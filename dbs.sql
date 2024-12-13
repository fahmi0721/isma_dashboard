-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for isma_dashboard
DROP DATABASE IF EXISTS `isma_dashboard`;
CREATE DATABASE IF NOT EXISTS `isma_dashboard` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `isma_dashboard`;

-- Dumping structure for table isma_dashboard.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.migrations: ~13 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(4, '2024_11_30_115258_create_periode_tables', 2),
	(5, '2024_12_02_152154_create_table_entitas', 3),
	(6, '2024_12_02_152605_create_table_kategori_project', 3),
	(7, '2024_12_02_152643_create_table_project', 3),
	(8, '2024_12_04_075219_create_table_tenaga_kerja', 4),
	(9, '2024_12_04_080044_create_table_tipe_jabatan', 5),
	(10, '2024_12_04_080219_create_table_jabatan', 6),
	(11, '2024_12_05_081307_create_tabel_tb_rkap', 7),
	(12, '2024_12_10_020242_create_table_tb_pbl', 8),
	(13, '2024_12_13_085008_create_table_tb_biaya_project', 9);

-- Dumping structure for table isma_dashboard.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table isma_dashboard.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table isma_dashboard.tb_entitas
DROP TABLE IF EXISTS `tb_entitas`;
CREATE TABLE IF NOT EXISTS `tb_entitas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('afiliasi','berelasi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.tb_entitas: ~3 rows (approximately)
DELETE FROM `tb_entitas`;
INSERT INTO `tb_entitas` (`id`, `nama`, `jenis`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 'PT PELINDO JASA MARITIM', 'afiliasi', 'SPJM', '2024-12-02 07:56:07', '2024-12-02 08:02:47'),
	(2, 'PT JASA ARMADA INDONESIA Tbk', 'afiliasi', 'PT JAI', '2024-12-02 08:02:36', NULL),
	(3, 'PT PELINDO MARINE SERVICE', 'afiliasi', 'PT PMS', '2024-12-02 08:03:14', NULL);

-- Dumping structure for table isma_dashboard.tb_jabatan
DROP TABLE IF EXISTS `tb_jabatan`;
CREATE TABLE IF NOT EXISTS `tb_jabatan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_type_id` bigint NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_jabatan_job_type_id_index` (`job_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.tb_jabatan: ~9 rows (approximately)
DELETE FROM `tb_jabatan`;
INSERT INTO `tb_jabatan` (`id`, `job_type_id`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(4, 1, 'Nahkoda', 'Nahkoda', '2024-12-04 08:11:01', NULL),
	(5, 2, 'KKM', 'Kepala Kamar Mesin', '2024-12-04 08:11:20', NULL),
	(6, 1, 'Mualim 1', 'Mualim 1', '2024-12-04 08:11:36', NULL),
	(7, 1, 'Mualim II', 'Mualim II', '2024-12-04 08:11:48', NULL),
	(8, 2, 'Masinis I', 'Masinis I', '2024-12-04 08:12:06', NULL),
	(9, 2, 'Masinis II', 'Masinis II', '2024-12-04 08:12:22', NULL),
	(10, 3, 'Juru Mudi', 'Juru Mudi', '2024-12-04 08:12:36', NULL),
	(11, 3, 'Juru Motor', 'Juru Motor', '2024-12-04 08:12:54', NULL),
	(12, 5, 'Pandu', 'Pandu', '2024-12-08 17:29:10', NULL);

-- Dumping structure for table isma_dashboard.tb_kategori_project
DROP TABLE IF EXISTS `tb_kategori_project`;
CREATE TABLE IF NOT EXISTS `tb_kategori_project` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.tb_kategori_project: ~2 rows (approximately)
DELETE FROM `tb_kategori_project`;
INSERT INTO `tb_kategori_project` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 'Tenaga Kerja Crewing', 'Tenega Kerja Basis ABK', '2024-12-02 08:17:07', NULL),
	(2, 'Tenaga Kerja Pandu', 'Pandu', '2024-12-02 08:19:21', NULL);

-- Dumping structure for table isma_dashboard.tb_pbl
DROP TABLE IF EXISTS `tb_pbl`;
CREATE TABLE IF NOT EXISTS `tb_pbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `periode_id` bigint NOT NULL,
  `pendapatan` bigint NOT NULL,
  `biaya` bigint NOT NULL,
  `laba_rugi` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_pbl_periode_id_unique` (`periode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.tb_pbl: ~11 rows (approximately)
DELETE FROM `tb_pbl`;
INSERT INTO `tb_pbl` (`id`, `periode_id`, `pendapatan`, `biaya`, `laba_rugi`, `created_at`, `updated_at`) VALUES
	(4, 14, 12530000000, 12300000000, 210000000, '2024-12-09 19:06:19', NULL),
	(5, 15, 25010000000, 24000000000, 610000000, '2024-12-09 19:07:37', NULL),
	(6, 16, 40150000000, 39300000000, 730000000, '2024-12-09 19:21:21', NULL),
	(7, 17, 51180000000, 50200000000, 880000000, '2024-12-09 19:25:19', NULL),
	(8, 18, 62110000000, 61100000000, 970000000, '2024-12-09 19:28:19', NULL),
	(9, 19, 80470000000, 79300000000, 1060000000, '2024-12-09 19:31:23', NULL),
	(10, 20, 93890000000, 92400000000, 1290000000, '2024-12-09 19:33:58', NULL),
	(11, 21, 109090000000, 107100000000, 1290000000, '2024-12-09 19:37:31', NULL),
	(12, 22, 124920000000, 122700000000, 1910000000, '2024-12-09 19:44:20', NULL),
	(13, 23, 141980000000, 139000000000, 2530000000, '2024-12-09 19:47:13', NULL),
	(14, 24, 156830000000, 153500000000, 3000000000, '2024-12-12 00:03:05', NULL);

-- Dumping structure for table isma_dashboard.tb_pb_project
DROP TABLE IF EXISTS `tb_pb_project`;
CREATE TABLE IF NOT EXISTS `tb_pb_project` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint NOT NULL,
  `periode_id` bigint NOT NULL,
  `biaya` bigint NOT NULL,
  `pendapatan` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id_periode_id` (`project_id`,`periode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.tb_pb_project: ~10 rows (approximately)
DELETE FROM `tb_pb_project`;
INSERT INTO `tb_pb_project` (`id`, `project_id`, `periode_id`, `biaya`, `pendapatan`, `created_at`, `updated_at`) VALUES
	(1, 1, 24, 132100000000, 133300000000, '2024-12-13 01:16:09', NULL),
	(6, 3, 24, 122100000000, 122200000000, '2024-12-13 01:18:38', NULL),
	(7, 4, 24, 110000000000, 111000000000, '2024-12-13 01:19:38', NULL),
	(9, 5, 24, 144300000000, 144400000000, '2024-12-13 01:20:16', NULL),
	(11, 6, 24, 144400000000, 144500000000, '2024-12-13 01:20:45', NULL),
	(12, 1, 23, 144400000000, 144500000000, '2024-12-13 01:21:27', NULL),
	(13, 3, 23, 155400000000, 155500000000, '2024-12-13 01:22:02', NULL),
	(14, 4, 23, 133200000000, 133300000000, '2024-12-13 01:22:24', NULL),
	(15, 5, 23, 133000000000, 133100000000, '2024-12-13 01:22:45', NULL),
	(16, 7, 23, 122100000000, 122200000000, '2024-12-13 01:23:07', NULL);

-- Dumping structure for table isma_dashboard.tb_periode
DROP TABLE IF EXISTS `tb_periode`;
CREATE TABLE IF NOT EXISTS `tb_periode` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_periode_nama_unique` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.tb_periode: ~11 rows (approximately)
DELETE FROM `tb_periode`;
INSERT INTO `tb_periode` (`id`, `nama`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
	(14, '2024-01', 'Januari 2024', '0', '2024-11-30 11:06:11', '2024-12-09 19:06:53'),
	(15, '2024-02', 'Februari 2024', '0', '2024-11-30 11:06:23', '2024-12-09 19:08:00'),
	(16, '2024-03', 'Maret 2024', '0', '2024-12-02 01:02:19', '2024-12-09 19:21:36'),
	(17, '2024-04', 'April 2024', '0', '2024-12-02 01:02:33', '2024-12-09 19:25:59'),
	(18, '2024-05', 'Mei 2024', '0', '2024-12-02 01:02:45', '2024-12-09 19:28:36'),
	(19, '2024-06', 'Juni 2024', '0', '2024-12-02 01:02:55', '2024-12-09 19:31:39'),
	(20, '2024-07', 'Juli 2024', '0', '2024-12-02 01:03:47', '2024-12-09 19:34:13'),
	(21, '2024-08', 'Agustus 2024', '0', '2024-12-02 01:05:17', '2024-12-09 19:37:42'),
	(22, '2024-09', 'September 2024', '0', '2024-12-02 01:05:29', '2024-12-09 19:44:30'),
	(23, '2024-10', 'Oktober 2024', '0', '2024-12-02 01:05:40', '2024-12-13 01:23:54'),
	(24, '2024-11', 'November 2024', '1', '2024-12-02 01:06:17', '2024-12-13 01:23:56');

-- Dumping structure for table isma_dashboard.tb_project
DROP TABLE IF EXISTS `tb_project`;
CREATE TABLE IF NOT EXISTS `tb_project` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `entitas_id` bigint NOT NULL,
  `kategori_id` bigint NOT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_from` date NOT NULL,
  `valid_to` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_project_kode_unique` (`kode`),
  KEY `tb_project_entitas_id_index` (`entitas_id`),
  KEY `tb_project_kategori_id_index` (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.tb_project: ~8 rows (approximately)
DELETE FROM `tb_project`;
INSERT INTO `tb_project` (`id`, `entitas_id`, `kategori_id`, `kode`, `nama`, `deskripsi`, `valid_from`, `valid_to`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 'S/IS-2024-01-00001', 'Jasa Crew - PT Jasa Armada Indonesia Tbk', 'Crew Jai', '2024-07-01', '2025-06-30', '2024-12-03 22:22:27', NULL),
	(3, 3, 1, 'S/IS-2024-01-00002', 'Jasa Crew - PT Pelindo Marine Service - Crew PMS Regional 4', 'PMS Regional 4', '2024-01-01', '2024-12-31', '2024-12-03 23:41:50', '2024-12-04 06:54:54'),
	(4, 3, 1, 'S/IS-2024-01-00003', 'Jasa Crew - PT Pelindo Marine Service - Crew PMS Harga Satuan', 'PMS Regional 3', '2024-07-01', '2024-12-31', '2024-12-03 23:42:32', '2024-12-04 06:55:09'),
	(5, 3, 1, 'S/IS-2024-01-00004', 'Jasa Crew - PT Pelindo Marine Service - Crew PMS KPC Sangatta', 'PMS Sangatta', '2024-07-01', '2024-12-31', '2024-12-03 23:43:10', '2024-12-04 06:55:24'),
	(6, 3, 1, 'S/IS-2024-01-00005', 'Jasa Crew - PT Pelindo Marine Service - Crew PMS Regioal 1', 'PMS Regional 1', '2024-08-01', '2024-12-31', '2024-12-03 23:43:51', '2024-12-04 06:55:39'),
	(7, 1, 2, 'S/IS-2024-02-00001', 'Jasa TK Pandu - PT Pelindo Jasa Maritim - Pandu Wilayah 4', 'SPJM Wilyaha 4', '2024-01-01', '2024-12-31', '2024-12-03 23:44:35', '2024-12-04 06:55:54'),
	(8, 1, 2, 'S/IS-2024-02-00003', 'Jasa TK Pandu - PT Pelindo Jasa Maritim - Pandu Wilayah 2', 'SPJM Wilayah 2', '2024-01-01', '2024-12-31', '2024-12-03 23:46:14', '2024-12-04 06:56:08'),
	(9, 1, 2, 'S/IS-2024-02-00004', 'Jasa TK Pandu - PT Pelindo Jasa Maritim - Pandu Wilayah 4 (2 Orang)', 'SPJM wilayah 4 (2 Orang)', '2024-01-01', '2024-12-31', '2024-12-03 23:46:55', '2024-12-04 06:56:23');

-- Dumping structure for table isma_dashboard.tb_rkap
DROP TABLE IF EXISTS `tb_rkap`;
CREATE TABLE IF NOT EXISTS `tb_rkap` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendapatan` double NOT NULL DEFAULT '0',
  `biaya` double NOT NULL DEFAULT '0',
  `laba_rugi` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.tb_rkap: ~1 rows (approximately)
DELETE FROM `tb_rkap`;
INSERT INTO `tb_rkap` (`id`, `tahun`, `pendapatan`, `biaya`, `laba_rugi`, `created_at`, `updated_at`) VALUES
	(3, '2024', 156670000000, 152100000000, 3710000000, '2024-12-06 00:11:26', '2024-12-06 00:13:22');

-- Dumping structure for table isma_dashboard.tb_tenaga_kerja
DROP TABLE IF EXISTS `tb_tenaga_kerja`;
CREATE TABLE IF NOT EXISTS `tb_tenaga_kerja` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint NOT NULL,
  `periode_id` bigint NOT NULL,
  `job_id` bigint NOT NULL,
  `job_type_id` bigint NOT NULL,
  `jumlah_tk` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project_id` (`project_id`,`periode_id`,`job_id`),
  KEY `tb_tenaga_kerja_project_id_index` (`project_id`),
  KEY `tb_tenaga_kerja_periode_id_index` (`periode_id`),
  KEY `tb_tenaga_kerja_job_id_index` (`job_id`),
  KEY `tb_tenaga_kerja_job_type_id_index` (`job_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=399 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.tb_tenaga_kerja: ~369 rows (approximately)
DELETE FROM `tb_tenaga_kerja`;
INSERT INTO `tb_tenaga_kerja` (`id`, `project_id`, `periode_id`, `job_id`, `job_type_id`, `jumlah_tk`, `created_at`, `updated_at`) VALUES
	(11, 7, 14, 12, 5, 9, '2024-12-08 17:29:52', NULL),
	(12, 9, 14, 12, 5, 2, '2024-12-08 17:30:08', NULL),
	(13, 8, 14, 12, 5, 27, '2024-12-08 17:30:27', NULL),
	(14, 4, 14, 4, 1, 1, '2024-12-08 17:32:21', NULL),
	(15, 4, 14, 5, 2, 1, '2024-12-08 17:33:58', NULL),
	(16, 4, 14, 8, 2, 1, '2024-12-08 17:34:45', NULL),
	(17, 4, 14, 9, 2, 0, '2024-12-08 17:35:45', NULL),
	(18, 4, 14, 6, 1, 1, '2024-12-08 17:38:43', NULL),
	(19, 4, 14, 7, 1, 1, '2024-12-08 17:40:15', NULL),
	(20, 4, 14, 10, 3, 2, '2024-12-08 17:40:53', NULL),
	(21, 4, 14, 11, 3, 2, '2024-12-08 17:41:19', NULL),
	(22, 3, 14, 4, 1, 23, '2024-12-08 17:44:21', NULL),
	(23, 3, 14, 5, 2, 18, '2024-12-08 17:44:48', NULL),
	(24, 3, 14, 8, 2, 6, '2024-12-08 17:45:21', NULL),
	(25, 3, 14, 9, 2, 3, '2024-12-08 17:45:48', NULL),
	(26, 3, 14, 6, 1, 6, '2024-12-08 17:46:24', NULL),
	(27, 3, 14, 7, 1, 7, '2024-12-08 17:46:49', NULL),
	(28, 3, 14, 10, 3, 49, '2024-12-08 17:47:16', NULL),
	(29, 3, 14, 11, 3, 42, '2024-12-08 17:47:40', NULL),
	(30, 7, 15, 12, 5, 9, '2024-12-08 17:54:05', NULL),
	(31, 9, 15, 12, 5, 2, '2024-12-08 17:54:31', NULL),
	(32, 8, 15, 12, 5, 30, '2024-12-08 17:55:02', NULL),
	(33, 4, 15, 4, 1, 1, '2024-12-08 17:55:33', NULL),
	(34, 4, 15, 5, 2, 1, '2024-12-08 17:55:57', NULL),
	(35, 4, 15, 8, 2, 1, '2024-12-08 17:56:24', NULL),
	(36, 4, 15, 9, 2, 0, '2024-12-08 17:56:44', NULL),
	(37, 4, 15, 6, 1, 1, '2024-12-08 17:57:08', NULL),
	(38, 4, 15, 7, 1, 1, '2024-12-08 17:57:28', NULL),
	(39, 4, 15, 10, 3, 2, '2024-12-08 17:58:31', NULL),
	(40, 4, 15, 11, 3, 2, '2024-12-08 17:58:53', NULL),
	(41, 3, 15, 4, 1, 23, '2024-12-08 17:59:41', NULL),
	(42, 3, 15, 5, 2, 18, '2024-12-08 18:00:06', NULL),
	(43, 3, 15, 8, 2, 5, '2024-12-08 18:00:51', NULL),
	(44, 3, 15, 9, 2, 2, '2024-12-08 18:01:15', NULL),
	(45, 3, 15, 6, 1, 6, '2024-12-08 18:01:40', NULL),
	(46, 3, 15, 7, 1, 7, '2024-12-08 18:02:02', NULL),
	(47, 3, 15, 10, 3, 49, '2024-12-08 18:02:34', NULL),
	(48, 3, 15, 11, 3, 40, '2024-12-08 18:02:57', NULL),
	(49, 7, 16, 12, 5, 11, '2024-12-08 18:08:09', NULL),
	(50, 9, 16, 12, 5, 2, '2024-12-08 18:08:40', NULL),
	(51, 8, 16, 12, 5, 27, '2024-12-08 18:08:59', NULL),
	(52, 4, 16, 4, 1, 1, '2024-12-08 18:09:27', NULL),
	(53, 4, 16, 5, 2, 1, '2024-12-08 18:09:52', NULL),
	(54, 4, 16, 8, 2, 1, '2024-12-08 18:10:16', NULL),
	(55, 4, 16, 9, 2, 0, '2024-12-08 18:10:34', NULL),
	(56, 4, 16, 6, 1, 1, '2024-12-08 18:11:00', NULL),
	(57, 4, 16, 7, 1, 1, '2024-12-08 18:11:28', NULL),
	(58, 4, 16, 10, 3, 2, '2024-12-08 18:12:04', NULL),
	(59, 4, 16, 11, 3, 2, '2024-12-08 18:12:20', NULL),
	(60, 3, 16, 4, 1, 25, '2024-12-08 18:13:11', NULL),
	(61, 3, 16, 5, 2, 18, '2024-12-08 18:13:30', NULL),
	(62, 3, 16, 8, 2, 5, '2024-12-08 18:13:53', NULL),
	(63, 3, 16, 9, 2, 2, '2024-12-08 18:14:09', NULL),
	(65, 3, 16, 6, 1, 5, '2024-12-08 18:15:13', NULL),
	(66, 3, 16, 7, 1, 8, '2024-12-08 18:15:38', NULL),
	(67, 3, 16, 10, 3, 46, '2024-12-08 18:16:01', NULL),
	(68, 3, 16, 11, 3, 40, '2024-12-08 18:16:25', NULL),
	(69, 7, 17, 12, 5, 12, '2024-12-08 18:18:26', NULL),
	(70, 9, 17, 12, 5, 2, '2024-12-08 18:18:53', NULL),
	(71, 8, 17, 12, 5, 24, '2024-12-08 18:19:23', NULL),
	(72, 4, 17, 4, 1, 1, '2024-12-08 18:20:04', NULL),
	(73, 4, 17, 5, 2, 1, '2024-12-08 18:20:34', NULL),
	(74, 4, 17, 8, 2, 1, '2024-12-08 18:21:02', NULL),
	(75, 4, 17, 9, 2, 0, '2024-12-08 18:21:57', NULL),
	(76, 4, 17, 6, 1, 1, '2024-12-08 18:22:38', NULL),
	(77, 4, 17, 7, 1, 1, '2024-12-08 18:23:04', NULL),
	(78, 4, 17, 10, 3, 2, '2024-12-08 18:23:22', NULL),
	(79, 4, 17, 11, 3, 2, '2024-12-08 18:23:47', NULL),
	(80, 3, 17, 4, 1, 25, '2024-12-08 18:24:14', NULL),
	(81, 3, 17, 5, 2, 18, '2024-12-08 18:24:37', NULL),
	(82, 3, 17, 8, 2, 5, '2024-12-08 18:24:54', NULL),
	(83, 3, 17, 9, 2, 2, '2024-12-08 18:25:24', NULL),
	(84, 3, 17, 6, 1, 5, '2024-12-08 18:25:40', NULL),
	(85, 3, 17, 7, 1, 8, '2024-12-08 18:26:05', NULL),
	(86, 3, 17, 10, 3, 45, '2024-12-08 18:26:29', NULL),
	(87, 3, 17, 11, 3, 39, '2024-12-08 18:26:52', '2024-12-09 08:53:37'),
	(88, 7, 18, 12, 5, 13, '2024-12-08 18:28:44', NULL),
	(89, 9, 18, 12, 5, 2, '2024-12-08 18:29:13', NULL),
	(90, 8, 18, 12, 5, 22, '2024-12-08 18:29:32', NULL),
	(91, 4, 18, 4, 1, 1, '2024-12-08 18:29:51', NULL),
	(92, 4, 18, 5, 2, 1, '2024-12-08 18:30:07', NULL),
	(93, 4, 18, 8, 2, 1, '2024-12-08 18:30:28', NULL),
	(94, 4, 18, 9, 2, 0, '2024-12-08 18:30:49', NULL),
	(95, 4, 18, 6, 1, 1, '2024-12-08 18:31:06', NULL),
	(96, 4, 18, 7, 1, 1, '2024-12-08 18:31:22', NULL),
	(97, 4, 18, 10, 3, 2, '2024-12-08 18:31:46', NULL),
	(98, 4, 18, 11, 3, 2, '2024-12-08 18:32:04', NULL),
	(99, 3, 18, 4, 1, 25, '2024-12-08 18:32:23', NULL),
	(100, 3, 18, 5, 2, 18, '2024-12-08 18:32:40', NULL),
	(101, 3, 18, 8, 2, 4, '2024-12-08 18:32:58', NULL),
	(102, 3, 18, 9, 2, 2, '2024-12-08 18:33:38', NULL),
	(103, 3, 18, 6, 1, 5, '2024-12-08 18:33:57', NULL),
	(104, 3, 18, 7, 1, 8, '2024-12-08 18:34:28', NULL),
	(105, 3, 18, 10, 3, 46, '2024-12-08 18:34:45', NULL),
	(106, 3, 18, 11, 3, 43, '2024-12-08 18:35:03', '2024-12-09 08:52:10'),
	(107, 7, 19, 12, 5, 16, '2024-12-08 18:37:18', NULL),
	(108, 9, 19, 12, 5, 2, '2024-12-08 18:37:49', NULL),
	(109, 8, 19, 12, 5, 22, '2024-12-08 18:38:16', '2024-12-09 08:49:13'),
	(110, 4, 19, 4, 1, 1, '2024-12-08 18:38:39', NULL),
	(111, 4, 19, 5, 2, 1, '2024-12-08 18:39:00', NULL),
	(112, 4, 19, 8, 2, 1, '2024-12-08 18:39:43', NULL),
	(113, 4, 19, 9, 2, 0, '2024-12-08 18:40:53', NULL),
	(114, 4, 19, 6, 1, 1, '2024-12-08 18:41:16', NULL),
	(115, 4, 19, 7, 1, 1, '2024-12-08 18:41:37', NULL),
	(116, 4, 19, 10, 3, 2, '2024-12-08 18:41:52', NULL),
	(117, 4, 19, 11, 3, 2, '2024-12-08 18:42:13', NULL),
	(118, 3, 19, 4, 1, 26, '2024-12-08 18:42:39', NULL),
	(119, 3, 19, 5, 2, 18, '2024-12-08 18:42:59', NULL),
	(120, 3, 19, 8, 2, 4, '2024-12-08 18:43:19', NULL),
	(121, 3, 19, 9, 2, 2, '2024-12-08 18:43:51', NULL),
	(122, 3, 19, 6, 1, 5, '2024-12-08 18:44:11', NULL),
	(123, 3, 19, 7, 1, 8, '2024-12-08 18:44:26', NULL),
	(124, 3, 19, 10, 3, 48, '2024-12-08 18:44:44', NULL),
	(125, 3, 19, 11, 3, 42, '2024-12-08 18:45:01', NULL),
	(126, 7, 20, 12, 5, 15, '2024-12-08 18:47:02', NULL),
	(127, 9, 20, 12, 5, 2, '2024-12-08 18:47:20', NULL),
	(128, 8, 20, 12, 5, 23, '2024-12-08 18:47:48', NULL),
	(129, 4, 20, 4, 1, 16, '2024-12-08 18:48:18', NULL),
	(130, 4, 20, 5, 2, 16, '2024-12-08 18:48:35', NULL),
	(131, 4, 20, 8, 2, 3, '2024-12-08 18:48:54', NULL),
	(132, 4, 20, 9, 2, 13, '2024-12-08 18:49:14', NULL),
	(133, 4, 20, 6, 1, 16, '2024-12-08 18:49:40', NULL),
	(134, 4, 20, 7, 1, 15, '2024-12-08 18:49:55', NULL),
	(135, 4, 20, 10, 3, 32, '2024-12-08 18:50:24', '2024-12-09 08:45:53'),
	(136, 4, 20, 11, 3, 33, '2024-12-08 18:50:40', NULL),
	(137, 3, 20, 4, 1, 26, '2024-12-08 18:51:08', NULL),
	(138, 3, 20, 5, 2, 18, '2024-12-08 18:51:29', NULL),
	(139, 3, 20, 8, 2, 4, '2024-12-08 18:51:51', NULL),
	(140, 3, 20, 9, 2, 2, '2024-12-08 18:52:13', NULL),
	(141, 3, 20, 6, 1, 5, '2024-12-08 18:52:36', NULL),
	(142, 3, 20, 7, 1, 8, '2024-12-08 18:53:03', NULL),
	(143, 3, 20, 10, 3, 47, '2024-12-08 18:53:24', NULL),
	(144, 3, 20, 11, 3, 43, '2024-12-08 18:53:43', NULL),
	(145, 5, 20, 4, 1, 0, '2024-12-08 18:54:30', NULL),
	(146, 5, 20, 5, 2, 0, '2024-12-08 18:54:52', NULL),
	(147, 5, 20, 8, 2, 3, '2024-12-08 18:55:30', NULL),
	(148, 5, 20, 9, 2, 0, '2024-12-08 18:55:55', NULL),
	(149, 5, 20, 6, 1, 3, '2024-12-08 18:56:16', NULL),
	(150, 5, 20, 7, 1, 0, '2024-12-08 18:56:37', NULL),
	(151, 5, 20, 10, 3, 6, '2024-12-08 18:56:59', NULL),
	(152, 5, 20, 11, 3, 6, '2024-12-08 18:57:17', NULL),
	(153, 7, 21, 12, 5, 15, '2024-12-08 18:59:44', NULL),
	(154, 9, 21, 12, 5, 2, '2024-12-08 19:00:08', NULL),
	(155, 8, 21, 12, 5, 23, '2024-12-08 19:00:34', NULL),
	(156, 4, 21, 4, 1, 15, '2024-12-08 19:00:58', NULL),
	(157, 4, 21, 5, 2, 18, '2024-12-08 19:01:22', NULL),
	(158, 4, 21, 8, 2, 2, '2024-12-08 19:01:40', NULL),
	(159, 4, 21, 9, 2, 12, '2024-12-08 19:02:27', NULL),
	(160, 4, 21, 6, 1, 16, '2024-12-08 19:02:52', NULL),
	(161, 4, 21, 7, 1, 14, '2024-12-08 19:03:18', NULL),
	(162, 4, 21, 10, 3, 39, '2024-12-08 19:03:39', NULL),
	(163, 4, 21, 11, 3, 34, '2024-12-08 19:04:01', NULL),
	(164, 3, 21, 4, 1, 27, '2024-12-08 19:04:43', NULL),
	(165, 3, 21, 5, 2, 18, '2024-12-08 19:05:24', NULL),
	(166, 3, 21, 8, 2, 4, '2024-12-08 19:05:46', NULL),
	(167, 3, 21, 9, 2, 2, '2024-12-08 19:06:28', NULL),
	(168, 3, 21, 6, 1, 4, '2024-12-08 19:06:49', NULL),
	(169, 3, 21, 7, 1, 2, '2024-12-08 19:07:20', NULL),
	(170, 3, 21, 10, 3, 49, '2024-12-08 19:07:49', NULL),
	(171, 3, 21, 11, 3, 45, '2024-12-08 19:08:18', NULL),
	(172, 5, 21, 4, 1, 0, '2024-12-08 19:08:43', NULL),
	(173, 5, 21, 5, 2, 0, '2024-12-08 19:08:59', NULL),
	(174, 5, 21, 8, 2, 3, '2024-12-08 19:09:23', NULL),
	(175, 5, 21, 9, 2, 0, '2024-12-08 19:09:45', NULL),
	(176, 5, 21, 6, 1, 3, '2024-12-08 19:10:13', NULL),
	(177, 5, 21, 7, 1, 0, '2024-12-08 19:10:32', NULL),
	(178, 5, 21, 10, 3, 6, '2024-12-08 19:10:59', NULL),
	(179, 5, 21, 11, 3, 6, '2024-12-08 19:11:34', NULL),
	(180, 6, 21, 4, 1, 35, '2024-12-08 19:12:08', NULL),
	(181, 6, 21, 5, 2, 35, '2024-12-08 19:12:25', NULL),
	(182, 6, 21, 8, 2, 19, '2024-12-08 19:12:47', NULL),
	(183, 6, 21, 9, 2, 7, '2024-12-08 19:13:09', NULL),
	(184, 6, 21, 6, 1, 16, '2024-12-08 19:13:31', NULL),
	(185, 6, 21, 7, 1, 11, '2024-12-08 19:13:50', NULL),
	(186, 6, 21, 10, 3, 77, '2024-12-08 19:14:11', '2024-12-09 08:44:15'),
	(187, 6, 21, 11, 3, 67, '2024-12-08 19:14:28', '2024-12-09 08:44:34'),
	(188, 7, 22, 12, 5, 14, '2024-12-08 19:18:53', NULL),
	(189, 9, 22, 12, 5, 2, '2024-12-08 19:20:21', NULL),
	(190, 8, 22, 12, 5, 20, '2024-12-08 19:20:59', NULL),
	(191, 4, 22, 4, 1, 16, '2024-12-08 19:21:34', NULL),
	(192, 4, 22, 5, 2, 21, '2024-12-08 19:22:05', NULL),
	(193, 4, 22, 8, 2, 20, '2024-12-08 19:22:29', NULL),
	(194, 4, 22, 9, 2, 0, '2024-12-08 19:23:32', NULL),
	(200, 4, 22, 6, 1, 22, '2024-12-08 19:25:15', NULL),
	(201, 4, 22, 7, 1, 18, '2024-12-08 19:25:37', NULL),
	(202, 4, 22, 10, 3, 40, '2024-12-08 19:26:02', NULL),
	(203, 4, 22, 11, 3, 37, '2024-12-08 19:26:28', NULL),
	(204, 3, 22, 4, 1, 26, '2024-12-08 19:27:59', NULL),
	(205, 3, 22, 5, 2, 18, '2024-12-08 19:28:45', NULL),
	(206, 3, 22, 8, 2, 4, '2024-12-08 19:29:31', NULL),
	(207, 3, 22, 9, 2, 1, '2024-12-08 19:29:55', NULL),
	(208, 3, 22, 6, 1, 4, '2024-12-08 19:30:22', NULL),
	(209, 3, 22, 7, 1, 7, '2024-12-08 19:30:46', NULL),
	(210, 3, 22, 10, 3, 46, '2024-12-08 19:31:23', NULL),
	(211, 3, 22, 11, 3, 42, '2024-12-08 19:32:11', NULL),
	(212, 5, 22, 4, 1, 0, '2024-12-08 19:33:21', NULL),
	(213, 5, 22, 5, 2, 0, '2024-12-08 19:33:47', NULL),
	(214, 5, 22, 8, 2, 3, '2024-12-08 19:34:07', NULL),
	(215, 5, 22, 9, 2, 0, '2024-12-08 19:34:23', NULL),
	(216, 5, 22, 6, 1, 3, '2024-12-08 19:34:51', NULL),
	(217, 5, 22, 7, 1, 0, '2024-12-08 19:35:53', NULL),
	(218, 5, 22, 10, 3, 6, '2024-12-08 19:36:23', NULL),
	(219, 5, 22, 11, 3, 6, '2024-12-08 19:36:51', NULL),
	(220, 6, 22, 4, 1, 36, '2024-12-08 19:37:17', NULL),
	(221, 6, 22, 5, 2, 36, '2024-12-08 19:37:44', NULL),
	(222, 6, 22, 8, 2, 20, '2024-12-08 19:38:21', NULL),
	(227, 6, 22, 9, 2, 6, '2024-12-08 19:40:40', NULL),
	(228, 6, 22, 6, 1, 17, '2024-12-08 19:41:41', NULL),
	(229, 6, 22, 7, 1, 11, '2024-12-08 19:42:10', NULL),
	(231, 6, 22, 10, 3, 65, '2024-12-08 19:43:39', '2024-12-09 08:41:48'),
	(232, 6, 22, 11, 3, 60, '2024-12-08 19:43:58', '2024-12-09 08:41:06'),
	(235, 7, 23, 12, 5, 14, '2024-12-08 19:46:27', NULL),
	(236, 9, 23, 12, 5, 2, '2024-12-08 19:46:46', NULL),
	(237, 8, 23, 12, 5, 20, '2024-12-08 19:47:04', NULL),
	(238, 4, 23, 4, 1, 17, '2024-12-08 19:47:26', NULL),
	(239, 4, 23, 5, 2, 19, '2024-12-08 19:47:47', NULL),
	(240, 4, 23, 8, 2, 18, '2024-12-08 19:48:02', NULL),
	(242, 4, 23, 9, 2, 0, '2024-12-08 19:48:57', NULL),
	(243, 4, 23, 6, 1, 20, '2024-12-08 19:49:15', NULL),
	(244, 4, 23, 7, 1, 14, '2024-12-08 19:49:28', NULL),
	(245, 4, 23, 10, 3, 47, '2024-12-08 19:49:44', NULL),
	(246, 4, 23, 11, 3, 43, '2024-12-08 19:50:00', NULL),
	(247, 3, 23, 4, 1, 24, '2024-12-08 19:50:31', NULL),
	(248, 3, 23, 5, 2, 18, '2024-12-08 19:50:54', NULL),
	(249, 3, 23, 8, 2, 5, '2024-12-08 19:51:12', NULL),
	(250, 3, 23, 9, 2, 0, '2024-12-08 19:51:27', NULL),
	(251, 3, 23, 6, 1, 5, '2024-12-08 19:51:50', NULL),
	(252, 3, 23, 7, 1, 7, '2024-12-08 19:52:14', NULL),
	(253, 3, 23, 10, 3, 47, '2024-12-08 19:52:44', NULL),
	(254, 3, 23, 11, 3, 43, '2024-12-08 19:53:11', NULL),
	(255, 5, 23, 4, 1, 0, '2024-12-08 19:53:34', NULL),
	(256, 5, 23, 5, 2, 0, '2024-12-08 19:54:00', NULL),
	(257, 5, 23, 8, 2, 3, '2024-12-08 19:54:17', NULL),
	(258, 5, 23, 9, 2, 0, '2024-12-08 19:54:39', NULL),
	(259, 5, 23, 6, 1, 3, '2024-12-08 19:55:04', NULL),
	(260, 5, 23, 7, 1, 0, '2024-12-08 19:55:21', NULL),
	(262, 5, 23, 10, 3, 6, '2024-12-08 19:56:10', NULL),
	(263, 5, 23, 11, 3, 6, '2024-12-08 19:56:26', NULL),
	(265, 6, 23, 4, 1, 36, '2024-12-08 20:00:17', NULL),
	(266, 6, 23, 5, 2, 39, '2024-12-08 20:00:41', NULL),
	(267, 6, 23, 8, 2, 19, '2024-12-08 20:01:24', NULL),
	(268, 6, 23, 9, 2, 6, '2024-12-08 20:01:44', NULL),
	(270, 6, 23, 6, 1, 17, '2024-12-08 20:02:48', NULL),
	(271, 6, 23, 7, 1, 10, '2024-12-08 20:03:04', NULL),
	(272, 6, 23, 10, 3, 69, '2024-12-08 20:03:26', NULL),
	(273, 6, 23, 11, 3, 63, '2024-12-08 20:03:45', NULL),
	(274, 7, 24, 12, 5, 11, '2024-12-08 20:07:02', NULL),
	(275, 9, 24, 12, 5, 1, '2024-12-08 20:07:43', NULL),
	(276, 8, 24, 12, 5, 20, '2024-12-08 20:08:07', NULL),
	(277, 4, 24, 4, 1, 16, '2024-12-08 20:09:12', NULL),
	(278, 4, 24, 5, 2, 18, '2024-12-08 20:09:31', NULL),
	(279, 4, 24, 8, 2, 18, '2024-12-08 20:09:58', NULL),
	(280, 4, 24, 9, 2, 1, '2024-12-08 20:10:27', NULL),
	(281, 4, 24, 6, 1, 21, '2024-12-08 20:10:47', NULL),
	(282, 4, 24, 7, 1, 14, '2024-12-08 20:11:04', NULL),
	(283, 4, 24, 10, 3, 53, '2024-12-08 20:11:41', NULL),
	(284, 4, 24, 11, 3, 47, '2024-12-08 20:11:59', NULL),
	(285, 3, 24, 4, 1, 25, '2024-12-08 20:12:25', NULL),
	(286, 3, 24, 5, 2, 17, '2024-12-08 20:13:24', NULL),
	(287, 3, 24, 8, 2, 5, '2024-12-08 20:13:47', NULL),
	(288, 3, 24, 9, 2, 1, '2024-12-08 20:14:14', NULL),
	(289, 3, 24, 6, 1, 5, '2024-12-08 20:14:34', NULL),
	(290, 3, 24, 7, 1, 6, '2024-12-08 20:16:41', NULL),
	(291, 3, 24, 10, 3, 46, '2024-12-08 20:17:01', NULL),
	(292, 3, 24, 11, 3, 43, '2024-12-08 20:17:20', NULL),
	(294, 5, 24, 4, 1, 0, '2024-12-08 20:18:29', NULL),
	(295, 5, 24, 5, 2, 0, '2024-12-08 20:19:04', NULL),
	(296, 5, 24, 8, 2, 3, '2024-12-08 20:19:21', NULL),
	(297, 5, 24, 9, 2, 0, '2024-12-08 20:19:45', NULL),
	(298, 5, 24, 6, 1, 3, '2024-12-08 20:20:03', NULL),
	(299, 5, 24, 7, 1, 0, '2024-12-08 20:20:26', NULL),
	(300, 5, 24, 10, 3, 6, '2024-12-08 20:21:03', NULL),
	(301, 5, 24, 11, 3, 6, '2024-12-08 20:21:30', NULL),
	(302, 6, 24, 4, 1, 38, '2024-12-08 20:21:59', NULL),
	(303, 6, 24, 5, 2, 40, '2024-12-08 20:22:14', '2024-12-09 07:52:42'),
	(304, 6, 24, 8, 2, 20, '2024-12-08 20:22:54', NULL),
	(305, 6, 24, 9, 2, 4, '2024-12-08 20:23:25', NULL),
	(306, 6, 24, 6, 1, 18, '2024-12-08 20:23:46', NULL),
	(307, 6, 24, 7, 1, 10, '2024-12-08 20:24:07', NULL),
	(308, 6, 24, 10, 3, 71, '2024-12-08 20:24:26', '2024-12-09 08:26:10'),
	(309, 6, 24, 11, 3, 62, '2024-12-08 20:24:46', NULL),
	(310, 1, 14, 4, 1, 63, '2024-12-09 00:15:43', NULL),
	(311, 1, 14, 6, 1, 42, '2024-12-09 00:16:16', NULL),
	(312, 1, 14, 7, 1, 44, '2024-12-09 00:16:31', NULL),
	(313, 1, 14, 10, 3, 157, '2024-12-09 00:16:59', NULL),
	(314, 1, 14, 5, 2, 70, '2024-12-09 00:17:15', NULL),
	(315, 1, 14, 8, 2, 38, '2024-12-09 00:17:41', NULL),
	(316, 1, 14, 9, 2, 41, '2024-12-09 00:18:08', NULL),
	(317, 1, 14, 11, 3, 123, '2024-12-09 00:18:33', '2024-12-09 09:04:40'),
	(318, 1, 15, 4, 1, 62, '2024-12-09 00:27:14', '2024-12-09 08:59:52'),
	(319, 1, 15, 6, 1, 42, '2024-12-09 00:27:40', '2024-12-09 09:00:27'),
	(320, 1, 15, 7, 1, 44, '2024-12-09 00:28:07', '2024-12-09 09:00:37'),
	(321, 1, 15, 10, 3, 156, '2024-12-09 00:28:29', '2024-12-09 08:58:55'),
	(322, 1, 15, 5, 2, 70, '2024-12-09 00:28:49', '2024-12-09 09:01:05'),
	(323, 1, 15, 8, 2, 38, '2024-12-09 00:29:24', '2024-12-09 09:01:19'),
	(324, 1, 15, 9, 2, 40, '2024-12-09 00:29:54', '2024-12-09 08:57:59'),
	(325, 1, 15, 11, 3, 124, '2024-12-09 00:30:16', '2024-12-09 08:56:21'),
	(326, 1, 16, 4, 1, 62, '2024-12-09 00:33:43', NULL),
	(327, 1, 16, 6, 1, 42, '2024-12-09 00:34:07', NULL),
	(328, 1, 16, 7, 1, 44, '2024-12-09 00:35:17', NULL),
	(329, 1, 16, 10, 3, 156, '2024-12-09 00:35:38', NULL),
	(330, 1, 16, 5, 2, 70, '2024-12-09 00:35:56', NULL),
	(331, 1, 16, 8, 2, 38, '2024-12-09 00:36:17', NULL),
	(332, 1, 16, 9, 2, 40, '2024-12-09 00:36:32', NULL),
	(333, 1, 16, 11, 3, 124, '2024-12-09 00:37:02', NULL),
	(335, 1, 17, 4, 1, 62, '2024-12-09 00:41:32', NULL),
	(336, 1, 17, 6, 1, 42, '2024-12-09 00:42:06', NULL),
	(337, 1, 17, 7, 1, 44, '2024-12-09 00:42:27', NULL),
	(338, 1, 17, 10, 3, 156, '2024-12-09 00:42:47', NULL),
	(339, 1, 17, 5, 2, 70, '2024-12-09 00:43:09', NULL),
	(340, 1, 17, 8, 2, 38, '2024-12-09 00:43:55', NULL),
	(341, 1, 17, 9, 2, 40, '2024-12-09 00:44:19', NULL),
	(342, 1, 17, 11, 3, 124, '2024-12-09 00:44:44', NULL),
	(343, 1, 18, 4, 1, 62, '2024-12-09 00:45:54', NULL),
	(344, 1, 18, 6, 1, 42, '2024-12-09 00:46:42', NULL),
	(345, 1, 18, 7, 1, 44, '2024-12-09 00:47:00', NULL),
	(346, 1, 18, 10, 3, 156, '2024-12-09 00:47:19', NULL),
	(347, 1, 18, 5, 2, 70, '2024-12-09 00:47:33', NULL),
	(348, 1, 18, 8, 2, 38, '2024-12-09 00:47:47', NULL),
	(349, 1, 18, 9, 2, 40, '2024-12-09 00:48:02', NULL),
	(350, 1, 18, 11, 3, 124, '2024-12-09 00:48:17', NULL),
	(351, 1, 19, 4, 1, 61, '2024-12-09 00:49:06', NULL),
	(352, 1, 19, 6, 1, 42, '2024-12-09 00:49:25', NULL),
	(353, 1, 19, 7, 1, 43, '2024-12-09 00:49:41', NULL),
	(354, 1, 19, 10, 3, 156, '2024-12-09 00:50:07', NULL),
	(355, 1, 19, 5, 2, 70, '2024-12-09 00:50:23', NULL),
	(356, 1, 19, 8, 2, 38, '2024-12-09 00:50:48', NULL),
	(357, 1, 19, 9, 2, 40, '2024-12-09 00:51:00', NULL),
	(358, 1, 19, 11, 3, 125, '2024-12-09 00:51:18', '2024-12-09 08:50:08'),
	(359, 1, 20, 4, 1, 62, '2024-12-09 00:51:58', NULL),
	(360, 1, 20, 6, 1, 42, '2024-12-09 00:52:17', NULL),
	(361, 1, 20, 7, 1, 44, '2024-12-09 00:52:30', NULL),
	(362, 1, 20, 10, 3, 151, '2024-12-09 00:52:49', NULL),
	(363, 1, 20, 5, 2, 69, '2024-12-09 00:53:06', NULL),
	(364, 1, 20, 8, 2, 38, '2024-12-09 00:53:24', NULL),
	(365, 1, 20, 9, 2, 41, '2024-12-09 00:53:41', NULL),
	(366, 1, 20, 11, 3, 121, '2024-12-09 00:53:55', NULL),
	(367, 1, 21, 4, 1, 61, '2024-12-09 00:54:34', NULL),
	(368, 1, 21, 6, 1, 42, '2024-12-09 00:55:00', NULL),
	(369, 1, 21, 7, 1, 44, '2024-12-09 00:55:17', NULL),
	(370, 1, 21, 10, 3, 151, '2024-12-09 00:55:43', NULL),
	(371, 1, 21, 5, 2, 69, '2024-12-09 00:56:03', NULL),
	(372, 1, 21, 8, 2, 38, '2024-12-09 00:56:22', NULL),
	(373, 1, 21, 9, 2, 41, '2024-12-09 00:56:39', NULL),
	(374, 1, 21, 11, 3, 120, '2024-12-09 00:57:00', NULL),
	(375, 1, 22, 4, 1, 62, '2024-12-09 00:57:41', NULL),
	(376, 1, 22, 6, 1, 42, '2024-12-09 00:57:54', NULL),
	(377, 1, 22, 7, 1, 43, '2024-12-09 00:58:22', NULL),
	(378, 1, 22, 10, 3, 153, '2024-12-09 00:58:39', NULL),
	(379, 1, 22, 5, 2, 68, '2024-12-09 00:59:01', NULL),
	(380, 1, 22, 8, 2, 39, '2024-12-09 00:59:16', NULL),
	(381, 1, 22, 9, 2, 41, '2024-12-09 00:59:30', NULL),
	(382, 1, 22, 11, 3, 121, '2024-12-09 00:59:44', NULL),
	(383, 1, 23, 4, 1, 62, '2024-12-09 01:00:13', NULL),
	(384, 1, 23, 6, 1, 42, '2024-12-09 01:00:27', NULL),
	(385, 1, 23, 7, 1, 43, '2024-12-09 01:00:40', NULL),
	(386, 1, 23, 10, 3, 153, '2024-12-09 01:00:55', NULL),
	(387, 1, 23, 5, 2, 69, '2024-12-09 01:01:09', NULL),
	(388, 1, 23, 8, 2, 39, '2024-12-09 01:01:25', NULL),
	(389, 1, 23, 9, 2, 41, '2024-12-09 01:01:41', NULL),
	(390, 1, 23, 11, 3, 121, '2024-12-09 01:02:01', '2024-12-09 08:39:13'),
	(391, 1, 24, 4, 1, 62, '2024-12-09 01:02:52', NULL),
	(392, 1, 24, 6, 1, 42, '2024-12-09 01:03:05', NULL),
	(393, 1, 24, 7, 1, 43, '2024-12-09 01:03:19', NULL),
	(394, 1, 24, 10, 3, 153, '2024-12-09 01:03:34', NULL),
	(395, 1, 24, 5, 2, 69, '2024-12-09 01:03:48', NULL),
	(396, 1, 24, 8, 2, 39, '2024-12-09 01:04:00', NULL),
	(397, 1, 24, 9, 2, 41, '2024-12-09 01:04:11', NULL),
	(398, 1, 24, 11, 3, 122, '2024-12-09 01:04:26', '2024-12-09 08:31:42');

-- Dumping structure for table isma_dashboard.tb_tipe_jabatan
DROP TABLE IF EXISTS `tb_tipe_jabatan`;
CREATE TABLE IF NOT EXISTS `tb_tipe_jabatan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.tb_tipe_jabatan: ~4 rows (approximately)
DELETE FROM `tb_tipe_jabatan`;
INSERT INTO `tb_tipe_jabatan` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 'Perwira Deck', 'Perwira Deck', '2024-12-04 00:44:14', NULL),
	(2, 'Perwira Mesin', 'Perwira', '2024-12-04 00:44:29', NULL),
	(3, 'Abk', 'Abk', '2024-12-04 00:44:37', '2024-12-04 08:10:38'),
	(5, 'Pandu', 'Pandu', '2024-12-08 17:28:48', NULL);

-- Dumping structure for table isma_dashboard.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table isma_dashboard.users: ~2 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `nama`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Fahmi Idrus', 'fahmi@intansejahterautama.co.id', '$2y$10$Wqhsb0.jmtO./II86Ql2TujHcmswDBzPIcyra/Ijpv6uTDclaxGNG', 'admin', NULL, '2024-11-29 22:08:36', '2024-11-29 22:08:36'),
	(2, 'Alamsyah Saputra Agung', 'alamsyah.saputra@pelindo.co.id', '$2y$10$0wftg16SIEhrVNJq.lK1/OXsGFT3QUZ18hiMavSHw9k4uhS0/tV9O', 'admin', NULL, '2024-12-13 08:55:34', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
