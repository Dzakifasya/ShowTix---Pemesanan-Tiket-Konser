<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            Pembayaran::create([
                'transaksi_id' => $i,
                'metode_pembayaran' => ['Transfer Bank','QRIS'][rand(0,1)],
                'jumlah_bayar' => rand(500000,3000000),
                'tanggal_bayar' => now(),
                'status_pembayaran' => 'Berhasil',
                'bukti_pembayaran' => null,
            ]);
        }
    }
}