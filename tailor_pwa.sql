-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 03:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tailor_pwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `estimasi`
--

CREATE TABLE `estimasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipe_estimasi` enum('1','2') NOT NULL,
  `kain_id` bigint(20) UNSIGNED NOT NULL,
  `kemeja_id` bigint(20) UNSIGNED NOT NULL,
  `ukuran_id` bigint(20) UNSIGNED NOT NULL,
  `lengan_id` bigint(20) UNSIGNED NOT NULL,
  `total_meter_kain` varchar(255) NOT NULL,
  `total_biaya` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('diterima','ditolak','diproses') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estimasi`
--

INSERT INTO `estimasi` (`id`, `tipe_estimasi`, `kain_id`, `kemeja_id`, `ukuran_id`, `lengan_id`, `total_meter_kain`, `total_biaya`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(17, '1', 3, 1, 2, 1, '3', '135000', 2, 'diterima', '2023-12-26 01:42:13', '2023-12-27 02:47:34'),
(18, '1', 3, 1, 4, 1, '4', '165000', 2, 'ditolak', '2023-12-26 18:32:58', '2023-12-27 03:01:38'),
(19, '2', 1, 2, 2, 1, '3', '65000', 4, 'ditolak', '2023-12-26 18:46:23', '2023-12-27 03:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `kain`
--

CREATE TABLE `kain` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga_per_meter` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kain`
--

INSERT INTO `kain` (`id`, `nama`, `harga_per_meter`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Katun', '50000', 'Kain katun adalah salah satu bahan yang paling umum digunakan untuk kemeja. Ini ringan, nyaman, dan tersedia dalam berbagai pola dan gaya.', '2023-12-10 19:10:02', '2023-12-10 19:10:02'),
(2, 'Linen', '35000', 'Kain linen sering digunakan untuk kemeja musim panas karena sifatnya yang ringan dan menyerap keringat dengan baik.', '2023-12-10 19:10:26', '2023-12-10 19:10:26'),
(3, 'Flanel', '25000', 'Flanel adalah kain yang sering kali digunakan untuk kemeja kasual karena sifatnya yang hangat dan nyaman.', '2023-12-10 19:11:05', '2023-12-10 19:11:05'),
(4, 'Denim', '55000', 'Kain denim sering kali digunakan untuk kemeja kasual dan memiliki daya tahan yang baik.', '2023-12-10 19:11:23', '2023-12-10 19:11:23'),
(5, 'Oxford Cloth', '75000', 'Kain Oxford sering kali digunakan untuk kemeja formal karena teksturnya yang tahan lama dan cukup tebal.', '2023-12-10 19:11:44', '2023-12-10 19:11:44'),
(6, 'Satin', '30000', 'Kain satin umumnya digunakan untuk kemeja formal karena kilauannya yang elegan dan teksturnya yang halus.', '2023-12-10 19:12:06', '2023-12-10 19:12:06'),
(7, 'Sutra', '80000', 'Kain sutra sering kali digunakan untuk kemeja formal karena kemewahan dan kilau alaminya.', '2023-12-10 19:12:34', '2023-12-10 19:12:34'),
(8, 'Poliester', '75000', 'Kain poliester sering kali digunakan untuk kemeja karena sifatnya yang tahan lama dan tidak kusut.', '2023-12-10 19:13:10', '2023-12-10 19:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `kemeja`
--

CREATE TABLE `kemeja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `biaya` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kemeja`
--

INSERT INTO `kemeja` (`id`, `nama`, `jenis`, `biaya`, `created_at`, `updated_at`) VALUES
(1, 'Kemeja Berkerah', 'Kemeja Berkerah', '35000', '2023-12-10 17:50:51', '2023-12-25 00:29:48'),
(2, 'Kemeja Polo', 'Kemeja Polo', '40000', '2023-12-10 18:15:19', '2023-12-25 00:29:55'),
(4, 'Kemeja Flanel', 'Kemeja Flanel', '45000', '2023-12-10 18:18:29', '2023-12-25 00:30:06'),
(5, 'Kemeja Denim', 'Kemeja Denim', '50000', '2023-12-10 19:05:25', '2023-12-25 00:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `lengan`
--

CREATE TABLE `lengan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `meter_kain` varchar(255) NOT NULL,
  `biaya` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lengan`
--

INSERT INTO `lengan` (`id`, `nama`, `meter_kain`, `biaya`, `created_at`, `updated_at`) VALUES
(1, 'Panjang', '0.5', '10000', '2023-12-10 19:42:07', '2023-12-10 19:42:07'),
(2, 'Pendek', '0.3', '5000', '2023-12-10 19:42:22', '2023-12-12 18:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2023_12_05_135104_create_kemeja_table', 1),
(4, '2023_12_05_135321_create_kain_table', 1),
(5, '2023_12_05_135410_create_ukuran_table', 1),
(6, '2023_12_05_135445_create_lengan_table', 1),
(7, '2023_12_05_135534_create_portpolio_table', 1),
(8, '2023_12_05_143543_create_estimasi_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portpolio`
--

