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
        $this->middleware('auth');
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
                    'redirect_url' => route('payment.index', ['transaksi_id' => $transaksi->id]),
                ]);
            }

            return redirect()
                ->route('payment.index', ['transaksi_id' => $transaksi->id])
                ->with('success', 'Checkout berhasil, lanjutkan ke pembayaran');

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
}

            $adminFee = $subtotal * 0.025;
            $serviceFee = 10000;
            $totalAmount = $subtotal + $adminFee + $serviceFee;

            // Create transaction
            $transaksi = Transaksi::create([
                'pembeli_id' => $pembeli->id,
                'total_harga' => $totalAmount,
                'status_transaksi' => 'pending',
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'no_referensi' => 'TXN' . str_pad(Transaksi::max('id') + 1, 8, '0', STR_PAD_LEFT),
            ]);

            // Create orders for each cart item
            foreach ($cartItems as $item) {
                $pemesanan = Pemesanan::create([
                    'transaksi_id' => $transaksi->id,
                    'kategori_tiket_id' => $item['kategori_tiket_id'],
                    'jumlah_tiket' => $item['jumlah_tiket'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);

                // Generate tickets
                for ($i = 0; $i < $item['jumlah_tiket']; $i++) {
                    Tiket::create([
                        'pemesanan_id' => $pemesanan->id,
                        'kode_tiket' => 'TKT' . strtoupper(Str::random(10)),
                        'status_tiket' => 'pending',
                    ]);
                }
            }

            // Clear cart and redirect to payment
            session(['cart' => []]);
            session(['cart_count' => 0]);
            session(['transaksi_id' => $transaksi->id]);
            session(['checkout_data' => $validated]);

            return redirect()->route('payment')->with('success', 'Silakan selesaikan pembayaran Anda');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
