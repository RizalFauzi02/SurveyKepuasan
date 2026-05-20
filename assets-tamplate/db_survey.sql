-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Bulan Mei 2026 pada 11.04
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_survey`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_survey`
--

CREATE TABLE `tb_survey` (
  `id_survey` int(11) NOT NULL,
  `nama_lokasi` text DEFAULT NULL,
  `lantai` int(11) DEFAULT NULL,
  `tipe_fasilitas` text DEFAULT NULL,
  `survey_kepuasan` int(11) DEFAULT NULL,
  `survey_memuaskan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_survey`
--

INSERT INTO `tb_survey` (`id_survey`, `nama_lokasi`, `lantai`, `tipe_fasilitas`, `survey_kepuasan`, `survey_memuaskan`, `created_at`, `updated_at`) VALUES
(1, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 4, 'Petugas ramah dan sopan, Berpenampilan rapi dengan seragam jelas, Lainnya: Bersih dan wangi', '2026-03-26 17:40:33', '2026-03-26 17:40:33'),
(2, 'Administrasi Rawat Inap', 1, 'Counter 1 - Administrasi Rawat Inap', 3, 'Petugas ramah dan sopan, Berpenampilan rapi dengan seragam jelas, Cepat tanggap saat membantu pasien', '2026-03-26 17:41:29', '2026-03-26 17:41:29'),
(3, 'Perawat Rawat Inap', 5, 'Emerald Diamond - Perawat Rawat Inap', 5, 'Petugas ramah dan sopan, Lainnya: garcep ketika diminta tolong', '2026-03-26 17:42:06', '2026-03-26 17:42:06'),
(4, 'Kamar Rawat Inap', 8, 'Crystal - 801', 1, 'Lainnya: kamar mandinya bauuuu', '2026-03-26 17:43:13', '2026-03-26 17:43:13'),
(5, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 2, 'Petugas ramah dan sopan, Berpenampilan rapi dengan seragam jelas, Cepat tanggap saat membantu pasien, Jumlah petugas cukup, Lainnya: BAGUSS BANGET', '2026-03-27 18:04:30', '2026-03-27 18:04:30'),
(6, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 1, 'Petugas ramah dan sopan, Berpenampilan rapi dengan seragam jelas', '2026-03-27 18:06:16', '2026-03-27 18:06:16'),
(7, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 4, 'Jumlah petugas cukup, Cepat tanggap saat membantu pasien, Berpenampilan rapi dengan seragam jelas', '2026-03-27 18:06:22', '2026-03-27 18:06:22'),
(8, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 2, 'Berpenampilan rapi dengan seragam jelas, Cepat tanggap saat membantu pasien, Jumlah petugas cukup, Petugas ramah dan sopan', '2026-03-27 18:06:27', '2026-03-27 18:06:27'),
(9, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 5, 'Petugas ramah dan sopan', '2026-03-27 18:06:34', '2026-03-27 18:06:34'),
(10, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 5, 'Cepat tanggap saat membantu pasien, Jumlah petugas cukup', '2026-03-27 18:09:07', '2026-03-27 18:09:07'),
(11, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 5, 'Lainnya: mmmmmmm', '2026-03-27 18:09:16', '2026-03-27 18:09:16'),
(12, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 5, 'Cepat tanggap saat membantu pasien, Berpenampilan rapi dengan seragam jelas', '2026-03-27 18:09:20', '2026-03-27 18:09:20'),
(13, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 5, 'Petugas ramah dan sopan, Berpenampilan rapi dengan seragam jelas', '2026-03-27 18:09:26', '2026-03-27 18:09:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `is_role` enum('1','2','3') NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `unit`, `is_role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '$2y$10$UVxYwsbPaGOcIX.UeeJN9unXg5iItCR8yrQmVv7R92vx/XIqMHhFm', 'Administrator', '1', '1', '2026-03-26 13:59:01', '2026-03-26 13:59:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_survey`
--
ALTER TABLE `tb_survey`
  ADD PRIMARY KEY (`id_survey`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_survey`
--
ALTER TABLE `tb_survey`
  MODIFY `id_survey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
