<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Admin User
        User::create([
            'name' => 'Admin Studio',
            'email' => 'admin@studio.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Member User
        User::create([
            'name' => 'Member User',
            'email' => 'member@studio.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);
    }
}
