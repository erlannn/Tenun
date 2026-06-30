<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');

            $table->foreignId('id_pelanggan')
                ->constrained('pelanggan', 'id_pelanggan')
                ->cascadeOnDelete();

            $table->date('tanggal_pesan');

            $table->date('tanggal_selesai')
                ->nullable();

            $table->enum('jenis_transaksi', [
                'PreOrder',
                'Bahan'
            ]);

            $table->enum('status', [
                'diproses',
                'selesai'
            ])->default('diproses');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};