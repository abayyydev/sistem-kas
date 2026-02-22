-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2026 at 01:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pettycash`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `action` varchar(50) NOT NULL,
  `details` text,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES
(1, 1, 'LOGIN', 'User berhasil login', '::1', '2025-11-30 11:23:24'),
(2, 1, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Operasional - Konsumsi)', '::1', '2025-11-30 11:34:10'),
(3, 4, 'LOGIN', 'User berhasil login', '::1', '2025-11-30 11:36:29'),
(4, 5, 'LOGIN', 'User berhasil login', '::1', '2025-11-30 11:38:51'),
(5, 1, 'LOGIN', 'User berhasil login', '::1', '2025-11-30 11:39:55'),
(6, 1, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 200,000 (Operasional - Konsumsi)', '::1', '2025-11-30 11:43:42'),
(7, 1, 'LOGIN', 'User berhasil login', '::1', '2025-11-30 11:57:37'),
(8, 2, 'LOGIN', 'User berhasil login', '::1', '2026-01-19 12:34:56'),
(9, 1, 'LOGIN', 'User berhasil login', '::1', '2026-01-19 12:36:25'),
(10, 2, 'LOGIN', 'User berhasil login', '::1', '2026-01-19 12:41:51'),
(11, 1, 'LOGIN', 'User berhasil login', '::1', '2026-01-19 12:42:04'),
(12, 1, 'LOGIN', 'User berhasil login', '::1', '2026-02-02 15:02:53'),
(13, 1, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 12,000,000 (Konsumsi)', '::1', '2026-02-02 15:14:18'),
(14, 1, 'VERIFY_DATA', 'Audit Transaksi ID #3 menjadi verified. Alasan: 1', '::1', '2026-02-02 15:14:39'),
(15, 4, 'LOGIN', 'User berhasil login', '::1', '2026-02-03 04:23:50'),
(16, 4, 'LOGIN', 'User berhasil login', '::1', '2026-02-03 04:26:40'),
(17, 5, 'LOGIN', 'User berhasil login', '::1', '2026-02-03 04:27:06'),
(18, 2, 'LOGIN', 'User berhasil login', '::1', '2026-02-03 04:27:30'),
(19, 1, 'LOGIN', 'User berhasil login', '::1', '2026-02-03 04:27:47'),
(20, 4, 'LOGIN', 'User berhasil login', '::1', '2026-02-03 04:34:52'),
(21, 2, 'LOGIN', 'User berhasil login', '::1', '2026-02-03 04:35:13'),
(22, 2, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 2,000,000 (Peralatan Kantor)', '::1', '2026-02-03 04:35:40'),
(23, 4, 'LOGIN', 'User berhasil login', '::1', '2026-02-03 04:35:52'),
(24, 4, 'VERIFY_DATA', 'Audit Transaksi ID #4 menjadi verified. Alasan: 1', '::1', '2026-02-03 04:36:06'),
(25, 4, 'VERIFY_DATA', 'Audit Transaksi ID #1 menjadi verified. Alasan: 1', '::1', '2026-02-03 04:36:10'),
(26, 4, 'VERIFY_DATA', 'Audit Transaksi ID #2 menjadi verified. Alasan: 1', '::1', '2026-02-03 04:36:13'),
(27, 1, 'LOGIN', 'User berhasil login', '::1', '2026-02-03 04:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`) VALUES
(1, 'Jakarta'),
(2, 'Bandung'),
(3, 'Surabaya'),
(4, 'Pusat'),
(6, 'Bogor');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `group_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_zakat` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `group_id`, `name`, `is_zakat`) VALUES
(1, 1, 'Listrik & Air', 0),
(2, 1, 'Konsumsi', 0),
(3, 3, 'Peralatan Kantor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_groups`
--

CREATE TABLE `category_groups` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category_groups`
--

INSERT INTO `category_groups` (`id`, `name`) VALUES
(1, 'Operasional Rutin'),
(2, 'Perjalanan Dinas'),
(3, 'Aset & Inventaris'),
(4, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `branch` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `type` enum('in','out') NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `is_zakat` tinyint(1) DEFAULT '0',
  `proof_file` varchar(255) DEFAULT NULL,
  `status` enum('pending','verified','rejected') DEFAULT 'pending',
  `verified_by` int DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `branch`, `date`, `type`, `category`, `description`, `amount`, `is_zakat`, `proof_file`, `status`, `verified_by`, `verified_at`, `created_at`) VALUES
(1, 1, 'Pusat', '2025-11-30', 'out', 'Operasional - Konsumsi', 'pem', 200000.00, 1, 'proof_1_1764502450.png', 'verified', 4, '2026-02-03 11:36:10', '2025-11-30 11:34:10'),
(2, 1, 'Pusat', '2025-11-30', 'in', 'Operasional - Konsumsi', 'dd', 200000.00, 1, 'proof_1_1764503022.jpeg', 'verified', 4, '2026-02-03 11:36:13', '2025-11-30 11:43:42'),
(3, 1, 'Pusat', '2026-02-02', 'out', 'Konsumsi', 'hallo', 12000000.00, 0, 'proof_1_1770045258.jpeg', 'verified', 1, '2026-02-02 22:14:39', '2026-02-02 15:14:18'),
(4, 2, 'Jakarta', '2026-02-03', 'out', 'Peralatan Kantor', 'Pembelian Kursi Kantor', 2000000.00, 1, 'proof_2_1770093340.png', 'verified', 4, '2026-02-03 11:36:06', '2026-02-03 04:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('admin','pj_gudang','tup','pimpinan') NOT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `role`, `branch`, `created_at`) VALUES
(1, 'admin', '$2y$10$PgWqfuuuehj2qvBK8.XwPOSFYqH3G7O2i7V5PLkko8TCvc/Lxol4e', 'Administrator IT', 'admin', 'Pusat', '2025-11-30 11:12:02'),
(2, 'pj_jkt', '$2y$10$PgWqfuuuehj2qvBK8.XwPOSFYqH3G7O2i7V5PLkko8TCvc/Lxol4e', 'Budi Santoso', 'pj_gudang', 'Jakarta', '2025-11-30 11:12:02'),
(3, 'pj_bdg', '$2y$10$PgWqfuuuehj2qvBK8.XwPOSFYqH3G7O2i7V5PLkko8TCvc/Lxol4e', 'Asep Surasep', 'pj_gudang', 'Bandung', '2025-11-30 11:12:02'),
(4, 'tup_audit', '$2y$10$PgWqfuuuehj2qvBK8.XwPOSFYqH3G7O2i7V5PLkko8TCvc/Lxol4e', 'Sari Mawar', 'tup', 'Pusat', '2025-11-30 11:12:02'),
(5, 'pimpinan', '$2y$10$PgWqfuuuehj2qvBK8.XwPOSFYqH3G7O2i7V5PLkko8TCvc/Lxol4e', 'Bapak Direktur', 'pimpinan', 'Pusat', '2025-11-30 11:12:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_groups`
--
ALTER TABLE `category_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `verified_by` (`verified_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_groups`
--
ALTER TABLE `category_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
