<?php

namespace App\Services;

use App\Models\Pembeli;
use App\Models\Pemesanan;
use App\Models\Transaksi;
use App\Models\KategoriTiket;
use App\Models\Tiket;
use DB;

class CheckoutService
{
    /**
     * Create or update pembeli (customer) record
     */
    public function createOrUpdatePembeli($userId, $data)
    {
        return Pembeli::updateOrCreate(
            ['user_id' => $userId],
            [
                'nama_lengkap' => $data['nama_lengkap'],
                'email' => $data['email'],
                'no_hp' => $data['no_hp'] ?? $data['no_whatsapp'],
                'no_whatsapp' => $data['no_whatsapp'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'provinsi' => $data['provinsi'],
                'tanggal_lahir' => $data['tanggal_lahir'],
            ]
        );
    }

    /**
     * Process checkout and create transaction
     */
    public function processCheckout($userId, $pembeliData)
    {
        return DB::transaction(function () use ($userId, $pembeliData) {
            // Get or create pembeli
            $pembeli = $this->createOrUpdatePembeli($userId, $pembeliData);

            // Get cart items from session
            $cart = session('cart', []);

            if (empty($cart)) {
                throw new \Exception('Keranjang Anda kosong');
            }

            // Calculate total
            $totalHarga = 0;
            foreach ($cart as $item) {
                $totalHarga += $item['subtotal'];
            }

            // Create transaction
            $transaksi = Transaksi::create([
                'pembeli_id' => $pembeli->id,
                'kode_transaksi' => $this->generateTransactionCode(),
                'tanggal_transaksi' => now(),
                'expired_at' => now()->addMinutes(15),
                'total_harga' => $totalHarga,
                'status_transaksi' => 'Pending',
            ]);

            // Create pemesanan (orders) for each cart item
            foreach ($cart as $item) {
                $kategoriTiket = KategoriTiket::findOrFail($item['kategori_tiket_id']);

                // Check availability one more time
                if ($kategoriTiket->sisa_kuota < $item['jumlah_tiket']) {
                    throw new \Exception("Tiket {$kategoriTiket->nama_kategori} tidak tersedia");
                }

                // Create pemesanan
                $pemesanan = Pemesanan::create([
                    'transaksi_id' => $transaksi->id,
                    'kategori_tiket_id' => $item['kategori_tiket_id'],
                    'jumlah_tiket' => $item['jumlah_tiket'],
                    'harga_satuan' => $item['harga_satuan'],
                    'subtotal' => $item['subtotal'],
                ]);

                // Update kategori tiket quota
                $kategoriTiket->decrement('sisa_kuota', $item['jumlah_tiket']);

                // Create individual tikets
                for ($i = 0; $i < $item['jumlah_tiket']; $i++) {
                    Tiket::create([
                        'pemesanan_id' => $pemesanan->id,
                        'kode_tiket' => $this->generateTicketCode($transaksi->id, $pemesanan->id, $i),
                        'status_tiket' => 'Aktif',
                    ]);
                }
            }

            // Clear session cart
            session()->forget('cart');
            session()->forget('cart_count');

            return $transaksi;
        });
    }

    /**
     * Generate unique transaction code
     */
    private function generateTransactionCode()
    {
        $prefix = 'TRX';
        $timestamp = now()->format('YmdHis');
        $random = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return "{$prefix}{$timestamp}{$random}";
    }

    /**
     * Generate unique ticket code
     */
    private function generateTicketCode($transaksiId, $pemesananId, $index)
    {
        $timestamp = now()->format('YmdH');
        $sequence = str_pad($index + 1, 3, '0', STR_PAD_LEFT);

        return "TKT{$timestamp}{$transaksiId}{$sequence}";
    }

    /**
     * Get checkout summary
     */
    public function getCheckoutSummary()
    {
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return null;
        }

        $items = [];
        $totalPrice = 0;

        foreach ($cart as $item) {
            $kategoriTiket = KategoriTiket::with('konser')->find($item['kategori_tiket_id']);
            
            if ($kategoriTiket) {
                $items[] = [
                    'id' => $item['id'],
                    'konser_nama' => $kategoriTiket->konser->nama_konser,
                    'kategori_nama' => $kategoriTiket->nama_kategori,
                    'harga_satuan' => $item['harga_satuan'],
                    'jumlah_tiket' => $item['jumlah_tiket'],
                    'subtotal' => $item['subtotal'],
                    'poster' => $kategoriTiket->konser->poster,
                ];

                $totalPrice += $item['subtotal'];
            }
        }

        return [
            'items' => $items,
            'item_count' => count($items),
            'total_tiket' => array_sum(array_column($items, 'jumlah_tiket')),
            'total_price' => $totalPrice,
        ];
    }

    /**
     * Validate cart before checkout
     */
    public function validateCart()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return [
                'valid' => false,
                'message' => 'Keranjang Anda kosong',
            ];
        }

        // Check each item availability
        foreach ($cart as $item) {
            $kategoriTiket = KategoriTiket::find($item['kategori_tiket_id']);

            if (!$kategoriTiket) {
                return [
                    'valid' => false,
                    'message' => 'Item tidak ditemukan di katalog',
                ];
            }

            if ($kategoriTiket->sisa_kuota < $item['jumlah_tiket']) {
                return [
                    'valid' => false,
                    'message' => "Tiket {$kategoriTiket->nama_kategori} hanya tersisa {$kategoriTiket->sisa_kuota} tiket",
                ];
            }
        }

        return [
            'valid' => true,
            'message' => 'Keranjang valid',
        ];
    }
}
