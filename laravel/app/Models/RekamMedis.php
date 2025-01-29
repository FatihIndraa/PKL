<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Dokter;
use App\Models\tindakan;

class RekamMedis extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function dokter(){
        return $this->belongsTo(Dokter::class);
    }
    public function tindakan(){
        return $this->belongsTo(tindakan::class);
    }
}
