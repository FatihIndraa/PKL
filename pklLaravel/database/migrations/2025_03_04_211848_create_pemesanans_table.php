<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke users
            $table->foreignId('paket_id')->constrained('pakets')->onDelete('cascade'); // Relasi ke pakets
            $table->string('nama');
            $table->string('email');
            $table->date('tanggal'); // Menyimpan tanggal pemesanan
            $table->time('jam'); // Menyimpan jam pemesanan
            $table->text('catatan')->nullable(); // Bisa kosong
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanans');
    }
};
