-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 05, 2014 at 06:09 AM
-- Server version: 5.5.23
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `e-news-system`
--
CREATE DATABASE IF NOT EXISTS `e-news-system` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `e-news-system`;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `desc` text NOT NULL,
  `details` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `news_image` varchar(50) NOT NULL,
  `datecreated` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `desc`, `details`, `user_id`, `status`, `news_image`, `datecreated`) VALUES
(1, 'Breaking News', 'Breaking News hjfegjwehg we thjweh wjhet  t hwet wekth jwethjweth  twhketj weht jkwehjt wejtjwekht  wehtjkwe jthk tjkhwet kwetjklk tweklt', 'Thank you for using our core values', 1, 1, '', '0000-00-00'),
(2, 'Welcome notice', 'Welcome notice', 'Thank you usin g our news platform.', 1, 1, '', '2013-09-18'),
(3, 'Test sample 3', 'Test sample Three', 'Test sample Three', 1, 1, '', '2013-09-28'),
(4, 'Test sample 4', 'Test sample Four', 'Test sample Four', 1, 1, '', '2013-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `validtill` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `middlename` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '1',
  `datecreated` date NOT NULL,
  `lastlogin` date NOT NULL,
  `no_of_visits` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `validtill`, `createdby`, `firstname`, `middlename`, `lastname`, `status`, `datecreated`, `lastlogin`, `no_of_visits`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2013-09-16', 1, 'System', '', 'Administrator', 1, '0000-00-00', '2014-01-05', 77),
(2, 'prodigy', '0e411e1bbaba90b26c1cf25142cf4457', 'Sys. User', '2014-01-23', 1, 'Olorundare', 'Adeola', 'Ogunlewe', 1, '2011-03-22', '2014-01-02', 29),
(3, 'dayo', '960b9209775171cab231538b826e412e', 'Sys. User', '2014-01-07', 0, 'Adelope', 'Oladayo', 'Olusola', 1, '2011-03-30', '0000-00-00', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
