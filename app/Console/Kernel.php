<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\PemesananController;
use App\Models\Pemesanan;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
    // di app/Console/Kernel.php
    // app/Console/Kernel.php
    // app/Console/Kernel.php

    protected $commands = [
        Commands\UpdatePemesananStatus::class, // Pastikan command sudah didaftarkan
    ];

    // app/Console/Kernel.php

    protected function schedule(Schedule $schedule)
    {
        // Memeriksa status selesai setiap 5 menit
        $schedule->call(function () {
            Pemesanan::where('status_selesai', 'belum_selesai')
                ->where('status_pemesanan', 'disetujui')
                ->get()
                ->each(function ($pemesanan) {
                    $start = Carbon::parse($pemesanan->tanggal . ' ' . $pemesanan->jam);
                    $jamSelesai = $start->copy()->addMinutes($pemesanan->paket->durasi);

                    // Cek jika waktu sudah terlewat
                    if (now()->greaterThanOrEqualTo($jamSelesai)) {
                        $pemesanan->update(['status_selesai' => 'selesai']);
                    }
                });
        })->everyFiveMinutes(); // Menjalankan setiap 5 menit
    }
}
