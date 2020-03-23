-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2020 at 09:01 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `symptoms` text DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `active` smallint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkup`
--

INSERT INTO `checkup` (`checkup_id`, `patient_id`, `user_id`, `blood_pressure`, `temperature`, `pulse_rate`, `respiration_rate`, `weight`, `height`, `symptoms`, `diagnosis`, `date`, `notes`, `active`) VALUES
(8, 'P000000002', 'FDH342960817', '80/110', '34', '82/90', '8/20', '55', '162', 'Headache', 'Hangover', '2020-03-23 00:00:00', 'Drink moderately', 1),
(9, 'P000000003', 'FDH342960817', '80/110', '34', '82/90', '8/20', '66', '162', 'asdf', 'asdf', '2020-03-23 00:00:00', 'follow up checkup on March 30, 2020', 1);

-- --------------------------------------------------------

--
-- Table structure for table `immunization_record`
--

CREATE TABLE `immunization_record` (
  `immunization_record_id` int(11) NOT NULL,
  `child_name` varchar(64) NOT NULL,
  `mother_name` varchar(64) NOT NULL,
  `father_name` varchar(64) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(64) NOT NULL,
  `birth_height` varchar(64) NOT NULL,
  `birth_weight` varchar(64) NOT NULL,
  `sex` smallint(1) NOT NULL,
  `address` varchar(128) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `active` smallint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `immunization_record`
--

INSERT INTO `immunization_record` (`immunization_record_id`, `child_name`, `mother_name`, `father_name`, `birthdate`, `birthplace`, `birth_height`, `birth_weight`, `sex`, `address`, `created_on`, `active`) VALUES
(1, 'Michael Joshua Marana', 'Marissa Marana', 'Fernando Marana', '2020-02-05', 'Camarines Norte', '130', '6', 1, 'Pampanga', '2020-03-08 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_request`
--

CREATE TABLE `laboratory_request` (
  `lab_req_id` int(11) NOT NULL,
  `user_id` varchar(15) CHARACTER SET latin1 NOT NULL,
  `lab_id` int(11) NOT NULL,
  `patient_id` varchar(15) CHARACTER SET latin1 NOT NULL,
  `note` text NOT NULL,
  `results` text DEFAULT NULL,
  `status` smallint(1) NOT NULL DEFAULT 0,
  `date_requested` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laboratory_request`
--

INSERT INTO `laboratory_request` (`lab_req_id`, `user_id`, `lab_id`, `patient_id`, `note`, `results`, `status`, `date_requested`, `date_updated`) VALUES
(8, 'FDH342960817', 1, 'P000000002', 'sd', NULL, 0, '2020-03-22 12:56:11', NULL),
(9, 'FDH342960817', 1, 'P000000002', 'asdf', NULL, 0, '2020-03-23 13:12:32', NULL),
(10, 'FDH342960817', 1, 'P000000003', 'asdf', NULL, 0, '2020-03-23 14:27:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_test`
--

CREATE TABLE `laboratory_test` (
  `lab_id` int(11) NOT NULL,
  `description` varchar(64) NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laboratory_test`
--

INSERT INTO `laboratory_test` (`lab_id`, `description`, `active`) VALUES
(1, 'Blood Testing', 1),
(2, 'Written', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `medication_id` int(11) NOT NULL,
  `checkup_id` int(11) NOT NULL,
  `user_id` varchar(15) CHARACTER SET latin1 NOT NULL,
  `patient_id` varchar(15) CHARACTER SET latin1 NOT NULL,
  `med_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT 0,
  `date_requested` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`medication_id`, `checkup_id`, `user_id`, `patient_id`, `med_id`, `quantity`, `status`, `date_requested`, `date_updated`) VALUES
(8, 8, 'FDH342960817', 'P000000002', 4, 1, 2, '2020-03-23 12:08:19', '2020-03-23 12:31:46'),
(9, 8, 'FDH342960817', 'P000000002', 3, 1, 0, '2020-03-23 13:53:17', NULL),
(10, 9, 'FDH342960817', 'P000000003', 4, 1, 0, '2020-03-23 14:23:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `med_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT 1
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
  `active` smallint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `med_category`
--

INSERT INTO `med_category` (`category_id`, `description`, `active`) VALUES
(1, 'Antibiotics', 0),
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
  `active` smallint(1) NOT NULL DEFAULT 1,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `patient_id`, `firstname`, `middlename`, `lastname`, `address`, `birthdate`, `contact_info`, `sex`, `active`, `created_on`) VALUES
(11, 'P000000001', 'Michael', 'Duran', 'Marana', 'Pampanga', '1997-10-11', '09334237563', 1, 1, '2020-03-19'),
(13, 'P000000002', 'Mellisa', 'Fuentes', 'Ancino', 'bulacan', '1997-03-04', '0394467361', 2, 1, '2020-03-19'),
(14, 'P000000003', 'Adolf', NULL, 'Hitler', 'Berlin, Germany', '1978-11-28', '0937362834', 1, 1, '2020-03-19');

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
  `active` smallint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `checkup_id`, `med_id`, `no_days`, `intake_schedule`, `before_meal`, `active`) VALUES
