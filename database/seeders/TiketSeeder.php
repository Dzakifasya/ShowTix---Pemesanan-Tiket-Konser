<?php

namespace Database\Seeders;

use App\Models\Tiket;
use Illuminate\Database\Seeder;

class TiketSeeder extends Seeder
{
    public function run(): void
    {
        $nomor = 1;

        for ($pemesanan = 1; $pemesanan <= 10; $pemesanan++) {

            for ($j = 1; $j <= 2; $j++) {

                Tiket::create([
                    'pemesanan_id' => $pemesanan,
                    'kode_tiket' => 'TKT-' . str_pad($nomor, 5, '0', STR_PAD_LEFT),
                    'qr_code' => 'QR-' . $nomor,
                    'status_tiket' => 'Aktif',
                ]);

                $nomor++;
            }
        }
    }
}