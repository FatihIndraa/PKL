<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->enum('status_pemesanan', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->enum('status_selesai', ['belum_selesai', 'selesai'])->default('belum_selesai');
            $table->string('bukti_pembayaran')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn(['status_pemesanan', 'status_selesai', 'bukti_pembayaran']);
        });
    }
};
