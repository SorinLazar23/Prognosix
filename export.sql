-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2018 at 01:53 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS `prognosix`;

--
-- Database: `prognosix`
--
CREATE DATABASE IF NOT EXISTS `prognosix` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `prognosix`;

-- --------------------------------------------------------

--
-- Table structure for table `disciplines`
--

CREATE TABLE `disciplines` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disciplines`
--

INSERT INTO `disciplines` (`id`, `name`, `teacher_id`) VALUES
(1, 'BD', 6),
(2, 'GPC', 6),
(3, 'TW', 6),
(4, 'ML', 6),
(5, 'IA', 6),
(6, 'Python', 6);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `discipline_id` int(11) NOT NULL,
  `round` varchar(100) NOT NULL,
  `grade` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `user_id`, `discipline_id`, `round`, `grade`) VALUES
(2, 1, 1, 'Laborator - prima parte', 13),
(5, 1, 1, 'Sesiune', 6),
(6, 1, 2, 'Laborator - prima parte', 11),
(7, 1, 2, 'Laborator - prima parte', 11),
(8, 1, 2, 'Proiect', 10),
(9, 1, 3, 'laborator1', 6),
(18, 1, 5, 'laborator2', 8.5),
(19, 1, 5, 'laborator1', 7.5),
(20, 1, 5, 'sesiune', 9.5),
(21, 1, 4, 'laborator1', 4),
(22, 1, 4, 'laborator2', 5),
(23, 1, 6, 'laborator2', 7),
(24, 1, 1, 'Proiect', 12),
(25, 1, 3, 'sesiune', 7.8);

-- --------------------------------------------------------

--
-- Table structure for table `grade_files`
--

CREATE TABLE `grade_files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `discipline_id` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `punctaj_p` float NOT NULL,
  `punctaj_m` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_files`
--

INSERT INTO `grade_files` (`id`, `user_id`, `discipline_id`, `url`, `punctaj_p`, `punctaj_m`) VALUES
(2, 6, 1, 'D://programs/xampp/xampp/htdocs/prognosix/uploads/1528794246_Note BD.csv', 5, 2),
(3, 6, 2, 'D://programs/xampp/xampp/htdocs/prognosix/uploads/1528794275_Note GPC.csv', 3, 0.5),
(4, 6, 3, 'D://programs/xampp/xampp/htdocs/prognosix/uploads/1528794332_Note TW.json', 1, 0.2),
(5, 6, 4, 'D://programs/xampp/xampp/htdocs/prognosix/uploads/1528794340_Note ML.xml', 2, 2),
(6, 6, 5, 'D://programs/xampp/xampp/htdocs/prognosix/uploads/1528794354_Note IA.json', 1.5, 0.25),
(7, 6, 6, 'D://programs/xampp/xampp/htdocs/prognosix/uploads/1528794370_Note Python.xml', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `typename` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `typename`) VALUES
(1, 'student'),
(2, 'profesor');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `type`) VALUES
(1, 'Laurentiu Cozma', '81dc9bdb52d04dc20036dbd8313ed055', 'laurentiucozma@gmail.com', 1),
(5, 'Sorin Lazar', '81dc9bdb52d04dc20036dbd8313ed055', 'sorinlazargmail.com', 1),
(6, 'Laurentiu Cozma', '81dc9bdb52d04dc20036dbd8313ed055', 'laurentiucozma-prof@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_disciplines`
--

CREATE TABLE `user_disciplines` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `disciplines_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_files`
--
ALTER TABLE `grade_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_disciplines`
--
ALTER TABLE `user_disciplines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `grade_files`
--
ALTER TABLE `grade_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_disciplines`
--
ALTER TABLE `user_disciplines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
