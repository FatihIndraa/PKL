<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateStatusPemesanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status-pemesanan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    // di app/Console/Commands/UpdateStatusPemesanan.php
    public function handle()
    {
        $pemesanans = \App\Models\Pemesanan::where('status_selesai', false)
            ->where('status_pemesanan', '!=', 'selesai')
            ->get();

        foreach ($pemesanans as $pemesanan) {
            if ($pemesanan->status_selesai_otomatis) {
                $pemesanan->update(['status_pemesanan' => 'selesai']);
            }
        }

        $this->info('Status pemesanan berhasil diperbarui.');
    }
}
