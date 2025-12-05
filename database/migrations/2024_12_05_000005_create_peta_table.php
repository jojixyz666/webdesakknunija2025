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
        Schema::create('peta', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi');
            $table->text('deskripsi')->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->enum('kategori', ['fasilitas_umum', 'wisata', 'pemerintahan', 'lainnya'])->default('lainnya');
            $table->string('icon')->nullable();
            $table->string('gambar')->nullable(); // Path: storage/app/public/peta/nama-file.jpg
            $table->boolean('tampilkan')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peta');
    }
};
