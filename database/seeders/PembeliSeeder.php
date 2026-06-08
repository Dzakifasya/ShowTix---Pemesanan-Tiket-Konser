<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembeli;

class PembeliSeeder extends Seeder
{
    public function run(): void
    {
        Pembeli::insert([
            [
                'user_id' => 2,
                'nama_lengkap' => 'Budi Santoso',
                'no_hp' => '081234567890',
                'alamat' => 'Jakarta',
                'tanggal_lahir' => '2002-05-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'nama_lengkap' => 'Siti Rahma',
                'no_hp' => '081234567891',
                'alamat' => 'Bandung',
                'tanggal_lahir' => '2001-08-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'nama_lengkap' => 'Ahmad Fauzi',
                'no_hp' => '081234567892',
                'alamat' => 'Surabaya',
                'tanggal_lahir' => '2000-03-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'nama_lengkap' => 'Dinda Putri',
                'no_hp' => '081234567893',
                'alamat' => 'Yogyakarta',
                'tanggal_lahir' => '2002-11-25',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'nama_lengkap' => 'Raka Pratama',
                'no_hp' => '081234567894',
                'alamat' => 'Semarang',
                'tanggal_lahir' => '2001-06-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}