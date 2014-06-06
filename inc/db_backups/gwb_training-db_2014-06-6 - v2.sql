-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2014 at 10:08 PM
-- Server version: 5.1.67
-- PHP Version: 5.3.6-13ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gwb_training`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(4) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(80) NOT NULL,
  `department_id` int(4) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `department_id`) VALUES
(1, 'Personal Consumer Accounting Certification', 1),
(3, 'Intermediary Relationship Management', 1),
(4, 'Risk Assessment', 1),
(5, 'Bank Operations Structure', 1),
(6, 'Foreign Currency Operations', 1),
(7, 'Repo Policies', 1),
(8, 'Hedge Accounting', 1),
(10, 'Sexual Harassment', 2),
(11, 'Employee Benefits', 2),
(12, 'Anti-Discrimination', 2),
(13, 'Developing Leadership', 2),
(14, 'Conflict Management', 2),
(15, 'Advanced Phone Resolution', 3),
(16, 'Basic Troubleshooting for Consumers', 3),
(17, 'Advanced Troubleshooting for Consumers', 3),
(18, 'New Employee Entry Protocol', 3),
(19, 'Employee Exit Protocol', 3),
(20, 'Network Security Policies', 3),
(21, 'Manage Network Services', 3),
(22, 'Maintaining Hardware Inventory', 3),
(23, 'Security Certification', 3),
(24, 'Mortgage Loan Policies', 4),
(25, 'Greenwell Commercial Loan Policies', 4),
(26, 'Consumer Loan Policies', 4),
(27, 'Competitive Banking ', 4),
(28, 'Credit Lines ', 4),
(29, 'Working with Real Estate Agents', 4),
(30, 'Working with Car Dealerships', 4),
(31, 'FHA Workshop', 4),
(32, 'Economic Growth and Interest Rates', 4),
(33, 'Learning the Loan Assessment App', 4),
(34, 'Maintaining CFSA Certification', 5),
(35, 'Code of Ethics', 5),
(36, 'Networking Opportunities', 5),
(37, 'Fraud Information', 5),
(38, 'Internal Audit Function', 5),
(39, 'Quality Assurance', 5),
(40, 'Auditing Investment Activities', 5),
(41, 'Auditing Contracts: Planning to Reporting', 5),
(42, 'Certificates of Deposit ', 6),
(43, 'Crisis Safety Management ', 6),
(44, 'Customer Service 101', 6),
(45, 'Advanced Accounting Concepts', 6),
(46, 'Ethics in Customer Relations', 6),
(47, 'Creating a Culture of Sales and Service', 6),
(48, 'Frontline Employee Action Plans', 6),
(49, 'Answering Consumer FAQs', 6);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
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
(0, '-- No Department --', 'For all usergroups that are above employee.', 0),
(1, 'Financial Accounts Department', 'FAD oversees many of the back-office operations of the bank including accounting, financial, and purchasing services and records. FAD maintains relationships with intermediaries and financial markets.', 6),
(2, 'Human Resources Department', 'HRD is responsible for the coordination of human resources including attracting, training, and retaining highly motivated staff with a drive to provide efficient and reliable services to the bank and its members.', 5),
(3, 'Information Technology Department', 'ITD is responsible for developing and maintaining all aspects of information technology for the bank. ITD develops and supports all hardware and software used by the bank as well as maintaining the bank’s website.', 7),
(4, 'Consumer Lending Department', 'CLD is responsible for overseeing new personal loans and managing loan accounts as well as maintaining bank compliance with lending regulations.', 8),
(5, 'Auditing Department', 'The auditing department is responsible for all objective appraisals and audits of all internal operations.', 7),
(6, 'Retail Banking Department', 'RBD provides all personal banking services to individual consumers. Personnel includes notaries, bank tellers, receptionists and bank branch managers.', 7);

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE IF NOT EXISTS `usergroups` (
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

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `usergroup_id` int(4) NOT NULL,
  `department_id` int(4) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`, `first_name`, `last_name`, `usergroup_id`, `department_id`, `active`) VALUES
(1, 'admin', 'pass', 'Troy', 'Uyan', 4, 0, 1),
(2, 'viewer', 'pass', 'Bruce', 'Greenwell', 3, 0, 1),
(3, 'coordinator', 'pass', 'Jason', 'McCoord', 2, 0, 1),
(4, 'employee', 'pass', 'Melissa', 'Fredrick', 1, 1, 1),
(15, 'emp_test', 'emp1', 'Sav', 'Rawr', 1, 1, 1),
(26, 'username', 'pass', 'first_name', 'last_name', 2, 0, 1),
(27, 'username2', 'pass', 'first_name', 'last_name', 1, 0, 1),
(28, 'username', 'pass', 'first_name', 'last_name', 3, 0, 0),
(30, 'inactivetest', 'dsadgs', 'indsa', 'testsa', 1, 1, 0),
(31, 'username43', 'dsadsa', 'Test', 'Name', 1, 1, 0),
(32, 'audit_test2', 'dsa432d', 'Audits', 'TssteT', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_courses`
--

CREATE TABLE IF NOT EXISTS `users_courses` (
  `user_id` int(4) NOT NULL,
  `course_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
