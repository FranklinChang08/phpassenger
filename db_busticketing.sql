-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Feb 2025 pada 10.08
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_busticketing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bus`
--

CREATE TABLE `bus` (
  `id_bus` int(11) NOT NULL,
  `nama_bus` varchar(100) DEFAULT NULL,
  `plat_nomor` varchar(20) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bus`
--

INSERT INTO `bus` (`id_bus`, `nama_bus`, `plat_nomor`, `kapasitas`, `created_at`, `updated_at`) VALUES
(2, 'Bus Batam Center', 'BP 9042 ED', 5, '2025-02-17 03:15:03', '2025-02-17 03:15:03'),
(3, 'Bus Tester', 'BP 3942 OP', 20, '2025-02-17 03:56:24', '2025-02-17 03:56:24'),
(4, 'Bus 89', 'BP 0123 AC', 5, '2025-02-17 08:58:04', '2025-02-17 08:58:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bus_kelas`
--

CREATE TABLE `bus_kelas` (
  `id_bus` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bus_kelas`
--

INSERT INTO `bus_kelas` (`id_bus`, `id_kelas`) VALUES
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(2, 1),
(3, 4),
(4, 1),
(4, 2),
(4, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bus_rute`
--

CREATE TABLE `bus_rute` (
  `id_bus_rute` int(11) NOT NULL,
  `id_bus` int(11) DEFAULT NULL,
  `id_rute` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bus_rute`
--

INSERT INTO `bus_rute` (`id_bus_rute`, `id_bus`, `id_rute`, `created_at`, `updated_at`) VALUES
(2, 2, 1, '2025-02-17 03:15:18', '2025-02-17 03:15:18'),
(3, 2, 2, '2025-02-17 03:55:06', '2025-02-17 03:55:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_detail_pemesanan` int(11) NOT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `id_kursi_bus` int(11) DEFAULT NULL,
  `nama_penumpang` varchar(100) DEFAULT NULL,
  `nomor_identitas` varchar(50) DEFAULT NULL,
  `harga_kursi` decimal(10,2) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(11) NOT NULL,
  `id_rute` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `harga`
--

INSERT INTO `harga` (`id_harga`, `id_rute`, `id_kelas`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 21000.00, '2025-02-16 18:53:05', '2025-02-16 18:53:05'),
(2, 1, 2, 35000.00, '2025-02-17 06:34:12', '2025-02-17 06:34:12'),
(3, 1, 3, 50000.00, '2025-02-17 06:34:26', '2025-02-17 06:34:26'),
(4, 1, 4, 100000.00, '2025-02-17 06:34:35', '2025-02-17 06:34:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_bus_rute` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu_berangkat` time DEFAULT NULL,
  `waktu_tiba` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `created_at`, `updated_at`) VALUES
(1, 'Bisnis', '2025-02-16 18:45:09', '2025-02-16 18:45:09'),
(2, 'Ekonomi', '2025-02-16 18:45:15', '2025-02-16 18:45:15'),
(3, 'VIP', '2025-02-16 18:45:35', '2025-02-16 18:45:35'),
(4, 'VVIP', '2025-02-16 18:45:44', '2025-02-16 18:45:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kursi_bus`
--

CREATE TABLE `kursi_bus` (
  `id_kursi_bus` int(11) NOT NULL,
  `id_bus` int(11) DEFAULT NULL,
  `nomor_kursi` varchar(10) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `status` enum('Available','Booked') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kursi_bus`
--

INSERT INTO `kursi_bus` (`id_kursi_bus`, `id_bus`, `nomor_kursi`, `id_kelas`, `status`, `created_at`, `updated_at`) VALUES
(6, 2, 'B1', 1, 'Available', '2025-02-17 03:15:57', '2025-02-17 08:55:30'),
(7, 2, 'B2', 1, 'Available', '2025-02-17 03:15:57', '2025-02-17 07:30:30'),
(8, 2, 'B3', 1, 'Available', '2025-02-17 03:15:57', '2025-02-17 07:04:10'),
(9, 2, 'C1', 2, 'Available', '2025-02-17 03:16:08', '2025-02-17 06:38:38'),
(10, 2, 'D4', 1, 'Available', '2025-02-17 03:16:39', '2025-02-17 07:04:10'),
(11, 4, 'E1', 1, 'Available', '2025-02-17 08:59:52', '2025-02-17 08:59:52'),
(12, 4, 'E2', 1, 'Available', '2025-02-17 08:59:52', '2025-02-17 08:59:52'),
(13, 4, 'E3', 1, 'Available', '2025-02-17 08:59:52', '2025-02-17 08:59:52'),
(14, 4, 'E4', 1, 'Available', '2025-02-17 08:59:52', '2025-02-17 08:59:52'),
(15, 4, 'E5', 1, 'Available', '2025-02-17 08:59:52', '2025-02-17 08:59:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `tanggal_pemesanan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Confirmed','Cancelled','Booking') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL,
  `role` enum('Admin','Penumpang') DEFAULT 'Penumpang',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `email`, `password`, `nomor_telepon`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Franklin Sebatian Felix', 'franklinchang0129@gmail.com', '$2y$12$JL6hn.GWyBO0UVnCBzwRsuDOecOMh394luZip/vGJv1Q.gFylCJ1C', '0849132412', 'Admin', '2025-02-16 18:44:19', '2025-02-17 01:44:48'),
(2, 'Amirul', 'amirul0812@gmail.com', '$2y$12$5UahoodfM4IRtQm6qYc6ceoKV3bEFwbI24aBGKe9t3hyqHLArJ.0i', '12345678', 'Penumpang', '2025-02-16 18:55:06', '2025-02-16 18:55:06'),
(3, 'Budi', 'im@gmail.com', '$2y$12$dsGoj034f1LEnTD2b2OGIeDmb9hBq0tvUDjwPAv/yFkBakAoCWSYe', '08491324', 'Penumpang', '2025-02-17 07:02:17', '2025-02-17 07:02:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rute`
--

CREATE TABLE `rute` (
  `id_rute` int(11) NOT NULL,
  `asal` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `jarak_km` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rute`
--

INSERT INTO `rute` (`id_rute`, `asal`, `tujuan`, `jarak_km`, `created_at`, `updated_at`) VALUES
(1, 'Batam Center', 'Batu Aji', 15.00, '2025-02-16 18:51:35', '2025-02-16 18:51:35'),
(2, 'Batam Center', 'Barelang', 22.00, '2025-02-17 03:54:43', '2025-02-17 03:54:43');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EAxHsBTnaREYC6RRCXeFB4hqnwVw7E3okMfoUt4l', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', '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', 1739776303),
('fxyqAbP60xhniV10p9dCCUdbJcVrv7iFSZ3ULO02', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoid1M0YVh0WWF0M20wMmNPQ2tWQ3RrbTJNWWNTdFZMclFLMHNwY0p5WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qYWR3YWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjQ6InVzZXIiO086MTk6IkFwcFxNb2RlbHNcUGVuZ2d1bmEiOjMyOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjg6InBlbmdndW5hIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjExOiJpZF9wZW5nZ3VuYSI7czoxMDoiACoAa2V5VHlwZSI7czozOiJpbnQiO3M6MTI6ImluY3JlbWVudGluZyI7YjoxO3M6NzoiACoAd2l0aCI7YTowOnt9czoxMjoiACoAd2l0aENvdW50IjthOjA6e31zOjE5OiJwcmV2ZW50c0xhenlMb2FkaW5nIjtiOjA7czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjg6e3M6MTE6ImlkX3BlbmdndW5hIjtpOjE7czo0OiJuYW1hIjtzOjIzOiJGcmFua2xpbiBTZWJhdGlhbiBGZWxpeCI7czo1OiJlbWFpbCI7czoyNzoiZnJhbmtsaW5jaGFuZzAxMjlAZ21haWwuY29tIjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTIkSkw2aG4uR1d5Qk8wVVZuQ0J6d1JzdURPZWNPTWgzOTRsdVppcC92R0p2MVEuZ0Z5bENKMUMiO3M6MTM6Im5vbW9yX3RlbGVwb24iO3M6MTA6IjA4NDkxMzI0MTIiO3M6NDoicm9sZSI7czo1OiJBZG1pbiI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMi0xNyAwMTo0NDoxOSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wMi0xNyAwODo0NDo0OCI7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjg6e3M6MTE6ImlkX3BlbmdndW5hIjtpOjE7czo0OiJuYW1hIjtzOjIzOiJGcmFua2xpbiBTZWJhdGlhbiBGZWxpeCI7czo1OiJlbWFpbCI7czoyNzoiZnJhbmtsaW5jaGFuZzAxMjlAZ21haWwuY29tIjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTIkSkw2aG4uR1d5Qk8wVVZuQ0J6d1JzdURPZWNPTWgzOTRsdVppcC92R0p2MVEuZ0Z5bENKMUMiO3M6MTM6Im5vbW9yX3RlbGVwb24iO3M6MTA6IjA4NDkxMzI0MTIiO3M6NDoicm9sZSI7czo1OiJBZG1pbiI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMi0xNyAwMTo0NDoxOSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wMi0xNyAwODo0NDo0OCI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6Mzp7czo0OiJyb2xlIjtzOjY6InN0cmluZyI7czoxMDoiY3JlYXRlZF9hdCI7czo4OiJkYXRldGltZSI7czoxMDoidXBkYXRlZF9hdCI7czo4OiJkYXRldGltZSI7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6MTM6InVzZXNVbmlxdWVJZHMiO2I6MDtzOjk6IgAqAGhpZGRlbiI7YToxOntpOjA7czo4OiJwYXNzd29yZCI7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjY6e2k6MDtzOjQ6Im5hbWEiO2k6MTtzOjU6ImVtYWlsIjtpOjI7czo4OiJwYXNzd29yZCI7aTozO3M6MTM6Im5vbW9yX3RlbGVwb24iO2k6NDtzOjQ6InJvbGUiO2k6NTtzOjg6InBhc3N3b3JkIjt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9czoxOToiACoAYXV0aFBhc3N3b3JkTmFtZSI7czo4OiJwYXNzd29yZCI7czoyMDoiACoAcmVtZW1iZXJUb2tlbk5hbWUiO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjt9czoxMzoibGFzdF9vcmRlcl9pZCI7aToxMDtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1739782822);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `bukti_pembayaran` blob DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT current_timestamp(),
  `status_pembayaran` enum('Confirmed','Completed','Cancelled','Pending','Refund') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id_bus`);

--
-- Indeks untuk tabel `bus_kelas`
--
ALTER TABLE `bus_kelas`
  ADD KEY `bus_kelas_ibfk_1` (`id_bus`),
  ADD KEY `bus_kelas_ibfk_2` (`id_kelas`);

--
-- Indeks untuk tabel `bus_rute`
--
ALTER TABLE `bus_rute`
  ADD PRIMARY KEY (`id_bus_rute`),
  ADD KEY `bus_rute_ibfk_1` (`id_bus`),
  ADD KEY `bus_rute_ibfk_2` (`id_rute`);

--
-- Indeks untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id_detail_pemesanan`),
  ADD KEY `detail_pemesanan_ibfk_1` (`id_pemesanan`),
  ADD KEY `detail_pemesanan_ibfk_2` (`id_kursi_bus`);

--
-- Indeks untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`),
  ADD KEY `harga_ibfk_2` (`id_kelas`),
  ADD KEY `harga_ibfk_1` (`id_rute`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `jadwal_ibfk_1` (`id_bus_rute`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `kursi_bus`
--
ALTER TABLE `kursi_bus`
  ADD PRIMARY KEY (`id_kursi_bus`),
  ADD KEY `kursi_bus_ibfk_1` (`id_bus`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `pemesanan_ibfk_1` (`id_pengguna`),
  ADD KEY `pemesanan_ibfk_2` (`id_jadwal`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_rute`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `transaction_ibfk_1` (`id_pemesanan`),
  ADD KEY `transaction_ibfk_2` (`id_pengguna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bus`
--
ALTER TABLE `bus`
  MODIFY `id_bus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `bus_rute`
--
ALTER TABLE `bus_rute`
  MODIFY `id_bus_rute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id_detail_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kursi_bus`
--
ALTER TABLE `kursi_bus`
  MODIFY `id_kursi_bus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rute`
--
ALTER TABLE `rute`
  MODIFY `id_rute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bus_kelas`
--
ALTER TABLE `bus_kelas`
  ADD CONSTRAINT `bus_kelas_ibfk_1` FOREIGN KEY (`id_bus`) REFERENCES `bus` (`id_bus`) ON DELETE CASCADE,
  ADD CONSTRAINT `bus_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bus_rute`
--
ALTER TABLE `bus_rute`
  ADD CONSTRAINT `bus_rute_ibfk_1` FOREIGN KEY (`id_bus`) REFERENCES `bus` (`id_bus`) ON DELETE CASCADE,
  ADD CONSTRAINT `bus_rute_ibfk_2` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`id_kursi_bus`) REFERENCES `kursi_bus` (`id_kursi_bus`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD CONSTRAINT `harga_ibfk_1` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`) ON DELETE CASCADE,
  ADD CONSTRAINT `harga_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_bus_rute`) REFERENCES `bus_rute` (`id_bus_rute`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kursi_bus`
--
ALTER TABLE `kursi_bus`
  ADD CONSTRAINT `kursi_bus_ibfk_1` FOREIGN KEY (`id_bus`) REFERENCES `bus` (`id_bus`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

DELIMITER $$
--
-- Event
--
CREATE DEFINER=`root`@`localhost` EVENT `HAPUS_PEMESANAN_TANPA_DETAIL` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-01-02 13:06:28' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM pemesanan
  WHERE created_at < NOW() - INTERVAL 30 SECOND
  AND id_pemesanan NOT IN (SELECT DISTINCT id_pemesanan FROM detail_pemesanan)$$

CREATE DEFINER=`root`@`localhost` EVENT `update_kursi_status` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-02-17 14:30:30' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE kursi_bus
    JOIN bus ON kursi_bus.id_bus = bus.id_bus
    JOIN bus_rute ON bus_rute.id_bus = bus.id_bus
    JOIN jadwal ON jadwal.id_bus_rute = bus_rute.id_bus_rute
    SET kursi_bus.status = 'Available'
    WHERE kursi_bus.status = 'Booked'
      AND jadwal.waktu_berangkat <= NOW();
END$$

CREATE DEFINER=`root`@`localhost` EVENT `delete_old_jadwal` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-02-17 14:31:44' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    DELETE FROM jadwal
    WHERE waktu_tiba <= NOW();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
