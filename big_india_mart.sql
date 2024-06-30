-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 08:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `big_india_mart`
--

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `id` int(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `redeem_point` varchar(30) NOT NULL,
  `upi` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `redeem`
--

INSERT INTO `redeem` (`id`, `email`, `redeem_point`, `upi`, `date`, `status`) VALUES
(5, 'satyamcgt2004@gmail.com', '550', 'abc@ybl', '23/06/2024', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `refer_and_earn`
--

CREATE TABLE `refer_and_earn` (
  `id` int(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `refer_email` varchar(100) NOT NULL,
  `refer_amount` varchar(10) NOT NULL,
  `refer_status` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refer_and_earn`
--

INSERT INTO `refer_and_earn` (`id`, `email`, `refer_email`, `refer_amount`, `refer_status`, `date`) VALUES
(13, 'satyam.mishra.ecelliitkgp@gmail.com', 'satyamcgt2004@gmail.com', '10', 'Yes', '23/06/2024');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `email_otp` varchar(20) NOT NULL,
  `email_verify` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `phone_otp` varchar(10) NOT NULL,
  `phone_verify` varchar(10) NOT NULL,
  `password` varchar(200) NOT NULL,
  `service` varchar(30) NOT NULL,
  `add1` varchar(100) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `state` varchar(100) NOT NULL,
  `regis_amount` varchar(10) NOT NULL,
  `regis_payment` varchar(10) NOT NULL,
  `payment_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `email`, `email_otp`, `email_verify`, `phone`, `phone_otp`, `phone_verify`, `password`, `service`, `add1`, `add2`, `city`, `pincode`, `state`, `regis_amount`, `regis_payment`, `payment_id`) VALUES
(31, 'Manish Kumar', 'manishkumar16036@gmail.com', '2529', 'Yes', '9693613140', '4533', 'No', '$2y$10$swuOQ4vx75Y81IIrW4MlHO2JzZkW4wIyb0cOee0sRijLnDeLaNkTy', '', 'Areraj', 'East Champaran', 'Motihari', '845419', 'Bihar', '10', 'Paid', 'no'),
(32, 'Satyam Mishra', 'satyamcgt2004@gmail.com', '6928', 'Yes', '8210948861', '1756', 'No', '$2y$10$EhArTSlnx.2kU2PxqlQjKuHbjTzYrbiCAInQ4ofnPCFQOGbGqidVm', '', 'KUCHAIKOTE, GOPALGANJ', 'KUCHAIKOTE, GOPALGANJ', 'Gopalganj', '841503', 'Bihar', '10', 'Paid', 'no'),
(35, 'Satyam Mishra', 'satyam.mishra.ecelliitkgp@gmail.com', '1103', 'Yes', '8210948861', '9710', 'No', '$2y$10$aGu7HJTfsaXajwYGHt5Za.5Uso4Sayjtah4.6rQsF4rYhqjQhENQa', '', 'Kuchaikote', 'Gopalganj', 'Gopalganj', '841502', 'Bihar', '10', 'Paid', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(200) NOT NULL,
  `services` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `cashback` varchar(10) NOT NULL,
  `bonus` varchar(10) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `services`, `user`, `date`, `status`, `cashback`, `bonus`, `message`) VALUES
(24, 'Legal Service', 'manishkumar16036@gmail.com', '09/06/2024', 'Closed', '200', '50', 'cdcdcd vcdsc c sdcxc sds  scsdcsd'),
(25, 'House Rent Service', 'manishkumar16036@gmail.com', '09/06/2024', 'Closed', '50', '25', 'v xvdfh dhdfgjeh  ghdfhg '),
(26, 'Tax Consultancy Service', 'manishkumar16036@gmail.com', '10/06/2024', 'Request Created', '0', '0', 'fxgs sfhs sdfjs sdfjsd sdffsd '),
(27, 'Educational Service', 'satyamcgt2004@gmail.com', '23/06/2024', 'Closed', '500', '50', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(100) NOT NULL,
  `wallet_point` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `wallet_point`, `email`) VALUES
(8, '200', 'manishkumar16036@gmail.com'),
(9, '10', 'satyamcgt2004@gmail.com'),
(12, '0', 'satyam.mishra.ecelliitkgp@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refer_and_earn`
--
ALTER TABLE `refer_and_earn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `refer_and_earn`
--
ALTER TABLE `refer_and_earn`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
