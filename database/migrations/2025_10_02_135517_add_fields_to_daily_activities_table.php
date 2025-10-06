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
        Schema::table('daily_activities', function (Blueprint $table) {
            $table->time('waktu_mulai')->nullable()->after('tanggal');
            $table->time('waktu_selesai')->nullable()->after('waktu_mulai');
            $table->text('deskripsi')->nullable()->after('kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daily_activities', function (Blueprint $table) {
            $table->dropColumn(['waktu_mulai', 'waktu_selesai', 'deskripsi']);
        });
    }
};
