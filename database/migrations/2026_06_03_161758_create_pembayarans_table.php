<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transaksi_id')
                ->unique()
                ->constrained('transaksis')
                ->cascadeOnDelete();

            $table->string('metode_pembayaran');

            $table->decimal('jumlah_bayar', 12, 2);

            $table->dateTime('tanggal_bayar')->nullable();

            $table->enum('status_pembayaran', [
                'Pending',
                'Berhasil',
                'Gagal'
            ])->default('Pending');

            $table->string('bukti_pembayaran')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};