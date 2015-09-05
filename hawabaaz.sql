-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2015 at 11:55 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hawabaaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_locations`
--

CREATE TABLE IF NOT EXISTS `available_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `available_locations`
--

INSERT INTO `available_locations` (`id`, `name`, `details`) VALUES
(1, 'location one', ''),
(2, 'location two', ''),
(3, 'location three', ''),
(4, 'location four', ''),
(5, 'location five', '');

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE IF NOT EXISTS `registered_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` text,
  `email` text,
  `password` text,
  `verified` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`id`, `phone`, `email`, `password`, `verified`) VALUES
(1, 'sf', 'kklsf', '', 0),
(2, NULL, '', '', 0),
(3, 'ds', 'dd', 'k', 1),
(4, 'dssd', 'dde', '', 0),
(5, 'dssd4', 'dde4', 'd', 0),
(6, '322', 'dde4d', 'd', 0),
(7, '32232', 'dde4de', 'd', 0),
(8, '32232.232', 'dde4de3df', 'd', 0),
(9, '234', 'adf', 'dfssdf', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
