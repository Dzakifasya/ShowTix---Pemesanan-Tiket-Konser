<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transaksi_id')
                ->constrained('transaksis')
                ->cascadeOnDelete();

            $table->foreignId('kategori_tiket_id')
                ->constrained('kategori_tikets')
                ->cascadeOnDelete();

            $table->integer('jumlah_tiket');

            $table->decimal('harga_satuan', 12, 2);

            $table->decimal('subtotal', 12, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};