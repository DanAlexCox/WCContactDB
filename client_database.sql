-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 01:21 PM
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
  `Religion` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`Client_ID`, `Email`, `Prefix`, `Forename`, `Surname`, `Gender`, `Age`, `Religion`, `Created_at`, `Updated_at`) VALUES
(1, 'adala738@gmail.com', 'Mr', 'Daniel', 'Cox', 'Male', 24, 'Christianity', '2024-12-12 00:00:00', '2024-12-12 13:05:07'),
(2, 'daniel@womensconsortium.org.uk', 'Dr', 'Danny', 'Coal', 'Male', 25, 'Islam', '2024-12-12 00:00:00', '2024-12-12 13:11:26'),
(3, 'Daniel@womensconsortium.org.uk', 'Prof', 'John', 'Doe', 'Male', 30, 'Judaism', '2024-12-12 00:00:00', '2024-12-12 13:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_user`
--

CREATE TABLE `clinic_user` (
  `User_ID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clinic_user`
--

INSERT INTO `clinic_user` (`User_ID`, `Username`, `Password`, `Email`, `Created_at`, `Updated_at`) VALUES
(1, 'DanCox', 'JohnDoe', 'adala738@gmail.com', '2024-12-12 14:00:58', '2024-12-12 14:00:58');

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
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `impactr`
--

INSERT INTO `impactr` (`Impactr_ID`, `Client_ID`, `Onehelp`, `Tworecovery`, `Threeimprove`, `Rating`, `Created_at`, `Updated_at`) VALUES
(1, 1, 'help', 'recover', 'improve', 2, '2024-12-12 14:01:22', '2024-12-12 14:01:22'),
(2, 3, 'helper', 'recoverer', 'improver', 4, '2024-12-12 14:01:22', '2024-12-12 14:01:22'),
(3, 1, '', '', '', 0, '2024-12-12 14:01:22', '2024-12-12 14:01:22'),
(4, 2, 'Health', 'Recovery', 'Future', 5, '2024-12-12 14:01:22', '2024-12-12 14:01:22'),
(5, 2, 'Hello', 'World', '!!', 4, '2024-12-12 14:01:22', '2024-12-12 14:01:22'),
(6, 2, 'World', 'Hello', '!!', 0, '2024-12-12 14:01:22', '2024-12-12 14:01:22'),
(7, 1, 'I am Daniel', 'This is hello world', 'Hello Daniel I am Hello world', 3, '2024-12-12 14:01:22', '2024-12-12 14:01:22'),
(8, 1, 'Its good', 'I am happy', 'No', 5, '2024-12-12 14:01:22', '2024-12-12 14:01:22'),
(9, 1, 'Health', 'This is hello world', 'Future', 5, '2024-12-12 14:01:22', '2024-12-12 14:01:22');

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
  `Partner_email` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`Partner_ID`, `Partner_name`, `Address`, `Join_date`, `Contribution`, `Representative`, `Partner_email`, `Created_at`, `Updated_at`) VALUES
(1, 'DCCompany', 'h69 3DE', '2024-11-20', 5, 'Mr Daniel Cox', 'adala738@gmail.com', '2024-12-12 14:01:35', '2024-12-12 14:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `staff_user`
--

CREATE TABLE `staff_user` (
  `User_ID` int(11) NOT NULL,
  `Staff_email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Privilege` varchar(255) DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_user`
--

INSERT INTO `staff_user` (`User_ID`, `Staff_email`, `Username`, `Password`, `Privilege`, `Created_at`, `Updated_at`) VALUES
(1, 'Daniel@womensconsortium.org.uk', 'DanielCox', '$2y$10$f4oV7ZKKnCk4SV7Zxlv.4eoB/CeWZ1hs0LqX9lWy3qZALQrOklwui', 'VCM', '2024-12-12 14:01:47', '2024-12-16 12:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `symptomgroups`
--

CREATE TABLE `symptomgroups` (
  `SymptomGroup_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptomgroups`
--

INSERT INTO `symptomgroups` (`SymptomGroup_ID`, `Name`, `Created_at`, `Updated_at`) VALUES
(1, 'Mood Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(2, 'Anxiety Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(3, 'Psychotic Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(4, 'Personality Disorders:', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(5, 'Eating Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(6, 'Neurodevelopmental Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(7, 'Substance Use Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(8, 'Other Symptoms', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(9, 'Trauma- and Stressor-Related Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(10, 'Obsessive-Compulsive and Related Disorders:', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(11, 'Somatic Symptom and Related Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(12, 'Neurocognitive Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(13, 'Paraphilic Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(14, 'Dissociative Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(15, 'Neurodevelopmental Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(16, 'Sleep-Wake Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(17, 'Sexual Dysfunctions', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(18, 'Gender Dysphoria', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(19, 'Disruptive, Impulse-Control, and Conduct Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58'),
(20, 'Paraphilic Disorders', '2024-12-12 14:01:58', '2024-12-12 14:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `Symptom_ID` int(11) NOT NULL,
  `SymptomGroup_ID` int(11) NOT NULL,
  `SymptomSubGroup_ID` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`Symptom_ID`, `SymptomGroup_ID`, `SymptomSubGroup_ID`, `Created_at`, `Updated_at`) VALUES
(1, 1, 1, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(2, 1, 2, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(3, 1, 3, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(4, 2, 4, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(5, 2, 5, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(6, 2, 6, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(7, 2, 7, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(8, 2, 8, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(9, 3, 9, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(10, 3, 10, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(11, 4, 11, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(12, 4, 12, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(13, 4, 13, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(14, 5, 14, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(15, 5, 15, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(16, 5, 16, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(17, 6, 17, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(18, 6, 18, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(19, 7, 19, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(20, 7, 20, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(21, 8, 21, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(22, 8, 22, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(23, 8, 23, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(24, 8, 24, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(25, 8, 25, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(26, 9, 26, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(27, 9, 27, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(28, 9, 28, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(29, 10, 29, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(30, 10, 30, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(31, 10, 31, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(32, 11, 32, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(33, 11, 33, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(34, 11, 34, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(35, 12, 35, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(36, 12, 36, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(37, 13, 37, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(38, 13, 38, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(39, 13, 39, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(40, 14, 40, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(41, 14, 41, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(42, 14, 42, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(43, 15, 43, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(44, 15, 44, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(45, 15, 45, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(46, 16, 46, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(47, 16, 47, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(48, 16, 48, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(49, 17, 49, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(50, 17, 50, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(51, 17, 51, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(52, 18, 52, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(53, 19, 53, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(54, 19, 54, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(55, 19, 55, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(56, 20, 56, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(57, 20, 57, '2024-12-12 14:02:14', '2024-12-12 14:02:14'),
(58, 20, 58, '2024-12-12 14:02:14', '2024-12-12 14:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `symptomsubgroups`
--

CREATE TABLE `symptomsubgroups` (
  `SymptomGroupSubgroup_ID_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `symptomsubgroups`
--

INSERT INTO `symptomsubgroups` (`SymptomGroupSubgroup_ID_ID`, `Name`, `Created_at`, `Updated_at`) VALUES
(1, 'Depression', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(2, 'Bipolar Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(3, 'Dysthymia', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(4, 'Generalized Anxiety Disorder (GAD)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(5, 'Panic Attacks', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(6, 'Social Anxiety Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(7, 'Obsessive-Compulsive Disorder (OCD)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(8, 'Post-Traumatic Stress Disorder (PTSD)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(9, 'Schizophrenia', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(10, 'Schizoaffective Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(11, 'Borderline Personality Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(12, 'Antisocial Personality Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(13, 'Narcissistic Personality Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(14, 'Anorexia Nervosa', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(15, 'Bulimia Nervosa', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(16, 'Binge-Eating Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(17, 'Attention-Deficit/Hyperactivity Disorder (ADHD)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(18, 'Autism Spectrum Disorder (ASD)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(19, 'Alcohol Use Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(20, 'Drug Dependence', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(21, 'Sleep Disturbances', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(22, 'Suicidal Ideation', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(23, 'Self-Harm Behaviors', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(24, 'Cognitive Impairments', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(25, 'Somatic Complaints', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(26, 'Post-Traumatic Stress Disorder (PTSD)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(27, 'Acute Stress Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(28, 'Adjustment Disorders', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(29, 'Adjustment Disorders', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(30, 'Obsessive-Compulsive Disorder (OCD)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(31, 'Body Dysmorphic Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(32, 'Hoarding Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(33, 'Somatic Symptom Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(34, 'Illness Anxiety Disorder (Hypochondriasis)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(35, 'Conversion Disorder (Functional Neurological Symptom Disorder)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(36, 'Delirium', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(37, 'Major and Mild Neurocognitive Disorders (e.g. Alzheimer\'s Disease)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(38, 'Exhibitionistic Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(39, 'Frotteuristic Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(40, 'Pedophilic Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(41, 'Dissociative Identity Disorder (DID)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(42, 'Dissociative Amnesia', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(43, 'Depersonalization/Derealization Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(44, 'Autism Spectrum Disorder (ASD)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(45, 'Attention-Deficit/Hyperactivity Disorder (ADHD)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(46, 'Specific Learning Disorders', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(47, 'Insomnia Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(48, 'Narcolepsy', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(49, 'Restless Legs Syndrome (RLS)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(50, 'Erectile Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(51, 'Female Orgasmic Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(52, 'Premature (Early) Ejaculation', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(53, 'Gender Dysphoria in Adolescents and Adults', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(54, 'Oppositional Defiant Disorder (ODD)', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(55, 'Conduct Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(56, 'Intermittent Explosive Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(57, 'Exhibitionistic Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(58, 'Frotteuristic Disorder', '2024-12-12 14:02:09', '2024-12-12 14:02:09'),
(59, 'Sexual Masochism and Sadism Disorders', '2024-12-12 14:02:09', '2024-12-12 14:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `treatmentgroups`
--

CREATE TABLE `treatmentgroups` (
  `TreatmentGroup_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatmentgroups`
--

INSERT INTO `treatmentgroups` (`TreatmentGroup_ID`, `Name`, `Created_at`, `Updated_at`) VALUES
(1, 'Psychotherapeutic Interventions', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(2, 'Pharmacological Treatments', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(3, 'Lifestyle and Supportive Measures', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(4, 'Crisis Intervention Plans', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(5, 'Acceptance and Commitment Therapy (ACT)', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(6, 'Mindfulness-Based Cognitive Therapy (MBCT)', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(7, 'Eye Movement Desensitization and Reprocessing (EMDR)', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(8, 'Narrative Therapy', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(9, 'Solution-Focused Brief Therapy (SFBT)', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(10, 'Motivational Interviewing', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(11, 'Art Therapy', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(12, 'Music Therapy', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(13, 'Dance/Movement Therapy', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(14, 'Play Therapy', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(15, 'Interpersonal Therapy (IPT)', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(16, 'Schema Therapy', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(17, 'Somatic Experiencing', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(18, 'Biofeedback', '2024-12-12 14:02:45', '2024-12-12 14:02:45'),
(19, 'Hypnotherapy', '2024-12-12 14:02:45', '2024-12-12 14:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `Treatment_ID` int(11) NOT NULL,
  `TreatmentGroup_ID` int(11) NOT NULL,
  `TreatmentSubGroup_ID` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatments`
--

INSERT INTO `treatments` (`Treatment_ID`, `TreatmentGroup_ID`, `TreatmentSubGroup_ID`, `Created_at`, `Updated_at`) VALUES
(1, 1, 1, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(2, 1, 2, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(3, 1, 3, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(4, 1, 4, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(5, 1, 5, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(6, 2, 6, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(7, 2, 7, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(8, 2, 8, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(9, 2, 9, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(10, 2, 10, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(11, 3, 11, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(12, 3, 12, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(13, 3, 13, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(14, 3, 14, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(15, 3, 15, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(16, 3, 16, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(17, 3, 17, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(18, 4, 18, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(19, 4, 19, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(20, 4, 20, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(21, 5, 21, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(22, 6, 22, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(23, 7, 23, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(24, 8, 24, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(25, 9, 25, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(26, 10, 26, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(27, 11, 27, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(28, 12, 28, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(29, 13, 29, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(30, 14, 30, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(31, 15, 31, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(32, 16, 32, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(33, 17, 33, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(34, 18, 34, '2024-12-12 14:02:29', '2024-12-12 14:02:29'),
(35, 19, 35, '2024-12-12 14:02:29', '2024-12-12 14:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `treatmentsubgroups`
--

CREATE TABLE `treatmentsubgroups` (
  `TreatmentSubGroup_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatmentsubgroups`
--

INSERT INTO `treatmentsubgroups` (`TreatmentSubGroup_ID`, `Name`, `Created_at`, `Updated_at`) VALUES
(1, 'Cognitive Behavioral Therapy (CBT)', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(2, 'Dialectical Behavior Therapy (DBT)', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(3, 'Psychodynamic Therapy', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(4, 'Family Therapy', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(5, 'Group Therapy', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(6, 'Antidepressants', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(7, 'Anxiolytics', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(8, 'Antipsychotics', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(9, 'Mood Stabilizers', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(10, 'Stimulants', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(11, 'Psychoeducation', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(12, 'Stress Management Techniques', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(13, 'Sleep Hygiene Education', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(14, 'Nutritional Counseling', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(15, 'Exercise Programs', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(16, 'Social Skills Training', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(17, 'Support Groups', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(18, 'Safety Planning', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(19, 'Emergency Contact Protocols', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(20, 'Hospitalization Procedures', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(21, 'Encourages acceptance of negative thoughts and feelings while committing to personal values to promote psychological flexibility.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(22, 'Combines cognitive therapy with mindfulness strategies to prevent relapse in depression and reduce anxiety.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(23, 'Utilizes guided eye movements to process and reduce distress associated with traumatic memories.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(24, 'Helps individuals separate themselves from their problems by re-authoring their personal narratives.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(25, 'Concentrates on identifying and enhancing existing strengths and resources to find solutions.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(26, 'A client-centered approach that enhances motivation to change by exploring and resolving ambivalence.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(27, 'Employs creative art-making processes to explore emotions, reduce anxiety, and improve self-esteem.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(28, 'Uses musical interventions to address emotional, cognitive, and social needs, promoting healing and well-being.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(29, 'Involves the therapeutic use of movement to improve emotional, cognitive, and physical integration.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(30, 'Utilizes play to help children express feelings, develop problem-solving skills, and process experiences.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(31, 'Focuses on improving interpersonal relationships and social functioning to alleviate depressive symptoms.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(32, 'Integrates elements of cognitive, behavioral, and psychodynamic therapies to address deep-seated patterns and beliefs.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(33, 'Addresses trauma by focusing on bodily sensations to release stored tension and promote healing.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(34, 'Teaches control over physiological functions to alleviate stress-related symptoms.', '2024-12-12 14:02:50', '2024-12-12 14:02:50'),
(35, 'Uses guided relaxation and focused attention to achieve a heightened state of awareness for therapeutic purposes.', '2024-12-12 14:02:50', '2024-12-12 14:02:50');

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
-- Indexes for table `symptomgroups`
--
ALTER TABLE `symptomgroups`
  ADD PRIMARY KEY (`SymptomGroup_ID`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`Symptom_ID`);

--
-- Indexes for table `symptomsubgroups`
--
ALTER TABLE `symptomsubgroups`
  ADD PRIMARY KEY (`SymptomGroupSubgroup_ID_ID`);

--
-- Indexes for table `treatmentgroups`
--
ALTER TABLE `treatmentgroups`
  ADD PRIMARY KEY (`TreatmentGroup_ID`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`Treatment_ID`);

--
-- Indexes for table `treatmentsubgroups`
--
ALTER TABLE `treatmentsubgroups`
  ADD PRIMARY KEY (`TreatmentSubGroup_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `Client_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clinic_user`
--
ALTER TABLE `clinic_user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `impactr`
--
ALTER TABLE `impactr`
  MODIFY `Impactr_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `Partner_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff_user`
--
ALTER TABLE `staff_user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `symptomgroups`
--
ALTER TABLE `symptomgroups`
  MODIFY `SymptomGroup_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `Symptom_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `symptomsubgroups`
--
ALTER TABLE `symptomsubgroups`
  MODIFY `SymptomGroupSubgroup_ID_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `treatmentgroups`
--
ALTER TABLE `treatmentgroups`
  MODIFY `TreatmentGroup_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `Treatment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `treatmentsubgroups`
--
ALTER TABLE `treatmentsubgroups`
  MODIFY `TreatmentSubGroup_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
