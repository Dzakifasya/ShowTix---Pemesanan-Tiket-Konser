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
        Schema::table('pembelis', function (Blueprint $table) {
            $table->string('email')->nullable()->after('nama_lengkap');
            $table->string('no_whatsapp', 20)->nullable()->after('no_hp');
            $table->string('jenis_kelamin')->nullable()->after('no_whatsapp');
            $table->string('provinsi')->nullable()->after('jenis_kelamin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelis', function (Blueprint $table) {
            $table->dropColumn(['email', 'no_whatsapp', 'jenis_kelamin', 'provinsi']);
        });
    }
};
