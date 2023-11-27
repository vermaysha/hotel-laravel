-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.11.2-MariaDB-1:10.11.2+maria~ubu2204 - mariadb.org binary distribution
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table p3l_b_10784.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kamar_id` int(10) unsigned NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned NOT NULL DEFAULT 0,
  `uniq_id` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT '0',
  `nama_pelanggan` varchar(50) NOT NULL DEFAULT '0',
  `alamat_pelanggan` text DEFAULT NULL,
  `kekurangan` int(11) DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table p3l_b_10784.bookings: ~3 rows (approximately)
INSERT IGNORE INTO `bookings` (`id`, `kamar_id`, `user_id`, `uniq_id`, `status`, `nama_pelanggan`, `alamat_pelanggan`, `kekurangan`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
	(6, 3, 3, NULL, 'completed', 'Ashary Vermaysha', NULL, 1485000, '2023-11-21 00:00:00', '2023-11-23 00:00:00', '2023-11-21 04:25:29', '2023-11-21 04:28:50'),
	(8, 3, 3, NULL, 'completed', 'Ashary Vermaysha', NULL, 1485000, '2023-11-21 00:00:00', '2023-11-22 00:00:00', '2023-11-21 06:16:15', '2023-11-21 06:16:34'),
	(9, 3, 3, NULL, 'checkin', 'Ashary Vermaysha', NULL, 1485000, '2023-11-21 00:00:00', '2023-11-22 00:00:00', '2023-11-21 06:36:19', '2023-11-21 06:36:19');

-- Dumping structure for table p3l_b_10784.booking_layanan_kamar
CREATE TABLE IF NOT EXISTS `booking_layanan_kamar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` int(10) unsigned NOT NULL DEFAULT 0,
  `layanan_kamar_id` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table p3l_b_10784.booking_layanan_kamar: ~5 rows (approximately)
INSERT IGNORE INTO `booking_layanan_kamar` (`id`, `booking_id`, `layanan_kamar_id`, `created_at`, `updated_at`) VALUES
	(4, 8, 1, '2023-11-21 13:16:15', '2023-11-21 13:16:15'),
	(5, 8, 2, '2023-11-21 13:16:15', '2023-11-21 13:16:15'),
	(6, 8, 3, '2023-11-21 13:16:15', '2023-11-21 13:16:15'),
	(7, 9, 1, '2023-11-21 13:36:19', '2023-11-21 13:36:19'),
	(8, 9, 2, '2023-11-21 13:36:19', '2023-11-21 13:36:19');

-- Dumping structure for table p3l_b_10784.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `nama_customer` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_institusi` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_user_id_foreign` (`user_id`),
  CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.customers: ~0 rows (approximately)

-- Dumping structure for table p3l_b_10784.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table p3l_b_10784.kamars
CREATE TABLE IF NOT EXISTS `kamars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `jenis_kamar` varchar(255) NOT NULL,
  `tipe_tempat_tidur` varchar(255) NOT NULL,
  `tarif_awal` int(11) NOT NULL,
  `ukuran_kamar` int(11) NOT NULL,
  `kapasitas_kamar` int(11) NOT NULL,
  `rincian_kamar` varchar(255) NOT NULL,
  `detail_kamar` varchar(255) NOT NULL,
  `tarif_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kamars_tarif_id_foreign` (`tarif_id`),
  CONSTRAINT `kamars_tarif_id_foreign` FOREIGN KEY (`tarif_id`) REFERENCES `tarifs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.kamars: ~1 rows (approximately)
INSERT IGNORE INTO `kamars` (`id`, `jenis_kamar`, `tipe_tempat_tidur`, `tarif_awal`, `ukuran_kamar`, `kapasitas_kamar`, `rincian_kamar`, `detail_kamar`, `tarif_id`, `created_at`, `updated_at`) VALUES
	(3, 'deluxe', 'king', 15000, 2, 20, 'bagus', 'nice', 2, '2023-11-02 02:49:54', '2023-11-22 02:49:54');

-- Dumping structure for table p3l_b_10784.layanan_kamars
CREATE TABLE IF NOT EXISTS `layanan_kamars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(255) NOT NULL,
  `tarif_layanan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.layanan_kamars: ~2 rows (approximately)
INSERT IGNORE INTO `layanan_kamars` (`id`, `nama_layanan`, `tarif_layanan`, `created_at`, `updated_at`) VALUES
	(1, 'Extra Bed', 10000, '2023-11-21 11:35:59', '2023-11-21 11:36:01'),
	(2, 'Laundry', 150000, '2023-11-21 11:36:11', '2023-11-21 11:36:13'),
	(3, 'Tambahan breakfast', 50000, '2023-11-21 11:36:33', '2023-11-21 11:36:36');

-- Dumping structure for table p3l_b_10784.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.migrations: ~10 rows (approximately)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_10_16_082520_create_seasons_table', 1),
	(6, '2023_10_16_092621_create_tarifs_table', 1),
	(7, '2023_10_17_031001_create_kamars_table', 1),
	(8, '2023_10_22_054121_create_layanan_kamars_table', 1),
	(9, '2023_10_22_060210_create_customers_table', 1),
	(10, '2023_10_29_100027_create_roles_table', 1);

-- Dumping structure for table p3l_b_10784.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.password_resets: ~0 rows (approximately)

-- Dumping structure for table p3l_b_10784.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table p3l_b_10784.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_role_name_unique` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.roles: ~6 rows (approximately)
INSERT IGNORE INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2023-11-13 10:27:19', '2023-11-13 10:27:19'),
	(2, 'sm', '2023-11-13 10:27:19', '2023-11-13 10:27:19'),
	(3, 'gm', '2023-11-13 10:27:19', '2023-11-13 10:27:19'),
	(4, 'owner', '2023-11-13 10:27:19', '2023-11-13 10:27:19'),
	(5, 'customer', '2023-11-13 10:27:19', '2023-11-13 10:27:19'),
	(6, 'fo', '2023-11-13 10:27:19', '2023-11-13 10:27:19');

