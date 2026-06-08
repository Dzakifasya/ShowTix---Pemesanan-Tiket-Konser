<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konser_artis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('konser_id')
                ->constrained('konsers')
                ->cascadeOnDelete();

            $table->foreignId('artis_id')
                ->constrained('artis')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konser_artis');
    }
};