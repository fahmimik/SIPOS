-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2020 at 11:29 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_sipos`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) NOT NULL,
  `child_id` bigint(20) NOT NULL,
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1: baru, 2: naik, 3: turun, 0: tidak hadir',
  `age` int(11) NOT NULL COMMENT 'dalam bulan',
  `vitamin_a` tinyint(1) NOT NULL DEFAULT 0,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `breast_milks`
--

CREATE TABLE `breast_milks` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `breast_milks`
--

INSERT INTO `breast_milks` (`id`, `name`) VALUES
(1, 'E0'),
(2, 'E1'),
(3, 'E2'),
(4, 'E3'),
(5, 'E4'),
(6, 'E5'),
(7, 'E6');

-- --------------------------------------------------------

--
-- Table structure for table `breast_milk_activities`
--

CREATE TABLE `breast_milk_activities` (
  `activity_id` bigint(20) NOT NULL,
  `breast_milk_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `childrens`
--

CREATE TABLE `childrens` (
  `id` bigint(20) NOT NULL,
  `family_id` bigint(20) NOT NULL,
  `religion_id` bigint(20) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` datetime NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '1: perempuan, 2: laki2',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `childrens`
--

INSERT INTO `childrens` (`id`, `family_id`, `religion_id`, `name`, `birth_place`, `birth_date`, `gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, 'mamat mager sekali nemen sangat', 'Madura', '2019-02-06 01:01:48', 1, '2020-04-13 23:40:14', '2020-04-14 01:01:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contraceptions`
--

CREATE TABLE `contraceptions` (
  `id` bigint(20) NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `id` bigint(20) NOT NULL,
  `mother_id` bigint(20) NOT NULL,
  `father_id` bigint(20) NOT NULL,
  `married_at` datetime NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`id`, `mother_id`, `father_id`, `married_at`, `address`, `no_kk`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 4, 3, '2019-02-05 01:01:07', 'Diatas Awan Ada Langit', '350101010101010101', '2020-04-12 23:30:18', '2020-04-14 01:01:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `immunizations`
--

CREATE TABLE `immunizations` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `immunizations`
--

INSERT INTO `immunizations` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BCG', NULL, NULL, NULL),
(2, 'DPT/HB1', NULL, NULL, NULL),
(3, 'DPT/HB2', NULL, NULL, NULL),
(4, 'DPT/HB3', NULL, NULL, NULL),
(5, 'Polio 1', NULL, NULL, NULL),
(6, 'Polio 2', NULL, NULL, NULL),
(7, 'Polio 3', NULL, NULL, NULL),
(8, 'Polio 4', NULL, NULL, NULL),
(9, 'Campak', NULL, NULL, NULL),
(10, 'DPT/HB/HIB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `immunization_activities`
--

CREATE TABLE `immunization_activities` (
  `activity_id` bigint(20) NOT NULL,
  `immunization_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` bigint(20) NOT NULL,
  `religion_id` bigint(20) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '1: perempuan, 2: laki2',
  `nik` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` datetime NOT NULL,
  `birth_place` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `religion_id`, `name`, `gender`, `nik`, `job`, `birth_date`, `birth_place`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 1, 'tesy', 2, '54331235346', 'Pengangguran', '1990-01-17 01:01:07', 'Jakarta', '2020-04-12 23:30:18', '2020-04-14 01:01:07', NULL),
(4, 1, 'tretre', 1, '666666666', 'ART', '1992-04-07 01:01:07', 'Bandung', '2020-04-12 23:30:18', '2020-04-14 01:01:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parent_notes`
--

CREATE TABLE `parent_notes` (
  `id` bigint(20) NOT NULL,
  `family_id` bigint(20) NOT NULL,
  `lila` double NOT NULL,
  `savings` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'punya tabungan atau tidak',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_note_contraceptions`
--

CREATE TABLE `parent_note_contraceptions` (
  `parent_note_id` bigint(20) NOT NULL,
  `contraception_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pregnants`
--

CREATE TABLE `pregnants` (
  `id` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `visit_at` datetime NOT NULL,
  `number_of_pregnant` int(11) NOT NULL,
  `lila` double NOT NULL,
  `weight` double NOT NULL,
  `pregnant_age` int(11) NOT NULL COMMENT 'dalam minggu',
  `blood_pill` int(11) NOT NULL DEFAULT 0,
  `tetanus_immunization` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pregnants`
--

INSERT INTO `pregnants` (`id`, `parent_id`, `visit_at`, `number_of_pregnant`, `lila`, `weight`, `pregnant_age`, `blood_pill`, `tetanus_immunization`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, '2020-04-10 15:38:39', 2, 25, 50, 2, 0, 'T1', '2020-04-14 15:38:39', '2020-04-14 15:38:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `name`) VALUES
(1, 'Islam'),
(2, 'Kristen'),
(3, 'Katholik'),
(4, 'Hindu'),
(5, 'Budha');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `name`) VALUES
(1, 'admin', 'Admin'),
(2, 'bidan', 'Bidan'),
(3, 'kader', 'Kader');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 1, '$2y$12$uks2djVGzhTM5s4CDHkUK.5/Cu3Pr10dFDxdMm0xFXbe7iSkVSDEC', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_id` (`child_id`);

--
-- Indexes for table `breast_milks`
--
ALTER TABLE `breast_milks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breast_milk_activities`
--
ALTER TABLE `breast_milk_activities`
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `breast_milk_id` (`breast_milk_id`);

--
-- Indexes for table `childrens`
--
ALTER TABLE `childrens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `family_id` (`family_id`),
  ADD KEY `religion_id` (`religion_id`);

--
-- Indexes for table `contraceptions`
--
ALTER TABLE `contraceptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`id`),
  ADD KEY `father_id` (`father_id`),
  ADD KEY `mother_id` (`mother_id`);

--
-- Indexes for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `immunization_activities`
--
ALTER TABLE `immunization_activities`
  ADD KEY `activity_id` (`activity_id`),
  ADD KEY `immunization_id` (`immunization_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `religion_id` (`religion_id`);

--
-- Indexes for table `parent_notes`
--
ALTER TABLE `parent_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `family_id` (`family_id`);

--
-- Indexes for table `parent_note_contraceptions`
--
ALTER TABLE `parent_note_contraceptions`
  ADD KEY `contraception_id` (`contraception_id`),
  ADD KEY `parent_note_id` (`parent_note_id`);

--
-- Indexes for table `pregnants`
--
ALTER TABLE `pregnants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `breast_milks`
--
ALTER TABLE `breast_milks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `childrens`
--
ALTER TABLE `childrens`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contraceptions`
--
ALTER TABLE `contraceptions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `immunizations`
--
ALTER TABLE `immunizations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parent_notes`
--
ALTER TABLE `parent_notes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pregnants`
--
ALTER TABLE `pregnants`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `childrens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `breast_milk_activities`
--
ALTER TABLE `breast_milk_activities`
  ADD CONSTRAINT `breast_milk_activities_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `breast_milk_activities_ibfk_2` FOREIGN KEY (`breast_milk_id`) REFERENCES `breast_milks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `childrens`
--
ALTER TABLE `childrens`
  ADD CONSTRAINT `childrens_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `childrens_ibfk_2` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `families`
--
ALTER TABLE `families`
  ADD CONSTRAINT `families_ibfk_1` FOREIGN KEY (`father_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `families_ibfk_2` FOREIGN KEY (`mother_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `immunization_activities`
--
ALTER TABLE `immunization_activities`
  ADD CONSTRAINT `immunization_activities_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `immunization_activities_ibfk_2` FOREIGN KEY (`immunization_id`) REFERENCES `immunizations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`religion_id`) REFERENCES `religions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent_notes`
--
ALTER TABLE `parent_notes`
  ADD CONSTRAINT `parent_notes_ibfk_1` FOREIGN KEY (`family_id`) REFERENCES `families` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent_note_contraceptions`
--
ALTER TABLE `parent_note_contraceptions`
  ADD CONSTRAINT `parent_note_contraceptions_ibfk_1` FOREIGN KEY (`contraception_id`) REFERENCES `contraceptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parent_note_contraceptions_ibfk_2` FOREIGN KEY (`parent_note_id`) REFERENCES `parent_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pregnants`
--
ALTER TABLE `pregnants`
  ADD CONSTRAINT `pregnants_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
