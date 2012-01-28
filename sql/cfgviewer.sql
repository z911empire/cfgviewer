-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2012 at 09:00 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cfgviewer`
--

-- --------------------------------------------------------

--
-- Table structure for table `cfg`
--

CREATE TABLE IF NOT EXISTS `cfg` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `keyA` varchar(64) NOT NULL,
  `keyB` varchar(64) DEFAULT NULL,
  `keyC` varchar(64) DEFAULT NULL,
  `valueA` varchar(256) NOT NULL,
  `valueB` varchar(256) DEFAULT NULL,
  `valueC` varchar(256) DEFAULT NULL,
  `datetimeA` datetime DEFAULT NULL,
  `datetimeB` datetime DEFAULT NULL,
  `datetimeC` datetime DEFAULT NULL,
  `locked` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
