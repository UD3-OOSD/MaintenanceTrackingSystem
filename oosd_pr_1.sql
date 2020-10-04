-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 05:07 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oosd_pr_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `activerepairs`
--

CREATE TABLE `activerepairs` (
  `RepairId` int(11) NOT NULL,
  `RepairState` int(11) NOT NULL,
  `RepairDescription` int(11) NOT NULL,
  `Labourers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activeservices`
--

CREATE TABLE `activeservices` (
  `ServiceId` varchar(80) NOT NULL,
  `ServiceState` int(11) NOT NULL,
  `ServiceType` varchar(80) NOT NULL,
  `ServiceDate` date NOT NULL,
  `Labourers` varchar(255) NOT NULL,
  `ServiceDescription` varchar(100) DEFAULT NULL,
  `BusNumber` varchar(80) NOT NULL,
  `BusCategory` varchar(100) NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activeservices`
--

INSERT INTO `activeservices` (`ServiceId`, `ServiceState`, `ServiceType`, `ServiceDate`, `Labourers`, `ServiceDescription`, `BusNumber`, `BusCategory`, `deleted`) VALUES
('Serv1', 3, 'Engine', '2020-10-05', 'Lab7,Lab8', NULL, 'NC-2910', 'Leyland', 0),
('Serv10', 8, 'Engine', '2020-10-05', 'Lab8,Lab9,Lab4', NULL, 'SP-3659', 'Honda', 1),
('Serv11', 2, 'Engine', '2020-10-05', 'Lab9,Lab7,Lab4', NULL, 'HI-4902', 'Honda', 0),
('Serv12', 2, 'Tire', '2020-10-04', 'Lab4,Lab9', NULL, 'NC-5678', 'Leyland', 0),
('Serv13', 3, 'Tire', '2019-09-10', 'Lab9,Lab8,Lab4', NULL, 'ND-2945', 'Leyland', 0),
('Serv14', 3, 'Oil', '2019-07-01', 'Lab7,Lab4', NULL, 'NB-7863', 'Leyland', 0),
('Serv15', 1, 'Oil', '2019-07-01', 'Lab9,Lab7', NULL, 'TY-4658', 'Leyland', 0),
('Serv16', 4, 'Engine', '2019-04-09', 'Lab8,Lab4,Lab7', NULL, 'NB-1235', 'Leyland', 0),
('Serv18', 1, 'Tire', '2020-10-05', 'Lab7,Lab4,Lab8', NULL, 'NB-1235', 'Leyland', 0),
('Serv19', 4, 'Oil', '2020-10-06', 'Lab9,Lab4', NULL, 'RS-2346', 'Honda', 0),
('Serv2', 1, 'Engine', '2019-08-06', 'Lab9,Lab4', NULL, 'NC-2910', 'Leyland', 0),
('Serv22', 5, 'Oil', '2020-10-03', 'Lab8,Lab4', NULL, 'TU-6902', 'Leyland', 0),
('Serv23', 8, 'Oil', '2019-04-17', 'Lab7,Lab8', NULL, 'TU-6902', 'Leyland', 1),
('Serv25', 6, 'Engine', '2018-12-03', 'Lab9,Lab8,Lab4', NULL, 'TP-6784', 'Honda', 0),
('Serv27', 6, 'Oil', '2020-10-04', 'Lab8,Lab9', NULL, 'JK-2910', 'Honda', 0),
('Serv29', 7, 'Tire', '2020-10-04', 'Lab7,Lab9,Lab8', NULL, 'NB-7863', 'Leyland', 0),
('Serv3', 8, 'Engine', '2020-10-06', 'Lab7,Lab8', NULL, 'US-5892', 'Leyland', 1),
('Serv32', 8, 'Engine', '2019-02-13', 'Lab4,Lab9,Lab7', NULL, 'TY-4658', 'Leyland', 1),
('Serv33', 7, 'Engine', '2019-05-24', 'Lab4,Lab9', NULL, 'NA-6520', 'Honda', 0),
('Serv34', 8, 'Oil', '2019-11-13', 'Lab4,Lab7,Lab8', NULL, 'ND-2945', 'Leyland', 0),
('Serv35', 8, 'Oil', '2019-11-13', 'Lab1,Lab2,Lab3', NULL, 'NB-7863', 'Leyland', 0),
('Serv4', 8, 'Tire', '2020-06-03', 'Lab7,Lab4', NULL, 'PT-4748', 'Honda', 1),
('Serv5', 8, 'Oil', '2020-07-05', 'Lab9,Lab8', NULL, 'SU-2394', 'Honda', 1),
('Serv6', 0, 'Tire', '2020-04-07', 'Lab8,Lab4', NULL, 'RP-5693', 'Honda', 0),
('Serv7', 8, 'Oil', '2020-03-15', 'Lab8,Lab4', NULL, 'US-5892', 'Leyland', 1),
('Serv8', 2, 'Tire', '2020-04-08', 'Lab4,Lab7', NULL, 'NT-3901', 'Honda', 0);

-- --------------------------------------------------------

--
-- Table structure for table `buscategory`
--

CREATE TABLE `buscategory` (
  `BusType` varchar(255) NOT NULL,
  `EngineService` int(11) NOT NULL,
  `TireService` int(11) NOT NULL,
  `OilService` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buscategory`
--

INSERT INTO `buscategory` (`BusType`, `EngineService`, `TireService`, `OilService`) VALUES
('Demo', 50000, 25000, 10000),
('Honda', 6000, 3000, 5000),
('Leyland', 10000, 5000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `busmileage`
--

CREATE TABLE `busmileage` (
  `BusNumber` varchar(11) NOT NULL,
  `EngineService` int(11) NOT NULL,
  `TireService` int(11) NOT NULL,
  `TotalDistanceTravelled` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `OilService` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `busmileage`
--

INSERT INTO `busmileage` (`BusNumber`, `EngineService`, `TireService`, `TotalDistanceTravelled`, `deleted`, `OilService`) VALUES
('EH-5656', 45800, 9190, 60500, 0, 100),
('HI-4902', 4000, 2400, 7000, 0, 2100),
('JK-2910', 3200, 1200, 4500, 0, 3200),
('KH-8592', 30000, 24990, 125899, 0, NULL),
('NA-6520', 1998, 1998, 19982, 0, 4909),
('NB-1235', 9900, 1263, 13658, 0, 0),
('NB-7863', 7856, 4800, 13300, 0, 0),
('NC-2910', 6000, 3200, 10040, 0, NULL),
('NC-5678', 9800, 3200, 13700, 0, NULL),
('ND-2945', 9800, 4990, 12000, 0, NULL),
('NT-3901', 4000, 1000, 5600, 0, 3400),
('PT-4748', 3000, 2900, 6900, 1, 4990),
('RP-5693', 5900, 2800, 7840, 0, NULL),
('RS-2346', 5000, 2900, 7000, 0, 4200),
('SP-3659', 5900, 2800, 9040, 1, 3000),
('SU-2394', 5300, 2090, 7030, 1, 3200),
('TP-6784', 4300, 2000, 5600, 0, 3200),
('TU-6902', 3456, 433, 5000, 0, NULL),
('TY-4658', 6000, 2990, 7080, 0, NULL),
('US-5892', 4200, 4000, 9020, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bustable`
--

CREATE TABLE `bustable` (
  `BusId` varchar(100) NOT NULL,
  `BusNumber` varchar(255) NOT NULL,
  `BusCategory` varchar(80) NOT NULL,
  `EngineNumber` varchar(255) NOT NULL,
  `RegistrationDate` date NOT NULL,
  `ManufacturedYear` varchar(50) NOT NULL,
  `Colour` varchar(80) NOT NULL,
  `NumberOfSeats` int(11) NOT NULL,
  `BusState` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bustable`
--

INSERT INTO `bustable` (`BusId`, `BusNumber`, `BusCategory`, `EngineNumber`, `RegistrationDate`, `ManufacturedYear`, `Colour`, `NumberOfSeats`, `BusState`, `deleted`) VALUES
('Bus1', 'EH-5656', 'Demo', '2343234', '2020-06-14', '2020', 'blue', 56, 0, 0),
('Bus10', 'US-5892', 'Leyalnd', '0569356', '2019-10-23', '2005', 'Black', 52, 3, 1),
('Bus11', 'HI-4902', 'Honda', '9872643', '2000-12-25', '1998', 'Blue', 52, 2, 0),
('Bus12', 'RS-2346', 'Honda', '3075429', '2010-08-29', '2000', 'Black', 50, 3, 0),
('Bus13', 'SU-2394', 'Honda', '9570346', '2000-12-31', '1990', 'Black', 52, 3, 1),
('Bus14', 'TP-6784', 'Honda', '5678234', '2000-09-24', '1998', 'Black', 50, 2, 0),
('Bus15', 'JK-2910', 'Honda', '7890233', '2000-06-11', '1998', 'Blue', 52, 1, 0),
('Bus16', 'NC-5678', 'Leyland', '1234567', '2004-12-04', '1999', 'Black', 52, 2, 0),
('Bus17', 'PT-4748', 'Honda', '0987489', '2000-12-31', '1990', 'Black', 52, 1, 1),
('Bus18', 'ND-2945', 'Leyland', '9847444', '2000-08-15', '1990', 'Black', 52, 1, 0),
('Bus19', 'SP-3659', 'Honda', '7543489', '2002-02-11', '2000', 'Blue', 52, 2, 1),
('Bus2', 'KH-8592', 'Demo', '6544357', '2020-03-15', '2000', 'black', 40, 1, 1),
('Bus20', 'TY-4658', 'Leyland', '3447890', '2015-02-18', '2000', 'Black', 52, 1, 0),
('Bus3', 'NA-6520', 'Honda', '43057801', '2020-06-07', '1990', 'blue', 45, 1, 0),
('Bus4', 'RP-5693', 'Honda', '3447489', '2015-02-01', '2002', 'Black', 52, 0, 0),
('Bus5', 'NB-1235', 'Leyland', '6876124', '2020-06-07', '1980', 'blue', 55, 3, 0),
('Bus6', 'NB-7863', 'Leyland', '2353332', '2014-06-19', '2000', 'black', 50, 0, 1),
('Bus7', 'NC-2910', 'Leyalnd', '8495673', '2015-02-11', '2000', 'Blue', 52, 3, 0),
('Bus8', 'NT-3901', 'Honda', '9495673', '2014-02-11', '2005', 'Blue', 52, 3, 0),
('Bus9', 'TU-6902', 'Leyalnd', '9486056', '2015-05-13', '2000', 'Blue', 45, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `email` varchar(175) NOT NULL,
  `phone1` varchar(50) NOT NULL,
  `phone2` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(120) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip_code` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donerepairs`
--

CREATE TABLE `donerepairs` (
  `RepairId` int(11) NOT NULL,
  `FinishedDate` date NOT NULL,
  `RepairDescription` varchar(400) NOT NULL,
  `BusId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doneservice`
--

CREATE TABLE `doneservice` (
  `ServiceId` int(11) NOT NULL,
  `TypeofService` varchar(255) NOT NULL,
  `FinishedDate` date NOT NULL,
  `BusId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `labourdetails`
--

CREATE TABLE `labourdetails` (
  `LabourId` varchar(80) NOT NULL,
  `fullName` varchar(80) NOT NULL,
  `lastName` varchar(80) NOT NULL,
  `nameWIn` varchar(80) NOT NULL,
  `address` varchar(255) NOT NULL,
  `title` varchar(80) NOT NULL,
  `nic` varchar(80) NOT NULL,
  `tel` int(12) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `race` varchar(80) NOT NULL,
  `religion` varchar(80) NOT NULL,
  `img_path` text NOT NULL DEFAULT 'pf1.jpg',
  `dob` date NOT NULL,
  `LabourState` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `labourdetails`
--

INSERT INTO `labourdetails` (`LabourId`, `fullName`, `lastName`, `nameWIn`, `address`, `title`, `nic`, `tel`, `gender`, `race`, `religion`, `img_path`, `dob`, `LabourState`, `deleted`) VALUES
('Lab1', 'Devin', 'De Silva', 'D.Y De Silva', '145/5 Salgas mawatha maththegoda', 'Mr.', '982910110v', 776685899, 'male', 'Sinhalese', 'Buddhism', 'pf2.jpg', '2013-12-09', 0, 0),
('Lab10', 'Pathirage Avishka Perera', 'Perera', 'P.A.Perera', '65/2 S,Temple Road,Piliyandala', 'Mr.', '962354589v', 785236859, 'male', 'Sinhalese', 'Christian', 'pf5.jpg', '1996-10-09', 0, 0),
('Lab2', 'Clerk', 'Clerk', 'c.c', 'clerk', 'Mr.', '1029384756', 1029384756, 'male', 'Sinhalese', 'Buddhism', 'pf3.jpg', '2020-05-31', 0, 0),
('Lab3', 'Forman', 'Forman', 'Forman', 'Forman', 'Mr.', '1010101010', 1010101010, 'other', 'Sinhalese', 'Buddhism', 'pf4.jpg', '2020-06-17', 0, 0),
('Lab4', 'mechanic', 'mechanic', 'mechanic', 'mechanic', 'Mr.', '1234098756', 1234098756, 'other', 'Sinhalese', 'Buddhism', 'pf5.jpg', '2020-05-31', 0, 0),
('Lab5', 'Rahal Silva', 'Silva', 'R.Silva', '97/5, Hirana', 'Mr.', '963215478v', 112369547, 'male', 'Sinhalese', 'Buddhism', 'pf7.jpg', '1996-12-10', 0, 0),
('Lab6', 'Thushan Pathirage', 'Pathirage', 'T.Pathirage', '74/5 A, Colombo', 'Mr.', '923654159v', 112369847, 'male', 'Sinhalese', 'Buddhism', 'pf4.jpg', '1992-10-20', 0, 0),
('Lab7', 'Devin Perera', 'Perera', 'D.Perera', '34/7 H, Kesbewa', 'Mr.', '936520145v', 786596032, 'male', 'Burgher', 'Islam', 'pf6.jpg', '1993-10-18', 0, 0),
('Lab8', 'Kavishwa Wijesinghe', 'Wijesinghe', 'K.Wijesinghe', '56/9, Colombo', 'Mr.', '985632156v', 112365948, 'male', 'Burgher', 'Hinduism', 'pf5.jpg', '1998-08-03', 0, 0),
('Lab9', 'Sachin Gamage', 'Gamage', 'S.Gamage', '67/9, Negombo', 'Mr.', '902365148v', 725639048, 'male', 'Muslim', 'Christian', 'pf6.jpg', '1990-06-13', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `servicematrics`
--

CREATE TABLE `servicematrics` (
  `ServiceId` varchar(100) NOT NULL,
  `Lab2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `LabourId` varchar(80) NOT NULL,
  `username` varchar(150) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `acl` text NOT NULL,
  `deleted` int(11) NOT NULL,
  `VerificationKey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`LabourId`, `username`, `email`, `password`, `acl`, `deleted`, `VerificationKey`) VALUES
('Lab1', 'admin', 'devin.18@cse.mrt.ac.lk', '$2y$10$dPGVWWtXvVDqlRijU8tLhe0zb37vCfZWlH5l28vE228q/UUqjZb6K', 'Admin', 0, '0'),
('Lab10', 'Avishka96', 'don371519@gmail.com', '$2y$10$C4xQFJBJxTpzwa.XyoNHv.ZZTOS1J6frxtTf4rTOWGcNZH7Kvdq1a', 'Admin', 0, ''),
('Lab2', 'clerk', 'clerk.18@cse.mrt.ac.lk', '$2y$10$dPGVWWtXvVDqlRijU8tLhe0zb37vCfZWlH5l28vE228q/UUqjZb6K', 'Clerk', 0, '0'),
('Lab3', 'forman', 'forman@cse.mrt.ac.lk', '$2y$10$dPGVWWtXvVDqlRijU8tLhe0zb37vCfZWlH5l28vE228q/UUqjZb6K', 'Forman', 0, '0'),
('Lab4', 'mechanic', 'mechanic@cse.mrt.ac.lk', '$2y$10$dPGVWWtXvVDqlRijU8tLhe0zb37vCfZWlH5l28vE228q/UUqjZb6K', 'Mechanic', 0, '0'),
('Lab5', 'Rahal96', 'nipun.18@cse.mrt.ac.lk', '$2y$10$.GFhK/Os/y8c3ZgJO69ysuH9xdTiKIau97RUKPQfX9bwY1SNY8Cgi', 'Clerk', 0, ''),
('Lab6', 'Thushan92', 'nipun1deelaka@gmail.com', '$2y$10$2OVbuCuNWo6HlTgl8jQbJ.0THOfOJkHQ8u.4xzfHCNEqQMwKl/GnS', 'Forman', 0, ''),
('Lab7', 'Devin93', 'devindesilva123@gmail.com', '$2y$10$mbig3vw46FdgDJF/VF1tde6Rer3r7S0Dn85brxLrQ7A3FotIWcQWe', 'Mechanic', 0, ''),
('Lab8', 'Kavishwa98', 'nipun1deelaka@gmail.com', '$2y$10$mm7A8poFCDKKl.BSX4ETyeIH4JclTKRG8WS/zI7fVoZayqtejAqFe', 'Mechanic', 0, ''),
('Lab9', 'Sachin90', 'nipun1deelaka@gmail.com', '$2y$10$GGYxTV1Rm67BFpo9m5/AUuuZtuvHZoiYcAKuHxVICWC4edLkrvGNe', 'Mechanic', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `session_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`session_id`, `user_id`, `session`, `user_agent`) VALUES
(3, 9, 'sdsdsgs', 'sdgsgfsdhfgn'),
(4, 8, 'sfgdfgdgf', 'aqsacascasc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activeservices`
--
ALTER TABLE `activeservices`
  ADD PRIMARY KEY (`ServiceId`);

--
-- Indexes for table `buscategory`
--
ALTER TABLE `buscategory`
  ADD PRIMARY KEY (`BusType`);

--
-- Indexes for table `busmileage`
--
ALTER TABLE `busmileage`
  ADD PRIMARY KEY (`BusNumber`),
  ADD UNIQUE KEY `BusId` (`BusNumber`);

--
-- Indexes for table `bustable`
--
ALTER TABLE `bustable`
  ADD PRIMARY KEY (`BusId`),
  ADD UNIQUE KEY `BusId` (`BusId`),
  ADD UNIQUE KEY `BusNumber` (`BusNumber`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donerepairs`
--
ALTER TABLE `donerepairs`
  ADD PRIMARY KEY (`RepairId`);

--
-- Indexes for table `doneservice`
--
ALTER TABLE `doneservice`
  ADD PRIMARY KEY (`ServiceId`);

--
-- Indexes for table `labourdetails`
--
ALTER TABLE `labourdetails`
  ADD PRIMARY KEY (`LabourId`),
  ADD UNIQUE KEY `LabourId` (`LabourId`),
  ADD UNIQUE KEY `nic` (`nic`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`LabourId`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donerepairs`
--
ALTER TABLE `donerepairs`
  MODIFY `RepairId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doneservice`
--
ALTER TABLE `doneservice`
  MODIFY `ServiceId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
