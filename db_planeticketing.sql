-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Mar 2025 pada 14.07
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
-- Database: `db_planeticketing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_detail_pemesanan` int(11) NOT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `id_kursi_plane` int(11) DEFAULT NULL,
  `nama_penumpang` varchar(100) DEFAULT NULL,
  `nomor_identitas` varchar(50) DEFAULT NULL,
  `harga_kursi` decimal(10,2) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`id_detail_pemesanan`, `id_pemesanan`, `id_kursi_plane`, `nama_penumpang`, `nomor_identitas`, `harga_kursi`, `total_harga`, `created_at`, `updated_at`) VALUES
(7, 19, 2, 'Habib', '3213', 400000.00, 400000.00, '2025-02-28 08:52:20', '2025-02-28 08:52:20');

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
(1, 1, 1, 400000.00, '2025-02-28 03:55:24', '2025-02-28 03:55:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_plane_rute` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu_berangkat` time DEFAULT NULL,
  `waktu_tiba` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_plane_rute`, `tanggal`, `waktu_berangkat`, `waktu_tiba`, `created_at`, `updated_at`) VALUES
(2, 1, '2025-02-28', '21:00:00', '23:00:00', '2025-02-28 08:45:53', '2025-02-28 08:51:29');

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
(1, 'Bisnis', '2025-02-28 02:54:39', '2025-02-28 02:54:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kursi_plane`
--

CREATE TABLE `kursi_plane` (
  `id_kursi_plane` int(11) NOT NULL,
  `id_plane` int(11) DEFAULT NULL,
  `nomor_kursi` varchar(10) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `status` enum('Available','Booked') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kursi_plane`
--

INSERT INTO `kursi_plane` (`id_kursi_plane`, `id_plane`, `nomor_kursi`, `id_kelas`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'B1', 1, 'Booked', '2025-02-28 03:39:18', '2025-02-28 06:58:28'),
(2, 2, 'B2', 1, 'Booked', '2025-02-28 03:39:18', '2025-02-28 08:52:29'),
(3, 2, 'B3', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 06:57:49'),
(4, 2, 'B4', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(5, 2, 'B5', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(6, 2, 'B6', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(7, 2, 'B7', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(8, 2, 'B8', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(9, 2, 'B9', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(10, 2, 'B10', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(11, 2, 'B11', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(12, 2, 'B12', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(13, 2, 'B13', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(14, 2, 'B14', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(15, 2, 'B15', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(16, 2, 'B16', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(17, 2, 'B17', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(18, 2, 'B18', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(19, 2, 'B19', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18'),
(20, 2, 'B20', 1, 'Available', '2025-02-28 03:39:18', '2025-02-28 03:39:18');

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
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `tanggal_pemesanan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Pending','Confirmed','Cancelled','Booking') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_pengguna`, `id_jadwal`, `tanggal_pemesanan`, `status`, `created_at`, `updated_at`) VALUES
(19, 2, 2, '2025-02-28 08:52:29', 'Booking', '2025-02-28 08:52:14', '2025-02-28 08:52:29');

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
  `photo_profile` blob DEFAULT NULL,
  `role` enum('Admin','Penumpang') DEFAULT 'Penumpang',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `email`, `password`, `nomor_telepon`, `photo_profile`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Franklin Sebatian Felix', 'franklinchang0129@gmail.com', '$2y$12$SCv7k9X1FafSndESUj028eLi0AJnCYMbgqyt8z8/hnzcrzVuyTw..', '0849132412', NULL, 'Admin', '2025-02-28 02:53:31', '2025-02-28 02:54:27'),
(2, 'Haikal', 'im@gmail.com', '$2y$12$KBb.VjNHlsNJu49cLdmOfeJmUdULB8rCM1Uz47rno90kxxTGImFjS', '084913249321', 0x7374617469632f696d672f646174615f70656e6767756e612f5a65652e6a7067, 'Penumpang', '2025-02-28 03:53:20', '2025-02-28 04:39:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `plane`
--

CREATE TABLE `plane` (
  `id_plane` int(11) NOT NULL,
  `nama_maskapai` varchar(20) DEFAULT NULL,
  `nomor_regis` varchar(10) DEFAULT NULL,
  `nomor_penerbangan` varchar(10) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `plane`
--

INSERT INTO `plane` (`id_plane`, `nama_maskapai`, `nomor_regis`, `nomor_penerbangan`, `kapasitas`, `created_at`, `updated_at`) VALUES
(1, 'Lion Air', 'PK-AXD', 'LA 321', 20, '2025-02-28 03:12:49', '2025-02-28 03:18:17'),
(2, 'Lion Air', 'PK-AXF', 'LA 213', 20, '2025-02-28 03:28:21', '2025-02-28 03:28:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `plane_kelas`
--

CREATE TABLE `plane_kelas` (
  `id_plane` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `plane_kelas`
--

INSERT INTO `plane_kelas` (`id_plane`, `id_kelas`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `plane_rute`
--

CREATE TABLE `plane_rute` (
  `id_plane_rute` int(11) NOT NULL,
  `id_plane` int(11) DEFAULT NULL,
  `id_rute` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `plane_rute`
--

INSERT INTO `plane_rute` (`id_plane_rute`, `id_plane`, `id_rute`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-02-28 03:26:36', '2025-02-28 03:28:31');

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
(1, 'Batam', 'Singapura', 25.00, '2025-02-28 03:20:11', '2025-02-28 03:20:11');

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
('hl1J7QMBJm5wVcVxWLUXv1YG8MAVNC6PPM1wr2yH', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', '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', 1740733137),
('KqplKeooxBMDe13afQjDclpG88r4ybUlTerqNzzU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3NZdEVKbzJCQ0llRU9BZFkxY3JXUjlEbWN6WkRCYlRlTUp1R3lyMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1740790076),
('Pa77h7SXT3BxYFfOeQdM2udfAVJVvwUQIjYHlONA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXl3em1pR3ZHbnlsbnZNRnVGQlU1Q1F3VE1mQ0xOclRFMExXTTJacCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1741053834),
('sRCYOLwtphYtotpZHIi7oU9auy3jGFQqQ6JppVMA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHBaWklOZ29SMHllSmU1Ym9HQ0xlblFIOE1BSEEzNFJhU1VwbDVEYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1741053833);

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
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `id_pemesanan`, `id_pengguna`, `bukti_pembayaran`, `tanggal_pembayaran`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(10, 19, 2, 0x7374617469632f696d672f646174615f7472616e73616374696f6e2f42756b74692050656d6261796172616e20446f6d61696e20436c6f756442616e6b2e6a706567, '2025-02-28', 'Completed', '2025-02-28 08:52:20', '2025-02-28 08:52:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id_detail_pemesanan`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_kursi_plane` (`id_kursi_plane`);

--
-- Indeks untuk tabel `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`),
  ADD KEY `id_rute` (`id_rute`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_plane_rute` (`id_plane_rute`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `kursi_plane`
--
ALTER TABLE `kursi_plane`
  ADD PRIMARY KEY (`id_kursi_plane`),
  ADD KEY `id_plane` (`id_plane`),
  ADD KEY `id_kelas` (`id_kelas`);

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
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `plane`
--
ALTER TABLE `plane`
  ADD PRIMARY KEY (`id_plane`);

--
-- Indeks untuk tabel `plane_kelas`
--
ALTER TABLE `plane_kelas`
  ADD KEY `id_plane` (`id_plane`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `plane_rute`
--
ALTER TABLE `plane_rute`
  ADD PRIMARY KEY (`id_plane_rute`),
  ADD KEY `id_plane` (`id_plane`),
  ADD KEY `id_rute` (`id_rute`);

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
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id_detail_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kursi_plane`
--
ALTER TABLE `kursi_plane`
  MODIFY `id_kursi_plane` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `plane`
--
ALTER TABLE `plane`
  MODIFY `id_plane` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `plane_rute`
--
ALTER TABLE `plane_rute`
  MODIFY `id_plane_rute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rute`
--
ALTER TABLE `rute`
  MODIFY `id_rute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`id_kursi_plane`) REFERENCES `kursi_plane` (`id_kursi_plane`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_plane_rute`) REFERENCES `plane_rute` (`id_plane_rute`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kursi_plane`
--
ALTER TABLE `kursi_plane`
  ADD CONSTRAINT `kursi_plane_ibfk_1` FOREIGN KEY (`id_plane`) REFERENCES `plane` (`id_plane`) ON DELETE CASCADE,
  ADD CONSTRAINT `kursi_plane_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `plane_kelas`
--
ALTER TABLE `plane_kelas`
  ADD CONSTRAINT `plane_kelas_ibfk_1` FOREIGN KEY (`id_plane`) REFERENCES `plane` (`id_plane`) ON DELETE CASCADE,
  ADD CONSTRAINT `plane_kelas_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `plane_rute`
--
ALTER TABLE `plane_rute`
  ADD CONSTRAINT `plane_rute_ibfk_1` FOREIGN KEY (`id_plane`) REFERENCES `plane` (`id_plane`) ON DELETE CASCADE,
  ADD CONSTRAINT `plane_rute_ibfk_2` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE;

DELIMITER $$
--
-- Event
--
CREATE DEFINER=`root`@`localhost` EVENT `HAPUS_PEMESANAN_TANPA_DETAIL` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-01-02 13:06:28' ON COMPLETION PRESERVE ENABLE DO BEGIN
    DELETE FROM pemesanan
    WHERE created_at < NOW() - INTERVAL 300 SECOND
    AND id_pemesanan NOT IN (
        SELECT DISTINCT id_pemesanan FROM detail_pemesanan
    );
END$$

CREATE DEFINER=`root`@`localhost` EVENT `update_kursi_status` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-02-17 14:30:30' ON COMPLETION PRESERVE ENABLE DO BEGIN
    UPDATE kursi_bus
    JOIN bus ON kursi_bus.id_bus = bus.id_bus
    JOIN bus_rute ON bus_rute.id_bus = bus.id_bus
    JOIN jadwal ON jadwal.id_bus_rute = bus_rute.id_bus_rute
    SET kursi_bus.status = 'Available'
    WHERE kursi_bus.status = 'Booked'
    AND jadwal.waktu_berangkat <= NOW();
END$$

CREATE DEFINER=`root`@`localhost` EVENT `delete_old_jadwal` ON SCHEDULE EVERY 1 MINUTE STARTS '2025-02-17 14:31:44' ON COMPLETION PRESERVE ENABLE DO BEGIN
    DELETE FROM jadwal
    WHERE waktu_tiba <= NOW();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
