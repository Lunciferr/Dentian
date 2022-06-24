-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 08:15 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_table`
--

CREATE TABLE `appointment_table` (
  `appointment_id` int(11) NOT NULL,
  `dentist_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `appt_number` int(11) NOT NULL,
  `appt_reason` mediumtext NOT NULL,
  `appt_time` time NOT NULL,
  `status` varchar(30) NOT NULL,
  `comments` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dentist_schedule`
--

CREATE TABLE `dentist_schedule` (
  `schedule_id` int(11) NOT NULL,
  `dentist_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `schedule_start_time` varchar(20) NOT NULL,
  `schedule_end_time` varchar(20) NOT NULL,
  `avg_consult_time` varchar(10) NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dentist_schedule`
--

INSERT INTO `dentist_schedule` (`schedule_id`, `dentist_id`, `schedule_date`, `schedule_day`, `schedule_start_time`, `schedule_end_time`, `avg_consult_time`, `Status`) VALUES
(1, 1001, '2021-02-19', 'Friday', '08:00', '15:00', '30 mins', 'Active'),
(2, 1001, '2022-05-31', 'Tuesday', '16:00', '17:00', '60 mins', 'Active'),
(3, 1001, '2023-02-14', 'Tuesday', '12:00', '12:30', '30 mins', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `patient_profile`
--

CREATE TABLE `patient_profile` (
  `Patient_ID` int(11) NOT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'Active',
  `First_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `NRIC_PNum` varchar(9) NOT NULL,
  `Gender` char(1) NOT NULL,
  `Birth_Date` date DEFAULT NULL,
  `Address` varchar(50) NOT NULL,
  `Nationality` varchar(100) NOT NULL,
  `Phone_Num` int(8) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Marital Status` varchar(20) NOT NULL,
  `Occupation` varchar(50) NOT NULL,
  `Smoker` varchar(3) NOT NULL,
  `Allergies` varchar(100) DEFAULT NULL,
  `Long_term_med` varchar(200) DEFAULT NULL,
  `Existing_Med_Conds` varchar(200) DEFAULT NULL,
  `Referred_by_clinic` varchar(50) DEFAULT NULL,
  `Referred_memo` varchar(200) DEFAULT NULL,
  `Family_ID` int(100) DEFAULT NULL,
  `Emer_Name` varchar(20) NOT NULL,
  `Emer_Contact` int(8) NOT NULL,
  `Emer_relation` varchar(10) NOT NULL,
  `Subsidies` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_profile`
--

