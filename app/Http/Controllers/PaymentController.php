<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
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
     * Display payment method selection page
     */
    public function selectMethod(Request $request)
    {
        $transaksiId = $request->query('transaksi_id');

        $transaksi = Transaksi::with([
            'pembeli',
            'pembeli.user',
            'pemesanan.kategoriTiket.konser'
        ])->findOrFail($transaksiId);

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

        // Get cart items from transaksi
        $cartItems = [];
        $subtotal = 0;
        $serviceFee = 3000;
        
        foreach ($transaksi->pemesanan as $pemesanan) {
            $itemSubtotal = $pemesanan->harga_satuan * $pemesanan->jumlah_tiket;
            $cartItems[] = [
                'konser_nama' => $pemesanan->kategoriTiket->konser->nama_konser,
                'kategori_nama' => $pemesanan->kategoriTiket->nama_kategori,
                'jumlah_tiket' => $pemesanan->jumlah_tiket,
                'harga_satuan' => $pemesanan->harga_satuan,
                'subtotal' => $itemSubtotal,
            ];
            $subtotal += $itemSubtotal;
        }

        $grandTotal = $subtotal + $serviceFee;

        return view('payment.select-method', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'serviceFee' => $serviceFee,
            'grandTotal' => $grandTotal,
            'phone' => $transaksi->pembeli->no_hp ?? '',
            'transactionCode' => 'TXN' . str_pad($transaksi->id, 6, '0', STR_PAD_LEFT),
            'transaksi' => $transaksi,
        ]);
    }

    /**
     * Process payment with selected method
     */
    public function process(Request $request, $method)
    {
        // Get transaksi_id from query parameter, POST data, or session
        $transaksiId = $request->query('transaksi_id') 
                    ?? $request->post('transaksi_id')
                    ?? session('last_transaksi_id');
        
        if (!$transaksiId) {
            return redirect()->route('cart.index')
                ->with('error', 'Data transaksi tidak ditemukan');
        }

        $transaksi = Transaksi::with('pembeli')->findOrFail($transaksiId);

        // Check if user owns this transaction
        if ($transaksi->pembeli->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak mengakses transaksi ini');
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

        try {
            // Create payment record
            $serviceCharge = 3000;
            $pembayaran = PaymentService::createPayment(
                $transaksi,
                $method,
                $serviceCharge
            );

            // Format payment code
            $formattedCode = PaymentService::formatPaymentCode(
                $pembayaran->kode_pembayaran,
                $method
            );

            // Store method in session for next step
            session(['payment_method' => $method, 'transaksi_id' => $transaksiId]);

            // Redirect to payment instruction page based on method
            return redirect()->route('payment.index', ['transaksi_id' => $transaksiId])
                ->with([
                    'success' => true,
                    'payment_method' => $method,
                    'payment_code' => $formattedCode,
                    'total_amount' => $transaksi->total_harga + $serviceCharge,
                ]);

        } catch (\Exception $e) {
            return redirect()->route('payment.select-method', ['transaksi_id' => $transaksiId])
                ->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
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
