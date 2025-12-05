# Website Informasi Desa dengan CMS

Website informasi desa modern dengan custom CMS yang dibangun menggunakan Laravel 11 dan Tailwind CSS. Website ini dilengkapi dengan fitur berita, pengaduan masyarakat, pemetaan lokasi, dan galeri.

## 🚀 Fitur Utama

### Frontend (Website Publik)
- ✨ **Beranda Modern** - Landing page dengan statistik desa dan pengumuman
- 📰 **Berita & Pengumuman** - Sistem berita dengan kategori
- 📝 **Pengaduan Masyarakat** - Form pengaduan dengan tracking status
- 🗺️ **Peta Interaktif** - Pemetaan lokasi penting menggunakan Leaflet.js
- 📸 **Galeri Foto** - Galeri dengan lightbox
- 📱 **Responsive Design** - Tampilan optimal di semua perangkat
- 🎨 **UI/UX Modern** - Menggunakan Tailwind CSS dengan animasi Alpine.js

### Backend (CMS Admin)
- 🔐 **Authentication** - Login sistem untuk admin
- 📊 **Dashboard** - Statistik dan overview
- 📝 **Manajemen Berita** - CRUD berita dan pengumuman
- 💬 **Manajemen Pengaduan** - Tanggapi dan update status pengaduan
- 📍 **Manajemen Peta** - Kelola lokasi di peta desa
- 🖼️ **Manajemen Galeri** - Upload dan kelola foto
- ⚙️ **Pengaturan Website** - Konfigurasi informasi desa dan upload gambar

## 📋 Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL >= 5.7 atau MariaDB
- Git

## 🛠️ Instalasi

### 1. Clone atau Copy Project
```bash
cd /home/balzak/Documents/web1/laravel
```

### 2. Install Dependencies PHP
```bash
composer install
```

### 3. Install Dependencies JavaScript
```bash
npm install
```

### 4. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Konfigurasi Database
Edit file `.env` dan sesuaikan dengan database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_database
DB_PASSWORD=password_database
```

### 6. Buat Database
Buat database baru di MySQL:
```sql
CREATE DATABASE nama_database_anda CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7. Jalankan Migration dan Seeder
```bash
php artisan migrate --seed
```

Perintah ini akan:
- Membuat semua tabel yang diperlukan
- Membuat user admin default
- Mengisi pengaturan website awal

### 8. Setup Storage Link
```bash
php artisan storage:link
```

Perintah ini membuat symbolic link dari `public/storage` ke `storage/app/public` agar gambar yang diupload dapat diakses.

### 9. Build Assets
```bash
npm run build
```

Untuk development dengan auto-reload:
```bash
npm run dev
```

### 10. Jalankan Server
```bash
php artisan serve
```

Website akan berjalan di: `http://localhost:8000`

## 🔑 Login Admin

Setelah instalasi, Anda bisa login ke CMS admin dengan:

- **URL**: `http://localhost:8000/login`
- **Email**: `admin@desa.id`
- **Password**: `password123`

⚠️ **PENTING**: Ganti password default setelah login pertama!

## 📂 Struktur File Penting

### Controllers
- `app/Http/Controllers/BerandaController.php` - Halaman beranda
- `app/Http/Controllers/BeritaController.php` - Manajemen berita
- `app/Http/Controllers/PengaduanController.php` - Sistem pengaduan
- `app/Http/Controllers/PetaController.php` - Pemetaan lokasi
- `app/Http/Controllers/GaleriController.php` - Galeri foto
- `app/Http/Controllers/PengaturanController.php` - Pengaturan website
- `app/Http/Controllers/AdminController.php` - Dashboard admin

### Models
- `app/Models/Berita.php` - Model berita
- `app/Models/Pengaduan.php` - Model pengaduan
- `app/Models/Peta.php` - Model lokasi peta
- `app/Models/Galeri.php` - Model galeri
- `app/Models/Pengaturan.php` - Model pengaturan

### Views
- `resources/views/beranda.blade.php` - Halaman depan
- `resources/views/berita/` - Views berita
- `resources/views/pengaduan/` - Views pengaduan
- `resources/views/peta/` - Views peta
- `resources/views/galeri/` - Views galeri
- `resources/views/admin/` - Views CMS admin
- `resources/views/layouts/app.blade.php` - Layout frontend
- `resources/views/admin/layouts/app.blade.php` - Layout admin

## 🖼️ Panduan Upload Gambar

### Penempatan Gambar
Semua gambar yang diupload melalui CMS akan disimpan di:
```
storage/app/public/
├── berita/          # Gambar berita
├── pengaduan/       # Gambar pengaduan
├── peta/           # Gambar lokasi peta
├── galeri/         # Galeri foto
└── pengaturan/     # Banner, logo, dll
```

