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

-- Dumping structure for table laravel-kampus.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.cache: ~2 rows (approximately)
REPLACE INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel_kampus_cache_77de68daecd823babbb58edb1c8e14d7106e83bb', 'i:2;', 1740904548),
	('laravel_kampus_cache_77de68daecd823babbb58edb1c8e14d7106e83bb:timer', 'i:1740904548;', 1740904548);

-- Dumping structure for table laravel-kampus.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.cache_locks: ~0 rows (approximately)

-- Dumping structure for table laravel-kampus.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table laravel-kampus.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.jobs: ~0 rows (approximately)

-- Dumping structure for table laravel-kampus.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.job_batches: ~0 rows (approximately)

-- Dumping structure for table laravel-kampus.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.migrations: ~1 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_03_02_053253_create_pembayaran_mahasiswas_table', 2),
	(5, '2025_03_02_084205_create_perangkat_ajars_table', 3);

-- Dumping structure for table laravel-kampus.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table laravel-kampus.pembayaran_mahasiswas
CREATE TABLE IF NOT EXISTS `pembayaran_mahasiswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nama_mahasiswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `jumlah_pembayaran` decimal(10,2) NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` tinyint(1) NOT NULL DEFAULT '1',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_mahasiswas_user_id_foreign` (`user_id`),
  CONSTRAINT `pembayaran_mahasiswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.pembayaran_mahasiswas: ~5 rows (approximately)
REPLACE INTO `pembayaran_mahasiswas` (`id`, `user_id`, `nama_mahasiswa`, `nim`, `jenis_pembayaran`, `tanggal_pembayaran`, `jumlah_pembayaran`, `bukti_pembayaran`, `status_pembayaran`, `keterangan`, `created_at`, `updated_at`) VALUES
	(5, 1, 'Tempore voluptate s', 'Ea perferendis modi', 'Aute sed laborum Om', '1991-04-15', 56.00, '1740898568.jpg', 1, 'Dolore officia qui p', '2025-03-01 23:56:08', '2025-03-01 23:56:08'),
	(6, 1, 'Id dicta ex voluptat', 'Enim accusamus a lib', 'Fugit pariatur Nis', '2002-07-07', 88.00, '1740898593.jpg', 1, 'Eaque velit perferen', '2025-03-01 23:56:33', '2025-03-01 23:56:33'),
	(7, 4, 'Aliquid corporis ani', 'Omnis quia eum conse', 'Harum dolor voluptas', '1976-10-27', 43.00, '1740903971.png', 1, 'Ad proident consequ', '2025-03-02 01:26:11', '2025-03-02 01:26:11'),
	(8, 4, 'Nostrum earum aut ma', 'Cupiditate animi pa', 'Aut architecto paria', '2011-10-24', 35.00, '1740914927.jpg', 1, 'Possimus sapiente e', '2025-03-02 04:28:47', '2025-03-02 04:28:47'),
	(9, 14, 'fdsf', '423234234', 'Tenetur anim ad eum', '2025-03-02', 4234234.00, '1740920446.png', 1, 'dsfsdfsdfs', '2025-03-02 06:00:46', '2025-03-02 06:00:46');

-- Dumping structure for table laravel-kampus.perangkat_ajars
CREATE TABLE IF NOT EXISTS `perangkat_ajars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `nama_perangkat_ajar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mata_kuliah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_perangkat_ajar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perangkat_ajars_user_id_foreign` (`user_id`),
  CONSTRAINT `perangkat_ajars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.perangkat_ajars: ~3 rows (approximately)
