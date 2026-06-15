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
}
