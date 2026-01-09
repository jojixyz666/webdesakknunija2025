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
        Schema::create('data_apbdes', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->string('kategori'); // Pendapatan, Belanja
            $table->string('jenis'); // Jenis pendapatan/belanja
            $table->decimal('jumlah', 15, 2);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_apbdes');
    }
};