REPLACE INTO `perangkat_ajars` (`id`, `user_id`, `nama_perangkat_ajar`, `mata_kuliah`, `semester`, `tahun_ajaran`, `file_perangkat_ajar`, `created_at`, `updated_at`) VALUES
	(1, 3, 'Do dolore minus saep', 'Dolores odio excepte', 'Voluptatibus non eu', '2024-04-08 00:00:00', '1740905584_JUKNIS SELEKSI LKS WEB KAB. MOJOKERTO-Rev 1.pdf', '2025-03-02 01:53:04', '2025-03-02 01:53:04'),
	(3, 3, 'Nesciunt aut qui de', 'Dolor suscipit dolor', 'Ut aut dolor eum omn', '2015-01-20 00:00:00', '1740914860_JUKNIS SELEKSI LKS WEB KAB. MOJOKERTO-Rev 1.pdf', '2025-03-02 04:27:40', '2025-03-02 04:27:40'),
	(4, 15, 'sfdfsdfsf', 'sdfsdfsd', 'ffssfsf', '2025-03-02 00:00:00', '1740920522_JUKNIS SELEKSI LKS WEB KAB. MOJOKERTO-Rev 1.pdf', '2025-03-02 06:02:02', '2025-03-02 06:02:02');

-- Dumping structure for table laravel-kampus.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.sessions: ~2 rows (approximately)
REPLACE INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('QMepFjrW0mVWoU0nSB3M9TEPmLwf8tJULmLoQoBj', 15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidTc4OFJGU2VPa0hlQTlpWTFoUWc0ZmpPSTVXNk5LMnFaMUFaRGpEViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly9sYXJhdmVsLWthbXB1cy50ZXN0L2Rvc2VuLzQvZWRpdCI7fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNTt9', 1740920536),
	('WlcutlA0NtLlEO0QoEs2xpzm9Hb2EzZiBrdcmeXE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid3BpWEVLTUhibGV6bDl5VGVDSGZnZ1BvUnNqVm1PdTZXQXhMTUd1MSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sYXJhdmVsLWthbXB1cy50ZXN0L3VzZXJzIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1740920483);

-- Dumping structure for table laravel-kampus.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` enum('mahasiswa','admin','dosen') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mahasiswa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel-kampus.users: ~5 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `usertype`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Dev fdsfsdf', 'dev@gmail.com', '2025-03-01 00:11:50', '$2y$12$8A3Ko6UjQGNFABcIciRZ2Ocd85GWxXiWhdHfu85N48jxFNB2vYa36', 'admin', '1moy77hSXkYRMQ2MzIyKLhCcUeMI3SLHSPAOqWRbZDGZIrmgVfN7fgQbesbY', '2025-03-01 00:11:50', '2025-03-01 22:19:53'),
	(3, 'Shay Ayala afsdfsdf', 'mapydupo@mailinator.com', '2025-03-02 01:34:59', '$2y$12$bUiUxfsH1uwN.LBz56AmhemG.2yQV49vipw16RYLYVW6Wib8zsWC2', 'dosen', NULL, '2025-03-01 21:54:31', '2025-03-02 01:34:59'),
	(4, 'Lucas Bauer ddd', 'vyvan@mailinator.com', '2025-03-02 01:05:48', '$2y$12$Ey5n7pK3RPMrkBe7OZCAN.FMSoWXXHZ2YYakiqPPTCzVRYkxA5gVG', 'mahasiswa', NULL, '2025-03-01 21:54:50', '2025-03-02 01:17:38'),
	(14, 'Robert Harrington', 'hagewav@mailinator.com', '2025-03-03 06:26:07', '$2y$12$f0sZfV7o77F/HIZCt0AeQ.O41luQMudIMpqa22qwl0BC8.dN4vjd2', 'mahasiswa', NULL, '2025-03-02 05:59:48', '2025-03-02 05:59:48'),
	(15, 'Shana Huber', 'tysimagug@mailinator.com', '2025-03-03 06:26:09', '$2y$12$Mhfe3qXZLHUV8cLBMkBueO2O.3SX3Spno8RRuiPGefyIdwLF7e/we', 'dosen', NULL, '2025-03-02 06:01:22', '2025-03-02 06:01:22');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
