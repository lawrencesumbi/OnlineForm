-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2026 at 04:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sss_form`
--

-- --------------------------------------------------------

--
-- Table structure for table `sss_members`
--

CREATE TABLE `sss_members` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `date_of_birth` date NOT NULL,
  `sex` varchar(20) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `place_of_birth` varchar(150) NOT NULL,
  `home_address` varchar(150) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sss_members`
--

INSERT INTO `sss_members` (`id`, `full_name`, `date_of_birth`, `sex`, `civil_status`, `nationality`, `place_of_birth`, `home_address`, `mobile_number`, `email`, `created_at`) VALUES
(1, 'Sumbi, Lawrence Guian Parba', '2004-11-04', 'male', 'single', 'Filipino', 'Cebu City', 'Cebu City', '', '', '2026-01-12 15:16:36'),
(2, 'Sumbi, Rowena Parba', '1976-07-02', 'female', 'married', 'Filipino', 'Bogo City', 'Bogo City', '09278288036', 'rowenasumbi5@gmail.com', '2026-01-12 15:23:52'),
(3, 'Padilla, Daniel', '1980-01-01', 'male', 'Divorced', 'Filipino', 'Quezon City', 'Metropolitan Manila', '09123456789', 'danielpadilla@gmail.com', '2026-01-12 15:26:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sss_members`
--
ALTER TABLE `sss_members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sss_members`
--
ALTER TABLE `sss_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
