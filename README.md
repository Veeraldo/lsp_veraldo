
# DentalCare - Sistem Reservasi Klinik Gigi

Aplikasi berbasis web modern untuk manajemen klinik gigi, mulai dari verifikasi akun pasien, manajemen jadwal dokter, hingga pelacakan status pembayaran reservasi. 

Aplikasi ini dirancang dengan antarmuka pengguna yang bersih, responsif, dan premium menggunakan **Laravel 13** dan **Bootstrap 5**.

---

## Spesifikasi & Teknologi

Aplikasi ini dibangun di atas tumpukan teknologi modern standar industri:
- **Framework:** Laravel 13.x
- **Bahasa Pemrograman:** PHP 8.2+
- **Database:** MySQL
- **Frontend / UI:** 
  - Bootstrap 5.3 (via CDN)
  - CSS Kustom (Desain identitas *Teal*)
  - Blade Templating Engine
  - Google Fonts (Inter) & Bootstrap Icons

---

## Fitur Utama

Sistem ini memiliki dua peran utama: **Admin** dan **Pasien**, masing-masing dengan alur kerja yang terpisah dan aman.

**Panel Admin:**
- **Verifikasi Pasien:** Memverifikasi akun pasien baru sebelum mereka bisa melakukan reservasi.
- **Manajemen Dokter:** *Create, Read, Update, Delete* (CRUD) profil dokter dan foto.
- **Manajemen Jadwal:** Mengatur tanggal, waktu mulai, dan ketersediaan dokter.
- **Manajemen Reservasi:** Memverifikasi pengajuan jadwal pasien dan menetapkan harga (tagihan) reservasi.
- **Verifikasi Pembayaran:** Memverifikasi bukti transfer pasien.

**Panel Pasien:**
- **Sistem Pendaftaran Aman:** Pasien tidak dapat memesan sebelum diverifikasi(Approved) oleh Admin.
- **Reservasi Dinamis:** Memilih spesialisasi, dokter, dan jadwal ketersediaan.
- **Pembayaran Terintegrasi:** Mengunggah bukti transfer (dengan format rupiah otomatis) untuk jadwal yang telah disetujui admin.
- **Manajemen Aktivitas:** Mengubah (*Reschedule*) atau membatalkan (*Cancel*) jadwal sebelum disetujui.

---

## Panduan Instalasi (Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini secara lokal di komputer Anda:

### 1. Kebutuhan Sistem (*Prerequisites*)
Pastikan Anda sudah menginstal:
- [PHP](https://www.php.net/downloads) (Versi 8.2 atau lebih baru)
- [Composer](https://getcomposer.org/)
- [XAMPP / MySQL](https://www.apachefriends.org/index.html)
- Web Browser Modern (Chrome / Edge / Firefox)

### 2. Langkah Instalasi

```bash
# 1. Kloning Repositori (Jika menggunakan Git)
git clone <url-repo-anda>
cd reservasi-dokter

# 2. Instalasi Dependensi PHP
composer install

# 3. Konfigurasi File Lingkungan
copy .env.example .env

# 4. Buat Application Key
php artisan key:generate
```

### 3. Konfigurasi Database
Buka file `.env` yang baru saja dibuat, lalu sesuaikan konfigurasi koneksi *database*-nya. (Pastikan Anda sudah membuat *database* kosong di MySQL/phpMyAdmin, misalnya bernama `reservasi_dokter`):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reservasi_dokter
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi & Data Awal (Penting!)
Jalankan perintah ini untuk membangun struktur tabel *database* dan menyuntikkan akun admin *default*:
```bash
php artisan migrate:fresh --seed
```

### 5. Hubungkan Folder Penyimpanan Gambar
Agar foto dokter dan bukti pembayaran bisa ditampilkan di *website*, jalankan perintah ini (hanya perlu sekali):
```bash
php artisan storage:link
```

### 6. Jalankan Server
```bash
php artisan serve
```
Aplikasi kini dapat diakses melalui browser di alamat: **`http://localhost:8000`**

---

## Kredensial Akses Default

Setelah menjalankan *seeder* (`migrate:fresh --seed`), Anda bisa langsung masuk sebagai Admin menggunakan akun berikut:
- **Email:** `admin@gmail.com`
- **Password:** `admin123`

Untuk masuk sebagai Pasien, silakan daftar (*Register*) melalui halaman web, lalu jangan lupa **sahkan (approve) akun pasien tersebut menggunakan panel Admin** agar bisa mencoba fitur reservasi.