### Rekomendasi Ukuran Gambar

#### Banner Depan
- **Lokasi**: Pengaturan → Banner Depan
- **Ukuran**: 1920x600 px (ratio 16:5)
- **Format**: JPG, PNG, WebP
- **Maksimal**: 2MB

#### Logo Desa
- **Lokasi**: Pengaturan → Logo Desa
- **Ukuran**: 200x200 px
- **Format**: PNG (dengan background transparan)
- **Maksimal**: 1MB

#### Gambar Berita
- **Ukuran**: 1200x600 px
- **Format**: JPG, PNG, WebP
- **Maksimal**: 2MB

#### Foto Galeri
- **Ukuran**: 1200x800 px atau lebih
- **Format**: JPG, PNG, WebP
- **Maksimal**: 2MB

### Cara Mengganti Banner Depan
1. Login ke CMS Admin
2. Buka menu **Pengaturan**
3. Scroll ke bagian "Umum"
4. Cari field **Banner Depan**
5. Klik area upload
6. Pilih gambar (1920x600px rekomendasi)
7. Klik **Simpan Pengaturan**
8. Banner baru akan langsung tampil di halaman depan

## 🔧 Konfigurasi

### Pengaturan Website
Akses melalui: **Admin Panel → Pengaturan**

Anda dapat mengatur:
- Nama Desa
- Informasi Kontak
- Banner & Logo
- Statistik Desa (Jumlah Penduduk, KK, RT, RW)
- Media Sosial

### Koordinat Peta Default
Edit di `resources/views/peta/index.blade.php` line 80:
```javascript
const defaultLat = -6.2088;  // Ganti dengan latitude desa Anda
const defaultLng = 106.8456; // Ganti dengan longitude desa Anda
```

## 📝 Penggunaan CMS

### Menambah Berita
1. Login ke Admin Panel
2. Klik menu **Berita**
3. Klik **Tambah Berita**
4. Isi form:
   - Judul
   - Konten
   - Upload gambar
   - Pilih kategori (Berita/Pengumuman)
   - Set tanggal publikasi
   - Centang "Tampilkan di website"
5. Klik **Simpan Berita**

### Mengelola Pengaduan
1. Login ke Admin Panel
2. Klik menu **Pengaduan**
3. Klik pengaduan yang ingin ditanggapi
4. Update status (Pending/Proses/Selesai)
5. Isi tanggapan
6. Klik **Update Status**

### Menambah Lokasi di Peta
1. Login ke Admin Panel
2. Klik menu **Peta**
3. Klik **Tambah Lokasi**
4. Isi informasi lokasi
5. Masukkan koordinat (latitude & longitude)
   - Tip: Gunakan Google Maps untuk mendapatkan koordinat
6. Pilih kategori
7. Upload gambar (opsional)
8. Klik **Simpan Lokasi**

## 🎨 Customization

### Warna Theme
Edit di `resources/css/app.css` atau langsung di views dengan Tailwind classes.

### Menambah Field Pengaturan Baru
1. Buat migration baru atau edit seeder
2. Tambahkan entry di `PengaturanSeeder.php`
3. Jalankan `php artisan db:seed --class=PengaturanSeeder`

## 🐛 Troubleshooting

### Gambar tidak muncul
```bash
php artisan storage:link
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### Error 500 setelah upload
Cek permission folder storage:
```bash
sudo chown -R www-data:www-data storage/
sudo chmod -R 775 storage/
```

### CSS tidak muncul
```bash
npm run build
php artisan optimize:clear
```

### Database connection error
- Pastikan MySQL/MariaDB sudah running
- Cek konfigurasi `.env`
- Cek user database memiliki privilege yang cukup

## 📦 Production Deployment

### 1. Optimasi
```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Security
- Ganti APP_KEY di `.env`
- Set `APP_ENV=production`
- Set `APP_DEBUG=false`
- Ganti password admin default
- Setup HTTPS/SSL
- Aktifkan firewall

### 3. Backup
Backup rutin:
- Database
- Folder `storage/app/public/`
- File `.env`

## 📱 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## 🤝 Support

Untuk bantuan atau pertanyaan:
- Baca dokumentasi di atas
- Check error logs di `storage/logs/`
- Review konfigurasi `.env`

## 📄 License

Project ini dibuat untuk kebutuhan website desa. Silakan dimodifikasi sesuai kebutuhan.

---

**Dibuat dengan ❤️ menggunakan Laravel 11 & Tailwind CSS**
