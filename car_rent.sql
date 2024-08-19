-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2022 at 08:00 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rent`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` varchar(30) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `status`, `id`) VALUES
('ad_mule', 'waQtBT26nVSI7RN', 'Activated', 27),
('Biruk_AY', 'biruk12qweQW45', 'Activated', 1),
('Eyob_Tesh', 'bXG95lt5BqNznfD', 'Activated', 28),
('Galo_Med', 'gjhPrppftxhYxK1', 'Activated', 30),
('helen_meles', 'mOK39dbs9iBBoxY', 'Activated', 29);

-- --------------------------------------------------------

--
-- Table structure for table `car_log`
--

CREATE TABLE `car_log` (
  `log_id` int(11) NOT NULL,
  `requested_by` varchar(20) NOT NULL,
  `rdate` date NOT NULL,
  `car` varchar(20) NOT NULL,
  `driver` varchar(25) NOT NULL,
  `l_approve` date DEFAULT NULL,
  `f_approve` date DEFAULT NULL,
  `m_approve` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_log`
--

INSERT INTO `car_log` (`log_id`, `requested_by`, `rdate`, `car`, `driver`, `l_approve`, `f_approve`, `m_approve`, `returned_date`) VALUES
(4, '29', '2022-06-24', 'eth10', '7', '2022-06-24', '2022-06-24', '2022-06-24', '2022-06-24'),
(5, '29', '2022-06-24', 'eth10', '7', '2022-06-24', '2022-06-24', '2022-06-24', '2022-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `car_requests`
--

CREATE TABLE `car_requests` (
  `rq_id` int(11) NOT NULL,
  `requested_by` varchar(20) NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `car` varchar(20) NOT NULL,
  `driver` varchar(25) NOT NULL,
  `req_status` varchar(20) NOT NULL,
  `l_approve` date DEFAULT NULL,
  `f_approve` date DEFAULT NULL,
  `m_approve` date DEFAULT NULL,
  `returned_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_requests`
--

INSERT INTO `car_requests` (`rq_id`, `requested_by`, `sdate`, `edate`, `car`, `driver`, `req_status`, `l_approve`, `f_approve`, `m_approve`, `returned_date`) VALUES
(10, '29', '2022-06-24', '2022-06-24', 'eth11', '', 'F_approved', '2022-06-24', '2022-06-25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `drid` int(11) NOT NULL,
  `drfname` varchar(20) NOT NULL,
  `drlname` varchar(20) NOT NULL,
  `dremail` varchar(30) NOT NULL,
  `drpnumber` varchar(20) NOT NULL,
  `drlicense` varchar(20) NOT NULL,
  `drimage` varchar(40) NOT NULL,
  `drbday` date NOT NULL,
  `drstatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`drid`, `drfname`, `drlname`, `dremail`, `drpnumber`, `drlicense`, `drimage`, `drbday`, `drstatus`) VALUES
(10, 'D', 'M', 'kulhabesh31@gmail.com', '454354', 'dg5454', 'IMG_20220405_142019_479.jpg', '2022-06-26', 'Available'),
(12, 'sds', 'Das', 'kulhabesh31@gmail.com', '4324', 'lsc', 'adis.jpeg', '2022-06-15', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` int(15) NOT NULL,
  `bdate` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `email`, `phone`, `bdate`, `gender`, `photo`, `role`) VALUES
(1, 'Biruk', 'AY', 'biruk@gmail.com', 912121212, '2022-06-23', 'Male', '', 'Admin'),
(27, 'ad', 'mule', 'kulhabesh31@gmail.com', 2147483647, '2022-06-21', 'Male', 'D', 'Manager'),
(28, 'Eyob', 'Tesh', 'kulhabesh31@gmail.com', 2147483647, '2022-06-22', 'Male', 'D', 'Logistics'),
(29, 'helen', 'meles', 'kulhabesh31@gmail.com', 2147483647, '2022-06-22', 'Male', 'D', 'Sales'),
(30, 'Galo', 'Med', 'kulhabesh31@gmail.com', 2147483647, '2022-06-22', 'Male', 'D', 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `plate` varchar(11) NOT NULL,
  `vtype` varchar(11) NOT NULL,
  `ftype` varchar(11) NOT NULL,
  `mileage` varchar(11) NOT NULL,
  `price_per_day` int(5) NOT NULL,
  `model_year` int(5) NOT NULL,
  `seat_capacity` int(2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `owner` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`plate`, `vtype`, `ftype`, `mileage`, `price_per_day`, `model_year`, `seat_capacity`, `status`, `owner`) VALUES
('eth01', 'Toyota', 'fuel 0', '1500', 120, 2005, 4, 'Not set', 'company'),
('eth2', 'v8', 'fuel1', '500', 120, 1998, 3, 'Not set', 'id1'),
('eth3', 'v8', 'benzene', '500', 2000, 2009, 0, 'Not set', 'company');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_owners`
--

CREATE TABLE `vehicle_owners` (
  `id` int(11) NOT NULL,
  `O_id` varchar(30) NOT NULL,
  `O_fname` varchar(25) NOT NULL,
  `O_lname` varchar(25) NOT NULL,
  `O_phone` varchar(15) NOT NULL,
  `O_car_plate` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_owners`
--

INSERT INTO `vehicle_owners` (`id`, `O_id`, `O_fname`, `O_lname`, `O_phone`, `O_car_plate`) VALUES
(1, 'company', '', '', '', 'eth01'),
(2, 'id1', 'Adisu', 'Mulu', '924703531', 'eth2'),
(4, 'company', '', '', '', 'eth3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `car_log`
--
ALTER TABLE `car_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `car_requests`
--
ALTER TABLE `car_requests`
  ADD PRIMARY KEY (`rq_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`drid`),
  ADD UNIQUE KEY `pnumber` (`drpnumber`),
  ADD UNIQUE KEY `drlicense` (`drlicense`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`plate`);

--
-- Indexes for table `vehicle_owners`
--
ALTER TABLE `vehicle_owners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_log`
--
ALTER TABLE `car_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `car_requests`
--
ALTER TABLE `car_requests`
  MODIFY `rq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `drid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vehicle_owners`
--
ALTER TABLE `vehicle_owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
