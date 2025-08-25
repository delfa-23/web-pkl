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
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->string('nama_perusahaan');   // nama tempat PKL
            $table->string('alamat_perusahaan'); // alamat tempat PKL
            $table->string('telepon_perusahaan')->nullable();
            $table->string('pembimbing_perusahaan')->nullable(); // opsional
            $table->enum('status', ['Menunggu Verifikasi', 'Diterima', 'Ditolak'])->default('Menunggu Verifikasi');
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
