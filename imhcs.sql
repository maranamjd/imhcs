-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2020 at 12:32 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imhcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkup`
--

CREATE TABLE `checkup` (
  `checkup_id` int(11) NOT NULL,
  `patient_id` varchar(15) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `blood_pressure` varchar(16) DEFAULT NULL,
  `temperature` varchar(16) DEFAULT NULL,
  `pulse_rate` varchar(16) DEFAULT NULL,
  `respiration_rate` varchar(16) DEFAULT NULL,
  `weight` varchar(16) DEFAULT NULL,
  `height` varchar(16) DEFAULT NULL,
  `symptoms` text,
  `diagnosis` text,
  `date` datetime DEFAULT NULL,
  `notes` text,
  `active` smallint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkup`
--

INSERT INTO `checkup` (`checkup_id`, `patient_id`, `user_id`, `blood_pressure`, `temperature`, `pulse_rate`, `respiration_rate`, `weight`, `height`, `symptoms`, `diagnosis`, `date`, `notes`, `active`) VALUES
(1, 'SCA931758264', 'FDH342960817', '90/120', '37', '70/80', '12/20', '45', '116', 'Dizziness, Headache', 'Fever', '2020-01-04 00:00:00', NULL, 1),
(2, 'SCA931758264', 'FDH342960817', '90/100', '35', '72/80', '10/20', '60', '116', 'Difficulty in breathing', 'Busog', '2020-01-01 00:00:00', 'Mag diet', 0),
(3, 'SCA931758264', 'FDH342960817', '90/120', '37', '72/80', '10/20', '50', '116', 'Vomiting', 'Food poisoning', '2020-01-02 00:00:00', 'Yannnnn. Katakawan!', 1),
(4, 'SCA931758264', 'FDH342960817', '80/110', '34', '82/90', '12/20', '45', '162', 'Nagtatae', 'LBM', '2020-01-05 00:00:00', 'Drink lots of water', 1),
(5, 'LNT451289037', 'FDH342960817', '100/120', '37', '86/90', '8/20', 'undefined', '173', NULL, NULL, '2020-01-05 00:00:00', NULL, 0),
(6, 'SCA931758264', 'FDH342960817', '80/110', '33', '82/90', '8/20', '54', '162', 'adf', 'adsf', '2020-01-05 00:00:00', 'asdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `med_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`med_id`, `name`, `category_id`, `active`) VALUES
(3, 'Amoxcicillin', 1, 1),
(4, 'Red Horse', 3, 1),
(5, 'Tokhang', 2, 1),
(6, 'Bioflu', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `med_category`
--

CREATE TABLE `med_category` (
  `category_id` int(11) NOT NULL,
  `description` varchar(32) NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `med_category`
--

INSERT INTO `med_category` (`category_id`, `description`, `active`) VALUES
(1, 'Antibiotics', 1),
(2, 'Gamot sa adik', 1),
(3, 'Gamot sa puso', 1),
(4, 'Bags', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(32) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `sex` smallint(1) NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT '1',
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `patient_id`, `firstname`, `middlename`, `lastname`, `address`, `birthdate`, `contact_info`, `sex`, `active`, `created_on`) VALUES
(8, 'SCA931758264', 'Mellisa', 'Fuentes', 'Ancino', 'Bulacan', '1996-07-24', '09375621287', 2, 1, '2020-01-05'),
(9, 'LNT451289037', 'Adolf', NULL, 'Hitler', 'Berlin, Germany', '1985-06-26', '03847231223', 1, 1, '2020-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(11) NOT NULL,
  `checkup_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL,
  `no_days` int(64) DEFAULT NULL,
  `intake_schedule` varchar(5) DEFAULT NULL,
  `before_meal` int(1) DEFAULT NULL,
  `active` smallint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `checkup_id`, `med_id`, `no_days`, `intake_schedule`, `before_meal`, `active`) VALUES
(1, 1, 3, 5, '1-0-1', 1, 1),
(2, 4, 4, 3, '1-0-1', 0, 1),
(3, 6, 4, 7, '1-1-1', 1, 1),
(4, 4, 5, 1, '1-0-0', 1, 1),
(5, 4, 3, 1, '1-1-1', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(32) NOT NULL,
  `image` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `user_type` int(11) DEFAULT NULL,
  `active` smallint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `image`, `email`, `password`, `user_type`, `active`, `created_on`) VALUES
('DYE473869250', 'unknown.png', 'nurse@nurse.com', 'lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=', 2, 1, '2019-12-28 15:26:22'),
('FDH342960817', 'unknown.png', 'doctor@doctor.com', 'lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=', 1, 1, '2020-01-01 00:00:00'),
('HDB264370589', 'unknown.png', 'quack@doctor.com', '884g7GMGaRs4I7K6JeBaXg0Siq3MEvFs3qmzHeG48Ok=', 1, 1, '2020-01-04 11:42:43'),
('JIE625973480', 'unknown.png', 'laboratorist@laboratorist.com', 'lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=', 3, 1, '2019-12-28 15:27:06'),
('JMH501243798', 'unknown.png', 'pharmacist@pharmacist.com', 'lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=', 4, 1, '2019-12-28 15:27:46'),
('URL283051674', 'unknown.png', 'admin@admin.com', 'lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=', 5, 1, '2019-12-28 15:29:08'),
('WVA618742593', 'unknown.png', 'parma@email.com', 'Z/9J1A1TRcYWahvlzTZIIN7c0AmvNcideu17Yq6HGcU=', 4, 1, '2020-01-04 11:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `middlename` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(32) NOT NULL,
  `sex` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `firstname`, `middlename`, `lastname`, `address`, `birthdate`, `contact_info`, `sex`) VALUES
(1, 'FDH342960817', 'Michael', 'Duran', 'Marana', 'Sta. Mesa', '1997-10-11', '09123445678', 1),
(2, 'DYE473869250', 'Julyn', NULL, 'Divinagracia', 'bahay', '1992-05-02', '09123456789', 2),
(3, 'JIE625973480', 'Jemalyn', NULL, 'Cepe', 'sa kanila', '1995-10-02', '09468029840', 2),
(4, 'JMH501243798', 'Hazel Joy', 'Garcia', 'Hernandez', 'Bulacan', '1996-01-14', '09347343624', 2),
(5, 'URL283051674', 'Lito', NULL, 'Lapid', 'mansion', '1986-04-23', '09572657834', 1),
(6, 'HDB264370589', 'Doctor', 'Quack', 'Quack', 'pond', '2000-06-07', '09336283513', 1),
(7, 'WVA618742593', 'parma', NULL, 'parmaa', 'clinic', '1996-06-04', '09572636432', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkup`
--
ALTER TABLE `checkup`
  ADD PRIMARY KEY (`checkup_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `employee_id` (`user_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`med_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `med_category`
--
ALTER TABLE `med_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkup_id` (`checkup_id`),
  ADD KEY `med_id` (`med_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkup`
--
ALTER TABLE `checkup`
  MODIFY `checkup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `med_category`
--
ALTER TABLE `med_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkup`
--
ALTER TABLE `checkup`
  ADD CONSTRAINT `patient_ibfk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `user_id_ibfk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `category_ibfk` FOREIGN KEY (`category_id`) REFERENCES `med_category` (`category_id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `checkup_ibfk` FOREIGN KEY (`checkup_id`) REFERENCES `checkup` (`checkup_id`),
  ADD CONSTRAINT `med_ibfk` FOREIGN KEY (`med_id`) REFERENCES `medicine` (`med_id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_ibfk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
