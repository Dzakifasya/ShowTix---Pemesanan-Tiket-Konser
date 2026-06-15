<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Change status_transaksi to allow more states
            $table->string('status_transaksi')->change();
            
            // Add expired_at for payment timeout
            $table->dateTime('expired_at')->nullable()->after('tanggal_transaksi');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn('expired_at');
        });
    }
};
