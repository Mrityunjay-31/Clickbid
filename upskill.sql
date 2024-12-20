-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 12:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upskill`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `sl_no` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`sl_no`, `email`, `fname`, `password`, `created_date`) VALUES
(1, 'adminrabi@upskill.com', 'Rabi', '1', '2024-12-03 20:51:41'),
(2, 'adminpratik@upskill.com', 'Pratik', '1', '2024-12-03 20:52:47'),
(3, 'adminmrityunjay@upskill.com', 'Mrityunjay', 'Admin@Mrityunjay.30', '2024-12-03 20:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `sl_no` int(11) NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `bidding_date` datetime NOT NULL,
  `deadline` datetime NOT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `features` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `contact_method` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `freelancer_id` varchar(255) NOT NULL,
  `freelancer_name` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`sl_no`, `project_id`, `project_name`, `description`, `category`, `price`, `bidding_date`, `deadline`, `skills`, `features`, `client_id`, `client_name`, `contact_method`, `contact`, `freelancer_id`, `freelancer_name`, `status`) VALUES
(15, 'P_67642df5e6ae5', '2D Gaming APP', 'This is a 2D gaming App based on UNITY and C.', 'app-development', 1700, '2024-12-19 20:00:13', '2024-12-19 20:02:00', 'C, Unity', 'Mobile Friendly', 'U_67625b9f8939a', 'pratik', 'phone', '7848066434', 'U_67625c043e58c', 'mrityunjay', 'LIVE'),
(16, 'P_67643a6fd1b50', 'AI Chat bot', 'This is chat bot using Ai and python', 'web-development', 1600, '2024-12-19 20:53:27', '2024-12-20 10:00:00', 'python, AI', 'Responsive Design, SEO Optimization, API Integration', 'U_6764394fdb973', 'user1', 'email', 'user@gmail.com', 'U_67625c043e58c', 'mrityunjay', 'LIVE'),
(18, 'P_67648635b9a0e', 'Ecommerce Website for Fashion Brand', 'The Ecommerce Website for a Fashion Brand will feature an intuitive online store for browsing and purchasing stylish clothing and accessories. With user-friendly navigation, product filtering, secure payment options, and a responsive design, customers can', 'web-development', 1015, '2024-12-20 02:16:45', '2025-12-21 10:00:00', 'JAVA, HTML,CSS, JS, MySQL', 'Responsive Design, SEO Optimization, API Integration', 'U_67625b88c7a06', 'rabi', 'phone', '7848066434', 'U_67625c043e58c', 'mrityunjay', 'LIVE'),
(19, 'P_676487e62723a', 'QuickRent', 'A peer-to-peer platform for renting household items, tools, and appliances. QuickRent allows users to list and rent items locally, promoting sustainability and cost-effectiveness. The app features secure transactions, item ratings, and real-time availabil', 'web-development', 2600, '2024-12-20 02:23:58', '2024-12-25 00:00:00', 'React, Node, Express, MongoDB , PayPal', 'Responsive Design, SEO Optimization, API Integration', 'U_67625c043e58c', 'mrityunjay', 'phone', '7894561230', 'U_67625b88c7a06', 'rabi', 'LIVE');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `sl_no` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `city` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`sl_no`, `user_id`, `username`, `email`, `password`, `dob`, `city`, `created_date`) VALUES
(23, 'U_67625b88c7a06', 'rabi', 'rabi@gmail.com', 'Rabi', '2004-11-21', 'Kolkata', '2024-12-18 10:50:08'),
(24, 'U_67625b9f8939a', 'pratik', 'pratik@gmail.com', 'Pratik', '2004-10-10', 'Cuttack', '2024-12-18 10:50:31'),
(25, 'U_67625c043e58c', 'mrityunjay', 'mrityunjay@gmail.com', '123', '2004-12-15', 'Mumbai', '2024-12-18 10:52:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
