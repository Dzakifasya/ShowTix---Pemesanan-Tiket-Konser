<?php

namespace App\Services;

use App\Repositories\KategoriTiketRepositoryInterface;

class CartService
{
    protected $tiketRepository;

    public function __construct(KategoriTiketRepositoryInterface $tiketRepository)
    {
        $this->tiketRepository = $tiketRepository;
    }

    /**
     * Add item to cart with validation
     */
    public function addToCart($konser_id, $kategori_tiket_id, $jumlah_tiket, $harga_satuan)
    {
        // Check availability
        if (!$this->tiketRepository->isAvailable($kategori_tiket_id, $jumlah_tiket)) {
            throw new \Exception('Tiket yang tersedia tidak cukup');
        }

        // Get cart from session
        $cart = session('cart', []);

        // Create item key
        $itemKey = 'item_' . $konser_id . '_' . $kategori_tiket_id;

        // Add or update item
        if (array_key_exists($itemKey, $cart)) {
            $cart[$itemKey]['jumlah_tiket'] += $jumlah_tiket;
            $cart[$itemKey]['subtotal'] = $cart[$itemKey]['harga_satuan'] * $cart[$itemKey]['jumlah_tiket'];
        } else {
            $cart[$itemKey] = [
                'id' => $itemKey,
                'konser_id' => $konser_id,
                'kategori_tiket_id' => $kategori_tiket_id,
                'harga_satuan' => $harga_satuan,
                'jumlah_tiket' => $jumlah_tiket,
                'subtotal' => $harga_satuan * $jumlah_tiket,
            ];
        }

        // Save to session
        session(['cart' => $cart]);
        session(['cart_count' => count($cart)]);

        return $cart[$itemKey];
    }

    /**
     * Update item quantity
     */
    public function updateItem($itemKey, $jumlah_tiket)
    {
        $cart = session('cart', []);

        if (array_key_exists($itemKey, $cart)) {
            $cart[$itemKey]['jumlah_tiket'] = $jumlah_tiket;
            $cart[$itemKey]['subtotal'] = $cart[$itemKey]['harga_satuan'] * $jumlah_tiket;
            session(['cart' => $cart]);
            return $cart[$itemKey];
        }

        throw new \Exception('Item tidak ditemukan di keranjang');
    }

    /**
     * Remove item from cart
     */
    public function removeItem($itemKey)
    {
        $cart = session('cart', []);

        if (array_key_exists($itemKey, $cart)) {
            unset($cart[$itemKey]);
            session(['cart' => $cart]);
            session(['cart_count' => count($cart)]);
            return true;
        }

        throw new \Exception('Item tidak ditemukan di keranjang');
    }

    /**
     * Clear cart
     */
    public function clearCart()
    {
        session()->forget('cart');
        session(['cart_count' => 0]);
        return true;
    }

    /**
     * Get cart items
     */
    public function getCart()
    {
        return session('cart', []);
    }

    /**
     * Get cart total
     */
    public function getCartTotal()
    {
        $cart = $this->getCart();
        return array_reduce($cart, function ($total, $item) {
            return $total + $item['subtotal'];
        }, 0);
    }

    /**
     * Get cart count
     */
    public function getCartCount()
    {
        return session('cart_count', 0);
    }
}
