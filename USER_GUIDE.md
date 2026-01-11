# PANDUAN PENGGUNAAN SISTEM INFORMASI DESA AMBUNTEN TENGAH

---

## KATA PENGANTAR

Panduan ini disusun untuk membantu pengguna dalam mengoperasikan Sistem Informasi Desa Ambunten Tengah. Dokumen ini berisi petunjuk lengkap penggunaan website, baik untuk masyarakat umum maupun administrator sistem.

Harapan kami, dengan adanya panduan ini, seluruh fitur dan layanan dapat dimanfaatkan secara optimal untuk meningkatkan pelayanan publik dan transparansi pemerintahan desa.

---

## DAFTAR ISI

**BAGIAN I - INFORMASI UMUM**
1. [Tentang Sistem](#1-tentang-sistem)
2. [Akses dan Login](#2-akses-dan-login)

**BAGIAN II - PANDUAN PENGUNJUNG**
3. [Halaman Beranda](#3-halaman-beranda)
4. [Informasi Berita Desa](#4-informasi-berita-desa)
5. [Data dan Statistik](#5-data-dan-statistik)
6. [Peta Wilayah Desa](#6-peta-wilayah-desa)
7. [Layanan Pengaduan](#7-layanan-pengaduan)
8. [Galeri Kegiatan](#8-galeri-kegiatan)
9. [Transparansi APBD](#9-transparansi-apbd)

**BAGIAN III - PANDUAN ADMINISTRATOR**
10. [Dashboard Administrator](#10-dashboard-administrator)
11. [Pengelolaan Berita](#11-pengelolaan-berita)
12. [Pengelolaan Pengaduan](#12-pengelolaan-pengaduan)
13. [Pengelolaan Peta Lokasi](#13-pengelolaan-peta-lokasi)
14. [Pengelolaan Galeri](#14-pengelolaan-galeri)
15. [Pengelolaan Data Warga](#15-pengelolaan-data-warga)
16. [Pengelolaan APBD](#16-pengelolaan-apbd)
17. [Pengaturan Sistem](#17-pengaturan-sistem)

**BAGIAN IV - LAMPIRAN**
18. [Tanya Jawab Umum](#18-tanya-jawab-umum)
19. [Informasi Kontak](#19-informasi-kontak)

---

## BAGIAN I - INFORMASI UMUM

### 1. TENTANG SISTEM

#### 1.1 Pengertian
Sistem Informasi Desa Ambunten Tengah adalah aplikasi berbasis website yang digunakan untuk menyampaikan informasi dan pelayanan kepada masyarakat Desa Ambunten Tengah, Kecamatan Ambunten, Kabupaten Sumenep, Provinsi Jawa Timur.

#### 1.2 Tujuan Sistem
a. Menyediakan informasi desa yang akurat dan terkini kepada masyarakat
b. Meningkatkan transparansi pemerintahan desa
c. Memudahkan masyarakat dalam mengakses layanan desa
d. Menyediakan sarana komunikasi antara pemerintah desa dan masyarakat

#### 1.3 Fitur Utama Sistem
- Publikasi berita dan pengumuman desa
- Penyajian data kependudukan dan statistik
- Peta wilayah desa dengan informasi lokasi penting
- Layanan pengaduan masyarakat secara online
- Galeri dokumentasi kegiatan desa
- Transparansi Anggaran Pendapatan dan Belanja Desa (APBD)
- Panel administrasi untuk pengelolaan konten

#### 1.4 Spesifikasi Teknis
- Platform: Aplikasi Web
- Akses: Melalui browser internet (Chrome, Firefox, Safari, Edge)
- Responsive: Dapat diakses melalui komputer, tablet, dan smartphone


---

### 2. AKSES DAN LOGIN

#### 2.1 Alamat Website
Website dapat diakses melalui browser dengan alamat:
```
http://desaambuntentengah.sumenepkab.go.id
```

Untuk pengembangan lokal:
```
http://localhost:8000
```

#### 2.2 Akses untuk Masyarakat Umum
Masyarakat dapat mengakses informasi publik tanpa perlu login, meliputi:
- Halaman beranda
- Berita dan pengumuman
- Data statistik kependudukan
- Peta wilayah desa
- Galeri kegiatan
- Data APBD

#### 2.3 Akses untuk Administrator
Administrator perlu melakukan login untuk mengelola konten website.

**Kredensial Default:**
- Email: admin@admin.com
- Kata Sandi: password

**PENTING:** Segera ubah kata sandi setelah login pertama kali untuk keamanan sistem.

**Prosedur Login:**
1. Buka halaman login di: [URL]/login
2. Masukkan alamat email administrator
3. Masukkan kata sandi
4. Klik tombol "Masuk"
5. Sistem akan mengarahkan ke halaman Dashboard Administrator

**Prosedur Logout:**
1. Klik nama pengguna di pojok kanan atas
2. Pilih menu "Keluar"
3. Konfirmasi logout

---

## BAGIAN II - PANDUAN PENGUNJUNG

### 3. HALAMAN BERANDA

#### 3.1 Deskripsi
Halaman beranda adalah halaman utama yang pertama kali muncul saat mengakses website. Halaman ini menampilkan informasi ringkas dan menarik tentang desa.

#### 3.2 Komponen Halaman Beranda

**a. Banner Utama**
- Menampilkan foto atau gambar unggulan desa
- Dapat dikustomisasi oleh administrator
- Berisi sambutan singkat

**b. Statistik Penduduk**
Menampilkan data real-time yang meliputi:
- Total Penduduk: Jumlah seluruh penduduk terdaftar
- Jumlah Kepala Keluarga: Total kepala keluarga
- Jumlah RT: Jumlah Rukun Tetangga
- Jumlah RW: Jumlah Rukun Warga

Data statistik ini diperbaharui secara otomatis berdasarkan data terbaru dalam database.

**c. Berita Terkini**
Menampilkan 3 (tiga) berita terbaru yang dipublikasikan oleh pemerintah desa.

**d. Profil Desa**
Informasi singkat mengenai profil Desa Ambunten Tengah.

**e. Kontak Informasi**
Informasi kontak kantor desa yang dapat dihubungi oleh masyarakat.

#### 3.3 Navigasi Menu Utama
Menu navigasi terletak di bagian atas halaman (header) dan dapat diakses dari semua halaman, terdiri dari:
- Beranda
- Berita
- Data Grafis
- Peta
- Pengaduan
- Galeri
- APBD

---

### 4. INFORMASI BERITA DESA

#### 4.1 Deskripsi
Halaman berita menampilkan seluruh artikel berita dan pengumuman yang dipublikasikan oleh pemerintah desa.

#### 4.2 Cara Mengakses
1. Klik menu "Berita" pada navigasi utama
2. Sistem akan menampilkan daftar semua berita

#### 4.3 Fitur yang Tersedia

**a. Kategori Berita**
Berita dikategorikan menjadi beberapa jenis:
- Pengumuman: Pemberitahuan resmi dari pemerintah desa
- Kegiatan: Informasi kegiatan yang dilaksanakan
- Pembangunan: Update proyek pembangunan desa
- Lainnya: Informasi umum lainnya

**b. Filter Berita**
Gunakan tombol filter untuk menampilkan berita berdasarkan kategori tertentu.

**c. Pencarian**
Masukkan kata kunci di kolom pencarian untuk menemukan berita spesifik.

#### 4.4 Membaca Detail Berita
1. Klik pada judul atau gambar berita yang ingin dibaca
2. Halaman detail berita akan terbuka
3. Informasi yang ditampilkan:
   - Judul berita
   - Tanggal publikasi
   - Kategori
   - Gambar (jika ada)
   - Isi berita lengkap
4. Gunakan tombol "Kembali" untuk kembali ke daftar berita

---

### 5. DATA DAN STATISTIK

#### 5.1 Deskripsi
Halaman Data Grafis menyajikan informasi kependudukan desa dalam bentuk angka statistik dan visualisasi data.

#### 5.2 Cara Mengakses
Klik menu "Data Grafis" pada navigasi utama.

#### 5.3 Informasi yang Disajikan

**Tab Kependudukan**

Menampilkan statistik penduduk dengan kartu informasi berwarna:

a. **Total Penduduk** (Kartu Hijau)
   - Jumlah seluruh penduduk terdaftar

b. **Kepala Keluarga** (Kartu Emerald)
   - Jumlah kepala keluarga

c. **Penduduk Laki-laki** (Kartu Teal)
   - Jumlah penduduk berjenis kelamin laki-laki

d. **Penduduk Perempuan** (Kartu Pink)
   - Jumlah penduduk berjenis kelamin perempuan

e. **Wajib Pilih** (Kartu Cyan)
   - Jumlah penduduk yang memiliki hak pilih (usia ≥ 17 tahun)

#### 5.4 Catatan
Semua data statistik diperbaharui secara otomatis dan real-time berdasarkan database kependudukan desa.

---

### 6. PETA WILAYAH DESA

#### 6.1 Deskripsi
Halaman peta menampilkan peta interaktif wilayah Desa Ambunten Tengah beserta lokasi-lokasi penting di dalamnya.

#### 6.2 Cara Mengakses
Klik menu "Peta" pada navigasi utama.

#### 6.3 Fitur Peta Interaktif

**a. Batas Wilayah Administratif**
- Ditampilkan dengan garis hijau putus-putus
- Menggunakan 145 titik koordinat GPS untuk akurasi tinggi
- Klik pada area polygon untuk melihat informasi batas wilayah:
  - Utara: Laut Jawa
  - Timur: Desa Ambunten Timur
  - Selatan: Desa Tambaagung Barat
  - Barat: Desa Ambunten Barat

**b. Marker Lokasi**
Lokasi-lokasi penting ditandai dengan ikon berwarna:
- Merah (🏥): Fasilitas Umum (sekolah, puskesmas, dll)
- Hijau (🎯): Tempat Wisata
- Biru (🏛️): Gedung Pemerintahan
- Orange (📍): Lokasi Lainnya

#### 6.4 Cara Menggunakan Peta

**Filter Lokasi:**
1. Gunakan tombol filter di atas peta
2. Pilih kategori yang diinginkan:
   - Semua: Menampilkan seluruh lokasi
   - Fasilitas Umum
   - Wisata
   - Pemerintahan
   - Lainnya
3. Peta akan menyesuaikan tampilan sesuai filter

**Navigasi Peta:**
- **Zoom In/Out**: Gunakan tombol (+) dan (-) atau scroll mouse
- **Geser Peta**: Klik dan tahan mouse, lalu geser ke area yang diinginkan
- **Lihat Detail Lokasi**: Klik marker untuk membuka informasi

**Informasi Detail Lokasi:**
Setiap marker yang diklik akan menampilkan popup berisi:
- Nama lokasi
- Kategori
- Foto lokasi (jika tersedia)
- Deskripsi
- Tombol "Buka di Google Maps" untuk navigasi

**Daftar Lokasi:**
- Di bawah peta terdapat daftar kartu lokasi
- Klik tombol "Lihat di Peta" pada kartu untuk fokus ke lokasi tersebut

---

### 7. LAYANAN PENGADUAN

#### 7.1 Deskripsi
Layanan pengaduan adalah sarana bagi masyarakat untuk menyampaikan keluhan, saran, atau laporan terkait pelayanan dan kondisi di desa.

#### 7.2 Cara Mengakses
Klik menu "Pengaduan" pada navigasi utama.

#### 7.3 Mengajukan Pengaduan Baru

**Langkah-langkah:**
1. Klik tombol "Buat Pengaduan Baru"
2. Isi formulir pengaduan dengan lengkap:

   a. **Nama Lengkap** (Wajib)
      - Tulis nama lengkap Anda

   b. **Alamat Email** (Wajib)
      - Gunakan email aktif untuk menerima notifikasi
      - Email akan digunakan untuk komunikasi terkait pengaduan

   c. **Kategori Pengaduan** (Wajib)
      - Pilih kategori yang sesuai:
        - Infrastruktur (jalan, jembatan, dll)
        - Pelayanan Publik
        - Lingkungan
        - Administrasi
        - Lainnya

   d. **Judul Pengaduan** (Wajib)
      - Buat judul singkat yang jelas (maksimal 100 karakter)

   e. **Isi Pengaduan** (Wajib)
      - Jelaskan detail pengaduan Anda
      - Sertakan informasi lokasi, waktu, dan kronologi jika perlu

   f. **Foto Pendukung** (Opsional)
      - Upload foto terkait pengaduan
      - Format: JPG atau PNG
      - Ukuran maksimal: 2 MB

3. Klik tombol "Kirim Pengaduan"
4. Sistem akan memberikan nomor tiket pengaduan
5. **Simpan nomor tiket** untuk tracking status pengaduan

#### 7.4 Status Pengaduan

Setiap pengaduan memiliki status sebagai berikut:

a. **Pending (Menunggu)**
   - Pengaduan baru diterima
   - Menunggu ditanggapi petugas

b. **Diproses (Sedang Ditangani)**
   - Pengaduan sedang ditindaklanjuti
   - Petugas sedang melakukan penanganan

c. **Selesai**
   - Pengaduan telah ditindaklanjuti
   - Dapat dilihat tanggapan dari petugas

#### 7.5 Melihat Status Pengaduan
1. Masuk ke halaman Pengaduan
2. Lihat daftar pengaduan yang pernah diajukan
3. Status akan ditampilkan dengan warna:
   - Kuning: Pending
   - Biru: Diproses
   - Hijau: Selesai

#### 7.6 Etika Pengaduan
- Sampaikan pengaduan dengan bahasa yang sopan
- Berikan informasi yang akurat dan jelas
- Hindari pengaduan yang bersifat SARA
- Gunakan layanan ini untuk hal-hal yang konstruktif

---

### 8. GALERI KEGIATAN

#### 8.1 Deskripsi
Galeri berisi dokumentasi foto dan video kegiatan yang dilaksanakan di Desa Ambunten Tengah.

#### 8.2 Cara Mengakses
Klik menu "Galeri" pada navigasi utama.

#### 8.3 Kategori Galeri
- Kegiatan: Dokumentasi acara dan kegiatan desa
- Pembangunan: Dokumentasi proyek pembangunan
- Budaya: Kegiatan budaya dan tradisi
- Lainnya: Dokumentasi umum lainnya

#### 8.4 Fitur Galeri

**Filter Kategori:**
- Gunakan tombol filter untuk menampilkan galeri berdasarkan kategori
- Klik "Semua" untuk menampilkan seluruh galeri

**Melihat Foto:**
1. Klik pada thumbnail foto yang ingin dilihat
2. Foto akan ditampilkan dalam ukuran besar (lightbox)
3. Gunakan tombol panah (< >) untuk navigasi antar foto
4. Klik tombol X atau area di luar foto untuk menutup

**Informasi yang Ditampilkan:**
- Judul galeri
- Kategori
- Deskripsi
- Tanggal upload

---

### 9. TRANSPARANSI APBD

#### 9.1 Deskripsi
Halaman APBD (Anggaran Pendapatan dan Belanja Desa) menyajikan informasi tentang keuangan desa secara transparan kepada masyarakat.

#### 9.2 Cara Mengakses
Klik menu "APBD" pada navigasi utama.

#### 9.3 Informasi yang Disajikan

**a. Ringkasan APBD**
- Tahun Anggaran
- Total Pendapatan
- Total Belanja
- Total Pembiayaan

**b. Rincian Pendapatan**
Sumber-sumber pendapatan desa, antara lain:
- Dana Desa
- Alokasi Dana Desa (ADD)
- Bagi Hasil Pajak dan Retribusi
- Pendapatan Asli Desa
- Lain-lain pendapatan yang sah

**c. Rincian Belanja**
Penggunaan anggaran untuk:
- Belanja Pegawai
- Belanja Barang dan Jasa
- Belanja Modal
- Belanja Tidak Terduga

**d. Pembiayaan**
- Penerimaan Pembiayaan
- Pengeluaran Pembiayaan

#### 9.4 Format Penyajian
- Data disajikan dalam bentuk tabel
- Grafik perbandingan (jika tersedia)
- Data dapat diunduh dalam format PDF (jika tersedia)

#### 9.5 Periode Data
Data APBD diperbaharui setiap tahun anggaran baru oleh administrator desa.

---

## BAGIAN III - PANDUAN ADMINISTRATOR

### Login ke Admin Panel

1. Akses: `http://localhost:8000/login`
2. Masukkan email dan password admin
3. Klik "Login"
4. Anda akan diarahkan ke Dashboard Admin

### Dashboard Admin

**Statistik yang Ditampilkan**:
- 👥 Total Penduduk
- 🏠 Kepala Keluarga
- 👨 Laki-laki
- 👩 Perempuan
- 📰 Total Berita
- 📢 Total Pengaduan (+ pending)
- 📍 Total Lokasi
- 📸 Total Galeri

---

## Panduan Lengkap Fitur

### 📰 Kelola Berita

**Menu**: Admin → Berita

#### Menambah Berita Baru
1. Klik tombol "Tambah Berita"
2. Isi form:
   - **Judul**: Judul berita (wajib)
   - **Kategori**: Pilih kategori (wajib)
   - **Konten**: Isi berita lengkap (wajib)
   - **Gambar**: Upload gambar (max 2MB, format: jpg/png)
   - **Status**: Published/Draft
3. Klik "Simpan"

#### Edit Berita
1. Klik tombol "Edit" pada baris berita
2. Ubah data yang diperlukan
3. Klik "Update"

#### Hapus Berita
1. Klik tombol "Hapus"
2. Konfirmasi penghapusan
3. Data akan dihapus permanen

**Tips**:
- Gunakan status "Draft" untuk berita yang belum siap dipublikasi
- Ukuran gambar optimal: 1200x630px
- Format gambar: JPG atau PNG

---

### 📢 Kelola Pengaduan

**Menu**: Admin → Pengaduan

#### Menanggapi Pengaduan
1. Klik pengaduan yang masuk
2. Lihat detail pengaduan
3. Ubah status:
   - **Pending** → **Diproses**: Saat mulai menangani
   - **Diproses** → **Selesai**: Saat sudah ditindaklanjuti
4. Tulis tanggapan di kolom "Tanggapan"
5. Klik "Simpan Tanggapan"

**Tips**:
- Prioritaskan pengaduan kategori darurat
- Berikan tanggapan yang jelas dan sopan
- Update status secara berkala

---

### 🗺️ Kelola Lokasi Peta

**Menu**: Admin → Peta/Lokasi

#### Menambah Lokasi Baru
1. Klik "Tambah Lokasi"
2. Isi form:
   - **Nama Lokasi**: Nama tempat
   - **Kategori**: Fasilitas Umum/Wisata/Pemerintahan/Lainnya
   - **Deskripsi**: Detail lokasi
   - **Latitude**: Koordinat lintang (-6.xxxx)
   - **Longitude**: Koordinat bujur (113.xxxx)
   - **Gambar**: Upload foto lokasi (opsional)
3. Klik "Simpan"

**Cara Mendapatkan Koordinat**:
1. Buka Google Maps
2. Klik kanan pada lokasi → "What's here?"
3. Copy koordinat yang muncul
4. Format: -6.9003364, 113.7216313

**Tips**:
- Pastikan koordinat berada dalam wilayah desa
- Gunakan marker yang sesuai kategori
- Upload foto untuk informasi lebih jelas

---

### 📸 Kelola Galeri

**Menu**: Admin → Galeri

#### Upload Foto/Video
1. Klik "Tambah Galeri"
2. Isi form:
   - **Judul**: Judul media
   - **Kategori**: Kegiatan/Pembangunan/Budaya/Lainnya
   - **Deskripsi**: Keterangan
   - **File**: Upload gambar/video
     - Gambar: Max 5MB, format JPG/PNG
     - Video: Max 50MB, format MP4
3. Klik "Upload"

#### Kelola Album
1. Gunakan kategori sebagai album
2. Filter berdasarkan kategori
3. Edit/Hapus sesuai kebutuhan

---

### 👥 Kelola Data Warga

**Menu**: Admin → Data Warga

#### Import Data dari CSV
1. Siapkan file CSV dengan format:
   ```
   Nama,NKK,NIK,Tgl Lahir,SHDK,Status Hubungan Keluarga,PEND,Pendidikan Terakhir,Alamat
   ```
2. Letakkan file `1.csv` di root project
3. Jalankan command:
   ```bash
   php artisan db:seed --class=WargaSeeder
   ```
4. Data akan otomatis terimport

#### Tambah Warga Manual
1. Klik "Tambah Warga"
2. Isi form lengkap:
   - NIK (16 digit)
   - Nomor KK (16 digit)
   - Nama Lengkap
   - Jenis Kelamin
   - Tempat/Tanggal Lahir
   - Agama
   - Pendidikan
   - Pekerjaan
   - Status Perkawinan
   - Status dalam Keluarga
   - Dusun, RT, RW
   - Alamat
3. Klik "Simpan"

**Field Wajib Diisi**:
- NIK
- Nama
- Nomor KK
- Jenis Kelamin
- Tanggal Lahir

**Tips**:
- NIK harus unik (tidak boleh sama)
- Digit ke-7-8 NIK menentukan jenis kelamin (>40 = Perempuan)
- Wajib pilih otomatis ter-set untuk umur ≥17 tahun

---

### 💰 Kelola APBD

**Menu**: Admin → APBD

#### Tambah Data APBD Tahunan
1. Klik "Tambah APBD"
2. Isi form:
   - **Tahun Anggaran**: 2024, 2025, dst
   - **Pendapatan**: Total pendapatan (Rp)
   - **Belanja**: Total belanja (Rp)
   - **Pembiayaan**: Total pembiayaan (Rp)
3. Tambah detail item:
   - **Jenis**: Pendapatan/Belanja/Pembiayaan
   - **Uraian**: Nama item
   - **Jumlah**: Nominal (Rp)
4. Klik "Simpan"

**Tips**:
- Total Belanja tidak boleh melebihi Pendapatan + Pembiayaan
- Gunakan format angka tanpa titik/koma (sistem akan format otomatis)

---

### ⚙️ Pengaturan Website

**Menu**: Admin → Pengaturan

#### Update Informasi Desa
1. Buka menu Pengaturan
2. Edit informasi:
   - **Nama Desa**: Ambunten Tengah
   - **Kecamatan**: Ambunten
   - **Kabupaten**: Sumenep
   - **Provinsi**: Jawa Timur
   - **Kode Pos**: xxxxx
   - **Email Desa**: email@desa.id
   - **Telepon**: 08xx-xxxx-xxxx
   - **Alamat Kantor**: Alamat lengkap
3. Klik "Simpan"

#### Upload Logo & Banner
1. **Logo Desa**: 
   - Ukuran: 200x200px
   - Format: PNG transparan
   - Lokasi: Navbar & Footer

2. **Banner Beranda**:
   - Ukuran: 1920x600px
   - Format: JPG/PNG
   - Lokasi: Header beranda

#### Sambutan Kepala Desa
1. Edit konten sambutan
2. Upload foto kepala desa (400x400px)
3. Isi jabatan dan nama
4. Klik "Simpan"

---

### 👤 Kelola Profil Admin

**Menu**: Klik nama user (top right) → Profil

#### Ubah Password
1. Masukkan password lama
2. Masukkan password baru (min. 8 karakter)
3. Konfirmasi password baru
4. Klik "Ubah Password"

#### Update Profil
1. Edit nama
2. Edit email (pastikan valid)
3. Upload foto profil (opsional)
4. Klik "Simpan"

---

## FAQ & Troubleshooting

### ❓ Pertanyaan Umum

**Q: Bagaimana cara mengubah data statistik penduduk?**
A: Statistik dihitung otomatis dari tabel `warga`. Edit/tambah data warga di menu Data Warga, statistik akan update otomatis.

**Q: Mengapa peta tidak muncul?**
A: Pastikan:
- Koneksi internet aktif (untuk loading OpenStreetMap tiles)
- Browser sudah update (support Leaflet.js)
- Clear cache browser (Ctrl+Shift+R)

**Q: Foto yang diupload tidak muncul?**
A: Pastikan:
- Format file benar (JPG/PNG)
- Ukuran file < max limit (2MB untuk berita, 5MB untuk galeri)
- Folder `storage/app/public` memiliki permission write
- Jalankan: `php artisan storage:link`

**Q: Setelah login langsung logout otomatis?**
A: Periksa:
- Session driver di `.env` (gunakan `file` atau `database`)
- Cookie domain setting
- Clear browser cookies

**Q: Data dari CSV tidak masuk semua?**
A: Cek:
- Format CSV sesuai template
- Encoding file UTF-8
- Tidak ada NIK duplikat
- Lihat log error di `storage/logs/laravel.log`

---

### 🔧 Troubleshooting Umum

#### Error 500 - Internal Server Error
```bash
# Cek log error
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Pastikan permission folder
chmod -R 775 storage bootstrap/cache
```

#### Upload File Gagal
```bash
# Buat symlink storage
php artisan storage:link

# Cek permission
chmod -R 775 storage/app/public

# Update .env
FILESYSTEM_DISK=public
```

#### Database Error
```bash
# Cek koneksi database di .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

# Migrate database
php artisan migrate

# Fresh install (HATI-HATI: menghapus semua data)
php artisan migrate:fresh --seed
```

#### Peta Tidak Load
1. Cek koneksi internet
2. Buka browser console (F12) untuk lihat error
3. Pastikan koordinat valid (format: -6.xxx, 113.xxx)
4. Clear browser cache

---

### 📞 Bantuan Lebih Lanjut

**Kontak Teknis**:
- Email: support@desaambuntentengah.id
- WhatsApp: 08xx-xxxx-xxxx
- Jam Kerja: Senin-Jumat, 08:00-16:00 WIB

**Dokumentasi Laravel**:
- https://laravel.com/docs

**Dokumentasi Leaflet.js**:
- https://leafletjs.com/reference.html

---

## 📝 Catatan Penting

### Keamanan
- ✅ Ubah password default admin
- ✅ Gunakan password kuat (min. 8 karakter, kombinasi huruf, angka, simbol)
- ✅ Jangan share kredensial login
- ✅ Logout setelah selesai menggunakan admin panel
- ✅ Backup database secara berkala

### Backup Data
```bash
# Backup database
mysqldump -u root -p nama_database > backup_$(date +%Y%m%d).sql

# Backup files
tar -czf backup_files_$(date +%Y%m%d).tar.gz storage/ public/storage/
```

### Update Website
```bash
# Pull update dari repository
git pull origin main

# Update dependencies
composer install
npm install && npm run build

# Migrate database
php artisan migrate

# Clear cache
php artisan optimize:clear
```

---

## 🎯 Best Practices

### Untuk Admin
1. Update berita minimal 2x seminggu
2. Tanggapi pengaduan maksimal 2x24 jam
3. Verifikasi data warga setiap bulan
4. Backup database setiap minggu
5. Update foto galeri setiap ada kegiatan
6. Cek statistik dashboard setiap hari

### Untuk Maintenance
1. Monitor disk space server
2. Cek error log harian
3. Update Laravel security patch
4. Optimize database query
5. Compress uploaded images
6. Set up auto backup

---

## 📊 Statistik & Monitoring

### Melihat Performa Website
1. Akses: Admin → Dashboard
2. Lihat widget statistik
3. Monitor waktu loading halaman
4. Cek penggunaan bandwidth

### Database Optimization
```bash
# Optimize database tables
php artisan db:optimize

# Clear old logs
php artisan log:clear

# Clear old sessions
php artisan session:gc
```

---

**Versi**: 1.0
**Terakhir Diupdate**: 10 Januari 2026
**Developer**: Tim KKN Unija 2025

---

*Dokumen ini akan diupdate sesuai pengembangan fitur baru.*
