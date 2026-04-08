-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Apr 2026 pada 06.37
-- Versi server: 12.3.1-MariaDB-log
-- Versi PHP: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `aplikasi_pengaduan_sarana_sekolah_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `aktivitas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `aktivitas`, `created_at`, `updated_at`) VALUES
(1, 1, 'Memperbarui status aspirasi dari siswa bernama Pak Toni menjadi Menunggu', '2026-04-08 06:03:53', '2026-04-08 06:03:53'),
(2, 1, 'Memperbarui status aspirasi dari siswa bernama Pak Toni menjadi Selesai', '2026-04-08 06:16:04', '2026-04-08 06:16:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aspirasis`
--

CREATE TABLE `aspirasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(255) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `ket_aspirasi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu','Proses','Selesai') NOT NULL DEFAULT 'Menunggu',
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `aspirasis`
--

INSERT INTO `aspirasis` (`id`, `nis`, `kelas`, `kategori_id`, `lokasi`, `ket_aspirasi`, `gambar`, `status`, `feedback`, `created_at`, `updated_at`) VALUES
(1, '120313990', 'XII RPL 1', 1, 'Masjid', 'Rusuh pol masjid e', 'aspirasi/QNDxy9D2y60iKjzqspXG7Y2eVzj4Ibkv4DYvx5M2.webp', 'Selesai', 'wes bersih mas', '2026-04-08 03:57:31', '2026-04-08 03:58:08'),
(2, '10298339', 'XII RPL 3', 1, 'Masjid', 'rusuh pol masjid e', 'aspirasi/GnZzRCklNbCZ7zZr2AputUesiZMluROTOPSR4eZd.webp', 'Selesai', 'sudah aman', '2026-04-08 04:22:11', '2026-04-08 06:16:04'),
(3, '10298339', 'XII RPL 3', 3, 'Kantin', 'banyak bangku yang blm dibenerin', NULL, 'Selesai', 'sudah yaa', '2026-04-08 04:22:38', '2026-04-08 04:24:27'),
(4, '10298339', 'XII RPL 3', 3, 'Kelas', 'bangku rusak', 'aspirasi/fTVcq0FL4QDgreeLTRFkEXx1cg4f614C8OyThsi6.jpg', 'Selesai', 'ooh iyaa saya sudah pesan bangku baru', '2026-04-08 04:23:24', '2026-04-08 04:28:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('pengembangan-aplikasi-pengaduan-sarana-sekolah-cache-bapak toni|127.0.0.1', 'i:1;', 1775622767),
('pengembangan-aplikasi-pengaduan-sarana-sekolah-cache-bapak toni|127.0.0.1:timer', 'i:1775622767;', 1775622767),
('pengembangan-aplikasi-pengaduan-sarana-sekolah-cache-bapaktoni@gmail.com|127.0.0.1', 'i:1;', 1775622780),
('pengembangan-aplikasi-pengaduan-sarana-sekolah-cache-bapaktoni@gmail.com|127.0.0.1:timer', 'i:1775622780;', 1775622780);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ket_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `ket_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Kebersihan', '2026-04-08 03:56:41', '2026-04-08 03:56:41'),
(2, 'Keamanan', '2026-04-08 03:56:41', '2026-04-08 03:56:41'),
(3, 'Kerusakan', '2026-04-08 03:56:41', '2026-04-08 03:56:41'),
(4, 'Lainnya', '2026-04-08 03:56:41', '2026-04-08 03:56:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_08_013054_create_kategoris_table', 1),
(5, '2026_04_08_013055_create_aspirasis_table', 1),
(6, '2026_04_08_100815_add_kelas_and_gambar_to_aspirasis_table', 1),
(7, '2026_04_08_114305_create_activity_logs_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KWYOxrC9fFmnoSCu4ubkdekPUnNWBUZHKFKFXKaV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib25LVHc0ejZ3elFEZHlYbnk2eWRuYUprY0dEbUw4ZkJ0UEJjVlBPZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2ctYWt0aXZpdGFzIjtzOjU6InJvdXRlIjtzOjE5OiJsb2dfYWt0aXZpdGFzLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1775630222);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nis` varchar(20) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `peran` enum('admin','siswa') NOT NULL DEFAULT 'siswa',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `nis`, `kelas`, `peran`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'panduadmin@gmail.com', 'Pandu Admin', NULL, NULL, 'admin', NULL, '$2y$12$oZ2MEdYjeV/FPKlIp65dk.eB1N9QxGvNFbR3IKID1TeC9MioD/E9.', NULL, '2026-04-08 03:56:41', '2026-04-08 03:56:41'),
(2, 'Kevin', 'kevin@gmail.com', 'kevin', '120313990', 'XII RPL 1', 'siswa', NULL, '$2y$12$6guig1tmrgAz5B31.rLswu6kwvdb0lfAcvvaxHzrjPG8.ZMnzte7e', NULL, '2026-04-08 03:56:41', '2026-04-08 03:56:41'),
(3, 'Radit', 'radit@gmail.com', 'radit', '12931293', 'XII RPL 2', 'siswa', NULL, '$2y$12$Oo6CMJZctWg/nZ8HSCW1suATur7RwOKUHiTTJYkTw4/7C.sP6aHhO', NULL, '2026-04-08 03:56:41', '2026-04-08 03:56:41'),
(4, 'Rasya', 'rasya@gmail.com', 'rasya', '1293938', 'XI TKJ 2', 'siswa', NULL, '$2y$12$2rk0WMJH4d8ej7DeOMu7M.csjiT6YuL9gU.4Djf1LTOG3Jy6dLjsG', NULL, '2026-04-08 03:56:42', '2026-04-08 03:56:42'),
(5, 'Taufiq', 'taufiq@gmail.com', 'taufiq', '18231873', 'XI TKJ 2', 'siswa', NULL, '$2y$12$7aURoVGRPRvLnMOl0PQOYOTNPmCq0MMXnWFi8m8pugAmLii54LVyS', NULL, '2026-04-08 03:56:42', '2026-04-08 03:56:42'),
(6, 'Rehan', 'rehan@gmail.com', 'rehan', '12389232', 'XII RPL 2', 'siswa', NULL, '$2y$12$TzrdMCiuuo6zxhBSuKmc8.pbpPCYa8cIWvbwchLkiDsYQH.V/FXK6', NULL, '2026-04-08 03:56:42', '2026-04-08 03:56:42'),
(7, 'Pak Toni', 'paktoni@gmail.com', 'bapaktoni', '10298339', 'XII RPL 3', 'siswa', NULL, '$2y$12$qxE6hLnhw/OL49f7QpndguEKm8Bqy1BANqTi2iDttb4EEHGOIRW.u', NULL, '2026-04-08 04:21:41', '2026-04-08 04:21:41');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `aspirasis`
--
ALTER TABLE `aspirasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aspirasis_kategori_id_foreign` (`kategori_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_nis_unique` (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `aspirasis`
--
ALTER TABLE `aspirasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `aspirasis`
--
ALTER TABLE `aspirasis`
  ADD CONSTRAINT `aspirasis_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
