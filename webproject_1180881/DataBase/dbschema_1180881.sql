-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 01:51 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_31`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(120) NOT NULL,
  `Password` varchar(120) NOT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `UserName`, `Password`, `UpdationDate`) VALUES
(1, 'admin@store.ps', 'aaf4c61ddcc5e8a2dabede0f3b482cd9aea9434d', '2021-06-01 11:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `ID` int(11) NOT NULL,
  `VehicleId` varchar(250) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `FromDate` varchar(20) DEFAULT NULL,
  `ToDate` varchar(20) DEFAULT NULL,
  `TotalPrice` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`ID`, `VehicleId`, `UserID`, `FromDate`, `ToDate`, `TotalPrice`, `Status`, `PostingDate`) VALUES
(7, '2-2345-49', 8, '2021-06-24', '2021-06-26', 750, NULL, '2021-06-16 15:13:47'),
(8, '1-2355-42', 8, '2021-06-16', '2021-06-18', 135, NULL, '2021-06-16 15:15:41'),
(13, '1-2345-82', 8, '2021-06-16', '2021-06-18', 540, NULL, '2021-06-16 15:29:50'),
(14, '2-2345-49', 8, '2021-06-22', '2021-06-25', 1000, NULL, '2021-06-16 16:57:04'),
(15, '1-2355-42', 8, '2021-06-22', '2021-06-30', 405, NULL, '2021-06-16 17:02:13'),
(19, '2-2345-49', 8, '2021-05-04', '2021-05-06', 750, NULL, '2021-06-16 18:46:30'),
(20, '2-2345-49', 8, '2021-08-09', '2021-08-11', 750, NULL, '2021-06-16 18:54:57'),
(21, '1-2345-82', 8, '2021-06-19', '2021-06-20', 360, NULL, '2021-06-16 19:41:25'),
(22, '1-2345-82', 8, '2021-06-12', '2021-06-13', 360, NULL, '2021-06-16 19:45:48'),
(23, '1-2395-42', 8, '2021-06-08', '2021-06-17', 1200, NULL, '2021-06-16 22:13:36'),
(24, '2-2345-49', NULL, '2021-06-10', '2021-06-19', 2500, NULL, '2021-06-17 08:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `ID` int(11) NOT NULL,
  `BrandName` varchar(225) DEFAULT NULL,
  `CreateDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`ID`, `BrandName`, `CreateDate`, `updationDate`) VALUES
(1, 'BMW', '2021-06-11 17:37:22', NULL),
(6, 'toyota', '2021-06-11 17:46:31', NULL),
(7, 'Nissan', '2021-06-11 17:46:52', NULL),
(9, 'Kia', '2021-06-11 17:48:47', NULL),
(10, 'Ford', '2021-06-11 17:48:52', NULL),
(11, 'hyundai', '2021-06-11 17:49:30', NULL),
(15, 'mercedes', '2021-06-11 17:51:10', NULL),
(22, 'orobrand', '2021-06-12 05:57:10', NULL),
(26, 'marotest', '2021-06-12 06:54:43', '2021-06-12 07:01:59'),
(27, 'mazda', '2021-06-12 13:36:23', NULL),
(28, 'Audi', '2021-06-13 11:20:31', NULL),
(29, 'testPostBrand', '2021-06-14 09:34:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(120) NOT NULL,
  `Address` varchar(225) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `DateOfBirth` date DEFAULT NULL,
  `Mobile` int(11) DEFAULT NULL,
  `Telephone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FullName`, `Email`, `Password`, `Address`, `RegDate`, `UpdationDate`, `DateOfBirth`, `Mobile`, `Telephone`) VALUES
