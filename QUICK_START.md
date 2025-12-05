# 🚀 Quick Start Guide - Website Desa

## ✅ Setup Sudah Selesai!

Website informasi desa dengan CMS sudah siap digunakan. Berikut cara untuk memulai:

## 🏃 Langkah Cepat

### 1. Jalankan Development Server

```bash
cd /home/balzak/Documents/web1/laravel
php artisan serve
```

Website akan berjalan di: **http://localhost:8000**

### 2. Login ke Admin Panel

- URL: http://localhost:8000/login
- Email: `admin@desa.id`
- Password: `password123`

⚠️ **PENTING**: Ganti password setelah login pertama!

## 📋 Yang Sudah Dibuat

### ✅ Database
- [x] Tabel users
- [x] Tabel berita
- [x] Tabel pengaduan
- [x] Tabel peta
- [x] Tabel galeri
- [x] Tabel pengaturan
- [x] User admin default
- [x] Pengaturan awal website

### ✅ Frontend (Website Publik)
- [x] Halaman Beranda - http://localhost:8000/
- [x] Halaman Berita - http://localhost:8000/berita
- [x] Halaman Detail Berita
- [x] Form Pengaduan - http://localhost:8000/pengaduan
- [x] Tracking Pengaduan - http://localhost:8000/pengaduan/lacak
- [x] Peta Interaktif - http://localhost:8000/peta
- [x] Galeri Foto - http://localhost:8000/galeri

### ✅ Backend (CMS Admin)
- [x] Dashboard - http://localhost:8000/admin/dashboard
- [x] Manajemen Berita
- [x] Manajemen Pengaduan
- [x] Manajemen Peta
- [x] Manajemen Galeri
- [x] Pengaturan Website

## 🎯 Langkah Selanjutnya

### 1. Konfigurasi Informasi Desa (WAJIB)
1. Login ke admin panel
2. Buka menu **Pengaturan**
3. Isi data desa:
   - Nama desa
   - Alamat lengkap
   - Kontak (telepon, email)
   - Statistik (jumlah penduduk, KK, RT, RW)

### 2. Upload Banner Depan (RECOMMENDED)
1. Di menu **Pengaturan**
2. Cari field "Banner Depan"
3. Upload gambar (Rekomendasi: 1920x600px)
4. Simpan

### 3. Upload Logo Desa (RECOMMENDED)
1. Di menu **Pengaturan**
2. Cari field "Logo Desa"
3. Upload logo (Rekomendasi: 200x200px PNG transparan)
4. Simpan

### 4. Buat Konten Pertama
- Tambah berita/pengumuman pertama
- Upload foto ke galeri
- Tambah lokasi penting di peta

## 📍 Konfigurasi Koordinat Peta

Edit file: `resources/views/peta/index.blade.php`

Cari baris 80 dan ganti dengan koordinat desa Anda:
```javascript
const defaultLat = -6.2088;  // Latitude desa Anda
const defaultLng = 106.8456; // Longitude desa Anda
```

**Cara mendapatkan koordinat:**
1. Buka Google Maps
2. Klik kanan pada lokasi desa
3. Copy koordinat yang muncul

## 🖼️ Panduan Upload Gambar

### Banner Depan
- **Ukuran**: 1920x600px
- **Format**: JPG/PNG/WebP
- **Lokasi**: Menu Pengaturan
- **Tip**: Gunakan gambar landscape yang menarik

### Logo Desa
- **Ukuran**: 200x200px
- **Format**: PNG (background transparan)
- **Lokasi**: Menu Pengaturan

### Gambar Berita
- **Ukuran**: 1200x600px
- **Format**: JPG/PNG/WebP
- **Lokasi**: Form tambah/edit berita

### Foto Galeri
- **Ukuran**: Minimal 1200x800px
- **Format**: JPG/PNG/WebP
- **Lokasi**: Menu Galeri

## 🔧 Command Yang Berguna

### Development
```bash
# Jalankan server
php artisan serve

# Build assets (jika ada perubahan CSS/JS)
npm run build

# Development dengan auto-reload
npm run dev
```

### Database
```bash
# Reset database (HATI-HATI: Menghapus semua data!)
php artisan migrate:fresh --seed

# Jalankan seeder saja
php artisan db:seed
```

### Cache
```bash
# Clear semua cache
php artisan optimize:clear

# Clear view cache
php artisan view:clear

# Clear config cache
php artisan config:clear
```

## 📱 Fitur Website

### Untuk Masyarakat
- ✅ Lihat berita dan pengumuman terbaru
- ✅ Submit pengaduan online
- ✅ Track status pengaduan via email
- ✅ Lihat peta lokasi penting desa
- ✅ Browse galeri foto kegiatan

### Untuk Admin
- ✅ Kelola berita dan pengumuman
- ✅ Tanggapi pengaduan masyarakat
- ✅ Update peta lokasi
- ✅ Upload foto galeri
- ✅ Konfigurasi website

## 🎨 Customisasi

### Ganti Warna Theme
Edit: `resources/css/app.css`

### Tambah Menu
Edit: `resources/views/layouts/app.blade.php`

### Ganti Footer
Edit: `resources/views/layouts/app.blade.php` (bagian footer)

## 🔒 Security Checklist

- [ ] Ganti password admin default
- [ ] Update .env dengan data yang benar
- [ ] Set APP_DEBUG=false di production
- [ ] Aktifkan HTTPS di production
- [ ] Setup backup database rutin
- [ ] Backup folder storage/app/public/

## 📞 Troubleshooting

### Gambar tidak muncul
```bash
php artisan storage:link
chmod -R 755 storage/
```

### CSS/JS tidak muncul
```bash
npm run build
php artisan optimize:clear
```

### Error 500
Cek log di: `storage/logs/laravel.log`

## 📚 Dokumentasi Lengkap

Baca file `README_DESA.md` untuk dokumentasi detail dan lengkap.

---

**Website siap digunakan! 🎉**

Jika ada pertanyaan, cek dokumentasi atau log error di `storage/logs/`.
