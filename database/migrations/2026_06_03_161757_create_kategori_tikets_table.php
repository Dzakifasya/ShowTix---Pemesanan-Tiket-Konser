<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_tikets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('konser_id')
                ->constrained('konsers')
                ->cascadeOnDelete();

            $table->string('nama_kategori');
            $table->decimal('harga', 12, 2);

            $table->integer('kuota');
            $table->integer('sisa_kuota');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_tikets');
    }
};