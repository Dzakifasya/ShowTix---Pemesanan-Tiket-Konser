<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display payment page
     */
    public function index(Request $request)
    {
        $transaksiId = $request->query('transaksi_id');

        $transaksi = Transaksi::with(['pembeli', 'pemesanan.kategoriTiket.konser'])
                             ->findOrFail($transaksiId);

        // Check if user owns this transaction
        if ($transaksi->pembeli->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak mengakses halaman ini');
        }

        // Check if payment already processed
        if ($transaksi->status_transaksi === 'completed') {
            return redirect()->route('payment.success', ['transaksi_id' => $transaksiId]);
        }

        // Check if payment expired
        if (PaymentService::isPaymentExpired($transaksi)) {
            return redirect()->route('home')
                ->with('error', 'Waktu pembayaran telah habis. Silakan pesan kembali.');
        }

        // Get payment methods
        $paymentMethods = PaymentService::getPaymentMethods();

        // Calculate payment details
        $subtotal = $transaksi->total_harga;
        $serviceCharge = 3000; // Fixed service charge

        // Get transaction details
        $items = $transaksi->pemesanan()->with('kategoriTiket.konser')->get();

        // Get expiry time
        $expirySeconds = PaymentService::getPaymentExpirySeconds($transaksi);

        return view('payment.index', compact(
            'transaksi',
            'paymentMethods',
            'subtotal',
            'serviceCharge',
            'items',
            'expirySeconds'
        ));
    }

    /**
     * Process payment (AJAX)
     */
    public function verify(StorePaymentRequest $request)
    {
        try {
            $validated = $request->validated();

            $transaksi = Transaksi::findOrFail($validated['transaksi_id']);

            // Verify ownership
            if ($transaksi->pembeli->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak berhak mengakses transaksi ini',
                ], 403);
            }

            // Check if already paid
            if ($transaksi->status_transaksi === 'completed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran sudah diproses sebelumnya',
                ], 400);
            }

            // Check if expired
            if (PaymentService::isPaymentExpired($transaksi)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Waktu pembayaran telah habis',
                ], 400);
            }

            // Calculate service fee
            $serviceCharge = 3000;

            // Create payment record
            $pembayaran = PaymentService::createPayment(
                $transaksi,
                $validated['metode_pembayaran'],
                $serviceCharge
            );

            // Format payment code
            $formattedCode = PaymentService::formatPaymentCode(
                $pembayaran->kode_pembayaran,
                $validated['metode_pembayaran']
            );

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil diproses',
                'transaksi_id' => $transaksi->id,
                'payment_code' => $formattedCode,
                'method' => $validated['metode_pembayaran'],
                'total_amount' => $transaksi->total_harga + $serviceCharge,
                'redirect_url' => route('payment.success', ['transaksi_id' => $transaksi->id]),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display payment success page
     */
    public function success(Request $request)
    {
        $transaksiId = $request->query('transaksi_id');

        $transaksi = Transaksi::with([
            'pembeli',
            'pemesanan.kategoriTiket.konser',
            'pemesanan.tiket',
            'pembayaran'
        ])->findOrFail($transaksiId);

        // Check if user owns this transaction
        if ($transaksi->pembeli->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak mengakses halaman ini');
        }

        // Get payment info
        $pembayaran = $transaksi->pembayaran;

        return view('payment.success', compact('transaksi', 'pembayaran'));
    }

    /**
     * Get payment status (AJAX - for polling)
     */
    public function getStatus(Request $request)
    {
        $transaksiId = $request->query('transaksi_id');

        $transaksi = Transaksi::with('pembeli', 'pembayaran')->findOrFail($transaksiId);

        // Check if user owns this transaction
        if ($transaksi->pembeli->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $expirySeconds = PaymentService::getPaymentExpirySeconds($transaksi);
        $isExpired = PaymentService::isPaymentExpired($transaksi);

        return response()->json([
            'success' => true,
            'status' => $transaksi->status_transaksi,
            'payment_status' => $transaksi->pembayaran?->status_pembayaran,
            'expired' => $isExpired,
            'expiry_seconds' => max(0, $expirySeconds),
        ]);
    }

    /**
     * Handle payment webhook from gateway
     */
    public function webhook(Request $request)
    {
        // This is for payment gateway webhooks (Midtrans, Doku, etc.)
        // Implementation depends on the payment gateway used

        // For now, just log the webhook
        \Log::info('Payment Webhook Received', $request->all());

        return response()->json(['status' => 'ok']);
    }

    /**
     * Cancel payment (expire transaction)
     */
    public function cancel(Request $request)
    {
        $transaksiId = $request->query('transaksi_id');

        $transaksi = Transaksi::findOrFail($transaksiId);

        // Check if user owns this transaction
        if ($transaksi->pembeli->user_id !== auth()->id()) {
            return redirect()->route('home')
                ->with('error', 'Anda tidak berhak membatalkan transaksi ini');
        }

        // Only allow cancellation if not completed
        if ($transaksi->status_transaksi === 'completed') {
            return redirect()->route('payment.success', ['transaksi_id' => $transaksiId])
                ->with('error', 'Pembayaran sudah diproses');
        }

        // Mark as expired
        $transaksi->update(['status_transaksi' => 'expired']);

        // Restore quota
        foreach ($transaksi->pemesanan as $pemesanan) {
            $pemesanan->kategoriTiket->increment('sisa_kuota', $pemesanan->jumlah_tiket);
        }

        return redirect()->route('home')
            ->with('success', 'Transaksi dibatalkan. Tiket kembali ke stok tersedia.');
    }
}
