-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 16, 2012 at 12:26 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sirdar`
--

-- --------------------------------------------------------

--
-- Table structure for table `cfg`
--

CREATE TABLE IF NOT EXISTS `cfg` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `keyA` varchar(32) NOT NULL,
  `keyB` varchar(32) DEFAULT NULL,
  `valueA` varchar(256) DEFAULT NULL,
  `valueB` varchar(256) DEFAULT NULL,
  `timeA` datetime DEFAULT NULL,
  `timeB` datetime DEFAULT NULL,
  `locked` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sir_id` int(6) NOT NULL,
  `user_id` int(4) NOT NULL,
  `comment` text NOT NULL,
  `comment_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sir`
--

CREATE TABLE IF NOT EXISTS `sir` (
  `id` int(6) NOT NULL,
  `type` varchar(128) NOT NULL,
  `application` varchar(128) DEFAULT NULL,
  `currentstate` varchar(128) NOT NULL,
  `submitter` varchar(256) NOT NULL,
  `currentowner` varchar(256) DEFAULT NULL,
  `lastmoddatetime` datetime NOT NULL,
  `submitdatetime` datetime NOT NULL,
  `classification` varchar(64) DEFAULT NULL,
  `priority` varchar(64) DEFAULT NULL,
  `functionalarea` varchar(128) DEFAULT NULL,
  `technicalarea` varchar(128) DEFAULT NULL,
  `requestedrelease` varchar(64) DEFAULT NULL,
  `tobefixedinrelease` varchar(64) DEFAULT NULL,
  `initiatingteam` varchar(256) DEFAULT NULL,
  `shortdescription` text NOT NULL,
  `lastrefresh` datetime NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `shortdescription` (`shortdescription`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sircontainer`
--

CREATE TABLE IF NOT EXISTS `sircontainer` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `containersir_id` int(6) NOT NULL,
  `sir_id` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2543 ;

-- --------------------------------------------------------

--
-- Table structure for table `sirtag`
--

CREATE TABLE IF NOT EXISTS `sirtag` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `tag_id` int(4) NOT NULL,
  `sir_id` int(6) NOT NULL,
  `user_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `sirwatch`
--

CREATE TABLE IF NOT EXISTS `sirwatch` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `sir_id` int(6) NOT NULL,
  `user_id` int(4) NOT NULL,
  `lastwatch` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `label` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`label`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `loginname` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loginname` (`loginname`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
