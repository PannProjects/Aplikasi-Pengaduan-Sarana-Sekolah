# 🏫 Aplikasi Pengaduan Sarana Sekolah

**Aplikasi Pengaduan Sarana Sekolah** adalah sebuah platform berbasis web yang dirancang khusus untuk memudahkan siswa dalam menyampaikan keluhan atau aspirasi terkait fasilitas dan sarana di lingkungan sekolah. Dibangun menggunakan framework modern **Laravel 12**, aplikasi ini memfasilitasi komunikasi yang transparan antara siswa dan pihak administrasi sekolah, memastikan setiap keluhan dapat ditangani dengan cepat dan tepat.

---

## ✨ Fitur Utama

- **Sistem Autentikasi & Multi-Role**: Akses khusus yang dibedakan antara **Siswa** (pelapor) dan **Admin** (pengelola).
- **Pengajuan Pendumas/Keluhan**: Siswa dapat membuat laporan keluhan dilengkapi dengan **unggah foto bukti** kerusakan atau masalah sarana.
- **Manajemen Data Siswa (Admin)**: Admin dapat melihat dan mengelola data siswa yang terdaftar dalam sistem.
- **Riwayat Aspirasi**: Menu khusus "Riwayat Aspirasi" bagi Admin dan Siswa untuk melacak keluhan yang telah berstatus *selesai*, memisahkan data aktif dari data *history*.
- **Aktivitas Log Admin**: Sistem pencatatan otomatis yang merekam seluruh perubahan profil maupun pembaruan status keluhan oleh admin, memudahkan proses audit dan *monitoring*.

---

## 🛠️ Teknologi yang Digunakan

- **Backend:** PHP 8.2 & Laravel 12.x
- **Frontend:** Laravel Blade, Vite
- **Database:** MySQL
- **Styling:** CSS Framework (Tailwind CSS / Native Bootstrap)

---

## 🚀 Panduan Instalasi (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di komputer lokal (localhost):

### Persyaratan Sistem
Pastikan sistem Anda telah terinstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- Database MySQL / MariaDB (melalui XAMPP/Laragon/sejenisnya)

### Langkah Instalasi Mutlak

1. **Clone repository ini** (jika ada) ke dalam direktori lokal Anda:
   ```bash
   git clone https://github.com/PannProjects/Aplikasi-Pengaduan-Sarana-Sekolah.git
   cd Aplikasi_Pengaduan_Sarana_Sekolah
   ```

2. **Gunakan Script Setup Otomatis (Direkomendasikan)**
   Aplikasi ini memiliki *script* bawaan dari `composer.json` untuk setup otomatis:
   ```bash
   composer setup
   ```
   *(Perintah ini akan menjalankan `composer install`, copy `.env`, `key:generate`, `migrate`, dan proses instalasi NPM untuk build aset frontend).*

3. **Atau Instalasi Manual** (Jika perintah di atas tidak berjalan):
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   Buka file `.env` di *text editor* Anda dan sesuaikan konfigurasi database berikut (sesuaikan dengan lokal Anda):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pengembangan_aplikasi_pengaduan_sarana_sekolah_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   *Pastikan Anda telah membuat database dengan nama `pengembangan_aplikasi_pengaduan_sarana_sekolah_db` melalui PhpMyAdmin.*

5. **Jalankan Migrasi dan Database Seeder**
   Setelah database Anda siap, jalankan migrasi tabel dan pengisian data *dummy*:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Jalankan Development Server**
   Gunakan perintah bawaan composer kami untuk menjalankan `php artisan serve` dan Vite Server (`npm run dev`) secara bersamaan:
   ```bash
   composer dev
   ```
   
Aplikasi kini dapat diakses melalui browser di: **http://127.0.0.1:8000**

---

## 🔐 Akun Akses Pengujian (Seeder)

Anda dapat menggunakan akun-akun *dummy* berikut untuk menguji aplikasi:

### 👨‍💻 Admin
- **Email:** `panduadmin@gmail.com`
- **Password:** `pandusetya`
- *Catatan: Akun ini memiliki kontrol penuh atas manajemen aplikasi.*

### 🧑‍🎓 Siswa (Contoh)
- **Email:** `kevin@gmail.com`
- **Password:** `12345678`
*(Tersedia pula akses siswa lain di database seperti Radit, Rasya, Taufiq, dan Rehan dengan password default `12345678`)*

---

## 📖 Cara Penggunaan Singkat

1. **Siswa:** Lakukan *login* menggunakan email siswa. Masuk ke halaman Form Pengaduan untuk mulai mengirimkan laporan beserta bukti fotonya. Pantau status laporan Anda melalui menu Riwayat.
2. **Admin:** Lakukan *login* sebagai admin. Cek laporan masuk, perbarui status penanganan (Proses, Selesai), dan pantau seluruh *Log Aktivitas* dari tindakan pengurus.

---

## 🛡️ Keamanan

Jika Anda menemukan celah keamanan dalam aplikasi ini, harap melaporkannya terlebih dahulu kepada tim pengembang kami sebelum membuka masalah (issue) secara publik.
