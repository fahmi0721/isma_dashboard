-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for skripsi_2
-- CREATE DATABASE IF NOT EXISTS `skripsi_2` /*!40100 DEFAULT CHARACTER SET latin1 */;
-- USE `skripsi_2`;

-- Dumping structure for table skripsi_2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.migrations: ~13 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(3, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(4, '2024_08_21_135135_create_parokis_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(5, '2024_08_21_135324_create_sekolahs_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(6, '2024_08_21_142737_create_kegiatan_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(7, '2024_08_21_143003_create_agendas_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(8, '2024_08_21_143224_create_kotak_sarans_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(9, '2024_08_21_143354_create_permohonans_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(10, '2024_08_21_143625_create_pertanggungjawaban_table', 6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(11, '2024_08_21_143757_create_historis_table', 7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(12, '2024_08_30_031100_create_table_profils', 8);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(13, '2024_08_30_145600_create_templates_table', 9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
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

-- Dumping data for table skripsi_2.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.tb_agenda
CREATE TABLE IF NOT EXISTS `tb_agenda` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.tb_agenda: ~3 rows (approximately)
DELETE FROM `tb_agenda`;
/*!40000 ALTER TABLE `tb_agenda` DISABLE KEYS */;
INSERT INTO `tb_agenda` (`id`, `judul`, `tanggal`, `deskripsi`, `lokasi`, `created_at`, `updated_at`) VALUES
	(2, 'qwertyuiop[', '2024-09-20', '123456789', 'dfghjkl', '2024-08-29 07:42:55', '2024-08-29 16:34:50');
INSERT INTO `tb_agenda` (`id`, `judul`, `tanggal`, `deskripsi`, `lokasi`, `created_at`, `updated_at`) VALUES
	(3, 'swswswsw', '2024-08-29', 'xssxsxsx', 'xsxsxsx', '2024-08-29 07:49:51', NULL);
INSERT INTO `tb_agenda` (`id`, `judul`, `tanggal`, `deskripsi`, `lokasi`, `created_at`, `updated_at`) VALUES
	(4, 'Sosialisasi Kegiatan', '2024-07-01', '-', 'Makassar', '2024-08-29 16:29:02', NULL);
/*!40000 ALTER TABLE `tb_agenda` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.tb_histori
CREATE TABLE IF NOT EXISTS `tb_histori` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permohonan_id` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.tb_histori: ~0 rows (approximately)
DELETE FROM `tb_histori`;
/*!40000 ALTER TABLE `tb_histori` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_histori` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.tb_kegiatan
CREATE TABLE IF NOT EXISTS `tb_kegiatan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_kegiatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.tb_kegiatan: ~2 rows (approximately)
DELETE FROM `tb_kegiatan`;
/*!40000 ALTER TABLE `tb_kegiatan` DISABLE KEYS */;
INSERT INTO `tb_kegiatan` (`id`, `judul`, `isi`, `tanggal_kegiatan`, `foto`, `lokasi_kegiatan`, `created_at`, `updated_at`) VALUES
	(2, 'Jadwal Lengkap Kunjungan Paus Fransiskus ke Indonesia', '<p style="text-align:justify">Liputan6.com, Jakarta - Paus Fransiskus dijadwalkan akan mengunjungi Indonesia pada 3-6 September 2024, negara pertama yang menjadi tujuannya dalam perjalanan apostolik ke Asia Pasifik.</p>\r\n\r\n<p style="text-align:justify">Lawatan Paus ke Indonesia mengangkat tema: &quot;Iman, Persaudaraan, dan Bela Rasa&quot;.</p>\r\n\r\n<p style="text-align:justify">Kunjungan ini merupakan momen bersejarah dan sangat penting bagi umat Katolik di Indonesia, serta menjadi bagian dari upaya memperkuat tali persaudaraan antar umat beragama.</p>\r\n\r\n<p style="text-align:justify">Setibanya di Indonesia, Paus Fransiskus dijadwalkan akan melakukan serangkaian kegiatan termasuk melakukan kunjungan kehormatan ke Istana Merdeka dan bertemu dengan Presiden Joko Widodo (Jokowi) hingga memimpin misa kudus di Gelora Bung Karno (GBK) yang akan dihadiri oleh lebih dari 80 ribu umat Katolik Indonesia.</p>\r\n\r\n<p style="text-align:justify">&nbsp;</p>\r\n\r\n<p style="text-align:justify">Mengutip siaran pers Tim Media Kunjungan Paus Fransiskus, berikut adalah jadwal lengkap Paus selama di Indonesia:</p>\r\n\r\n<p style="text-align:justify">&nbsp;</p>\r\n\r\n<p style="text-align:justify">Senin, 2 September 2024</p>\r\n\r\n<p style="text-align:justify">&nbsp;</p>\r\n\r\n<p style="text-align:justify">Berangkat dengan pesawat dari Bandara Internasional Roma/Fiumicino ke Jakarta</p>\r\n\r\n<p style="text-align:justify">Selasa, 3 September 2024</p>\r\n\r\n<p style="text-align:justify">&nbsp;</p>\r\n\r\n<p style="text-align:justify">Tiba di Bandara Soekarno-Hatta, Cengkareng</p>\r\n\r\n<p style="text-align:justify">Rabu, 4 September 2024</p>\r\n\r\n<p style="text-align:justify">&nbsp;</p>\r\n\r\n<p style="text-align:justify">Melakukan kunjungan kehormatan kepada Presiden Republik Indonesia Joko Widodo (Jokowi) di Istana Merdeka, Jakarta</p>\r\n\r\n<p style="text-align:justify">Melakukan pertemuan dengan kalangan pemerintahan, masyarakat sipil, dan korps diplomatik di Aula Istana Negara, Jakarta</p>\r\n\r\n<p style="text-align:justify">Melakukan pertemuan pribadi dengan anggota Serikat Jesus (SJ) di Kedutaan Besar Vatikan, Jakarta</p>\r\n\r\n<p style="text-align:justify">Melakukan pertemuan dengan para uskup, imam, diakon, pelaku hidup bakti, seminaris, dan katekis di Gereja Katedral, Jakarta</p>\r\n\r\n<p style="text-align:justify">Kamis, 5 September 2024</p>\r\n\r\n<p style="text-align:justify">&nbsp;</p>\r\n\r\n<p style="text-align:justify">Melakukan pertemuan antaragama dan bertemu Imam Besar Nasaruddin Umar Masjid Istiqlal, di Masjid Istiqlal, Jakarta</p>\r\n\r\n<p style="text-align:justify">Melakukan pertemuan dengan penerima manfaat organisasi amal di Kantor Pusat KWI, Jakarta</p>\r\n\r\n<p style="text-align:justify">Memimpin misa kudus di Stadion Gelora Bung Karno, Jakarta</p>', '2024-08-30', '20240831152149_70ce89380ca10f57dcf7ca8d8.jpg', 'Mesjid Istiqlal Jakarta', '2024-08-31 15:14:32', '2024-08-31 15:21:49');
INSERT INTO `tb_kegiatan` (`id`, `judul`, `isi`, `tanggal_kegiatan`, `foto`, `lokasi_kegiatan`, `created_at`, `updated_at`) VALUES
	(3, 'Paus Fransiskus Tur Asia Mulai dari Indonesia, Ini Jadwal Lengkapnya', '<p>Jakarta, CNN Indonesia -- Paus Fransiskus akan memulai tur apostoliknya ke sejumlah negara di Asia Pasifik terutama Asia Tenggara dengan Indonesia sebagai negara pertama yang dikunjungi.</p>\r\n\r\n<p>Paus Fransiskus akan menghabiskan 12 hari untuk mengunjungi Indonesia, Papua Nugini, Timor Leste, dan Singapura mulai 3 September mendatang.</p>\r\n\r\n<p>1. Indonesia (3-6 September)<br />\r\nPaus Fransiskus&nbsp;akan memulai turnya di Jakarta. Ia akan tiba di Indonesia&nbsp;pada Selasa (3/9).<br />\r\n<br />\r\nSehari setelah tiba, pemimpin umat Katolik itu akan bertemu Presiden Jokowi di Istana Kepresidenan Jakarta pada Rabu (4/9).<br />\r\n<br />\r\nSelain itu, Paus juga dikabarkan akan mengunjungi Gereja Katedral dan Masjid Istiqlal.<br />\r\n<br />\r\nTema utama dari kunjungan&nbsp;ke Jakarta adalah dialog antargama&nbsp;Islam-Kristen, di tengah kekhawatiran soal diskriminasi dan pelecehan terhadap kelompok agama minoritas yang meningkat di Indonesia.<br />\r\n<br />\r\nPaus akan bertemu dengan perwakilan dari enam agama dan denominasi resmi Indonesia yakni umat Islam, Protestan, Katolik, Buddha, Hindu, dan Konghucu&nbsp;di Masjid Istiqlal&nbsp;pada Kamis (5/9).<br />\r\n<br />\r\n&nbsp;</p>', '2024-09-06', '20240831152339_7c0f0d1d8829f1133d2c7145a.jpeg', 'Mesjid Istiqlal Jakarta Pusat', '2024-08-31 15:23:39', NULL);
/*!40000 ALTER TABLE `tb_kegiatan` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.tb_kotak_permohonan
CREATE TABLE IF NOT EXISTS `tb_kotak_permohonan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemohon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `kode_pj` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_kotak_permohonan_kode_unique` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.tb_kotak_permohonan: ~6 rows (approximately)
DELETE FROM `tb_kotak_permohonan`;
/*!40000 ALTER TABLE `tb_kotak_permohonan` DISABLE KEYS */;
INSERT INTO `tb_kotak_permohonan` (`id`, `judul`, `kode`, `nama_pemohon`, `email`, `deskripsi`, `lampiran`, `status`, `kode_pj`, `created_at`, `updated_at`) VALUES
	(1, 'xsxsx', 'REQ-5418-240901023944', 'xsx', 'fahmiidrus131@gmail.com', 'xsxsx', '20240901143944_4504ab196404260c4453ccf40.pdf', '1', NULL, '2024-09-01 14:39:44', NULL);
INSERT INTO `tb_kotak_permohonan` (`id`, `judul`, `kode`, `nama_pemohon`, `email`, `deskripsi`, `lampiran`, `status`, `kode_pj`, `created_at`, `updated_at`) VALUES
	(2, 'Bantuan Buku untukPerpustakaan', 'REQ-6846-240901024134', 'Mail', 'fahmiidrus131@gmail.com', 'wertyuiop', '20240901144134_722d0831a1e0f8252ceb169ed.pdf', '2', NULL, '2024-09-01 14:41:34', NULL);
INSERT INTO `tb_kotak_permohonan` (`id`, `judul`, `kode`, `nama_pemohon`, `email`, `deskripsi`, `lampiran`, `status`, `kode_pj`, `created_at`, `updated_at`) VALUES
	(3, 'Permohonan Bantuan Dana', 'REQ-3457-240901030500', 'Fahmi Idrus', 'fahmiidrus131@gmail.com', 'Mohon kamidiberikan bantuan dana untuk pembelian buku dengan rincian prmohonan terlampir', '20240901150500_d5a49d4d58328bbe652cf998d.pdf', '1', NULL, '2024-09-01 15:05:00', NULL);
INSERT INTO `tb_kotak_permohonan` (`id`, `judul`, `kode`, `nama_pemohon`, `email`, `deskripsi`, `lampiran`, `status`, `kode_pj`, `created_at`, `updated_at`) VALUES
	(4, 'Permohonan Bantuan Buku', 'REQ-4025-240901031120', 'Reynaldi', 'reynaldi2002@gmail.com', 'Perohonan Bantuan Buku', '20240901151120_397860f258876084c0088abed.pdf', '1', NULL, '2024-09-01 15:11:20', NULL);
INSERT INTO `tb_kotak_permohonan` (`id`, `judul`, `kode`, `nama_pemohon`, `email`, `deskripsi`, `lampiran`, `status`, `kode_pj`, `created_at`, `updated_at`) VALUES
	(5, 'tES', 'REQ-3819-240902032220', 'FFFDF', 'fahmiidrus131@gmail.com', 'ok', '20240902032220_e4d176926ef6712834fbadb8f.pdf', '0', NULL, '2024-09-02 03:22:20', NULL);
INSERT INTO `tb_kotak_permohonan` (`id`, `judul`, `kode`, `nama_pemohon`, `email`, `deskripsi`, `lampiran`, `status`, `kode_pj`, `created_at`, `updated_at`) VALUES
	(6, 'Permohonan Bantuan Dana', 'REQ-2873-240903043359', 'Reynaldi', 'reynaldi2002@gmail.com', 'Permohonan Bantuan Dana  untuk Kegiatan Ibadah', '20240903043359_86ce72dfbb0deb034252e4756.pdf', '1', NULL, '2024-09-03 04:33:59', NULL);
/*!40000 ALTER TABLE `tb_kotak_permohonan` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.tb_kotak_saran
CREATE TABLE IF NOT EXISTS `tb_kotak_saran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_samaran` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.tb_kotak_saran: ~2 rows (approximately)
DELETE FROM `tb_kotak_saran`;
/*!40000 ALTER TABLE `tb_kotak_saran` DISABLE KEYS */;
INSERT INTO `tb_kotak_saran` (`id`, `nama_samaran`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 'Bacondeng', 'Bla Bla Bla BlaBla Bla Bla BlaBla Bla Bla BlaBla Bla Bla Bla', '2024-08-31 17:40:48', NULL);
INSERT INTO `tb_kotak_saran` (`id`, `nama_samaran`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(2, 'Baco', 'dfx xvsxbsxdc ddc', '2024-08-31 17:49:33', NULL);
/*!40000 ALTER TABLE `tb_kotak_saran` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.tb_paroki
CREATE TABLE IF NOT EXISTS `tb_paroki` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_paroki` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pastur` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_umat` int(11) NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.tb_paroki: ~2 rows (approximately)
DELETE FROM `tb_paroki`;
/*!40000 ALTER TABLE `tb_paroki` DISABLE KEYS */;
INSERT INTO `tb_paroki` (`id`, `nama_paroki`, `nama_pastur`, `jumlah_umat`, `alamat`, `created_at`, `updated_at`) VALUES
	(2, 'Paroki Katedral', 'okokk', 20, 'kkkkkk', '2024-08-24 16:44:49', '2024-08-24 16:47:18');
INSERT INTO `tb_paroki` (`id`, `nama_paroki`, `nama_pastur`, `jumlah_umat`, `alamat`, `created_at`, `updated_at`) VALUES
	(3, 'Paroki Katedral', 'xsx', 2, 'sw', '2024-08-24 16:45:00', NULL);
/*!40000 ALTER TABLE `tb_paroki` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.tb_pertanggung_jawaban
CREATE TABLE IF NOT EXISTS `tb_pertanggung_jawaban` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pemohon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_pertanggung_jawaban_kode_unique` (`kode`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.tb_pertanggung_jawaban: ~5 rows (approximately)
DELETE FROM `tb_pertanggung_jawaban`;
/*!40000 ALTER TABLE `tb_pertanggung_jawaban` DISABLE KEYS */;
INSERT INTO `tb_pertanggung_jawaban` (`id`, `kode`, `kode_pemohon`, `deskripsi`, `lampiran`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'PJ-8395-240902061118', 'REQ-5418-240901023944', 'OK', '20240902061118_75ddbf2e10f88e264cc6ba066.pdf', '2', '2024-09-02 06:11:18', NULL);
INSERT INTO `tb_pertanggung_jawaban` (`id`, `kode`, `kode_pemohon`, `deskripsi`, `lampiran`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'PJ-3240-240902063852', 'REQ-3457-240901030500', 'xsxxx', '20240902063852_0ae580f44aa56474aff8ab6a2.pdf', '0', '2024-09-02 06:38:52', NULL);
INSERT INTO `tb_pertanggung_jawaban` (`id`, `kode`, `kode_pemohon`, `deskripsi`, `lampiran`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'PJ-3564-240902083027', 'REQ-3819-240902032220', 'rff', '20240902083027_149b3d63f5ebab2726b26633e.pdf', '2', '2024-09-02 08:30:27', NULL);
INSERT INTO `tb_pertanggung_jawaban` (`id`, `kode`, `kode_pemohon`, `deskripsi`, `lampiran`, `status`, `created_at`, `updated_at`) VALUES
	(4, 'PJ-8622-240902083733', 'REQ-4025-240901031120', 'ededd', '20240902083733_5048c71b1fc70a32de6d556a0.pdf', '1', '2024-09-02 08:37:33', NULL);
INSERT INTO `tb_pertanggung_jawaban` (`id`, `kode`, `kode_pemohon`, `deskripsi`, `lampiran`, `status`, `created_at`, `updated_at`) VALUES
	(5, 'PJ-6280-240903043923', 'REQ-2873-240903043359', 'Pertanggungjawaban Bantuan Dana untuk Ibadah', '20240903043923_4f8e8182bc257cd6d4801541e.pdf', '1', '2024-09-03 04:39:23', NULL);
/*!40000 ALTER TABLE `tb_pertanggung_jawaban` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.tb_profil
CREATE TABLE IF NOT EXISTS `tb_profil` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sejarah` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `visi_misi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peranan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `program` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `struktur` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.tb_profil: ~1 rows (approximately)
DELETE FROM `tb_profil`;
/*!40000 ALTER TABLE `tb_profil` DISABLE KEYS */;
INSERT INTO `tb_profil` (`id`, `sejarah`, `visi_misi`, `peranan`, `program`, `struktur`, `created_at`, `updated_at`) VALUES
	(1, '<p><b>\r\n\r\n</b></p><div><div></div></div><div><div>Bimas Katolik (Bimbingan Masyarakat Katolik) adalah salah satu unit di bawah Kementerian Agama Republik Indonesia yang bertanggung jawab atas pembinaan dan pengelolaan urusan keagamaan umat Katolik di Indonesia. Berikut adalah sejarah lengkap mengenai Bimas Katolik:</div></div><div><ol><li>\r\n\r\n<div><div>Latar Belakang Sejarah</div></div>\r\n\r\n\r\n\r\n<div><div>Masuknya Agama Katolik ke Indonesia:</div></div>\r\n\r\n\r\n\r\n<div>- Agama Katolik pertama kali diperkenalkan di Nusantara oleh misionaris Portugis pada abad ke-16, khususnya di Maluku. Namun, keberadaan Katolik sempat terhalang oleh konflik dengan kolonial Belanda yang lebih mendukung Protestanisme<br>- Pada abad ke-19, misionaris dari ordo Jesuit dan Fransiskan memulai kembali penyebaran agama Katolik di wilayah Hindia Belanda. Mereka mendirikan gereja, sekolah, dan rumah sakit, serta memperkuat komunitas Katolik di berbagai daerah<br><br>\r\n\r\n<div><div>Masa Kolonial Belanda:</div></div>\r\n\r\n\r\n\r\n<div>- Selama masa penjajahan Belanda, kehidupan beragama umat Katolik dikelola secara terbatas oleh pemerintah kolonial. Gereja Katolik mendapat pengakuan resmi, namun tetap dalam kendali ketat otoritas kolonial<br>- Pendidikan yang diberikan oleh misionaris Katolik menjadi salah satu pilar penting dalam penyebaran agama ini di berbagai wilayah Indonesia</div></div></li><li><p>Era Kemerdekaan dan Pembentukan Kementerian Agama<br>\r\n\r\n\r\n\r\n</p><div><div>Pembentukan Kementerian Agama (1946)**</div></div>\r\n\r\n\r\n\r\n<div><div>- Setelah Indonesia merdeka pada 17 Agustus 1945, pemerintah segera menyadari pentingnya mengelola urusan agama secara terstruktur. Pada 3 Januari 1946, Kementerian Agama Republik Indonesia resmi dibentuk dengan tujuan untuk mengelola kehidupan beragama secara nasional.</div><div>- Awalnya, fokus utama Kementerian Agama adalah Islam, mengingat mayoritas penduduk Indonesia beragama Islam. Namun, seiring waktu, kementerian ini juga memperluas cakupannya untuk mengelola agama-agama lain, termasuk Katolik</div></div>\r\n\r\n<p></p></li><li><div>\r\n\r\n<div><div>Pembentukan Direktorat Jenderal Bimbingan Masyarakat (Bimas)</div></div>\r\n\r\n\r\n\r\n<div><div>1960-an: Perkembangan Organisasi Bimas:</div></div>\r\n\r\n\r\n\r\n<div><div>- Pada dekade 1960-an, Direktorat Jenderal Bimbingan Masyarakat (Bimas) dibentuk di bawah Kementerian Agama. Direktorat ini bertanggung jawab atas pembinaan umat dari berbagai agama yang diakui di Indonesia.</div><div>- Bimas Katolik adalah salah satu direktorat di bawah Direktorat Jenderal Bimas yang fokus pada pembinaan umat Katolik. Bimas Katolik didirikan untuk memberikan bimbingan, pengawasan, dan dukungan kepada komunitas Katolik di seluruh Indonesia.</div></div>\r\n\r\n</div></li><li>\r\n\r\n<div><div>Tugas dan Fungsi Bimas Katolik</div></div>\r\n\r\n\r\n\r\n<div><div>Pembinaan Umat Katolik:</div></div>\r\n\r\n\r\n\r\n<div><div>- Bimas Katolik memiliki tugas untuk membina umat Katolik dalam menjalankan kehidupan beragama sesuai dengan ajaran Gereja Katolik. Ini melibatkan kegiatan keagamaan, pendidikan, sosial, dan budaya yang sejalan dengan nilai-nilai Katolik.</div><div>- Bimas Katolik bekerja sama dengan Keuskupan dan Paroki dalam melaksanakan berbagai program pembinaan yang mencakup liturgi, katekes, dan pelayanan sosial.<br>\r\n\r\n<div><div>Pendidikan dan Sekolah Katolik:</div></div>\r\n\r\n\r\n\r\n<div><div>- Salah satu peran penting Bimas Katolik adalah dalam mendukung pendidikan, baik formal maupun non-formal. Sekolah-sekolah Katolik yang tersebar di berbagai wilayah Indonesia mendapatkan bimbingan dan dukungan dari Bimas Katolik.</div><div>- Program pendidikan yang diselenggarakan oleh sekolah Katolik, mulai dari tingkat dasar hingga perguruan tinggi, berkontribusi besar dalam membentuk karakter dan intelektual umat Katolik di Indonesia<br>\r\n\r\n<div><div>Pengelolaan Dana dan Bantuan:</div></div>\r\n\r\n\r\n\r\n<div><div>- Bimas Katolik juga bertanggung jawab atas pengelolaan dana yang dialokasikan oleh pemerintah untuk kegiatan keagamaan Katolik. Pengelolaan dana ini mencakup alokasi untuk kegiatan keagamaan, pendidikan, sosial, dan pembangunan infrastruktur keagamaan.</div><div>- Bimas Katolik memastikan bahwa penggunaan dana tersebut dilakukan secara transparan, akuntabel, dan sesuai dengan peraturan yang berlaku.</div></div>\r\n\r\n</div></div></div></div></li><li>\r\n\r\n<div><div>Perkembangan Hingga Saat Ini</div></div>\r\n\r\n\r\n\r\n<div><div>Modernisasi dan Digitalisasi:</div></div>\r\n\r\n\r\n\r\n<div><div>- &nbsp; Dengan kemajuan teknologi, Bimas Katolik telah berupaya untuk memodernisasi layanan dan programnya. Ini termasuk pengembangan sistem berbasis web untuk memudahkan pengelolaan data, komunikasi, dan pelaporan kegiatan.</div><div>- &nbsp; Penggunaan teknologi ini bertujuan untuk meningkatkan efisiensi, transparansi, dan akuntabilitas dalam pelaksanaan program Bimas Katolik.</div></div>\r\n\r\n\r\n\r\n<div><div>Kontribusi dalam Kerukunan Beragama:</div></div>\r\n\r\n\r\n\r\n<div><div>- &nbsp; Bimas Katolik terus berperan dalam menjaga kerukunan antarumat beragama di Indonesia. Sebagai bagian dari Kementerian Agama, Bimas Katolik turut berkontribusi dalam dialog antaragama dan upaya menciptakan harmoni sosial.</div><div>- &nbsp; Melalui program-program yang mendukung kerjasama lintas agama, Bimas Katolik membantu membangun masyarakat yang toleran dan inklusif.</div></div>\r\n\r\n</li><li>\r\n\r\n<div><div>Tantangan dan Harapan</div></div>\r\n\r\n\r\n\r\n<div><div>Tantangan:</div></div>\r\n\r\n<div><div>- &nbsp; Bimas Katolik menghadapi tantangan dalam hal pemenuhan kebutuhan umat di daerah-daerah terpencil, peningkatan kualitas pendidikan Katolik, serta pengelolaan dana yang efektif.</div><div>- &nbsp; Selain itu, menjaga relevansi di tengah perkembangan sosial dan budaya yang cepat juga menjadi tantangan tersendiri.<br>Harapan\r\n\r\n<div><div>- &nbsp; Dengan komitmen terhadap nilai-nilai Katolik dan dukungan dari pemerintah, Bimas Katolik diharapkan terus berkembang sebagai lembaga yang mampu memberikan pelayanan terbaik bagi umat Katolik di Indonesia.</div><div>- &nbsp; Bimas Katolik juga diharapkan dapat menjadi model bagi pengelolaan keagamaan yang transparan, inklusif, dan berorientasi pada kesejahteraan masyarakat.<br><br></div></div>\r\n\r\n</div></div>\r\n\r\n\r\n\r\n<div><div>Kesimpulan</div></div>\r\n\r\n\r\n\r\n<div><div>Sejarah Bimas Katolik adalah cerminan dari perjalanan panjang agama Katolik di Indonesia, dari masa penjajahan hingga era modern saat ini. Sebagai bagian dari Kementerian Agama, Bimas Katolik memainkan peran vital dalam pembinaan umat Katolik, pendidikan, dan pengelolaan dana untuk kegiatan keagamaan. Dengan terus beradaptasi terhadap perubahan zaman, Bimas Katolik berupaya untuk menjadi pilar penting dalam mendukung kehidupan beragama umat Katolik di Indonesia.</div></div>\r\n\r\n<br></li></ol><br><div><br></div></div><b><div><div></div></div>\r\n\r\n</b><p></p>', '<p>Visi Bimas Katolik<br><i>"Terwujudnya Masyarakat Katolik yang seratus persen Katolik dan seratus persen Pancasilais dalam Negara yang ber-Bhineka Tunggal Ika"<br>\r\n\r\n</i></p><div><div></div></div><div><div>Visi tersebut dicirikan oleh:</div></div><div><div></div></div>\r\n\r\n<ol><li><i>\r\n\r\n<div><div></div></div></i><div><p>Terwujudnya Komunitas Katolik yang berkualitas iman dan takwa.</p></div></li><li><p>Terwujudnya Kerukunan Umat Beragama dalam Umat Katolik kerangka kesatuan dan persatuan.</p></li><li><p>\r\n\r\n</p><div><div>Tertatanya pranata pranata Keagamaan Katolik</div></div><p></p></li><li><div>\r\n\r\n<div><p>Terkristalnya semangat kemandirian umat Katolik dan kesetiakawanan sosial atas dasar persaudaraan sejati.</p></div></div></li><li><p>\r\n\r\n</p><div><div>Terwujudnya pemahaman, penghayatan, pengamalan agama Katolik secara dewasa.</div></div><p></p></li><li><div>\r\n\r\n<div><div>Terwujudnya pemahaman, penghayatan dan pelaksanaan hak dan kewajiban sebagai warga Negara.</div></div></div></li></ol><p></p><p>\r\n\r\n</p><div><div>Misi Bimas Katolik</div></div>\r\n\r\n\r\n\r\n<div><div><i>"Mengajak masyarakat Katolik untuk berperan serta secara aktif dan dinamis dalam mencapai tujuan pembangunan bangsanya"</i>. Misi tersebut dijabarkan dalam usaha usaha:</div></div><div><ol><li>\r\n\r\n<div><p>Mengajak masyarakat Katolik untuk bersikap mengetahui, memahami, menghargai dan menghormati keanekaan dan kemajemukan yang ada dia sekitarnya. masyarakat Katolik berkiprah di tengah pembangunan.</p></div></li><li><p>\r\n\r\n</p><div><div>Mengajak bangsanya dengan semangat persaudaraan sejati.</div></div><p></p></li><li><div>\r\n\r\n<div><p>Mengajak masyarakat Katolik menggenggam paham kita dalam pola pikir dan perilakunya.</p></div></div></li></ol></div>\r\n\r\n<br><p></p>', '<p><ol><li>\r\n\r\n<div><p>Memberdayakan umat/masyarakat Katolik Indonesia</p></div></li><li><p>\r\n\r\n<div><div>Meningkatkan paham iman dan Agama di tengah yang majemuk.</div></div></p></li><li>\r\n\r\n<div><p>Menjadi jembatan/mediator/fasilitator antara pemerintah dengan masyarakat Katolik/Gereja Katolik Indonesia.</p></div></li><li><p>\r\n\r\n<div><div>Mendengarkan dan menerima serta merangkum harapan umat Katolik kepada pemerintah.</div></div></p></li><li><div>\r\n\r\n<div><div>Bersama tokoh Gereja Katolik memberikan pencerahan, penyuluhan dan pendidikan Agama Katolik kepada masyarakat Katolik.</div></div>\r\n\r\n﻿﻿</div></li></ol></p>', '<p><ol><li>\r\n\r\n<div><p>Pengelolaan dan pembinaan Pendidikan Katolik.</p></div></li><li><p>\r\n\r\n<div><div>Pengelolaan dan pembinaan Urusan Agama Katolik.</div></div></p></li><li><div>\r\n\r\n<div><p>Penyelanggaraan Administrasi perkantoran Pendidikan Bimas Katolik.</p></div></div></li><li><p>\r\n\r\n<div><div>Dukungan Managemen dan Pelaksanaan Tugas Teknis Lainnya Bimas Katolik.</div></div></p></li></ol></p>', '20240903044434_200ff5c7712e47e169083f66c.png', '2024-08-30 03:16:21', NULL);
/*!40000 ALTER TABLE `tb_profil` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.tb_sekolah
CREATE TABLE IF NOT EXISTS `tb_sekolah` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kepala_sekolah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_siswa` int(11) NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.tb_sekolah: ~1 rows (approximately)
DELETE FROM `tb_sekolah`;
/*!40000 ALTER TABLE `tb_sekolah` DISABLE KEYS */;
INSERT INTO `tb_sekolah` (`id`, `nama_sekolah`, `nama_kepala_sekolah`, `jumlah_siswa`, `alamat`, `created_at`, `updated_at`) VALUES
	(1, 'wertyuiop[', 'qwerty90', 4567, 'qwerty', '2024-08-24 16:58:50', NULL);
/*!40000 ALTER TABLE `tb_sekolah` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.tb_template
CREATE TABLE IF NOT EXISTS `tb_template` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_template` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('req','pj') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.tb_template: ~2 rows (approximately)
DELETE FROM `tb_template`;
/*!40000 ALTER TABLE `tb_template` DISABLE KEYS */;
INSERT INTO `tb_template` (`id`, `nama_template`, `kategori`, `file`, `created_at`, `updated_at`) VALUES
	(3, 'Surat Pertanggungjawaban', 'pj', '20240831055558_c2b79c201cf9833beb66dc4ce.pdf', '2024-08-31 05:55:58', NULL);
INSERT INTO `tb_template` (`id`, `nama_template`, `kategori`, `file`, `created_at`, `updated_at`) VALUES
	(4, 'Template RAB Bantuan Dana', 'req', '20240903044148_5e861b71cb219c866d42faaf6.pdf', '2024-09-03 04:41:48', NULL);
/*!40000 ALTER TABLE `tb_template` ENABLE KEYS */;

-- Dumping structure for table skripsi_2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table skripsi_2.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nama`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Fahmi Idrus', 'fahmiidrus131@gmail.com', '$2y$10$WJZowg7RAEHxysvy4iw1wufdsq/eMzQuW5H6BoE2MhuZJoqOHC7wq', NULL, '2024-08-24 16:02:24', '2024-08-24 16:02:24');
INSERT INTO `users` (`id`, `nama`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(2, 'Reynaldi Sentosa', 'reynaldi2002@gmail.com', '$2y$10$NvCXhOHHkuOeIIodfhNPsOK5lWdENCvUEZYs05/bL9atcnU2yTnS.', NULL, '2024-09-03 04:50:10', '2024-09-03 04:50:10');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
