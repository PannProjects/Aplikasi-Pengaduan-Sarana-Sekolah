# Dokumentasi Aplikasi Pengaduan Sarana Sekolah (Pandu Setya Wijaya)

## A. ERD

Untuk database-nya saya pakai 3 tabel:

    USERS:
        bigint id PK
        varchar name
        varchar email
        varchar username
        varchar nis
        varchar kelas
        enum peran
        varchar password
        timestamp created_at
        timestamp updated_at

    KATEGORIS:
        bigint id PK
        varchar ket_kategori
        timestamp created_at
        timestamp updated_at

    ASPIRASIS:
        bigint id PK
        varchar nis FK
        varchar kelas
        bigint kategori_id FK
        varchar lokasi
        text ket_aspirasi
        varchar gambar
        enum status
        text feedback
        timestamp created_at
        timestamp updated_at

Tabel `users` nyimpan data pengguna (admin dan siswa). Tabel `kategoris` isinya jenis-jenis pengaduan kayak Kebersihan, Keamanan, Kerusakan. Tabel `aspirasis` itu data pengaduan yang dikirim siswa, termasuk kelas pengirim dan foto bukti kalau ada.

Relasinya, satu user bisa kirim banyak aspirasi (one to many, dihubungkan lewat kolom `nis`). Terus satu kategori juga bisa dipake banyak aspirasi (one to many lewat `kategori_id`).

---

## B. Deskripsi Program

Aplikasi ini saya buat pakai Laravel 12 + Tailwind CSS + Alpine.js dengan database MySQL. Intinya biar siswa bisa lapor kalau ada sarana sekolah yang rusak atau bermasalah lewat web, terus admin bisa liat dan tanggapi laporannya.

Fitur buat siswa:
- Daftar akun pake Nama, Username, NIS, Kelas, Email
- Login bisa pake username, NIS, atau email (fleksibel)
- Kirim pengaduan (isi lokasi, pilih kategori, tulis keterangan, upload foto bukti)
- Liat laporan pribadi yang masih Menunggu dan Proses (halaman Aspirasi Saya)
- Liat Riwayat Aspirasi yang udah selesai (halaman terpisah)
- Cek status pengaduannya udah ditangani atau belum (Menunggu/Proses/Selesai)
- Baca balasan dari admin

Fitur buat admin:
- Login pake username atau email
- Liat data laporan baru dan proses (Aspirasi yang "Selesai" otomatis dipindah ke menu Riwayat)
- Liat riwayat aspirasi yang udah diselesaikan dan bisa hapus permanen data tersebut
- Filter data realtime (ketik langsung kefilter, gak perlu reload)
- Update status aspirasi jadi Menunggu/Proses/Selesai
- Kasih feedback ke siswa
- Ada statistik di dashboard (total, menunggu, proses, selesai)
- Liat daftar semua akun siswa yang terdaftar (halaman Data Siswa)
- Cek Log Aktivitas (Sistem merekam setiap admin ganti profil, update status aspirasi, atau hapus aspirasi)

Akun admin bawaan: email `panduadmin@gmail.com`, username `Pandu Admin`, password `pandusetya`.

Akun siswa bawaan (password semua `12345678`):
- Kevin (NIS: 120313990, Kelas: XII RPL 1, Username: kevin)
- Radit (NIS: 12931293, Kelas: XII RPL 2, Username: radit)
- Rasya (NIS: 1293938, Kelas: XI TKJ 2, Username: rasya)
- Taufiq (NIS: 18231873, Kelas: XI TKJ 2, Username: taufiq)
- Rehan (NIS: 12389232, Kelas: XII RPL 2, Username: rehan)

Kategori bawaan ada 3: Kebersihan, Keamanan, Kerusakan.

---

## C. Dokumentasi Fungsi / Prosedur

### 1. AspirasiController

File-nya di `app/Http/Controllers/AspirasiController.php`. Controller ini yang handle semua logic aspirasi.

**index()** — Nampilin halaman utama. Kalau yang login admin, tampil semua data aspirasi yang belum selesai (Menunggu & Proses) lengkap sama statistik. Kalau siswa, nampilin aspirasi pribadi yang masih Menunggu & Proses juga.

**riwayat()** — Nampilin halaman Riwayat Aspirasi yang isinya pengaduan yang berstatus "Selesai". Baik admin maupun siswa masuk ke sini buat ngecek datanya yang udah selesai.

