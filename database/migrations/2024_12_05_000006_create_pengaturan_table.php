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
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('kunci')->unique(); // Contoh: 'banner_depan', 'logo_desa', 'nama_desa'
            $table->text('nilai')->nullable(); // Untuk banner_depan: storage/app/public/pengaturan/banner.jpg
            $table->string('tipe')->default('text'); // text, image, textarea
            $table->string('grup')->default('umum'); // umum, kontak, sosial_media
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};