INSERT INTO `patient_profile` (`Patient_ID`, `Status`, `First_Name`, `Last_Name`, `NRIC_PNum`, `Gender`, `Birth_Date`, `Address`, `Nationality`, `Phone_Num`, `Email`, `Marital Status`, `Occupation`, `Smoker`, `Allergies`, `Long_term_med`, `Existing_Med_Conds`, `Referred_by_clinic`, `Referred_memo`, `Family_ID`, `Emer_Name`, `Emer_Contact`, `Emer_relation`, `Subsidies`) VALUES
(1, 'Active', 'Elong', 'Mask', 'S8515249F', 'M', '1971-06-28', '3500 Deer Creek Road, Palo Alto', 'Singaporean', 84512355, 'elongmask@testla.com', 'Divorced', 'Investor', 'Yes', 'NULL', 'Captopril', 'High Blood Pressure', 'NULL', 'NULL', 123, 'May Mask', 91234567, 'Mother', 'No'),
(2, 'Active', 'Steve', 'Jobs', 'S2324914E', 'M', '1992-01-30', '576 East Coast Road, S(459185)', 'Singaporean', 82412051, 'steve@orange.com', 'Married', 'Engineer', 'No', 'Penicillin', 'NULL', 'Laryngeal cancer', 'Planet Dental Centre Pte. Ltd.', 'Referred for unrestorable tooth', 420, 'Henry Jobs', 89012225, 'Siblings', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `patient_record`
--

CREATE TABLE `patient_record` (
  `Record_ID` int(6) NOT NULL,
  `Patient_ID` int(11) NOT NULL,
  `Treatment_Date` date DEFAULT NULL,
  `Treatment_type` varchar(50) NOT NULL,
  `Treatment_details` varchar(255) NOT NULL,
  `Material_used` varchar(255) NOT NULL,
  `Doctor/Assistant 1` varchar(50) NOT NULL,
  `Doctor/Assistant 2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_record`
--

INSERT INTO `patient_record` (`Record_ID`, `Patient_ID`, `Treatment_Date`, `Treatment_type`, `Treatment_details`, `Material_used`, `Doctor/Assistant 1`, `Doctor/Assistant 2`) VALUES
(1, 1, '2022-05-15', 'Dental Check ups', 'Annual Dental check ups', 'Dental mirror, Ultrasonic cleaner, Curette/scaler, Fluoride solution', 'Nelson', 'Monica'),
(2, 2, '2022-02-06', 'Restoration of teeth', 'Composite resins bonded to discolored teeth', 'Composite Resins', 'Nelson', 'Monica'),
(3, 1, '2022-04-28', 'Professional Teeth Cleaning', 'Scaling and Polishing', 'Mouth mirror, Dental probe, Dental syringe, Scaler,Curette', 'Nil', 'Nil'),
(4, 2, '2022-05-16', 'Dental Implants', 'Dental implants completed for the impacted tooth', 'Titanium\r\n', 'Nil', 'Nil');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `product_name` varchar(50) NOT NULL,
  `product_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`product_name`, `product_price`) VALUES
('product1', 100),
('product2', 200),
('product3', 300);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `Emp_ID` int(11) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `NRIC_PNum` varchar(9) NOT NULL,
  `Gender` char(1) NOT NULL,
  `Birth_Date` date DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `Phone_Num` int(8) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Specialization` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`Emp_ID`, `First_Name`, `Last_Name`, `username`, `password`, `NRIC_PNum`, `Gender`, `Birth_Date`, `Address`, `Phone_Num`, `Email`, `Role`, `Specialization`) VALUES
(1001, 'Nelson', 'Tan', 'nelsontan', 'password', 'S0000001I', 'M', '1998-01-01', ' 138 CECIL ST #14-02 S(069538)', 98765432, 'nelsontan@dentian.com', 'Dentist', 'General Dentist'),
(2001, 'Monica', 'Chng', 'monicachng', 'password', 'S0000002A', 'F', '1992-02-08', 'Sunnyvale Apartments 134B Lorong K Telok Kurau #03-04 S(425773)', 97654321, 'monicachng@dentian.com', 'Dentist Assistant', 'NULL'),
(2002, 'Peter', 'Parker', 'pp', 'password', 's9811132f', 'M', '1982-04-04', 'test', 98157553, 'peter@parker.com', 'Dentist Assistant', 'NULL'),
(3001, 'Benjamin', 'Tan', 'bentan', 'password', 'S0000005J', 'M', '1993-04-04', '120 Hillview Avenue #06-08 S(669594)', 96543210, 'bentan@dentian.com', 'Receptionist', 'NULL'),
(4001, 'Stephen', 'Strange', 'drstrange', 'password', 'S5521709K', 'M', '1993-04-15', '177A Bleecker Street', 95432109, 'drstrange@dentain.com', 'System Admin', 'NULL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_table`
--
ALTER TABLE `appointment_table`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `dentist_schedule`
--
ALTER TABLE `dentist_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `patient_profile`
--
ALTER TABLE `patient_profile`
  ADD PRIMARY KEY (`Patient_ID`);

--
-- Indexes for table `patient_record`
--
ALTER TABLE `patient_record`
  ADD PRIMARY KEY (`Record_ID`),
  ADD KEY `Patient_ID` (`Patient_ID`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`Emp_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_table`
--
ALTER TABLE `appointment_table`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dentist_schedule`
--
ALTER TABLE `dentist_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_record`
--
ALTER TABLE `patient_record`
  MODIFY `Record_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_record`
--
ALTER TABLE `patient_record`
  ADD CONSTRAINT `patient_record_ibfk_1` FOREIGN KEY (`Patient_ID`) REFERENCES `patient_profile` (`Patient_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
