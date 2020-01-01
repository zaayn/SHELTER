-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 31, 2019 at 02:05 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crmshelter`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_depan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_belakang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_id` int(10) UNSIGNED NOT NULL,
  `no_hp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rule` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `current_login_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `nama_depan`, `nama_belakang`, `email`, `area_id`, `no_hp`, `password`, `rule`, `remember_token`, `created_at`, `updated_at`, `last_login_at`, `current_login_at`) VALUES
('admin', 'admin', 'admin', 'admin@gmail.com', 3, '999', '$2y$10$bqP.QgUolREUU0SOIVQNieK5XwaOveX9yBR/OT8aIOCN2foRNfUXS', 'admin', 'JE4fXMvjbgi2turijci2NGmNbFJvoRUWsJ6wNPVEg7AK1F6tnwz33X3r5ifW', '2019-07-18 12:32:08', '2019-12-31 05:04:02', '2019-12-31 01:43:04', '2019-12-31 05:04:02'),
('direktur', 'direktur', 'direktur', 'direktur@gmail.com', 3, '33333', '$2y$10$f2aiEmthf50ML7w0Bvn25e6nbLuCqm.i7lon0y97dcnfGgTKN9gMS', 'direktur', NULL, '2019-07-18 12:34:41', '2019-12-16 04:36:47', '2019-12-16 03:17:01', '2019-12-16 04:36:47'),
('manager', 'manager', 'manager', 'manager@gmail.com', 4, '11111', '$2y$10$DCOKlC3JuZCFJB8JUXqLZuiwUHdAW55eTMX7eavRAzaCJv3tkpmY2', 'manager_crm', NULL, '2019-07-18 12:33:38', '2019-12-16 04:36:03', '2019-12-09 21:41:28', '2019-12-16 04:36:03'),
('managernoncrm', 'manager', 'non crm', 'managernoncrm@gmail.com', 3, '44444', '$2y$10$mX64rSgdLiHtAussF6yZ5ufa4pK6vPkvx78YZT.CrTte4VdV3ul42', 'manager_non_crm', NULL, '2019-07-18 12:34:08', '2019-12-16 04:36:26', '2019-12-09 21:43:38', '2019-12-16 04:36:26'),
('officer', 'officer', 'officer', 'officer@gmail.com', 5, '5555', '$2y$10$qt447SOMpsIDCsZOxNkrTewRGxREG7wkpfH/yu0zasie.xQjq.K6q', 'officer_crm', NULL, '2019-07-18 12:33:14', '2019-12-15 19:24:04', '2019-12-12 23:47:28', '2019-12-15 19:24:04'),
('Super Admin CRM', 'super', 'admin', 'superadmin@gmail.com', 1, '1000000', '$2y$10$IpUzRfUQsjZicf57jis5NuvvrLzv5u8BMZaN5cj6lj3tPgKauq1rW', 'superadmin', NULL, '2019-07-22 13:23:05', '2019-12-31 01:40:37', '2019-12-09 21:44:31', '2019-12-31 01:40:37'),
('officercrm', 'Lala', 'Luna', 'officer2@gmail.com', 2, '00999999', '$2y$10$rDmRM2saOuyhVsKGGZcRf.IbpyruMhWsCindEDnRCghVz8eHhhly2', 'officer_crm', NULL, '2019-12-31 01:42:08', '2019-12-31 01:42:08', NULL, NULL),
('officercrm-3', 'Sri', 'Lestari', 'officer3@gmail.com', 3, '0009993', '$2y$10$PYRw3IAFIXF.zq4vNkMhd.ATQ0nv4VDgSyg1pwJNx3ZYC11JAkaKS', 'officer_crm', NULL, '2019-12-31 01:42:57', '2019-12-31 01:42:57', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_wilayah_id_foreign` (`area_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
