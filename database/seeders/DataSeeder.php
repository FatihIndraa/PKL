<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Paket; 

class DataSeeder extends Seeder
{
    public function run(): void
    {
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

        // Paket Data
        Paket::insert([
            [
                'nama_paket' => 'Paket Hemat',
                'deskripsi' => 'Paket foto murah meriah dengan kualitas terbaik.',
                'harga' => 150000,
                'gambar' => 'paket/satu.jpg',
                'durasi' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_paket' => 'Paket Premium',
                'deskripsi' => 'Paket eksklusif dengan editing profesional.',
                'harga' => 300000,
                'durasi' => 60,
                'gambar' => 'paket/duwa.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
