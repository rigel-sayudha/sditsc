# 🔐 PANDUAN LOGIN ADMIN - STEP BY STEP

## 🚀 **LANGKAH 1: BUKA BROWSER**

Buka browser favorit Anda (Chrome, Firefox, Safari, Edge) dan buka URL:

```
http://localhost:8000/admin
```

---

## 📝 **LANGKAH 2: LIHAT LOGIN PAGE**

Anda akan melihat halaman login dengan form berikut:
- Email input field
- Password input field
- "Login" button
- Link "Kembali ke Beranda"

---

## 👤 **LANGKAH 3: MASUKKAN CREDENTIALS**

### **Masukkan Email:**
```
admin@example.com
```

### **Masukkan Password:**
```
password
```

---

## ✅ **LANGKAH 4: KLIK LOGIN**

Klik button "Login" dan tunggu proses autentikasi.

---

## 🎯 **HASIL YANG DIHARAPKAN**

Setelah login berhasil, Anda akan:
1. ✅ Redirect ke Admin Dashboard
2. ✅ Melihat navbar dengan menu admin
3. ✅ Profile admin ditampilkan
4. ✅ Melihat tombol "Logout" di navbar

---

## 📊 **ADMIN DASHBOARD FEATURES**

Setelah login, Anda bisa mengakses:

### **1. 👤 Profil Admin** (`/admin/profile`)
- Edit nama, email, password
- Upload foto profil
- Update informasi personal

### **2. 📰 Manajemen Artikel** (`/admin/articles`)
- Lihat daftar artikel
- Tambah artikel baru
- Edit artikel
- Hapus artikel
- Upload gambar artikel

### **3. 🖼️ Gallery** (`/admin/gallery`)
- Manage foto gallery sekolah
- Upload foto
- Delete foto

### **4. 📝 Sambutan** (`/admin/sambutan`)
- Edit sambutan kepala sekolah
- Upload foto kepala sekolah

### **5. 📋 Pendaftaran**
- View pendaftaran siswa
- Approve/reject registrasi
- Download data pendaftaran

---

## 🔒 **TROUBLESHOOTING**

### **Error: Email tidak ditemukan**
- Pastikan email benar: `admin@example.com`
- Cek database apakah user sudah ada

### **Error: Password salah**
- Pastikan password benar: `password`
- Password case-sensitive!

### **Error: Server error 500**
- Cek file `storage/logs/laravel.log`
- Pastikan database connected
- Run `php artisan migrate`

### **Halaman blank/tidak load**
- Clear cache browser (Ctrl+Shift+Del)
- Try incognito/private mode
- Cek console (F12) untuk JS errors

---

## 🔄 **JIKA INGIN LOGOUT**

1. Klik tombol **"Logout"** di navbar kanan atas
2. Lihat confirmation popup SweetAlert
3. Klik **"Ya, Logout"**
4. Lihat toast success notification
5. Redirect ke homepage

---

## 🎯 **QUICK ADMIN ACTIONS**

Setelah login, Anda bisa langsung:

### **1. Ubah Profile**
```
Klik: Profil di navbar
Upload: Foto baru
Edit: Nama/Email/Password
Click: Simpan Perubahan
```

### **2. Tambah Artikel Baru**
```
Klik: Manajemen Artikel
Click: Tambah Artikel
Fill: Title, content, kategori
Upload: Gambar artikel
Click: Simpan
```

### **3. Lihat Pendaftaran Siswa**
```
Klik: Pendaftaran (di menu)
View: List pendaftaran siswa
Check: Data yang disubmit
Accept/Reject: Status pendaftaran
```

---

## 📱 **RESPONSIVE INTERFACE**

Admin panel sudah responsive untuk:
- ✅ Desktop (1920x1080)
- ✅ Tablet (768x1024)
- ✅ Mobile (375x667)

---

## 🔐 **SECURITY NOTES**

- ✅ Password di-hash dengan bcrypt
- ✅ Session management aman
- ✅ CSRF protection enabled
- ✅ Auto-logout jika inactive
- ✅ Avatar upload validation

---

## 📚 **ADMIN MENU STRUCTURE**

```
Admin Dashboard
├── 📊 Dashboard
├── 👤 Profil Admin
│   └─ Edit Informasi
│   └─ Upload Avatar
├── 📰 Manajemen Artikel
│   └─ Lihat Artikel
│   └─ Tambah Artikel
│   └─ Edit Artikel
│   └─ Hapus Artikel
├── 🖼️ Gallery
│   └─ Manage Foto
├── 📝 Sambutan
│   └─ Edit Sambutan
├── 📋 Pendaftaran
│   └─ View Pendaftaran
│   └─ Approve/Reject
└── 🚪 Logout
```

---

## ✨ **FITUR UI/UX ADMIN**

- ✅ Dark-aware sidebar
- ✅ Responsive navbar
- ✅ SweetAlert notifications
- ✅ Loading states
- ✅ Form validation
- ✅ Image preview
- ✅ Quick actions
- ✅ Mobile menu

---

## 🎉 **SELAMAT MENCOBA ADMIN PANEL!**

Sudah siap? Mari kita mulai:

```bash
1. Buka: http://localhost:8000/admin
2. Email: admin@example.com
3. Password: password
4. Klik: Login
5. Explore: Admin Features
```

**Happy Admin Dashboard! 🚀**