(7, 8, 3, 1, '1-0-0', 1, 0),
(8, 8, 4, 1, '1-1-0', 1, 0),
(9, 9, 4, 1, '1-1-0', 1, 1);

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
  `active` smallint(1) NOT NULL DEFAULT 1,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `image`, `email`, `password`, `user_type`, `active`, `created_on`) VALUES
('DYE473869250', 'unknown.png', 'nurse@nurse.com', 'ZEV0bzhaemF2L1ZTWnVOTVVzY210QT09Ojq6FBQ9YfV3ej0DxE9KZaYj', 2, 1, '2019-12-28 15:26:22'),
('FDH342960817', 'unknown.png', 'doctor@doctor.com', 'ZEV0bzhaemF2L1ZTWnVOTVVzY210QT09Ojq6FBQ9YfV3ej0DxE9KZaYj', 1, 1, '2020-01-01 00:00:00'),
('HDB264370589', 'unknown.png', 'quack@doctor.com', 'ZEV0bzhaemF2L1ZTWnVOTVVzY210QT09Ojq6FBQ9YfV3ej0DxE9KZaYj', 1, 1, '2020-01-04 11:42:43'),
('JIE625973480', 'unknown.png', 'laboratorist@laboratorist.com', 'ZEV0bzhaemF2L1ZTWnVOTVVzY210QT09Ojq6FBQ9YfV3ej0DxE9KZaYj', 3, 1, '2019-12-28 15:27:06'),
('JMH501243798', 'unknown.png', 'pharmacist@pharmacist.com', 'ZEV0bzhaemF2L1ZTWnVOTVVzY210QT09Ojq6FBQ9YfV3ej0DxE9KZaYj', 4, 1, '2019-12-28 15:27:46'),
('QOG345069182', 'unknown.png', 'esme@gmail.com', 'ZGNrdHJFRUJYbUJ6UHVSUmZnVmxwZz09OjqvOcSp6ZHOv7/JTC+d38PW', 2, 1, '2020-02-04 21:21:09'),
('URL283051674', 'unknown.png', 'admin@admin.com', 'ZEV0bzhaemF2L1ZTWnVOTVVzY210QT09Ojq6FBQ9YfV3ej0DxE9KZaYj', 5, 1, '2019-12-28 15:29:08'),
('WVA618742593', 'unknown.png', 'parma@email.com', 'ZEV0bzhaemF2L1ZTWnVOTVVzY210QT09Ojq6FBQ9YfV3ej0DxE9KZaYj', 4, 1, '2020-01-04 11:48:57');

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
(7, 'WVA618742593', 'parma', NULL, 'parmaa', 'clinic', '1996-06-04', '09572636432', 2),
(8, 'QOG345069182', 'Esmeralda', 'Capitulo', 'Pangilinan', 'Taguig', '1993-06-10', '09264738271', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `vaccination_id` int(11) NOT NULL,
  `immunization_record_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `user_id` varchar(15) CHARACTER SET latin1 NOT NULL,
  `doses` varchar(32) NOT NULL,
  `date` date NOT NULL,
  `remarks` text NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`vaccination_id`, `immunization_record_id`, `vaccine_id`, `user_id`, `doses`, `date`, `remarks`, `active`) VALUES
(3, 1, 1, 'DYE473869250', '1', '2020-03-08', 'next on March 15, 2020', 1),
(4, 1, 1, 'FDH342960817', '1', '2020-03-08', 'asdf', 1),
(5, 1, 3, 'FDH342960817', '1', '2020-03-11', 'ads', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine`
--

CREATE TABLE `vaccine` (
  `vaccine_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccine`
--

INSERT INTO `vaccine` (`vaccine_id`, `name`, `active`) VALUES
(1, 'BCG', 1),
(2, 'Hepatitis B', 1),
(3, 'Pentavalent Vaccine', 1),
(4, 'Oral Polio Vaccine', 1),
(5, 'Inactivated Polio Vaccine', 1),
(6, 'Pneumococcal Conjugate Vaccine', 1),
(7, 'Measles, Mumps, Rubella', 1),
(8, 'asdf', 0);

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
-- Indexes for table `immunization_record`
--
ALTER TABLE `immunization_record`
  ADD PRIMARY KEY (`immunization_record_id`);

--
-- Indexes for table `laboratory_request`
--
ALTER TABLE `laboratory_request`
  ADD PRIMARY KEY (`lab_req_id`),
  ADD KEY `patient_ibfk_3` (`patient_id`),
  ADD KEY `lab_test_ibfk` (`lab_id`),
  ADD KEY `user_ibfk_5` (`user_id`);

--
-- Indexes for table `laboratory_test`
--
ALTER TABLE `laboratory_test`
  ADD PRIMARY KEY (`lab_id`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`medication_id`),
  ADD KEY `patient_ibfk_2` (`patient_id`),
  ADD KEY `med_ibfk_2` (`med_id`),
  ADD KEY `user_ibfk_4` (`user_id`),
  ADD KEY `checkup_ibfk_3` (`checkup_id`);

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
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`vaccination_id`),
  ADD KEY `immunization_record_ibfk` (`immunization_record_id`),
  ADD KEY `vaccine_ibfk` (`vaccine_id`),
  ADD KEY `user_ibfk_6` (`user_id`);

--
-- Indexes for table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`vaccine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkup`
--
ALTER TABLE `checkup`
  MODIFY `checkup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `immunization_record`
--
ALTER TABLE `immunization_record`
  MODIFY `immunization_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laboratory_request`
--
ALTER TABLE `laboratory_request`
  MODIFY `lab_req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `laboratory_test`
--
ALTER TABLE `laboratory_test`
  MODIFY `lab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `medication_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `vaccination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `vaccine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkup`
--
ALTER TABLE `checkup`
  ADD CONSTRAINT `patient_ibfk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_ibfk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laboratory_request`
--
ALTER TABLE `laboratory_request`
  ADD CONSTRAINT `lab_test_ibfk` FOREIGN KEY (`lab_id`) REFERENCES `laboratory_test` (`lab_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_ibfk_3` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medication`
--
ALTER TABLE `medication`
  ADD CONSTRAINT `checkup_ibfk_3` FOREIGN KEY (`checkup_id`) REFERENCES `checkup` (`checkup_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `med_ibfk_2` FOREIGN KEY (`med_id`) REFERENCES `medicine` (`med_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `category_ibfk` FOREIGN KEY (`category_id`) REFERENCES `med_category` (`category_id`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `checkup_ibfk` FOREIGN KEY (`checkup_id`) REFERENCES `checkup` (`checkup_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `med_ibfk` FOREIGN KEY (`med_id`) REFERENCES `medicine` (`med_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_ibfk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD CONSTRAINT `immunization_record_ibfk` FOREIGN KEY (`immunization_record_id`) REFERENCES `immunization_record` (`immunization_record_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vaccine_ibfk` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccine` (`vaccine_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
