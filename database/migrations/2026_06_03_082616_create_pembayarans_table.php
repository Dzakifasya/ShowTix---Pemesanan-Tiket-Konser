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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
                $table->foreignId('pemesanan_id')
                    ->unique()
                    ->constrained('pemesanans')
                    ->cascadeOnDelete();

            $table->string('metode_pembayaran');

            $table->enum('status_pembayaran', [
                'Pending',
                'Lunas'
            ])->default('Pending');

            $table->dateTime('tanggal_bayar')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
