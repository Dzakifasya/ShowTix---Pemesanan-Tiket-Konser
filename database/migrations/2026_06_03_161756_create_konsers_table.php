<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konsers', function (Blueprint $table) {
            $table->id();

            $table->string('nama_konser');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_konser');
            $table->time('waktu_konser');
            $table->string('lokasi');
            $table->string('poster')->nullable();

            $table->enum('status_konser', [
                'Aktif',
                'Selesai',
                'Dibatalkan'
            ])->default('Aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsers');
    }
};