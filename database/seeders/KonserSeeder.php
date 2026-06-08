<?php

namespace Database\Seeders;

use App\Models\Konser;
use Illuminate\Database\Seeder;

class KonserSeeder extends Seeder
{
    public function run(): void
    {
        Konser::insert([
            [
                'nama_konser' => 'ShowTix Music Festival 2026',
                'deskripsi' => 'Festival musik terbesar tahun 2026',
                'tanggal_konser' => '2026-07-10',
                'waktu_konser' => '19:00:00',
                'lokasi' => 'Jakarta International Stadium',
                'poster' => null,
                'status_konser' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_konser' => 'Bandung Indie Night',
                'deskripsi' => 'Konser musik indie terbaik di Bandung',
                'tanggal_konser' => '2026-08-15',
                'waktu_konser' => '20:00:00',
                'lokasi' => 'Sasana Budaya Ganesha',
                'poster' => null,
                'status_konser' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_konser' => 'Jakarta Music Fest',
                'deskripsi' => 'Festival musik modern Indonesia',
                'tanggal_konser' => '2026-09-20',
                'waktu_konser' => '18:30:00',
                'lokasi' => 'Gelora Bung Karno',
                'poster' => null,
                'status_konser' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}