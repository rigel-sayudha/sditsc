# 🚀 PANDUAN MENJALANKAN PROJECT SDITCENDEKIA

## ✅ **STATUS PROJECT: READY TO RUN**

Project Laravel SDITCendekia sudah dikompilasi dan siap dijalankan!

## 🎯 **QUICK START (PILIH SALAH SATU)**

### **Option 1: Development Server (Terminal Terpisah)**

**Terminal 1 - Run Laravel Server:**
```bash
cd d:\laravel\sditcendekia
php artisan serve
```
✅ Server akan jalan di: `http://localhost:8000`

**Terminal 2 - Run Asset Compilation (Optional):**
```bash
cd d:\laravel\sditcendekia
npm run dev
```
✅ Asset akan auto-compile saat Anda edit CSS/JS

---

### **Option 2: Production Build (Single Terminal)**

```bash
cd d:\laravel\sditcendekia
php artisan serve
```

Untuk production, asset sudah di-compile. Akses di:
- **Local**: `http://localhost:8000`
- **Online**: `https://sditsemestacendekia.sch.id`

---

## 📋 **SYSTEM REQUIREMENTS**

✅ **PHP**: 8.1+
✅ **MySQL**: 5.7+
✅ **Node.js**: 14+ (untuk npm)
✅ **Composer**: Latest

---

## 🔧 **SETUP YANG SUDAH DILAKUKAN**

### ✅ **Database:**
- [x] Migration selesai
- [x] Users table dengan avatar column
- [x] All tables ready

### ✅ **Dependencies:**
- [x] Composer packages installed
- [x] npm packages installed
- [x] Vite configured

### ✅ **Configuration:**
- [x] .env file configured
- [x] APP_KEY generated
- [x] Database connection tested

### ✅ **Features Ready:**
- [x] Login/Logout dengan SweetAlert
- [x] Admin Dashboard
- [x] Edit Profile Admin
- [x] Upload Image CRUD
- [x] Pendaftaran Siswa
- [x] Manajemen Artikel
- [x] Gallery Management

---

## 📊 **PORT YANG DIGUNAKAN**

| Layanan | Port | URL |
|---------|------|-----|
| Laravel Server | 8000 | http://localhost:8000 |
| Vite Dev Server | 5173 | http://localhost:5173 |
| MySQL | 3306 | localhost:3306 |

---

## 👤 **DEFAULT LOGIN CREDENTIALS**

**Admin Account:**
- **Email**: admin@example.com
- **Password**: password

**Database:** `sditcendekia`

---

## 🎯 **FITUR UTAMA PROJECT**

### **1. Authentication System**
- ✅ Login/Register
- ✅ Logout dengan SweetAlert
- ✅ Session Management
- ✅ Password Reset

### **2. Admin Dashboard**
- ✅ Profile Management
- ✅ Upload Avatar
- ✅ Edit Data Admin
- ✅ Change Password

### **3. Content Management**
- ✅ Manajemen Berita/Artikel
- ✅ Upload Gambar
- ✅ Gallery Management
- ✅ Poster Management

### **4. Pendaftaran Siswa**
- ✅ Multi-step Form
- ✅ Validasi Data
- ✅ File Upload KK & Akta
- ✅ Status Tracking

### **5. Frontend**
- ✅ Homepage
- ✅ Profile Sekolah
- ✅ Berita/Artikel
- ✅ Gallery
- ✅ Kontak

---

## 🐛 **TROUBLESHOOTING**

### **Error: Port 8000 already in use**
```bash
# Gunakan port lain
php artisan serve --port=8001
```

### **Error: Database connection failed**
```bash
# Check .env file
# Pastikan DB_HOST, DB_USER, DB_PASSWORD benar
php artisan migrate
```

### **Error: Assets tidak load**
```bash
# Compile ulang assets
npm run build
```

### **Error: Permission denied untuk storage**
```bash
# Fix permissions
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

---

## 📱 **AKSES APLIKASI**

### **Homepage:**
```
http://localhost:8000/
```

### **Admin Dashboard:**
```
http://localhost:8000/admin
```
Login dengan kredensial admin

### **Pendaftaran:**
```
http://localhost:8000/pendaftaran
```

### **Profile:**
```
http://localhost:8000/admin/profile
```

---

## 🔄 **WORKFLOW DEVELOPMENT**

### **1. Start Servers:**
```bash
# Terminal 1
cd d:\laravel\sditcendekia
php artisan serve

# Terminal 2
cd d:\laravel\sditcendekia
npm run dev
```

### **2. Edit Files:**
- Edit blade files di `resources/views/`
- Edit CSS di `resources/css/`
- Edit JS di `resources/js/`

### **3. Auto Reload:**
- Vite akan auto-compile CSS/JS
- Browser akan auto-refresh (hot reload)

### **4. Test Features:**
- Buka browser ke `http://localhost:8000`
- Test login/logout
- Test upload file
- Test form submission

---

## 📦 **PROJECT STRUCTURE**

```
sditcendekia/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php
│   │   ├── Auth/LoginController.php
│   │   └── ...
│   ├── Models/
│   │   ├── User.php
│   │   ├── Article.php
│   │   └── ...
│   └── ...
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── ...
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── layouts/
│   │   └── ...
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   ├── api.php
│   └── ...
├── storage/
│   ├── app/public/
│   └── logs/
├── public/
│   ├── index.php
│   ├── storage/ (symlink)
│   └── ...
├── .env
├── composer.json
├── package.json
└── vite.config.js
```

---

## ✅ **QUICK CHECKLIST SEBELUM RUN**

- [x] PHP 8.1+ installed
- [x] MySQL running
- [x] Composer dependencies installed
- [x] npm packages installed
- [x] .env file configured
- [x] Database migrated
- [x] Storage symlink created
- [x] Assets compiled

---

## 🎉 **PROJECT SIAP DIJALANKAN!**

**Jalankan command di bawah untuk mulai development:**

```bash
cd d:\laravel\sditcendekia
php artisan serve
```

**Kemudian buka di browser:**
```
http://localhost:8000
```

**Atau jika sudah online:**
```
https://sditsemestacendekia.sch.id
```

---

## 📞 **SUPPORT**

Jika ada error atau issue saat menjalankan project:

1. Check terminal output untuk error message
2. Cek file `storage/logs/laravel.log` untuk detailed error
3. Run `php artisan migrate --force` jika database belum ter-setup
4. Clear cache: `php artisan cache:clear`

**Project sudah siap dan berfungsi 100%!** 🚀