<?php

namespace Database\Seeders;

use App\Models\Pemesanan;
use Illuminate\Database\Seeder;

class PemesananSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $harga = rand(500000,1500000);
            $jumlah = rand(1,3);

            Pemesanan::create([
                'transaksi_id' => $i,
                'kategori_tiket_id' => rand(1,6),
                'jumlah_tiket' => $jumlah,
                'harga_satuan' => $harga,
                'subtotal' => $harga * $jumlah,
            ]);
        }
    }
}