-- Dumping structure for table p3l_b_10784.seasons
CREATE TABLE IF NOT EXISTS `seasons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_season` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.seasons: ~1 rows (approximately)
INSERT IGNORE INTO `seasons` (`id`, `nama_season`, `tanggal_mulai`, `tanggal_berakhir`, `created_at`, `updated_at`) VALUES
	(1, 'natal', '2023-11-01', '2023-11-03', '2023-11-01 02:49:05', '2023-11-01 02:49:05');

-- Dumping structure for table p3l_b_10784.tarifs
CREATE TABLE IF NOT EXISTS `tarifs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tarif_terpasang` int(11) NOT NULL,
  `season_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tarifs_season_id_foreign` (`season_id`),
  CONSTRAINT `tarifs_season_id_foreign` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.tarifs: ~1 rows (approximately)
INSERT IGNORE INTO `tarifs` (`id`, `tarif_terpasang`, `season_id`, `created_at`, `updated_at`) VALUES
	(2, 1500000, 1, '2023-11-01 02:49:33', '2023-11-01 02:49:33');

-- Dumping structure for table p3l_b_10784.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_identitas` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_institusi` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table p3l_b_10784.users: ~12 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `no_identitas`, `nomor_telepon`, `alamat`, `nama_institusi`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Nia Kunze', 'heaven39@example.org', '4929759913631', '+1-864-740-9105', '54536 Robyn Inlet Apt. 198\nPort Emoryland, AR 87857-3127', 'Hodkiewicz, Stamm and Klocko', '2023-11-13 10:27:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'RTXoedeoVk', '2023-11-13 10:27:20', '2023-11-13 10:27:20'),
	(2, 'Winifred Ullrich', 'wilfredo44@example.net', '2221798767109356', '+1 (407) 757-5118', '4700 Casper Hill Apt. 186\nLoniefort, IN 76273-7502', 'Towne, Klocko and Keeling', '2023-11-13 10:27:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 6, 'vINJgDh4Ji', '2023-11-13 10:27:20', '2023-11-13 10:27:20'),
	(3, 'Webster Schmeler', 'oda.bergnaum@example.org', '4716043764164940', '785-652-5583', '179 Stoltenberg Mall Suite 638\nPort Emmystad, WY 00794', 'Kiehn-Romaguera', '2023-11-13 10:27:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 'C1ktVB0avwqMiuzbGsiJEKuzms8SGoAJAeNsnoDNLjp64KsLeRTEKbPMzs9z', '2023-11-13 10:27:20', '2023-11-13 10:27:20'),
	(4, 'Candice Terry', 'lind.maudie@example.net', '5447894039627084', '+1-406-643-4592', '5976 Quitzon Junction\nEast Jerald, GA 01108', 'Pacocha LLC', '2023-11-13 10:27:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 'XLEiSPYHtx', '2023-11-13 10:27:20', '2023-11-13 10:27:20'),
	(5, 'Milton Brekke', 'kadin56@example.com', '5553597235716979', '+15398392465', '767 Jabari Keys Suite 938\nManteville, NE 08363-5022', 'Schinner Inc', '2023-11-13 10:27:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 'toveaFirPH', '2023-11-13 10:27:20', '2023-11-13 10:27:20'),
	(6, 'Amelia Adams', 'deon.schumm@example.org', '4024007104044390', '989.424.1989', '105 Shannon Circles\nPort Cordell, WY 45831-0345', 'Bashirian Group', '2023-11-13 10:27:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 'C4p48L7qsI', '2023-11-13 10:27:20', '2023-11-13 10:27:20'),
	(7, 'Wilhelmine Kris', 'edwardo34@example.com', '4556406354972217', '1-267-668-4272', '71998 Effie Orchard Apt. 473\nWest Joseph, TX 40314-7234', 'Frami LLC', '2023-11-13 10:27:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 6, '0peqAMgrlu', '2023-11-13 10:27:20', '2023-11-13 10:27:20'),
	(8, 'Thelma Breitenberg', 'lubowitz.jermain@example.com', '4916976414907705', '+14692127430', '53798 Sauer Landing Apt. 941\nWest Alejandra, WV 13968-4249', 'Rogahn-Leuschke', '2023-11-13 10:27:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 6, '5ChTIosUDp', '2023-11-13 10:27:20', '2023-11-13 10:27:20'),
	(9, 'Arlene Macejkovic', 'ukautzer@example.org', '6011378494550621', '1-920-952-4531', '777 Will Pines\nWest Carroll, OH 05742', 'Medhurst Ltd', '2023-11-13 10:27:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, 'ULqghRU5yP', '2023-11-13 10:27:20', '2023-11-13 10:27:20'),
	(10, 'Odell Carter I', 'anthony18@example.org', '4532103215682064', '+1.337.634.6193', '945 King Roads Apt. 986\nPort Jaiden, MT 73373-3390', 'Hermiston-McLaughlin', '2023-11-13 10:27:20', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 6, '5RshZjotpq', '2023-11-13 10:27:20', '2023-11-13 10:27:20'),
	(11, 'Ariel', 'ariel@mail.com', '123', '0895505050', 'jalan pattimura', 'uajy', NULL, '$2y$10$9SruEbKReN.qhLSavgo4v.nwLa5ba.sEy1l422fNunp/FA7uHnkHu', 5, NULL, '2023-11-13 12:33:20', '2023-11-13 12:33:20'),
	(12, 'Ariel', 'ariel@mail.comds', '123', '08955050111', 'jalan pattimura', 'uajy', NULL, '$2y$10$7wGVrAioiFPTvwnPQL11/.eux9fkW/hO1RAFdqJOjyb8GihSKGIfS', 0, NULL, '2023-11-13 12:35:11', '2023-11-13 12:35:11');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
