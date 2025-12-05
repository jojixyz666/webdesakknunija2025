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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon')->nullable();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('gambar')->nullable(); // Path: storage/app/public/pengaduan/nama-file.jpg
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->text('tanggapan')->nullable();
            $table->timestamp('tanggal_tanggapan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
