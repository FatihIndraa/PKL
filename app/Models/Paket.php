<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = ['nama_paket', 'harga', 'deskripsi', 'gambar', 'durasi'];
    protected $casts = [
        'harga' => 'decimal:2',
        'durasi' => 'integer', // Menggunakan integer untuk durasi
    ];
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
