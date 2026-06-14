<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Transaksi;
use App\Models\Pemesanan;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }

        return view('checkout.index', compact('cartItems'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'metode_pembayaran' => 'required|in:bank_transfer,e_wallet,credit_card,cicilan',
            'agree_terms' => 'required|accepted',
        ]);

        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            return back()->with('error', 'Keranjang Anda kosong');
        }

        try {
            // Get or create pembeli
            $pembeli = Pembeli::firstOrCreate(
                ['user_id' => auth()->id()],
                [
                    'nama_lengkap' => $validated['nama_lengkap'],
                    'no_hp' => $validated['no_hp'],
                    'alamat' => $validated['alamat'],
                    'tanggal_lahir' => $validated['tanggal_lahir'],
                ]
            );

            // Calculate totals
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += $item['subtotal'];
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