(8, 'Orouba', 'oro', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '  Qibya Ramallah      ', '2021-06-02 19:09:12', '2021-06-09 06:26:52', '2000-02-19', 56432222, 224352876),
(1180881, ' Orouba Test5  ', 'oror', '360e46f15f432af83c77017177a759aba8a58519', ' ramallah-Palestine ', '2021-06-08 18:34:51', '2021-06-08 18:49:01', '2020-12-08', 654324578, 453455555),
(111232343, 'ororororr', 'dd@fftt', '4ea842c8c6304f4a418835fb6665df10524df1a5', 'qibya', '2021-06-09 11:02:51', NULL, '2021-06-02', 1234565432, 234565432),
(112322132, 'rrrrrrrrrrrrrrrr', 'dd@ffeef', '4ea842c8c6304f4a418835fb6665df10524df1a5', 'dddd', '2021-06-09 19:29:33', NULL, '2021-06-04', 1234565437, 1234565434),
(123453245, 'Orouba_test_8', 'orouba@gh', '4ea842c8c6304f4a418835fb6665df10524df1a5', 'gh', '2021-06-09 16:22:38', NULL, '2020-09-02', 1234565432, 1254565432),
(123456743, 'orouba test8', 'oo@gm', '4ea842c8c6304f4a418835fb6665df10524df1a5', 'ramm', '2021-06-09 06:30:46', NULL, '2021-06-01', 1234532456, 234532456),
(123456785, 'test7', 'test7@gmail.com', '4ea842c8c6304f4a418835fb6665df10524df1a5', '444', '2021-06-09 06:17:00', NULL, '2021-06-01', 1111111, 1111111),
(123456789, 'Orouba_test_reg', 'oro1@gmail.com', '4ea842c8c6304f4a418835fb6665df10524df1a5', 'eee', '2021-06-09 06:10:42', NULL, '2021-06-02', NULL, 1111111),
(231234537, 'oooooooooooooooooooo', 'dd@ff22qq', '4ea842c8c6304f4a418835fb6665df10524df1a5', 'ddddddddd', '2021-06-13 04:05:37', NULL, '2021-06-01', 1234565437, 1234565434),
(232123452, 'Orouba Test_Update35', 'dd@ffee', '4ea842c8c6304f4a418835fb6665df10524df1a5', 'yy', '2021-06-09 18:38:24', NULL, '2021-06-04', 1234565432, 1234565434);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id_car_ref` int(11) NOT NULL,
  `VehiclesTitle` varchar(200) DEFAULT NULL,
  `CarReference` varchar(250) DEFAULT NULL,
  `VehiclesBrand` int(11) DEFAULT NULL,
  `VehiclesOverview` longtext CHARACTER SET utf8 DEFAULT NULL,
  `PricePerDay` int(11) DEFAULT NULL,
  `ModelYear` int(11) DEFAULT NULL,
  `SeatingCapacity` int(11) DEFAULT NULL,
  `Vimage1` varchar(130) DEFAULT NULL,
  `Vimage2` varchar(130) DEFAULT NULL,
  `Vimage3` varchar(130) DEFAULT NULL,
  `Vimage4` varchar(250) DEFAULT NULL,
  `ManCountry` varchar(60) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `AvailableColors` varchar(250) DEFAULT NULL,
  `HorsePower` int(11) DEFAULT NULL,
  `Length_` int(11) DEFAULT NULL,
  `Width` int(11) DEFAULT NULL,
  `AvgConPerKM` double DEFAULT NULL,
  `is_rental` int(11) DEFAULT 0 COMMENT 'this car is renal by another user or not',
  `RegStatus` int(11) DEFAULT 0 COMMENT 'هل هو عضو او لا',
  `status` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id_car_ref`, `VehiclesTitle`, `CarReference`, `VehiclesBrand`, `VehiclesOverview`, `PricePerDay`, `ModelYear`, `SeatingCapacity`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `ManCountry`, `RegDate`, `UpdationDate`, `AvailableColors`, `HorsePower`, `Length_`, `Width`, `AvgConPerKM`, `is_rental`, `RegStatus`, `status`) VALUES
