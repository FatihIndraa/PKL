<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Operator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'pasien',
                'email' => 'pasien@pasien.com',
                'password' => bcrypt('password'),
            ],
        ];
        $dokterData = [
            [
                'name' => 'dokter',
                'email' => 'dokter@dokter.com',
                'password' => bcrypt('password'),
            ],
        ];
        $operatorData = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
            ],
        ];
        
        foreach ($userData as $key => $value) {
            User::create($value);
        }
        foreach ($dokterData as $key => $value) {
            Dokter::create($value);
        }
        foreach ($operatorData as $key => $value) {
            Operator::create($value);
        }
    }
}
