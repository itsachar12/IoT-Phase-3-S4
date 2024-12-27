-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Des 2024 pada 18.05
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-iot-phase-3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `appliances`
--

CREATE TABLE `appliances` (
  `id_appliances` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `usage_time` int(11) NOT NULL,
  `speed_fan` varchar(20) DEFAULT NULL,
  `degree` float DEFAULT NULL,
  `electrical_power` int(11) NOT NULL,
  `total_power` int(11) NOT NULL,
  `type_appliance` varchar(50) NOT NULL,
  `lux` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `appliances`
--

INSERT INTO `appliances` (`id_appliances`, `name`, `status`, `start_time`, `usage_time`, `speed_fan`, `degree`, `electrical_power`, `total_power`, `type_appliance`, `lux`) VALUES
(1, 'AC 1', 'Inactive', '2024-12-27 17:00:00', 0, 'NORMAL', 27, 457, 0, 'AC', 0),
(2, 'Lamp 1', 'Inactive', '2024-12-27 17:00:00', 0, '0', 0, 29, 0, 'Light', 0),
(3, 'AC 2 ', 'Active', '2024-12-27 17:00:00', 875, 'NORMAL', 16, 564, 137, 'AC', 0),
(4, 'Lamp 2', 'Active', '2024-12-27 17:00:00', 10, '0', 0, 20, 0, 'Light', 43),
(5, 'Lamp 3', 'Active', '2024-12-27 17:00:00', 10, '0', 0, 18, 0, 'Light', 69);

--
-- Trigger `appliances`
--
DELIMITER $$
CREATE TRIGGER `update_total_power` BEFORE UPDATE ON `appliances` FOR EACH ROW SET new.total_power = (new.electrical_power * new.usage_time)/3600
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `emitter`
--

CREATE TABLE `emitter` (
  `id_emission` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `power` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `emission` float NOT NULL,
  `predicted_emission` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `emitter`
--

INSERT INTO `emitter` (`id_emission`, `name`, `power`, `status`, `emission`, `predicted_emission`) VALUES
(1, 'Diesel', 12, 'Active', 52.9, 512.1),
(2, 'Gas Engine', 16, 'Inactive', 30.4, 300),
(3, 'PLN', 3, 'Active', 12.2, 300),
(4, 'Panel Surya', 0, 'Active', 0.9, 10);

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
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reports`
--

CREATE TABLE `reports` (
  `id_report` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `type_report` varchar(50) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `time_span` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reports`
--

INSERT INTO `reports` (`id_report`, `description`, `date`, `type_report`, `periode`, `time_span`) VALUES
(9, 'Laporan Penggunaan Lampu di Ruangan Utama Minggi Ini', '2024-12-19', 'Light', 'Today', '2024-12-19'),
(12, 'Test Month', '2024-12-26', 'Light', 'Month', '2024-11-26'),
(13, 'test lampu 7 hari', '2024-12-27', 'Light', 'Week', '2024-12-20'),
(14, 'TEST WEEK 2', '2024-12-27', 'AC', 'Week', '2024-12-20'),
(15, 'Today', '2024-12-28', 'Light', 'Today', '2024-12-28'),
(16, 'no', '2024-12-22', 'Light', 'Today', '2024-12-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` int(11) NOT NULL,
  `name_appliance` varchar(255) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `repeat_schedule` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_appliances` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `name_appliance`, `time_start`, `time_end`, `repeat_schedule`, `status`, `id_appliances`) VALUES
(19, 'AC 1', '14:30:00', '14:33:00', 'Once', 'Active', 1);

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
('0UilLEF3EEry8Ffas6rLCh8o2n94Cm5pIOwrnkId', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickZ5VkhZT3Z6VE90N09mU3RPVE1sMm5GWFlYazNTcW95THZvZlhRQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731851525),
('i5BfqRMcGlU20DrW1sY2cjj9bAkFq991P08CmWoN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEluSU9NTlFQaTBWa1MwWVFyNWc1TTNGcTVzYXNqQW1lbzd3bE9CVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731846572),
('lttjzH2qZo6oTO5hjHQcHdHVdtBu5ijvaOMj2Iuu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYURpT1dsSFRYM2VrWXhwUG53UlR0MkEzV0h4Um1jQmhnbk1uSUdDQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731850684),
('SGcTSjrQ9Vgh3Gvoee85fxOonDlc0gxxZCxjmM6F', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMUh1dDZYUnZ0OG85cHU2MnljRjl0cktxa0J2TnhHa2ZNb2pLTGpveiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731845367),
('tQ7s5GsIzQKkHVd7rvHSBHNEMSGrfFM0AIdS1Gvs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3JnYmFQQ0FOVDUySVUyT3ZaSFBZa1FocktZMXZwZDhMeERSYWRJMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731852290),
('WPA83bBaddMn2zXN32iib746nyIQkY6s8mt3TACH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmNCQjI0ZklDYm1ueHhhTTZEVkNud091ZmpSZ3VmTVJXejZta3FDMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731845079);

-- --------------------------------------------------------

--
-- Struktur dari tabel `summary`
--

CREATE TABLE `summary` (
  `id_summary` int(11) NOT NULL,
  `id_appliances` int(11) NOT NULL,
  `total_power` int(50) NOT NULL,
  `total_usage_time` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `summary`
--

INSERT INTO `summary` (`id_summary`, `id_appliances`, `total_power`, `total_usage_time`, `created_at`, `updated_at`) VALUES
(2, 5, 8683, 25186, '2024-12-19 16:00:38', '2024-02-24 09:47:58'),
(3, 5, 4465, 71684, '2024-12-21 10:07:26', '2024-11-12 14:50:31'),
(4, 3, 5874, 17146, '2024-04-04 03:40:01', '2024-05-11 22:30:30'),
(5, 2, 9555, 50181, '2024-01-01 06:35:23', '2024-03-28 23:35:38'),
(6, 5, 6582, 214, '2024-07-24 13:24:44', '2024-03-25 11:25:26'),
(7, 1, 8159, 1712, '2024-09-22 16:18:07', '2024-03-06 05:02:32'),
(8, 1, 133, 28406, '2024-05-06 10:22:02', '2024-10-16 13:23:16'),
(9, 2, 4005, 24150, '2024-06-11 11:10:01', '2024-11-26 21:10:21'),
(10, 4, 2394, 78527, '2024-05-13 02:47:45', '2024-08-22 03:35:41'),
(11, 5, 1870, 39148, '2024-12-11 07:32:47', '2024-05-14 08:34:18'),
(12, 2, 9183, 3365, '2024-01-12 20:42:30', '2024-06-28 03:53:51'),
(13, 5, 5939, 8390, '2024-08-03 15:15:52', '2024-02-23 00:11:17'),
(14, 4, 6861, 65655, '2024-04-10 02:10:07', '2024-09-26 00:13:59'),
(15, 1, 1745, 52046, '2024-01-02 09:27:16', '2024-02-01 09:04:02'),
(16, 5, 3655, 82545, '2024-06-09 16:22:39', '2024-09-06 06:39:31'),
(17, 5, 2411, 77295, '2024-08-21 15:54:41', '2024-06-10 13:05:06'),
(18, 3, 7698, 7649, '2024-01-18 09:06:49', '2024-12-23 12:24:28'),
(19, 3, 950, 71464, '2024-01-02 04:38:24', '2024-05-02 02:48:53'),
(20, 1, 3112, 48157, '2024-04-15 11:26:51', '2024-05-31 21:02:59'),
(21, 3, 3825, 67995, '2024-06-12 02:39:17', '2024-05-28 03:52:00'),
(22, 2, 8250, 48267, '2024-05-07 17:00:24', '2024-01-23 20:29:39'),
(23, 2, 6165, 71965, '2024-12-18 10:28:18', '2024-04-22 09:17:56'),
(24, 3, 8084, 64521, '2024-12-22 00:33:27', '2024-03-27 09:11:50'),
(25, 3, 8799, 26367, '2024-10-22 12:48:05', '2024-10-13 15:00:20'),
(26, 5, 3187, 58174, '2024-11-08 11:47:07', '2024-08-13 13:31:42'),
(27, 5, 7466, 12991, '2024-11-28 02:06:52', '2024-06-20 15:46:11'),
(28, 2, 4269, 21269, '2024-10-02 01:31:01', '2024-05-13 00:53:09'),
(29, 1, 8113, 21381, '2024-09-11 15:09:04', '2024-05-01 05:07:05'),
(30, 5, 1798, 83922, '2024-03-08 17:09:54', '2024-12-15 21:26:44'),
(31, 5, 1019, 39975, '2024-10-27 01:10:07', '2024-04-01 20:20:59'),
(32, 3, 56, 16557, '2024-07-03 00:13:23', '2024-06-02 12:05:46'),
(33, 5, 6055, 51735, '2024-11-24 04:49:16', '2024-05-17 19:10:38'),
(34, 3, 3309, 25644, '2024-12-04 00:20:49', '2024-04-03 22:57:32'),
(35, 3, 7237, 10828, '2024-10-16 12:42:44', '2024-05-13 22:40:14'),
(36, 4, 4359, 63884, '2024-02-11 04:10:20', '2024-07-14 18:38:31'),
(37, 1, 1164, 10355, '2024-08-13 21:49:46', '2024-03-17 16:06:26'),
(38, 1, 3430, 19893, '2024-11-24 16:36:04', '2024-02-07 00:23:05'),
(39, 1, 3494, 47734, '2024-09-21 01:39:27', '2024-02-28 04:29:57'),
(40, 4, 3598, 16421, '2024-11-25 16:36:47', '2024-06-04 16:25:43'),
(41, 2, 2953, 39941, '2024-09-05 19:08:59', '2024-02-07 02:18:52'),
(42, 5, 5056, 53739, '2024-05-01 05:42:02', '2024-05-12 14:47:36'),
(43, 2, 2569, 22079, '2024-07-19 04:20:35', '2024-07-04 08:55:56'),
(44, 5, 5654, 58777, '2024-04-20 15:36:26', '2024-05-18 08:06:19'),
(45, 3, 259, 13008, '2024-07-09 14:59:13', '2024-11-15 21:57:34'),
(46, 1, 9426, 25796, '2024-08-09 20:51:14', '2024-07-20 02:52:19'),
(47, 5, 8362, 83686, '2024-08-29 03:02:49', '2024-02-28 20:39:43'),
(48, 1, 3513, 32651, '2024-02-23 20:01:17', '2024-01-08 19:03:06'),
(49, 1, 7316, 6827, '2024-04-15 13:09:57', '2024-04-09 18:20:55'),
(50, 5, 8958, 29098, '2024-03-15 09:21:15', '2024-05-08 21:18:14'),
(51, 1, 0, 8501, '2024-12-24 16:00:00', '2024-12-24 16:00:00'),
(52, 2, 176, 21895, '2024-12-24 16:00:00', '2024-12-24 16:00:00'),
(53, 3, 0, 4900, '2024-12-24 16:00:00', '2024-12-24 16:00:00'),
(54, 4, 113, 20278, '2024-12-24 16:00:00', '2024-12-24 16:00:00'),
(55, 5, 92, 18478, '2024-12-24 16:00:01', '2024-12-24 16:00:01'),
(56, 1, 3822, 30105, '2024-12-24 17:00:00', '2024-12-24 17:00:00'),
(57, 2, 205, 25501, '2024-12-24 17:00:00', '2024-12-24 17:00:00'),
(58, 3, 4159, 26548, '2024-12-24 17:00:00', '2024-12-24 17:00:00'),
(59, 4, 133, 23884, '2024-12-24 17:00:00', '2024-12-24 17:00:00'),
(60, 5, 110, 22084, '2024-12-24 17:00:00', '2024-12-24 17:00:00'),
(61, 1, 4280, 33717, '2024-12-24 18:00:00', '2024-12-24 18:00:00'),
(62, 2, 205, 25501, '2024-12-24 18:00:00', '2024-12-24 18:00:00'),
(63, 3, 4718, 30116, '2024-12-24 18:00:00', '2024-12-24 18:00:00'),
(64, 4, 133, 23884, '2024-12-24 18:00:00', '2024-12-24 18:00:00'),
(65, 5, 110, 22084, '2024-12-24 18:00:00', '2024-12-24 18:00:00'),
(66, 1, 4334, 34137, '2024-12-25 13:00:01', '2024-12-25 13:00:01'),
(67, 2, 786, 97555, '2024-12-25 13:00:01', '2024-12-25 13:00:01'),
(68, 3, 4784, 30536, '2024-12-25 13:00:01', '2024-12-25 13:00:01'),
(69, 4, 533, 95938, '2024-12-25 13:00:01', '2024-12-25 13:00:01'),
(70, 5, 471, 94138, '2024-12-25 13:00:01', '2024-12-25 13:00:01'),
(71, 1, 0, 0, '2024-12-25 14:00:00', '2024-12-25 14:00:00'),
(72, 2, 609, 75600, '2024-12-25 14:00:00', '2024-12-25 14:00:00'),
(73, 3, 0, 0, '2024-12-25 14:00:00', '2024-12-25 14:00:00'),
(74, 4, 420, 75600, '2024-12-25 14:00:00', '2024-12-25 14:00:00'),
(75, 5, 378, 75599, '2024-12-25 14:00:00', '2024-12-25 14:00:00'),
(76, 1, 9748, 76788, '2024-12-25 15:00:00', '2024-12-25 15:00:00'),
(77, 2, 0, 0, '2024-12-25 15:00:00', '2024-12-25 15:00:00'),
(78, 3, 12030, 76788, '2024-12-25 15:00:00', '2024-12-25 15:00:00'),
(79, 4, 0, 0, '2024-12-25 15:00:00', '2024-12-25 15:00:00'),
(80, 5, 382, 76445, '2024-12-25 15:00:00', '2024-12-25 15:00:00'),
(81, 1, 472, 3715, '2024-12-25 16:00:00', '2024-12-25 16:00:00'),
(82, 2, 5, 600, '2024-12-25 16:00:01', '2024-12-25 16:00:01'),
(83, 3, 12058, 76963, '2024-12-25 16:00:01', '2024-12-25 16:00:01'),
(84, 4, 23, 4205, '2024-12-25 16:00:01', '2024-12-25 16:00:01'),
(85, 5, 384, 76740, '2024-12-25 16:00:01', '2024-12-25 16:00:01'),
(86, 1, 4, 35, '2024-12-26 11:00:01', '2024-12-26 11:00:01'),
(87, 2, 1, 75, '2024-12-26 11:00:01', '2024-12-26 11:00:01'),
(88, 3, 16, 105, '2024-12-26 11:00:01', '2024-12-26 11:00:01'),
(89, 4, 1, 220, '2024-12-26 11:00:01', '2024-12-26 11:00:01'),
(90, 5, 1, 290, '2024-12-26 11:00:01', '2024-12-26 11:00:01'),
(91, 1, 4, 35, '2024-12-26 12:00:00', '2024-12-26 12:00:00'),
(92, 2, 1, 75, '2024-12-26 12:00:00', '2024-12-26 12:00:00'),
(93, 3, 16, 105, '2024-12-26 12:00:00', '2024-12-26 12:00:00'),
(94, 4, 1, 220, '2024-12-26 12:00:00', '2024-12-26 12:00:00'),
(95, 5, 1, 290, '2024-12-26 12:00:00', '2024-12-26 12:00:00'),
(96, 1, 4, 35, '2024-12-26 13:00:01', '2024-12-26 13:00:01'),
(97, 2, 1, 75, '2024-12-26 13:00:01', '2024-12-26 13:00:01'),
(98, 3, 16, 105, '2024-12-26 13:00:01', '2024-12-26 13:00:01'),
(99, 4, 2, 310, '2024-12-26 13:00:01', '2024-12-26 13:00:01'),
(100, 5, 2, 380, '2024-12-26 13:00:01', '2024-12-26 13:00:01'),
(101, 1, 0, 0, '2024-12-27 14:00:01', '2024-12-27 14:00:01'),
(102, 2, 0, 0, '2024-12-27 14:00:01', '2024-12-27 14:00:01'),
(103, 3, 24, 150, '2024-12-27 14:00:01', '2024-12-27 14:00:01'),
(104, 4, 0, 0, '2024-12-27 14:00:01', '2024-12-27 14:00:01'),
(105, 5, 0, 0, '2024-12-27 14:00:01', '2024-12-27 14:00:01'),
(106, 1, 0, 0, '2024-12-27 15:00:00', '2024-12-27 15:00:00'),
(107, 2, 0, 0, '2024-12-27 15:00:00', '2024-12-27 15:00:00'),
(108, 3, 67, 425, '2024-12-27 15:00:00', '2024-12-27 15:00:00'),
(109, 4, 0, 0, '2024-12-27 15:00:00', '2024-12-27 15:00:00'),
(110, 5, 0, 0, '2024-12-27 15:00:00', '2024-12-27 15:00:00'),
(111, 1, 0, 0, '2024-12-27 16:00:00', '2024-12-27 16:00:00'),
(112, 2, 0, 0, '2024-12-27 16:00:00', '2024-12-27 16:00:00'),
(113, 3, 107, 680, '2024-12-27 16:00:00', '2024-12-27 16:00:00'),
(114, 4, 0, 0, '2024-12-27 16:00:00', '2024-12-27 16:00:00'),
(115, 5, 0, 0, '2024-12-27 16:00:00', '2024-12-27 16:00:00'),
(116, 1, 0, 0, '2024-12-27 17:00:00', '2024-12-27 17:00:00'),
(117, 2, 0, 0, '2024-12-27 17:00:00', '2024-12-27 17:00:00'),
(118, 3, 128, 820, '2024-12-27 17:00:00', '2024-12-27 17:00:00'),
(119, 4, 0, 0, '2024-12-27 17:00:00', '2024-12-27 17:00:00'),
(120, 5, 0, 0, '2024-12-27 17:00:00', '2024-12-27 17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `picture` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `picture`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', '', 'admin@gmail.com', NULL, '$2y$10$M1MuYXw9WcUt7uMyIjPNVORcIDNkQRCYngv/4jcAh6N7aR7OK7w2u', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `appliances`
--
ALTER TABLE `appliances`
  ADD PRIMARY KEY (`id_appliances`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `emitter`
--
ALTER TABLE `emitter`
  ADD PRIMARY KEY (`id_emission`);

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
-- Indeks untuk tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id_report`);

--
-- Indeks untuk tabel `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_appliances` (`id_appliances`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`id_summary`),
  ADD KEY `id_appliances` (`id_appliances`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `appliances`
--
ALTER TABLE `appliances`
  MODIFY `id_appliances` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `emitter`
--
ALTER TABLE `emitter`
  MODIFY `id_emission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `summary`
--
ALTER TABLE `summary`
  MODIFY `id_summary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`id_appliances`) REFERENCES `appliances` (`id_appliances`);

--
-- Ketidakleluasaan untuk tabel `summary`
--
ALTER TABLE `summary`
  ADD CONSTRAINT `summary_ibfk_1` FOREIGN KEY (`id_appliances`) REFERENCES `appliances` (`id_appliances`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
