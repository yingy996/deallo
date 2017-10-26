-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2017 at 08:34 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

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
  `rating` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `price`, `shipping_fee`, `shipping_agents`, `seller_id`, `created`, `modified`, `img`, `rating`) VALUES
('GXM981', 'Black and White Lanterns', 'Bunch of lanterns', 'roomDecor', '53.00', '7.00', 'fedex', 'JosephSim#16801', '2017-10-22', '2017-10-22', 'productImages/wawwlrqytuky73rtalri.png_,_productImages/Shimbashi rain. Tokyo, Japan..jpg_,_productImages/nrzwvx3dxlu0qai569to.jpg_,_productImages/Higashi Honganji Garden.jpg', NULL),
('KDF170', 'Flatiron Nightfall Neon ', 'New York City', 'craftSupplies', '543.00', '5.00', 'abx', 'josephsim', '2017-10-22', '2017-10-22', 'productImages/Flatiron - New York City, New York.jpg', '3.50'),
('MCV930', 'Lumiose City', 'Paris, France', 'jewelry', '15.00', '5.00', 'poslaju,ctlink,FedEx', 'josephsim', '2017-10-22', '2017-10-22', 'productImages/bolzjztocaixmrqt8y7b.jpg', NULL),
('WQY947', 'Higashi Honganji Garden', 'This is a photo of a Japanese garden', 'vintageArts', '84.00', '4.00', 'poslaju,gdex', 'josephsim', '2017-10-22', '2017-10-22', 'productImages/Higashi Honganji Garden.jpg', NULL);

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
