-- ============================================================
-- MIGRATION: Survey Kepuasan Pasien RS
-- Database: db_survey
-- Versi: 2.0
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ============================================================
-- 1. UPDATE TABEL users
-- ============================================================
-- Hapus enum lama, ganti dengan role yang benar:
-- '1' = Superadmin, '2' = Admin

ALTER TABLE `users`
  MODIFY `is_role` enum('1','2') NOT NULL COMMENT '1=superadmin, 2=admin',
  ADD UNIQUE KEY `uk_username` (`username`);

-- Update password superadmin lama ke hash baru (password: superadmin)
UPDATE `users` SET
  `password` = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
  `unit` = 'Administrator',
  `is_role` = '1',
  `is_active` = '1'
WHERE `username` = 'superadmin';

-- Insert admin default (password: admin123)
INSERT INTO `users` (`username`, `password`, `unit`, `is_role`, `is_active`, `created_at`, `updated_at`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin RS', '2', '1', NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();

-- ============================================================
-- 2. TABEL rooms (Ruangan)
-- ============================================================
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Nama ruangan',
  `slug` varchar(100) NOT NULL COMMENT 'URL slug (lowercase, underscore)',
  `floor` int(11) DEFAULT NULL COMMENT 'Nomor lantai',
  `facility_type` varchar(100) DEFAULT NULL COMMENT 'Tipe fasilitas',
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample rooms
INSERT INTO `rooms` (`name`, `slug`, `floor`, `facility_type`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
('Toilet Lantai 1', 'toilet_lantai_1', 1, 'Toilet Umum', '1', 1, NOW(), NOW()),
('Toilet Lantai 2', 'toilet_lantai_2', 2, 'Toilet Poli Eksekutif', '1', 2, NOW(), NOW()),
('Ruang Mawar', 'ruang_mawar', 3, 'Kamar Rawat Inap', '1', 3, NOW(), NOW()),
('Ruang Melati', 'ruang_melati', 4, 'Kamar Rawat Inap', '1', 4, NOW(), NOW()),
('Administrasi Rawat Inap', 'administrasi_rawat_inap', 1, 'Counter Administrasi', '1', 5, NOW(), NOW()),
('Perawat Rawat Inap', 'perawat_rawat_inap', 5, 'Unit Perawatan', '1', 6, NOW(), NOW());

-- ============================================================
-- 3. TABEL survey_questions (Pertanyaan Survei)
-- ============================================================
CREATE TABLE IF NOT EXISTS `survey_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL COMMENT 'Foreign key ke rooms',
  `question_text` text NOT NULL COMMENT 'Teks pertanyaan',
  `question_type` enum('radio','checkbox','text') NOT NULL DEFAULT 'radio'
    COMMENT 'radio=pilihan ganda single, checkbox=pilihan ganda multi, text=bebas',
  `options` json DEFAULT NULL COMMENT 'Array opsi untuk radio/checkbox: ["Opsi 1","Opsi 2"]',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_question_room` (`room_id`),
  CONSTRAINT `fk_question_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 4. TABEL survey_responses (Jawaban Survei)
-- ============================================================
CREATE TABLE IF NOT EXISTS `survey_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `respondent_name` varchar(100) DEFAULT NULL COMMENT 'Nama respondent (opsional)',
  `satisfaction_score` int(11) NOT NULL COMMENT 'Rating 1-5',
  `feedback` text DEFAULT NULL COMMENT 'Komentar bebas',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_response_room` (`room_id`),
  CONSTRAINT `fk_response_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 5. TABEL response_answers (Jawaban Per Pertanyaan)
-- ============================================================
CREATE TABLE IF NOT EXISTS `response_answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `response_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_text` text DEFAULT NULL COMMENT 'Jawaban: teks, atau JSON array untuk checkbox',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_answer_response` (`response_id`),
  KEY `fk_answer_question` (`question_id`),
  CONSTRAINT `fk_answer_response` FOREIGN KEY (`response_id`) REFERENCES `survey_responses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_answer_question` FOREIGN KEY (`question_id`) REFERENCES `survey_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- 6. INSERT CONTOH PERTANYAAN PER RUANGAN
-- ============================================================

-- Toilet Lantai 1
INSERT INTO `survey_questions` (`room_id`, `question_text`, `question_type`, `options`, `sort_order`, `is_active`) VALUES
(1, 'Bagaimana kebersihan toilet ini?', 'radio', '["Sangat Bersih","Bersih","Cukup","Kurang","Tidak Bersih"]', 1, '1'),
(1, 'Apakah perlengkapan toilet tersedia lengkap?', 'checkbox', '["Sabun","Tisu","Handuk","Parfum","Sarung Tangan"]', 2, '1'),
(1, 'Saran atau masukan untuk perbaikan toilet ini?', 'text', NULL, 3, '1');

-- Toilet Lantai 2
INSERT INTO `survey_questions` (`room_id`, `question_text`, `question_type`, `options`, `sort_order`, `is_active`) VALUES
(2, 'Bagaimana kebersihan toilet ini?', 'radio', '["Sangat Bersih","Bersih","Cukup","Kurang","Tidak Bersih"]', 1, '1'),
(2, 'Apakah perlengkapan toilet tersedia lengkap?', 'checkbox', '["Sabun","Tisu","Handuk","Parfum","Sarung Tangan"]', 2, '1'),
(2, 'Saran atau masukan untuk perbaikan toilet ini?', 'text', NULL, 3, '1');

-- Ruang Mawar
INSERT INTO `survey_questions` (`room_id`, `question_text`, `question_type`, `options`, `sort_order`, `is_active`) VALUES
(3, 'Bagaimana pelayanan perawat di ruangan ini?', 'radio', '["Sangat Baik","Baik","Cukup","Kurang","Buruk"]', 1, '1'),
(3, 'Apakah Anda puas dengan kebersihan ruangan?', 'radio', '["Sangat Puas","Puas","Cukup","Tidak Puas","Sangat Tidak Puas"]', 2, '1'),
(3, 'Fasilitas apa yang menurut Anda perlu diperbaiki?', 'checkbox', '["AC","Tempat Tidur","Kamar Mandi","TV","Lemari"]', 3, '1'),
(3, 'Komentar atau saran Anda?', 'text', NULL, 4, '1');

-- Ruang Melati
INSERT INTO `survey_questions` (`room_id`, `question_text`, `question_type`, `options`, `sort_order`, `is_active`) VALUES
(4, 'Bagaimana pelayanan perawat di ruangan ini?', 'radio', '["Sangat Baik","Baik","Cukup","Kurang","Buruk"]', 1, '1'),
(4, 'Apakah Anda puas dengan kebersihan ruangan?', 'radio', '["Sangat Puas","Puas","Cukup","Tidak Puas","Sangat Tidak Puas"]', 2, '1'),
(4, 'Fasilitas apa yang menurut Anda perlu diperbaiki?', 'checkbox', '["AC","Tempat Tidur","Kamar Mandi","TV","Lemari"]', 3, '1'),
(4, 'Komentar atau saran Anda?', 'text', NULL, 4, '1');

-- Administrasi Rawat Inap
INSERT INTO `survey_questions` (`room_id`, `question_text`, `question_type`, `options`, `sort_order`, `is_active`) VALUES
(5, 'Bagaimana pelayanan petugas administrasi?', 'radio', '["Sangat Ramah","Ramah","Cukup","Kurang","Tidak Ramah"]', 1, '1'),
(5, 'Apakah proses administrasi berjalan lancar?', 'radio', '["Sangat Lancar","Lancar","Cukup","Kurang","Tidak Lancar"]', 2, '1'),
(5, 'Saran atau masukan untuk perbaikan pelayanan?', 'text', NULL, 3, '1');

-- Perawat Rawat Inap
INSERT INTO `survey_questions` (`room_id`, `question_text`, `question_type`, `options`, `sort_order`, `is_active`) VALUES
(6, 'Bagaimana responsivitas perawat saat dipanggil?', 'radio', '["Sangat Cepat","Cepat","Cukup","Lambat","Sangat Lambat"]', 1, '1'),
(6, 'Apakah perawat menjelaskan prosedur dengan jelas?', 'radio', '["Sangat Jelas","Jelas","Cukup","Kurang","Tidak Jelas"]', 2, '1'),
(6, 'Komentar atau saran Anda?', 'text', NULL, 3, '1');

-- ============================================================
-- 7. MIGRATE DATA LAMA (opsional)
-- ============================================================
-- Data lama di tb_survey tetap dipertahankan untuk referensi
-- Tidak dihapus untuk backward compatibility

COMMIT;
