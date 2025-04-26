<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pemesanan extends Model
{
    // di app/Models/Pemesanan.php
    public function isSelesai()
    {
        return $this->status_selesai == 'selesai';
    }

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'paket_id',
        'tanggal',
        'jam',
        'catatan',
        'status_pemesanan',
        'status_selesai',
        'bukti_pembayaran'
    ];

    protected $appends = ['jam_selesai'];

    // Relasi dengan Paket
    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk jam_selesai
    public function getJamSelesaiAttribute()
    {
        try {
            $jamMulai = Carbon::createFromFormat('H:i', $this->jam);
            $jamSelesai = $jamMulai->copy()->addMinutes($this->paket->durasi);
            return $jamSelesai->format('H:i');
        } catch (\Exception $e) {
            return '--:--';
        }
    }

    // Cek apakah pemesanan sudah selesai berdasarkan waktu
    public function getIsCompletedAttribute()
    {
        if ($this->status_selesai) {
            return true;
        }

        try {
            $tanggalSelesai = Carbon::parse($this->tanggal)
                ->setTimeFromTimeString($this->jam_selesai);

            return now()->greaterThanOrEqualTo($tanggalSelesai);
        } catch (\Exception $e) {
            return false;
        }
    }
}
