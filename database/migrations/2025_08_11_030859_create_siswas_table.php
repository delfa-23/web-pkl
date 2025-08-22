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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('login_id'); // foreign key ke logins.id
            $table->string('nama');
            $table->string('nis')->nullable();
            $table->string('nisn')->nullable();
            $table->string('telepon');
            $table->string('kelas');
            $table->string('jurusan');
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->integer('kehadiran')->default(0);
            $table->timestamps();

            $table->foreign('login_id')->references('id')->on('logins')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
