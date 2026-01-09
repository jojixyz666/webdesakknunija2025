<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warga;
use Carbon\Carbon;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $dusunList = ['Dusun Krajan', 'Dusun Kebun', 'Dusun Sumber', 'Dusun Rejo'];
        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'];
        $pendidikanList = [
            'Tidak/Belum Sekolah',
            'Belum Tamat SD/Sederajat',
            'Tamat SD/Sederajat',
            'SLTP/Sederajat',
            'SLTA/Sederajat',
            'Diploma I/II',
            'Akademi/Diploma III/S.Muda',
            'Diploma IV/Strata I',
            'Strata II',
            'Strata III'
        ];
        $pekerjaanList = [
            'Belum/Tidak Bekerja',
            'Pelajar/Mahasiswa',
            'Ibu Rumah Tangga',
            'Petani',
            'Pedagang',
            'Wiraswasta',
            'PNS',
            'TNI/Polri',
            'Guru',
            'Karyawan Swasta',
            'Buruh Tani',
            'Buruh Harian Lepas'
        ];
        $statusPerkawinan = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
        
        // Data nama untuk variasi
        $namaLakiLaki = [
            'Ahmad Fauzi', 'Budi Santoso', 'Agus Wijaya', 'Dedi Kurniawan', 'Eko Prasetyo',
            'Hendra Gunawan', 'Joko Susilo', 'Rudi Hartono', 'Bambang Setiawan', 'Suparman',
            'Muhammad Rizki', 'Andi Saputra', 'Yudi Nugroho', 'Hendro Wibowo', 'Teguh Purnomo',
            'Wahyu Hidayat', 'Arief Rahman', 'Doni Setyawan', 'Firman Hakim', 'Imam Santoso'
        ];
        
        $namaPerempuan = [
            'Siti Aisyah', 'Sri Wahyuni', 'Dewi Lestari', 'Ani Suryani', 'Rina Marlina',
            'Indah Permata', 'Lilis Suryati', 'Wati Rahayu', 'Yanti Kusuma', 'Endang Susilawati',
            'Fitri Handayani', 'Nur Azizah', 'Rini Puspitasari', 'Dwi Astuti', 'Tri Wahyuningsih',
            'Nina Safitri', 'Maya Sari', 'Lia Amelia', 'Ratna Dewi', 'Putri Ayu'
        ];
        
        $tempatLahir = [
            'Surabaya', 'Malang', 'Jakarta', 'Bandung', 'Semarang',
            'Yogyakarta', 'Solo', 'Kediri', 'Blitar', 'Jember'
        ];

        // Generate 100 data warga
        $wargaData = [];
        $usedNIK = [];
        $usedKK = [];
        
        for ($i = 1; $i <= 100; $i++) {
            // Generate unique NIK
            do {
                $nik = '35' . str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT) . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT) . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            } while (in_array($nik, $usedNIK));
            $usedNIK[] = $nik;
            
            // Generate KK (multiple people can have same KK)
            if ($i % 4 == 1 || empty($usedKK)) {
                do {
                    $nomorKK = '35' . str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT) . str_pad(rand(1, 999999999999), 12, '0', STR_PAD_LEFT);
                } while (in_array($nomorKK, $usedKK));
                $usedKK[] = $nomorKK;
                $currentKK = $nomorKK;
                $isKepalaKeluarga = true;
            } else {
                $currentKK = $usedKK[array_rand($usedKK)];
                $isKepalaKeluarga = false;
            }
            
            $jenisKelamin = $i % 2 == 0 ? 'L' : 'P';
            $nama = $jenisKelamin == 'L' ? $namaLakiLaki[array_rand($namaLakiLaki)] : $namaPerempuan[array_rand($namaPerempuan)];
            
            // Random age between 0-80 years
            $umur = rand(0, 80);
            $tanggalLahir = Carbon::now()->subYears($umur)->subDays(rand(1, 365));
            
            // Status dalam keluarga based on age and kepala keluarga
            if ($isKepalaKeluarga) {
                $statusDalamKeluarga = 'Kepala Keluarga';
            } else {
                if ($umur < 18) {
                    $statusDalamKeluarga = rand(0, 1) ? 'Anak' : 'Cucu';
                } elseif ($jenisKelamin == 'P' && rand(0, 1)) {
                    $statusDalamKeluarga = 'Istri';
                } else {
                    $statusOptions = ['Anak', 'Menantu', 'Orang Tua', 'Famili Lain'];
                    $statusDalamKeluarga = $statusOptions[array_rand($statusOptions)];
                }
            }
            
            // Pendidikan based on age
            if ($umur < 6) {
                $pendidikan = 'Tidak/Belum Sekolah';
            } elseif ($umur < 12) {
                $pendidikan = rand(0, 1) ? 'Tidak/Belum Sekolah' : 'Belum Tamat SD/Sederajat';
            } elseif ($umur < 15) {
                $pendidikan = rand(0, 1) ? 'Belum Tamat SD/Sederajat' : 'Tamat SD/Sederajat';
            } elseif ($umur < 18) {
                $pendidikan = rand(0, 1) ? 'Tamat SD/Sederajat' : 'SLTP/Sederajat';
            } else {
                $pendidikan = $pendidikanList[array_rand($pendidikanList)];
            }
            
            // Pekerjaan based on age
            if ($umur < 6) {
                $pekerjaan = 'Belum/Tidak Bekerja';
            } elseif ($umur < 18) {
                $pekerjaan = 'Pelajar/Mahasiswa';
            } elseif ($jenisKelamin == 'P' && rand(0, 2) > 0) {
                $pekerjaan = 'Ibu Rumah Tangga';
            } else {
                $pekerjaan = $pekerjaanList[array_rand($pekerjaanList)];
            }
            
            // Status perkawinan based on age
            if ($umur < 17) {
                $statusKawin = 'Belum Kawin';
            } else {
                $statusKawin = $statusPerkawinan[array_rand($statusPerkawinan)];
            }
            
            // Wajib pilih (17 tahun ke atas)
            $wajibPilih = $umur >= 17;
            
            $dusun = $dusunList[array_rand($dusunList)];
            
            $wargaData[] = [
                'nik' => $nik,
                'nama' => $nama . ' ' . $i,
                'nomor_kk' => $currentKK,
                'jenis_kelamin' => $jenisKelamin,
                'tempat_lahir' => $tempatLahir[array_rand($tempatLahir)],
                'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),
                'agama' => $agamaList[array_rand($agamaList)],
                'pendidikan' => $pendidikan,
                'pekerjaan' => $pekerjaan,
                'status_perkawinan' => $statusKawin,
                'status_dalam_keluarga' => $statusDalamKeluarga,
                'dusun' => $dusun,
                'rt' => str_pad(rand(1, 10), 3, '0', STR_PAD_LEFT),
                'rw' => str_pad(rand(1, 5), 3, '0', STR_PAD_LEFT),
                'alamat' => 'Jl. Raya ' . $dusun . ' No. ' . rand(1, 100),
                'wajib_pilih' => $wajibPilih,
                'kewarganegaraan' => 'WNI',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Insert in chunks for better performance
        foreach (array_chunk($wargaData, 50) as $chunk) {
            Warga::insert($chunk);
        }
        
        $this->command->info('Berhasil menambahkan 100 data warga!');
    }
}
