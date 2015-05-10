-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2015 at 06:25 PM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ilennox_portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `main_content`
--

CREATE TABLE IF NOT EXISTS `main_content` (
  `id` int(11) NOT NULL,
  `image` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `about` varchar(9000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main_content`
--

INSERT INTO `main_content` (`id`, `image`, `email`, `about`) VALUES
(5, 'img/isobelLennoxSM.jpg', 'contact@isobellennox.com', 'I am working toward an AAT in Web Development at Computer Technology at Clark College (Graduating Spring 2015).\r\n\r\nMy goal is to be part of a productive and stable team, to learn new technologies and techniques, and to assist others in multiple roles. I am most interested in a long-term position in back end development.\r\n\r\nI am a Mother of a little girl, and I enjoy hiking, watching Star Trek or X-Files, and playing music in my free time.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_for` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `subtitle`, `url`, `image`, `created_for`) VALUES
(11, 'jQuery Animation', 'Part of a presentation Illustrating the differences in animations using CSS3 vs. jQuery.', 'projects/jqueryAnimation', 'img/animations.PNG', 'A presentation for CTEC126: Javascript '),
(10, 'Bookshelf', 'An interactive library', '../bookshelf', 'img/bookshelf.png', 'Personal Development'),
(9, 'Business Web Practices Final', 'This is a five-part essay based on the employed ethics and<br/> legal concerns applied to web development technologies.', 'projects/BusWebFinalExam/index.php', 'img/BusWebFinal.png', 'Completed for CTEC165: Business Web Practices.'),
(12, 'Javascript Final', 'This project includes technologies learned in CTEC126: Javascript', 'projects/jsFinalProject/', 'img/jsFinal.png', 'CTEC126: Javascript'),
(13, 'PHP & SQL Final', 'This project emphasizes simple admin panel controls to work with CRUD', 'http://ctec127.isobellennox.com', 'img/ctec127.PNG', 'CTEC127: PHP1'),
(14, 'EscapeHatch', 'A Social Media Network', 'http://ehv1.isobellennox.com', 'img/EH.png', 'First CMS built from scratch to sharpen skills with database design'),
(15, 'Arbytes', 'A Ticketing and Content Management System', 'http://arbytes.isobellennox.com', 'img/arbytes.png', 'built from scratch to sharpen skills with database design'),
(16, 'Bookshelf', 'An interactive ebook library', 'http://bookshelf.isobellennox.com', 'img/bookshelf1.png', 'Personal Development'),
(17, 'Flying Zora', 'CSS3 Animation built using SASS. Works best in Chrome.', 'http://codepen.io/IsoLennox/pen/waKMdM', 'img/screenshot.PNG', 'Bettering skills with SASS');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`) VALUES
(6, 'PHP'),
(7, 'SQL'),
(8, 'HTML5/CSS3'),
(9, 'jQuery'),
(11, 'CakePHP'),
(12, 'Ajax'),
(13, 'JSON'),
(14, 'API'),
(15, 'Javascript'),
(16, 'SASS'),
(17, 'CSS3 Animations');

-- --------------------------------------------------------

--
-- Table structure for table `skill_project`
--

CREATE TABLE IF NOT EXISTS `skill_project` (
  `id` int(11) NOT NULL,
  `skill_id` int(7) NOT NULL,
  `project_id` int(7) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `skill_project`
--

INSERT INTO `skill_project` (`id`, `skill_id`, `project_id`) VALUES
(36, 14, 12),
(35, 13, 12),
(34, 12, 12),
(27, 9, 9),
(26, 8, 9),
(28, 9, 11),
(22, 9, 10),
(21, 8, 10),
(20, 7, 10),
(19, 6, 10),
(33, 9, 12),
(37, 15, 12),
(38, 6, 13),
(39, 7, 13),
(40, 8, 13),
(41, 15, 13),
(42, 6, 14),
(43, 7, 14),
(44, 8, 14),
(45, 6, 15),
(46, 7, 15),
(47, 8, 15),
(48, 9, 15),
(49, 6, 16),
(50, 7, 16),
(51, 8, 16),
(52, 9, 16),
(53, 12, 16),
(63, 17, 17),
(62, 16, 17),
(61, 8, 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `username`) VALUES
(1, 'Isobel', '$2y$10$nhSCdQYEbVPa4eOStIBsOuno.8drGY0D7VYvwwecWOJD5r4jEiADO', 'isolennox@gmail.com', 'ilennox');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `main_content`
--
ALTER TABLE `main_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill_project`
--
ALTER TABLE `skill_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `main_content`
--
ALTER TABLE `main_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `skill_project`
--
ALTER TABLE `skill_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
