<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataApbdes;

class DataApbdesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahunSekarang = date('Y');
        $tahunList = [$tahunSekarang - 2, $tahunSekarang - 1, $tahunSekarang]; // 3 tahun: 2024, 2025, 2026
        
        foreach ($tahunList as $index => $tahun) {
            // Faktor pertumbuhan untuk setiap tahun (tahun lalu lebih kecil)
            $faktor = 1 + ($index * 0.08); // Pertumbuhan 8% per tahun
            
            $data = [
                // Pendapatan
                [
                    'tahun' => $tahun,
                    'kategori' => 'Pendapatan',
                    'jenis' => 'Pendapatan Asli Desa',
                    'jumlah' => 125000000 * $faktor,
                    'urutan' => 1,
                ],
                [
                    'tahun' => $tahun,
                    'kategori' => 'Pendapatan',
                    'jenis' => 'Dana Desa',
                    'jumlah' => 800000000 * $faktor,
                    'urutan' => 2,
                ],
                [
                    'tahun' => $tahun,
                    'kategori' => 'Pendapatan',
                    'jenis' => 'Alokasi Dana Desa',
                    'jumlah' => 500000000 * $faktor,
                    'urutan' => 3,
                ],
                [
                    'tahun' => $tahun,
                    'kategori' => 'Pendapatan',
                    'jenis' => 'Bagi Hasil Pajak dan Retribusi',
                    'jumlah' => 150000000 * $faktor,
                    'urutan' => 4,
                ],
                [
                    'tahun' => $tahun,
                    'kategori' => 'Pendapatan',
                    'jenis' => 'Bantuan Keuangan Provinsi',
                    'jumlah' => 200000000 * $faktor,
                    'urutan' => 5,
                ],
                
                // Belanja
                [
                    'tahun' => $tahun,
                    'kategori' => 'Belanja',
                    'jenis' => 'Belanja Pegawai',
                    'jumlah' => 450000000 * $faktor,
                    'urutan' => 1,
                ],
                [
                    'tahun' => $tahun,
                    'kategori' => 'Belanja',
                    'jenis' => 'Belanja Barang dan Jasa',
                    'jumlah' => 300000000 * $faktor,
                    'urutan' => 2,
                ],
                [
                    'tahun' => $tahun,
                    'kategori' => 'Belanja',
                    'jenis' => 'Belanja Modal',
                    'jumlah' => 600000000 * $faktor,
                    'urutan' => 3,
                ],
                [
                    'tahun' => $tahun,
                    'kategori' => 'Belanja',
                    'jenis' => 'Belanja Tak Terduga',
                    'jumlah' => 50000000 * $faktor,
                    'urutan' => 4,
                ],
                
                // Pembiayaan Penerimaan
                [
                    'tahun' => $tahun,
                    'kategori' => 'Pembiayaan Penerimaan',
                    'jenis' => 'Sisa Lebih Perhitungan Anggaran Tahun Sebelumnya',
                    'jumlah' => 150000000 * $faktor,
                    'urutan' => 1,
                ],
                [
                    'tahun' => $tahun,
                    'kategori' => 'Pembiayaan Penerimaan',
                    'jenis' => 'Pencairan Dana Cadangan',
                    'jumlah' => 0,
                    'urutan' => 2,
                ],
                
                // Pembiayaan Pengeluaran
                [
                    'tahun' => $tahun,
                    'kategori' => 'Pembiayaan Pengeluaran',
                    'jenis' => 'Pembentukan Dana Cadangan',
                    'jumlah' => 100000000 * $faktor,
                    'urutan' => 1,
                ],
                [
                    'tahun' => $tahun,
                    'kategori' => 'Pembiayaan Pengeluaran',
                    'jenis' => 'Penyertaan Modal Desa',
                    'jumlah' => 50000000 * $faktor,
                    'urutan' => 2,
                ],
            ];

            foreach ($data as $item) {
                DataApbdes::create($item);
            }
        }
    }
}
