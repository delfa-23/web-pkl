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
        Schema::create('tempat_pkls', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');   // nama tempat PKL
            $table->string('alamat_perusahaan'); // alamat tempat PKL
            $table->string('telepon_perusahaan')->nullable();
            $table->string('pembimbing_perusahaan')->nullable(); // opsional
            $table->enum('status', ['belum_terverifikasi', 'proses', 'diterima', 'ditolak'])
                ->default('belum_terverifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_pkls');
    }
};
