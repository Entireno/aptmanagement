-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2018 at 01:24 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apt`
--

-- --------------------------------------------------------

--
-- Table structure for table `diger`
--

CREATE TABLE `diger` (
  `id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ilk` date NOT NULL,
  `son` date NOT NULL,
  `durum` int(2) NOT NULL DEFAULT '0',
  `tarih` date NOT NULL,
  `miktar` float NOT NULL,
  `gecikme` int(2) NOT NULL DEFAULT '0',
  `blok` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diger`
--

INSERT INTO `diger` (`id`, `s_id`, `ilk`, `son`, `durum`, `tarih`, `miktar`, `gecikme`, `blok`) VALUES
(1, 11, '2018-08-20', '2018-08-27', 0, '0000-00-00', 312.5, 0, 'B'),
(2, 12, '2018-08-20', '2018-08-27', 0, '2018-12-12', 312.5, 0, 'B'),
(3, 13, '2018-08-20', '2018-08-27', 0, '0000-00-00', 312.5, 0, 'B'),
(4, 14, '2018-08-20', '2018-08-27', 0, '0000-00-00', 312.5, 0, 'B'),
(5, 15, '2018-04-15', '2018-04-22', 0, '0000-00-00', 1000, 0, 'D'),
(6, 16, '2018-04-27', '2018-05-05', 0, '0000-00-00', 2382, 0, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `dogalgaz`
--

CREATE TABLE `dogalgaz` (
  `id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ilk` date NOT NULL,
  `son` date NOT NULL,
  `durum` int(2) NOT NULL DEFAULT '0',
  `tarih` date DEFAULT NULL,
  `gecikme` int(2) NOT NULL DEFAULT '0',
  `miktar` float NOT NULL,
  `blok` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dogalgaz`
--

INSERT INTO `dogalgaz` (`id`, `s_id`, `ilk`, `son`, `durum`, `tarih`, `gecikme`, `miktar`, `blok`) VALUES
(2, 11, '2012-12-10', '2012-12-15', 1, '2014-12-15', 1, 1666.67, 'B'),
(3, 12, '2012-12-10', '2012-12-15', 0, NULL, 1, 1666.67, 'B'),
(4, 13, '2012-12-10', '2012-12-15', 0, NULL, 1, 1666.67, 'B'),
(5, 6, '2018-12-15', '2018-12-22', 0, NULL, 0, 400, 'A'),
(6, 7, '2018-12-15', '2018-12-22', 0, NULL, 0, 400, 'A'),
(7, 8, '2018-12-15', '2018-12-22', 0, NULL, 0, 400, 'A'),
(8, 9, '2018-12-15', '2018-12-22', 0, NULL, 0, 400, 'A'),
(9, 10, '2018-12-15', '2018-12-22', 0, NULL, 0, 400, 'A'),
(10, 6, '2020-09-15', '2020-09-22', 0, NULL, 0, 100, 'A'),
(11, 7, '2020-09-15', '2020-09-22', 0, NULL, 0, 100, 'A'),
(12, 8, '2020-09-15', '2020-09-22', 0, NULL, 0, 100, 'A'),
(13, 9, '2020-09-15', '2020-09-22', 0, NULL, 0, 100, 'A'),
(14, 10, '2020-09-15', '2020-09-22', 0, NULL, 0, 100, 'A'),
(15, 16, '2018-04-24', '2018-05-01', 1, '2018-04-24', 0, 10000, 'C'),
(16, 6, '2018-04-20', '2018-04-27', 0, NULL, 0, 200, 'A'),
(17, 7, '2018-04-20', '2018-04-27', 0, NULL, 0, 200, 'A'),
(18, 8, '2018-04-20', '2018-04-27', 0, NULL, 0, 200, 'A'),
(19, 9, '2018-04-20', '2018-04-27', 0, NULL, 0, 200, 'A'),
(20, 10, '2018-04-20', '2018-04-27', 0, NULL, 0, 200, 'A'),
(21, 11, '2018-04-27', '2018-05-18', 0, NULL, 0, 125, 'B'),
(22, 12, '2018-04-27', '2018-05-18', 0, NULL, 0, 125, 'B'),
(23, 13, '2018-04-27', '2018-05-18', 0, NULL, 0, 125, 'B'),
(24, 14, '2018-04-27', '2018-05-18', 0, NULL, 0, 125, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `duyurular`
--

CREATE TABLE `duyurular` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `icerik` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `duyurular`
--

INSERT INTO `duyurular` (`id`, `baslik`, `icerik`) VALUES
(1, 'Bu bir denemedir', 'Deneme icerik');

-- --------------------------------------------------------

--
-- Table structure for table `elektirik`
--

CREATE TABLE `elektirik` (
  `id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ilk` date NOT NULL,
  `son` date NOT NULL,
  `durum` int(2) NOT NULL DEFAULT '0',
  `tarih` date DEFAULT NULL,
  `gecikme` int(2) DEFAULT '0',
  `miktar` float NOT NULL,
  `blok` varchar(2) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `elektirik`
--

INSERT INTO `elektirik` (`id`, `s_id`, `ilk`, `son`, `durum`, `tarih`, `gecikme`, `miktar`, `blok`) VALUES
(13, 11, '2017-09-10', '2017-09-22', 1, NULL, 0, 233.333, 'B'),
(14, 12, '2017-09-10', '2017-09-22', 1, NULL, 0, 233.333, 'B'),
(15, 13, '2017-09-10', '2017-09-22', 1, NULL, 0, 233.333, 'B'),
(16, 11, '2019-09-12', '2019-09-19', 1, '2018-04-24', 0, 333, 'B'),
(17, 12, '2019-09-12', '2019-09-19', 0, NULL, 0, 333, 'B'),
(18, 13, '2019-09-12', '2019-09-19', 0, NULL, 0, 333, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `sakin`
--

CREATE TABLE `sakin` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `tel` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `eposta` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `blok` varchar(1) COLLATE utf8_turkish_ci NOT NULL,
  `apartman` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `daire` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  `resim` int(11) DEFAULT NULL,
  `yetki` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `sakin`
--

INSERT INTO `sakin` (`id`, `ad`, `tel`, `eposta`, `sifre`, `blok`, `apartman`, `daire`, `resim`, `yetki`) VALUES
(1, 'A A', '5554424232', 'example@example.com', '1e55dbf412cb74d5e2c21fb6452408c7', '', '', '', NULL, 1),
(6, 'B B', '5433121212', 'example@example.com', '1e55dbf412cb74d5e2c21fb6452408c7', 'A', 'A2', '2', NULL, 0),
(7, 'B B', '5551511515', 'ahmetahmet@gmail.com', '056f32ee5cf49404607e368bd8d3f2af', 'A', 'A1', '3', NULL, 0),
(8, 'Ahmet CAN', '5425424242', 'ahmetcan@gamil.com', 'f50881ced34c7d9e6bce100bf33dec60', 'A', 'A1', '4', NULL, 0),
(9, 'Hayko CEPKIN', '5131313113', 'haykosayko@hotmail.com', '81a1e7e35e13e13939905df0c20d1420', 'A', 'A1', '5', NULL, 0),
(10, 'C C', '5444421212', 'example@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'A', 'A1', '7', NULL, 0),
(11, 'D D', '5433125251', 'example@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'B', 'A1', '1', NULL, 0),
(12, 'F F', '5433581501', 'example@example.com', '1e55dbf412cb74d5e2c21fb6452408c7', 'B', 'A1', '2', NULL, 0),
(13, 'E E', '5131313131', 'example@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'B', 'B1', '3', NULL, 0),
(14, 'Deneyelim DENEBAKALIM', '2222222222', 'mmm', '1e55dbf412cb74d5e2c21fb6452408c7', 'B', 'B2', '7', NULL, 0),
(15, 'G G', '5458534336', 'example@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'D', 'D2', '1', NULL, 0),
(16, 'H  H', '5555555555', 'example@example.com', 'e10adc3949ba59abbe56e057f20f883e', 'C', 'Teknoloji', '1', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sikayetler`
--

CREATE TABLE `sikayetler` (
  `id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `icerik` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sikayetler`
--

INSERT INTO `sikayetler` (`id`, `s_id`, `baslik`, `icerik`) VALUES
(1, 10, 'Otopark Sorunu', '5 numarıdaki komsum bana ait park alanını sürekli işgal ediyor'),
(2, 16, 'park ', 'komşular hayvani bir park stiline sahip');

-- --------------------------------------------------------

--
-- Table structure for table `su`
--

CREATE TABLE `su` (
  `id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ilk` date NOT NULL,
  `son` date NOT NULL,
  `durum` int(2) DEFAULT '0',
  `tarih` date NOT NULL,
  `gecikme` int(2) NOT NULL DEFAULT '0',
  `miktar` float NOT NULL,
  `blok` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `su`
--

INSERT INTO `su` (`id`, `s_id`, `ilk`, `son`, `durum`, `tarih`, `gecikme`, `miktar`, `blok`) VALUES
(62, 11, '2019-09-19', '2019-09-26', 1, '2018-04-24', 0, 249.75, 'B'),
(63, 12, '2019-09-19', '2019-09-26', 0, '0000-00-00', 0, 249.75, 'B'),
(64, 13, '2019-09-19', '2019-09-26', 0, '0000-00-00', 0, 249.75, 'B'),
(65, 14, '2019-09-19', '2019-09-26', 0, '0000-00-00', 0, 249.75, 'B'),
(66, 15, '2018-04-23', '2018-04-30', 1, '2018-04-24', 0, 100, 'D');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diger`
--
ALTER TABLE `diger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dogalgaz`
--
ALTER TABLE `dogalgaz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duyurular`
--
ALTER TABLE `duyurular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elektirik`
--
ALTER TABLE `elektirik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sakin`
--
ALTER TABLE `sakin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sikayetler`
--
ALTER TABLE `sikayetler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `su`
--
ALTER TABLE `su`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diger`
--
ALTER TABLE `diger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `dogalgaz`
--
ALTER TABLE `dogalgaz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `duyurular`
--
ALTER TABLE `duyurular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `elektirik`
--
ALTER TABLE `elektirik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `sakin`
--
ALTER TABLE `sakin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sikayetler`
--
ALTER TABLE `sikayetler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `su`
--
ALTER TABLE `su`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
