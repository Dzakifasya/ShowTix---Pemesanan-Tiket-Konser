<?php

namespace App\Http\Controllers;

use App\Models\Konser;
use App\Models\KategoriTiket;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session('cart', []);
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'konser_id' => 'required|exists:konsers,id',
            'kategori_tiket_id' => 'required|exists:kategori_tikets,id',
            'jumlah_tiket' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $konser = Konser::find($validated['konser_id']);
        $kategori = KategoriTiket::find($validated['kategori_tiket_id']);

        // Check if ticket quantity is available
        if ($kategori->sisa_kuota < $validated['jumlah_tiket']) {
            return back()->with('error', 'Tiket yang tersedia tidak cukup');
        }

        $cart = session('cart', []);

        $itemKey = 'item_' . $validated['konser_id'] . '_' . $validated['kategori_tiket_id'];

        $cartItem = [
            'id' => $itemKey,
            'konser_id' => $validated['konser_id'],
            'konser_nama' => $konser->nama_konser,
            'poster' => $konser->poster,
            'tanggal_konser' => is_string($konser->tanggal_konser) ? \Carbon\Carbon::parse($konser->tanggal_konser)->format('d M Y') : $konser->tanggal_konser->format('d M Y'),
            'lokasi' => $konser->lokasi,
            'kategori_tiket_id' => $validated['kategori_tiket_id'],
            'kategori_nama' => $kategori->nama_kategori,
            'harga_satuan' => $validated['harga_satuan'],
            'jumlah_tiket' => $validated['jumlah_tiket'],
            'subtotal' => $validated['harga_satuan'] * $validated['jumlah_tiket'],
        ];

        if (array_key_exists($itemKey, $cart)) {
            $cart[$itemKey]['jumlah_tiket'] += $validated['jumlah_tiket'];
            $cart[$itemKey]['subtotal'] = $cart[$itemKey]['harga_satuan'] * $cart[$itemKey]['jumlah_tiket'];
        } else {
            $cart[$itemKey] = $cartItem;
        }

        session(['cart' => $cart]);
        session(['cart_count' => count($cart)]);

        return redirect()->route('cart.index')->with('success', 'Tiket berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $itemId)
    {
        $validated = $request->validate([
            'jumlah_tiket' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);

        if (array_key_exists($itemId, $cart)) {
            $cart[$itemId]['jumlah_tiket'] = $validated['jumlah_tiket'];
            $cart[$itemId]['subtotal'] = $cart[$itemId]['harga_satuan'] * $validated['jumlah_tiket'];

            session(['cart' => $cart]);
            return back()->with('success', 'Keranjang berhasil diperbarui');
        }

        return back()->with('error', 'Item tidak ditemukan');
    }

    public function remove($itemId)
    {
        $cart = session('cart', []);

        if (array_key_exists($itemId, $cart)) {
            unset($cart[$itemId]);
            session(['cart' => $cart]);
            session(['cart_count' => count($cart)]);
            return back()->with('success', 'Tiket berhasil dihapus dari keranjang');
        }

        return back()->with('error', 'Item tidak ditemukan');
    }

    public function clear()
    {
        session(['cart' => []]);
        session(['cart_count' => 0]);
        return redirect()->route('home')->with('success', 'Keranjang berhasil dikosongkan');
    }
}