**destroy()** — Buat fungsi hapus permanen data aspirasi dari riwayat. Hapus ini sekalian dicatet ke Log Aktivitas.

**create()** — Nampilin form buat kirim aspirasi baru. Ngambil daftar kategori dari database buat dropdown.

**store()** — Proses simpan aspirasi ke database. Ada validasi dulu (kategori harus ada, lokasi wajib diisi, keterangan wajib diisi, gambar opsional maks 2MB). Kalau ada upload gambar, disimpan ke folder `storage/app/public/aspirasi/`. Kelas otomatis diambil dari data user yang login.

```php
public function store(Request $request)
{
    $request->validate([
        'kategori_id'  => 'required|exists:kategoris,id',
        'lokasi'       => 'required|string|max:255',
        'ket_aspirasi' => 'required|string',
        'gambar'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('aspirasi', 'public');
    }

    Aspirasi::create([
        'nis'          => Auth::user()->nis,
        'kelas'        => Auth::user()->kelas,
        'kategori_id'  => $request->kategori_id,
        'lokasi'       => $request->lokasi,
        'ket_aspirasi' => $request->ket_aspirasi,
        'gambar'       => $gambarPath,
        'status'       => 'Menunggu',
    ]);

    return redirect()->route('aspirasi.index')
        ->with('success', 'Aspirasi berhasil dikirim!');
}
```

**update()** — Khusus buat admin. Fungsinya buat update status aspirasi sama kasih feedback. Kalau yang akses bukan admin, langsung di-block pake `abort(403)`.

**siswa()** — Khusus admin juga. Nampilin daftar semua akun siswa yang terdaftar di sistem (nama, username, NIS, kelas, email, tanggal daftar).

### 2. ActivityLogController

File-nya di `app/Http/Controllers/ActivityLogController.php`. Cuma ada satu fungsi aja yaitu `index()` buat nampilin tabel rekam jejak atau log aktivitas yang dilakukan oleh admin ke tampilan web.

### 3. Model

**User** (`app/Models/User.php`) — Nyimpan data pengguna. Field-nya: name, email, username, nis, kelas, peran, password. Password otomatis di-hash.

**Aspirasi** (`app/Models/Aspirasi.php`) — Data pengaduan. Field-nya: nis, kelas, kategori_id, lokasi, ket_aspirasi, gambar, status, feedback. Punya relasi `belongsTo` ke User (lewat nis) dan ke Kategori (lewat kategori_id).

**Kategori** (`app/Models/Kategori.php`) — Jenis pengaduan. Field-nya: ket_kategori. Punya relasi `hasMany` ke Aspirasi.

**ActivityLog** (`app/Models/ActivityLog.php`) — Buat nyimpan histori log aktivitas. Field-nya: user_id sama aktivitas. Dia `belongsTo` ke tabel User.

### 4. Sistem Login

File-nya `app/Http/Requests/Auth/LoginRequest.php`. Login-nya fleksibel, bisa pake email, NIS, atau username. Sistemnya otomatis deteksi input-nya apa. Kalau format email ya login pake email, kalau angka pake NIS, sisanya pake username. Ada rate limiting juga, kalau salah 5 kali dikunci sementara.

### 5. Registrasi

File-nya `app/Http/Controllers/Auth/RegisteredUserController.php`. Saat daftar, siswa harus isi: Nama, Username, NIS, Kelas, Email, Password. Username dan NIS harus unik. Peran otomatis diset jadi "siswa".

### 6. Daftar Route

- `GET /` → Landing page
- `GET /aspirasi` → Halaman utama (beda tampilan admin/siswa)
- `GET /aspirasi/tambah` → Form kirim aspirasi
- `POST /aspirasi` → Simpan aspirasi (support upload gambar)
- `PATCH /aspirasi/{id}` → Update status dan feedback
- `GET /aspirasi/riwayat` → Tab halaman khusus aspirasi selesai (admin & siswa)
- `DELETE /aspirasi/{id}` → Aksi hapus pengaduan (admin only)
- `GET /log-aktivitas` → Liat tabel Log Aktivitas (admin only)
- `GET /siswa` → Daftar akun siswa (khusus admin)
- `GET /profile` → Edit profil
- `PATCH /profile` → Simpan profil
- `DELETE /profile` → Hapus akun

### 7. Struktur File View

