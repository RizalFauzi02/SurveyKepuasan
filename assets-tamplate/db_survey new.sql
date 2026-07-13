-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2026 at 03:35 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

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
-- Table structure for table `response_answers`
--

CREATE TABLE `response_answers` (
  `id` int NOT NULL,
  `response_id` int NOT NULL,
  `question_id` int NOT NULL,
  `answer_text` text COMMENT 'Jawaban: teks, atau JSON array untuk checkbox',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Nama ruangan',
  `slug` varchar(100) NOT NULL COMMENT 'URL slug (lowercase, underscore)',
  `floor` int DEFAULT NULL COMMENT 'Nomor lantai',
  `facility_type` varchar(100) DEFAULT NULL COMMENT 'Tipe fasilitas',
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `slug`, `floor`, `facility_type`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Toilet Lantai 1', 'toilet_lantai_1', 1, 'Toilet Umum', '1', 1, '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(2, 'Toilet Lantai 2', 'toilet_lantai_2', 2, 'Toilet Poli Eksekutif', '1', 2, '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(3, 'Ruang Mawar', 'ruang_mawar', 3, 'Kamar Rawat Inap', '1', 3, '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(4, 'Ruang Melati', 'ruang_melati', 4, 'Kamar Rawat Inap', '1', 4, '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(5, 'Administrasi Rawat Inap', 'administrasi_rawat_inap', 1, 'Counter Administrasi', '1', 5, '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(6, 'Perawat Rawat Inap', 'perawat_rawat_inap', 5, 'Unit Perawatan', '1', 6, '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(8, 'Test', 'unique_slug_1783834427', 1, 'Type', '1', 0, '2026-07-12 05:33:47', '2026-07-12 05:33:47'),
(72, 'Lobby', 'lobby', 1, 'Lobby Area', '1', 1, '2026-07-13 01:26:04', '2026-07-13 01:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `id` int NOT NULL,
  `room_id` int NOT NULL COMMENT 'Foreign key ke rooms',
  `question_text` text NOT NULL COMMENT 'Teks pertanyaan',
  `question_type` enum('radio','checkbox','text') NOT NULL DEFAULT 'radio' COMMENT 'radio=pilihan ganda single, checkbox=pilihan ganda multi, text=bebas',
  `options` json DEFAULT NULL COMMENT 'Array opsi untuk radio/checkbox: ["Opsi 1","Opsi 2"]',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`id`, `room_id`, `question_text`, `question_type`, `options`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bagaimana kebersihan toilet ini?', 'radio', '[\"Sangat Bersih\", \"Bersih\", \"Cukup\", \"Kurang\", \"Tidak Bersih\"]', 1, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(2, 1, 'Apakah perlengkapan toilet tersedia lengkap?', 'checkbox', '[\"Sabun\", \"Tisu\", \"Handuk\", \"Parfum\", \"Sarung Tangan\"]', 2, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(3, 1, 'Saran atau masukan untuk perbaikan toilet ini?', 'text', NULL, 3, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(4, 2, 'Bagaimana kebersihan toilet ini?', 'radio', '[\"Sangat Bersih\", \"Bersih\", \"Cukup\", \"Kurang\", \"Tidak Bersih\"]', 1, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(5, 2, 'Apakah perlengkapan toilet tersedia lengkap?', 'checkbox', '[\"Sabun\", \"Tisu\", \"Handuk\", \"Parfum\", \"Sarung Tangan\"]', 2, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(6, 2, 'Saran atau masukan untuk perbaikan toilet ini?', 'text', NULL, 3, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(7, 3, 'Bagaimana pelayanan perawat di ruangan ini?', 'radio', '[\"Sangat Baik\", \"Baik\", \"Cukup\", \"Kurang\", \"Buruk\"]', 1, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(8, 3, 'Apakah Anda puas dengan kebersihan ruangan?', 'radio', '[\"Sangat Puas\", \"Puas\", \"Cukup\", \"Tidak Puas\", \"Sangat Tidak Puas\"]', 2, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(9, 3, 'Fasilitas apa yang menurut Anda perlu diperbaiki?', 'checkbox', '[\"AC\", \"Tempat Tidur\", \"Kamar Mandi\", \"TV\", \"Lemari\"]', 3, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(10, 3, 'Komentar atau saran Anda?', 'text', NULL, 4, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(11, 4, 'Bagaimana pelayanan perawat di ruangan ini?', 'radio', '[\"Sangat Baik\", \"Baik\", \"Cukup\", \"Kurang\", \"Buruk\"]', 1, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(12, 4, 'Apakah Anda puas dengan kebersihan ruangan?', 'radio', '[\"Sangat Puas\", \"Puas\", \"Cukup\", \"Tidak Puas\", \"Sangat Tidak Puas\"]', 2, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(13, 4, 'Fasilitas apa yang menurut Anda perlu diperbaiki?', 'checkbox', '[\"AC\", \"Tempat Tidur\", \"Kamar Mandi\", \"TV\", \"Lemari\"]', 3, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(14, 4, 'Komentar atau saran Anda?', 'text', NULL, 4, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(15, 5, 'Bagaimana pelayanan petugas administrasi?', 'radio', '[\"Sangat Ramah\", \"Ramah\", \"Cukup\", \"Kurang\", \"Tidak Ramah\"]', 1, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(16, 5, 'Apakah proses administrasi berjalan lancar?', 'radio', '[\"Sangat Lancar\", \"Lancar\", \"Cukup\", \"Kurang\", \"Tidak Lancar\"]', 2, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(17, 5, 'Saran atau masukan untuk perbaikan pelayanan?', 'text', NULL, 3, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(18, 6, 'Bagaimana responsivitas perawat saat dipanggil?', 'radio', '[\"Sangat Cepat\", \"Cepat\", \"Cukup\", \"Lambat\", \"Sangat Lambat\"]', 1, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(19, 6, 'Apakah perawat menjelaskan prosedur dengan jelas?', 'radio', '[\"Sangat Jelas\", \"Jelas\", \"Cukup\", \"Kurang\", \"Tidak Jelas\"]', 2, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(20, 6, 'Komentar atau saran Anda?', 'text', NULL, 3, '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `survey_responses`
--

CREATE TABLE `survey_responses` (
  `id` int NOT NULL,
  `room_id` int NOT NULL,
  `respondent_name` varchar(100) DEFAULT NULL COMMENT 'Nama respondent (opsional)',
  `satisfaction_score` int NOT NULL COMMENT 'Rating 1-5',
  `feedback` text COMMENT 'Komentar bebas',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_survey`
--

CREATE TABLE `tb_survey` (
  `id_survey` int NOT NULL,
  `nama_lokasi` text,
  `lantai` int DEFAULT NULL,
  `tipe_fasilitas` text,
  `survey_kepuasan` int DEFAULT NULL,
  `survey_memuaskan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_survey`
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
(13, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 5, 'Petugas ramah dan sopan, Berpenampilan rapi dengan seragam jelas', '2026-03-27 18:09:26', '2026-03-27 18:09:26'),
(14, 'Toilet Umum Wanita', 2, 'Toilet Poli Eksekutif - Lantai 2', 1, 'Petugas ramah dan sopan', '2026-07-12 01:51:06', '2026-07-12 01:51:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `is_role` enum('1','2') NOT NULL COMMENT '1=superadmin, 2=admin',
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `unit`, `is_role`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', '1', '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57'),
(4, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin RS', '2', '1', '2026-07-12 05:31:57', '2026-07-12 05:31:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `response_answers`
--
ALTER TABLE `response_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_answer_response` (`response_id`),
  ADD KEY `fk_answer_question` (`question_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_slug` (`slug`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_question_room` (`room_id`);

--
-- Indexes for table `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_response_room` (`room_id`);

--
-- Indexes for table `tb_survey`
--
ALTER TABLE `tb_survey`
  ADD PRIMARY KEY (`id_survey`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `uk_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `response_answers`
--
ALTER TABLE `response_answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `survey_responses`
--
ALTER TABLE `survey_responses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_survey`
--
ALTER TABLE `tb_survey`
  MODIFY `id_survey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `response_answers`
--
ALTER TABLE `response_answers`
  ADD CONSTRAINT `fk_answer_question` FOREIGN KEY (`question_id`) REFERENCES `survey_questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_answer_response` FOREIGN KEY (`response_id`) REFERENCES `survey_responses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD CONSTRAINT `fk_question_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD CONSTRAINT `fk_response_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
