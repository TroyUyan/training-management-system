-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 18, 2014 at 12:09 AM
-- Server version: 5.5.37
-- PHP Version: 5.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gwb_training`
--
CREATE DATABASE IF NOT EXISTS `gwb_training` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gwb_training`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `course_id` int(4) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(80) NOT NULL,
  `course_desc` text NOT NULL,
  `department_id` int(4) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `department_id` int(4) NOT NULL,
  `department_name` varchar(40) NOT NULL,
  `department_desc` text NOT NULL,
  `required_courses` int(2) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `department_desc`, `required_courses`) VALUES
(0, 'No Department', 'For all usergroups that are above employee.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

DROP TABLE IF EXISTS `usergroups`;
CREATE TABLE `usergroups` (
  `usergroup_id` int(4) NOT NULL,
  `usergroup_name` varchar(40) NOT NULL,
  PRIMARY KEY (`usergroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usergroups`
--

INSERT INTO `usergroups` (`usergroup_id`, `usergroup_name`) VALUES
(1, 'Employee'),
(2, 'Coordinator'),
(3, 'Viewer'),
(4, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `usergroup_id` int(4) NOT NULL,
  `department_id` int(4) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`, `first_name`, `last_name`, `usergroup_id`, `department_id`) VALUES
(1, 'admin', 'pass', 'Troy', 'Uyan', 4, 0),
(2, 'viewer', 'pass', 'Bruce', 'Greenwell', 3, 0),
(3, 'coordinator', 'pass', 'Jason', 'McCoord', 2, 0),
(4, 'employee', 'pass', 'Melissa', 'Fredrick', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_courses`
--

DROP TABLE IF EXISTS `users_courses`;
CREATE TABLE `users_courses` (
  `user_id` int(4) NOT NULL,
  `course_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
