<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckoutRequest;
use App\Services\CheckoutService;
use App\Services\LocationService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    /**
     * Display checkout form
     */
    public function index()
    {
        $summary = $this->checkoutService->getCheckoutSummary();

        if (!$summary) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong');
        }

        // Get provinces for form
        $provinces = LocationService::getProvinces();

        return view('checkout.index', compact('summary', 'provinces'));
    }

    /**
     * Process checkout (AJAX or Form)
     */
    public function process(StoreCheckoutRequest $request)
    {
        // Validate cart first
        $cartValidation = $this->checkoutService->validateCart();
        if (!$cartValidation['valid']) {
            return response()->json([
                'success' => false,
                'message' => $cartValidation['message'],
            ], 422);
        }

        try {
            $validated = $request->validated();

            // Process checkout via service
            $transaksi = $this->checkoutService->processCheckout(
                auth()->id(),
                $validated
            );

            // Return response
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Checkout berhasil',
                    'transaksi_id' => $transaksi->id,
                    'redirect_url' => route('payment.select-method', ['transaksi_id' => $transaksi->id]),
                ]);
            }

            return redirect()
                ->route('payment.select-method', ['transaksi_id' => $transaksi->id])
                ->with('success', 'Checkout berhasil, pilih metode pembayaran');

        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 500);
            }

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Store checkout data and process transaction
     */
    public function store(Request $request)
    {
        // 1. Validate all required fields
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'email_confirmation' => ['required', 'email', 'same:email'],
            'no_whatsapp' => ['required', 'string', 'min:9', 'max:15'],
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan,other'],
            'provinsi' => ['required', 'string'],
            'tanggal_lahir' => ['required', 'date'],
            'agree_terms' => ['required', 'accepted'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nama_lengkap.min' => 'Nama minimal 3 karakter',
            'nama_lengkap.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email_confirmation.required' => 'Konfirmasi email wajib diisi',
            'email_confirmation.same' => 'Email tidak cocok',
            'no_whatsapp.required' => 'Nomor HP/WhatsApp wajib diisi',
            'no_whatsapp.min' => 'Nomor HP/WhatsApp minimal 9 digit',
            'no_whatsapp.max' => 'Nomor HP/WhatsApp maksimal 15 digit',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',
            'provinsi.required' => 'Provinsi wajib dipilih',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.date' => 'Format tanggal tidak valid',
            'agree_terms.required' => 'Anda harus menyetujui syarat dan ketentuan',
            'agree_terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan',
        ]);

        // 2. Validate cart
        $cartValidation = $this->checkoutService->validateCart();
        if (!$cartValidation['valid']) {
            return back()->with('error', $cartValidation['message'])->withInput();
        }

        $summary = $this->checkoutService->getCheckoutSummary();
        if (!$summary || empty($summary['items'])) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong');
        }

        try {
            // Get cart details before processing checkout clears the session cart
            $cart = session('cart', []);
            $firstItemKey = array_key_first($cart);
            $firstItem = $cart[$firstItemKey] ?? null;

            $id_konser = $firstItem ? $firstItem['konser_id'] : null;
            $id_kategori_tiket = $firstItem ? $firstItem['kategori_tiket_id'] : null;
            $jumlah_tiket = $summary['total_tiket'];
            $subtotal = $summary['total_price'];
            $serviceFee = 3000;
            $total = $subtotal + $serviceFee;

            // Process checkout via service (creates Pembeli, Transaksi, Pemesanan, and Tiket records)
            $transaksi = $this->checkoutService->processCheckout(
                auth()->id(),
                [
                    'nama_lengkap' => $request->nama_lengkap,
                    'email' => $request->email,
                    'no_whatsapp' => $request->no_whatsapp,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'provinsi' => $request->provinsi,
                    'tanggal_lahir' => $request->tanggal_lahir,
                ]
            );

            // Simpan data checkout sementara di session
            session([
                'id_konser' => $id_konser,
                'id_kategori_tiket' => $id_kategori_tiket,
                'nama_pembeli' => $request->nama_lengkap,
                'email' => $request->email,
                'no_hp' => $request->no_whatsapp,
                'jumlah_tiket' => $jumlah_tiket,
                'subtotal' => $subtotal,
                'total' => $total,
                'last_transaksi_id' => $transaksi->id,
            ]);

            return redirect()->route('payment.index', ['transaksi_id' => $transaksi->id]);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
