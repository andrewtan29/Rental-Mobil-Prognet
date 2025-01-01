<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->foreignId('id_mobil')->constrained('mobil');
            $table->foreignId('id_pelanggan')->constrained('pelanggan');
            $table->foreignId('id_admin')->constrained('users');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->bigInteger('harga_sewa');
            $table->bigInteger('total_harga');
            $table->enum('status_transaksi', ['selesai', 'batal', 'sedang disewa']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
