-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Bulan Mei 2025 pada 16.25
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
(1, 'AC 1', 'Active', '2025-05-10 17:00:00', 0, 'FAST', 16, 457, 0, 'AC', 2),
(2, 'Lamp 1', 'Inactive', '2025-05-10 17:00:00', 0, '0', 0, 29, 0, 'Light', 0),
(3, 'AC 2 ', 'Active', '2025-05-10 17:00:00', 0, 'NORMAL', 16, 564, 0, 'AC', 67),
(6, 'Lamp 2', 'Inactive', '2025-05-10 17:00:00', 0, '0', 0, 35, 0, 'Light', 0);

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
(12, 'Test Month', '2024-12-26', 'Light', 'Month', '2024-11-26'),
(13, 'test lampu 7 hari', '2024-12-27', 'Light', 'Week', '2024-12-20'),
(14, 'TEST WEEK 2', '2024-12-27', 'AC', 'Week', '2024-12-20'),
(15, 'Today', '2024-12-28', 'Light', 'A Day', '2024-12-28'),
(16, 'no', '2024-12-22', 'Light', 'A Day', '2024-12-22'),
(17, 'tes lamp 28 des', '2024-12-28', 'Light', 'A Day', '2024-12-28'),
(19, '28 des', '2024-12-28', 'AC', 'A Day', '2024-12-28'),
(20, '28/12/2024 Laporan Hari Ini', '2024-12-28', 'AC', 'A Day', '2024-12-28'),
(21, 'A day', '2024-12-28', 'Light', 'A Day', '2024-11-28'),
(22, 'Laporan Semua Appliance 28 Des 24', '2024-12-28', 'All', 'A Day', '2024-11-28'),
(23, 'Laporan semua Minngu', '2024-12-28', 'All', 'Week', '2024-12-21'),
(24, '02 January 2025 all app recap', '2025-01-02', 'All', 'A Day', '2024-12-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` int(11) NOT NULL,
  `name_appliance` varchar(255) NOT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `repeat_schedule` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_appliances` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 2, 9676, 5829, '2024-11-05 10:17:32', '2024-11-16 03:45:46'),
(3, 1, 7674, 1417, '2024-12-12 06:15:22', '2024-11-20 20:08:00'),
(4, 1, 1779, 16501, '2024-12-06 19:52:12', '2024-12-11 11:38:53'),
(6, 2, 3778, 75690, '2024-12-10 11:53:41', '2024-11-23 08:06:09'),
(7, 3, 866, 2103, '2024-11-21 16:24:43', '2024-12-19 09:48:54'),
(8, 3, 9876, 30710, '2024-12-24 14:51:20', '2024-11-21 07:30:43'),
(10, 2, 5566, 26879, '2024-12-07 05:18:43', '2024-12-27 05:32:41'),
(11, 2, 7089, 80900, '2024-11-07 07:53:56', '2024-12-12 22:30:12'),
(13, 2, 6763, 10098, '2024-11-07 07:31:59', '2024-11-20 09:45:41'),
(14, 1, 1406, 67732, '2024-12-22 12:23:12', '2024-12-13 16:19:34'),
(15, 3, 3046, 84163, '2024-11-22 08:36:28', '2024-12-05 08:25:49'),
(16, 2, 9546, 4039, '2024-11-20 15:21:34', '2024-11-11 12:21:17'),
(17, 3, 7075, 73267, '2024-12-18 09:22:50', '2024-12-04 12:05:27'),
(19, 3, 5799, 60907, '2024-12-11 01:42:31', '2024-11-17 17:58:35'),
(24, 2, 6330, 78416, '2024-12-21 10:56:17', '2024-12-11 13:35:08'),
(25, 2, 3719, 29541, '2024-11-08 15:03:39', '2024-11-18 11:24:49'),
(26, 3, 9415, 55818, '2024-12-07 00:17:24', '2024-12-10 02:31:02'),
(28, 1, 5139, 27927, '2024-12-15 01:18:59', '2024-12-02 11:53:37'),
(29, 3, 4943, 11205, '2024-11-25 07:02:12', '2024-12-28 12:39:47'),
(30, 3, 5127, 42683, '2024-12-03 07:22:38', '2024-11-25 17:22:38'),
(31, 2, 3060, 24584, '2024-11-09 06:55:13', '2024-12-07 13:00:32'),
(32, 2, 3307, 63783, '2024-11-25 00:45:13', '2024-11-22 08:18:28'),
(33, 2, 5677, 56391, '2024-12-23 18:28:59', '2024-11-01 23:21:11'),
(34, 1, 6624, 46758, '2024-11-21 11:32:40', '2024-11-10 13:27:08'),
(36, 2, 3651, 34707, '2024-11-02 11:03:12', '2024-11-27 11:17:52'),
(37, 3, 9892, 7013, '2024-11-08 17:46:59', '2024-12-27 08:10:17'),
(38, 1, 8623, 62423, '2024-11-23 07:24:58', '2024-11-03 07:42:56'),
(39, 2, 9346, 47266, '2024-11-04 03:32:03', '2024-12-04 21:38:02'),
(40, 2, 1775, 17408, '2024-11-08 07:08:40', '2024-11-20 10:47:39'),
(41, 1, 7540, 10646, '2024-11-18 02:37:19', '2024-12-21 08:08:14'),
(42, 2, 7949, 13372, '2024-12-02 21:46:38', '2024-11-21 07:09:37'),
(44, 2, 5916, 74484, '2024-11-12 11:58:21', '2024-11-30 19:47:13'),
(47, 1, 723, 75360, '2024-12-26 19:56:12', '2024-11-18 12:35:13'),
(49, 1, 7767, 10323, '2024-12-01 04:43:27', '2024-11-15 06:30:14'),
(51, 1, 26, 201, '2024-12-28 14:30:54', '2024-12-28 16:50:01'),
(52, 2, 6, 748, '2024-12-28 14:30:54', '2024-12-28 16:50:01'),
(53, 3, 260, 1660, '2024-12-28 14:30:54', '2024-12-28 16:50:01'),
(56, 1, 0, 0, '2024-12-28 17:00:01', '2024-12-28 17:50:00'),
(57, 2, 0, 0, '2024-12-28 17:00:01', '2024-12-28 17:50:00'),
(58, 3, 0, 0, '2024-12-28 17:00:01', '2024-12-28 17:50:00'),
(61, 1, 0, 0, '2024-12-30 07:50:01', '2024-12-30 10:00:00'),
(72, 2, 61, 685, '2025-01-02 08:20:01', '2025-01-02 10:30:00'),
(76, 1, 116, 915, '2025-01-03 03:50:01', '2025-01-03 04:50:00'),
(77, 2, 5, 560, '2025-01-03 03:50:01', '2025-01-03 04:50:00'),
(78, 3, 143, 915, '2025-01-03 03:50:01', '2025-01-03 04:50:00'),
(81, 3, 392, 83820, '2025-01-02 14:55:59', '2025-01-02 05:09:29'),
(85, 1, 154, 6834, '2025-01-01 09:28:25', '2025-01-02 09:37:47'),
(87, 1, 36, 81921, '2024-12-31 16:51:46', '2025-01-02 10:17:54'),
(93, 2, 762, 39052, '2024-12-31 12:54:21', '2024-12-31 21:47:56'),
(101, 3, 345, 24549, '2025-01-01 03:41:59', '2024-12-30 14:46:27'),
(116, 2, 77, 86364, '2024-12-30 10:31:13', '2025-01-01 18:33:25'),
(123, 3, 85, 66460, '2024-12-30 15:21:27', '2025-01-02 11:10:58'),
(125, 1, 79, 66085, '2025-01-02 15:01:26', '2024-12-31 17:07:27'),
(127, 3, 658, 63694, '2024-12-31 08:58:15', '2024-12-30 19:33:56'),
(128, 2, 330, 29316, '2024-12-31 17:28:45', '2025-01-01 00:41:46');

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
(2, 'admin', 'admin2_03012025.jpg', 'admin@gmail.com', NULL, '$2y$10$M1MuYXw9WcUt7uMyIjPNVORcIDNkQRCYngv/4jcAh6N7aR7OK7w2u', NULL, NULL, '2025-01-03 03:53:16');

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
  MODIFY `id_appliances` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `summary`
--
ALTER TABLE `summary`
  MODIFY `id_summary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

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
