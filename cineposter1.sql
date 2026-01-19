-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2026 at 09:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cineposter1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id_genre` bigint UNSIGNED NOT NULL,
  `nama_genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_14_164022_create_movies_table', 1),
(5, '2026_01_14_164606_create_genres_table', 1),
(6, '2026_01_14_164658_create_reviews_table', 1),
(7, '2026_01_14_164853_create_movie_genre_table', 1),
(8, '2026_01_19_015316_rename_lokasi_in_movies_table', 2),
(9, '2026_01_19_072220_add_link_nonton_and_platform_to_movies_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id_film` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_rilis` int NOT NULL,
  `sinopsis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sutradara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `durasi_menit` int NOT NULL,
  `poster_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailer_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_nonton` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_bioskop` text COLLATE utf8mb4_unicode_ci,
  `rating_rata_rata` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id_film`, `judul`, `tahun_rilis`, `sinopsis`, `sutradara`, `durasi_menit`, `poster_url`, `trailer_url`, `link_nonton`, `platform`, `lokasi_bioskop`, `rating_rata_rata`, `created_at`, `updated_at`) VALUES
(8, 'The Fast and the Furious', 2001, 'Brian O’Conner adalah seorang polisi yang menyamar dan masuk ke dunia balap liar Los Angeles untuk menyelidiki kasus pembajakan truk. Ia mendekati Dominic Toretto, pemimpin kelompok pembalap yang dicurigai. Seiring waktu, Brian mulai terikat persahabatan dan jatuh cinta pada Mia, adik Dom, sehingga ia harus memilih antara tugas sebagai polisi atau loyalitas pada keluarga baru yang ia temukan.', 'Rob Cohen', 106, 'posters/1768804675_the_fast_and_the_furious.jpg', 'trailers/1768804675_the_fast_and_the_furious.mp4', NULL, NULL, '', 0, '2026-01-18 23:37:55', '2026-01-18 23:37:55'),
(9, '2 Fast 2 Furious', 2003, 'Brian O’Conner, mantan polisi yang kini hidup sebagai pembalap jalanan di Miami, dipaksa kembali bekerja sama dengan pihak berwajib untuk membersihkan namanya. Ia ditugaskan menyusup ke jaringan kriminal milik pengusaha kaya Carter Verone. Untuk menjalankan misi berbahaya ini, Brian menggandeng sahabat lamanya, Roman Pearce, serta bekerja sama dengan agen rahasia Monica Fuentes. Aksi balap liar, kejar-kejaran mobil, dan ketegangan khas Fast & Furious menjadi pusat cerita film ini.', 'John Singleton', 107, 'posters/1768806278_2_fast_2_furious.jpg', 'trailers/1768806278_2_fast_2_furious.mp4', 'https://d21.team/2-fast-2-furious-2003', 'LK21', '', 0, '2026-01-19 00:04:38', '2026-01-19 00:24:11'),
(10, 'Fast & Furious', 2009, 'Dominic Toretto dan Brian O’Conner kembali bekerja sama untuk mengungkap jaringan narkoba berbahaya yang dipimpin Arturo Braga. Kematian Letty membuat Dom haus akan balas dendam, sementara Brian berjuang antara tugas dan kesetiaan.', 'Justin Lin', 107, 'posters/1768813315_fast_&_furious.jpg', 'trailers/1768813315_fast_&_furious.mp4', NULL, 'LK21', '', 0, '2026-01-19 02:01:55', '2026-01-19 02:01:55'),
(11, 'Fast Five', 2011, 'Dom dan Brian menjadi buronan dan melarikan diri ke Rio de Janeiro. Mereka mengumpulkan tim untuk melakukan perampokan terbesar dalam hidup mereka, mencuri 100 juta dolar milik gembong kriminal Hernan Reyes, sambil diburu agen DSS Luke Hobbs.', 'Justin Lin', 130, 'posters/1768813392_fast_five.jpg', 'trailers/1768813392_fast_five.mp4', NULL, 'LK21', '', 0, '2026-01-19 02:03:12', '2026-01-19 02:03:12'),
(12, 'tes', 2026, 'stessss', 'Justin Lin', 120, 'posters/1768814044_tes.jpg', 'trailers/1768814044_tes.mp4', 'https://d21.team/2-fast-2-furious-2003', 'LK21', '', 0, '2026-01-19 02:14:04', '2026-01-19 02:14:04');

-- --------------------------------------------------------

--
-- Table structure for table `movie_genre`
--

CREATE TABLE `movie_genre` (
  `id` bigint UNSIGNED NOT NULL,
  `id_film` bigint UNSIGNED NOT NULL,
  `id_genre` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id_ulasan` bigint UNSIGNED NOT NULL,
  `id_pengguna` bigint UNSIGNED NOT NULL,
  `id_film` bigint UNSIGNED NOT NULL,
  `rating_numerik` double NOT NULL,
  `teks_ulasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_ulasan` datetime NOT NULL,
  `is_spoiler` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('InZANKBL9pgt5cvAwFjdPU8bNewZdqNNvCysXjrN', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZVRKQm1mcDNKU0VWaVZPNzJJRUkyc1BIN2ZoSzB5M2duMEdjSkFLQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tb3ZpZS85IjtzOjU6InJvdXRlIjtzOjEwOiJtb3ZpZS5zaG93Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3Njg4MDUzMjU7fX0=', 1768814902),
('yABevcuugSjKjPLfvyC10tw8JufBAan6TYqoEz9G', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidExGMjFqUWpBZm5tWHAxM0tENjI0cmE5djl4cTR4T0o3VEJYa1d1byI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9tb3ZpZXMiO3M6NToicm91dGUiO3M6MTI6ImFkbWluLm1vdmllcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzY4ODA1NzY3O319', 1768814867);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_pengguna` bigint UNSIGNED NOT NULL,
  `nama_depan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `tanggal_daftar` timestamp NULL DEFAULT NULL,
  `bio_profil` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_pengguna`, `nama_depan`, `email`, `password`, `role`, `tanggal_daftar`, `bio_profil`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Cineposter', 'admin@gmail.com', '$2y$12$4ToC7kpdTsg3PvRerYPXbeAH4Ck8nSaSrjzzgyOYDixmDV5JmD4QC', 'admin', '2026-01-18 06:09:22', NULL, 'dZ297tB9fpAGVijmhQi3wFKnDQZ6cZOPBZWkw45DuRtmGVAlxJx9EdsaQhTh', '2026-01-18 06:09:22', '2026-01-18 06:09:22'),
(2, 'cecil', 'cecil@gmail.com', '$2y$12$p32syCQA56jPM6dlVzSqT.54GSfDu3Y3qzkzF3eGhdzb66/wM8t0C', 'user', '2026-01-18 11:19:22', NULL, 'ktCqTFZyOUlsAnQx2dCgjCeT6KDILdjgZu7kgoxOFzcHZzzqUmKT5qtqFDO2', '2026-01-18 11:19:22', '2026-01-18 11:19:22'),
(3, 'leona', 'leona@gmail.com', '$2y$12$cH52injOhwEAm7ssnHufAuxzE/jzJveptjoyOI6cInbISkDz8q4ky', 'user', '2026-01-18 18:11:44', NULL, NULL, '2026-01-18 18:11:44', '2026-01-18 18:11:44'),
(4, 'thanisa', 'thanisa@gmail.com', '$2y$12$gImO/Ok4wZPf9HlJaB4NiOveR3GFxYYU0M4VGmgef5dYn807g0Kwe', 'user', '2026-01-18 20:14:18', NULL, NULL, '2026-01-18 20:14:18', '2026-01-18 20:14:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_film`);

--
-- Indexes for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_genre_id_film_foreign` (`id_film`),
  ADD KEY `movie_genre_id_genre_foreign` (`id_genre`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `reviews_id_pengguna_foreign` (`id_pengguna`),
  ADD KEY `reviews_id_film_foreign` (`id_film`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id_genre` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_film` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `movie_genre`
--
ALTER TABLE `movie_genre`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_ulasan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_pengguna` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `movie_genre_id_film_foreign` FOREIGN KEY (`id_film`) REFERENCES `movies` (`id_film`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_genre_id_genre_foreign` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id_genre`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_id_film_foreign` FOREIGN KEY (`id_film`) REFERENCES `movies` (`id_film`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id_pengguna`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
