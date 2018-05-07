-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2018 at 01:57 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `guestbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `jabatan` varchar(80) DEFAULT NULL,
  `kesan` varchar(500) DEFAULT NULL,
  `pesan` varchar(500) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `filename` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`id`, `date`, `name`, `address`, `instansi`, `jabatan`, `kesan`, `pesan`, `ip`, `filename`) VALUES
  (1, '2018-05-07 11:45:06', 'aaa', 'aa', 'aa', 'aa', 'aa', 'aa', '::1', NULL),
  (2, '2018-05-07 11:45:54', 'winzaldi', 'padang', 'diskominfo', 'pns', 'top sekali', 'lanjutkan', '::1', NULL),
  (3, '2018-05-07 11:53:32', '11', '11', '11', '11', '11', '11', '::1', NULL),
  (5, '2018-05-07 11:53:38', '11', '11', '11', '11', '11', '11', '::1', NULL),
  (6, '2018-05-07 11:53:40', '11', '11', '11', '11', '11', '11', '::1', NULL),
  (7, '2018-05-07 11:53:42', '11', '11', '11', '11', '11', '11', '::1', NULL),
  (8, '2018-05-07 11:53:44', '11', '11', '11', '11', '11', '11', '::1', NULL),
  (9, '2018-05-07 11:53:46', '11', '11', '11', '11', '11', '11', '::1', NULL),
  (10, '2018-05-07 11:53:48', '11', '11', '11', '11', '11', '11', '::1', NULL),
  (11, '2018-05-07 11:53:54', '11', '11', '11', '11', '11', '11', '::1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password_hash`, `name`, `role`) VALUES
  (1, 'admin@example.com', '$2y$10$gp7.FSLSV9WlTVAqaeK5auM1jWFw6BM4nMYFAn1XKFCKfQVNe3DFG', 'Admin', 'admin'),
  (2, 'user@example.com', '$2y$10$gp7.FSLSV9WlTVAqaeK5auM1jWFw6BM4nMYFAn1XKFCKfQVNe3DFG', 'User', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `record`
--
ALTER TABLE `record`
ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;