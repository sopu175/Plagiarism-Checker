-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2020 at 04:06 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bubt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Assignment'),
(2, 'Project Report'),
(5, 'Lab report');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(30) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `filename` varchar(40) NOT NULL,
  `filesize` int(30) NOT NULL,
  `destination` varchar(500) NOT NULL,
  `file` blob NOT NULL,
  `category_id` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `user_id`, `filename`, `filesize`, `destination`, `file`, `category_id`) VALUES
(71, '14152103035', 'lorem.txt', 1062, 'uploads/lorem.txt', '', '1'),
(72, '14152103035', 'lorem2.txt', 693, 'uploads/lorem2.txt', '', '2'),
(73, '14152103035', 'Pdf One.pdf', 32301, 'uploads/Pdf One.pdf', '', '5'),
(74, '14152103035', 'Pdf Two.pdf', 32162, 'uploads/Pdf Two.pdf', '', '5'),
(75, '14152103035', 'Word one.docx', 6383, 'uploads/Word one.docx', '', '2'),
(76, '14152103035', 'Word Two.docx', 6279, 'uploads/Word Two.docx', '', '2'),
(77, '14152103035', 'dcastalia.docx', 13234, 'uploads/dcastalia.docx', '', '1'),
(78, '14152103010', 'dcastalia.docx', 13234, 'uploads/dcastalia.docx', '', '2'),
(79, '14152103035', 'proposal.docx', 155032, 'uploads/proposal.docx', '', '2'),
(80, '14152103035', 'proposal.docx', 155032, 'uploads/proposal.docx', '', '2');

-- --------------------------------------------------------

--
-- Table structure for table `pending`
--

CREATE TABLE `pending` (
  `id` int(30) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filesize` int(30) NOT NULL,
  `destination` varchar(500) NOT NULL,
  `file` blob NOT NULL,
  `category_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(30) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `id` varchar(50) NOT NULL,
  `intake` varchar(30) DEFAULT NULL,
  `section` int(30) DEFAULT NULL,
  `program` varchar(40) DEFAULT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `image_src` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `id`, `intake`, `section`, `program`, `phone`, `password`, `image_src`) VALUES
(2, 'Habiba Tahrima', 'habiba@gmail.com', '14152103010', '29', 1, 'B.Sc Engn in CSE', '01944905884', '1234', ''),
(12, 'Sakhawat Sifat', 'sifat@gmail.com', '14152103037', '29', 4, 'B.Sc in CSIT', '+8801944905784', '12345', ''),
(15, 'Saif Islam', 'sopu175@gmail.com', '14152103035', '29', 1, 'B.Sc in CSE', '+8801928435474', '1234', './uploads/user/spencer-russell-C7FB7H-sXJs-unsplash.jpg'),
(16, 'Mohammad Sabbir Mahmud', 'teczardit@gmail.com', '14152103037', '29', 5, 'BBA', '01966904016', '1234', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `pending`
--
ALTER TABLE `pending`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
