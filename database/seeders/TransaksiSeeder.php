<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            Transaksi::create([
                'pembeli_id' => rand(1,5),
                'kode_transaksi' => 'TRX-2026-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'tanggal_transaksi' => now(),
                'total_harga' => rand(300000,1500000),
                'status_transaksi' => 'Berhasil',
            ]);

        }
    }
}