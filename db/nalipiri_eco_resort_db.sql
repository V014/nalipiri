-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 04:38 PM
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
-- Database: `nalipiri_eco_resort_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `water_usage` varchar(255) NOT NULL,
  `kWh_usage` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `water_bill` int(11) NOT NULL,
  `electric_bill` int(11) DEFAULT NULL,
  `total_bill` int(11) DEFAULT NULL,
  `room` int(3) NOT NULL,
  `occupants` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `customer_id`, `water_usage`, `kWh_usage`, `date`, `water_bill`, `electric_bill`, `total_bill`, `room`, `occupants`) VALUES
(1, 1, '30', '4', '2025-04-07 14:38:32', 3000, 600, 3600, 1, 2),
(2, 2, '35', '8', '2025-04-07 14:38:32', 3500, 1200, 4700, 2, 3);

--
-- Triggers `billing`
--
DELIMITER $$
CREATE TRIGGER `insert_electric_bill` BEFORE INSERT ON `billing` FOR EACH ROW BEGIN
    SET NEW.electric_bill = NEW.kWh_usage * 150;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_total` BEFORE INSERT ON `billing` FOR EACH ROW BEGIN
    SET NEW.total_bill = NEW.water_bill + NEW.electric_bill;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_water_bill` BEFORE INSERT ON `billing` FOR EACH ROW BEGIN
    SET NEW.water_bill = NEW.water_usage * 100;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_electric_bill` BEFORE UPDATE ON `billing` FOR EACH ROW BEGIN
    SET NEW.electric_bill = NEW.kWh_usage * 150;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_total` BEFORE UPDATE ON `billing` FOR EACH ROW BEGIN
    SET NEW.total_bill = NEW.water_bill + NEW.electric_bill;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_water_charge` BEFORE UPDATE ON `billing` FOR EACH ROW BEGIN
    SET NEW.water_bill = NEW.water_usage * 100;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` enum('read','unread') NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `customer_id`, `message`, `status`, `date`) VALUES
(1, 1, 'Welcome to Nalipiri Eco Resort, This is our user dashboard meant to display more about the usage of water and electricity and other services. To promote transparency to our customers and enable a flexible budget so that each customer is charged fairly.', 'unread', '2025-03-31 16:55:20'),
(2, 2, 'Welcome to Nalipiri Eco Resort, This is our user dashboard meant to display more about the usage of water and electricity and other services. To promote transparency to our customers and enable a flexible budget so that each customer is charged fairly.', 'unread', '2025-03-31 16:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `date_registered`) VALUES
(1, 'Wanga', '1234', 'customer', '2025-04-07 14:05:30'),
(2, 'Emmanuel', '1234', 'customer', '2025-04-07 14:05:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
