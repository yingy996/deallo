-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2017 at 03:08 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deallo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` varchar(6) NOT NULL,
  `customer_id` varchar(15) NOT NULL,
  `seller_id` varchar(15) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `status_date` date NOT NULL,
  `order_price` decimal(10,2) NOT NULL,
  `shipping_address` text NOT NULL,
  `recipient_name` varchar(200) NOT NULL,
  `recipient_contact` varchar(50) NOT NULL,
  `shipping_agent` varchar(50) DEFAULT NULL,
  `tracking_number` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `customer_id`, `seller_id`, `order_date`, `status`, `status_date`, `order_price`, `shipping_address`, `recipient_name`, `recipient_contact`, `shipping_agent`, `tracking_number`) VALUES
('DXA938', 'jonlau', 'jonlau', '2017-10-29', 'Not paid', '2017-10-29', '280.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jonathan Lau', '0167483923', NULL, NULL),
('ESA375', 'jonlau', 'jonlau', '2017-10-28', 'Not paid', '2017-10-28', '775.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jonathan Lau', '0167483923', NULL, NULL),
('EST615', 'jonlau', 'coucou', '2017-10-28', 'Not paid', '2017-10-28', '1900.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jonathan Lau', '0167483923', NULL, NULL),
('GVF243', 'jonlau', 'coucou', '2017-10-28', 'Not paid', '2017-10-28', '1000.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jonathan Lau', '0167483923', NULL, NULL),
('HDE147', 'jonlau', 'jonlau', '2017-10-28', 'Not paid', '2017-10-28', '265.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jon Jon', '0167483923', NULL, NULL),
('KQD855', 'jonlau', 'jonlau', '2017-10-29', 'Not paid', '2017-10-29', '915.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jonathan Lau', '0167483923', NULL, NULL),
('MRP730', 'jonlau', 'jonlau', '2017-10-28', 'Not paid', '2017-10-28', '100.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jonathan Lau', '0167483923', NULL, NULL),
('RLG143', 'jonlau', 'jonlau', '2017-10-29', 'Not paid', '2017-10-29', '100.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jonathan Lau', '0167483923', NULL, NULL),
('TKM932', 'jonlau', 'coucou', '2017-10-29', 'Not paid', '2017-10-29', '3700.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jonathan Lau', '0167483923', NULL, NULL),
('TYA678', 'jonlau', 'jonlau', '2017-10-29', 'Paid', '2017-10-29', '100.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jonat Donut', '0167483923', NULL, NULL),
('WIG839', 'jonlau', 'jonlau', '2017-10-29', 'Not paid', '2017-10-29', '165.00', 'No.9, Haribo Street, 54020, KFC, McDonald', 'Jonathan Lau', '0167483923', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
