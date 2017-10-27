-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 09:01 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `shipping_fee` decimal(10,2) NOT NULL,
  `shipping_agents` varchar(50) DEFAULT NULL,
  `seller_id` varchar(15) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `img` text NOT NULL,
  `rating` decimal(10,1) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `price`, `shipping_fee`, `shipping_agents`, `seller_id`, `created`, `modified`, `img`, `rating`, `deleted`) VALUES
('PDI435', 'Rawr', 'RawrRawr', 'weddingAccessories', '99999999.00', '99999997.00', 'poslaju,gdex', 'coucou', '2017-10-25', '2017-10-25', 'productImages/cool_darling.jpg', '5.0', 0),
('VBV503', 'asfasdzf', 'asdasd', 'toy', '123.00', '22.00', 'fedex', 'coucou', '2017-10-27', '2017-10-27', 'productImages/nimama.png', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
