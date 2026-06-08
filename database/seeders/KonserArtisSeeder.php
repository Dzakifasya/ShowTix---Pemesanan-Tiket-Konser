<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonserArtisSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('konser_artis')->insert([
            ['konser_id' => 1, 'artis_id' => 1],
            ['konser_id' => 1, 'artis_id' => 2],
            ['konser_id' => 1, 'artis_id' => 3],

            ['konser_id' => 2, 'artis_id' => 4],
            ['konser_id' => 2, 'artis_id' => 5],

            ['konser_id' => 3, 'artis_id' => 1],
            ['konser_id' => 3, 'artis_id' => 5],
        ]);
    }
}