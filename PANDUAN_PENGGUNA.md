# 📚 Panduan Pengguna Website Desa Ambunten Tengah

<div align="center">

**Program Kerja KKN Universitas Wiraraja Sumenep 2025**

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square)
![Status](https://img.shields.io/badge/Status-Production-green?style=flat-square)

</div>

---

## 📋 Daftar Isi

1. [Pengenalan](#-pengenalan)
2. [Akses Website](#-akses-website)
3. [Fitur Portal Publik](#-fitur-portal-publik)
4. [Panel Admin](#-panel-admin)
5. [Manajemen Konten](#-manajemen-konten)
6. [Panduan Teknis](#-panduan-teknis)
7. [Troubleshooting](#-troubleshooting)
8. [FAQ](#-faq)

---

## 🎯 Pengenalan

Website Desa Ambunten Tengah adalah portal informasi digital yang menyediakan layanan transparansi dan aksesibilitas informasi desa kepada masyarakat. Platform ini dilengkapi dengan Content Management System (CMS) untuk memudahkan pengelolaan konten.

### Tujuan

- ✅ Meningkatkan transparansi pemerintahan desa
- ✅ Mempermudah akses informasi bagi masyarakat
- ✅ Menyediakan saluran aspirasi dan pengaduan
- ✅ Menampilkan profil dan kegiatan desa
- ✅ Menyajikan data kependudukan dan anggaran

---

## 🌐 Akses Website

### Portal Publik
```
URL: http://127.0.0.1:8000
atau
URL: http://localhost:8000
```

### Panel Admin
```
URL: http://127.0.0.1:8000/admin/login
Username: (sesuai database)
Password: (sesuai database)
```

> **⚠️ Catatan Keamanan:**
> - Ganti password default setelah login pertama
> - Jangan bagikan kredensial login
> - Logout setelah selesai menggunakan panel admin

---

## 🏠 Fitur Portal Publik

### 1. Halaman Beranda

**Akses:** `http://127.0.0.1:8000/`

**Fitur yang Tersedia:**
- 📊 Statistik desa (jumlah penduduk, KK, laki-laki, perempuan)
- 📰 Berita dan pengumuman terbaru
- 🗺️ Peta wilayah desa
- 📝 Formulir pengaduan cepat
- 🖼️ Galeri kegiatan desa

### 2. Berita & Pengumuman

**Akses:** `Menu Berita` atau `/berita`

**Fitur:**
- Melihat semua berita dan pengumuman
- Filter berdasarkan kategori (Berita / Pengumuman)
- Pencarian berita
- Detail berita lengkap dengan gambar
- Berita terkait

**Cara Menggunakan:**
1. Klik menu **"Berita"** di navigasi
2. Browse daftar berita yang tersedia
3. Klik judul berita untuk membaca detail lengkap

### 3. Pengaduan Masyarakat

**Akses:** `Menu Pengaduan` atau `/pengaduan`

**Fitur:**
- Formulir pengaduan online
- Upload foto bukti pengaduan
- Tracking status pengaduan
- Notifikasi tanggapan

**Cara Mengajukan Pengaduan:**

1. **Buka Halaman Pengaduan**
   - Klik menu **"Pengaduan"**

2. **Isi Formulir:**
   - **Nama:** Nama lengkap Anda
   - **Email:** Email untuk notifikasi
   - **Telepon:** Nomor HP (opsional)
   - **Judul:** Judul singkat pengaduan
   - **Deskripsi:** Uraian lengkap masalah
   - **Gambar:** Upload foto bukti (opsional, max 2MB)

3. **Kirim Pengaduan**
   - Klik tombol **"Kirim Pengaduan"**
   - Catat ID pengaduan untuk tracking

**Tracking Pengaduan:**
1. Klik menu **"Lacak Pengaduan"**
2. Masukkan ID pengaduan
3. Lihat status:
   - 🟡 **Pending** - Menunggu diproses
   - 🔵 **Proses** - Sedang ditangani
   - 🟢 **Selesai** - Telah ditanggapi

### 4. Peta Interaktif

**Akses:** `Menu Peta` atau `/peta`

**Fitur:**
- Peta wilayah desa dengan Leaflet.js
- Marker lokasi penting (kantor desa, sekolah, masjid, dll)
- Info detail setiap lokasi
- Navigasi zoom dan pan

**Cara Menggunakan:**
1. Klik menu **"Peta"**
2. Zoom in/out menggunakan tombol **+/-**
3. Klik marker untuk melihat informasi lokasi
4. Geser peta untuk eksplorasi area

### 5. Profil Desa

**Akses:** `Menu Profil` atau `/profile`

**Informasi yang Tersedia:**
- 📖 Sejarah Desa
- 🎯 Visi & Misi
- 👥 Struktur Organisasi Pemerintahan Desa
- 📊 Data Statistik Kependudukan

### 6. Transparansi Anggaran (APBDes)

**Akses:** `Menu Transparansi` atau `/transparansi`

**Fitur:**
- Daftar dokumen APBDes per tahun
- Download dokumen APBDes format PDF
- Informasi anggaran desa

**Cara Download Dokumen:**
1. Klik menu **"Transparansi"**
2. Pilih tahun anggaran
3. Klik tombol **"Download"**

### 7. Data Grafis

**Akses:** `Menu Data Grafis` atau `/data-grafis`

**Fitur:**
- Visualisasi data APBDes dalam bentuk grafik
- Grafik kategori: Pendapatan, Belanja, Pembiayaan
- Filter berdasarkan tahun

---

## 🔐 Panel Admin

### Login Admin

**URL:** `http://127.0.0.1:8000/admin/login`

**Langkah Login:**
1. Buka halaman login admin
2. Masukkan **Email/Username**
3. Masukkan **Password**
4. Klik **"Login"**

> **💡 Tip:** Jika lupa password, hubungi administrator sistem

### Dashboard Admin

**Akses:** `/admin/dashboard`

**Informasi yang Ditampilkan:**
- 📊 **Statistik Utama:**
  - Total berita
  - Total pengaduan (dengan breakdown status)
  - Total lokasi peta
  - Total penduduk (dengan detail gender)
  
- 📋 **Quick View:**
  - 5 Pengaduan terbaru
  - 5 Berita terbaru

- 🔗 **Quick Links:**
  - Tambah berita baru
  - Kelola pengaduan
  - Pengaturan website

---

## 📝 Manajemen Konten

### A. Manajemen Berita

**Menu:** `Admin → Berita`

#### ➕ Tambah Berita Baru

1. **Navigasi:** Klik **"Berita"** → **"Tambah Berita"**

2. **Isi Formulir:**
   - **Judul:** Judul berita (max 255 karakter)
   - **Kategori:** Pilih `Berita` atau `Pengumuman`
   - **Konten:** Isi berita lengkap (mendukung HTML)
   - **Gambar:** Upload gambar (JPEG/PNG/JPG/WEBP, max 2MB)
   - **Tampilkan:** Centang untuk menampilkan di portal publik
   - **Tanggal Publikasi:** Tanggal dan waktu publikasi

3. **Simpan:**
   - Klik **"Simpan"** untuk menyimpan berita
   - Klik **"Batal"** untuk membatalkan

> **💡 Tip:** 
> - Slug URL dibuat otomatis dari judul
> - Jika slug duplikat, sistem menambahkan angka (e.g., judul-1, judul-2)
> - Gunakan gambar berkualitas tinggi untuk tampilan optimal

#### ✏️ Edit Berita

1. Klik ikon **pensil** pada daftar berita
2. Edit field yang diinginkan
3. Klik **"Update"** untuk menyimpan perubahan

#### 🗑️ Hapus Berita

1. Klik ikon **trash** pada daftar berita
2. Konfirmasi penghapusan
3. Berita dan gambar akan dihapus permanent

### B. Manajemen Pengaduan

**Menu:** `Admin → Pengaduan`

#### 👀 Lihat Detail Pengaduan

1. Klik pada pengaduan dari daftar
2. Lihat informasi lengkap:
   - Data pelapor
   - Deskripsi pengaduan
   - Foto bukti (jika ada)
   - Status saat ini

#### 📝 Tanggapi Pengaduan

1. **Buka Detail Pengaduan**
2. **Ubah Status:**
   - Pilih: `Pending`, `Proses`, atau `Selesai`
   
3. **Isi Tanggapan:**
   - Tulis tanggapan di kolom yang tersedia
   - Tanggapan akan dikirim ke email pelapor (jika tersedia)

4. **Simpan:**
   - Klik **"Update Status & Tanggapan"**

> **⚠️ Penting:** 
> - Tanggapi pengaduan secepat mungkin
> - Berikan tanggapan yang jelas dan solutif
> - Update status sesuai progress penanganan

#### 🗑️ Hapus Pengaduan

Untuk pengaduan spam atau tidak valid:
1. Klik ikon **trash**
2. Konfirmasi penghapusan

### C. Manajemen Peta

**Menu:** `Admin → Peta`

#### ➕ Tambah Lokasi Baru

1. **Navigasi:** `Peta` → `Tambah Lokasi`

2. **Isi Data Lokasi:**
   - **Nama:** Nama tempat (e.g., "Kantor Desa")
   - **Deskripsi:** Keterangan lokasi
   - **Kategori:** Pilih kategori:
     - Kantor Desa
     - Sekolah
     - Tempat Ibadah
     - Fasilitas Umum
     - Lainnya
   - **Latitude:** Koordinat lintang (e.g., -7.123456)
   - **Longitude:** Koordinat bujur (e.g., 113.123456)
   - **Ikon:** URL ikon marker (opsional)
   - **Tampilkan:** Centang untuk menampilkan di peta

3. **Simpan Lokasi**

> **💡 Cara Mendapatkan Koordinat:**
> 1. Buka Google Maps
> 2. Klik kanan pada lokasi
> 3. Pilih koordinat yang muncul
> 4. Copy latitude dan longitude

#### ✏️ Edit & Hapus Lokasi

- **Edit:** Klik ikon pensil, ubah data, simpan
- **Hapus:** Klik ikon trash, konfirmasi

### D. Manajemen APBDes

**Menu:** `Admin → APBD`

#### ➕ Upload Dokumen APBDes

1. **Navigasi:** `APBD` → `Tambah Dokumen`

2. **Isi Informasi:**
   - **Judul:** Nama dokumen (e.g., "APBDes 2025")
   - **Tahun:** Tahun anggaran
   - **Deskripsi:** Keterangan dokumen
   - **File PDF:** Upload file PDF (max 10MB)

3. **Simpan**

> **📌 Format File:**
> - Hanya menerima file PDF
> - Ukuran maksimal 10MB
> - Nama file sebaiknya deskriptif

### E. Manajemen Data Grafis APBDes

**Menu:** `Admin → Data Grafis → APBDes`

#### ➕ Tambah Data APBDes

1. **Navigasi:** `Data Grafis` → `APBDes` → `Tambah Data`

2. **Isi Formulir:**
   - **Tahun:** Tahun anggaran (2000-2100)
   - **Kategori:** Pilih:
     - Pendapatan
     - Belanja
     - Pembiayaan Penerimaan
     - Pembiayaan Pengeluaran
   - **Jenis/Uraian:** Detail item anggaran
   - **Jumlah (Rp):** Nominal dalam rupiah
   - **Urutan Tampilan:** Angka urutan (opsional)

3. **Simpan Data**

> **💡 Tip:**
> - Data akan ditampilkan dalam bentuk grafik
> - Urutan tampilan berguna untuk mengurutkan item
> - Angka lebih kecil tampil di atas

#### ✏️ Edit Data APBDes

1. Klik ikon **pensil**
2. Update data yang diinginkan
3. Klik **"Update Data"**

### F. Manajemen Galeri

**Menu:** `Admin → Galeri`

#### ➕ Tambah Foto

1. **Navigasi:** `Galeri` → `Tambah Foto`

2. **Isi Formulir:**
   - **Judul:** Judul foto/kegiatan
   - **Deskripsi:** Keterangan foto (opsional)
   - **Kategori:** Kategori foto (default: umum)
   - **Gambar:** Upload foto (JPEG/PNG/JPG/WEBP, max 2MB)
   - **Tampilkan:** Centang untuk publish

3. **Simpan**

> **📷 Tips Foto:**
> - Gunakan foto berkualitas tinggi
> - Rasio 16:9 atau 4:3 untuk tampilan optimal
> - Ukuran file < 2MB
> - Format JPEG untuk ukuran lebih kecil

### G. Manajemen Data Warga

**Menu:** `Admin → Warga`

#### ➕ Tambah Data Warga

1. **Navigasi:** `Warga` → `Tambah Data`

2. **Isi Data Warga:**
   - **NIK:** Nomor Induk Kependudukan (16 digit)
   - **Nama Lengkap:** Nama sesuai KTP
   - **Tempat Lahir:** Kota/kabupaten lahir
   - **Tanggal Lahir:** Format DD/MM/YYYY
   - **Jenis Kelamin:** Laki-laki / Perempuan
   - **Alamat:** Alamat lengkap
   - **RT/RW:** Nomor RT dan RW
   - **Status Kawin:** Kawin / Belum Kawin / Cerai
   - **Pekerjaan:** Jenis pekerjaan
   - **Pendidikan Terakhir:** SD/SMP/SMA/S1/dll
   - **Status KK:** Kepala Keluarga / Anggota Keluarga

3. **Simpan Data**

> **⚠️ Penting:**
> - Data warga bersifat sensitif, jaga kerahasiaan
> - Pastikan data sesuai dengan KTP
> - NIK harus unik (tidak boleh duplikat)

### H. Profil Desa

**Menu:** `Admin → Profile`

#### ✏️ Edit Profil Desa

1. **Navigasi:** `Profile` → `Edit`

2. **Edit Informasi:**
   - **Visi:** Visi desa
   - **Misi:** Misi desa (bisa multi-paragraf)
   - **Sejarah Desa:** Sejarah dan latar belakang desa
   - **Bagan Organisasi:** Upload struktur organisasi (gambar)

3. **Simpan Perubahan**

> **💡 Tips:**
> - Gunakan format HTML untuk styling teks
> - Upload bagan organisasi dalam resolusi tinggi
> - Format gambar: JPEG/PNG/WEBP, max 5MB

### I. Pengaturan Website

**Menu:** `Admin → Pengaturan`

#### ⚙️ Konfigurasi Umum

1. **Navigasi:** `Pengaturan`

2. **Pengaturan yang Tersedia:**

   **Informasi Dasar:**
   - Nama Desa
   - Nama Kecamatan
   - Nama Kabupaten
   - Nama Provinsi
   - Kode Pos
   - Email Desa
   - Telepon Desa
   - Alamat Kantor Desa

   **Media Sosial:**
   - Link Facebook
   - Link Instagram
   - Link Twitter
   - Link YouTube

   **Tampilan:**
   - Logo Desa (upload gambar)
   - Favicon (icon tab browser)
   - Warna Tema
   - Hero Image (gambar beranda)

   **SEO:**
   - Meta Description
   - Meta Keywords
   - Google Analytics ID

3. **Simpan Pengaturan**

> **🔧 Catatan:**
> - Perubahan logo/favicon memerlukan refresh browser
> - Pastikan link media sosial valid
> - Gunakan gambar logo format PNG dengan background transparan

### J. Manajemen Akun Admin

#### 🔑 Ubah Password

**Menu:** `Admin → Pengaturan → Password`

1. **Masukkan Data:**
   - **Password Saat Ini:** Password lama
   - **Password Baru:** Password baru (min 8 karakter)
   - **Konfirmasi Password:** Ulangi password baru

2. **Simpan Perubahan**

> **🔒 Password yang Kuat:**
> - Minimal 8 karakter
> - Kombinasi huruf besar & kecil
> - Mengandung angka
> - Mengandung simbol (!@#$%^&*)

#### 👤 Edit Profil Admin

**Menu:** `Admin → Akun → Profil`

1. **Edit Data:**
   - **Nama:** Nama lengkap admin
   - **Email:** Email admin
   
2. **Ubah Password (opsional):**
   - **Password Saat Ini**
   - **Password Baru**
   - **Konfirmasi Password Baru**

3. **Simpan Perubahan**

---

## 🛠️ Panduan Teknis

### Instalasi & Setup

#### Prasyarat Sistem

```bash
- PHP >= 8.3
- MySQL >= 8.0
- Composer >= 2.0
- Node.js >= 20.x
- NPM/Yarn
```

#### Langkah Instalasi

1. **Clone Repository**
```bash
git clone [repository-url]
cd webdesakknunija2025
```

2. **Install Dependencies**
```bash
# PHP Dependencies
composer install

# JavaScript Dependencies
npm install
```

3. **Konfigurasi Environment**
```bash
# Copy file .env
cp .env.example .env

# Generate Application Key
php artisan key:generate
```

4. **Konfigurasi Database**

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webdesa
DB_USERNAME=root
DB_PASSWORD=
```

5. **Migrasi Database**
```bash
# Jalankan migrasi
php artisan migrate

# (Opsional) Seed data contoh
php artisan db:seed
```

6. **Storage Link**
```bash
php artisan storage:link
```

7. **Compile Assets**
```bash
# Development
npm run dev

# Production
npm run build
```

8. **Jalankan Server**
```bash
php artisan serve
```

Website dapat diakses di: `http://127.0.0.1:8000`

### Backup & Restore

#### Backup Database

```bash
# Manual backup menggunakan mysqldump
mysqldump -u root -p webdesa > backup_webdesa_$(date +%Y%m%d).sql

# Atau menggunakan Laravel
php artisan db:backup
```

#### Backup File Upload

```bash
# Backup folder storage
tar -czf storage_backup_$(date +%Y%m%d).tar.gz storage/app/public/
```

#### Restore Database

```bash
# Restore dari backup
mysql -u root -p webdesa < backup_webdesa_20260113.sql
```

### Update & Maintenance

#### Update Aplikasi

```bash
# Pull update terbaru
git pull origin main

# Update dependencies
composer update
npm update

# Jalankan migrasi baru (jika ada)
php artisan migrate

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Compile assets
npm run build
```

#### Maintenance Mode

```bash
# Aktifkan maintenance mode
php artisan down --message="Sedang dalam pemeliharaan. Mohon tunggu beberapa saat."

# Nonaktifkan maintenance mode
php artisan up
```

### Optimasi Performa

```bash
# Cache konfigurasi
php artisan config:cache

# Cache route
php artisan route:cache

# Cache view
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize

# Clear semua cache
php artisan optimize:clear
```

---

## 🔧 Troubleshooting

### Masalah Umum & Solusi

#### 1. Error 500 - Internal Server Error

**Penyebab:**
- Kesalahan konfigurasi
- File permission salah
- Database tidak terkoneksi

**Solusi:**
```bash
# Cek log error
tail -f storage/logs/laravel.log

# Fix permission
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Clear cache
php artisan cache:clear
php artisan config:clear
```

#### 2. Gambar Tidak Muncul

**Penyebab:**
- Storage link belum dibuat
- Permission folder salah

**Solusi:**
```bash
# Buat storage link
php artisan storage:link

# Fix permission
chmod -R 755 storage/app/public
```

#### 3. Slug Berita Duplikat

**Penyebab:**
- Judul berita sama

**Solusi:**
- Sistem otomatis menambahkan angka (e.g., judul-1, judul-2)
- Atau ubah judul berita agar unik

#### 4. Upload File Gagal

**Penyebab:**
- Ukuran file terlalu besar
- Format file tidak didukung

**Solusi:**
```php
# Edit php.ini
upload_max_filesize = 10M
post_max_size = 10M

# Restart web server
sudo systemctl restart apache2
# atau
sudo systemctl restart nginx
```

#### 5. Session Expired / Logout Otomatis

**Penyebab:**
- Session lifetime terlalu pendek

**Solusi:**
```env
# Edit .env
SESSION_LIFETIME=120
```

#### 6. Peta Tidak Muncul

**Penyebab:**
- API key tidak valid
- JavaScript error

**Solusi:**
1. Buka browser console (F12)
2. Cek error JavaScript
3. Pastikan koneksi internet stabil
4. Clear browser cache

#### 7. Email Tidak Terkirim

**Penyebab:**
- Konfigurasi mail salah

**Solusi:**
```env
# Edit .env untuk SMTP
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

---

## ❓ FAQ (Frequently Asked Questions)

### Umum

**Q: Apakah website ini gratis?**  
A: Ya, website ini dikembangkan sebagai program KKN dan gratis untuk desa.

**Q: Apakah bisa diakses dari smartphone?**  
A: Ya, website fully responsive dan optimal di semua perangkat.

**Q: Berapa kapasitas upload file?**  
A: 
- Gambar berita/galeri: 2MB
- Bagan organisasi: 5MB
- Dokumen PDF APBDes: 10MB

**Q: Apakah ada batasan jumlah berita?**  
A: Tidak ada batasan, namun disarankan arsip berita lama secara berkala.

### Admin

**Q: Berapa banyak admin yang bisa login?**  
A: Bisa multiple admin, sesuai kebutuhan desa.

**Q: Apakah bisa menambah user admin baru?**  
A: Ya, hubungi developer atau gunakan Laravel Tinker.

**Q: Bagaimana jika lupa password?**  
A: Hubungi administrator atau reset melalui database.

### Teknis

**Q: Apakah harus menggunakan hosting berbayar?**  
A: Untuk produksi, disarankan menggunakan hosting atau VPS yang reliable.

**Q: Apakah support SSL/HTTPS?**  
A: Ya, tinggal install SSL certificate di hosting.

**Q: Bagaimana cara migrasi ke hosting?**  
A: 
1. Upload semua file
2. Import database
3. Set permission folder
4. Konfigurasi .env
5. Jalankan `php artisan storage:link`

**Q: Apakah ada dokumentasi API?**  
A: Saat ini hanya ada API untuk peta (`/api/peta/lokasi`).

**Q: Bagaimana cara update ke versi terbaru?**  
A: Lihat bagian [Update & Maintenance](#update--maintenance).

---

## 📞 Dukungan & Kontak

### Tim Pengembang

**Program KKN Universitas Wiraraja Sumenep 2025**

- **Website:** -
- **Email:** -
- **Repository:** -

### Pelaporan Bug

Jika menemukan bug atau error:
1. Screenshot error message
2. Catat langkah-langkah yang menyebabkan error
3. Hubungi tim pengembang dengan informasi detail

### Saran & Kritik

Kami menerima saran dan kritik untuk pengembangan lebih lanjut. Silakan hubungi:
- Email: [email pihak terkait]
- WhatsApp: [nomor kontak]

---

## 📄 Lisensi & Kredit

### Lisensi

Website ini dikembangkan untuk keperluan publik sebagai bagian dari Program KKN.

### Teknologi yang Digunakan

- **Laravel Framework** - [laravel.com](https://laravel.com)
- **Tailwind CSS** - [tailwindcss.com](https://tailwindcss.com)
- **Alpine.js** - [alpinejs.dev](https://alpinejs.dev)
- **Leaflet.js** - [leafletjs.com](https://leafletjs.com)
- **Chart.js** - [chartjs.org](https://www.chartjs.org)

### Kontributor

**Tim KKN Universitas Wiraraja Sumenep 2025**
- [Nama Anggota Tim]

---

## 📚 Referensi Tambahan

### Dokumentasi Terkait

- [USER_GUIDE.md](USER_GUIDE.md) - Panduan pengguna singkat
- [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Panduan troubleshooting detail
- [SECURITY_AUDIT.md](SECURITY_AUDIT.md) - Laporan audit keamanan
- [SEO_OPTIMIZATION_REPORT.md](SEO_OPTIMIZATION_REPORT.md) - Laporan optimasi SEO
- [BUGFIX_SUMMARY.md](BUGFIX_SUMMARY.md) - Ringkasan perbaikan bug

### Tutorial Video

(Tambahkan link tutorial video jika tersedia)

---

<div align="center">

**© 2026 KKN Universitas Wiraraja Sumenep**

**Desa Ambunten Tengah**

*Dikembangkan dengan ❤️ untuk kemajuan desa*

</div>
