-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2022 at 01:42 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


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
  `Family_ID` int(3) DEFAULT NULL,
  `Emer_Name` varchar(20) NOT NULL,
  `Emer_Contact` int(8) NOT NULL,
  `Emer_relation` varchar(10) NOT NULL,
  `Subsidies` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_profile`
--

INSERT INTO `patient_profile` (`Patient_ID`, `Status`, `First_Name`, `Last_Name`, `NRIC_PNum`, `Gender`, `Birth_Date`, `Address`, `Nationality`, `Phone_Num`, `Email`, `Marital Status`, `Occupation`, `Smoker`, `Allergies`, `Long_term_med`, `Existing_Med_Conds`, `Referred_by_clinic`, `Referred_memo`, `Family_ID`, `Emer_Name`, `Emer_Contact`, `Emer_relation`, `Subsidies`) VALUES
(1, 'Active', 'Elong', 'Masked', 'S8515249F', 'M', '1971-06-28', '3500 Deer Creek Road, Palo Alto', 'Singaporean', 84512355, 'elongmask@testla.com', 'Divorced', 'Investor', 'Yes', 'NULL', 'NULL', 'High Blood Pressure', 'NULL', 'NULL', 3136, 'May Mask', 91234567, 'Relative', 'No'),
(2, 'Active', 'Steve', 'Jobs', 'S2324914E', 'M', '1992-01-30', '576 East Coast Road, S(459185)', 'Singaporean', 82412051, 'steve@orange.com', 'Married', 'Engineer', 'No', 'Penicillin', 'NULL', 'Laryngeal cancer', 'Planet Dental Centre Pte. Ltd.', 'Referred for unrestorable tooth', 8966, 'Henry Jobs', 89012225, 'Siblings', 'Yes'),
(3, 'Active', 'Peter', 'Lim', 'S9477780A', 'M', '1994-02-10', '8 Grange Road 09-01 Cineleisure Orchard Singapore ', 'Singaporean', 98653976, 'peterlim@sim.sg', 'Married', 'Investor', 'Yes', 'Diary food, seafood', 'NULL', 'NULL', 'NULL', 'NULL', 2169, 'Mary Jane', 83776810, 'Mother', 'Yes'),
(4, 'Active', 'Tom', 'Jerry', 'S4988877E', 'M', '1995-08-15', '5001 BEACH ROAD, #03-96 Singapore 199588', 'South Korean', 86708939, 'tomandjerry@disney.com', 'Separated', 'Actor', 'Yes', 'Shellfish, egg', 'NULL', 'NULL', 'NULL', 'NULL', 1118, 'Crystal', 82187343, 'Siblings', 'No'),
(5, 'Active', 'Boon', 'Tong Kee', 'S8185724E', 'M', '1982-09-18', '101 Kitchener Rd #01-23 Jln Besar Plaza S(761101)', 'Chinese', 81275824, 'btk@chickenrice.com', 'Married', 'Founder', 'Yes', 'Peanuts', 'Candesartan', 'Candesartan', 'Luminuous Dental Clinic', 'Broken Front tooth from fall in kitchen', 3136, 'Wee Nam Kee', 91824754, 'Friend', 'Yes'),
(6, 'Active', 'Steve', 'Rogers', 'S9541535I', 'M', '1995-06-20', '261 Waterloo St #03-27', 'South African', 95845632, 'Steve@avengers.com', 'Single', 'Military', 'No', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 3223, 'Peggy ', 94563214, 'Friend', 'No'),
(7, 'Active', 'Mohammad', 'Ali', 'S7843690F', 'M', '1975-05-19', '55 Toh Guan Road East 03-01', 'American', 88125784, 'ali@fighter.com', 'Married', 'Professional Fighter', 'No', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 1394, 'Baba', 91587586, 'Siblings', 'No'),
(8, 'Active', 'Bell', 'Gates', 'S9541534I', 'M', '1995-06-21', '190 Clemenceau Ave #01-21', 'American', 95632145, 'Bellgates@myghostsoft.com', 'Single', 'Business leader', 'No', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 7974, 'Melinda', 95463258, 'Spouse', 'No'),
(9, 'Active', 'Mark', 'Lee', 'S0931492Z', 'M', '1998-01-04', 'Blk 253, Pasir Ris St 21 #01-233 Singapore 510253', 'Thai', 96613907, 'marklee@mediacorp.com', 'Separated', 'Director', 'Yes', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 8966, 'Janet Lee', 96372904, 'Spouse', 'Yes'),
(10, 'Active', 'Sar', 'Kor', 'S8517693D', 'M', '1984-05-20', 'Tampines Mart 5 Tampines Street 32 #01-14', 'Singaporean', 96172466, 'sarkor@shirtpants.com', 'Separated', 'Housewife', 'Yes', 'Fur and peanuts', 'NULL', 'NULL', 'NULL', 'NULL', 4247, 'Ali', 88125784, 'Friend', 'No'),
(11, 'Active', 'Ip', 'Man', 'S9254863M', 'M', '2005-06-14', '277 ORCHARD ROAD#B1-03', 'Chinese', 96415896, 'Ipman@gmail.com', 'Single', 'Teacher', 'No', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 1929, 'Ip Chun', 94850369, 'Father', 'No'),
(12, 'Active', 'Charles', 'Yeo', 'S7158249A', 'M', '1971-06-27', '143 CECIL STREET, #09-01', 'Singaporean', 91245838, 'chenghetitong@psp.com', 'Single', 'Politician', 'No', 'NULL', 'NULL', 'Valium', 'NULL', 'NULL', 8848, 'Tony', 92257284, 'Siblings', 'No'),
(13, 'Active', 'Jordon', 'Lamsey', 'S6589845M', 'M', '1999-06-07', '3 Pasir Panjang Road 10-35 Alexandra Distripark', 'American', 96312585, 'JordonLamsey@HellKitchen.com', 'Married', 'Chef', 'No', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 6120, 'Tina Lamsey', 98436201, 'Spouse', 'No'),
(14, 'Active', 'Donnie', 'Yen', 'S5650161D', 'M', '1991-07-08', 'Kilat Centre 33 Lorong Kilat #02-04 Singapore 5981', 'Singaporean', 96772978, 'donnieipman@gmail.com', 'Married', 'Fighter', 'No', 'NULL', 'Singulair, Flovent, Advair, Pulmicort, Symbicort', 'NULL', 'Family Clinic Ptd Ltd', 'Servere headache. Need more in-depth x-ray scan.', 3200, 'Olivia Yen', 96882374, 'Spouse', 'No'),
(15, 'Active', 'Gabriel', 'Quak', 'S7617482D', 'M', '1988-07-27', '1 Rochor Canal Road #01-33 Sim Lim Square', 'Singaporean', 92857646, 'quakgabriel@lcs.com', 'Married', 'Professional Footballer', 'No', 'NULL', 'NULL', 'NULL', 'Tampines Polyclinic', 'Specialist', 7419, 'Wendy', 88125784, 'Spouse', 'No'),
(16, 'Active', 'Wayne', 'Johnson', 'S9615486J', 'M', '2022-06-23', '222 Tagore Lane 01-11 TG Building', 'Argentinean', 90236485, 'WayneJohn@wwe.com', 'Married', 'Actor', 'No', 'Steroids', 'NULL', 'NULL', 'NULL', 'NULL', 1926, 'Laura', 98463012, 'Spouse', 'No');

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
(4, 2, '2022-05-16', 'Dental Implants', 'Dental implants completed for the impacted tooth', 'Titanium\r\n', 'Nil', 'Nil'),
(6, 1, '2022-06-10', 'Restoration of teeth', 'Right Molar 1', 'Platinum', 'Nelson', 'Peter'),
(7, 1, '2022-06-24', 'Restoration of teeth', 'Right Molar 1 - decaying\r\nRight Molar 2 - impacted', 'Platinum', 'Nelson', 'Monica'),
(8, 1, '2022-06-24', 'Dental Check ups', 'Right Molar 1 - decay\r\nLower Right Molar 2 - impacted', 'Platinum', 'Nelson', 'Monica'),
(9, 3, '2022-06-23', 'Restoration of teeth', 'Right Molar 1 - Silver filling', 'Glass Ionomers, Dental amalgam', 'Lee', 'Kor'),
(10, 3, '2022-06-24', 'Professional Teeth Cleaning', 'Cleaning of all teeth', 'Nil', 'Nelson', 'Monica');

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
(1002, 'Kor', 'Fee', 'korfee', 'password', 'S8915728H', 'M', '1982-02-17', 'Block 152 Bedok Reservoir Road #19-159 S460152', 91258723, 'korfee@dentian.com', 'Dentist', 'Oral Pathologist'),
(1003, 'Lee', 'Kum Kee', 'leekk', 'password', 'S8612736F', 'F', '1975-08-19', ' 1 Woodlands Square 04-45 738099', 91585262, 'leekk@dentian.com', 'Dentist', 'Pedodontist'),
(1004, 'Kim', 'Shin Wook', 'shinwook', 'password', 'S8201573D', 'M', '1982-08-19', ' Blk 628A Pasir Ris Dr 3 #01-326 S(510628)', 87526448, 'ksw@dentian.com', 'Dentist', 'Pedodontist'),
(2001, 'Monica', 'Chng', 'monicachng', 'password', 'S0000002A', 'F', '1992-02-08', 'Sunnyvale Apartments 134B Lorong K Telok Kurau #03-04 S(425773)', 97654321, 'monicachng@dentian.com', 'Dentist Assistant', 'NULL'),
(2002, 'Peter', 'Parker', 'pp', 'password', 's9811132f', 'M', '1982-04-04', 'Tampines Mall', 98157553, 'peter@parker.com', 'Dentist Assistant', 'NULL'),
(3001, 'Benjamin', 'Tan', 'bentan', 'password', 'S0000005J', 'M', '1993-04-04', '120 Hillview Avenue #06-08 S(669594)', 96543210, 'bentan@dentian.com', 'Receptionist', 'NULL'),
(3002, 'Jia', 'Kantang', 'jkt', 'password', 'S7841728P', 'M', '1978-03-27', '257 Selegie Road #03-295 SELEGIE COMPLEX S188257', 91245718, 'potatoeater@dentian.com', 'Receptionist', 'NULL'),
(4001, 'Stephen', 'Strange', 'drstrange', 'password', 'S5521709K', 'M', '1955-04-15', '177A Bleecker Street', 95432109, 'drstrange@dentain.com', 'System Admin', 'NULL'),
(4002, 'Tony', 'Stark', 'ironman', 'password', 'S7518427B', 'M', '1975-01-28', '194 PANDAN LOOP, #06-17', 81257284, 'ironman@dentian.com', 'System Admin', 'NULL');

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
  MODIFY `Record_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
