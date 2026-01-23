-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2026 at 09:57 AM
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
-- Database: `sss_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dependents`
--

CREATE TABLE `dependents` (
  `id` int(11) NOT NULL,
  `personal_data_id` int(11) NOT NULL,
  `spouse` varchar(150) NOT NULL,
  `spouse_dob` date NOT NULL,
  `children` text NOT NULL,
  `children_dob` text NOT NULL,
  `beneficiaries` text NOT NULL,
  `relationship` varchar(30) NOT NULL,
  `benef_dob` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dependents`
--

INSERT INTO `dependents` (`id`, `personal_data_id`, `spouse`, `spouse_dob`, `children`, `children_dob`, `beneficiaries`, `relationship`, `benef_dob`) VALUES
(1, 3, 'Sumbi, Lawrence Guian Parba', '2026-01-23', 'Sumbi, Princess Gi-Ann Mae Obaob', '2026-01-23', 'N/A', 'N/A', '2026-01-23'),
(2, 4, 'Obaob, Patricia Ann Mae Largo', '2005-03-20', '[\"Sumbi, Lelouch Kai Zhen Obaob\",\"Sumbi, Princess Gi-Ann Mae Obaob\",\"\"]', '[\"2026-01-23\",\"2026-01-23\",\"\"]', '\"N\\/A\"', '\"N\\/A\"', '\"2026-01-23\"'),
(5, 7, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]');

-- --------------------------------------------------------

--
-- Table structure for table `personal_data`
--

CREATE TABLE `personal_data` (
  `id` int(11) NOT NULL,
  `sss_number` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `name_dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `tin_number` varchar(15) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `place_of_birth` varchar(150) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email_address` varchar(254) NOT NULL,
  `tel_number` varchar(20) NOT NULL,
  `fathers_name` varchar(150) NOT NULL,
  `mothers_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_data`
--

INSERT INTO `personal_data` (`id`, `sss_number`, `name`, `name_dob`, `sex`, `civil_status`, `tin_number`, `nationality`, `religion`, `place_of_birth`, `home_address`, `zip_code`, `mobile_number`, `email_address`, `tel_number`, `fathers_name`, `mothers_name`) VALUES
(3, '06-1234567-8', 'Obaob, Patricia Ann Mae Largo', '2005-03-20', 'female', 'married', '123-456-789', 'Filipino', 'Roman Catholic', 'Cebu City', 'Purok Bayabas, Pitalo, SanFernando, Cebu, Philippines', '1234', '+639058557409', 'pat@gmail.com', '09123456789', 'Obaob, Eutiquio Alfeche', 'Largo, Nerissa Ravina'),
(4, '06-1234567-9', 'Sumbi, Lawrence Guian Parba', '2004-11-04', 'male', 'married', '123-456-789', 'Filipino', 'Roman Catholic', 'Cebu', 'Purok Talong, Vito, Minglanilla, Cebu', '6036', '09753140724', 'guiansumbi@gmail.com', '09123456789', 'Sumbi, Raul Capada', 'Parba, Rowena Abella'),
(7, '12-3456789-1', 'Pader, Xander Ryzen Parba', '2011-01-01', 'male', 'single', '123-456-789', 'Filipino', 'Roman Catholic', 'Purok Talong, Vito, Minglanilla, Cebu', 'Purok Talong, Vito, Minglanilla, Cebu', '', '09123456789', 'xander@gmail.com', '09123456789', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `id` int(11) NOT NULL,
  `personal_data_id` int(11) NOT NULL,
  `profession_business` varchar(150) NOT NULL,
  `date_started` date NOT NULL,
  `self_earnings` text NOT NULL,
  `foreign_address` varchar(255) NOT NULL,
  `ofw_earnings` text NOT NULL,
  `membership` varchar(100) NOT NULL,
  `reference` varchar(150) NOT NULL,
  `spouse_income` text NOT NULL,
  `agreement` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `personal_data_id`, `profession_business`, `date_started`, `self_earnings`, `foreign_address`, `ofw_earnings`, `membership`, `reference`, `spouse_income`, `agreement`) VALUES
(1, 7, 'Roblox Player', '2021-12-01', '10,000.00', 'California', '5,000.00', 'yes', '123456789123', '20,000', 'I agree.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dependents`
--
ALTER TABLE `dependents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_data_id` (`personal_data_id`);

--
-- Indexes for table `personal_data`
--
ALTER TABLE `personal_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_data_id` (`personal_data_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dependents`
--
ALTER TABLE `dependents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_data`
--
ALTER TABLE `personal_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dependents`
--
ALTER TABLE `dependents`
  ADD CONSTRAINT `dependents_personal_data_id_fr` FOREIGN KEY (`personal_data_id`) REFERENCES `personal_data` (`id`);

--
-- Constraints for table `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `work_personal_data_id` FOREIGN KEY (`personal_data_id`) REFERENCES `personal_data` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
