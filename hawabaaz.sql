-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2015 at 12:38 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
-- Table structure for table `available_recipies`
--

CREATE TABLE IF NOT EXISTS `available_recipies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) DEFAULT NULL,
  `name` text,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `available_recipies`
--

INSERT INTO `available_recipies` (`id`, `location`, `name`, `details`) VALUES
(1, 1, 'item one', NULL),
(2, 2, 'item two', NULL),
(3, 3, 'item three', NULL),
(4, 1, 'item four', NULL),
(5, 2, 'item five', NULL),
(6, 3, 'item six', NULL),
(7, 1, 'item seven', NULL),
(8, 2, 'item eight', NULL),
(9, 3, 'item nine', NULL),
(10, 4, 'item ten', NULL);

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
(3, 'ds', 'dd', 'adjjl', 1),
(4, 'dssd', 'dde', '', 0),
(5, 'dssd4', 'dde4', 'd', 0),
(6, '322', 'dde4d', 'd', 0),
(7, '32232', 'dde4de', 'd', 0),
(8, '32232.232', 'dde4de3df', 'd', 0),
(9, '234', 'adf', 'dfssdf', 0);
