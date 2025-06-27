<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Rasty Admin Espartero',
            'email' => 'gemrasty@gmail.com',
            'password' => Hash::make('password'), 
            'role' => 'admin',
        ]);

        // Product Manager
        User::create([
            'name' => 'Rasty PM Espartero',
            'email' => 'rcannuespartero@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'product-manager',
        ]);
    }
}
