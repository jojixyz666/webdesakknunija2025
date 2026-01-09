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
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->string('nomor_kk', 16);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])->default('Belum Kawin');
            $table->enum('status_dalam_keluarga', ['Kepala Keluarga', 'Istri', 'Anak', 'Menantu', 'Cucu', 'Orang Tua', 'Mertua', 'Famili Lain', 'Pembantu', 'Lainnya'])->default('Anak');
            $table->string('dusun');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->text('alamat');
            $table->boolean('wajib_pilih')->default(false);
            $table->string('kewarganegaraan')->default('WNI');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
