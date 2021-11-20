-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2021 at 08:19 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room-booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(27, 'poonam', 'poonam2002', 'pabo'),
(28, 'arpita londhe', 'arpita2001', 'pabo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `room` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `no_rooms` int(11) NOT NULL,
  `no_days` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `cust_name` varchar(150) NOT NULL,
  `cust_contact` varchar(20) NOT NULL,
  `cust_email` varchar(150) NOT NULL,
  `cust_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id`, `room`, `price`, `no_rooms`, `no_days`, `total`, `checkin_date`, `checkout_date`, `status`, `cust_name`, `cust_contact`, `cust_email`, `cust_address`) VALUES
(1, 'Room with view', '300.00', 1, 1, '300.00', '2021-11-19', '2021-11-27', 'On Booking', 'poonam bhilare', '8080993843', 'poonambhilare758@gmail.com', '  pune'),
(2, 'Grand suite', '450.00', 2, 2, '1800.00', '2021-11-19', '2021-11-20', 'Cancelled', 'poonam bhilare', '8080993843', 'poonambhilare758@gmail.com', ' pune'),
(3, 'Grand suite', '450.00', 3, 3, '4050.00', '2021-11-18', '2021-11-21', 'Check Out', 'poonam bhilare', '8080993843', 'poonambhilare758@gmail.com', ' pune'),
(4, 'Room with view', '300.00', 1, 6, '1800.00', '2021-11-20', '2021-11-26', 'Booked', 'arpita londhe', '8080993843', 'alien@gmail.com', '  pune'),
(5, 'Room with view', '300.00', 1, 1, '300.00', '2021-11-19', '2021-11-20', 'Check Out', 'arpita londhe', '8080993843', 'alien@gmail.com', '     mumbai'),
(6, 'Grand suite', '450.00', 1, 1, '450.00', '2021-11-19', '2021-11-20', 'Cancelled', 'arpita londhe', '8080993843', 'poonambhilare758@gmail.com', ' kola'),
(7, 'Room with view', '300.00', 1, 14, '4200.00', '2021-11-19', '2021-11-20', 'Booked', 'poonam bhilare', '8080993843', 'poonambhilare758@gmail.com', ' india'),
(8, 'Presidential suite', '450.00', 3, 3, '4050.00', '2021-11-18', '2021-11-23', 'Check Out', 'varsha bhilare', '8010584556', 'varshabhilare@gmail.com', '    pune'),
(9, 'Presidential suite', '450.00', 20, 10, '90000.00', '2021-11-19', '2021-11-29', 'Booked', 'Harshada awhale', '8080143912', 'hap.0061.sp@gmail.com', ' india'),
(10, 'Room with view', '300.00', 1, 1, '300.00', '2021-11-26', '2021-11-27', 'Booked', 'varsha bhilare', '8010584556', 'hap.0061.sp@gmail.com', ' korea'),
(11, 'Room with view', '300.00', 1, 1, '300.00', '2021-11-19', '2021-11-20', 'Booked', 'varsha bhilare2', '8080143912', 'hap.0061.sp@gmail.com', ' pakistan'),
(12, 'Room with view', '300.00', 1, 1, '300.00', '2021-11-06', '2021-11-07', 'Booked', 'Harshada awhale', '8010584556', 'hap.0061.sp@gmail.com', ' wagholi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(18, 'single bed', 'Room_Category_5485.jpeg', 'Yes', 'Yes'),
(19, 'Double Bed', 'Room_Category_8651.jpeg', 'Yes', 'Yes'),
(20, 'Triple Bed', 'Room_Category_8390.jpeg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`id`, `title`, `description`, `price`, `image_name`, `featured`, `active`, `category_id`) VALUES
(12, 'Deluxe Single Bed Room', 'Standard Room', '30.00', 'Room-Name_2558.jpg', 'Yes', 'Yes', 18),
(13, 'Deluxe Double Bed Room', 'Standard Room', '50.00', 'Room-Name_1399.jpeg', 'No', 'Yes', 19),
(14, 'Deluxe Tripple Bed Room', 'Standard Room', '70.00', 'Room-Name-9404.jpeg', 'No', 'Yes', 20),
(15, 'Premium Single Bed Room', ' Executive Room', '40.00', 'Room-Name_5668.jpg', 'Yes', 'Yes', 18),
(16, 'Premium Double Bed Room', 'Executive room', '60.00', 'Room-Name-3535.jpeg', 'No', 'Yes', 19),
(17, 'Premium Tripple Bed Room', 'Executive Room', '70.00', 'Room-Name-1136.jpeg', 'No', 'Yes', 20),
(18, 'Room with view single bed room', 'Sea view', '50.00', 'Room-Name_8086.jpeg', 'Yes', 'Yes', 18),
(19, 'Room with view double bed room', 'City View', '70.00', 'Room-Name_7396.jpeg', 'No', 'Yes', 19),
(20, 'Room with view Tripple bed room', 'City View', '80.00', 'Room-Name_2913.jpeg', 'No', 'Yes', 20),
(21, 'Junior Suite Single-bed Room', 'Luxury rooms.', '60.00', 'Room-Name_5099.jpeg', 'Yes', 'Yes', 18),
(22, 'Junior Suite Double-bed Room', 'Luxury Rooms', '80.00', 'Room-Name_3272.jpeg', 'No', 'Yes', 19),
(23, 'Junior Suite Tripple-bed Room', 'Luxury Rooms', '90.00', 'Room-Name_4043.jpeg', 'No', 'Yes', 20),
(24, 'Grand Suite Single-bed Room', 'Luxurious Room', '120.00', 'Room-Name_9505.jpeg', 'Yes', 'Yes', 18),
(25, 'Grand Suite Double-bed Room', 'Luxurious Room', '100.00', 'Room-Name_5421.jpeg', 'No', 'Yes', 19),
(26, 'Grand Suite Tripple-bed Room', 'Luxurious Room', '120.00', 'Room-Name_516.jpeg', 'No', 'Yes', 20),
(27, 'Presidential Suite', 'Royal Suite', '100.00', 'Room-Name_8920.jpeg', 'Yes', 'Yes', 18),
(28, 'Precidential Suite 2', 'Royal Rooms', '120.00', 'Room-Name_2612.jpeg', 'No', 'Yes', 19),
(29, 'Precidential Suite 3', 'Royal Rooms', '150.00', 'Room-Name_2717.jpeg', 'No', 'Yes', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
