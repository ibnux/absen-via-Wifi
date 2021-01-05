-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2021 at 10:38 AM
-- Server version: 8.0.13
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_absen`
--

CREATE TABLE `t_absen` (
  `tanggal_absen` date NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `keterangan` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_absen`
--

INSERT INTO `t_absen` (`tanggal_absen`, `user_id`, `name`, `jam_masuk`, `jam_keluar`, `keterangan`) VALUES
('2020-03-11', 'ibnu.maksum', 'Ibnu Maksum', '12:04:10', '12:09:40', 'WIFI'),
('2020-03-11', 'rudi.maksum', 'Rudi Maksum', '15:14:47', '15:43:20', 'WIFI');

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `user_id` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `user_mac` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `date_added` datetime NOT NULL,
  `last_check` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`user_id`, `user_mac`, `date_added`, `last_check`) VALUES
('ibnu.maksum', '23', '2020-03-11 12:03:15', '2020-03-11 12:09:40'),
('rudi.maksum', '00:23:12:DE:44', '2020-03-11 12:11:46', '2020-03-11 15:43:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_absen`
--
ALTER TABLE `t_absen`
  ADD PRIMARY KEY (`tanggal_absen`,`user_id`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`user_id`,`user_mac`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
