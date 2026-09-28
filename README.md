<p align="center">
  <h1 align="center">🏹 SMECONE ARCHERY CLUB (SAC)</h1>
  <p align="center">
    <strong>Sistem Informasi & Manajemen Ekstrakurikuler Panahan SMK Negeri 1 Purwokerto</strong>
  </p>
  <p align="center">
    <i>Fokus, Disiplin, dan Presisi Menuju Prestasi.</i>
  </p>
</p>

---

## 📌 Tentang Proyek

**SMECONE Archery Club (SAC)** adalah aplikasi web berbasis **Laravel 11** yang dirancang khusus untuk mendigitalkan seluruh kegiatan operasional ekstrakurikuler panahan di SMK Negeri 1 Purwokerto, mulai dari manajemen keanggotaan, pencatatan absensi sesi latihan rutin, rekapitulasi iuran kas, hingga pengelolaan jadwal kegiatan dan struktur organisasi.

---

## ✨ Fitur Utama

- 🎯 **Beranda Interaktif**: Showcase klub, visi misi, statistik keanggotaan langsung dari database, prestasi, inventaris, dan galeri kegiatan.
- 👥 **Manajemen Anggota**: Daftar lengkap seluruh anggota & atlet SAC beserta kelas, divisi panahan (Recurve, Compound, Barebow, Standard Bow), status keaktifan, dan status iuran. Dilengkapi fitur CRUD penuh untuk Administrator.
- 📋 **Absensi Digital**: Pencatatan kehadiran latihan secara real-time berdasarkan tanggal, status kehadiran (Hadir, Izin, Sakit, Alpa), serta rekapitulasi kehadiran.
- 💰 **Kas & Iuran Keuangan**: Pencatatan arus kas masuk (iuran bulanan, subsidi sekolah) dan keluar (perawatan alat, target face) dengan kalkulasi saldo otomatis.
- 📅 **Jadwal Sesi Latihan**: Informasi agenda latihan rutin, scoring round, simulasi tanding POPDA, lokasi, dan pelatih pendamping.
- 🏛️ **Struktur Kepengurusan**: Bagan organisasi resmi klub dari Pembina, Ketua, Wakil, Sekretaris, Bendahara, hingga koordinator divisi (Humas, Perlengkapan, Olahraga, Dokumentasi).
- 🛡️ **Role-Based Access Control (RBAC)**:
  - **Admin (Coach/Pembina)**: Akses penuh CRUD, admin command center, pencatatan transaksi, dan kelola absensi.
  - **Anggota (Siswa)**: Mode read-only untuk melihat data klub, jadwal, dan transparansi keuangan.

---

## 🛠️ Tech Stack

- **Framework**: Laravel 11
- **Styling**: Tailwind CSS & Modern Color Tokens
- **Icons & Typography**: Google Material Symbols Outlined, Lexend & Plus Jakarta Sans
- **Database**: SQLite / MySQL
- **Language**: PHP 8.2+

---

## 🚀 Panduan Instalasi Lokal

### 1. Clone Repository
```bash
git clone https://github.com/fauzan235/archery-smc.git
cd archery-smc
```

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Konfigurasi Environment
Salin file environment dan generate application key:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database & Seeder
Secara default menggunakan SQLite atau sesuaikan `.env` dengan database Anda:
```bash
php artisan migrate:fresh --seed
```

### 5. Jalankan Local Server
```bash
php artisan serve
```
Buka peramban di: `http://127.0.0.1:8000`

---

## 🔐 Akun Demo Pengujian

Aplikasi telah dilengkapi seeder akun untuk pengujian:

| Role | Email | Password | Hak Akses |
|---|---|---|---|
| **Admin (Coach)** | `admin@smecone.sch.id` | `admin123` | Full CRUD & Admin Dashboard |
| **Anggota (Siswa)** | `bondan@smecone.sch.id` | `siswa123` | Read-only portal |

---

## 📂 Struktur Proyek

```
archery-smc/
├── app/
│   ├── Http/Controllers/     # Controller untuk seluruh modul (Member, Attendance, Finance, dll)
│   ├── Http/Middleware/      # AdminMiddleware (Role protection)
│   └── Models/               # Eloquent Models (Member, Attendance, Finance, Schedule, dll)
├── database/
│   ├── migrations/           # Database schema migrations
│   └── seeders/              # DatabaseSeeder dengan data real anggota SAC
├── docs/                     # Dokumentasi & arsip absensi resmi
├── public/                   # Public web root (assets, css, js)
├── resources/
│   └── views/
│       ├── layouts/app.blade.php  # Base layout utama yang responsif
│       └── pages/                 # Halaman modular (home, members, attendances, finances, dll)
└── routes/
    └── web.php               # Rute terstruktur dengan grouping guest, auth, dan admin
```

---

<p align="center">
  Dibuat dengan dedikasi untuk <b>SMECONE Archery Club (SAC) - SMK Negeri 1 Purwokerto</b> 🎯
</p>
