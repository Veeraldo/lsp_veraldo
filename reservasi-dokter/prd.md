PRD — Project Requirements Document
Aplikasi Reservasi Jadwal Periksa Dokter Gigi
1. Overview
Aplikasi ini bertujuan untuk mendigitalkan proses reservasi jadwal periksa di klinik dokter gigi, yang sebelumnya dilakukan secara manual (telepon/datang langsung) sehingga rawan bentrok jadwal dan sulit dipantau. Masalah utama yang ingin diselesaikan adalah kesulitan pasien dalam mendaftar dan memantau status reservasi, serta kesulitan admin klinik dalam memverifikasi pendaftaran, jadwal, dan pembayaran secara terpusat.
Tujuan utama aplikasi adalah menyediakan platform berbasis web yang memungkinkan Pasien melakukan pendaftaran akun, reservasi jadwal periksa, dan konfirmasi pembayaran secara mandiri, sementara Admin dapat memverifikasi seluruh proses tersebut serta mengelola pengumuman klinik.
2. Requirements
•	Aksesibilitas: Aplikasi harus dapat diakses melalui web browser (desktop maupun mobile).
•	Pengguna: Sistem memiliki dua peran pengguna — Pasien dan Admin — dengan hak akses berbeda (otentikasi & otorisasi).
•	Database: Menggunakan MySQL dengan minimal 3 tabel utama.
•	Framework: Dibangun menggunakan framework PHP (Laravel) dan framework CSS (Bootstrap/Tailwind/lainnya).
•	Verifikasi Berjenjang: Setiap aksi penting pasien (pendaftaran akun, reservasi, pembayaran) memerlukan verifikasi admin sebelum berlaku efektif.
•	Multimedia: Aplikasi menampilkan unsur gambar dan video pada bagian yang relevan (misalnya profil dokter/klinik atau pengumuman).
•	Version Control: Proyek dikelola menggunakan GitHub sebagai version control system, lengkap dengan dokumentasi README.md.
3. Core Features
Fitur-fitur kunci yang harus ada dalam versi pertama (MVP), dikelompokkan berdasarkan aktor:
3.1 Modul Pasien
1.	Pendaftaran Akun — pasien mengisi form registrasi untuk membuat akun baru.
2.	Status Pendaftaran Akun — pasien dapat melihat status akun (menunggu/diterima/ditolak).
3.	Login — autentikasi pasien ke dalam sistem.
4.	Reservasi Jadwal Periksa — pasien memilih tanggal, jam, dan dokter untuk reservasi.
5.	Status Reservasi — pasien memantau status reservasi (menunggu/dikonfirmasi/ditolak).
6.	Konfirmasi Pembayaran — pasien mengunggah/mengonfirmasi bukti pembayaran.
7.	Lihat Pengumuman — pasien dapat membaca pengumuman terbaru dari klinik.
3.2 Modul Admin
8.	Login — autentikasi admin ke dalam sistem.
9.	Verifikasi Pendaftaran Akun — admin menerima/menolak pendaftaran akun pasien baru.
10.	Verifikasi Reservasi Jadwal Periksa — admin menerima/menolak reservasi yang diajukan pasien.
11.	Verifikasi Pembayaran — admin menerima/menolak bukti pembayaran yang diajukan pasien.
12.	Kelola Pengumuman — admin dapat menambah, mengubah, dan menghapus pengumuman (CRUD).
13.	Dashboard Admin — ringkasan jumlah pendaftaran, reservasi, dan pembayaran yang menunggu verifikasi.
4. User Flow
4.1 Alur Pasien
14.	Registrasi: Pasien mengisi form pendaftaran akun.
15.	Menunggu Verifikasi: Admin memverifikasi pendaftaran (terima/tolak).
16.	Login: Setelah akun diterima, pasien login ke aplikasi.
17.	Reservasi: Pasien memilih jadwal periksa yang tersedia dan mengajukan reservasi.
18.	Menunggu Konfirmasi: Admin memverifikasi reservasi (terima/tolak).
19.	Pembayaran: Setelah reservasi dikonfirmasi, pasien melakukan dan mengonfirmasi pembayaran.
20.	Verifikasi Pembayaran: Admin memverifikasi pembayaran (terima/tolak).
21.	Selesai: Pasien dapat memantau status akhir reservasi dan membaca pengumuman klinik.
4.2 Alur Admin
22.	Login ke dashboard admin.
23.	Meninjau daftar pendaftaran akun baru → terima/tolak.
24.	Meninjau daftar reservasi baru → terima/tolak.
25.	Meninjau bukti pembayaran → terima/tolak.
26.	Mengelola konten pengumuman (tambah/ubah/hapus).
5. Architecture
Alur data pada proses inti aplikasi (contoh: proses reservasi jadwal periksa) digambarkan secara sekuensial sebagai berikut:
•	Pasien (Browser) mengirim data reservasi (dokter, tanggal, jam) melalui antarmuka web (Blade/Frontend).
•	Frontend mengirim request ke Backend (Laravel Controller).
•	Backend melakukan validasi data dan otorisasi sesi pasien.
•	Backend menyimpan data reservasi ke Database (MySQL) dengan status "menunggu verifikasi".
•	Database mengonfirmasi penyimpanan data ke Backend.
•	Backend mengirim response sukses ke Frontend, ditampilkan sebagai notifikasi/alert ke pasien.
•	Saat Admin login dan membuka menu verifikasi, Backend mengambil data reservasi berstatus "menunggu" dari Database untuk ditampilkan.
•	Admin memverifikasi (terima/tolak), Backend memperbarui status reservasi di Database, dan Pasien melihat status terbaru saat memantau halaman status reservasi.
6. Database Schema
Struktur database minimal (dapat dikembangkan sesuai kebutuhan) mencakup tabel-tabel berikut:
6.1 Entitas Utama
Tabel	Deskripsi
users	Data akun (pasien & admin) — email, password, role, status verifikasi akun
dokters	Master data dokter gigi — nama, spesialisasi, jadwal praktik, foto
reservasis	Data reservasi jadwal periksa — pasien, dokter, tanggal, jam, status
pembayarans	Data pembayaran terkait reservasi — nominal, bukti bayar, status verifikasi
pengumumans	Data pengumuman klinik — judul, isi, gambar/video, tanggal publikasi
6.2 Detail Kolom (Ringkas)
Tabel	Kolom Kunci
users	id (PK), name, email, password, role (pasien/admin), status_akun, created_at
dokters	id (PK), nama, spesialisasi, jadwal, foto, created_at
reservasis	id (PK), user_id (FK), dokter_id (FK), tanggal, jam, status, created_at
pembayarans	id (PK), reservasi_id (FK), nominal, bukti_bayar, status, created_at
pengumumans	id (PK), judul, isi, media, tanggal_publikasi, created_at
6.3 Relasi Antar Tabel
•	users (1) — reservasis (banyak): satu pasien dapat memiliki banyak reservasi.
•	dokters (1) — reservasis (banyak): satu dokter dapat memiliki banyak reservasi.
•	reservasis (1) — pembayarans (1 atau banyak): satu reservasi memiliki satu/lebih data pembayaran.
•	users/admin (1) — pengumumans (banyak): satu admin dapat mengelola banyak pengumuman.
7. Design & Technical Constraints
7.1 Teknologi
Sistem dibangun menggunakan Laravel (PHP) sebagai backend framework, MySQL sebagai database, serta framework CSS (Bootstrap/Tailwind) untuk antarmuka. Library eksternal dapat digunakan bila diperlukan untuk mendukung fungsionalitas tertentu (misalnya upload gambar/video, atau komponen UI tambahan).
7.2 Batasan Proyek
•	Waktu pengembangan: 10 jam.
•	Version control: GitHub, dengan dokumentasi README.md (instalasi, spesifikasi, dependensi).
•	Demonstrasi: Presentasi aplikasi maksimal 10 menit, dilanjutkan tanya-jawab maksimal 30 menit.
•	Kriteria penilaian: ketepatan jawaban, penguasaan kode program, dan kelengkapan ruang lingkup aplikasi web.

8. PENYEMPURNAAN PRD (Assessment Ready)
Business Rules:
Registrasi akun harus diverifikasi admin sebelum login.
Reservasi hanya dapat dibuat oleh akun yang telah disetujui.
Satu slot jadwal dokter hanya dapat dipakai satu reservasi aktif.
Pembayaran hanya dapat dilakukan setelah reservasi disetujui.
Admin mencatat status approve/reject beserta waktu verifikasi.
Reservasi otomatis ditolak apabila slot telah terisi.
Database Enhancement:
- Tambahkan tabel jadwal_dokters (id, dokter_id, hari, jam_mulai, jam_selesai, status).
- Tambahkan admin_id pada pengumumans.
- Tambahkan logs_verifikasi (opsional) untuk audit.
ERD yang direkomendasikan: users->reservasis, dokters->jadwal_dokters->reservasis, reservasis->pembayarans, admin(users)->pengumumans.
