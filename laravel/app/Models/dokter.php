<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;


class Dokter extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function rekamMedis(){
        return $this->hasMany(RekamMedis::class);
    }
}
