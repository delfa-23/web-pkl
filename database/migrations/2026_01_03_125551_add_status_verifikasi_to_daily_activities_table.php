<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('daily_activities', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['pending', 'diterima', 'ditolak'])
                ->default('pending')
                ->after('foto');
        });
    }

    public function down()
    {
        Schema::table('daily_activities', function (Blueprint $table) {
            $table->dropColumn('status_verifikasi');
        });
    }
};
