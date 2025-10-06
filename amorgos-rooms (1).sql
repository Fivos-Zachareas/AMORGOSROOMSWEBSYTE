-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 30, 2024 at 06:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amorgos-rooms`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomodation`
--

CREATE TABLE `accomodation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(320) NOT NULL,
  `website` text NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accomodation`
--

INSERT INTO `accomodation` (`id`, `name`, `location`, `number`, `email`, `website`, `image`) VALUES
(1, 'Hotel Kaerati Apartments Amorgos', 'Αμοργός', '2285301240', 'info@kaerati-amorgos.gr', 'https://www.kaerati-amorgos.gr', 'Kaerati-partments.jpg'),
(2, 'Amorgion Hotel', 'Κατάπολα', '2285071361', 'alexandros.studios.amorgos@gmail.com', 'https://www.amorgion-hotel.gr/el/', 'Amorgion-Hotel.jpg'),
(3, 'Aegialis Hotel & Spa', 'Αιγιάλη', '2285073393', 'info@aegialis.com', 'https://amorgos-aegialis.com/el/', NULL),
(4, 'Lakki Village Family Beach Hotel\r\n', 'Λάκκι', '2285073505', 'nfo@lakkivillage.gr', 'https://www.lakkivillage.com/el/', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(350) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `first_name`, `last_name`, `email`, `username`, `password`) VALUES
(1, 'Ionas', 'Kapralos', 'ionaskapralos@gmail.com', 'Alfred', 'Batman1');

-- --------------------------------------------------------

--
-- Table structure for table `local_websites`
--

CREATE TABLE `local_websites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business-name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `business-phone` varchar(15) NOT NULL,
  `email` varchar(350) NOT NULL,
  `mobile-phone` varchar(15) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `local_websites`
--

INSERT INTO `local_websites` (`id`, `business-name`, `description`, `business-phone`, `email`, `mobile-phone`, `image`) VALUES
(39, 'akis cooking', 'aaa', '111111', '1@1', '1', 'akis-cooking.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pending_users`
--

CREATE TABLE `pending_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `business_name` varchar(100) NOT NULL,
  `business_number` varchar(15) NOT NULL,
  `business_email` varchar(320) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_users`
--

INSERT INTO `pending_users` (`id`, `first_name`, `last_name`, `business_name`, `business_number`, `business_email`, `username`, `password`) VALUES
(1, 'Harvey', 'Specter', 'Pearson&Specter', '121212', 'specter@gmail.com', 'Specter', '1');

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `business_name` varchar(100) NOT NULL,
  `business_number` varchar(15) NOT NULL,
  `business_email` varchar(320) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`id`, `first_name`, `last_name`, `business_name`, `business_number`, `business_email`, `username`, `password`) VALUES
(26, 'akis', 'petretzikis', 'akis cooking', '111111', '1@1', 'akis1', '1'),
(55, 'a', 'a', 'a', '', 'a', 'a', ''),
(56, 'b', 'b', 'b', '', 'b', 'b', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accomodation`
--
ALTER TABLE `accomodation`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `local_websites`
--
ALTER TABLE `local_websites`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `pending_users`
--
ALTER TABLE `pending_users`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomodation`
--
ALTER TABLE `accomodation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `local_websites`
--
ALTER TABLE `local_websites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pending_users`
--
ALTER TABLE `pending_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `registered_users`
--
ALTER TABLE `registered_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
