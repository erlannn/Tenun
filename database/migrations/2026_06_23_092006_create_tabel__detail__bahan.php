<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_bahan', function (Blueprint $table) {
            $table->id('id_detail_bahan');

            $table->foreignId('id_detail')
                ->constrained('detail_transaksi', 'id_detail')
                ->cascadeOnDelete();

            $table->foreignId('id_bahan')
                ->constrained('bahan', 'id_bahan')
                ->cascadeOnDelete();

            $table->integer('jumlah_bahan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_bahan');
    }
};