<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama', 'email', 'paket_id', 'tanggal', 'jam', 'catatan', 'bukti_pembayaran', 'status_pemesanan', 'status_selesai'];


    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    
    // Relasi ke tabel pakets
    public function paket()
    {
        return $this->belongsTo(\App\Models\Paket::class);
    }
}
