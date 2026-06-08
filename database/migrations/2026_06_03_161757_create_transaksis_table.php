<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pembeli_id')
                ->constrained('pembelis')
                ->cascadeOnDelete();

            $table->string('kode_transaksi')->unique();

            $table->dateTime('tanggal_transaksi');

            $table->decimal('total_harga', 12, 2);

            $table->enum('status_transaksi', [
                'Pending',
                'Berhasil',
                'Dibatalkan'
            ])->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};