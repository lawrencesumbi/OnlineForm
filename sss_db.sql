-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2026 at 04:28 PM
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
-- Table structure for table `certification`
--

CREATE TABLE `certification` (
  `id` int(11) NOT NULL,
  `personal_data_id` int(11) NOT NULL,
  `printed_name` varchar(100) NOT NULL,
  `cert_signature` text NOT NULL,
  `cert_date` date NOT NULL,
  `right_thumb` text NOT NULL,
  `right_index` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certification`
--

INSERT INTO `certification` (`id`, `personal_data_id`, `printed_name`, `cert_signature`, `cert_date`, `right_thumb`, `right_index`) VALUES
(1, 9, 'Xena Rika', 'Signed', '2026-01-23', 'ok', 'ok'),
(2, 12, '', '', '0000-00-00', '', ''),
(3, 13, '', '', '0000-00-00', '', ''),
(4, 14, '', '', '0000-00-00', '', ''),
(5, 16, '', '', '0000-00-00', '', ''),
(6, 17, '', '', '0000-00-00', '', ''),
(7, 18, '', '', '0000-00-00', '', ''),
(8, 19, '', '', '0000-00-00', '', ''),
(9, 20, '', '', '0000-00-00', '', ''),
(10, 21, '', '', '0000-00-00', '', ''),
(11, 22, '', '', '0000-00-00', '', '');

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
(5, 7, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(7, 9, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(9, 11, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(10, 12, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(11, 13, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(12, 14, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(13, 15, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(14, 16, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(15, 17, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(16, 18, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(17, 19, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(18, 20, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(19, 21, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]'),
(20, 22, '', '0000-00-00', '[\"\",\"\",\"\"]', '[\"\",\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]', '[\"\",\"\"]');

-- --------------------------------------------------------

--
-- Table structure for table `filled_sss`
--

CREATE TABLE `filled_sss` (
  `id` int(11) NOT NULL,
  `personal_data_id` int(11) NOT NULL,
  `business_code` varchar(20) NOT NULL,
  `monthly_contribution` varchar(15) NOT NULL,
  `start_payment` date NOT NULL,
  `working_spouse` text NOT NULL,
  `approved_msc` varchar(15) NOT NULL,
  `flexi_fund` text DEFAULT NULL,
  `received_signature` varchar(100) NOT NULL,
  `received_date` date NOT NULL,
  `processed_signature` varchar(100) NOT NULL,
  `processed_date` date NOT NULL,
  `reviewed_signature` varchar(100) NOT NULL,
  `reviewed_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filled_sss`
--

INSERT INTO `filled_sss` (`id`, `personal_data_id`, `business_code`, `monthly_contribution`, `start_payment`, `working_spouse`, `approved_msc`, `flexi_fund`, `received_signature`, `received_date`, `processed_signature`, `processed_date`, `reviewed_signature`, `reviewed_date`) VALUES
(1, 14, 'IT3A', '1,000.00', '2026-01-23', '1,000.00', '500.00', 'approved', 'Signed', '2026-01-23', 'Signed', '2026-01-23', 'Signed', '2026-01-23'),
(2, 16, 'IT3A', '1,000.00', '2026-01-23', '1,000.00', '500.00', 'approved', 'Signed', '2026-01-23', 'Signed', '2026-01-23', 'Signed', '2026-01-23'),
(3, 17, '', '', '0000-00-00', '', '', NULL, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(4, 18, '', '', '0000-00-00', '', '', NULL, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(5, 19, '', '', '0000-00-00', '', '', NULL, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(6, 20, '', '', '0000-00-00', '', '', NULL, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(7, 21, '', '', '0000-00-00', '', '', NULL, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00'),
(8, 22, '', '', '0000-00-00', '', '', NULL, '', '0000-00-00', '', '0000-00-00', '', '0000-00-00');

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
(7, '12-3456789-1', 'Pader, Xander Ryzen Parba', '2011-01-01', 'male', 'single', '123-456-789', 'Filipino', 'Roman Catholic', 'Purok Talong, Vito, Minglanilla, Cebu', 'Purok Talong, Vito, Minglanilla, Cebu', '', '09123456789', 'xander@gmail.com', '09123456789', '', ''),
(9, '', 'Pader, Xena Rika', '2026-01-23', 'female', 'single', '', 'Filipino', 'Roman Catholic', 'Bogo, Cebu', 'Purok Matamban, Anonang Sur', '6010', '+639058557409', 'xena@gmail.com', '', 'Pader, Philmon', 'Parba, Malou Abella'),
(11, '', 'Parba, Bham Angel Delabrino', '2026-01-23', 'female', 'single', '', 'Filipino', 'Roman Catholic', 'Bogo, Cebu', 'Purok Matamban, Anonang Sur', '6010', '+639058557409', 'bham@gmail.com', '', 'Parba, Bobby Delabrino', 'Delabrino, Alma'),
(12, '', 'Parba, Benish Reina Delabrino', '2026-01-23', 'female', 'single', '', 'Filipino', 'Roman Catholic', 'Bogo, Cebu', 'Purok Matamban, Anonang Sur', '6010', '+639058557409', 'benish@gmail.com', '09123456789', 'Parba, Bobby Delabrino', 'Delabrino, Alma'),
(13, '', 'Parba, Bryll Josh Delabrino', '2026-01-23', 'male', 'single', '', 'Filipino', 'Roman Catholic', 'Bogo, Cebu', 'Purok Matamban, Anonang Sur', '6010', '+639058557409', 'bryll@gmail.com', '', 'Parba, Bobby Delabrino', 'Delabrino, Alma'),
(14, '', 'Obaob, King James Largo', '2026-01-23', 'male', 'single', '', 'Filipino', 'Roman Catholic', 'Bogo, Cebu', 'Purok Matamban, Anonang Sur', '6010', '+639058557409', 'king@gmail.com', '', 'Obaob, Eutiquio Alfeche', 'Obaob, Nerissa '),
(15, '', 'Obaob, Emman Largo', '2026-01-23', 'male', 'single', '', 'Filipino', 'Roman Catholic', 'Bogo, Cebu', 'Purok Matamban, Anonang Sur', '6010', '+639058557409', 'emman@gmail.com', '', 'Obaob, Eutiquio Alfeche', 'Largo, Nerissa Ravina'),
(16, '', 'Obaob, Lenzey Largo', '2026-01-23', 'female', 'single', '', 'Filipino', 'Roman Catholic', 'Bogo, Cebu', 'Purok Matamban, Anonang Sur', '6010', '+639058557409', 'lenzey@gmail.com', '', 'Obaob, Eutiquio Alfeche', 'Largo, Nerissa Ravina'),
(17, '', 'sample1', '2026-01-23', 'male', 'others', '', 'Filipino', '', 'Sample1', 'sample01', '6010', '+639058557409', 'guiansumbi@gmail.com', '', '', ''),
(18, '', 'sample2', '2012-12-12', 'male', 'single', '', 'Filipino', '', 'Bogo City', 'Bogo City', '', '+639058557409', 'guiansumbi@gmail.com', '', '', ''),
(19, '', 'Sample3', '2021-12-12', 'male', 'single', '', 'Filipino', '', 'Minglanilla', 'Minglanilla', '', '+639058557409', 'guiansumbi@gmail.com', '', '', ''),
(20, '', 'Sample 4', '2025-12-12', 'male', 'single', '', 'Filipino', '', 'Minglanilla', 'Naga', '', '09123456789', 'guiansumbi@gmail.com', '', '', ''),
(21, '', 'Sample 5', '2026-01-23', 'male', 'others', '', 'Filipino', '', 'Bogo, Cebu', 'Purok Matamban, Anonang Sur', '6010', '+639058557409', 'guiansumbi@gmail.com', '', '', ''),
(22, '', 'Sample 6', '2026-01-23', 'male', 'hello', '', 'Filipino', '', 'Bogo, Cebu', 'Purok Matamban, Anonang Sur', '6010', '+639058557409', 'guiansumbi@gmail.com', '', '', '');

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
  `membership` varchar(100) DEFAULT NULL,
  `reference` varchar(150) NOT NULL,
  `spouse_income` text NOT NULL,
  `agreement` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`id`, `personal_data_id`, `profession_business`, `date_started`, `self_earnings`, `foreign_address`, `ofw_earnings`, `membership`, `reference`, `spouse_income`, `agreement`) VALUES
(1, 7, 'Roblox Player', '2021-12-01', '10,000.00', 'California', '5,000.00', 'yes', '123456789123', '20,000', 'I agree.'),
(2, 9, '', '0000-00-00', '', '', '', 'no', '', '', ''),
(3, 12, '', '0000-00-00', '', '', '', '', '', '', ''),
(4, 13, '', '0000-00-00', '', '', '', 'no', '', '', ''),
(5, 14, '', '0000-00-00', '', '', '', '', '', '', ''),
(6, 16, '', '0000-00-00', '', '', '', 'no', '', '', ''),
(7, 17, '', '0000-00-00', '', '', '', NULL, '', '', ''),
(8, 18, '', '0000-00-00', '', '', '', NULL, '', '', ''),
(9, 19, '', '0000-00-00', '', '', '', NULL, '', '', ''),
(10, 20, '', '0000-00-00', '', '', '', NULL, '', '', ''),
(11, 21, '', '0000-00-00', '', '', '', NULL, '', '', ''),
(12, 22, '', '0000-00-00', '', '', '', NULL, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_data_id` (`personal_data_id`);

--
-- Indexes for table `dependents`
--
ALTER TABLE `dependents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_data_id` (`personal_data_id`);

--
-- Indexes for table `filled_sss`
--
ALTER TABLE `filled_sss`
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
-- AUTO_INCREMENT for table `certification`
--
ALTER TABLE `certification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dependents`
--
ALTER TABLE `dependents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `filled_sss`
--
ALTER TABLE `filled_sss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_data`
--
ALTER TABLE `personal_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certification`
--
ALTER TABLE `certification`
  ADD CONSTRAINT `certification_personal_data_id_fr` FOREIGN KEY (`personal_data_id`) REFERENCES `personal_data` (`id`);

--
-- Constraints for table `dependents`
--
ALTER TABLE `dependents`
  ADD CONSTRAINT `dependents_personal_data_id_fr` FOREIGN KEY (`personal_data_id`) REFERENCES `personal_data` (`id`);

--
-- Constraints for table `filled_sss`
--
ALTER TABLE `filled_sss`
  ADD CONSTRAINT `filled_sss_personal_data_id` FOREIGN KEY (`personal_data_id`) REFERENCES `personal_data` (`id`);

--
-- Constraints for table `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `work_personal_data_id` FOREIGN KEY (`personal_data_id`) REFERENCES `personal_data` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
