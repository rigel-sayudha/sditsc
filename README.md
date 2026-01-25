# SD IT Semesta Cendekia / 🎓 Sistem PPDB SD IT Cendekia

Aplikasi web profile SD IT Semesta Cendekia dan sistem Penerimaan Peserta Didik Baru (PPDB) untuk SD IT Cendekia — platform pendaftaran online yang mudah dan efisien.

## 🌟 Fitur Utama

### 👥 Untuk Calon Siswa & Orang Tua
- **Pendaftaran Online**: Formulir pendaftaran multi-step yang user-friendly
- **Upload Dokumen**: Upload foto, KTP, KK, dan dokumen pendukung lainnya
- **Pemilihan Jadwal Tes**: Pilih jadwal tes yang tersedia sesuai kapasitas
- **Status Real-time**: Cek status pendaftaran secara real-time
- **Draft System**: Simpan dan lanjutkan pendaftaran kapan saja
- **Validasi Otomatis**: Validasi NIK otomatis untuk mencegah duplikasi

### 👨‍💼 Panel Administrator
- **Dashboard Lengkap**: Overview statistik pendaftaran dan data penting
- **Manajemen Pendaftar**: Kelola semua data pendaftaran dengan mudah
- **Jadwal Tes**: Atur jadwal tes dan kapasitas peserta
- **Export Data**: Export data ke Excel untuk analisis lebih lanjut
- **Galeri & Konten**: Kelola konten website dan galeri foto
- **Sistem Pengguna**: Manajemen user dan hak akses

### 🌐 Website Publik
- **Profil Sekolah**: Informasi lengkap tentang SD IT Cendekia
- **Berita & Artikel**: Update terbaru dan informasi penting
- **Galeri Foto**: Dokumentasi kegiatan sekolah
- **Kontak & Lokasi**: Informasi kontak dan alamat sekolah
- **Responsive Design**: Tampilan optimal di semua perangkat

## 🛠️ Teknologi

- **Backend**: Laravel 10.x (PHP 8.1+)
- **Frontend**: Tailwind CSS, Alpine.js
- **Database**: MySQL 8.0+
- **File Storage**: Laravel Storage (Local/Cloud)
- **Authentication**: Laravel Sanctum
- **PDF Generation**: DomPDF
- **Excel Export**: Maatwebsite Excel

## 📋 Prasyarat

- PHP 8.1 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL 8.0+
- Web Server (Apache/Nginx)

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone [repository-url]
cd sditcendekia
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```

### 4. Setup Database

```bash
# Jalankan migrasi database
php artisan migrate

# (Opsional) Jalankan seeder untuk data awal
php artisan db:seed
```

### 5. Menjalankan Aplikasi

```bash
# Jalankan development server
php artisan serve

# Aplikasi akan berjalan di http://localhost:8000
```

## Akses Admin

Gunakan kredensial berikut untuk login ke dashboard admin:
- URL: `/admin/login`
- Email: admin@admin.com
- Password: password

## Struktur Modul

1. **Profil Sekolah**
   - Sambutan Kepala Sekolah
   - Visi & Misi
   - Struktur Organisasi
   - Berita/Artikel
   - Galeri

2. **PPDB Online**
   - Pendaftaran Siswa Baru
   - Form Data Diri
   - Upload Dokumen (KK & Akta)
   - Pemilihan Jadwal Tes
   - Status Pendaftaran

3. **Admin Panel**
   - Manajemen Pendaftaran
   - Verifikasi Dokumen
   - Pengaturan Jadwal Tes
   - Manajemen Konten Website

## Fitur Utama

### PPDB Online
- Form pendaftaran multi-step
- Upload dokumen persyaratan
- Perhitungan usia otomatis
- Status rekomendasi PIP berdasarkan penghasilan orang tua
- Sistem kuota jadwal tes (20 siswa per hari)
- Notifikasi sisa kuota

### Admin Panel
- Dashboard admin dengan leaderboard
- Manajemen data pendaftar
- Pengaturan kuota tes
- Pengelolaan konten website
- Cetak laporan pendaftaran

### Struktur Database

Tabel Utama:
- registrations: Data pendaftaran siswa
- registration_points: Sistem poin pendaftaran
- registration_answers: Jawaban form pendaftaran
- articles: Berita & pengumuman sekolah
- struktur_organisasis: Data struktur organisasi

## Teknologi yang Digunakan

- Laravel 10
- Tailwind CSS
- Alpine.js
- MySQL
- Git

## Maintenance

### Update Dependencies

```bash
# Update composer dependencies
composer update

# Update npm packages
npm update
```

### Backup Database

```bash
# Export database
php artisan db:backup
```

### Clear Cache

```bash
# Clear application cache
php artisan cache:clear

# Clear view cache
php artisan view:clear

# Clear config cache
php artisan config:clear
```

## Troubleshooting

### Issue: Permission Denied
```bash
# Set permission untuk storage dan bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### Issue: Database Connection Error
1. Periksa konfigurasi database di `.env`
2. Pastikan service MySQL berjalan
3. Cek kredensial database

### Issue: Asset Not Found
```bash
# Rebuild assets
npm run build
```

## Kontribusi

1. Fork repository
2. Buat branch baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -am 'Menambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## Lisensi

[MIT License](LICENSE.md)

## Support

Jika ada pertanyaan atau kendala, silakan buat issue di repository ini atau hubungi maintainer:
- GitHub: [@rigel-sayudha](https://github.com/rigel-sayudha)
