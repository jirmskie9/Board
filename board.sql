-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 07:35 PM
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
-- Database: `board`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `ID` int(11) NOT NULL,
  `tenantid` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `pstat` varchar(20) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`ID`, `tenantid`, `amount`, `pstat`, `date`) VALUES
(48, 5, '2500', '0', '2024-11-30 23:53:09'),
(49, 7, '2500', '0', '2024-11-30 23:53:09'),
(50, 6, '4000', '0', '2024-11-30 23:53:09'),
(51, 5, '2500', '0', '2024-12-01 00:01:22'),
(52, 7, '2500', '0', '2024-12-01 00:01:22'),
(53, 6, '4000', '0', '2024-12-01 00:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `sender` int(5) NOT NULL,
  `receiver` int(5) NOT NULL,
  `msg` varchar(2555) NOT NULL,
  `Category` varchar(100) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `sender`, `receiver`, `msg`, `Category`, `dt`) VALUES
(79, 2, 0, 'Test', 'Message', '2024-10-20 11:25:00'),
(80, 2, 1, 'Try lang ni', 'Message', '2024-10-20 11:25:00'),
(81, 1, 2, 'Test pud ni', 'Message', '2024-10-20 11:26:00'),
(82, 1, 1, 'ang ano?', 'Message', '2024-10-20 11:26:00'),
(83, 1, 0, 'test', 'Message', '2024-10-20 11:27:00'),
(84, 1, 1, 'gg', 'Message', '2024-10-20 11:29:00'),
(85, 1, 1, 'as', 'Message', '2024-10-20 11:30:00'),
(86, 2, 1, 'adonnis', 'Message', '2024-11-24 10:41:00'),
(87, 1, 1, 'Huy', 'Message', '2024-11-24 10:45:00'),
(88, 1, 2, 'Test', 'Message', '2024-11-24 10:45:00'),
(89, 2, 2, 'lah', 'Message', '2024-11-24 10:45:00'),
(90, 1, 0, 'Katol buli mo? Nangita na na', 'Message', '2024-11-24 10:46:00'),
(91, 1, 0, 'Hahhaah', 'Message', '2024-11-24 10:46:00'),
(92, 2, 0, 'ghgh', 'Message', '2024-11-24 10:47:00'),
(93, 1, 2, 'G', 'Message', '2024-11-24 10:47:00'),
(94, 1, 1, 'G', 'Message', '2024-11-24 10:47:00'),
(95, 1, 2, 'G', 'Message', '2024-11-24 10:50:00'),
(96, 1, 1, 'Test', 'Message', '2024-11-24 10:50:00'),
(97, 1, 1, 'Gg', 'Message', '2024-11-24 10:52:00'),
(98, 1, 0, 'H', 'Message', '2024-11-24 10:53:00'),
(99, 2, 0, 'l', 'Message', '2024-11-24 10:53:00'),
(100, 1, 1, 'H', 'Message', '2024-11-24 10:53:00'),
(101, 1, 1, 'H', 'Message', '2024-11-24 10:54:00'),
(102, 1, 1, 'H', 'Message', '2024-11-24 10:54:00'),
(103, 1, 1, 'Hh', 'Message', '2024-11-24 10:54:00'),
(104, 2, 1, '1', 'Message', '2024-11-24 10:55:00'),
(105, 2, 2, '1', 'Message', '2024-11-24 10:55:00'),
(106, 1, 2, 'H', 'Message', '2024-11-24 10:55:00'),
(107, 2, 0, '1225', 'Message', '2024-11-24 10:56:00'),
(108, 1, 0, 'H', 'Message', '2024-11-24 10:56:00'),
(109, 2, 0, '1', 'Message', '2024-11-24 10:56:00'),
(110, 1, 0, 'G', 'Message', '2024-11-24 10:57:00'),
(111, 1, 0, 'H', 'Message', '2024-11-24 11:00:00'),
(112, 1, 0, 'H', 'Message', '2024-11-24 11:01:00'),
(113, 1, 0, 'L', 'Message', '2024-11-24 11:01:00'),
(114, 0, 0, 'G', 'Message', '2024-12-01 12:53:00'),
(115, 0, 0, '', 'Message', '2024-12-01 12:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `electricity`
--

CREATE TABLE `electricity` (
  `EID` int(11) NOT NULL,
  `Roomnum` int(50) NOT NULL,
  `Pkw` varchar(50) NOT NULL,
  `Nkw` varchar(50) NOT NULL,
  `Ppkw` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `electricity`
--

INSERT INTO `electricity` (`EID`, `Roomnum`, `Pkw`, `Nkw`, `Ppkw`) VALUES
(1, 1, '0', '5', '15');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `EXID` int(11) NOT NULL,
  `Details` varchar(500) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `attachment` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `timeanddate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`EXID`, `Details`, `amount`, `attachment`, `note`, `timeanddate`) VALUES
(1, '12W Led Bulb', '85', '', 'Replacement for Room 1 light', '2024-10-06 20:42:37'),
(2, 'snmbdha', '500', '', 'sjkdfhj', '2024-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `ID` int(11) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `roomnum` varchar(50) NOT NULL,
  `daterequest` datetime NOT NULL DEFAULT current_timestamp(),
  `datedone` varchar(100) NOT NULL,
  `requestedby` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Requesting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`ID`, `Description`, `roomnum`, `daterequest`, `datedone`, `requestedby`, `status`) VALUES
(2, 'ashdhjasd', '', '2024-12-01 02:04:10', '', '7', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `paymenthistory`
--

CREATE TABLE `paymenthistory` (
  `ID` int(11) NOT NULL,
  `tenantid` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `baseddate` varchar(50) NOT NULL,
  `paymentdate` datetime NOT NULL DEFAULT current_timestamp(),
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymenthistory`
--

INSERT INTO `paymenthistory` (`ID`, `tenantid`, `amount`, `baseddate`, `paymentdate`, `user`) VALUES
(9, '7', '2500', '2024-11-30 23:53:09', '2024-12-01 00:31:11', '0'),
(10, '7', '2500', '2024-12-01 00:01:22', '2024-12-01 00:31:38', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RID` int(11) NOT NULL,
  `Roomnum` int(11) NOT NULL,
  `Occupants` int(11) NOT NULL,
  `Cost` varchar(10) NOT NULL,
  `Balance` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RID`, `Roomnum`, `Occupants`, `Cost`, `Balance`) VALUES
(1, 1, 4, '3500', '0'),
(2, 43, 2, '3000', ''),
(3, 42, 2, '3000', ''),
(4, 2, 6, '5000', ''),
(5, 10, 4, '4000', ''),
(6, 8, 6, '5000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `ID` int(11) NOT NULL,
  `fname` varchar(5) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `efullname` varchar(50) NOT NULL,
  `eaddress` varchar(100) NOT NULL,
  `econtact` varchar(20) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `room` int(10) NOT NULL,
  `balance` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`ID`, `fname`, `lname`, `mname`, `address`, `contact`, `email`, `efullname`, `eaddress`, `econtact`, `relation`, `room`, `balance`) VALUES
(5, 'Eldie', 'Aberde', 'Albarin', 'Polomolok', '09106673838', 'ldwow@gmail.com', 'Nenet A. Aberde', 'Polomolok', '09106673838', 'Mother', 2, '5000'),
(6, 'Adonn', 'Pama', 'Sablaon', 'General Santos City', '09672814013', 'pamaadonnis@gmail.com', 'Emilia S. Pama', 'General Santos City', '09456304714', 'Mother', 10, '6000'),
(7, 'Eldie', 'Aberde', 'Albarin', 'Polomolok', '09106673838', 'ldwow@gmail.com', 'Nenet A. Aberde', 'Polomolok', '09106673838', 'Mother', 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Fullname` varchar(500) NOT NULL,
  `imgs` varchar(500) NOT NULL DEFAULT 'logo.png',
  `Usertype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`, `Fullname`, `imgs`, `Usertype`) VALUES
(1, 'User', 'user', 'User Account', 'logo.png', 1),
(2, 'Admin', 'admin', 'Admin Account', 'logo.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electricity`
--
ALTER TABLE `electricity`
  ADD PRIMARY KEY (`EID`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`EXID`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `paymenthistory`
--
ALTER TABLE `paymenthistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RID`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `electricity`
--
ALTER TABLE `electricity`
  MODIFY `EID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `EXID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paymenthistory`
--
ALTER TABLE `paymenthistory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `Monthlybill` ON SCHEDULE EVERY 1 MONTH STARTS '2024-12-01 00:01:22' ENDS '2030-11-01 00:05:23' ON COMPLETION NOT PRESERVE ENABLE DO update tenants as t inner join rooms as r on t.room=r.Roomnum set t.balance=t.balance+(r.cost/(select count(*) from tenants where room=r.Roomnum))$$

CREATE DEFINER=`root`@`localhost` EVENT `bills` ON SCHEDULE EVERY 1 MONTH STARTS '2024-12-01 00:01:22' ENDS '2033-11-30 19:33:03' ON COMPLETION NOT PRESERVE ENABLE DO insert into bills(tenantid,amount) select tenants.id,rooms.cost/(select count(*) from tenants where room=rooms.Roomnum) from tenants inner join rooms on tenants.room=rooms.Roomnum$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
