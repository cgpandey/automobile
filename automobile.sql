-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2014 at 07:23 AM
-- Server version: 5.1.48-community
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `automobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('bed3928d1b904034ba406c8674f0e10d', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36', 1394950671, 0x613a333a7b733a373a22757365725f6964223b733a313a2234223b733a383a22757365726e616d65223b733a31363a2270726f6a6563746964656173626c6f67223b733a363a22737461747573223b733a313a2231223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customerNumber` int(11) NOT NULL AUTO_INCREMENT,
  `customerName` varchar(50) NOT NULL,
  `contactLastName` varchar(50) NOT NULL,
  `contactFirstName` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `addressLine1` varchar(50) NOT NULL,
  `addressLine2` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postalCode` varchar(15) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `salesRepEmployeeNumber` int(11) DEFAULT NULL,
  `creditLimit` double DEFAULT NULL,
  PRIMARY KEY (`customerNumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerNumber`, `customerName`, `contactLastName`, `contactFirstName`, `phone`, `addressLine1`, `addressLine2`, `city`, `state`, `postalCode`, `country`, `salesRepEmployeeNumber`, `creditLimit`) VALUES
(1, 'Vijay', 'Chohan', '', '', '', NULL, '', NULL, NULL, '', NULL, NULL),
(2, 'Nathu ', 'Singh', 'Vineet', '230236', '232', '236 fdf', 'Delhi', 'Delhi', '300001', 'India', NULL, 500),
(3, 'Kritika', '', '', '', '', NULL, '', NULL, NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employeeNumber` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `extension` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `officeCode` varchar(10) NOT NULL,
  `file_url` varchar(250) CHARACTER SET utf8 NOT NULL,
  `jobTitle` varchar(50) NOT NULL,
  PRIMARY KEY (`employeeNumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeNumber`, `firstName`, `lastName`, `extension`, `email`, `officeCode`, `file_url`, `jobTitle`) VALUES
(1, 'Sharma', 'Ramesh', '', '', '', '', 'Head engineer');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `invoiceNumber` int(11) NOT NULL AUTO_INCREMENT,
  `orderNumber` int(11) NOT NULL,
  `customerNumber` int(11) NOT NULL,
  `invoiceDate` datetime NOT NULL,
  `initiatedBy` int(11) NOT NULL,
  `totalAmount` float NOT NULL,
  `invoiceComment` text NOT NULL,
  `amount_paid` float NOT NULL DEFAULT '0',
  `amount_due` float NOT NULL DEFAULT '0',
  `totalDiscount` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`invoiceNumber`,`orderNumber`),
  UNIQUE KEY `orderNumber` (`orderNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoiceNumber`, `orderNumber`, `customerNumber`, `invoiceDate`, `initiatedBy`, `totalAmount`, `invoiceComment`, `amount_paid`, `amount_due`, `totalDiscount`) VALUES
