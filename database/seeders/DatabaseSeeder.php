<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PembeliSeeder::class,

            ArtisSeeder::class,
            KonserSeeder::class,
            KonserArtisSeeder::class,

            KategoriTiketSeeder::class,

            TransaksiSeeder::class,
            PemesananSeeder::class,
            PembayaranSeeder::class,
            TiketSeeder::class,
    ]);
    }
}