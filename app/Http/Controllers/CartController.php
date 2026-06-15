<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\KategoriTiket;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display shopping cart
     */
    public function index()
    {
        $cartItems = session('cart', []);
        $cartCount = session('cart_count', 0);

        // Enrich cart items with current concert info (in case it changed)
        $cartItems = [];
        $totalPrice = 0;

        foreach (session('cart', []) as $key => $item) {
            $kategoriTiket = KategoriTiket::with('konser')->find($item['kategori_tiket_id']);

            if ($kategoriTiket) {
                $cartItems[] = [
                    'id' => $key,
                    'konser_nama' => $kategoriTiket->konser->nama_konser,
                    'tanggal_konser' => $kategoriTiket->konser->tanggal_konser,
                    'lokasi' => $kategoriTiket->konser->lokasi,
                    'poster' => $kategoriTiket->konser->poster,
                    'kategori_nama' => $kategoriTiket->nama_kategori,
                    'jumlah_tiket' => $item['jumlah_tiket'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ];

                $totalPrice += $item['subtotal'];
            }
        }

        return view('cart.index', compact('cartItems', 'cartCount', 'totalPrice'));
    }

    /**
     * Add item to cart (AJAX)
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'konser_id' => 'required|integer|exists:konsers,id',
            'kategori_tiket_id' => 'required|integer|exists:kategori_tikets,id',
            'jumlah_tiket' => 'required|integer|min:1|max:50',
        ]);

        try {
            $konser = Konser::find($validated['konser_id']);
            $kategori = KategoriTiket::find($validated['kategori_tiket_id']);

            // Check if ticket quantity is available
            if ($kategori->sisa_kuota < $validated['jumlah_tiket']) {
                return response()->json([
                    'success' => false,
                    'message' => "Tiket {$kategori->nama_kategori} hanya tersisa {$kategori->sisa_kuota}",
                ], 422);
            }

            // Add to cart via service
            $this->cartService->addToCart(
                $validated['konser_id'],
                $validated['kategori_tiket_id'],
                $validated['jumlah_tiket'],
                $kategori->harga
            );

            $cartCount = count(session('cart', []));

            return response()->json([
                'success' => true,
                'message' => "Tiket {$kategori->nama_kategori} berhasil ditambahkan ke keranjang",
                'cart_count' => $cartCount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update cart item quantity (AJAX)
     */
    public function update(Request $request, $itemId)
    {
        $validated = $request->validate([
            'jumlah_tiket' => 'required|integer|min:1|max:50',
        ]);

        try {
            $cart = session('cart', []);

            if (!array_key_exists($itemId, $cart)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item tidak ditemukan di keranjang',
                ], 404);
            }

            $kategoriTiket = KategoriTiket::find($cart[$itemId]['kategori_tiket_id']);

            // Check availability
            if ($kategoriTiket->sisa_kuota < $validated['jumlah_tiket']) {
                return response()->json([
                    'success' => false,
                    'message' => "Tiket hanya tersisa {$kategoriTiket->sisa_kuota}",
                ], 422);
            }

            $this->cartService->updateItem($itemId, $validated['jumlah_tiket']);

            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diperbarui',
                'subtotal' => $cart[$itemId]['harga_satuan'] * $validated['jumlah_tiket'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove item from cart (AJAX)
     */
    public function remove(Request $request, $itemId)
    {
        try {
            $this->cartService->removeItem($itemId);

            $cartCount = count(session('cart', []));

            return response()->json([
                'success' => true,
                'message' => 'Tiket dihapus dari keranjang',
                'cart_count' => $cartCount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        session()->forget('cart');
        session()->forget('cart_count');

        return redirect()->route('home')->with('success', 'Keranjang dikosongkan');
    }

    /**
     * Get cart summary (AJAX)
     */
    public function getSummary()
    {
        $cart = session('cart', []);
        $totalPrice = array_sum(array_column($cart, 'subtotal'));
        $itemCount = count($cart);
        $ticketCount = array_sum(array_column($cart, 'jumlah_tiket'));

        return response()->json([
            'success' => true,
            'item_count' => $itemCount,
            'ticket_count' => $ticketCount,
            'total_price' => $totalPrice,
        ]);
    }
}
