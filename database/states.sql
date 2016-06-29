-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2016 at 04:17 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `courtconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
`id` int(10) NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `state_code` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `state_code`) VALUES
(1, 'Alaska', 'AK'),
(2, 'Alabama', 'AL'),
(3, 'Arkansas', 'AR'),
(4, 'Arizona', 'AZ'),
(5, 'California', 'CA'),
(6, 'Colorado', 'CO'),
(7, 'Connecticut', 'CT'),
(8, 'Washington,DC', 'DC'),
(9, 'Delaware', 'DE'),
(10, 'Florida', 'FL'),
(11, 'Georgia', 'GA'),
(12, 'Hawaii', 'HI'),
(13, 'Iowa', 'IA'),
(14, 'Idaho', 'ID'),
(15, 'Illinois', 'IL'),
(16, 'Indiana', 'IN'),
(17, 'Kansas', 'KS'),
(18, 'Kentucky', 'KY'),
(19, 'Louisiana', 'LA'),
(20, 'Massachusetts', 'MA'),
(21, 'Maryland', 'MD'),
(22, 'Maine', 'ME'),
(23, 'Michigan', 'MI'),
(24, 'Minnesota', 'MN'),
(25, 'Missouri', 'MO'),
(26, 'Mississippi', 'MS'),
(27, 'Montana', 'MT'),
(28, 'North Carolina', 'NC'),
(29, 'North Dakota', 'ND'),
(30, 'Nebraska', 'NE'),
(31, 'New Hampshire', 'NH'),
(32, 'New Jersey', 'NJ'),
(33, 'New Mexico', 'NM'),
(34, 'Nevada', 'NV'),
(35, 'New York', 'NY'),
(36, 'Ohio', 'OH'),
(37, 'Oklahoma', 'OK'),
(38, 'Oregon', 'OR'),
(39, 'Pennsylvania', 'PA'),
(40, 'Rhode Island', 'RI'),
(41, 'South Carolina', 'SC'),
(42, 'South Dakota', 'SD'),
(43, 'Tennessee', 'TN'),
(44, 'Texas', 'TX'),
(45, 'Utah', 'UT'),
(46, 'Virginia', 'VA'),
(47, 'Vermont', 'VT'),
(48, 'Washington', 'WA'),
(49, 'Wisconsin', 'WI'),
(50, 'West Virginia', 'WV'),
(51, 'Wyoming', 'WY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `states`
--
ALTER TABLE `states`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
