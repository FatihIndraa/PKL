<?php

// app/Console/Commands/UpdateStatusPemesanan.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pemesanan;
use Carbon\Carbon;

class UpdatePemesananStatus extends Command
{
    protected $signature = 'update:status-pemesanan';
    protected $description = 'Update status pemesanan berdasarkan durasi paket';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Menjalankan update status pemesanan...');

        Pemesanan::where('status_selesai', 'belum_selesai')
            ->where('status_pemesanan', 'disetujui')
            ->with('paket')
            ->get()
            ->each(function ($pemesanan) {
                if (!$pemesanan->paket || $pemesanan->paket->durasi === null) {
                    return; // skip jika paket tidak ada atau durasi kosong
                }

                $start = Carbon::parse($pemesanan->tanggal . ' ' . $pemesanan->jam);
                $jamSelesai = $start->copy()->addMinutes($pemesanan->paket->durasi);

                if (now()->greaterThanOrEqualTo($jamSelesai)) {
                    $pemesanan->update(['status_selesai' => 'selesai']);
                }
            });

        $this->info('Update status pemesanan selesai.');
    }
}
