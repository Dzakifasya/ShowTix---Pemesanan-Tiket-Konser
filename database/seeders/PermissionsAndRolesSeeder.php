<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PermissionsAndRolesSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate([
            'name' => 'Admin'
        ]);

        $operatorRole = Role::firstOrCreate([
            'name' => 'Operator'
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@showtix.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        $operator = User::firstOrCreate(
            ['email' => 'operator@showtix.com'],
            [
                'name' => 'Operator',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );

        $admin->assignRole('Admin');
        $operator->assignRole('Operator');
    }
}