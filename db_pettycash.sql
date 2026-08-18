-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 18, 2026 at 04:19 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.30

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
  `action` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(27, 1, 'LOGIN', 'User berhasil login', '::1', '2026-02-03 04:36:27'),
(28, 1, 'LOGIN', 'User berhasil login', '114.10.77.236', '2026-04-14 13:38:19'),
(29, 1, 'LOGIN', 'User berhasil login', '103.171.161.132', '2026-04-15 14:08:42'),
(30, 13, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-15 14:26:48'),
(31, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '180.244.0.245', '2026-04-15 14:27:41'),
(32, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 600,000 (Konsumsi)', '180.244.0.245', '2026-04-15 14:28:25'),
(33, 18, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-15 14:28:41'),
(34, 1, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-15 14:28:58'),
(35, 1, 'VERIFY_DATA', 'Audit Transaksi ID #5 menjadi verified. Alasan: 1', '180.244.0.245', '2026-04-15 14:29:13'),
(36, 1, 'VERIFY_DATA', 'Audit Transaksi ID #6 menjadi verified. Alasan: 1', '180.244.0.245', '2026-04-15 14:29:19'),
(37, 13, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-15 14:29:34'),
(38, 18, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-15 14:30:27'),
(39, 1, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-15 14:31:11'),
(40, 18, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-15 14:31:31'),
(41, 1, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-15 14:32:11'),
(42, 19, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-15 14:32:41'),
(43, 1, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-15 14:33:28'),
(44, 1, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-16 02:35:09'),
(45, 13, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-16 02:36:26'),
(46, 19, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-16 02:38:03'),
(47, 1, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-16 02:40:41'),
(48, 1, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-16 02:41:07'),
(49, 20, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-16 02:45:14'),
(50, 1, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-16 04:56:59'),
(51, 13, 'LOGIN', 'User berhasil login', '103.171.161.132', '2026-04-16 04:58:33'),
(52, 1, 'LOGIN', 'User berhasil login', '103.28.116.239', '2026-04-16 06:37:24'),
(53, 1, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 10,000 (Pemasangan)', '103.28.116.239', '2026-04-16 06:38:32'),
(54, 1, 'REJECT_DATA', 'Audit Transaksi ID #7 menjadi rejected. Alasan: Gagal', '103.28.116.239', '2026-04-16 06:39:03'),
(55, 13, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-16 12:44:53'),
(56, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 20,000 (Listrik & Air)', '180.244.0.245', '2026-04-16 12:45:45'),
(57, 1, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-16 12:46:10'),
(58, 1, 'REJECT_DATA', 'Audit Transaksi ID #8 menjadi rejected. Alasan: akjkd', '180.249.217.36', '2026-04-16 12:46:25'),
(59, 1, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-16 13:18:09'),
(60, 16, 'LOGIN', 'User berhasil login', '111.94.164.246', '2026-04-16 13:51:23'),
(61, 16, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-16 13:51:53'),
(62, 16, 'LOGIN', 'User berhasil login', '111.94.164.246', '2026-04-16 13:56:36'),
(63, 16, 'LOGIN', 'User berhasil login', '114.8.225.139', '2026-04-16 13:56:53'),
(64, 16, 'LOGIN', 'User berhasil login', '111.94.164.246', '2026-04-16 13:57:57'),
(65, 1, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-16 14:09:35'),
(66, 16, 'LOGIN', 'User berhasil login', '117.20.60.35', '2026-04-16 14:12:17'),
(67, 16, 'LOGIN', 'User berhasil login', '117.20.60.35', '2026-04-16 14:19:47'),
(68, 15, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-17 03:32:37'),
(69, 12, 'LOGIN', 'User berhasil login', '180.244.0.245', '2026-04-17 03:35:03'),
(70, 1, 'LOGIN', 'User berhasil login', '103.51.103.192', '2026-04-17 04:06:36'),
(71, 12, 'LOGIN', 'User berhasil login', '103.51.103.192', '2026-04-17 04:14:29'),
(72, 9, 'LOGIN', 'User berhasil login', '180.249.217.36', '2026-04-17 06:25:17'),
(73, 1, 'LOGIN', 'User berhasil login', '103.51.103.192', '2026-04-17 07:51:28'),
(74, 1, 'LOGIN', 'User berhasil login', '103.51.103.192', '2026-04-17 07:51:41'),
(75, 1, 'LOGIN', 'User berhasil login', '180.245.57.201', '2026-04-17 10:23:37'),
(76, 1, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 210,000 (Internet)', '180.245.57.201', '2026-04-17 10:24:35'),
(77, 16, 'LOGIN', 'User berhasil login', '114.10.79.80', '2026-04-17 12:39:27'),
(78, 1, 'LOGIN', 'User berhasil login', '114.10.79.80', '2026-04-17 12:40:07'),
(79, 1, 'LOGIN', 'User berhasil login', '114.10.78.242', '2026-04-18 14:26:02'),
(80, 16, 'LOGIN', 'User berhasil login', '180.245.57.201', '2026-04-18 14:31:00'),
(81, 16, 'LOGIN', 'User berhasil login', '140.213.251.145', '2026-04-18 14:39:32'),
(82, 16, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 50,000 (Service Motor)', '140.213.251.145', '2026-04-18 14:40:35'),
(83, 16, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,000,000 (Ongkir Pemasangan)', '180.245.57.201', '2026-04-18 14:43:28'),
(84, 1, 'LOGIN', 'User berhasil login', '180.249.216.56', '2026-04-18 14:46:39'),
(85, 16, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 500,000 (Konsumsi)', '180.245.57.201', '2026-04-18 14:49:18'),
(86, 16, 'LOGIN', 'User berhasil login', '114.10.79.164', '2026-04-18 15:25:49'),
(87, 16, 'LOGIN', 'User berhasil login', '114.10.77.155', '2026-04-18 22:43:47'),
(88, 16, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 5,000,000 (Penambahan Saldo)', '114.10.78.155', '2026-04-18 22:46:18'),
(89, 1, 'LOGIN', 'User berhasil login', '125.166.101.161', '2026-05-03 13:44:26'),
(90, 21, 'LOGIN', 'User berhasil login', '125.166.101.161', '2026-05-03 13:45:27'),
(91, 22, 'LOGIN', 'User berhasil login', '125.166.101.161', '2026-05-03 13:47:00'),
(92, 22, 'REJECT_DATA', 'Audit Transaksi ID #9 menjadi rejected. Alasan: ---', '125.166.101.161', '2026-05-03 13:47:29'),
(93, 22, 'REJECT_DATA', 'Audit Transaksi ID #10 menjadi rejected. Alasan: smdf', '125.166.101.161', '2026-05-03 13:47:34'),
(94, 13, 'LOGIN', 'User berhasil login', '125.166.101.161', '2026-05-03 13:47:49'),
(95, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '125.166.101.161', '2026-05-03 13:49:00'),
(96, 1, 'LOGIN', 'User berhasil login', '125.166.101.161', '2026-05-03 13:49:25'),
(97, 23, 'LOGIN', 'User berhasil login', '125.166.101.161', '2026-05-03 13:50:53'),
(98, 22, 'LOGIN', 'User berhasil login', '125.166.101.161', '2026-05-03 13:51:23'),
(99, 22, 'VERIFY_DATA', 'Audit Transaksi ID #14 menjadi verified. Alasan: 1', '125.166.101.161', '2026-05-03 13:51:34'),
(100, 1, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-09 06:43:15'),
(101, 1, 'REJECT_DATA', 'Audit Transaksi ID #13 menjadi rejected. Alasan: fdetr', '180.244.0.8', '2026-05-09 06:44:08'),
(102, 8, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 06:45:01'),
(103, 8, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '180.244.0.240', '2026-05-11 06:47:16'),
(104, 1, 'LOGIN', 'User berhasil login', '180.244.0.240', '2026-05-11 06:47:49'),
(105, 1, 'VERIFY_DATA', 'Audit Transaksi ID #15 menjadi verified. Alasan: 1', '103.171.161.132', '2026-05-11 06:48:29'),
(106, 8, 'LOGIN', 'User berhasil login', '103.171.161.132', '2026-05-11 06:48:45'),
(107, 15, 'LOGIN', 'User berhasil login', '180.244.0.240', '2026-05-11 07:38:22'),
(108, 15, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '180.244.0.8', '2026-05-11 07:40:12'),
(109, 1, 'LOGIN', 'User berhasil login', '182.2.183.250', '2026-05-11 07:48:05'),
(110, 9, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 07:53:32'),
(111, 9, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '180.244.0.240', '2026-05-11 07:54:56'),
(112, 13, 'LOGIN', 'User berhasil login', '180.244.0.240', '2026-05-11 07:57:14'),
(113, 1, 'LOGIN', 'User berhasil login', '180.244.0.240', '2026-05-11 07:58:24'),
(114, 1, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 08:01:37'),
(115, 13, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 08:02:37'),
(116, 14, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 08:02:53'),
(117, 14, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 250,000 (Survey)', '180.244.0.240', '2026-05-11 08:04:31'),
(118, 14, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 12,500 (Sample)', '180.244.0.240', '2026-05-11 08:07:00'),
(119, 13, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 08:07:37'),
(120, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 75,000 (Perlengkapan/Peralatan Gudang)', '180.244.0.240', '2026-05-11 08:08:46'),
(121, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 206,000 (Listrik & Air)', '180.244.0.240', '2026-05-11 08:09:37'),
(122, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 35,000 (Transportasi)', '140.213.6.152', '2026-05-11 08:10:18'),
(123, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '140.213.6.152', '2026-05-11 08:11:07'),
(124, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 51,500 (Listrik & Air)', '140.213.6.152', '2026-05-11 08:11:46'),
(125, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 255,500 (Service Motor)', '140.213.6.152', '2026-05-11 08:12:22'),
(126, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '112.215.151.147', '2026-05-11 08:13:48'),
(127, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 280,000 (Pemasangan)', '112.215.151.147', '2026-05-11 08:14:35'),
(128, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 35,000 (Transportasi)', '112.215.151.147', '2026-05-11 08:15:09'),
(129, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 102,000 (Iuran Perumahan)', '112.215.151.147', '2026-05-11 08:15:57'),
(130, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 156,000 (Ongkir Pemasangan)', '112.215.151.147', '2026-05-11 08:16:39'),
(131, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '112.215.151.147', '2026-05-11 08:17:31'),
(132, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 80,000 (Konsumsi)', '112.215.151.147', '2026-05-11 08:18:28'),
(133, 1, 'LOGIN', 'User berhasil login', '180.244.0.240', '2026-05-11 08:18:57'),
(134, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 5,000 (Admin)', '112.215.152.115', '2026-05-11 08:20:24'),
(135, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 260,000 (Pemasangan)', '112.215.152.115', '2026-05-11 08:21:02'),
(136, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 2,000 (Admin)', '112.215.152.115', '2026-05-11 08:21:41'),
(137, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 65,000 (Ongkir Barang)', '112.215.152.115', '2026-05-11 08:22:21'),
(138, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 75,000 (Ongkir Pemasangan)', '112.215.152.115', '2026-05-11 08:23:05'),
(139, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 34,500 (Ongkir Barang)', '112.215.152.115', '2026-05-11 08:23:58'),
(140, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 175,000 (Pemasangan)', '112.215.152.182', '2026-05-11 08:24:56'),
(141, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 180,000 (Konsumsi)', '112.215.152.182', '2026-05-11 08:26:01'),
(142, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '140.213.6.84', '2026-05-11 08:26:53'),
(143, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 300,000 (Pemasangan)', '140.213.14.91', '2026-05-11 08:27:48'),
(144, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Pemasangan)', '140.213.14.91', '2026-05-11 08:28:42'),
(145, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 50,000 (Survey)', '112.215.45.244', '2026-05-11 08:29:52'),
(146, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 110,000 (Survey)', '112.215.45.244', '2026-05-11 08:30:42'),
(147, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 35,000 (Transportasi)', '112.215.45.244', '2026-05-11 08:31:20'),
(148, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 5,000 (Admin)', '112.215.152.54', '2026-05-11 08:32:57'),
(149, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 20,000 (Pemasangan)', '112.215.152.54', '2026-05-11 08:33:55'),
(150, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 21,000 (Sample)', '140.213.6.145', '2026-05-11 08:34:45'),
(151, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 125,000 (Pemasangan)', '140.213.6.145', '2026-05-11 08:35:26'),
(152, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Turun Barang)', '140.213.6.145', '2026-05-11 08:37:47'),
(153, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Ongkir Pemasangan)', '140.213.6.145', '2026-05-11 08:38:22'),
(154, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 60,000 (Konsumsi)', '140.213.6.145', '2026-05-11 08:39:16'),
(155, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 300,000 (Pemasangan)', '140.213.6.145', '2026-05-11 08:40:22'),
(156, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 115,000 (Pemasangan)', '140.213.6.145', '2026-05-11 08:41:14'),
(157, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 43,000 (Internet)', '140.213.6.145', '2026-05-11 08:41:51'),
(158, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 84,000 (Ongkir Pemasangan)', '140.213.6.145', '2026-05-11 08:42:37'),
(159, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 120,000 (Konsumsi)', '140.213.6.145', '2026-05-11 08:43:30'),
(160, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 180,000 (Konsumsi)', '140.213.6.145', '2026-05-11 08:44:19'),
(161, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 100,000 (Pemasangan)', '140.213.6.145', '2026-05-11 08:45:02'),
(162, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 5,000 (Admin)', '140.213.6.145', '2026-05-11 08:46:02'),
(163, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '140.213.6.145', '2026-05-11 08:46:42'),
(164, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 274,950 (Internet)', '140.213.14.221', '2026-05-11 08:48:02'),
(165, 13, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 25,000 (Lembur)', '140.213.14.221', '2026-05-11 08:49:24'),
(166, 1, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 08:49:59'),
(167, 13, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 08:51:35'),
(168, 1, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 08:53:30'),
(169, 1, 'REJECT_DATA', 'Audit Transaksi ID #12 menjadi rejected. ', '180.244.0.8', '2026-05-11 08:57:33'),
(170, 1, 'REJECT_DATA', 'Audit Transaksi ID #11 menjadi rejected. Alasan: smjlf', '180.244.0.8', '2026-05-11 08:57:39'),
(171, 1, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 2,140,000 (Admin)', '103.171.161.132', '2026-05-11 09:14:51'),
(172, 1, 'VERIFY_DATA', 'Audit Transaksi ID #65 menjadi verified. Alasan: 1', '180.244.0.240', '2026-05-11 09:16:10'),
(173, 27, 'LOGIN', 'User berhasil login', '140.213.14.223', '2026-05-11 09:17:07'),
(174, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 250,000 (Survey)', '140.213.14.90', '2026-05-11 09:19:10'),
(175, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 12,500 (Sample)', '112.215.151.159', '2026-05-11 09:21:37'),
(176, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 75,000 (Perlengkapan/Peralatan Gudang)', '112.215.151.159', '2026-05-11 09:22:32'),
(177, 1, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 14:15:27'),
(178, 1, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 14:20:44'),
(179, 24, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 14:20:58'),
(180, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 42,000 (Ongkir Barang)', '180.244.0.8', '2026-05-11 14:22:13'),
(181, 27, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 14:24:17'),
(182, 27, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 14:31:13'),
(183, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 206,000 (Listrik & Air)', '180.244.0.240', '2026-05-11 14:31:21'),
(184, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 35,000 (Transportasi)', '180.244.0.240', '2026-05-11 14:32:08'),
(185, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '180.244.0.8', '2026-05-11 14:33:04'),
(186, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 51,500 (Listrik & Air)', '180.244.0.8', '2026-05-11 14:33:37'),
(187, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 255,500 (Service Motor)', '180.244.0.240', '2026-05-11 14:34:36'),
(188, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '180.244.0.240', '2026-05-11 14:35:00'),
(189, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 280,000 (Pemasangan)', '103.171.161.132', '2026-05-11 14:35:56'),
(190, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 35,000 (Transportasi)', '180.244.0.240', '2026-05-11 14:36:13'),
(191, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 2,000 (Admin)', '180.244.0.240', '2026-05-11 14:37:02'),
(192, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 102,000 (Iuran Perumahan)', '180.244.0.240', '2026-05-11 14:37:17'),
(193, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 156,000 (Ongkir Pemasangan)', '103.171.161.132', '2026-05-11 14:38:32'),
(194, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '180.244.0.8', '2026-05-11 14:38:46'),
(195, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 80,000 (Konsumsi)', '180.244.0.8', '2026-05-11 14:39:42'),
(196, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 5,000 (Admin)', '103.171.161.132', '2026-05-11 14:39:49'),
(197, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 280,000 (Pemasangan)', '103.171.161.132', '2026-05-11 14:40:40'),
(198, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 2,000 (Admin)', '103.171.161.132', '2026-05-11 14:40:48'),
(199, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 65,000 (Ongkir Barang)', '180.244.0.240', '2026-05-11 14:41:28'),
(200, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 75,000 (Ongkir Pemasangan)', '103.171.161.132', '2026-05-11 14:41:41'),
(201, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 34,500 (Ongkir Barang)', '180.244.0.8', '2026-05-11 14:42:27'),
(202, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 175,000 (Pemasangan)', '103.171.161.132', '2026-05-11 14:42:35'),
(203, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 180,000 (Konsumsi)', '103.171.161.132', '2026-05-11 14:43:20'),
(204, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '103.171.161.132', '2026-05-11 14:43:33'),
(205, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 300,000 (Pemasangan)', '180.244.0.240', '2026-05-11 14:44:20'),
(206, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Pemasangan)', '103.171.161.132', '2026-05-11 14:44:35'),
(207, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 110,000 (Survey)', '180.244.0.240', '2026-05-11 14:45:32'),
(208, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 50,000 (Survey)', '180.244.0.240', '2026-05-11 14:45:53'),
(209, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 35,000 (Transportasi)', '180.244.0.240', '2026-05-11 14:46:15'),
(210, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 5,000 (Admin)', '180.244.0.240', '2026-05-11 14:46:53'),
(211, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 20,000 (Pemasangan)', '180.244.0.240', '2026-05-11 14:47:09'),
(212, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 21,000 (Sample)', '103.171.161.132', '2026-05-11 14:47:46'),
(213, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 125,000 (Pemasangan)', '180.244.0.240', '2026-05-11 14:47:56'),
(214, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Turun Barang)', '180.244.0.8', '2026-05-11 14:48:33'),
(215, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Ongkir Pemasangan)', '180.244.0.240', '2026-05-11 14:48:49'),
(216, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 60,000 (Konsumsi)', '180.244.0.240', '2026-05-11 14:49:37'),
(217, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 300,000 (Pemasangan)', '180.244.0.240', '2026-05-11 14:49:49'),
(218, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 115,000 (Pemasangan)', '180.244.0.240', '2026-05-11 14:50:36'),
(219, 27, 'LOGIN', 'User berhasil login', '180.244.0.240', '2026-05-11 14:50:45'),
(220, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 43,000 (Internet)', '180.244.0.240', '2026-05-11 14:51:20'),
(221, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 84,000 (Ongkir Pemasangan)', '180.244.0.8', '2026-05-11 14:52:14'),
(222, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 120,000 (Konsumsi)', '103.171.161.132', '2026-05-11 14:52:41'),
(223, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 180,000 (Konsumsi)', '180.244.0.8', '2026-05-11 14:53:41'),
(224, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 100,000 (Pemasangan)', '180.244.0.240', '2026-05-11 14:53:47'),
(225, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 5,000 (Admin)', '103.171.161.132', '2026-05-11 14:54:32'),
(226, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '180.244.0.240', '2026-05-11 14:54:57'),
(227, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 274,950 (Internet)', '103.171.161.132', '2026-05-11 14:55:30'),
(228, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 25,000 (Lembur)', '180.244.0.8', '2026-05-11 14:55:50'),
(229, 1, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 14:55:56'),
(230, 24, 'LOGIN', 'User berhasil login', '180.244.0.240', '2026-05-11 14:59:41'),
(231, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 206,000 (Ongkir Barang)', '180.244.0.240', '2026-05-11 15:01:09'),
(232, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '180.244.0.240', '2026-05-11 15:02:03'),
(233, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 231,180 (Listrik & Air)', '180.244.0.240', '2026-05-11 15:02:44'),
(234, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 268,400 (Internet)', '180.244.0.240', '2026-05-11 15:03:24'),
(235, 24, 'LOGIN', 'User berhasil login', '180.244.0.8', '2026-05-11 15:04:36'),
(236, 24, 'LOGIN', 'User berhasil login', '103.171.161.132', '2026-05-11 15:06:16'),
(237, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 268,400 (Internet)', '180.244.0.8', '2026-05-11 15:07:06'),
(238, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 71,200 (Listrik & Air)', '180.244.0.240', '2026-05-11 15:08:05'),
(239, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 150,000 (Service Motor)', '180.244.0.240', '2026-05-11 15:08:30'),
(240, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '180.244.0.240', '2026-05-11 15:09:13'),
(241, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 6,000 (Konsumsi)', '180.244.0.240', '2026-05-11 15:09:32'),
(242, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 2,000 (Ongkir Barang)', '180.244.0.240', '2026-05-11 15:10:22'),
(243, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 400,000 (Ongkir Barang)', '180.244.0.240', '2026-05-11 15:10:50'),
(244, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 77,990 (Internet)', '180.244.0.8', '2026-05-11 15:11:41'),
(245, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 232,500 (Ongkir Barang)', '180.244.0.8', '2026-05-11 15:12:05'),
(246, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 180,000 (Konsumsi)', '180.244.0.240', '2026-05-11 15:12:51'),
(247, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 35,000 (Transportasi)', '180.244.0.8', '2026-05-11 15:13:10'),
(248, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '103.171.161.132', '2026-05-11 15:13:55'),
(249, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 500,000 (Pemasangan)', '180.244.0.240', '2026-05-11 15:14:32'),
(250, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 60,000 (Konsumsi)', '180.244.0.8', '2026-05-11 15:15:34'),
(251, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 27,000 (Ongkir Barang)', '180.244.0.240', '2026-05-11 15:16:00'),
(252, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 60,000 (Konsumsi)', '180.244.0.240', '2026-05-11 15:16:48'),
(253, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 40,000 (Transportasi)', '180.244.0.240', '2026-05-11 15:17:17'),
(254, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 205,500 (Pemasangan)', '180.244.0.8', '2026-05-11 15:18:04'),
(255, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '180.244.0.240', '2026-05-11 15:18:36'),
(256, 1, 'LOGIN', 'User berhasil login', '103.28.116.201', '2026-05-15 10:35:09'),
(257, 1, 'LOGIN', 'User berhasil login', '180.244.0.66', '2026-05-15 14:46:26'),
(258, 24, 'LOGIN', 'User berhasil login', '125.166.101.136', '2026-05-15 14:51:51'),
(259, 1, 'LOGIN', 'User berhasil login', '140.213.140.48', '2026-05-27 19:48:53'),
(260, 1, 'LOGIN', 'User berhasil login', '180.244.0.27', '2026-06-03 16:27:13'),
(261, 24, 'LOGIN', 'User berhasil login', '103.171.161.132', '2026-06-03 16:58:10'),
(262, 1, 'LOGIN', 'User berhasil login', '125.166.100.140', '2026-06-03 16:59:11'),
(263, 1, 'VERIFY_DATA', 'Audit Transaksi ID #66 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:02:42'),
(264, 1, 'VERIFY_DATA', 'Audit Transaksi ID #67 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:02:54'),
(265, 1, 'VERIFY_DATA', 'Audit Transaksi ID #69 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:03:59'),
(266, 1, 'VERIFY_DATA', 'Audit Transaksi ID #68 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:04:17'),
(267, 1, 'VERIFY_DATA', 'Audit Transaksi ID #70 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:04:32'),
(268, 1, 'VERIFY_DATA', 'Audit Transaksi ID #71 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:04:45'),
(269, 1, 'VERIFY_DATA', 'Audit Transaksi ID #115 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:05:11'),
(270, 1, 'VERIFY_DATA', 'Audit Transaksi ID #72 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:05:33'),
(271, 1, 'VERIFY_DATA', 'Audit Transaksi ID #116 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:05:49'),
(272, 1, 'VERIFY_DATA', 'Audit Transaksi ID #73 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:06:16'),
(273, 1, 'VERIFY_DATA', 'Audit Transaksi ID #74 menjadi verified. Alasan: 1', '180.244.0.27', '2026-06-03 17:06:27'),
(274, 1, 'VERIFY_DATA', 'Audit Transaksi ID #117 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:06:50'),
(275, 1, 'VERIFY_DATA', 'Audit Transaksi ID #118 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:07:20'),
(276, 1, 'REJECT_DATA', 'Audit Transaksi ID #119 menjadi rejected. Alasan: DOUBLE', '125.166.100.140', '2026-06-03 17:07:30'),
(277, 1, 'VERIFY_DATA', 'Audit Transaksi ID #120 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:07:41'),
(278, 1, 'VERIFY_DATA', 'Audit Transaksi ID #121 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:07:51'),
(279, 1, 'VERIFY_DATA', 'Audit Transaksi ID #75 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:08:13'),
(280, 1, 'VERIFY_DATA', 'Audit Transaksi ID #76 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:08:26'),
(281, 1, 'VERIFY_DATA', 'Audit Transaksi ID #77 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:08:36'),
(282, 1, 'VERIFY_DATA', 'Audit Transaksi ID #78 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:08:44'),
(283, 1, 'VERIFY_DATA', 'Audit Transaksi ID #79 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:08:51'),
(284, 1, 'VERIFY_DATA', 'Audit Transaksi ID #80 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:09:00'),
(285, 1, 'VERIFY_DATA', 'Audit Transaksi ID #81 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:09:14'),
(286, 1, 'VERIFY_DATA', 'Audit Transaksi ID #82 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:09:24'),
(287, 1, 'VERIFY_DATA', 'Audit Transaksi ID #83 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:09:31'),
(288, 1, 'VERIFY_DATA', 'Audit Transaksi ID #122 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:09:54'),
(289, 1, 'VERIFY_DATA', 'Audit Transaksi ID #123 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:10:01'),
(290, 1, 'VERIFY_DATA', 'Audit Transaksi ID #124 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:10:09'),
(291, 1, 'VERIFY_DATA', 'Audit Transaksi ID #84 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:10:30'),
(292, 1, 'VERIFY_DATA', 'Audit Transaksi ID #85 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:10:36'),
(293, 1, 'VERIFY_DATA', 'Audit Transaksi ID #86 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:10:47'),
(294, 1, 'VERIFY_DATA', 'Audit Transaksi ID #87 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:10:57'),
(295, 1, 'VERIFY_DATA', 'Audit Transaksi ID #125 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:11:19'),
(296, 1, 'VERIFY_DATA', 'Audit Transaksi ID #88 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:16:23'),
(297, 1, 'VERIFY_DATA', 'Audit Transaksi ID #89 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:16:38'),
(298, 1, 'VERIFY_DATA', 'Audit Transaksi ID #90 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:16:45'),
(299, 1, 'VERIFY_DATA', 'Audit Transaksi ID #126 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:17:02'),
(300, 1, 'VERIFY_DATA', 'Audit Transaksi ID #127 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:17:12'),
(301, 1, 'VERIFY_DATA', 'Audit Transaksi ID #128 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:17:24'),
(302, 1, 'VERIFY_DATA', 'Audit Transaksi ID #129 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:17:32'),
(303, 1, 'VERIFY_DATA', 'Audit Transaksi ID #91 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:17:48'),
(304, 1, 'VERIFY_DATA', 'Audit Transaksi ID #92 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:18:01'),
(305, 1, 'VERIFY_DATA', 'Audit Transaksi ID #93 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:18:21'),
(306, 1, 'VERIFY_DATA', 'Audit Transaksi ID #95 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:18:40'),
(307, 1, 'VERIFY_DATA', 'Audit Transaksi ID #94 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:18:47'),
(308, 1, 'VERIFY_DATA', 'Audit Transaksi ID #96 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:18:55'),
(309, 1, 'VERIFY_DATA', 'Audit Transaksi ID #97 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:19:02'),
(310, 1, 'VERIFY_DATA', 'Audit Transaksi ID #98 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:19:10'),
(311, 1, 'VERIFY_DATA', 'Audit Transaksi ID #99 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:19:17'),
(312, 1, 'VERIFY_DATA', 'Audit Transaksi ID #100 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:19:25'),
(313, 1, 'VERIFY_DATA', 'Audit Transaksi ID #130 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:19:33'),
(314, 1, 'VERIFY_DATA', 'Audit Transaksi ID #131 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:19:51'),
(315, 1, 'VERIFY_DATA', 'Audit Transaksi ID #132 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:20:03'),
(316, 1, 'VERIFY_DATA', 'Audit Transaksi ID #133 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:20:11'),
(317, 1, 'VERIFY_DATA', 'Audit Transaksi ID #101 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:20:34'),
(318, 1, 'VERIFY_DATA', 'Audit Transaksi ID #102 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:20:42'),
(319, 1, 'VERIFY_DATA', 'Audit Transaksi ID #103 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:20:51'),
(320, 1, 'VERIFY_DATA', 'Audit Transaksi ID #104 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:21:02'),
(321, 1, 'VERIFY_DATA', 'Audit Transaksi ID #105 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 17:21:12'),
(322, 1, 'LOGIN', 'User berhasil login', '125.166.100.140', '2026-06-03 22:34:10'),
(323, 1, 'VERIFY_DATA', 'Audit Transaksi ID #134 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:34:27'),
(324, 1, 'VERIFY_DATA', 'Audit Transaksi ID #135 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:34:33'),
(325, 1, 'VERIFY_DATA', 'Audit Transaksi ID #136 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:34:45'),
(326, 1, 'VERIFY_DATA', 'Audit Transaksi ID #106 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:34:58'),
(327, 1, 'VERIFY_DATA', 'Audit Transaksi ID #107 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:35:06'),
(328, 1, 'VERIFY_DATA', 'Audit Transaksi ID #108 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:35:15'),
(329, 1, 'VERIFY_DATA', 'Audit Transaksi ID #109 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:35:22'),
(330, 1, 'VERIFY_DATA', 'Audit Transaksi ID #110 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:35:36'),
(331, 1, 'VERIFY_DATA', 'Audit Transaksi ID #111 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:35:41'),
(332, 1, 'VERIFY_DATA', 'Audit Transaksi ID #137 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:35:58'),
(333, 1, 'VERIFY_DATA', 'Audit Transaksi ID #112 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:36:07'),
(334, 1, 'VERIFY_DATA', 'Audit Transaksi ID #113 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:36:28'),
(335, 1, 'VERIFY_DATA', 'Audit Transaksi ID #114 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-03 22:36:34'),
(336, 27, 'LOGIN', 'User berhasil login', '125.166.100.140', '2026-06-03 22:36:58'),
(337, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 206,000 (Listrik & Air)', '180.244.0.27', '2026-06-03 22:39:46'),
(338, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 46,000 (Perlengkapan/Peralatan Gudang)', '125.166.100.140', '2026-06-03 22:40:42'),
(339, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 120,000 (Konsumsi)', '125.166.100.140', '2026-06-03 22:41:19'),
(340, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 180,000 (Konsumsi)', '180.244.0.27', '2026-06-03 22:41:51'),
(341, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 35,000 (Transportasi)', '180.244.0.27', '2026-06-03 22:42:22'),
(342, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 140,000 (Pemasangan)', '125.166.100.140', '2026-06-03 22:42:58'),
(343, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 5,000 (Admin)', '125.166.100.140', '2026-06-03 22:43:26'),
(344, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 91,000 (Ongkir Pemasangan)', '180.244.0.27', '2026-06-03 22:44:09'),
(345, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '180.244.0.27', '2026-06-03 22:44:55'),
(346, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 18,000 (Sample)', '180.244.0.27', '2026-06-03 22:45:26'),
(347, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 5,000 (Admin)', '180.244.0.27', '2026-06-03 22:45:52'),
(348, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 71,963 (Listrik & Air)', '103.171.161.132', '2026-06-03 22:46:57'),
(349, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 40,000 (Sample)', '103.171.161.132', '2026-06-03 22:47:25'),
(350, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 37,000 (Ongkir Barang)', '103.171.161.132', '2026-06-03 22:47:59'),
(351, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 36,000 (Ongkir Barang)', '103.171.161.132', '2026-06-03 22:48:26'),
(352, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 5,000,000 (Penambahan Saldo)', '103.171.161.132', '2026-06-03 22:49:12'),
(353, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '103.171.161.132', '2026-06-03 22:49:58'),
(354, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 50,000 (Survey)', '180.244.0.27', '2026-06-03 22:50:35'),
(355, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 35,000 (Transportasi)', '180.244.0.27', '2026-06-03 22:51:22'),
(356, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 18,000 (Sample)', '180.244.0.27', '2026-06-03 22:51:52'),
(357, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 7,500 (Admin)', '180.244.0.27', '2026-06-03 22:52:22'),
(358, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 25,000 (Perlengkapan/Peralatan Gudang)', '180.244.0.27', '2026-06-03 22:52:57'),
(359, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 20,000 (Perlengkapan/Peralatan Gudang)', '180.244.0.27', '2026-06-03 22:53:23'),
(360, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 80,000 (Konsumsi)', '180.244.0.27', '2026-06-03 22:53:49'),
(361, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 265,128 (Perlengkapan/Peralatan Gudang)', '180.244.0.27', '2026-06-03 22:54:26'),
(362, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 25,579 (Perlengkapan/Peralatan Gudang)', '180.244.0.27', '2026-06-03 22:54:53'),
(363, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 76,425 (Perlengkapan/Peralatan Gudang)', '180.244.0.27', '2026-06-03 22:55:23'),
(364, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 2,000 (Admin)', '180.244.0.27', '2026-06-03 22:55:52'),
(365, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 347,840 (Iuran Perumahan)', '180.244.0.27', '2026-06-03 22:56:40'),
(366, 27, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 85,000 (Ongkir Barang)', '180.244.0.27', '2026-06-03 22:57:17'),
(367, 1, 'LOGIN', 'User berhasil login', '114.10.76.1', '2026-06-04 11:33:02'),
(368, 27, 'LOGIN', 'User berhasil login', '180.244.0.27', '2026-06-04 12:34:09'),
(369, 1, 'LOGIN', 'User berhasil login', '180.244.0.27', '2026-06-04 12:34:25'),
(370, 1, 'VERIFY_DATA', 'Audit Transaksi ID #138 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:36:31'),
(371, 1, 'VERIFY_DATA', 'Audit Transaksi ID #139 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:36:37'),
(372, 1, 'VERIFY_DATA', 'Audit Transaksi ID #140 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:36:43'),
(373, 1, 'VERIFY_DATA', 'Audit Transaksi ID #141 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:36:49'),
(374, 1, 'VERIFY_DATA', 'Audit Transaksi ID #142 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:36:55'),
(375, 1, 'VERIFY_DATA', 'Audit Transaksi ID #158 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:37:01'),
(376, 1, 'VERIFY_DATA', 'Audit Transaksi ID #143 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:37:08'),
(377, 1, 'VERIFY_DATA', 'Audit Transaksi ID #144 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:37:15'),
(378, 1, 'VERIFY_DATA', 'Audit Transaksi ID #145 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:37:23'),
(379, 1, 'VERIFY_DATA', 'Audit Transaksi ID #146 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:37:30'),
(380, 1, 'VERIFY_DATA', 'Audit Transaksi ID #147 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:37:38'),
(381, 1, 'VERIFY_DATA', 'Audit Transaksi ID #148 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:37:47'),
(382, 1, 'VERIFY_DATA', 'Audit Transaksi ID #149 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:37:58'),
(383, 1, 'VERIFY_DATA', 'Audit Transaksi ID #150 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:39:12'),
(384, 1, 'VERIFY_DATA', 'Audit Transaksi ID #151 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:39:19'),
(385, 1, 'VERIFY_DATA', 'Audit Transaksi ID #152 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:39:27'),
(386, 1, 'VERIFY_DATA', 'Audit Transaksi ID #153 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:39:33'),
(387, 1, 'VERIFY_DATA', 'Audit Transaksi ID #154 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:39:42'),
(388, 1, 'VERIFY_DATA', 'Audit Transaksi ID #155 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:39:49'),
(389, 1, 'VERIFY_DATA', 'Audit Transaksi ID #156 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:39:57'),
(390, 1, 'VERIFY_DATA', 'Audit Transaksi ID #157 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:40:02'),
(391, 1, 'VERIFY_DATA', 'Audit Transaksi ID #159 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:40:06'),
(392, 1, 'VERIFY_DATA', 'Audit Transaksi ID #160 menjadi verified. Alasan: 1', '103.171.161.132', '2026-06-04 12:40:34'),
(393, 1, 'VERIFY_DATA', 'Audit Transaksi ID #161 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-04 12:40:39'),
(394, 1, 'VERIFY_DATA', 'Audit Transaksi ID #162 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-04 12:40:44'),
(395, 1, 'VERIFY_DATA', 'Audit Transaksi ID #163 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-04 12:40:50'),
(396, 1, 'VERIFY_DATA', 'Audit Transaksi ID #164 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-04 12:40:54'),
(397, 1, 'VERIFY_DATA', 'Audit Transaksi ID #165 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-04 12:41:00'),
(398, 1, 'VERIFY_DATA', 'Audit Transaksi ID #166 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-04 12:41:13'),
(399, 1, 'VERIFY_DATA', 'Audit Transaksi ID #167 menjadi verified. Alasan: 1', '125.166.100.140', '2026-06-04 12:41:17'),
(400, 27, 'LOGIN', 'User berhasil login', '125.166.100.140', '2026-06-04 12:41:33'),
(401, 24, 'LOGIN', 'User berhasil login', '125.166.100.140', '2026-06-04 12:42:26'),
(402, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 68,000 (Ongkir Pemasangan)', '125.166.100.140', '2026-06-04 12:43:44'),
(403, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 140,000 (Pemasangan)', '125.166.100.140', '2026-06-04 12:44:21'),
(404, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 120,000 (Konsumsi)', '125.166.100.140', '2026-06-04 12:45:00'),
(405, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 180,000 (Konsumsi)', '125.166.100.140', '2026-06-04 12:45:33'),
(406, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 125,000 (Ongkir Pemasangan)', '125.166.100.140', '2026-06-04 12:46:07'),
(407, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Pemasangan)', '125.166.100.140', '2026-06-04 12:46:37'),
(408, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 180,000 (Konsumsi)', '180.244.0.27', '2026-06-04 12:48:04'),
(409, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 120,000 (Konsumsi)', '180.244.0.27', '2026-06-04 12:48:52'),
(410, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 60,000 (Konsumsi)', '125.166.100.140', '2026-06-04 12:49:54'),
(411, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 74,500 (Konsumsi)', '125.166.100.140', '2026-06-04 12:50:27'),
(412, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 18,300 (Perlengkapan/Peralatan Gudang)', '180.244.0.27', '2026-06-04 12:51:15'),
(413, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 11,200 (Perlengkapan/Peralatan Gudang)', '180.244.0.27', '2026-06-04 12:51:47'),
(414, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 11,000 (Perlengkapan/Peralatan Gudang)', '125.166.100.140', '2026-06-04 12:52:15'),
(415, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 19,000 (Ongkir Barang)', '125.166.100.140', '2026-06-04 12:52:50'),
(416, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 162,000 (Ongkir Barang)', '103.171.161.132', '2026-06-04 12:53:38'),
(417, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '103.171.161.132', '2026-06-04 12:54:16'),
(418, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '103.171.161.132', '2026-06-04 12:54:55'),
(419, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Turun Barang)', '103.171.161.132', '2026-06-04 12:55:34'),
(420, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 40,000 (Transportasi)', '103.171.161.132', '2026-06-04 12:56:04'),
(421, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 20,000 (Turun Barang)', '103.171.161.132', '2026-06-04 12:56:34'),
(422, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 270,000 (Turun Barang)', '103.171.161.132', '2026-06-04 12:57:32'),
(423, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 31,000 (Ongkir Barang)', '103.171.161.132', '2026-06-04 12:58:17'),
(424, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 25,000 (Lembur)', '103.171.161.132', '2026-06-04 12:58:41'),
(425, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 18,000 (Sample)', '103.171.161.132', '2026-06-04 12:59:18'),
(426, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 360,000 (Konsumsi)', '103.171.161.132', '2026-06-04 12:59:53'),
(427, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 20,000 (Sample)', '103.171.161.132', '2026-06-04 13:00:51'),
(428, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 300,000 (Konsumsi)', '103.171.161.132', '2026-06-04 13:02:04'),
(429, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Pemasangan)', '103.171.161.132', '2026-06-04 13:02:38'),
(430, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 35,000 (Transportasi)', '125.166.100.140', '2026-06-04 13:03:00'),
(431, 24, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 2,000 (Admin)', '125.166.100.140', '2026-06-04 13:03:26'),
(432, 1, 'LOGIN', 'User berhasil login', '180.244.0.27', '2026-06-04 13:09:11'),
(433, 1, 'LOGIN', 'User berhasil login', '103.171.161.132', '2026-06-04 14:32:11'),
(434, 1, 'LOGIN', 'User berhasil login', '125.166.100.140', '2026-06-04 15:46:52'),
(435, 1, 'LOGIN', 'User berhasil login', '114.10.79.131', '2026-06-05 01:56:55'),
(436, 1, 'LOGIN', 'User berhasil login', '114.10.78.243', '2026-06-05 03:08:54'),
(437, 1, 'INPUT_TRANSAKSI', 'Input Transaksi: in Rp 2,500,000 (Penambahan Saldo)', '114.10.78.243', '2026-06-05 03:10:59'),
(438, 28, 'LOGIN', 'User berhasil login', '114.10.77.243', '2026-06-05 03:12:42'),
(439, 28, 'INPUT_TRANSAKSI', 'Input Transaksi: out Rp 200,000 (Pemasangan)', '114.10.77.243', '2026-06-05 03:14:17'),
(440, 1, 'LOGIN', 'User berhasil login', '114.10.77.243', '2026-06-05 03:14:36'),
(441, 1, 'LOGIN', 'User berhasil login', '::1', '2026-08-18 03:08:05'),
(442, 1, 'LOGIN', 'User berhasil login', '::1', '2026-08-18 03:46:53'),
(443, 29, 'LOGIN', 'User berhasil login', '::1', '2026-08-18 03:52:49'),
(444, 1, 'LOGIN', 'User berhasil login', '::1', '2026-08-18 03:53:07'),
(445, 29, 'LOGIN', 'User berhasil login', '::1', '2026-08-18 04:18:10'),
(446, 1, 'LOGIN', 'User berhasil login', '::1', '2026-08-18 04:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`) VALUES
(2, 'Bandung'),
(3, 'Surabaya'),
(6, 'Bogor'),
(7, 'Semarang'),
(8, 'Yogyakarta'),
(9, 'Bali'),
(10, 'Medan'),
(11, 'Pusat');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `group_id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_zakat` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `group_id`, `name`, `is_zakat`) VALUES
(1, 1, 'Listrik & Air', 0),
(3, 3, 'Peralatan Kantor', 1),
(4, 1, 'Konsumsi', 0),
(6, 1, 'Internet', 0),
(7, 7, 'Pemasangan', 0),
(8, 6, 'Transportasi', 0),
(9, 3, 'Perlengkapan/Peralatan Gudang', 0),
(10, 1, 'Ongkir Barang', 0),
(11, 7, 'Ongkir Pemasangan', 0),
(12, 5, 'Penambahan Saldo', 0),
(13, 1, 'Sample', 0),
(14, 1, 'Iuran Sampah', 0),
(15, 1, 'Service Motor', 0),
(16, 6, 'Uang Perjalanan', 0),
(17, 1, 'Iuran Perumahan', 0),
(18, 1, 'Lembur', 0),
(19, 7, 'Survey', 0),
(20, 1, 'Admin', 0),
(21, 4, 'Turun Barang', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_groups`
--

CREATE TABLE `category_groups` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_groups`
--

INSERT INTO `category_groups` (`id`, `name`) VALUES
(1, 'Operasional Rutin'),
(3, 'Aset & Inventaris'),
(4, 'Lainnya'),
(5, 'Penambahan Saldo'),
(6, 'Perjalanan'),
(7, 'Instalasi');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `branch` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `type` enum('in','out') COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `is_zakat` tinyint(1) DEFAULT '0',
  `proof_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','verified','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `verified_by` int DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `branch`, `date`, `type`, `category`, `description`, `amount`, `is_zakat`, `proof_file`, `status`, `verified_by`, `verified_at`, `created_at`) VALUES
(1, 1, 'Pusat', '2025-11-30', 'out', 'Operasional - Konsumsi', 'pem', '200000.00', 1, 'proof_1_1764502450.png', 'verified', 4, '2026-02-03 11:36:10', '2025-11-30 11:34:10'),
(2, 1, 'Pusat', '2025-11-30', 'in', 'Operasional - Konsumsi', 'dd', '200000.00', 1, 'proof_1_1764503022.jpeg', 'verified', 4, '2026-02-03 11:36:13', '2025-11-30 11:43:42'),
(3, 1, 'Pusat', '2026-02-02', 'out', 'Konsumsi', 'hallo', '12000000.00', 0, 'proof_1_1770045258.jpeg', 'verified', 1, '2026-02-02 22:14:39', '2026-02-02 15:14:18'),
(4, 2, 'Jakarta', '2026-02-03', 'out', 'Peralatan Kantor', 'Pembelian Kursi Kantor', '2000000.00', 1, 'proof_2_1770093340.png', 'verified', 4, '2026-02-03 11:36:06', '2026-02-03 04:35:40'),
(5, 13, 'Yogyakarta', '2026-04-15', 'in', 'Penambahan Saldo', 'penambahan saldo', '2500000.00', 0, 'proof_13_1776263261.png', 'verified', 1, '2026-04-15 21:29:13', '2026-04-15 14:27:41'),
(6, 13, 'Yogyakarta', '2026-04-15', 'out', 'Konsumsi', 'uang makan', '600000.00', 0, 'proof_13_1776263305.png', 'verified', 1, '2026-04-15 21:29:19', '2026-04-15 14:28:25'),
(14, 13, 'Yogyakarta', '2026-05-03', 'out', 'Konsumsi', 'uang makan', '360000.00', 0, 'proof_13_1777816140.jpg', 'verified', 22, '2026-05-03 20:51:34', '2026-05-03 13:49:00'),
(15, 8, 'Bandung', '2026-05-11', 'in', 'Penambahan Saldo', 'Penambahan Saldo ', '2500000.00', 0, 'proof_8_1778482036.jpg', 'verified', 1, '2026-05-11 13:48:29', '2026-05-11 06:47:16'),
(16, 15, 'Medan', '2026-05-11', 'in', 'Penambahan Saldo', 'd', '2500000.00', 0, 'proof_15_1778485212.jpeg', 'verified', NULL, NULL, '2026-05-11 07:40:12'),
(17, 9, 'Bali', '2026-05-11', 'in', 'Penambahan Saldo', 'penambahan saldo', '2500000.00', 0, 'proof_9_1778486096.jpg', 'verified', NULL, NULL, '2026-05-11 07:54:56'),
(18, 14, 'Surabaya', '2026-05-01', 'out', 'Survey', 'survey mini soccer', '250000.00', 0, 'proof_14_1778486671.jpg', 'verified', NULL, NULL, '2026-05-11 08:04:31'),
(19, 14, 'Surabaya', '2026-05-01', 'out', 'Sample', 'ongkir sample', '12500.00', 0, 'proof_14_1778486820.jpeg', 'verified', NULL, NULL, '2026-05-11 08:07:00'),
(20, 13, 'Yogyakarta', '2026-05-02', 'out', 'Perlengkapan/Peralatan Gudang', 'Meteran 50m', '75000.00', 0, 'proof_13_1778486926.jpg', 'verified', NULL, NULL, '2026-05-11 08:08:46'),
(21, 13, 'Yogyakarta', '2026-05-02', 'out', 'Listrik & Air', 'Token listrik ', '206000.00', 0, 'proof_13_1778486977.jpg', 'verified', NULL, NULL, '2026-05-11 08:09:37'),
(22, 13, 'Yogyakarta', '2026-05-02', 'out', 'Transportasi', 'bensin', '35000.00', 0, 'proof_13_1778487018.jpg', 'verified', NULL, NULL, '2026-05-11 08:10:18'),
(23, 13, 'Yogyakarta', '2026-05-03', 'out', 'Konsumsi', 'Uang makan', '360000.00', 0, 'proof_13_1778487067.jpg', 'verified', NULL, NULL, '2026-05-11 08:11:07'),
(24, 13, 'Yogyakarta', '2026-05-11', 'out', 'Listrik & Air', 'PDAM ', '51500.00', 0, 'proof_13_1778487106.jpg', 'verified', NULL, NULL, '2026-05-11 08:11:46'),
(25, 13, 'Yogyakarta', '2026-05-11', 'out', 'Service Motor', 'Service motor mei', '255500.00', 0, 'proof_13_1778487142.jpg', 'verified', NULL, NULL, '2026-05-11 08:12:22'),
(26, 13, 'Yogyakarta', '2026-05-05', 'in', 'Penambahan Saldo', 'Penambahan saldo ', '2500000.00', 0, 'proof_13_1778487228.jpg', 'verified', NULL, NULL, '2026-05-11 08:13:48'),
(27, 13, 'Yogyakarta', '2026-05-05', 'out', 'Pemasangan', 'Upah pemasangan 2 orang ', '280000.00', 0, 'proof_13_1778487275.jpg', 'verified', NULL, NULL, '2026-05-11 08:14:35'),
(28, 13, 'Yogyakarta', '2026-05-11', 'out', 'Transportasi', 'Bensin', '35000.00', 0, 'proof_13_1778487309.jpg', 'verified', NULL, NULL, '2026-05-11 08:15:09'),
(29, 13, 'Yogyakarta', '2026-05-05', 'out', 'Iuran Perumahan', 'Iuran perumahan ', '102000.00', 0, 'proof_13_1778487357.jpg', 'verified', NULL, NULL, '2026-05-11 08:15:57'),
(30, 13, 'Yogyakarta', '2026-05-05', 'out', 'Ongkir Pemasangan', 'Ongkir pemasangan', '156000.00', 0, 'proof_13_1778487399.jpg', 'verified', NULL, NULL, '2026-05-11 08:16:39'),
(31, 13, 'Yogyakarta', '2026-05-05', 'out', 'Konsumsi', 'Uang makan 3 orang 2 hari', '360000.00', 0, 'proof_13_1778487451.jpg', 'verified', NULL, NULL, '2026-05-11 08:17:31'),
(32, 13, 'Yogyakarta', '2026-05-05', 'out', 'Konsumsi', 'Beras', '80000.00', 0, 'proof_13_1778487508.jpg', 'verified', NULL, NULL, '2026-05-11 08:18:28'),
(33, 13, 'Yogyakarta', '2026-05-05', 'out', 'Admin', 'Admin', '5000.00', 0, 'proof_13_1778487624.jpg', 'verified', NULL, NULL, '2026-05-11 08:20:24'),
(34, 13, 'Yogyakarta', '2026-05-06', 'out', 'Pemasangan', 'Upah pemasangan ', '260000.00', 0, 'proof_13_1778487662.jpg', 'verified', NULL, NULL, '2026-05-11 08:21:02'),
(35, 13, 'Yogyakarta', '2026-05-06', 'out', 'Admin', 'Admin', '2000.00', 0, 'proof_13_1778487701.jpg', 'verified', NULL, NULL, '2026-05-11 08:21:41'),
(36, 13, 'Yogyakarta', '2026-05-06', 'out', 'Ongkir Barang', 'Ongkir barang', '65000.00', 0, 'proof_13_1778487741.jpg', 'verified', NULL, NULL, '2026-05-11 08:22:21'),
(37, 13, 'Yogyakarta', '2026-05-06', 'out', 'Ongkir Pemasangan', 'Ongkir pemasangan ', '75000.00', 0, 'proof_13_1778487785.jpg', 'verified', NULL, NULL, '2026-05-11 08:23:05'),
(38, 13, 'Yogyakarta', '2026-05-11', 'out', 'Ongkir Barang', 'Ongkir barang', '34500.00', 0, 'proof_13_1778487837.jpg', 'verified', NULL, NULL, '2026-05-11 08:23:58'),
(39, 13, 'Yogyakarta', '2026-05-11', 'out', 'Pemasangan', 'Lembur pemasangan ', '175000.00', 0, 'proof_13_1778487896.jpg', 'verified', NULL, NULL, '2026-05-11 08:24:56'),
(40, 13, 'Yogyakarta', '2026-05-07', 'out', 'Konsumsi', 'Uang makan 3 orang', '180000.00', 0, 'proof_13_1778487961.jpg', 'verified', NULL, NULL, '2026-05-11 08:26:01'),
(41, 13, 'Yogyakarta', '2026-05-08', 'in', 'Penambahan Saldo', 'Penambahan saldo ', '2500000.00', 0, 'proof_13_1778488013.jpg', 'verified', NULL, NULL, '2026-05-11 08:26:53'),
(42, 13, 'Yogyakarta', '2026-05-08', 'out', 'Pemasangan', 'Upah pasang sabtu darda', '300000.00', 0, 'proof_13_1778488068.jpg', 'verified', NULL, NULL, '2026-05-11 08:27:48'),
(43, 13, 'Yogyakarta', '2026-05-08', 'out', 'Pemasangan', 'Upah pemasangan aril', '200000.00', 0, 'proof_13_1778488122.jpg', 'verified', NULL, NULL, '2026-05-11 08:28:42'),
(44, 13, 'Yogyakarta', '2026-05-08', 'out', 'Survey', 'Survey jumat', '50000.00', 0, 'proof_13_1778488192.jpg', 'verified', NULL, NULL, '2026-05-11 08:29:52'),
(45, 13, 'Yogyakarta', '2026-05-08', 'out', 'Survey', 'Survey plus uang makan', '110000.00', 0, 'proof_13_1778488242.jpg', 'verified', NULL, NULL, '2026-05-11 08:30:42'),
(46, 13, 'Yogyakarta', '2026-05-11', 'out', 'Transportasi', 'Bensin', '35000.00', 0, 'proof_13_1778488280.jpg', 'verified', NULL, NULL, '2026-05-11 08:31:20'),
(47, 13, 'Yogyakarta', '2026-05-08', 'out', 'Admin', 'admin', '5000.00', 0, 'proof_13_1778488377.jpg', 'verified', NULL, NULL, '2026-05-11 08:32:57'),
(48, 13, 'Yogyakarta', '2026-05-08', 'out', 'Pemasangan', 'Karung', '20000.00', 0, 'proof_13_1778488435.jpg', 'verified', NULL, NULL, '2026-05-11 08:33:55'),
(49, 13, 'Yogyakarta', '2026-05-08', 'out', 'Sample', 'Ongkir sample', '21000.00', 0, 'proof_13_1778488485.jpg', 'verified', NULL, NULL, '2026-05-11 08:34:45'),
(50, 13, 'Yogyakarta', '2026-05-08', 'out', 'Pemasangan', 'Pasir', '125000.00', 0, 'proof_13_1778488526.jpg', 'verified', NULL, NULL, '2026-05-11 08:35:26'),
(51, 13, 'Yogyakarta', '2026-05-09', 'out', 'Turun Barang', 'Lembur turun barang', '200000.00', 0, 'proof_13_1778488667.jpg', 'verified', NULL, NULL, '2026-05-11 08:37:47'),
(52, 13, 'Yogyakarta', '2026-05-09', 'out', 'Ongkir Pemasangan', 'Ongkir pemasangan', '200000.00', 0, 'proof_13_1778488702.jpg', 'verified', NULL, NULL, '2026-05-11 08:38:22'),
(53, 13, 'Yogyakarta', '2026-05-09', 'out', 'Konsumsi', 'Uang makan minggu', '60000.00', 0, 'proof_13_1778488756.jpg', 'verified', NULL, NULL, '2026-05-11 08:39:16'),
(54, 13, 'Yogyakarta', '2026-05-09', 'out', 'Pemasangan', 'Upah pemasangan Minggu 1 orang ', '300000.00', 0, 'proof_13_1778488822.jpg', 'verified', NULL, NULL, '2026-05-11 08:40:22'),
(55, 13, 'Yogyakarta', '2026-05-09', 'out', 'Pemasangan', 'Gojek pemasangan', '115000.00', 0, 'proof_13_1778488874.jpg', 'verified', NULL, NULL, '2026-05-11 08:41:14'),
(56, 13, 'Yogyakarta', '2026-05-10', 'out', 'Internet', 'Internet ', '43000.00', 0, 'proof_13_1778488911.jpg', 'verified', NULL, NULL, '2026-05-11 08:41:51'),
(57, 13, 'Yogyakarta', '2026-05-10', 'out', 'Ongkir Pemasangan', 'Ongkir pemasangan ', '84000.00', 0, 'proof_13_1778488957.jpg', 'verified', NULL, NULL, '2026-05-11 08:42:37'),
(58, 13, 'Yogyakarta', '2026-05-10', 'out', 'Konsumsi', 'Uang makan Senin 2 orang ', '120000.00', 0, 'proof_13_1778489010.jpg', 'verified', NULL, NULL, '2026-05-11 08:43:30'),
(59, 13, 'Yogyakarta', '2026-05-10', 'out', 'Konsumsi', 'Uang makan Selasa 3 orang', '180000.00', 0, 'proof_13_1778489059.jpg', 'verified', NULL, NULL, '2026-05-11 08:44:19'),
(60, 13, 'Yogyakarta', '2026-05-10', 'out', 'Pemasangan', 'Upah pemasangan ', '100000.00', 0, 'proof_13_1778489102.jpg', 'verified', NULL, NULL, '2026-05-11 08:45:02'),
(61, 13, 'Yogyakarta', '2026-05-10', 'out', 'Admin', 'Admin ', '5000.00', 0, 'proof_13_1778489162.jpg', 'verified', NULL, NULL, '2026-05-11 08:46:02'),
(62, 13, 'Yogyakarta', '2026-05-11', 'in', 'Penambahan Saldo', 'Penambahan saldo ', '2500000.00', 0, 'proof_13_1778489202.jpg', 'verified', NULL, NULL, '2026-05-11 08:46:42'),
(63, 13, 'Yogyakarta', '2026-05-11', 'out', 'Internet', 'Wifi', '274950.00', 0, 'proof_13_1778489282.jpg', 'verified', NULL, NULL, '2026-05-11 08:48:02'),
(64, 13, 'Yogyakarta', '2026-05-11', 'out', 'Lembur', 'Lembur angkut barang ', '25000.00', 0, 'proof_13_1778489364.jpg', 'verified', NULL, NULL, '2026-05-11 08:49:24'),
(65, 1, 'Pusat', '2026-05-11', 'out', 'Admin', 'coba', '2140000.00', 0, 'proof_1_1778490891.jpeg', 'verified', 1, '2026-05-11 16:16:10', '2026-05-11 09:14:51'),
(66, 27, '', '2026-05-01', 'out', 'Survey', 'Survey mini soccer 2 orang ', '250000.00', 0, 'proof_27_1778491150.jpg', 'verified', 1, '2026-06-04 00:02:42', '2026-05-11 09:19:10'),
(67, 27, '', '2026-05-01', 'out', 'Sample', 'Ongkir sample', '12500.00', 0, 'proof_27_1778491297.jpg', 'verified', 1, '2026-06-04 00:02:54', '2026-05-11 09:21:37'),
(68, 27, '', '2026-05-02', 'out', 'Perlengkapan/Peralatan Gudang', 'Meteran 50m ', '75000.00', 0, 'proof_27_1778491352.jpg', 'verified', 1, '2026-06-04 00:04:17', '2026-05-11 09:22:32'),
(69, 24, 'Yogyakarta', '2026-05-01', 'out', 'Ongkir Barang', 'ongkir barang bogor', '42000.00', 0, 'proof_24_1778509333.jpeg', 'verified', 1, '2026-06-04 00:03:59', '2026-05-11 14:22:13'),
(70, 27, '', '2026-05-02', 'out', 'Listrik & Air', 'Token listrik ', '206000.00', 0, 'proof_27_1778509881.jpg', 'verified', 1, '2026-06-04 00:04:32', '2026-05-11 14:31:21'),
(71, 27, '', '2026-05-02', 'out', 'Transportasi', 'Bensin', '35000.00', 0, 'proof_27_1778509928.jpg', 'verified', 1, '2026-06-04 00:04:45', '2026-05-11 14:32:08'),
(72, 27, '', '2026-05-03', 'out', 'Konsumsi', 'Uang makan', '360000.00', 0, 'proof_27_1778509984.jpg', 'verified', 1, '2026-06-04 00:05:33', '2026-05-11 14:33:04'),
(73, 27, '', '2026-05-04', 'out', 'Listrik & Air', 'PDAM', '51500.00', 0, 'proof_27_1778510017.jpg', 'verified', 1, '2026-06-04 00:06:16', '2026-05-11 14:33:37'),
(74, 27, '', '2026-05-04', 'out', 'Service Motor', 'Service motor', '255500.00', 0, 'proof_27_1778510076.jpg', 'verified', 1, '2026-06-04 00:06:27', '2026-05-11 14:34:36'),
(75, 27, '', '2026-05-05', 'in', 'Penambahan Saldo', 'Penambahan saldo ', '2500000.00', 0, 'proof_27_1778510100.jpg', 'verified', 1, '2026-06-04 00:08:13', '2026-05-11 14:35:00'),
(76, 27, '', '2026-05-05', 'out', 'Pemasangan', 'Upah pemasangan 2 orang ', '280000.00', 0, 'proof_27_1778510156.jpg', 'verified', 1, '2026-06-04 00:08:26', '2026-05-11 14:35:56'),
(77, 27, '', '2026-05-05', 'out', 'Transportasi', 'Bensin ', '35000.00', 0, 'proof_27_1778510173.jpg', 'verified', 1, '2026-06-04 00:08:36', '2026-05-11 14:36:13'),
(78, 27, '', '2026-05-05', 'out', 'Admin', 'Admin', '2000.00', 0, 'proof_27_1778510222.jpg', 'verified', 1, '2026-06-04 00:08:44', '2026-05-11 14:37:02'),
(79, 27, '', '2026-05-05', 'out', 'Iuran Perumahan', 'Iuran perumahan', '102000.00', 0, 'proof_27_1778510237.jpg', 'verified', 1, '2026-06-04 00:08:51', '2026-05-11 14:37:17'),
(80, 27, '', '2026-05-05', 'out', 'Ongkir Pemasangan', 'Ongkir pemasangan ', '156000.00', 0, 'proof_27_1778510312.jpg', 'verified', 1, '2026-06-04 00:09:00', '2026-05-11 14:38:32'),
(81, 27, '', '2026-05-05', 'out', 'Konsumsi', 'Uang makan 3 orang 2 hari', '360000.00', 0, 'proof_27_1778510326.jpg', 'verified', 1, '2026-06-04 00:09:14', '2026-05-11 14:38:46'),
(82, 27, '', '2026-05-05', 'out', 'Konsumsi', 'Beras ', '80000.00', 0, 'proof_27_1778510382.jpg', 'verified', 1, '2026-06-04 00:09:24', '2026-05-11 14:39:42'),
(83, 27, '', '2026-05-05', 'out', 'Admin', 'Admin ', '5000.00', 0, 'proof_27_1778510389.jpg', 'verified', 1, '2026-06-04 00:09:31', '2026-05-11 14:39:49'),
(84, 27, '', '2026-05-06', 'out', 'Pemasangan', 'Upah pemasangan 2 orang', '280000.00', 0, 'proof_27_1778510440.jpg', 'verified', 1, '2026-06-04 00:10:30', '2026-05-11 14:40:40'),
(85, 27, '', '2026-05-06', 'out', 'Admin', 'Admin ', '2000.00', 0, 'proof_27_1778510448.jpg', 'verified', 1, '2026-06-04 00:10:36', '2026-05-11 14:40:48'),
(86, 27, '', '2026-05-06', 'out', 'Ongkir Barang', 'Ongkir barang', '65000.00', 0, 'proof_27_1778510488.jpg', 'verified', 1, '2026-06-04 00:10:47', '2026-05-11 14:41:28'),
(87, 27, '', '2026-05-06', 'out', 'Ongkir Pemasangan', 'Ongkir pemasangan ', '75000.00', 0, 'proof_27_1778510501.jpg', 'verified', 1, '2026-06-04 00:10:57', '2026-05-11 14:41:41'),
(88, 27, '', '2026-05-07', 'out', 'Ongkir Barang', 'Ongkir barang ', '34500.00', 0, 'proof_27_1778510547.jpg', 'verified', 1, '2026-06-04 00:16:22', '2026-05-11 14:42:27'),
(89, 27, '', '2026-05-07', 'out', 'Pemasangan', 'Lembur pemasangan ', '175000.00', 0, 'proof_27_1778510555.jpg', 'verified', 1, '2026-06-04 00:16:38', '2026-05-11 14:42:35'),
(90, 27, '', '2026-05-07', 'out', 'Konsumsi', 'Uang makan Jumat 3 orang', '180000.00', 0, 'proof_27_1778510600.jpg', 'verified', 1, '2026-06-04 00:16:45', '2026-05-11 14:43:20'),
(91, 27, '', '2026-05-08', 'in', 'Penambahan Saldo', 'Penambahan saldo ', '2500000.00', 0, 'proof_27_1778510613.jpg', 'verified', 1, '2026-06-04 00:17:48', '2026-05-11 14:43:33'),
(92, 27, '', '2026-05-08', 'out', 'Pemasangan', 'Upah pemasangan darda', '300000.00', 0, 'proof_27_1778510660.jpg', 'verified', 1, '2026-06-04 00:18:01', '2026-05-11 14:44:20'),
(93, 27, '', '2026-05-08', 'out', 'Pemasangan', 'Upah pasang aril', '200000.00', 0, 'proof_27_1778510675.jpg', 'verified', 1, '2026-06-04 00:18:21', '2026-05-11 14:44:35'),
(94, 27, '', '2026-05-08', 'out', 'Survey', 'Survey plus uang makan Sabtu ', '110000.00', 0, 'proof_27_1778510732.jpg', 'verified', 1, '2026-06-04 00:18:47', '2026-05-11 14:45:32'),
(95, 27, '', '2026-05-08', 'out', 'Survey', 'Survey Jumat ', '50000.00', 0, 'proof_27_1778510753.jpg', 'verified', 1, '2026-06-04 00:18:40', '2026-05-11 14:45:53'),
(96, 27, '', '2026-05-08', 'out', 'Transportasi', 'Bensin ', '35000.00', 0, 'proof_27_1778510775.jpg', 'verified', 1, '2026-06-04 00:18:55', '2026-05-11 14:46:15'),
(97, 27, '', '2026-05-08', 'out', 'Admin', 'Admin', '5000.00', 0, 'proof_27_1778510813.jpg', 'verified', 1, '2026-06-04 00:19:02', '2026-05-11 14:46:53'),
(98, 27, '', '2026-05-08', 'out', 'Pemasangan', 'Karung ', '20000.00', 0, 'proof_27_1778510829.jpg', 'verified', 1, '2026-06-04 00:19:10', '2026-05-11 14:47:09'),
(99, 27, '', '2026-05-08', 'out', 'Sample', 'Sample', '21000.00', 0, 'proof_27_1778510866.jpg', 'verified', 1, '2026-06-04 00:19:17', '2026-05-11 14:47:46'),
(100, 27, '', '2026-05-08', 'out', 'Pemasangan', 'Pasir', '125000.00', 0, 'proof_27_1778510876.jpg', 'verified', 1, '2026-06-04 00:19:25', '2026-05-11 14:47:56'),
(101, 27, '', '2026-05-09', 'out', 'Turun Barang', 'Lembur turun barang', '200000.00', 0, 'proof_27_1778510913.jpg', 'verified', 1, '2026-06-04 00:20:34', '2026-05-11 14:48:33'),
(102, 27, '', '2026-05-09', 'out', 'Ongkir Pemasangan', 'Ongkir pemasangan ', '200000.00', 0, 'proof_27_1778510929.jpg', 'verified', 1, '2026-06-04 00:20:42', '2026-05-11 14:48:49'),
(103, 27, '', '2026-05-09', 'out', 'Konsumsi', 'Yang makan darda minggu', '60000.00', 0, 'proof_27_1778510977.jpg', 'verified', 1, '2026-06-04 00:20:50', '2026-05-11 14:49:37'),
(104, 27, '', '2026-05-09', 'out', 'Pemasangan', 'Upah pemasangan Minggu ', '300000.00', 0, 'proof_27_1778510989.jpg', 'verified', 1, '2026-06-04 00:21:02', '2026-05-11 14:49:49'),
(105, 27, '', '2026-05-09', 'out', 'Pemasangan', 'Gojek pemasangan ', '115000.00', 0, 'proof_27_1778511036.jpg', 'verified', 1, '2026-06-04 00:21:12', '2026-05-11 14:50:36'),
(106, 27, '', '2026-05-10', 'out', 'Internet', 'Internet ', '43000.00', 0, 'proof_27_1778511080.jpg', 'verified', 1, '2026-06-04 05:34:58', '2026-05-11 14:51:20'),
(107, 27, '', '2026-05-10', 'out', 'Ongkir Pemasangan', 'Ongkir pemasangan ', '84000.00', 0, 'proof_27_1778511134.jpg', 'verified', 1, '2026-06-04 05:35:06', '2026-05-11 14:52:14'),
(108, 27, '', '2026-05-10', 'out', 'Konsumsi', 'Uang makan senin', '120000.00', 0, 'proof_27_1778511161.jpg', 'verified', 1, '2026-06-04 05:35:15', '2026-05-11 14:52:41'),
(109, 27, '', '2026-05-10', 'out', 'Konsumsi', 'Yang makan Selasa 3 oranh', '180000.00', 0, 'proof_27_1778511221.jpg', 'verified', 1, '2026-06-04 05:35:22', '2026-05-11 14:53:41'),
(110, 27, '', '2026-05-10', 'out', 'Pemasangan', 'Upah pemasangan Senin ', '100000.00', 0, 'proof_27_1778511227.jpg', 'verified', 1, '2026-06-04 05:35:36', '2026-05-11 14:53:47'),
(111, 27, '', '2026-05-10', 'out', 'Admin', 'Admin', '5000.00', 0, 'proof_27_1778511272.jpg', 'verified', 1, '2026-06-04 05:35:41', '2026-05-11 14:54:32'),
(112, 27, '', '2026-05-11', 'in', 'Penambahan Saldo', 'Penambahan saldo ', '2500000.00', 0, 'proof_27_1778511297.jpg', 'verified', 1, '2026-06-04 05:36:07', '2026-05-11 14:54:57'),
(113, 27, '', '2026-05-11', 'out', 'Internet', 'Wifi', '274950.00', 0, 'proof_27_1778511330.jpg', 'verified', 1, '2026-06-04 05:36:28', '2026-05-11 14:55:30'),
(114, 27, '', '2026-05-11', 'out', 'Lembur', 'Lembur ', '25000.00', 0, 'proof_27_1778511350.jpg', 'verified', 1, '2026-06-04 05:36:34', '2026-05-11 14:55:50'),
(115, 24, 'Yogyakarta', '2026-05-02', 'out', 'Ongkir Barang', 'Ongkir barang', '206000.00', 0, 'proof_24_1778511669.jpg', 'verified', 1, '2026-06-04 00:05:11', '2026-05-11 15:01:09'),
(116, 24, 'Yogyakarta', '2026-05-03', 'out', 'Konsumsi', 'Uang makan 2 hari 3 orang ', '360000.00', 0, 'proof_24_1778511723.jpg', 'verified', 1, '2026-06-04 00:05:49', '2026-05-11 15:02:03'),
(117, 24, 'Yogyakarta', '2026-05-04', 'out', 'Listrik & Air', 'Listrik ', '231180.00', 0, 'proof_24_1778511764.jpg', 'verified', 1, '2026-06-04 00:06:50', '2026-05-11 15:02:44'),
(118, 24, 'Yogyakarta', '2026-05-04', 'out', 'Internet', 'Wifi', '268400.00', 0, 'proof_24_1778511804.jpg', 'verified', 1, '2026-06-04 00:07:20', '2026-05-11 15:03:24'),
(120, 24, 'Yogyakarta', '2026-05-04', 'out', 'Listrik & Air', 'PDAM', '71200.00', 0, 'proof_24_1778512085.jpg', 'verified', 1, '2026-06-04 00:07:41', '2026-05-11 15:08:05'),
(121, 24, 'Yogyakarta', '2026-05-04', 'out', 'Service Motor', 'Service motor ', '150000.00', 0, 'proof_24_1778512110.jpg', 'verified', 1, '2026-06-04 00:07:51', '2026-05-11 15:08:30'),
(122, 24, 'Yogyakarta', '2026-05-05', 'out', 'Konsumsi', 'Yang makan 2 hari 3 oranh', '360000.00', 0, 'proof_24_1778512153.jpg', 'verified', 1, '2026-06-04 00:09:54', '2026-05-11 15:09:13'),
(123, 24, 'Yogyakarta', '2026-05-05', 'out', 'Konsumsi', 'Galon', '6000.00', 0, 'proof_24_1778512172.jpg', 'verified', 1, '2026-06-04 00:10:01', '2026-05-11 15:09:32'),
(124, 24, 'Yogyakarta', '2026-05-05', 'out', 'Ongkir Barang', 'Printing', '2000.00', 0, 'proof_24_1778512222.jpg', 'verified', 1, '2026-06-04 00:10:09', '2026-05-11 15:10:22'),
(125, 24, 'Yogyakarta', '2026-05-06', 'out', 'Ongkir Barang', 'Ongkir barang ', '400000.00', 0, 'proof_24_1778512250.jpg', 'verified', 1, '2026-06-04 00:11:19', '2026-05-11 15:10:50'),
(126, 24, 'Yogyakarta', '2026-05-07', 'out', 'Internet', 'Internet cctv', '77990.00', 0, 'proof_24_1778512301.jpg', 'verified', 1, '2026-06-04 00:17:02', '2026-05-11 15:11:41'),
(127, 24, 'Yogyakarta', '2026-05-07', 'out', 'Ongkir Barang', 'Ongkir bogor', '232500.00', 0, 'proof_24_1778512325.jpg', 'verified', 1, '2026-06-04 00:17:12', '2026-05-11 15:12:05'),
(128, 24, 'Yogyakarta', '2026-05-07', 'out', 'Konsumsi', 'Uang makan Jumat 3 orang ', '180000.00', 0, 'proof_24_1778512371.jpg', 'verified', 1, '2026-06-04 00:17:24', '2026-05-11 15:12:51'),
(129, 24, 'Yogyakarta', '2026-05-07', 'out', 'Transportasi', 'bensin', '35000.00', 0, 'proof_24_1778512390.jpg', 'verified', 1, '2026-06-04 00:17:32', '2026-05-11 15:13:10'),
(130, 24, 'Yogyakarta', '2026-05-08', 'in', 'Penambahan Saldo', 'Penambahan saldo', '2500000.00', 0, 'proof_24_1778512435.jpg', 'verified', 1, '2026-06-04 00:19:33', '2026-05-11 15:13:55'),
(131, 24, 'Yogyakarta', '2026-05-08', 'out', 'Pemasangan', 'Upah bongkar 2 orang', '500000.00', 0, 'proof_24_1778512472.jpg', 'verified', 1, '2026-06-04 00:19:51', '2026-05-11 15:14:32'),
(132, 24, 'Yogyakarta', '2026-05-08', 'out', 'Konsumsi', 'Uang makan 1 oranh', '60000.00', 0, 'proof_24_1778512534.jpg', 'verified', 1, '2026-06-04 00:20:03', '2026-05-11 15:15:34'),
(133, 24, 'Yogyakarta', '2026-05-08', 'out', 'Ongkir Barang', 'ongkir barang ', '27000.00', 0, 'proof_24_1778512560.jpg', 'verified', 1, '2026-06-04 00:20:11', '2026-05-11 15:16:00'),
(134, 24, 'Yogyakarta', '2026-05-09', 'out', 'Konsumsi', 'Uang makan Minggu 1 orang', '60000.00', 0, 'proof_24_1778512608.jpg', 'verified', 1, '2026-06-04 05:34:27', '2026-05-11 15:16:48'),
(135, 24, 'Yogyakarta', '2026-05-09', 'out', 'Transportasi', 'Bensin ', '40000.00', 0, 'proof_24_1778512637.jpg', 'verified', 1, '2026-06-04 05:34:33', '2026-05-11 15:17:17'),
(136, 24, 'Yogyakarta', '2026-05-09', 'out', 'Pemasangan', 'Tiner dll', '205500.00', 0, 'proof_24_1778512684.jpg', 'verified', 1, '2026-06-04 05:34:45', '2026-05-11 15:18:04'),
(137, 24, 'Yogyakarta', '2026-05-10', 'out', 'Konsumsi', 'Uang makan Senin Selasa 3 orang ', '360000.00', 0, 'proof_24_1778512716.jpg', 'verified', 1, '2026-06-04 05:35:58', '2026-05-11 15:18:36'),
(138, 27, 'Surabaya', '2026-05-12', 'out', 'Listrik & Air', 'token listrik', '206000.00', 0, 'proof_27_1780526386.png', 'verified', 1, '2026-06-04 19:36:31', '2026-06-03 22:39:46'),
(139, 27, 'Surabaya', '2026-05-12', 'out', 'Perlengkapan/Peralatan Gudang', 'tali rapia', '46000.00', 0, 'proof_27_1780526442.png', 'verified', 1, '2026-06-04 19:36:37', '2026-06-03 22:40:42'),
(140, 27, 'Surabaya', '2026-05-12', 'out', 'Konsumsi', 'uang makan rabu 2 orang\r\n', '120000.00', 0, 'proof_27_1780526479.png', 'verified', 1, '2026-06-04 19:36:43', '2026-06-03 22:41:19'),
(141, 27, 'Surabaya', '2026-05-12', 'out', 'Konsumsi', 'uang makan kamis 3 orang', '180000.00', 0, 'proof_27_1780526511.png', 'verified', 1, '2026-06-04 19:36:49', '2026-06-03 22:41:51'),
(142, 27, 'Surabaya', '2026-05-12', 'out', 'Transportasi', 'bensin', '35000.00', 0, 'proof_27_1780526542.png', 'verified', 1, '2026-06-04 19:36:55', '2026-06-03 22:42:22'),
(143, 27, 'Surabaya', '2026-05-12', 'out', 'Pemasangan', 'upah pemasangan', '140000.00', 0, 'proof_27_1780526578.png', 'verified', 1, '2026-06-04 19:37:08', '2026-06-03 22:42:58'),
(144, 27, 'Surabaya', '2026-05-12', 'out', 'Admin', 'admin', '5000.00', 0, 'proof_27_1780526606.png', 'verified', 1, '2026-06-04 19:37:15', '2026-06-03 22:43:26'),
(145, 27, 'Surabaya', '2026-05-13', 'out', 'Ongkir Pemasangan', 'ongkir pemasangan', '91000.00', 0, 'proof_27_1780526649.png', 'verified', 1, '2026-06-04 19:37:23', '2026-06-03 22:44:09'),
(146, 27, 'Surabaya', '2026-05-14', 'out', 'Konsumsi', 'uang makan', '360000.00', 0, 'proof_27_1780526695.png', 'verified', 1, '2026-06-04 19:37:30', '2026-06-03 22:44:55'),
(147, 27, 'Surabaya', '2026-05-14', 'out', 'Sample', 'ongkir sample', '18000.00', 0, 'proof_27_1780526726.png', 'verified', 1, '2026-06-04 19:37:38', '2026-06-03 22:45:26'),
(148, 27, 'Surabaya', '2026-05-14', 'out', 'Admin', 'admin', '5000.00', 0, 'proof_27_1780526752.png', 'verified', 1, '2026-06-04 19:37:47', '2026-06-03 22:45:52'),
(149, 27, 'Surabaya', '2026-05-15', 'out', 'Listrik & Air', 'otomatis sanyo', '71963.00', 0, 'proof_27_1780526817.png', 'verified', 1, '2026-06-04 19:37:58', '2026-06-03 22:46:57'),
(150, 27, 'Surabaya', '2026-05-15', 'out', 'Sample', 'ongkir sample', '40000.00', 0, 'proof_27_1780526845.png', 'verified', 1, '2026-06-04 19:39:12', '2026-06-03 22:47:25'),
(151, 27, 'Surabaya', '2026-05-15', 'out', 'Ongkir Barang', 'ongkir barang', '37000.00', 0, 'proof_27_1780526879.png', 'verified', 1, '2026-06-04 19:39:19', '2026-06-03 22:47:59'),
(152, 27, 'Surabaya', '2026-05-16', 'out', 'Ongkir Barang', 'ongkir barang', '36000.00', 0, 'proof_27_1780526906.png', 'verified', 1, '2026-06-04 19:39:26', '2026-06-03 22:48:26'),
(153, 27, 'Surabaya', '2026-05-16', 'in', 'Penambahan Saldo', 'penambahan saldo surabay', '5000000.00', 0, 'proof_27_1780526952.png', 'verified', 1, '2026-06-04 19:39:33', '2026-06-03 22:49:12'),
(154, 27, 'Surabaya', '2026-05-17', 'out', 'Konsumsi', 'uang makan senin selasa 3 orang', '360000.00', 0, 'proof_27_1780526998.png', 'verified', 1, '2026-06-04 19:39:42', '2026-06-03 22:49:58'),
(155, 27, 'Surabaya', '2026-05-17', 'out', 'Survey', 'upah survey 16 mei', '50000.00', 0, 'proof_27_1780527035.png', 'verified', 1, '2026-06-04 19:39:49', '2026-06-03 22:50:35'),
(156, 27, 'Surabaya', '2026-05-17', 'out', 'Transportasi', 'bensin', '35000.00', 0, 'proof_27_1780527081.png', 'verified', 1, '2026-06-04 19:39:57', '2026-06-03 22:51:22'),
(157, 27, 'Surabaya', '2026-05-17', 'out', 'Sample', 'ongkir sample', '18000.00', 0, 'proof_27_1780527112.png', 'verified', 1, '2026-06-04 19:40:02', '2026-06-03 22:51:52'),
(158, 27, 'Surabaya', '2026-05-17', 'out', 'Admin', 'admin', '7500.00', 0, 'proof_27_1780527142.png', 'verified', 1, '2026-06-04 19:37:01', '2026-06-03 22:52:22'),
(159, 27, 'Surabaya', '2026-05-17', 'out', 'Perlengkapan/Peralatan Gudang', '2 sabun cuci piring', '25000.00', 0, 'proof_27_1780527177.png', 'verified', 1, '2026-06-04 19:40:06', '2026-06-03 22:52:57'),
(160, 27, 'Surabaya', '2026-05-17', 'out', 'Perlengkapan/Peralatan Gudang', 'tisu', '20000.00', 0, 'proof_27_1780527203.png', 'verified', 1, '2026-06-04 19:40:33', '2026-06-03 22:53:23'),
(161, 27, 'Surabaya', '2026-05-17', 'out', 'Konsumsi', 'beras', '80000.00', 0, 'proof_27_1780527229.png', 'verified', 1, '2026-06-04 19:40:39', '2026-06-03 22:53:49'),
(162, 27, 'Surabaya', '2026-05-18', 'out', 'Perlengkapan/Peralatan Gudang', 'rice cooker', '265128.00', 0, 'proof_27_1780527266.png', 'verified', 1, '2026-06-04 19:40:44', '2026-06-03 22:54:26'),
(163, 27, 'Surabaya', '2026-05-18', 'out', 'Perlengkapan/Peralatan Gudang', 'holder hp', '25579.00', 0, 'proof_27_1780527293.png', 'verified', 1, '2026-06-04 19:40:50', '2026-06-03 22:54:53'),
(164, 27, 'Surabaya', '2026-05-18', 'out', 'Perlengkapan/Peralatan Gudang', 'teko listrik', '76425.00', 0, 'proof_27_1780527323.png', 'verified', 1, '2026-06-04 19:40:54', '2026-06-03 22:55:23'),
(165, 27, 'Surabaya', '2026-05-18', 'out', 'Admin', 'admin', '2000.00', 0, 'proof_27_1780527352.png', 'verified', 1, '2026-06-04 19:41:00', '2026-06-03 22:55:52'),
(166, 27, 'Surabaya', '2026-05-18', 'out', 'Iuran Perumahan', 'pajak gudang', '347840.00', 0, 'proof_27_1780527400.png', 'verified', 1, '2026-06-04 19:41:13', '2026-06-03 22:56:40'),
(167, 27, 'Surabaya', '2026-05-18', 'out', 'Ongkir Barang', 'ongkir barang', '85000.00', 0, 'proof_27_1780527437.png', 'verified', 1, '2026-06-04 19:41:17', '2026-06-03 22:57:17'),
(168, 24, 'Yogyakarta', '2026-05-11', 'out', 'Ongkir Pemasangan', 'ongkir pemasangan', '68000.00', 0, 'proof_24_1780577024.png', 'verified', NULL, NULL, '2026-06-04 12:43:44'),
(169, 24, 'Yogyakarta', '2026-05-12', 'out', 'Pemasangan', 'uang pemasangan sabtu', '140000.00', 0, 'proof_24_1780577061.png', 'verified', NULL, NULL, '2026-06-04 12:44:21'),
(170, 24, 'Yogyakarta', '2026-05-12', 'out', 'Konsumsi', 'uang makan rabu 2 orang', '120000.00', 0, 'proof_24_1780577100.png', 'verified', NULL, NULL, '2026-06-04 12:45:00'),
(171, 24, 'Yogyakarta', '2026-05-12', 'out', 'Konsumsi', 'uang makan kamis 3 orang', '180000.00', 0, 'proof_24_1780577133.png', 'verified', NULL, NULL, '2026-06-04 12:45:33'),
(172, 24, 'Yogyakarta', '2026-05-13', 'out', 'Ongkir Pemasangan', 'ongkir pemasangan', '125000.00', 0, 'proof_24_1780577167.png', 'verified', NULL, NULL, '2026-06-04 12:46:07'),
(173, 24, 'Yogyakarta', '2026-06-13', 'out', 'Pemasangan', 'upah pemasangan rabu', '200000.00', 0, 'proof_24_1780577197.png', 'verified', NULL, NULL, '2026-06-04 12:46:37'),
(174, 24, 'Yogyakarta', '2026-05-14', 'out', 'Konsumsi', 'upah makan jumat 3 orang', '180000.00', 0, 'proof_24_1780577284.png', 'verified', NULL, NULL, '2026-06-04 12:48:04'),
(175, 24, 'Yogyakarta', '2026-05-14', 'out', 'Konsumsi', 'uang makan sabtu 2 orang', '120000.00', 0, 'proof_24_1780577332.png', 'verified', NULL, NULL, '2026-06-04 12:48:52'),
(176, 24, 'Yogyakarta', '2026-05-14', 'out', 'Konsumsi', 'uang makan minggu 1 orang', '60000.00', 0, 'proof_24_1780577394.png', 'verified', NULL, NULL, '2026-06-04 12:49:54'),
(177, 24, 'Yogyakarta', '2026-05-14', 'out', 'Konsumsi', 'beras', '74500.00', 0, 'proof_24_1780577427.png', 'verified', NULL, NULL, '2026-06-04 12:50:27'),
(178, 24, 'Yogyakarta', '2026-05-14', 'out', 'Perlengkapan/Peralatan Gudang', 'vixal', '18300.00', 0, 'proof_24_1780577475.png', 'verified', NULL, NULL, '2026-06-04 12:51:15'),
(179, 24, 'Yogyakarta', '2026-05-14', 'out', 'Perlengkapan/Peralatan Gudang', 'soklin lantai', '11200.00', 0, 'proof_24_1780577507.png', 'verified', NULL, NULL, '2026-06-04 12:51:47'),
(180, 24, 'Yogyakarta', '2026-05-14', 'out', 'Perlengkapan/Peralatan Gudang', 'mama lemon', '11000.00', 0, 'proof_24_1780577535.png', 'verified', NULL, NULL, '2026-06-04 12:52:15'),
(181, 24, 'Yogyakarta', '2026-05-14', 'out', 'Ongkir Barang', 'ongkir barang\r\n', '19000.00', 0, 'proof_24_1780577570.png', 'verified', NULL, NULL, '2026-06-04 12:52:50'),
(182, 24, 'Yogyakarta', '2026-05-16', 'out', 'Ongkir Barang', 'ongkir barang', '162000.00', 0, 'proof_24_1780577618.png', 'verified', NULL, NULL, '2026-06-04 12:53:38'),
(183, 24, 'Yogyakarta', '2026-05-16', 'in', 'Penambahan Saldo', 'penambahan saldo jogja', '2500000.00', 0, 'proof_24_1780577656.png', 'verified', NULL, NULL, '2026-06-04 12:54:16'),
(184, 24, 'Yogyakarta', '2026-05-17', 'out', 'Konsumsi', 'uang makan senin selasa 3 orang', '360000.00', 0, 'proof_24_1780577695.png', 'verified', NULL, NULL, '2026-06-04 12:54:55'),
(185, 24, 'Yogyakarta', '2026-05-17', 'out', 'Turun Barang', 'lembur turun barang', '200000.00', 0, 'proof_24_1780577734.png', 'verified', NULL, NULL, '2026-06-04 12:55:34'),
(186, 24, 'Yogyakarta', '2026-05-17', 'out', 'Transportasi', 'bensin', '40000.00', 0, 'proof_24_1780577764.png', 'verified', NULL, NULL, '2026-06-04 12:56:04'),
(187, 24, 'Yogyakarta', '2026-05-17', 'out', 'Turun Barang', 'parkir truk', '20000.00', 0, 'proof_24_1780577794.png', 'verified', NULL, NULL, '2026-06-04 12:56:34'),
(188, 24, 'Yogyakarta', '2026-06-17', 'out', 'Turun Barang', 'pickup turun barang', '270000.00', 0, 'proof_24_1780577852.png', 'verified', NULL, NULL, '2026-06-04 12:57:32'),
(189, 24, 'Yogyakarta', '2026-05-18', 'out', 'Ongkir Barang', 'ongkir barang', '31000.00', 0, 'proof_24_1780577897.png', 'verified', NULL, NULL, '2026-06-04 12:58:17'),
(190, 24, 'Yogyakarta', '2026-05-18', 'out', 'Lembur', 'lembur', '25000.00', 0, 'proof_24_1780577921.png', 'verified', NULL, NULL, '2026-06-04 12:58:41'),
(191, 24, 'Yogyakarta', '2026-05-18', 'out', 'Sample', 'ongkir sample', '18000.00', 0, 'proof_24_1780577958.png', 'verified', NULL, NULL, '2026-06-04 12:59:18'),
(192, 24, 'Yogyakarta', '2026-05-19', 'out', 'Konsumsi', 'uang makan 2 hari 3 orang', '360000.00', 0, 'proof_24_1780577993.png', 'verified', NULL, NULL, '2026-06-04 12:59:53'),
(193, 24, 'Yogyakarta', '2026-05-19', 'out', 'Sample', 'ongkir sample', '20000.00', 0, 'proof_24_1780578050.png', 'verified', NULL, NULL, '2026-06-04 13:00:51'),
(194, 24, 'Yogyakarta', '2026-05-22', 'out', 'Konsumsi', 'uang makan jumat 3 orang sabtu 1 orang minggu 1 orang', '300000.00', 0, 'proof_24_1780578124.png', 'verified', NULL, NULL, '2026-06-04 13:02:04'),
(195, 24, 'Yogyakarta', '2026-05-22', 'out', 'Pemasangan', 'upah pemasangan sabtu 1 orang', '200000.00', 0, 'proof_24_1780578157.png', 'verified', NULL, NULL, '2026-06-04 13:02:38'),
(196, 24, 'Yogyakarta', '2026-05-22', 'out', 'Transportasi', 'bensin', '35000.00', 0, 'proof_24_1780578180.png', 'verified', NULL, NULL, '2026-06-04 13:03:00'),
(197, 24, 'Yogyakarta', '2026-05-22', 'out', 'Admin', 'admin', '2000.00', 0, 'proof_24_1780578206.png', 'verified', NULL, NULL, '2026-06-04 13:03:26'),
(198, 1, 'Pusat', '2026-06-05', 'in', 'Penambahan Saldo', 'penambahan saldo', '2500000.00', 0, 'proof_1_1780629059.png', 'verified', NULL, NULL, '2026-06-05 03:10:59'),
(199, 28, '', '2026-06-05', 'out', 'Pemasangan', 'upah pemasangan 1 orang', '200000.00', 0, 'proof_28_1780629257.png', 'verified', NULL, NULL, '2026-06-05 03:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('super_admin','admin','pj_gudang','tup','pimpinan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `role`, `branch`, `created_at`) VALUES
(1, 'super_admin', '$2y$10$PgWqfuuuehj2qvBK8.XwPOSFYqH3G7O2i7V5PLkko8TCvc/Lxol4e', 'Administrator IT', 'super_admin', 'Pusat', '2025-11-30 11:12:02'),
(11, 'pj_semarang', '$2y$10$uHFMoKLHMA7FaVDQa10gleepyVnNtpxBtPA2DGkdyDl2tGQV8/puW', 'Editia Novianti', 'pj_gudang', 'Semarang', '2026-04-15 14:21:58'),
(12, 'pj_bogor', '$2y$10$jhK8dy6HP41ZntGeQpUG5.WMSaeZAoiiMrMBKVGikgeF8LIv4c1mq', 'Alda Risma', 'pj_gudang', 'Bogor', '2026-04-15 14:22:17'),
(16, 'Umum', '$2y$10$RpN2Ztp0eEDUzi569JQ0GuL6RJEGbH4lhULxH8FXl7ZuE/MP7tTEK', 'Staff', 'pj_gudang', 'Bogor', '2026-04-15 14:23:55'),
(20, 'Direktur ', '$2y$10$lDOwxGyyTGhYKRolE14rUe55mlJ2WXmjbkHHGTkuRrTvobs5mXD6W', 'Samsuri Yahya', 'super_admin', 'Pusat', '2026-04-16 02:44:57'),
(21, 'Manager Keuangan', '$2y$10$iP7C47ZpNH9YPnybpGQqvOp/35db7BakaIQBKSVFppVxfBilg9fq.', 'Lutfiyah', 'super_admin', 'Pusat', '2026-04-16 02:46:22'),
(22, 'audit', '$2y$10$Z0UONSOxWbJDuiTepvfgqel3hYE5b66/ynM7UK7BDqq7bxHfJxXMu', 'Lutfiyah', 'tup', 'Pusat', '2026-05-03 13:46:48'),
(23, 'pimpinan', '$2y$10$PfZw8I1A9iL5YIkOw.w2jO.ABnWPVX2zXfxpibeQIrGlVAggtOURa', 'Samsuri Yahya', 'pimpinan', '', '2026-05-03 13:50:36'),
(24, 'pj_jogja', '$2y$10$dMJiQN4cb1dBxmRm2rtOVuSWGTTu2K41FohMWNnaC6v1wDZa0V652', 'Dea Puspita', 'pj_gudang', 'Yogyakarta', '2026-05-11 08:54:06'),
(25, 'pj_medan', '$2y$10$R6OMOg/pgOz3fNApSvQ5Tu/kK4BwfZEpWBm7v65d0.LNgYbo.Lnpe', 'Juleha', 'pj_gudang', 'Medan', '2026-05-11 08:54:53'),
(26, 'pj_bali', '$2y$10$2cBhhnaBWPJAAZ/QWO/F.uJ35ljebIuXHccskloZbEXCHiq4IYMtK', 'Syalita Sukma', 'pj_gudang', 'Bali', '2026-05-11 08:55:13'),
(27, 'pj_surabaya', '$2y$10$VNbOx5Fe1hjdQwoB8YbUb.gvPR9GPXTM6IggiyBIXaWoYvtrw0Nya', 'Dea Puspita', 'pj_gudang', 'Surabaya', '2026-05-11 08:56:21'),
(28, 'pj_bandung', '$2y$10$n2fzNMmELNh1s/hxRU2nkusm1J5RWT4qZyCzXPdIa6V.JhUoDab8e', 'Editia Novianti', 'pj_gudang', '', '2026-05-11 08:56:51'),
(29, 'admin', '$2y$10$EmZPUNNselIaM2.M1O5PAuchkuTjNIgMPprjtXWP1fOeuCscMnGDK', 'admin', 'admin', '', '2026-08-18 03:52:31');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category_groups`
--
ALTER TABLE `category_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
