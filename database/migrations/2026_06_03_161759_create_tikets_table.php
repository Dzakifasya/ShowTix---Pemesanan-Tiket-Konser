<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pemesanan_id')
                ->constrained('pemesanans')
                ->cascadeOnDelete();

            $table->string('kode_tiket')->unique();

            $table->string('qr_code')->nullable();

            $table->enum('status_tiket', [
                'Aktif',
                'Digunakan',
                'Kadaluarsa'
            ])->default('Aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};