(2, 1, 1, '2013-09-23 18:40:41', 2, 234400, '', 500, 233900, 0),
(3, 2, 3, '2013-10-03 15:57:47', 2, 2100, '', 600, 1500, 0),
(4, 3, 2, '2014-03-05 14:30:22', 2, 0, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_order`
--

CREATE TABLE IF NOT EXISTS `job_order` (
  `orderNumber` int(11) NOT NULL AUTO_INCREMENT,
  `job_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `job_type` enum('Paid','Free') NOT NULL,
  `service` enum('Yes','No') NOT NULL,
  `kms` varchar(50) NOT NULL,
  `oil_change` enum('Yes','No') NOT NULL,
  `fuel_condition` varchar(50) NOT NULL,
  `job_estimate` varchar(50) NOT NULL,
  `hhpp` varchar(50) NOT NULL,
  `supervisor_comment` text,
  `customerNumber` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `employeeNumber` int(11) NOT NULL,
  PRIMARY KEY (`orderNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `job_order`
--

INSERT INTO `job_order` (`orderNumber`, `job_date`, `delivery_date`, `job_type`, `service`, `kms`, `oil_change`, `fuel_condition`, `job_estimate`, `hhpp`, `supervisor_comment`, `customerNumber`, `vehicle_id`, `id`, `employeeNumber`) VALUES
(1, '2013-09-21 10:59:12', '2013-09-22 12:00:00', 'Paid', 'Yes', '1000', 'Yes', 'Half full', '5000', '', NULL, 1, 1, 1, 1),
(2, '2013-10-03 07:26:01', '2013-10-03 09:26:06', 'Paid', 'Yes', '5000', 'Yes', 'Half fill', '1500', '', NULL, 3, 3, 2, 1),
(3, '2014-03-11 12:00:00', '2014-03-11 12:00:00', 'Paid', 'Yes', '1500', 'Yes', 'Half fill', '1500', '', '<p>\r\n	aawaz aa rahi hai</p>\r\n', 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(2, '::1', 'priyanshu', '2014-03-16 06:17:51'),
(3, '::1', 'priyanshu', '2014-03-16 06:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE IF NOT EXISTS `offices` (
  `officeCode` int(10) NOT NULL AUTO_INCREMENT,
  `city` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `addressLine1` varchar(50) NOT NULL,
  `addressLine2` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `postalCode` varchar(15) NOT NULL,
  `territory` varchar(10) NOT NULL,
  PRIMARY KEY (`officeCode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`officeCode`, `city`, `phone`, `addressLine1`, `addressLine2`, `state`, `country`, `postalCode`, `territory`) VALUES
(1, 'Delhi', '011', 'Near Chandani Chowk', NULL, 'Delhi', 'India', '300001', 'Delhi');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderNumber` int(11) NOT NULL,
  `productCode` varchar(15) NOT NULL,
  `quantityOrdered` int(11) NOT NULL,
  `priceEach` float NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`orderNumber`,`productCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderNumber`, `productCode`, `quantityOrdered`, `priceEach`, `discount`, `amount`) VALUES
(1, 'Honda01', 586, 2000, 80, 234400),
(2, 'Service01', 1, 100, 0, 100),
(2, 'Honda01', 5, 500, 20, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `customerNumber` int(11) NOT NULL,
  `checkNumber` varchar(50) NOT NULL,
  `paymentDate` datetime NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`customerNumber`,`checkNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `productCode` varchar(15) NOT NULL,
  `productName` varchar(70) NOT NULL,
  `productType` varchar(50) NOT NULL,
  `vendorNumber` int(50) NOT NULL,
  `productDescription` text NOT NULL,
  `quantityInStock` smallint(6) NOT NULL,
  `buyPrice` double NOT NULL,
  `MSRP` double NOT NULL,
  PRIMARY KEY (`productCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productCode`, `productName`, `productType`, `vendorNumber`, `productDescription`, `quantityInStock`, `buyPrice`, `MSRP`) VALUES
('Honda01', 'Honda Brake Shoe', 'Brakes', 1, '', -1264, 20, 200),
('Service01', 'Free Service', 'Company Free Service', 1, '', 9966, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetails`
--

CREATE TABLE IF NOT EXISTS `purchasedetails` (
  `purchaseNumber` int(11) NOT NULL AUTO_INCREMENT,
  `productCode` varchar(15) NOT NULL,
  `quantityPurchased` int(11) NOT NULL,
  `priceEach` double NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `purchase_date` datetime NOT NULL,
  PRIMARY KEY (`purchaseNumber`,`productCode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `purchasedetails`
--

INSERT INTO `purchasedetails` (`purchaseNumber`, `productCode`, `quantityPurchased`, `priceEach`, `amount`, `purchase_date`) VALUES
(1, 'Honda01', 500, 50, 25000, '2013-09-23 02:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL),
(4, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `chassis_no` varchar(100) NOT NULL,
  `engine_no` varchar(100) NOT NULL,
  `regn_no` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `customerNumber` int(11) NOT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `chassis_no`, `engine_no`, `regn_no`, `model`, `customerNumber`) VALUES
(1, '1234', '1234', '123455', 'Lxi', 1),
(2, 'BMLHA10ACA9L01511', '1234', '343443', 'model', 2),
(3, '1255555', '55555', '555555', 'scooty', 3);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `vendorNumber` int(11) NOT NULL AUTO_INCREMENT,
  `vendorName` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `addressLine1` varchar(50) NOT NULL,
  `addressLine2` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postalCode` varchar(15) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  PRIMARY KEY (`vendorNumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendorNumber`, `vendorName`, `phone`, `addressLine1`, `addressLine2`, `city`, `state`, `postalCode`, `country`) VALUES
(1, 'Hero Group', '', 'Vasant Vihar', NULL, 'New Delhi', 'Rajasthan', '1001', 'India');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