- `resources/views/`
  - `welcome.blade.php` → Landing page
  - `dashboard.blade.php`
  - `layouts/`
    - `app.blade.php` → Layout utama
    - `guest.blade.php` → Layout login/register
  - `auth/`
    - `login.blade.php`
    - `register.blade.php` → Form registrasi
    - `forgot-password.blade.php`
    - `reset-password.blade.php`
    - `confirm-password.blade.php`
    - `verify-email.blade.php`
  - `aspirasi/`
    - `admin_index.blade.php` → Dashboard admin (filter realtime)
    - `admin_riwayat.blade.php` → Khusus pengaduan yang udah berstatus Selesai (admin)
    - `siswa_index.blade.php` → Dashboard siswa
    - `siswa_riwayat.blade.php` → Khusus pengaduan selesai buat siswa
    - `create.blade.php` → Form aspirasi
  - `admin/log_aktivitas/`
    - `index.blade.php` → Tampilan tabel rekam jejak aksi admin
  - `siswa/`
    - `index.blade.php` → Daftar akun siswa
  - `profile/`
    - `edit.blade.php`
    - `partials/`
      - `update-profile-information-form.blade.php`
      - `update-password-form.blade.php`
      - `delete-user-form.blade.php`

---

## D. Debugging

Perintah yang sering saya pakai waktu development:

- `php artisan serve` — jalanin server lokal
- `npm run dev` — jalanin Vite buat compile CSS
- `php artisan migrate:refresh --seed` — reset database
- `php artisan optimize:clear` — bersihin cache
- `php artisan route:list` — liat daftar route
- `php artisan storage:link` — buat symlink storage biar gambar bisa diakses dari web

Error yang pernah saya temui:

1. **Table doesn't exist** — jalanin `php artisan migrate`
2. **419 Page Expired** — lupa taro `@csrf` di form
3. **GET method not supported** — lupa taro `@method('PATCH')` di form update
4. **CSS gak muncul** — Vite belum jalan, jalanin `npm run dev`
5. **Login gagal** — bersihin cache dulu pake `php artisan optimize:clear`
6. **Gambar gak tampil** — belum jalanin `php artisan storage:link`

Buat debugging saya biasa pake `dd()` buat liat isi variabel, atau `Log::info()` kalau gak mau stop programnya. Log-nya ada di `storage/logs/laravel.log`.

### Alur Aplikasi

1. **Akses Web**: Pengguna membuka aplikasi. Jika belum login, diarahkan ke halaman Login.
2. **Login**: Pengguna masuk berdasarkan peran (Admin atau Siswa).
3. **Alur Siswa**:
   - Diarahkan ke Dashboard Siswa (menampilkan daftar laporan yang sedang berjalan).
   - Bisa mengirim pengaduan melalui form (dengan upload foto), otomatis berstatus "Menunggu".
   - Bisa mengecek Daftar Aspirasi yang sudah selesai di menu Riwayat Aspirasi.
4. **Alur Admin**:
   - Diarahkan ke Dashboard Admin.
   - Melihat, memfilter data aspirasi, dan mengelola daftar akun siswa.
   - Bisa memberikan *feedback* serta mengubah status pengaduan (menjadi "Proses" atau "Selesai").
   - Jika status diubah ke "Selesai", pengaduan dipindah ke menu Riwayat Aspirasi.
   - Admin juga dapat mengecek rekam jejak aktivitas akunnya di fitur Log Aktivitas.

---

## E. Laporan Evaluasi Singkat

Semua fitur udah saya coba dan hasilnya bisa berjalan tanpa ada error.
Dari sisi keamanan, passwordnya sudah saya hash, form nya pake csrf token, input sudah aman validasi, upload gambar sudah dibatasi 2MB, dan aman dari sql injection, dan terakhir login nya sudah pakai rate limiting biar tida bisa di brute force.

Kelebihan aplikasi ini menurut saya: login-nya fleksibel (bisa pake 3 cara), filter datanya realtime (gak perlu reload), stat cards-nya ikut berubah pas filter aktif, bisa upload foto bukti, dan admin bisa liat semua akun siswa.

Kekurangannya masih belum ada fitur export PDF/Excel, belum ada pagination, dan belum ada notifikasi realtime ke admin. Ini rencana mau saya tambahin kedepannya.

Kesimpulannya, aplikasi ini udah bisa dipake sesuai kebutuhan. Fitur dasarnya lengkap, tinggal dikembangin lagi aja buat fitur-fitur tambahan.