-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 18, 2024 at 03:12 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pt_len`
--

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` bigint NOT NULL,
  `nama_lokasi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `negara` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama_lokasi`, `negara`, `provinsi`, `kota`, `created_at`) VALUES
(1, 'Gudang Utama', 'Indonesia', 'Jawa Timur', 'Surabaya', '2024-08-18 07:40:39'),
(2, 'Kantor Cabang', 'Indonesia', 'Jawa Tengah', 'Semarang', '2024-08-18 07:38:02'),
(12, 'Kantor Operasi1', 'indonesia', 'Jawa Barat', 'Cirebon', '2024-08-18 15:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE `proyek` (
  `id` bigint NOT NULL,
  `nama_proyek` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `client` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `pimpinan_proyek` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id`, `nama_proyek`, `client`, `tgl_mulai`, `tgl_selesai`, `pimpinan_proyek`, `keterangan`, `created_at`) VALUES
(1, 'Proyek Baru', 'Albert siahaan', '2024-08-20 00:00:00', '2024-09-20 00:00:00', 'Rangga', 'Proyek penting', '2024-08-18 07:38:02'),
(5, 'Proyek ABC', 'Salman Alfas', '2024-08-20 10:00:00', '2024-08-30 10:00:00', 'Rangga', 'Proyek besar', '2024-08-18 14:51:17'),
(6, 'Proyek ABC', 'Winda Nurul', '2024-08-20 10:00:00', '2024-08-30 10:00:00', 'Rangga', 'Proyek besar', '2024-08-18 14:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `proyek_lokasi`
--

CREATE TABLE `proyek_lokasi` (
  `id` bigint NOT NULL,
  `proyek_id` bigint NOT NULL,
  `lokasi_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proyek_lokasi`
--

INSERT INTO `proyek_lokasi` (`id`, `proyek_id`, `lokasi_id`, `created_at`) VALUES
(1, 1, 1, '2024-08-18 07:38:02'),
(2, 1, 2, '2024-08-18 07:38:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proyek_lokasi`
--
ALTER TABLE `proyek_lokasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proyek_id` (`proyek_id`),
  ADD KEY `lokasi_id` (`lokasi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `proyek_lokasi`
--
ALTER TABLE `proyek_lokasi`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `proyek_lokasi`
--
ALTER TABLE `proyek_lokasi`
  ADD CONSTRAINT `proyek_lokasi_ibfk_1` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id`),
  ADD CONSTRAINT `proyek_lokasi_ibfk_2` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
