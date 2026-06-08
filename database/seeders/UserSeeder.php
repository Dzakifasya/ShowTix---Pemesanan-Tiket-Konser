<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@showtix.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pembeli',
            ],
            [
                'name' => 'Siti Rahma',
                'email' => 'siti@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pembeli',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pembeli',
            ],
            [
                'name' => 'Dinda Putri',
                'email' => 'dinda@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pembeli',
            ],
            [
                'name' => 'Raka Pratama',
                'email' => 'raka@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'pembeli',
            ],
        ]);
    }
}