CREATE TABLE `portpolio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `bahan` varchar(255) NOT NULL,
  `lengan` varchar(255) NOT NULL,
  `biaya` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portpolio`
--

INSERT INTO `portpolio` (`id`, `nama`, `jenis`, `bahan`, `lengan`, `biaya`, `foto`, `created_at`, `updated_at`) VALUES
(12, 'Kemeja Satu', 'Kemeja Berkerah', 'Poliester', 'Panjang', '350000', '1702453837_Buku.jpg', '2023-12-12 23:50:37', '2023-12-25 21:23:57'),
(13, 'Kemeja Dua', 'Kemeja Berkerah', 'Oxford Cloth', 'Pendek', '100000', '1702454042_Kemeja Dua.jpg', '2023-12-12 23:54:02', '2023-12-25 21:24:55'),
(15, 'Kemeja Empat', 'Kemeja Flanel', 'Flanel', 'Panjang', '100000', '1702964046_Kemeja Empat.jpg', '2023-12-18 21:34:06', '2023-12-18 21:34:06'),
(16, 'Kemeja Lima', 'Kemeja Flanel', 'Flanel', 'Pendek', '80000', '1702973263_Kemeja Lima.jpg', '2023-12-19 00:07:43', '2023-12-19 00:07:43'),
(17, 'Style Bagus', 'Kemeja Satu', 'Denim', 'Pendek', '400000', '1702983558_Style Bagus.jpg', '2023-12-19 02:59:18', '2023-12-19 02:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran`
--

CREATE TABLE `ukuran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `meter_kain` varchar(255) NOT NULL,
  `biaya` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ukuran`
--

INSERT INTO `ukuran` (`id`, `nama`, `meter_kain`, `biaya`, `created_at`, `updated_at`) VALUES
(1, 'S', '2', '10000', '2023-12-10 19:31:36', '2023-12-10 19:31:36'),
(2, 'M', '2.5', '15000', '2023-12-10 19:31:54', '2023-12-10 19:31:54'),
(3, 'L', '3', '15000', '2023-12-10 19:32:07', '2023-12-10 19:32:07'),
(4, 'XL', '3.5', '20000', '2023-12-10 19:32:26', '2023-12-10 19:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Risky Admin', 'admin@mail.com', NULL, 'admin', '$2y$10$fwyd9fYs0j7ak3F1dvN7De6ryAlqslq0X.Sv8Aey.2aoD2AlWf1pC', 'admin', NULL, '2023-12-07 15:39:10', '2023-12-07 15:39:10'),
(2, 'Yuda', 'yuda@mail.com', NULL, 'yuda', '$2y$10$Sc8TP/jTwURHchPhVifWKOM3oc.5u8TaFdyyWBnWbU8veMGkSM6Tu', 'user', NULL, '2023-12-18 23:31:35', '2023-12-18 23:31:35'),
(3, 'Liza', 'liza@mail.com', NULL, 'liza', '$2y$10$kTZQpb333JwliNN09YY78OLCiy4DVvr3lUQ6srQ7bdkyx3KKTwSHW', 'user', NULL, '2023-12-19 04:40:27', '2023-12-19 04:40:27'),
(4, 'Bayu', 'bayu@mail.com', NULL, 'bayu', '$2y$10$ip/DcWD.CvXNn5z/pCwvieO53fV9KIAmct1xmsTblC/rMZ5vUBwXy', 'user', NULL, '2023-12-26 18:45:07', '2023-12-26 18:45:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estimasi`
--
ALTER TABLE `estimasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estimasi_kain_id_foreign` (`kain_id`),
  ADD KEY `estimasi_kemeja_id_foreign` (`kemeja_id`),
  ADD KEY `estimasi_ukuran_id_foreign` (`ukuran_id`),
  ADD KEY `estimasi_lengan_id_foreign` (`lengan_id`),
  ADD KEY `estimasi_user_id_foreign` (`user_id`);

--
-- Indexes for table `kain`
--
ALTER TABLE `kain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kemeja`
--
ALTER TABLE `kemeja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lengan`
--
ALTER TABLE `lengan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `portpolio`
--
ALTER TABLE `portpolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estimasi`
--
ALTER TABLE `estimasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kain`
--
ALTER TABLE `kain`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kemeja`
--
ALTER TABLE `kemeja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lengan`
--
ALTER TABLE `lengan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `portpolio`
--
ALTER TABLE `portpolio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estimasi`
--
ALTER TABLE `estimasi`
  ADD CONSTRAINT `estimasi_kain_id_foreign` FOREIGN KEY (`kain_id`) REFERENCES `kain` (`id`),
  ADD CONSTRAINT `estimasi_kemeja_id_foreign` FOREIGN KEY (`kemeja_id`) REFERENCES `kemeja` (`id`),
  ADD CONSTRAINT `estimasi_lengan_id_foreign` FOREIGN KEY (`lengan_id`) REFERENCES `lengan` (`id`),
  ADD CONSTRAINT `estimasi_ukuran_id_foreign` FOREIGN KEY (`ukuran_id`) REFERENCES `ukuran` (`id`),
  ADD CONSTRAINT `estimasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
