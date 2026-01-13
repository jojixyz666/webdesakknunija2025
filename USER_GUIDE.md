# 📘 Panduan Pengguna Website Desa Ambunten Tengah

**Program KKN Universitas Wiraraja Sumenep 2025**

---

## 📖 Daftar Isi

### BAGIAN I: PENGENALAN
1. [Tentang Website](#1-tentang-website)
2. [Fitur Utama](#2-fitur-utama)
3. [Persyaratan Sistem](#3-persyaratan-sistem)
4. [Instalasi & Konfigurasi](#4-instalasi--konfigurasi)

### BAGIAN II: PANDUAN PENGUNJUNG
5. [Halaman Beranda](#5-halaman-beranda)
6. [Membaca Berita](#6-membaca-berita)
7. [Mengajukan Pengaduan](#7-mengajukan-pengaduan)
8. [Melihat Peta Desa](#8-melihat-peta-desa)
9. [Profil Desa](#9-profil-desa)
10. [Data Grafis APBDes](#10-data-grafis-apbdes)
11. [Transparansi APBD](#11-transparansi-apbd)

### BAGIAN III: PANDUAN ADMIN
12. [Login Admin](#12-login-admin)
13. [Dashboard Admin](#13-dashboard-admin)
14. [Kelola Berita](#14-kelola-berita)
15. [Kelola Pengaduan](#15-kelola-pengaduan)
16. [Kelola Peta](#16-kelola-peta)
17. [Kelola APBD](#17-kelola-apbd)
18. [Kelola Data APBDes](#18-kelola-data-apbdes)
19. [Kelola Data Warga](#19-kelola-data-warga)
20. [Kelola Profile Desa](#20-kelola-profile-desa)
21. [Pengaturan Website](#21-pengaturan-website)
22. [Ubah Password](#22-ubah-password)

### BAGIAN IV: TROUBLESHOOTING & FAQ
23. [FAQ](#23-faq)
24. [Troubleshooting](#24-troubleshooting)

---

# BAGIAN I: PENGENALAN

## 1. Tentang Website

Website Desa Ambunten Tengah adalah platform digital yang dikembangkan untuk:
- ✅ Meningkatkan transparansi pemerintahan desa
- ✅ Mempermudah akses informasi bagi masyarakat
- ✅ Menyediakan saluran pengaduan online
- ✅ Menampilkan data dan statistik desa secara real-time
- ✅ Memfasilitasi komunikasi antara pemerintah desa dengan masyarakat

**Dikembangkan oleh**: KKN Universitas Wiraraja Sumenep 2025  
**Teknologi**: Laravel 12.x, Tailwind CSS 4.0, Alpine.js, Leaflet.js

---

## 2. Fitur Utama

### 🌐 Portal Publik
- **Beranda**: Tampilan utama dengan statistik dan berita terbaru
- **Berita**: Publikasi berita dan pengumuman desa
- **Pengaduan**: Formulir pengaduan online dengan sistem tracking
- **Peta Interaktif**: Visualisasi lokasi penting di desa
- **Profil Desa**: Informasi lengkap tentang desa
- **Data Grafis**: Visualisasi data APBDes dalam bentuk grafik
- **Transparansi APBD**: Download dokumen APBD

### ⚙️ Panel Admin
- **Dashboard**: Statistik dan overview data
- **Manajemen Berita**: CRUD berita dan pengumuman
- **Manajemen Pengaduan**: Update status dan hapus pengaduan
- **Manajemen Peta**: Tambah/edit lokasi di peta
- **Manajemen APBD**: Upload dan kelola dokumen APBD
- **Manajemen Data APBDes**: Input data keuangan untuk grafik
- **Manajemen Warga**: CRUD data warga
- **Profil Desa**: Edit informasi desa
- **Pengaturan**: Konfigurasi website
- **Ganti Password**: Keamanan akun admin

---

## 3. Persyaratan Sistem

### Untuk Development
```
✓ PHP >= 8.4
✓ Composer (package manager PHP)
✓ Node.js >= 18.x & NPM
✓ MySQL >= 8.0
✓ Git
```

### Untuk Produksi
```
✓ Web Server (Apache/Nginx)
✓ PHP >= 8.4
✓ MySQL >= 8.0
✓ SSL Certificate (direkomendasikan)
```

### Browser yang Didukung
- Chrome/Edge (versi terbaru)
- Firefox (versi terbaru)
- Safari (versi terbaru)
- Mobile browsers (iOS Safari, Chrome Mobile)

---

## 4. Instalasi & Konfigurasi

### Langkah 1: Clone Repository
```bash
git clone https://github.com/jojixyz666/webdesakknunija2025.git
cd webdesakknunija2025
```

### Langkah 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### Langkah 3: Setup Environment
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Langkah 4: Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desa_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

Buat database:
```sql
CREATE DATABASE desa_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Langkah 5: Migrasi & Seeding Database
```bash
# Jalankan migrasi dan seeder
php artisan migrate:fresh --seed

# Link storage untuk upload file
php artisan storage:link
```

### Langkah 6: Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### Langkah 7: Jalankan Aplikasi
```bash
# Development server
php artisan serve

# Akses di browser: http://localhost:8000
```

### Login Admin Default
```
Email: admin@desa.id
Password: password123
```

⚠️ **PENTING**: Ganti password default setelah login pertama!

---

# BAGIAN II: PANDUAN PENGUNJUNG

## 5. Halaman Beranda

### 5.1 Akses Beranda
- Kunjungi: `http://localhost:8000` atau domain website
- Halaman beranda akan otomatis terbuka

### 5.2 Konten Beranda
#### Hero Section
- Banner utama dengan informasi desa
- Statistik desa (jumlah penduduk, RT/RW, dll)

#### Berita Terbaru
- Menampilkan 6 berita terbaru
- Klik judul berita untuk membaca selengkapnya
- Tombol "Lihat Semua Berita" untuk halaman berita lengkap

#### Fitur Cepat
- **Pengaduan**: Akses cepat ke formulir pengaduan
- **Peta**: Link ke peta interaktif desa
- **Transparansi**: Akses dokumen APBD

### 5.3 Navigasi
Menu utama berisi:
- Beranda
- Berita
- Pengaduan
- Peta
- Profil Desa
- Data Grafis
- Transparansi

---

## 6. Membaca Berita

### 6.1 Halaman Daftar Berita
**URL**: `/berita`

#### Fitur:
- Daftar semua berita yang dipublikasikan
- Gambar thumbnail berita
- Judul, tanggal, dan excerpt
- Pagination untuk navigasi halaman

### 6.2 Halaman Detail Berita
**URL**: `/berita/{slug-berita}`

#### Konten:
- Judul berita lengkap
- Tanggal publikasi
- Gambar utama (jika ada)
- Konten berita lengkap
- Tombol "Kembali ke Daftar Berita"

### 6.3 Tips Membaca Berita
- Klik judul atau gambar untuk membaca detail
- Berita ditampilkan dari yang terbaru
- Gunakan pagination di bagian bawah untuk halaman lain

---

## 7. Mengajukan Pengaduan

### 7.1 Akses Formulir Pengaduan
**URL**: `/pengaduan`

### 7.2 Cara Mengisi Formulir

#### Field yang Harus Diisi:
1. **Nama Lengkap** (wajib)
   - Masukkan nama sesuai identitas
   
2. **Email** (wajib)
   - Gunakan email aktif untuk notifikasi
   
3. **No. Telepon** (opsional)
   - Format: 08xxxxxxxxxx atau +628xxxxxxxxxx
   
4. **Kategori** (wajib)
   - Pilih kategori sesuai pengaduan:
     - Infrastruktur
     - Pelayanan
     - Lingkungan
     - Lainnya
   
5. **Judul Pengaduan** (wajib)
   - Ringkasan singkat pengaduan (max 255 karakter)
   
6. **Isi Pengaduan** (wajib)
   - Jelaskan detail pengaduan Anda
   
7. **Lampiran** (opsional)
   - Upload foto/dokumen pendukung
   - Format: JPG, PNG, PDF
   - Ukuran max: 2MB

### 7.3 Submit Pengaduan
1. Klik tombol "Kirim Pengaduan"
2. Akan muncul notifikasi sukses dengan **Nomor Tiket**
3. **SIMPAN NOMOR TIKET** untuk tracking

### 7.4 Tracking Status Pengaduan
**URL**: `/pengaduan/lacak`

#### Cara Tracking:
1. Masukkan **Nomor Tiket** yang didapat saat submit
2. Klik "Lacak Pengaduan"
3. Lihat status terkini:
   - 🟡 **Pending** - Menunggu review
   - 🔵 **Diproses** - Sedang ditangani
   - 🟢 **Selesai** - Pengaduan selesai
   - 🔴 **Ditolak** - Pengaduan tidak dapat diproses

---

## 8. Melihat Peta Desa

### 8.1 Akses Peta
**URL**: `/peta`

### 8.2 Fitur Peta Interaktif

#### Navigasi Peta:
- **Zoom In/Out**: Gunakan tombol +/- atau scroll mouse
- **Pan**: Klik dan drag untuk menggeser peta
- **Double Click**: Zoom in cepat

#### Marker Lokasi:
- 📍 **Merah**: Kantor/Pemerintahan
- 📍 **Biru**: Pendidikan
- 📍 **Hijau**: Kesehatan
- 📍 **Kuning**: Tempat Ibadah
- 📍 **Abu-abu**: Lainnya

#### Klik Marker:
- Popup akan muncul menampilkan:
  - Nama lokasi
  - Kategori
  - Deskripsi (jika ada)

### 8.3 Tips Menggunakan Peta:
- Gunakan pada layar yang lebih besar untuk pengalaman terbaik
- Marker mengelompok otomatis jika terlalu banyak (clustering)
- Responsif untuk mobile device

---

## 9. Profil Desa

### 9.1 Akses Profil
**URL**: `/profile`

### 9.2 Informasi yang Ditampilkan

#### Profil Umum:
- Nama Desa
- Alamat Lengkap
- Kode Pos
- Email Desa
- Nomor Telepon
- Website (jika ada)

#### Visi & Misi:
- Visi pembangunan desa
- Misi-misi strategis

#### Sejarah:
- Sejarah singkat desa
- Latar belakang pembentukan

#### Demografi:
- Jumlah penduduk
- Jumlah KK (Kepala Keluarga)
- Jumlah RT
- Jumlah RW
- Luas wilayah

#### Struktur Organisasi:
- Kepala Desa
- Sekretaris Desa
- Perangkat Desa
- BPD (Badan Permusyawaratan Desa)

---

## 10. Data Grafis APBDes

### 10.1 Akses Data Grafis
**URL**: `/data-grafis`

### 10.2 Visualisasi Data

#### Filter Tahun:
- Pilih tahun APBDes yang ingin dilihat
- Data akan otomatis refresh

#### Grafik yang Ditampilkan:

**1. Grafik Pie - Komposisi APBDes**
- Pendapatan
- Belanja
- Pembiayaan Penerimaan
- Pembiayaan Pengeluaran

**2. Grafik Bar - Detail per Kategori**
- Detail pendapatan berdasarkan sumber
- Detail belanja berdasarkan jenis
- Perbandingan antar kategori

#### Informasi Ringkasan:
- Total Pendapatan
- Total Belanja
- Total Pembiayaan Penerimaan
- Total Pembiayaan Pengeluaran
- Surplus/Defisit

### 10.3 Membaca Grafik:
- Hover pada grafik untuk melihat detail nilai
- Warna berbeda untuk setiap kategori
- Angka dalam format Rupiah

---

## 11. Transparansi APBD

### 11.1 Akses Halaman Transparansi
**URL**: `/transparansi`

### 11.2 Fitur Download Dokumen

#### Daftar Dokumen:
- Dokumen APBD per tahun
- Judul dokumen
- Tahun anggaran
- Ukuran file
- Tanggal upload

#### Cara Download:
1. Temukan dokumen yang diinginkan
2. Klik tombol "Download"
3. File akan terunduh dalam format asli (PDF/Excel)

### 11.3 Kategori Dokumen:
- **APBD**: Anggaran Pendapatan dan Belanja Desa
- **Laporan Keuangan**: Laporan realisasi
- **RAB**: Rencana Anggaran Biaya
- **Lainnya**: Dokumen pendukung

---

# BAGIAN III: PANDUAN ADMIN

## 12. Login Admin

### 12.1 Akses Halaman Login
**URL**: `/admin/login`

### 12.2 Cara Login
1. Masukkan **Email** admin
2. Masukkan **Password**
3. Klik "Login"

#### Kredensial Default:
```
Email: admin@desa.id
Password: password123
```

### 12.3 Setelah Login
- Otomatis redirect ke Dashboard Admin
- Session login aktif selama 120 menit
- Dapat logout kapan saja

### 12.4 Logout
1. Klik menu "Logout" di navbar admin
2. Atau akses: `/logout` (POST request)
3. Session akan dihapus dan kembali ke halaman login

---

## 13. Dashboard Admin

### 13.1 Akses Dashboard
**URL**: `/admin/dashboard`

### 13.2 Widget Statistik

#### Statistik Utama:
1. **Total Berita**
   - Jumlah semua berita (published + draft)
   - Icon: 📰

2. **Total Pengaduan**
   - Jumlah pengaduan yang masuk
   - Icon: 📝

3. **Total Lokasi Peta**
   - Jumlah marker di peta
   - Icon: 📍

4. **Total APBD**
   - Jumlah dokumen APBD yang diupload
   - Icon: 💰

5. **Total Data APBDes**
   - Jumlah entry data untuk grafik
   - Icon: 📊

6. **Total Warga**
   - Jumlah data warga terdaftar
   - Icon: 👥

### 13.3 Menu Navigasi Admin
Sidebar berisi menu:
- Dashboard
- Berita
- Pengaduan
- Peta
- APBD
- Data APBDes
- Data Warga
- Profile Desa
- Pengaturan
- Ubah Password
- Logout

---

## 14. Kelola Berita

### 14.1 Daftar Berita
**URL**: `/admin/berita`

#### Fitur:
- Tabel daftar semua berita
- Kolom: Gambar, Judul, Tanggal Publikasi, Status, Aksi
- Pagination
- Tombol "Tambah Berita"

### 14.2 Tambah Berita Baru
**URL**: `/admin/berita/create`

#### Form Input:
1. **Judul** (wajib)
   - Judul berita (max 255 karakter)
   
2. **Slug** (otomatis)
   - Generate otomatis dari judul
   - Bisa diedit manual
   
3. **Gambar** (opsional)
   - Upload gambar utama
   - Format: JPG, PNG, WEBP
   - Ukuran max: 2MB
   - Rekomendasi: 1200x630px
   
4. **Konten** (wajib)
   - Editor WYSIWYG untuk menulis berita
   - Mendukung format rich text
   
5. **Tanggal Publikasi** (wajib)
   - Pilih tanggal dan waktu publikasi
   - Default: tanggal hari ini
   
6. **Tampilkan** (checkbox)
   - Centang untuk publish langsung
   - Tidak dicentang = draft

#### Langkah:
1. Isi semua field
2. Upload gambar (opsional)
3. Tulis konten berita
4. Tentukan tanggal publikasi
5. Centang "Tampilkan" jika ingin publish
6. Klik "Simpan Berita"

### 14.3 Edit Berita
**URL**: `/admin/berita/{id}/edit`

#### Cara:
1. Di daftar berita, klik tombol "Edit" (icon pensil)
2. Form edit akan muncul dengan data sebelumnya
3. Ubah field yang diperlukan
4. Klik "Update Berita"

#### Tips Edit:
- Gambar lama akan ditampilkan jika ada
- Upload gambar baru akan replace gambar lama
- Kosongkan field gambar untuk tetap pakai gambar lama

### 14.4 Hapus Berita
1. Di daftar berita, klik tombol "Hapus" (icon trash)
2. Konfirmasi penghapusan
3. Berita dan gambar terkait akan dihapus permanen

⚠️ **Peringatan**: Penghapusan tidak bisa di-undo!

---

## 15. Kelola Pengaduan

### 15.1 Daftar Pengaduan
**URL**: `/admin/pengaduan`

#### Fitur:
- Tabel semua pengaduan
- Filter berdasarkan status
- Kolom: Nomor Tiket, Nama, Kategori, Status, Tanggal, Aksi
- Badge warna sesuai status:
  - 🟡 Pending (kuning)
  - 🔵 Diproses (biru)
  - 🟢 Selesai (hijau)
  - 🔴 Ditolak (merah)

### 15.2 Lihat Detail Pengaduan
**URL**: `/admin/pengaduan/{id}`

#### Informasi Ditampilkan:
- Nomor Tiket
- Nama Pelapor
- Email
- No. Telepon
- Kategori
- Judul
- Isi Pengaduan
- Lampiran (jika ada)
- Status Terkini
- Tanggal Dibuat

### 15.3 Update Status Pengaduan
**URL**: `/admin/pengaduan/{id}/status` (PUT)

#### Cara:
1. Buka detail pengaduan
2. Pilih status baru dari dropdown:
   - Pending
   - Diproses
   - Selesai
   - Ditolak
3. Klik "Update Status"
4. Status akan berubah dan notifikasi muncul

#### Best Practice:
- **Pending** → **Diproses**: Saat mulai menangani
- **Diproses** → **Selesai**: Setelah masalah terselesaikan
- **Pending/Diproses** → **Ditolak**: Jika tidak memenuhi syarat

### 15.4 Hapus Pengaduan
1. Di detail atau daftar, klik tombol "Hapus"
2. Konfirmasi penghapusan
3. Data pengaduan dan lampiran akan dihapus

⚠️ Hanya hapus pengaduan yang spam/tidak valid!

---

## 16. Kelola Peta

### 16.1 Daftar Lokasi Peta
**URL**: `/admin/peta`

#### Fitur:
- Tabel semua marker peta
- Kolom: Nama, Kategori, Koordinat, Aksi
- Tombol "Tambah Lokasi"

### 16.2 Tambah Lokasi Baru
**URL**: `/admin/peta/create`

#### Form Input:
1. **Nama Lokasi** (wajib)
   - Nama tempat/fasilitas
   - Contoh: "Kantor Desa Ambunten Tengah"
   
2. **Kategori** (wajib)
   - Pilih dari dropdown:
     - Kantor/Pemerintahan
     - Pendidikan
     - Kesehatan
     - Tempat Ibadah
     - Ekonomi
     - Lainnya
   
3. **Latitude** (wajib)
   - Koordinat lintang
   - Format: -7.123456 (decimal)
   - Range: -90 sampai 90
   
4. **Longitude** (wajib)
   - Koordinat bujur
   - Format: 112.123456 (decimal)
   - Range: -180 sampai 180
   
5. **Deskripsi** (opsional)
   - Informasi tambahan lokasi
   - Ditampilkan saat marker diklik

#### Cara Mendapatkan Koordinat:
1. Buka Google Maps
2. Klik kanan pada lokasi yang diinginkan
3. Pilih "What's here?"
4. Koordinat akan muncul di bagian bawah
5. Copy latitude dan longitude

#### Langkah:
1. Isi nama lokasi
2. Pilih kategori
3. Masukkan latitude & longitude
4. Tambahkan deskripsi (opsional)
5. Klik "Simpan Lokasi"

### 16.3 Edit Lokasi
**URL**: `/admin/peta/{id}/edit`

1. Di daftar peta, klik "Edit"
2. Ubah field yang diperlukan
3. Klik "Update Lokasi"

### 16.4 Hapus Lokasi
1. Klik tombol "Hapus"
2. Konfirmasi
3. Marker akan dihapus dari peta

---

## 17. Kelola APBD

### 17.1 Daftar Dokumen APBD
**URL**: `/admin/apbd`

#### Fitur:
- Tabel dokumen APBD
- Kolom: Judul, Tahun, Kategori, File, Tanggal Upload, Aksi
- Tombol "Upload Dokumen"

### 17.2 Upload Dokumen APBD
**URL**: `/admin/apbd/create`

#### Form Input:
1. **Judul Dokumen** (wajib)
   - Contoh: "APBD Tahun 2025"
   
2. **Tahun** (wajib)
   - Tahun anggaran
   - Format: YYYY
   - Contoh: 2025
   
3. **Kategori** (wajib)
   - Pilih dari dropdown:
     - APBD
     - Laporan Keuangan
     - RAB
     - Lainnya
   
4. **File** (wajib)
   - Upload dokumen
   - Format: PDF, XLS, XLSX, DOC, DOCX
   - Ukuran max: 5MB
   
5. **Deskripsi** (opsional)
   - Keterangan tambahan

#### Langkah:
1. Isi judul dokumen
2. Masukkan tahun
3. Pilih kategori
4. Upload file
5. Tambah deskripsi (opsional)
6. Klik "Upload Dokumen"

### 17.3 Edit Dokumen APBD
**URL**: `/admin/apbd/{id}/edit`

1. Klik "Edit" di daftar
2. Ubah informasi (judul, tahun, kategori, deskripsi)
3. Upload file baru untuk replace (opsional)
4. Klik "Update Dokumen"

### 17.4 Hapus Dokumen APBD
1. Klik "Hapus"
2. Konfirmasi
3. Dokumen dan file akan dihapus

---

## 18. Kelola Data APBDes

### 18.1 Daftar Data APBDes
**URL**: `/admin/data-grafis/apbdes`

#### Fitur:
- Tabel data APBDes
- Kolom: Tahun, Kategori, Item, Jumlah, Urutan
- Filter per tahun
- Tombol "Tambah Data"

### 18.2 Tambah Data APBDes
**URL**: `/admin/data-grafis/apbdes/create`

#### Form Input:
1. **Tahun** (wajib)
   - Tahun anggaran
   - Format: YYYY
   
2. **Kategori** (wajib)
   - Pilih dari dropdown:
     - Pendapatan
     - Belanja
     - Pembiayaan Penerimaan
     - Pembiayaan Pengeluaran
   
3. **Item** (wajib)
   - Nama item/pos
   - Contoh: "Dana Desa", "Belanja Pegawai"
   
4. **Jumlah** (wajib)
   - Nilai dalam Rupiah
   - Format: angka saja (tanpa titik/koma)
   - Contoh: 50000000 (untuk Rp 50 juta)
   
5. **Urutan** (wajib)
   - Nomor urut untuk pengurutan
   - Default: 1
   - Semakin kecil = semakin atas

#### Langkah:
1. Pilih tahun
2. Pilih kategori
3. Masukkan nama item
4. Input jumlah (angka saja)
5. Tentukan urutan
6. Klik "Simpan Data"

### 18.3 Edit Data APBDes
**URL**: `/admin/data-grafis/apbdes/{id}/edit`

1. Klik "Edit" di daftar
2. Ubah field yang perlu
3. Klik "Update Data"

### 18.4 Hapus Data APBDes
1. Klik "Hapus"
2. Konfirmasi
3. Data akan dihapus dari database

#### Tips:
- Data ini akan otomatis muncul di grafik halaman `/data-grafis`
- Pastikan total pendapatan dan belanja seimbang
- Urutan mempengaruhi tampilan di grafik

---

## 19. Kelola Data Warga

### 19.1 Daftar Warga
**URL**: `/admin/warga`

#### Fitur:
- Tabel data warga
- Kolom: NIK, Nama, Tempat/Tanggal Lahir, Jenis Kelamin, Alamat, Aksi
- Search dan filter
- Pagination
- Tombol "Tambah Warga"

### 19.2 Tambah Data Warga
**URL**: `/admin/warga/create`

#### Form Input:
1. **NIK** (wajib)
   - Nomor Induk Kependudukan
   - 16 digit
   - Harus unik
   
2. **KK (Nomor Kartu Keluarga)** (wajib)
   - 16 digit
   
3. **Nama Lengkap** (wajib)
   - Sesuai KTP
   
4. **Tempat Lahir** (wajib)
   - Kota/kabupaten lahir
   
5. **Tanggal Lahir** (wajib)
   - Format: DD/MM/YYYY
   
6. **Jenis Kelamin** (wajib)
   - Laki-laki / Perempuan
   
7. **Agama** (wajib)
   - Pilih dari dropdown
   
8. **Status Perkawinan** (wajib)
   - Belum Kawin / Kawin / Cerai Hidup / Cerai Mati
   
9. **Pekerjaan** (wajib)
   - Jenis pekerjaan
   
10. **Pendidikan** (opsional)
    - Pendidikan terakhir
    
11. **Alamat** (wajib)
    - Alamat lengkap
    
12. **RT** (wajib)
    - Nomor RT
    
13. **RW** (wajib)
    - Nomor RW

#### Langkah:
1. Isi semua field wajib
2. Pastikan NIK dan KK benar
3. Klik "Simpan Data Warga"

### 19.3 Lihat Detail Warga
**URL**: `/admin/warga/{id}`

- Menampilkan semua informasi warga
- Tombol "Edit" dan "Hapus"

### 19.4 Edit Data Warga
**URL**: `/admin/warga/{id}/edit`

1. Klik "Edit" di daftar atau detail
2. Ubah field yang diperlukan
3. Klik "Update Data Warga"

### 19.5 Hapus Data Warga
1. Klik "Hapus"
2. Konfirmasi penghapusan
3. Data warga akan dihapus permanen

⚠️ **Perhatian**: Pastikan data warga valid dan akurat!

---

## 20. Kelola Profile Desa

### 20.1 Edit Profile Desa
**URL**: `/admin/profile`

#### Field yang Dapat Diedit:

**Informasi Umum:**
1. **Nama Desa** (wajib)
2. **Alamat** (wajib)
3. **Kode Pos** (wajib)
4. **Email Desa** (wajib)
5. **No. Telepon** (wajib)
6. **Website** (opsional)

**Visi & Misi:**
7. **Visi** (wajib)
   - Textarea untuk visi desa
8. **Misi** (wajib)
   - Textarea untuk misi desa

**Sejarah:**
9. **Sejarah** (wajib)
   - Textarea untuk sejarah desa

**Demografi:**
10. **Jumlah Penduduk** (wajib)
11. **Jumlah KK** (wajib)
12. **Jumlah RT** (wajib)
13. **Jumlah RW** (wajib)
14. **Luas Wilayah** (wajib)
    - Dalam hektar atau km²

**Pemerintahan:**
15. **Kepala Desa** (wajib)
16. **Sekretaris Desa** (wajib)
17. **Struktur Organisasi** (opsional)
    - Upload gambar bagan
    - Format: JPG, PNG
    - Max: 2MB

#### Langkah Update:
1. Ubah field yang diperlukan
2. Upload gambar struktur (jika ada update)
3. Klik "Update Profile Desa"
4. Perubahan langsung terlihat di halaman `/profile`

---

## 21. Pengaturan Website

### 21.1 Akses Pengaturan
**URL**: `/admin/pengaturan`

### 21.2 Grup Pengaturan

#### Grup: UMUM
- **Nama Website**
  - Judul website yang muncul di browser
- **Tagline**
  - Slogan/motto website
- **Footer Text**
  - Teks copyright di footer

#### Grup: KONTAK
- **Email Kontak**
  - Email untuk kontak
- **Telepon**
  - Nomor telepon kantor desa
- **Alamat**
  - Alamat lengkap

#### Grup: SOSIAL MEDIA
- **Facebook**
  - URL profil Facebook
- **Instagram**
  - URL profil Instagram
- **Twitter**
  - URL profil Twitter
- **YouTube**
  - URL channel YouTube

#### Grup: MEDIA
- **Logo**
  - Upload logo desa
  - Format: PNG (transparan)
  - Ukuran: 200x200px
- **Favicon**
  - Icon website di browser tab
  - Format: ICO atau PNG
  - Ukuran: 32x32px

### 21.3 Cara Mengubah Pengaturan
1. Temukan pengaturan yang ingin diubah
2. Edit nilai di field yang tersedia
3. Untuk gambar: klik "Choose File" dan upload
4. Klik "Simpan Pengaturan" di bagian bawah
5. Perubahan akan langsung terlihat

### 21.4 Reset Pengaturan
Untuk reset ke default:
```bash
php artisan db:seed --class=PengaturanSeeder
```

---

## 22. Ubah Password

### 22.1 Akses Halaman Ubah Password
**URL**: `/admin/pengaturan/password`

### 22.2 Form Ubah Password

#### Field:
1. **Password Lama** (wajib)
   - Masukkan password saat ini
   
2. **Password Baru** (wajib)
   - Minimal 8 karakter
   - Gunakan kombinasi huruf, angka, simbol
   
3. **Konfirmasi Password Baru** (wajib)
   - Harus sama dengan password baru

### 22.3 Langkah Mengubah Password
1. Isi password lama
2. Isi password baru (min 8 karakter)
3. Konfirmasi password baru
4. Klik "Update Password"

### 22.4 Keamanan Password
✅ **DO**:
- Gunakan minimal 8 karakter
- Kombinasi huruf besar, kecil, angka, simbol
- Gunakan password yang unik
- Ganti password secara berkala

❌ **DON'T**:
- Jangan gunakan password yang mudah ditebak
- Jangan gunakan tanggal lahir atau nama
- Jangan share password dengan orang lain
- Jangan gunakan password yang sama di banyak tempat

---

# BAGIAN IV: TROUBLESHOOTING & FAQ

## 23. FAQ

### 23.1 Umum

**Q: Bagaimana cara reset password admin jika lupa?**
A: Jalankan seeder ulang:
```bash
php artisan db:seed --class=DatabaseSeeder
```
Password akan kembali ke `password123`

**Q: Apakah website ini responsive?**
A: Ya, website fully responsive untuk desktop, tablet, dan mobile.

**Q: Browser apa yang didukung?**
A: Chrome, Firefox, Safari, Edge versi terbaru.

### 23.2 Pengaduan

**Q: Apakah perlu login untuk mengajukan pengaduan?**
A: Tidak, pengaduan dapat diajukan tanpa login.

**Q: Berapa lama pengaduan diproses?**
A: Tergantung kategori dan kompleksitas. Track status via nomor tiket.

**Q: Apakah bisa mengubah pengaduan yang sudah dikirim?**
A: Tidak. Silakan ajukan pengaduan baru atau hubungi admin.

### 23.3 Admin

**Q: Berapa ukuran maksimal file yang bisa diupload?**
A: 
- Gambar berita: 2MB
- Dokumen APBD: 5MB
- Lampiran pengaduan: 2MB

**Q: Format file apa yang didukung?**
A:
- Gambar: JPG, PNG, WEBP
- Dokumen: PDF, XLS, XLSX, DOC, DOCX

**Q: Apakah ada backup otomatis?**
A: Belum. Lakukan backup manual database secara berkala.

### 23.4 Teknis

**Q: Bagaimana cara backup database?**
A:
```bash
php artisan db:backup
# atau manual via phpMyAdmin/MySQL dump
```

**Q: Bagaimana cara update Laravel?**
A:
```bash
composer update
php artisan migrate
```

**Q: Error "500 Internal Server Error"?**
A: 
1. Cek file `.env`
2. Cek permission folder `storage/` dan `bootstrap/cache/`
3. Jalankan: `php artisan cache:clear`

---

## 24. Troubleshooting

### 24.1 Masalah Instalasi

**Problem**: Composer install gagal
```bash
Solution:
1. Update composer: composer self-update
2. Hapus vendor folder: rm -rf vendor
3. Hapus composer.lock: rm composer.lock
4. Install ulang: composer install
```

**Problem**: NPM install error
```bash
Solution:
1. Hapus node_modules: rm -rf node_modules
2. Hapus package-lock.json: rm package-lock.json
3. Clear cache: npm cache clean --force
4. Install ulang: npm install
```

**Problem**: Database connection refused
```bash
Solution:
1. Cek MySQL service berjalan
2. Cek credentials di .env
3. Cek port MySQL (default: 3306)
4. Test connection: mysql -u root -p
```

### 24.2 Masalah Runtime

**Problem**: Gambar tidak muncul setelah upload
```bash
Solution:
php artisan storage:link

# Pastikan folder storage/app/public/ ada
# Cek permission folder storage/
```

**Problem**: Error 404 Not Found
```bash
Solution:
1. Cek file .htaccess ada di folder public/
2. Pastikan mod_rewrite enabled
3. Clear route cache: php artisan route:clear
```

**Problem**: Session tidak tersimpan
```bash
Solution:
1. Cek folder storage/framework/sessions/ writable
2. Clear session: php artisan session:clear
3. Cek SESSION_DRIVER di .env
```

**Problem**: CSS/JS tidak load
```bash
Solution:
1. Build ulang assets: npm run build
2. Clear cache: php artisan cache:clear
3. Hard refresh browser: Ctrl+Shift+R
```

### 24.3 Masalah Permission

**Problem**: Permission denied saat upload
```bash
Solution (Linux/Mac):
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
chown -R www-data:www-data storage/

Solution (Windows):
Klik kanan folder → Properties → Security → Full Control
```

### 24.4 Masalah Migrasi

**Problem**: Migration failed
```bash
Solution:
1. Cek database exists
2. Rollback: php artisan migrate:rollback
3. Fresh migrate: php artisan migrate:fresh --seed
```

**Problem**: Table already exists
```bash
Solution:
php artisan migrate:fresh --seed
# Warning: akan hapus semua data!
```

### 24.5 Debugging

**Enable Debug Mode:**
Edit `.env`:
```env
APP_DEBUG=true
APP_ENV=local
```

**Check Logs:**
```bash
# Lihat log error
tail -f storage/logs/laravel.log

# Clear log
truncate -s 0 storage/logs/laravel.log
```

**Clear All Cache:**
```bash
php artisan optimize:clear
# atau manual:
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 🆘 Butuh Bantuan?

Jika masih mengalami masalah:

1. **Cek Dokumentasi Laravel**: https://laravel.com/docs
2. **Stack Overflow**: Cari error message
3. **GitHub Issues**: https://github.com/jojixyz666/webdesakknunija2025/issues
4. **Kontak Developer**: hielmanabbrori@gmail.com

---

## 📋 Checklist Deployment Produksi

Sebelum deploy ke server produksi:

- [ ] Ganti password admin default
- [ ] Set `APP_ENV=production` di `.env`
- [ ] Set `APP_DEBUG=false` di `.env`
- [ ] Generate production key: `php artisan key:generate`
- [ ] Build production assets: `npm run build`
- [ ] Optimize autoloader: `composer install --optimize-autoloader --no-dev`
- [ ] Cache config: `php artisan config:cache`
- [ ] Cache routes: `php artisan route:cache`
- [ ] Cache views: `php artisan view:cache`
- [ ] Set proper file permissions (755 for folders, 644 for files)
- [ ] Install SSL certificate (HTTPS)
- [ ] Setup backup otomatis database
- [ ] Setup monitoring & logging
- [ ] Test semua fitur di staging dulu

---

## 📊 Maintenance Rutin

Lakukan secara berkala:

**Harian:**
- [ ] Cek log error
- [ ] Review pengaduan baru
- [ ] Backup database

**Mingguan:**
- [ ] Update berita
- [ ] Review dan update status pengaduan
- [ ] Cek performance website

**Bulanan:**
- [ ] Update data APBDes
- [ ] Review data warga
- [ ] Security audit
- [ ] Update dependencies (jika ada security patch)

**Per Tahun:**
- [ ] Upload dokumen APBD tahun baru
- [ ] Update profile desa
- [ ] Archive data tahun lama

---

<div align="center">

## ✨ Selamat Menggunakan Website Desa Ambunten Tengah! ✨

**Dikembangkan dengan ❤️ oleh KKN Universitas Wiraraja Sumenep 2025**

Versi Panduan: 1.0  
Tanggal: Januari 2026

</div>
