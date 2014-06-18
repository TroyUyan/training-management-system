-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2014 at 06:49 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

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
(49, 'Answering Consumer FAQs', 6),
(50, 'Cat Training', 54),
(51, 'Kitty Cat 101', 54),
(52, 'Workforce Management ', 2),
(54, 'Training Retail ', 48),
(55, 'Accounts Documenataion', 48),
(56, 'Working With Family Trusts', 48);

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
(2, 'Human Resources Department', 'HRD is responsible for the coordination of human resources including attracting, training, and retaining highly motivated staff with a drive to provide efficient and reliable services to the bank and its members.', 6),
(3, 'Information Technology Department', 'ITD is responsible for developing and maintaining all aspects of information technology for the bank. ITD develops and supports all hardware and software used by the bank as well as maintaining the bank’s website.', 7),
(4, 'Consumer Lending Department', 'CLD is responsible for overseeing new personal loans and managing loan accounts as well as maintaining bank compliance with lending regulations.', 8),
(5, 'Auditing Department', 'The auditing department is responsible for all objective appraisals and audits of all internal operations.', 7),
(6, 'Retail Banking Department', 'RBD provides all personal banking services to individual consumers. Personnel includes notaries, bank tellers, receptionists and bank branch managers.', 7),
(48, 'Legal Services', 'pending', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`, `first_name`, `last_name`, `usergroup_id`, `department_id`, `active`) VALUES
(1, 'admin', 'pass', 'Troy', 'Uyan', 4, 0, 1),
(2, 'viewer', 'pass', 'Bruce', 'Greenwell', 3, 0, 1),
(3, 'coordinator', 'pass', 'Jason', 'McCoord', 2, 0, 1),
(4, 'employee', 'pass', 'Melissa', 'Fredrick', 1, 1, 1),
(15, 'emp_test', 'emp1', 'Sav', 'Rawr', 1, 1, 1),
(26, 'username', 'pass', 'first_name', 'last_name', 2, 0, 0),
(27, 'username2', 'pass', 'first_name', 'last_name', 1, 0, 0),
(28, 'username', 'pass', 'first_name', 'last_name', 3, 0, 0),
(30, 'inactivetest', 'dsadgs', 'indsa', 'testsa', 1, 1, 0),
(31, 'username43', 'dsadsa', 'Test', 'Name', 1, 1, 0),
(32, 'audit_test2', 'dsa432d', 'Mark', 'Kelso', 1, 1, 1),
(33, 'captainjack', 'torchwood', 'Jack', 'Harkness', 1, 3, 1),
(34, 'captainjack2', 'rum', 'Jack', 'Sparrow', 1, 0, 0),
(35, 'captainjack', 'test', 'Test', 'Username', 1, 2, 0),
(36, 'jsparrow', 'captain', 'Jack', 'Sparrow', 1, 0, 0),
(37, 'cldtest', 'cldtest', 'Shawn', 'Crespo', 1, 4, 1),
(39, 'jbyers', 'lisa', 'Jesse', 'Byers', 1, 3, 1),
(40, 'pbarnes', 'james', 'Patrick', 'Barnes', 1, 6, 1),
(41, 'mcody', 'purple', 'Mona', 'Cody', 1, 1, 1),
(42, 'cjenkins', 'goddess', 'Cristi', 'Jenkins', 1, 6, 1),
(43, 'agarcia', 'orange', 'Angelica', 'Garcia', 1, 3, 1),
(44, 'slord', 'pudding', 'Savanna', 'Lord', 1, 6, 1),
(45, '', 'meth', 'Walter', 'White', 1, 6, 0),
(46, 'jblack', 'jumpin', 'Jack', 'Black', 1, 4, 1),
(47, 'jconklin', 'slacker', 'Jino', 'Conklin', 1, 6, 1),
(48, 'Fulfy', 'dsa', 'dsa', 'dsa', 1, 4, 0),
(49, 'Fulfy', 'dsa', 'dsa', 'dsa', 1, 0, 0),
(50, 'Fulfy321', 'dsa', 'dsa', 'dsa', 1, 0, 0),
(51, 'Fulfy3212', 'dsa', 'dsa', 'dsa', 1, 0, 0),
(52, 'lmcgee', 'singer', 'Lexi', 'McGee', 1, 6, 1),
(53, 'wwhite', 'meth', 'Walter', 'White', 1, 6, 1),
(54, 'ishoe', 'meth', 'Ian', 'Shoe', 1, 6, 1),
(55, 'iphone', 'mac', 'Icky', 'Phone', 1, 6, 1),
(56, 'mcow', 'milk', 'Mary', 'Cow', 1, 6, 1),
(57, 'pmcpat', 'barnes', 'Patty', 'Mcpat', 1, 6, 1),
(58, 'tjoker', 'serious', 'Theo', 'Joker', 1, 2, 1),
(59, 'bwayne', 'batman', 'Bruce', 'Wayne', 1, 3, 1),
(60, 'cgrimes', 'kid', 'Carl', 'Grimes', 1, 2, 1),
(61, 'jgrimes', 'baby', 'Judith', 'Grimes', 1, 4, 1),
(62, 'lgrimes', 'mother', 'Lori', 'Grimes', 1, 2, 1),
(63, 'rgrimes', 'father', 'Rick', 'Grimes', 1, 2, 1),
(64, 'mgreene', 'chick', 'Maggie', 'Greene', 1, 5, 1),
(65, 'hgreene', 'father', 'Hershel', 'Greene', 1, 1, 1),
(66, 'jpinkman', 'junkie', 'Jesse', 'Pinkman', 1, 3, 1),
(67, 'grhee', 'lover', 'Glenn', 'Rhee', 1, 2, 1),
(68, 'lbrown', 'army', 'Lavender', 'Brown', 1, 5, 1),
(69, 'tbrown', 'sugar', 'Ted', 'Brown', 1, 1, 1),
(70, 'stonks', 'daughter', 'Sarah', 'Tonks', 1, 4, 1),
(71, 'agreenwell', 'purple', 'Abigail', 'Greenwell', 3, 0, 1),
(72, 'lsass', 'bringer', 'Lilly', 'Sass', 1, 3, 1),
(73, 'dvane', 'student', 'Dean', 'Vane', 1, 4, 1),
(74, 'avane', 'member', 'Alice', 'Vane', 1, 5, 1),
(75, 'rfang', 'owner', 'Rosmerta ', 'Fang', 1, 5, 1),
(76, 'gnorris', 'teacher', 'Greg', 'Norris', 1, 3, 1),
(77, 'gnorman', 'teacher', 'Greg', 'Norman', 1, 4, 1),
(78, 'tnelson', 'creature', 'Trevor', 'Nelson', 1, 5, 1),
(79, 'severguard', 'orange', 'Sally', 'Everguard ', 1, 2, 1),
(80, 'rblack', 'black', 'Robert', 'Black', 1, 2, 1),
(81, 'mterry', 'red', 'Miranda', 'Terry', 1, 2, 1),
(82, 'lterry', 'teal', 'Lisa', 'Terry', 1, 4, 1),
(83, 'ahainey', '7ra11m', 'Alexis', 'Hainey', 1, 1, 1),
(84, 'tmccauley', 'tm3148', 'Tom', 'McCauley', 1, 1, 1),
(85, 'rreese', 'acesred2', 'Richard', 'Reese', 1, 1, 1),
(86, 'skirk', 'm0t0rcr0ss', 'Sally', 'Kirk', 1, 1, 1),
(87, 'mmcord', '8675309', 'Mark', 'McCord', 1, 1, 1),
(88, 'tjenson', 'kat22', 'Tim', 'Jenson', 1, 2, 1),
(89, 'bmiller', 'reaper6', 'Bob', 'Miller', 1, 2, 1),
(90, 'vramsey', '8n311', 'Viki', 'Ramsey', 1, 2, 1),
(91, 'mhunsaker', '313phant', 'Mike', 'Hunsaker', 1, 3, 1),
(92, 'asmith', 'nate&me', 'Ashley', 'Smith', 1, 3, 1),
(93, 'jwilliams', 'arr0n', 'Jessica', 'Williams', 1, 3, 1),
(94, 'aganti', 'phh227m', 'Amar', 'Ganti', 1, 4, 1),
(95, 'wrivera', 'y01e8da', 'Willow', 'Rivera', 1, 4, 1),
(96, 'ahedman', 'balkar', 'Amber', 'Hedman', 1, 4, 1),
(97, 'cfields', 'strawberry', 'Carol', 'Fields', 1, 5, 1),
(98, 'dbarnes', '5s3t15', 'Derek', 'Barnes', 1, 5, 1),
(99, 'eclark', 'magicmonday', 'Elise', 'Clark', 1, 5, 1),
(100, 'pdavis', '90_luk3', 'Pete', 'Davis', 1, 5, 1),
(101, 'liraheta', 'vine2732', 'Luke', 'Iraheta', 1, 5, 1),
(102, 'swoodburn', 'password', 'Sally', 'Woodburn', 1, 5, 1),
(103, 'belgort', 'password', 'Bruce', 'Elgort', 2, 0, 1),
(104, 'bgreenwell', 'password', 'Bruce', 'Greenwell', 3, 0, 1),
(105, 'sfisher', 'password', 'Scott', 'Fisher', 1, 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_courses`
--

CREATE TABLE IF NOT EXISTS `users_courses` (
  `user_id` int(4) NOT NULL,
  `course_id` int(4) NOT NULL,
  PRIMARY KEY (`user_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_courses`
--

INSERT INTO `users_courses` (`user_id`, `course_id`) VALUES
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(15, 1),
(15, 3),
(15, 4),
(15, 5),
(15, 6),
(15, 7),
(15, 8),
(32, 1),
(32, 5),
(32, 6),
(32, 7),
(33, 15),
(33, 17),
(33, 18),
(33, 19),
(33, 22),
(34, 12),
(34, 14),
(36, 34),
(36, 39),
(36, 41),
(37, 25),
(37, 28),
(37, 29),
(37, 31),
(39, 15),
(39, 16),
(39, 17),
(39, 18),
(39, 20),
(39, 22),
(39, 23),
(40, 46),
(41, 1),
(41, 4),
(41, 7),
(42, 45),
(42, 46),
(42, 47),
(43, 17),
(43, 18),
(45, 45),
(46, 24),
(46, 25),
(46, 26),
(46, 27),
(46, 29),
(46, 30),
(46, 31),
(46, 32),
(46, 33),
(47, 45),
(47, 48),
(47, 49),
(52, 49),
(53, 49),
(54, 48),
(54, 49),
(55, 42),
(55, 48),
(55, 49),
(56, 42),
(56, 48),
(56, 49),
(57, 42),
(57, 47),
(57, 48),
(57, 49),
(58, 11),
(58, 13),
(59, 16),
(59, 18),
(59, 22),
(60, 10),
(60, 11),
(60, 13),
(62, 10),
(62, 11),
(62, 12),
(62, 13),
(62, 14),
(63, 10),
(63, 13),
(64, 34),
(64, 35),
(64, 37),
(64, 38),
(64, 39),
(64, 40),
(64, 41),
(65, 1),
(65, 6),
(66, 16),
(66, 18),
(66, 22),
(67, 10),
(67, 11),
(67, 12),
(67, 13),
(68, 34),
(68, 35),
(68, 37),
(68, 38),
(68, 39),
(68, 40),
(68, 41),
(69, 1),
(69, 8),
(70, 30),
(70, 31),
(70, 32),
(70, 33),
(71, 34),
(71, 35),
(71, 37),
(71, 38),
(71, 39),
(71, 40),
(71, 41),
(72, 15),
(73, 28),
(77, 28),
(79, 14),
(80, 14),
(81, 14),
(94, 28),
(95, 28),
(102, 34),
(102, 35),
(102, 36),
(102, 37),
(105, 54),
(105, 55);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
