<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RekamMedis;

class Tindakan extends Model
{
    public function rekam_medis(){
        return $this->belongsTo(RekamMedis::class);
    }
    protected $fillable = ['rekam_medis_id', 'tindakan'];
}
