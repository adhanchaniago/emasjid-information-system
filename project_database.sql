-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2018 at 02:37 PM
-- Server version: 10.1.24-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masjid_info_digital`
--


--
-- Table structure for table `masjid_scroll`
--

CREATE TABLE `masjid_scroll` (
  `scroll_id` int(10) NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `paparkan` enum('0','1') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `masjid_slider`
--

CREATE TABLE `masjid_slider` (
  `slider_id` int(10) NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `paparkan` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '0',
  `giliran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `masjid_umum`
--

CREATE TABLE `masjid_umum` (
  `umum_id` int(10) NOT NULL,
  `lat` varchar(10) COLLATE utf8_bin NOT NULL,
  `lon` varchar(10) COLLATE utf8_bin NOT NULL,
  `nama_tempat` varchar(100) COLLATE utf8_bin NOT NULL,
  `slide_utama` varchar(255) COLLATE utf8_bin NOT NULL,
  `jeda_slide` varchar(10) COLLATE utf8_bin NOT NULL,
  `effect` varchar(100) COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `masjid_umum`
--

INSERT INTO `masjid_umum` (`umum_id`, `lat`, `lon`, `nama_tempat`, `slide_utama`, `jeda_slide`, `effect`, `last_update`) VALUES
(1, '3.1704', '101.6662', 'Surau Ibnu Umar', 'default.jpg', '20', 'random', '2018-03-09 04:42:20');

-- --------------------------------------------------------


--
-- Indexes for table `masjid_scroll`
--
ALTER TABLE `masjid_scroll`
  ADD PRIMARY KEY (`scroll_id`);

--
-- Indexes for table `masjid_slider`
--
ALTER TABLE `masjid_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `masjid_umum`
--
ALTER TABLE `masjid_umum`
  ADD PRIMARY KEY (`umum_id`);
  
--
-- AUTO_INCREMENT for table `masjid_scroll`
--
ALTER TABLE `masjid_scroll`
  MODIFY `scroll_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `masjid_slider`
--
ALTER TABLE `masjid_slider`
  MODIFY `slider_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `masjid_umum`
--
ALTER TABLE `masjid_umum`
  MODIFY `umum_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
