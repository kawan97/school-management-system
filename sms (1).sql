-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 28, 2021 at 07:39 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE IF NOT EXISTS `absence` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `studentname` varchar(150) NOT NULL,
  `lectureid` int(50) NOT NULL,
  `absence` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absence`
--

INSERT INTO `absence` (`id`, `studentname`, `lectureid`, `absence`) VALUES
(4, 'kawas', 2, 1),
(5, 'kawas', 7, 1),
(6, 'kawas1', 7, 0),
(7, 'dini', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `classname` varchar(150) NOT NULL,
  `teachername` varchar(150) NOT NULL,
  `teacherid` int(150) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'deactivate',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `classname`, `teachername`, `teacherid`, `status`) VALUES
(2, 'my first class', 'kawat', 8, 'active'),
(3, 'second class', 'kawat', 8, 'active'),
(4, 'english', 'kawat1', 10, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `enrollstu`
--

DROP TABLE IF EXISTS `enrollstu`;
CREATE TABLE IF NOT EXISTS `enrollstu` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `studentname` varchar(150) NOT NULL,
  `classid` int(150) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'deactivate',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollstu`
--

INSERT INTO `enrollstu` (`id`, `studentname`, `classid`, `status`) VALUES
(2, 'kawas', 2, 'active'),
(6, 'kawas', 3, 'deactivate'),
(13, 'kawas1', 2, 'active'),
(14, 'dini', 2, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `lectureid` int(50) NOT NULL,
  `degree` int(1) NOT NULL,
  `studentname` varchar(150) NOT NULL,
  `classid` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf16le;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `lectureid`, `degree`, `studentname`, `classid`) VALUES
(1, 4, 3, 'kawas', 2),
(5, 5, 4, 'kawas', 2),
(6, 6, 2, 'kawas', 2),
(7, 4, 2, 'kawas1', 2),
(9, 4, 1, 'kawas', 2),
(10, 7, 3, 'kawas', 2),
(11, 7, 2, 'kawas1', 2),
(12, 7, 5, 'dini', 2),
(13, 4, 2, 'dini', 2),
(14, 5, 4, 'dini', 2),
(15, 6, 2, 'dini', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

DROP TABLE IF EXISTS `lecture`;
CREATE TABLE IF NOT EXISTS `lecture` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `classid` int(50) NOT NULL,
  `lecturename` varchar(150) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `classid`, `lecturename`, `date`) VALUES
(1, 3, 'my first lecture', '2021-09-27'),
(2, 3, 'my second lecture', '2021-09-27'),
(3, 4, 'my first english lecture', '2021-09-27'),
(4, 2, 'math', '2021-09-28'),
(5, 2, '1111111', '2021-09-28'),
(6, 2, '22222222222', '2021-09-28'),
(7, 2, 'sasasasas', '2021-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `id` int(150) NOT NULL AUTO_INCREMENT,
  `parentkey` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`id`, `parentkey`, `username`) VALUES
(3, 'KpJyPGEHy5hRTFzHPR8c', 'kawau'),
(4, 'YoH3H5tgrN3YdMQVliwp', 'kawas'),
(5, '26DUH96YEK9cRnnpjJc5', 'kawas1'),
(6, 'IjKS0DjzEnza8KFMHRZE', 'dini');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `firstname` varchar(75) NOT NULL,
  `lastname` varchar(75) NOT NULL,
  `role` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'deactivate',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `role`, `email`, `password`, `status`) VALUES
(2, 'kawa1', 'dsds', 'dsd', 'teacher', 'pshtiwankawan@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'active'),
(5, 'kawant', 'kawa', 'da', 'teacher', '', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'deactivate'),
(6, 'kawau', 'kawan', 'pshtiwan', 'student', 'pshtiwankawan@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'deactivate'),
(7, 'kawa', 'kawan', 'pshtiwan', 'admin', '', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'active'),
(8, 'kawat', 'kawan', 'pshtiwan', 'teacher', '', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'deactivate'),
(9, 'kawas', 'kawan', 'pshtiwan', 'student', 'pshtiwankawan@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'deactivate'),
(10, 'kawat1', 'kawan', 'pshtiwan', 'teacher', '', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'deactivate'),
(11, 'kawas1', 'kawan', 'ps', 'student', 'pshtiwankawan@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'deactivate'),
(12, 'dini', 'dini', 'ibraim', 'student', 'admin@admin.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
