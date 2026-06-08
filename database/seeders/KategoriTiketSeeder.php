<?php

namespace Database\Seeders;

use App\Models\KategoriTiket;
use Illuminate\Database\Seeder;

class KategoriTiketSeeder extends Seeder
{
    public function run(): void
    {
        KategoriTiket::insert([
            [
                'konser_id' => 1,
                'nama_kategori' => 'VIP',
                'harga' => 1500000,
                'kuota' => 500,
                'sisa_kuota' => 500,
                'deskripsi' => 'Akses area VIP'
            ],
            [
                'konser_id' => 1,
                'nama_kategori' => 'Regular',
                'harga' => 750000,
                'kuota' => 1000,
                'sisa_kuota' => 1000,
                'deskripsi' => 'Tiket reguler'
            ],

            [
                'konser_id' => 2,
                'nama_kategori' => 'VIP',
                'harga' => 1200000,
                'kuota' => 400,
                'sisa_kuota' => 400,
                'deskripsi' => 'Akses area VIP'
            ],
            [
                'konser_id' => 2,
                'nama_kategori' => 'Regular',
                'harga' => 500000,
                'kuota' => 900,
                'sisa_kuota' => 900,
                'deskripsi' => 'Tiket reguler'
            ],

            [
                'konser_id' => 3,
                'nama_kategori' => 'VIP',
                'harga' => 1400000,
                'kuota' => 450,
                'sisa_kuota' => 450,
                'deskripsi' => 'Akses area VIP'
            ],
            [
                'konser_id' => 3,
                'nama_kategori' => 'Regular',
                'harga' => 800000,
                'kuota' => 1000,
                'sisa_kuota' => 1000,
                'deskripsi' => 'Tiket reguler'
            ],
        ]);
    }
}