(9, 'Nissan Vehicle', '2-2345-49', 7, '- Air conditioning vents for rear passengers\r\n- 8-inch touch screen\r\n- Heated and ventilated seats\r\n- Seat memory\r\n- Steering wheel controls and bluetooth feature\r\n-test test test', 250, 2021, 5, 'kia_sportage3.jpg', 'kia_sportage3.jpg', 'kia_sportage2.jpg', '', 'Indea', '2021-06-14 20:13:41', '2021-06-15 15:49:41', 'Red , Green', 120, 3, 2, 99, 0, 0, NULL),
(10, 'Audi car', '1-2545-42', 28, '- Keyless entry and start feature\r\n- Electric control mirrors with turn lights\r\n- Rear camera with sensors on the front and back\r\n- 9-inch touch screen\r\n- Heated and ventilated seats', 85, 2018, 7, 'kia_sportage2.jpg', 'kia_sportage3.jpg', 'kia_sportage4.jpg', '', 'Germany', '2021-06-15 06:05:23', NULL, 'white , black , Grey', 190, 4, 2, 87, 0, 0, NULL),
(11, 'Kia Test', '1-2355-42', 9, '- Rear camera with sensors on the front and back\r\n- Keyless entry and start feature\r\n- Air conditioning vents for rear passengers\r\n- 8-inch touch screen\r\n', 45, 2013, 5, 'kia_cerato4.jpg', 'kia_cerato1.jpg', 'kia_cerato2.jpg', '', 'Andorra', '2021-06-15 07:24:25', NULL, 'red, Green , Black', 44, 5, 2, 59, 0, 0, NULL),
(12, 'Audi Cerato', '1-2398-42', 10, '- Heated and ventilated seats\r\n- Seat memory\r\n- Steering wheel controls and bluetooth feature\r\n- Wireless charging feature for smartphones\r\n- 6 airbags', 83, 2019, 5, 'kia_cerato3.jpg', 'kia_cerato4.jpg', 'Hyundai_Accent3.jpg', 'Hyundai_Accent2.jpg', 'Andorra', '2021-06-15 09:10:07', '2021-06-15 15:50:28', 'white , black , Grey', 190, 5, 2, 120, 0, 0, NULL),
(13, 'Kia Cerato test', '1-2345-82', 1, '- Heated and ventilated seats\r\n- Seat memory\r\n- Steering wheel controls and bluetooth feature\r\n- Wireless charging feature for smartphones\r\n- 6 airbags', 180, 2021, 7, 'kia_cerato1.jpg', 'kia_cerato3.jpg', 'kia_cerato2.jpg', 'kia_cerato4.jpg', 'Andorra', '2021-06-15 14:08:56', NULL, 'white , black , Grey', 190, 5, 2, 55, 0, 0, NULL),
(14, 'Audi test', '1-2395-42', 28, '- Rear camera with sensors on the front and back\r\n- Air conditioning vents for rear passengers\r\n- 8-inch touch screen\r\n- Heated and ventilated seats\r\n- Seat memory', 120, 2019, 5, 'Hyundai_Accent1.jpg', 'Hyundai_Accent2.jpg', 'Hyundai_Accent3.jpg', 'Hyundai_Accent4.jpg', 'korea', '2021-06-15 14:10:14', NULL, 'white , black , Grey', 123, 4, 2, 33, 0, 0, NULL),
(15, 'BMW Test', '1-9845-42', 1, '- Keyless entry and start feature\r\n- Electric control mirrors with turn lights\r\n- Rear camera with sensors on the front and back\r\n- Air conditioning vents for rear passengers', 99, 2000, 7, 'Hyundai_Accent1.jpg', 'Hyundai_Accent3.jpg', 'Hyundai_Accent2.jpg', 'Hyundai_Accent4.jpg', 'Tokyo', '2021-06-15 14:20:00', NULL, 'red, Green ', 190, 5, 2, 120, 0, 0, NULL),
(16, 'Hyundai  Car', '1-9345-42', 11, '- Air conditioning vents for rear passengers\r\n- 8-inch touch screen\r\n- Heated and ventilated seats\r\n- Seat memory\r\n- Steering wheel controls and bluetooth feature', 35, 2013, 7, 'Hyundai_Accent2.jpg', 'Hyundai_Accent1.jpg', 'Hyundai_Accent3.jpg', 'Hyundai_Accent4.jpg', 'Palestine', '2021-06-15 14:25:33', NULL, 'white , Grey', 123, 5, 2, 78, 0, 0, NULL),
(17, 'ford', '1-2345-42', 10, '- Air conditioning vents for rear passengers\r\n- 8-inch touch screen\r\n- Heated and ventilated seats\r\n- Seat memory\r\n- Steering wheel controls and bluetooth feature\r\n- Wireless charging feature for smartphones', 120, 2020, 5, 'Hyundai_Accent3.jpg', 'Hyundai_Accent2.jpg', 'Hyundai_Accent4.jpg', 'Hyundai_Accent1.jpg', 'Palestine', '2021-06-15 14:27:29', NULL, 'red, Blue , white', 220, 5, 2, 120, 0, 0, NULL),
(18, 'Mazda car', '1-6745-42', 27, '- Electric control mirrors with turn lights\r\n- Rear camera with sensors on the front and back\r\n- Air conditioning vents for rear passengers\r\n- 8-inch touch screen\r\n- Heated and ventilated seats', 135, 2015, 7, 'Hyundai_Accent4.jpg', 'Hyundai_Accent3.jpg', 'Hyundai_Accent2.jpg', '', 'Palestine', '2021-06-15 14:29:34', '2021-06-15 15:29:56', 'red, White, Blue', 125, 4, 2, 58, 0, 0, NULL),
(20, 'Orouba Car', '1-2345-27', 1, '- Electric control mirrors with turn lights\r\n- Rear camera with sensors on the front and back\r\n- Air conditioning vents for rear passengers\r\n- 8-inch touch screen\r\n- Heated and ventilated seats', 199, 2021, 5, 'kia_sportage1.jpg', 'kia_sportage3.jpg', 'kia_sportage2.jpg', 'kia_sportage4.jpg', 'Palestine', '2021-06-16 21:20:37', NULL, 'Purple, White', 130, 4, 2, 48, 0, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Test1_user` (`UserID`),
  ADD KEY `Test2_veh` (`VehicleId`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id_car_ref`),
  ADD UNIQUE KEY `CarReference` (`CarReference`),
  ADD KEY `Test` (`VehiclesBrand`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id_car_ref` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `Test1_user` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Test2_veh` FOREIGN KEY (`VehicleId`) REFERENCES `vehicles` (`CarReference`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `Test` FOREIGN KEY (`VehiclesBrand`) REFERENCES `brands` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
