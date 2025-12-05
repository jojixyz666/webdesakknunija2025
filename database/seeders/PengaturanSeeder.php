<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaturan;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengaturan = [
            // Informasi Umum
            ['kunci' => 'nama_desa', 'nilai' => 'Desa Maju Jaya', 'tipe' => 'text', 'grup' => 'umum'],
            ['kunci' => 'kecamatan', 'nilai' => 'Kecamatan Maju', 'tipe' => 'text', 'grup' => 'umum'],
            ['kunci' => 'kabupaten', 'nilai' => 'Kabupaten Sejahtera', 'tipe' => 'text', 'grup' => 'umum'],
            ['kunci' => 'provinsi', 'nilai' => 'Provinsi Makmur', 'tipe' => 'text', 'grup' => 'umum'],
            ['kunci' => 'kode_pos', 'nilai' => '12345', 'tipe' => 'text', 'grup' => 'umum'],
            ['kunci' => 'tagline', 'nilai' => 'Portal informasi dan layanan masyarakat yang modern, transparan, dan mudah diakses.', 'tipe' => 'textarea', 'grup' => 'umum'],
            ['kunci' => 'deskripsi_desa', 'nilai' => 'Desa Maju Jaya adalah desa yang terus berkembang dengan masyarakat yang gotong royong dan berwawasan maju.', 'tipe' => 'textarea', 'grup' => 'umum'],
            ['kunci' => 'deskripsi_singkat', 'nilai' => 'Website resmi desa untuk informasi dan layanan masyarakat.', 'tipe' => 'text', 'grup' => 'umum'],
            
            // Gambar (path akan diisi setelah upload melalui CMS)
            ['kunci' => 'logo_desa', 'nilai' => '', 'tipe' => 'image', 'grup' => 'umum'],
            ['kunci' => 'banner_depan', 'nilai' => '', 'tipe' => 'image', 'grup' => 'umum'],
            
            // Kontak
            ['kunci' => 'alamat', 'nilai' => 'Jl. Raya Desa No. 123, Desa Maju Jaya', 'tipe' => 'textarea', 'grup' => 'kontak'],
            ['kunci' => 'telepon', 'nilai' => '(021) 12345678', 'tipe' => 'text', 'grup' => 'kontak'],
            ['kunci' => 'email', 'nilai' => 'info@desamajujaya.id', 'tipe' => 'text', 'grup' => 'kontak'],
            
            // Statistik Desa
            ['kunci' => 'jumlah_penduduk', 'nilai' => '5432', 'tipe' => 'text', 'grup' => 'statistik'],
            ['kunci' => 'jumlah_kk', 'nilai' => '1234', 'tipe' => 'text', 'grup' => 'statistik'],
            ['kunci' => 'jumlah_rt', 'nilai' => '12', 'tipe' => 'text', 'grup' => 'statistik'],
            ['kunci' => 'jumlah_rw', 'nilai' => '3', 'tipe' => 'text', 'grup' => 'statistik'],
            
            // Media Sosial
            ['kunci' => 'facebook', 'nilai' => '', 'tipe' => 'text', 'grup' => 'sosial_media'],
            ['kunci' => 'instagram', 'nilai' => '', 'tipe' => 'text', 'grup' => 'sosial_media'],
            ['kunci' => 'twitter', 'nilai' => '', 'tipe' => 'text', 'grup' => 'sosial_media'],
            ['kunci' => 'youtube', 'nilai' => '', 'tipe' => 'text', 'grup' => 'sosial_media'],
        ];

        foreach ($pengaturan as $item) {
            Pengaturan::updateOrCreate(
                ['kunci' => $item['kunci']],
                $item
            );
        }
    }
}
