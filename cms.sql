-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2020 at 09:13 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'Javascript'),
(3, 'OOP MVC'),
(4, 'JAVA'),
(11, 'Laravel'),
(16, 'PHP');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(25, 30, 'Zin May Thu', 'nainglin@gmail.com', 'sadfasdf', 'unapproved', '2020-12-22'),
(26, 30, 'Kyaw Kyaw', 'naing@gmail.com', 'asdfasdf', 'unapproved', '2020-12-22'),
(32, 31, 'Zin May Thu', 'paing@gmail.com', 'sdafasd', 'unapproved', '2020-12-22'),
(33, 31, 'Kyaw Kyaw', 'naing@gmail.com', 'sdafsda', 'unapproved', '2020-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_view_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_view_count`) VALUES
(9, 3, 'Procedural', '', 'Kyaw Thu', '2020-12-23', 'pexels-mike-244212.jpg', '<p>This is very reusable code course</p>', 'naing lin oo, php, oop', 1, 'published', 17),
(11, 1, 'Creating Calendar', 'Rooney', '', '2020-12-22', 'images-25.jpg', '<p>Very good course.</p>', 'javascript, rooney', 0, 'published', 3),
(15, 3, 'Procedural', 'Naing Lin Oo', '', '2020-12-22', 'images-19.jpg', '<p>This is very reusable code course</p>', 'naing lin oo, php, oop', 0, 'published', 3),
(16, 1, 'Creating Calendar', 'Rooney', '', '2020-12-22', 'images-18.jpg', '<p>Very good course.</p>', 'javascript, rooney', 0, 'published', 3),
(18, 3, 'Procedural', 'Naing Lin Oo', '', '2020-12-22', 'images-15.jpg', '<p>This is very reusable code course</p>', 'naing lin oo, php, oop', 0, 'published', 9),
(20, 3, 'Procedural', 'Naing Lin Oo', '', '2020-12-22', 'images-7.jpg', '<p>This is very reusable code course</p>', 'naing lin oo, php, oop', 0, 'published', 0),
(21, 1, 'Creating Calendar', 'Rooney', '', '2020-12-22', 'images-5.jpg', '<p>Very good course.</p>', 'javascript, rooney', 0, 'published', 0),
(27, 1, 'Creating Calendar', 'Rooney', '', '2020-12-22', 'images-4.jpg', '<p>Very good course.</p>', 'javascript, rooney', 0, 'published', 0),
(30, 3, 'Procedural', 'Naing Lin Oo', '', '2020-12-22', '_large_image_4.jpg', '<p>This is very reusable code course</p>', 'naing lin oo, php, oop', 0, 'published', 5),
(33, 3, 'Procedural', '', 'Aung Thu', '2020-12-23', '_large_image_1.jpg', '<p>This is very reusable code course</p>', 'naing lin oo, php, oop', 0, 'published', 1),
(39, 11, 'Laravel', '', 'Kyaw Thu', '2020-12-23', 'image_5.jpg', '<p>I think my web developing skill is getting increase.</p>', 'laravel, naing lin oo, web', 0, 'published', 0),
(41, 11, 'Laravel', '', 'Kyaw Thu', '2020-12-23', 'image_5.jpg', '<p>I think my web developing skill is getting increase.</p>', 'laravel, naing lin oo, web', 0, 'published', 0),
(42, 11, 'Laravel', '', 'Kyaw Thu', '2020-12-23', 'image_5.jpg', '<p>I think my web developing skill is getting increase.</p>', 'laravel, naing lin oo, web', 0, 'published', 0),
(43, 11, 'Laravel', '', 'Kyaw Thu', '2020-12-23', 'image_5.jpg', '<p>I think my web developing skill is getting increase.</p>', 'laravel, naing lin oo, web', 0, 'published', 0),
(44, 11, 'Laravel', '', 'Wai Yan Oo', '2020-12-23', 'image_5.jpg', '<p>I think my web developing skill is getting increase.</p>', 'laravel, naing lin oo, web', 0, 'published', 0),
(45, 4, 'Concentration', '', 'Naing Lin Oo', '2020-12-23', 'lambo_1.jpg', '<p>Take care whatever you do.</p>', 'concentration, java, naing lin oo', 0, 'published', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(11, 'Wai Yan Oo', '$2y$12$E3DhW9YlFECS8dGcWxHJcea5Kh/kMD1iC5ud0o4RaVthg1JGPmQYK', 'Wai Yan', 'Oo', 'waiyanoo@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22'),
(12, 'Kyaw Thu', '$2y$12$.eKd3ximDxo037SRSeH0wuOJ38s7m9.rUT9gzQDwHwNjtVMUqVzo.', 'Kyaw ', 'Thu', 'kyawthu@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22'),
(13, 'Aung Thu', '$2y$12$zw0sFMqOOjvCSjgoxNxaz.0RLpNuTxeK24RstXCn7zeHJVYh5FEyO', 'Aung ', 'Thu', 'aungthu@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22'),
(14, 'Naing Lin Oo', '$2y$12$1QvPveI0ngx928kc0WBXoes0wFsttHDxG/1bqMUAwtbw8y.2/.Zdm', 'Naing Lin', 'Oo', 'nainglinoo@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22'),
(15, 'Zar Chi Htwe', '$2y$12$xKRnfOwWgC5UOL0COSfOCOfmfhviIcwE7TwEBjrQZpCabgJB8irES', 'Zar Chi', 'Htwe', 'zarchihtwe@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22'),
(16, 'Zin May Thu', '$2y$12$.R6a1HzH/LMtoutL4pCzSuHOaDPOYsipVDc2xBhiZdGS1BRwgGmE6', 'Zin May', 'Thu', 'zinmaythu@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 't3rv18mvv7fmgv9hdnbc8hguu5', 1608629077),
(2, '5ecjrd5e309o3lgs79m7qdc0vm', 1608629417),
(3, 'i6us4h441me4a510cpnv0ta47a', 1608629023),
(4, '7b6ti1ianov7kee8j4ncvf0h5p', 1608630920),
(5, 'fp9j3ud5pbim9q28im01s9gn94', 1608629332),
(6, 'a4a66jk31aq8k0mh74jbi3ajb3', 1608630016),
(7, 'megpieshsf12c16t2lqc8qqicg', 1608630136),
(8, 'ui64rmksnf1h21vlmrl6rn0nfl', 1608649776),
(9, 'd1u4iso30208vshrosmmlr30u3', 1608654942),
(10, 'gqdt0te678qetsohjir09lluim', 1608711204),
(11, 'kvbdm8vb0fpk366kvt76tj0nqv', 1608709750);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
