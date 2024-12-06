-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 03:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wc`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `Client_ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Prefix` varchar(255) NOT NULL,
  `Forename` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Religion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`Client_ID`, `Email`, `Prefix`, `Forename`, `Surname`, `Gender`, `Age`, `Religion`) VALUES
(1, 'adala738@gmail.com', 'Mr', 'Daniel', 'Cox', 'Male', 24, 'Christianity'),
(2, 'daniel@womensconsortium.org.uk', 'Mr', 'Dan', 'Coach', 'Male', 25, 'Atheist');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_user`
--

CREATE TABLE `clinic_user` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clinic_user`
--

INSERT INTO `clinic_user` (`User_ID`, `Username`, `Password`, `Email`) VALUES
(1, 'DanCox', 'JohnDoe', 'adala738@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `impactr`
--

CREATE TABLE `impactr` (
  `Impactr_ID` int(11) NOT NULL,
  `Client_ID` int(11) NOT NULL,
  `Onehelp` varchar(255) NOT NULL,
  `Tworecovery` varchar(255) NOT NULL,
  `Threeimprove` varchar(255) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `impactr`
--

INSERT INTO `impactr` (`Impactr_ID`, `Client_ID`, `Onehelp`, `Tworecovery`, `Threeimprove`, `Rating`, `Created_at`) VALUES
(1, 1, 'help', 'recover', 'improve', 2, '2024-12-05'),
(2, 3, 'helper', 'recoverer', 'improver', 4, '2024-12-05'),
(3, 1, '', '', '', 0, '2024-12-05'),
(4, 2, 'Health', 'Recovery', 'Future', 5, '2024-12-05'),
(5, 2, 'Hello', 'World', '!!', 4, '2024-12-05'),
(6, 2, 'World', 'Hello', '!!', 0, '2024-12-05'),
(7, 1, 'I am Daniel', 'This is hello world', 'Hello Daniel I am Hello world', 3, '2024-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `Partner_ID` int(11) NOT NULL,
  `Partner_name` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Join_date` date NOT NULL DEFAULT current_timestamp(),
  `Contribution` int(11) NOT NULL,
  `Representative` varchar(255) NOT NULL COMMENT 'Later make representative table',
  `Partner_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`Partner_ID`, `Partner_name`, `Address`, `Join_date`, `Contribution`, `Representative`, `Partner_email`) VALUES
(1, 'DCCompany', 'h69 3DE', '2024-11-20', 5, 'Mr Daniel Cox', 'adala738@gmail.com'),
(6, 'Womens Consortium', 'R59 3WT', '2024-11-28', 0, 'Mr Daniel Cox', 'adala738@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `staff_user`
--

CREATE TABLE `staff_user` (
  `User_ID` int(11) NOT NULL,
  `Staff_email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_user`
--

INSERT INTO `staff_user` (`User_ID`, `Staff_email`, `Username`, `Password`) VALUES
(3, 'Daniel@womensconsortium.org.uk', 'DanielCox', '$2y$10$f4oV7ZKKnCk4SV7Zxlv.4eoB/CeWZ1hs0LqX9lWy3qZALQrOklwui');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`Client_ID`);

--
-- Indexes for table `clinic_user`
--
ALTER TABLE `clinic_user`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `impactr`
--
ALTER TABLE `impactr`
  ADD PRIMARY KEY (`Impactr_ID`),
  ADD KEY `Client_ID` (`Client_ID`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`Partner_ID`);

--
-- Indexes for table `staff_user`
--
ALTER TABLE `staff_user`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `Client_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clinic_user`
--
ALTER TABLE `clinic_user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `impactr`
--
ALTER TABLE `impactr`
  MODIFY `Impactr_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `Partner_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff_user`
--
ALTER TABLE `staff_user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
