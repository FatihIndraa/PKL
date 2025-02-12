<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksis'; // Sesuaikan dengan nama tabel di database
    protected $fillable = ['user_id', 'paket_id', 'status', 'created_at', 'updated_at'];
}
