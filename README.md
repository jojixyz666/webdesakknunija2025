<div align="center">

# 🏘️ Website Desa Ambunten Tengah

<p align="center">
  <img src="https://img.shields.io/badge/Status-Dalam%20Tahap%20Pengembangan-yellow?style=for-the-badge" alt="Status">
  <img src="https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/Tailwind%20CSS-4.0-38bdf8?style=for-the-badge&logo=tailwind-css" alt="Tailwind">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php" alt="PHP">
</p>

### 📋 Program Kerja KKN
**Universitas Wiraraja Sumenep 2025**

---

## 🎯 Tentang Proyek

Website informasi desa modern yang dikembangkan sebagai bagian dari Program Kerja **Kuliah Kerja Nyata (KKN) Universitas Wiraraja Sumenep 2025**. Platform ini dirancang untuk meningkatkan transparansi, aksesibilitas informasi, dan pelayanan digital kepada masyarakat Desa Ambunten Tengah.

### ✨ Fitur Utama

- 🏠 **Portal Informasi Desa** - Profil lengkap dan statistik desa
- 📰 **Berita & Pengumuman** - Update terkini kegiatan desa
- 📝 **Sistem Pengaduan** - Saluran aspirasi masyarakat dengan tracking status
- 🗺️ **Peta Interaktif** - Visualisasi wilayah dan fasilitas desa
- 🖼️ **Galeri Kegiatan** - Dokumentasi visual kegiatan desa
- 🎨 **CMS Admin** - Panel admin untuk pengelolaan konten
- 📱 **Responsive Design** - Optimal di semua perangkat
- 🎭 **Modern UI/UX** - Antarmuka yang intuitif dan menarik

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Versi | Kegunaan |
|-----------|-------|----------|
| **Laravel** | 12.x | PHP Framework |
| **Tailwind CSS** | 4.0 | Styling & Design |
| **Alpine.js** | 3.x | Interaktivitas |
| **Leaflet.js** | 1.9.4 | Peta Interaktif |
| **MySQL** | 8.x | Database |
| **Vite** | 7.x | Asset Bundler |

---

## 🚀 Quick Start

### Prasyarat
```bash
PHP >= 8.4
Composer
Node.js & NPM
MySQL
```

### Instalasi

1️⃣ **Clone Repository**
```bash
git clone https://github.com/jojixyz666/webdesakknunija2025.git
cd webdesakknunija2025
```

2️⃣ **Install Dependencies**
```bash
composer install
npm install
```

3️⃣ **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4️⃣ **Konfigurasi Database**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desa_db
DB_USERNAME=root
DB_PASSWORD=
```

5️⃣ **Migrasi & Seeding**
```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

6️⃣ **Build Assets**
```bash
npm run build
```

7️⃣ **Jalankan Server**
```bash
php artisan serve
```

Akses: `http://localhost:8000`

### 🔐 Login Admin
```
Email: admin@desa.id
Password: password123
```

---

## 📁 Struktur Fitur

### 🎯 Portal Publik
- Hero banner dengan statistik desa
- Berita & pengumuman terbaru
- Formulir pengaduan online
- Peta wilayah interaktif
- Galeri foto & video

### ⚙️ Panel Admin
- Dashboard dengan statistik
- Manajemen berita & pengumuman
- Pengelolaan pengaduan
- Upload & manage galeri
- Konfigurasi peta lokasi
- Pengaturan website

---

## 🎨 Fitur Unggulan

### 📊 Statistik Real-time
Menampilkan data kependudukan, jumlah RT/RW, dan informasi demografi lainnya secara dinamis.

### 🔍 Tracking Pengaduan
Masyarakat dapat melacak status pengaduan mereka dengan sistem nomor tiket unik.

### 🗺️ Peta Interaktif
Visualisasi lokasi-lokasi penting di desa menggunakan Leaflet.js dengan marker custom.

### 📱 Mobile Responsive
Tampilan optimal di berbagai ukuran layar (desktop, tablet, smartphone).

---

## 👥 Tim Pengembang

**KKN Universitas Wiraraja Sumenep 2025**
- JOICE HIELMAN ABBRORI

---

## 📝 Lisensi

Proyek ini dikembangkan untuk kepentingan publik dan pengabdian masyarakat dalam rangka Program KKN Universitas Wiraraja Sumenep 2025.

---

## 🤝 Kontribusi

Proyek ini merupakan bagian dari program KKN. Untuk saran dan masukan, silakan hubungi:
- **Email**: hielmanabbrori@gmail.com
- **Website**: [Coming Soon]

---

## 📌 Status Pengembangan

⚠️ **DALAM TAHAP PENGEMBANGAN**

Proyek ini sedang dalam tahap pengembangan aktif. Beberapa fitur mungkin belum lengkap atau masih dalam proses penyempurnaan.

### Roadmap
- [x] Desain UI/UX
- [x] Sistem Autentikasi
- [x] CRUD Berita & Pengumuman
- [x] Sistem Pengaduan
- [x] Peta Interaktif
- [x] Galeri
- [ ] Notifikasi Email
- [ ] Export Laporan
- [ ] Integrasi API Pemerintah
- [ ] Sistem Surat Online

---

<div align="center">

**Dikembangkan dengan ❤️ untuk Desa Ambunten Tengah**

*KKN Universitas Wiraraja Sumenep 2025*

[![GitHub](https://img.shields.io/badge/GitHub-Repository-black?style=for-the-badge&logo=github)](https://github.com/jojixyz666/webdesakknunija2025)

</div>

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).