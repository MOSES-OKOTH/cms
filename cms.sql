-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 10:22 PM
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
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `staff_no` varchar(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`staff_no`, `name`, `email`, `phone_no`, `password`) VALUES
('2024', 'DERRICK SHANZU', 'dshanzu@tum.ac.ke', '0712345678', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` varchar(200) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `added_on` varchar(50) DEFAULT NULL,
  `resolution` text DEFAULT NULL,
  `resolution_date` varchar(30) DEFAULT NULL,
  `reg_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `name`, `contact`, `subject`, `message`, `status`, `added_on`, `resolution`, `resolution_date`, `reg_no`) VALUES
('CMS20240724120622', 'MOSES OKOTH', '0724421886', 'TEST SUBJECT', 'Test message', '0', '2024-07-24 12:07:22', NULL, NULL, ''),
('CMS20240724120758', 'MOSES OKOTH', '0724421886', 'TEST SUBJECT', 'Another test message s', '0', '2024-07-24 12:07:58', NULL, NULL, ''),
('CMS20240724121541', 'MOSES OKOTH', '0724421886', 'TEST SUBJECT', 'hahshasgdghsdgdgsahjbdhsdjbh', '0', '2024-07-24 12:07:41', NULL, NULL, ''),
('CMS20240724121613', 'MOSES OKOTH', '0724421886', 'TEST SUBJECT', 'teststststststs', '0', '2024-07-24 12:07:13', NULL, NULL, ''),
('CMS20240724121700', 'MOSES OKOTH', '0724421886', 'TEST SUBJECT', '7yhnyub gyhvftgy', '1', '2024-07-24 12:07:00', NULL, NULL, ''),
('CMS20240724143837', 'DERRICK CHANZU', 'bmcs340j2020@students.tum.ac.ke - 0712345678', 'TEST SUBJECT', 'test sssss', '0', '2024-07-24 14:07:37', NULL, NULL, ''),
('CMS20240724144908', 'DERRICK CHANZU', 'bmcs340j2020@students.tum.ac.ke - 0712345678', 'TEST SUBJECT', 'Test test', '0', '2024-07-24 14:07:08', NULL, NULL, ''),
('CMS20240724145118', 'DERRICK CHANZU', 'bmcs340j2020@students.tum.ac.ke - 0712345678', 'TEST SUBJECT', 'sjhsdaf,anfjajfjnafjmnfnjmb cjbnddjns', '0', '2024-07-24 14:07:18', NULL, NULL, 'BMCS/340J/2020'),
('CMS20240724150049', 'DERRICK CHANZU', 'bmcs340j2020@students.tum.ac.ke - 0712345678', 'TEST SUBJECT', 'yffygjhhj', '0', '2024-07-24 15:07:49', NULL, NULL, 'BMCS/340J/2020'),
('CMS20240724170238', '', '', '', '', '0', '2024-07-24 17:07:38', NULL, NULL, ''),
('CMS20240724170246', '', '', '', '', '0', '2024-07-24 17:07:46', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(100) NOT NULL,
  `complaint_id` text DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `read_on` varchar(30) DEFAULT NULL,
  `reg_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `complaint_id`, `subject`, `message`, `status`, `added_on`, `read_on`, `reg_no`) VALUES
(1, 'CMS20240724164516', 'WELCOME TO TUM CMS', 'Dear Students, welcome to TUM CMS portal. We look forward to hearing from you.', 'unread', '2024-07-24', NULL, 'all'),
(2, 'CMS20240724164516', 'WELCOME TO TUM CMS', 'Dear Derrick, welcome to TUM CMS portal. We look forward to hearing from you.', 'unread', '2024-07-24', NULL, 'BMCS/340J/2020');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `reg_no` varchar(30) NOT NULL,
  `name` varchar(80) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `department` varchar(50) NOT NULL,
  `password` text DEFAULT NULL,
  `added_on` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`reg_no`, `name`, `gender`, `email`, `phone_no`, `department`, `password`, `added_on`) VALUES
('BMCS/323J/2020', 'MOSES OKOTH', 'male', 'bmcs.323j.2020@students.tum.ac.ke', '0714263898', 'Maths and Physics', 'BMCS/323J/2020', '2024-07-24 22:07pm'),
('BMCS/340J/2020', 'DERRICK CHANZU', 'male', 'bmcs340j2020@students.tum.ac.ke', '0742804467', 'Maths and Physics', 'BMCS/340J/2020', '2024-07-24 22:07pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`staff_no`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
