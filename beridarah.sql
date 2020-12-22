-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2020 at 09:01 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beridarah`
--

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id_donor` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `domicile_city` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `blood_group` varchar(3) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id_donor`, `id_user`, `name`, `gender`, `birthday`, `domicile_city`, `phone`, `blood_group`, `is_active`, `created_date`, `updated_date`) VALUES
(1, 1, 'Tryo Asnafi', 'L', '2001-02-01', 'Pekanbaru', '6285218391820', 'O+', 1, '2020-12-16 22:37:39', NULL),
(2, 1, 'Ona Tri Faisy', 'P', '1995-12-11', 'Pekanbaru', '6285315648970', 'O+', 1, '2020-12-16 22:45:49', '2020-12-16 22:56:11'),
(4, 2, 'Tryo Asnafi', 'L', '2001-01-20', 'Pekanbaru', '6285218391829', 'O+', 1, '2020-12-17 03:23:21', NULL),
(5, 3, 'Demo User', 'L', '2020-12-17', 'Bengkalis', '6281223456987', 'AB+', 1, '2020-12-17 03:44:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id_request` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `recipient_name` varchar(255) DEFAULT NULL,
  `recipient_gender` varchar(1) DEFAULT NULL,
  `blood_group` varchar(3) DEFAULT NULL,
  `hospital` varchar(255) DEFAULT NULL,
  `number_donors` int(3) DEFAULT NULL,
  `requester_name` varchar(255) DEFAULT NULL,
  `requester_phone` varchar(15) DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `message` text,
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id_request`, `id_user`, `recipient_name`, `recipient_gender`, `blood_group`, `hospital`, `number_donors`, `requester_name`, `requester_phone`, `relationship`, `message`, `status`, `created_date`, `updated_date`) VALUES
(1, 1, ' Lindha Usi Saputra', 'P', 'B+', 'RS An-Nisa', 2, 'Usi Lasmi', '6281384763798 ', 'Ibu', '', 1, '2020-12-16 23:39:24', '2020-12-16 23:56:37'),
(2, 1, 'Ny. Sapti', 'P', 'A+', 'RSUD Sumedang', 3, 'Bayu', '6283866284007 ', 'Teman', '', 1, '2020-12-16 23:58:03', NULL),
(3, 1, 'Apriyanto Saputra', 'L', 'O+', 'RS Fatmawati', 2, 'Wini', '6289698164193 ', 'Istri', '', 1, '2020-12-16 23:59:00', NULL),
(5, 2, ' S.E. Widodo', 'L', 'O+', 'RS Jakarta', 1, 'Dian Ika S.', '62818142299', 'Ayah', '', 1, '2020-12-17 01:44:13', '2020-12-17 01:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `level`, `created_date`, `updated_date`) VALUES
(1, 'Administrator', 'admin@admin.com', '$2y$10$G340i.IxMz0OeUfrJK1ly.1fgbT77y3FPIdCu8vgDYakqHs8/Ur1i', 'admin', '2020-12-16 22:20:09', '2020-12-16 23:03:48'),
(2, 'Tryo Asnafi', 'tryodiablo@gmail.com', '$2y$10$Hc6OvkU71CDjHnyrPNqezu3BiglA/JOeLP82Kq9BMCkM0aGRptnY.', 'user', '2020-12-16 23:05:46', '2020-12-16 23:08:00'),
(3, 'Demo', 'demo@demo.id', '$2y$10$8GgRc8oKgZTvLIbMNnH67.EJP9ZEimPxohTgsoRq1lnXsQX7lTIzu', 'user', '2020-12-17 03:39:23', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id_donor`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id_donor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donor`
--
ALTER TABLE `donor`
  ADD CONSTRAINT `donor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
