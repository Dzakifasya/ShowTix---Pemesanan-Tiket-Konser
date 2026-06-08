<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artis;

class ArtisSeeder extends Seeder
{
    public function run(): void
    {
        Artis::insert([
            [
                'nama_artis' => 'Tulus',
                'genre' => 'Pop',
                'negara_asal' => 'Indonesia',
                'deskripsi' => 'Penyanyi Pop Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_artis' => 'Hindia',
                'genre' => 'Indie',
                'negara_asal' => 'Indonesia',
                'deskripsi' => 'Musisi Indie Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_artis' => 'Pamungkas',
                'genre' => 'Pop',
                'negara_asal' => 'Indonesia',
                'deskripsi' => 'Solo Singer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_artis' => 'Nadin Amizah',
                'genre' => 'Folk',
                'negara_asal' => 'Indonesia',
                'deskripsi' => 'Penyanyi Folk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_artis' => 'Juicy Luicy',
                'genre' => 'Pop',
                'negara_asal' => 'Indonesia',
                'deskripsi' => 'Band Pop Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}