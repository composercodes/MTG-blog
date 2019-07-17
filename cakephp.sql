-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2019 at 07:56 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `content`, `created`, `modified`) VALUES
(1, 5, 'fdsgfgdf', '2019-07-15 23:22:17', '2019-07-15 23:22:17'),
(3, 9, 'asdasdasd', '2019-07-16 02:52:53', '2019-07-16 02:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `comment_count` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `img`, `date`, `comment_count`, `created`, `modified`) VALUES
(9, 22, 'asdsadsad', 'dasdasdasdasd', 'd1fe4_img_4.jpg', '2019-07-15', 0, '2019-07-15 23:40:33', '2019-07-16 02:22:41'),
(10, 22, 'asdsadsad', 'dasdasdasdasd', '4d084_img_4.jpg', '2019-07-15', 0, '2019-07-15 23:40:55', '2019-07-16 02:22:46'),
(11, 22, 'asdsadsad', 'dfgdfgdfgdfg', '9aeb2_img_2.jpg', '2019-07-15', 0, '2019-07-15 23:41:09', '2019-07-16 02:22:50'),
(12, 22, 'test', 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', 'd82d7_img_4.jpg', '2019-07-16', 0, '2019-07-16 01:51:37', '2019-07-16 02:22:55'),
(13, 22, 'asdsadsad', 'asdasdasd', 'dd1ec_img_2.jpg', '2019-07-16', 0, '2019-07-16 02:17:26', '2019-07-16 02:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `temp_files`
--

CREATE TABLE `temp_files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `behavior` varchar(255) DEFAULT NULL,
  `uploaded_for` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `role`, `email`, `created`, `modified`, `last_login`) VALUES
(20, 'admin', 'asdasdasd', '07035c84662efa4c3e71ce8896cb083abfba7e4e', 'admin', 'maged.ibrahem1@gmail.com', '2019-07-13 00:06:17', '2019-07-17 07:08:59', '0000-00-00 00:00:00'),
(21, 'adminn', 'asdasdasd', '07035c84662efa4c3e71ce8896cb083abfba7e4e', 'writer', 'maged.ibrahem1@gmail.com', '2019-07-13 00:07:05', '2019-07-16 01:47:23', '0000-00-00 00:00:00'),
(22, 'maged', 'asdasdasd', '2ffba41fdf2f404689078f36f8c43b5d77fd6f2e', 'admin', 'maged.ibrahem1@gmail.com', '2019-07-14 20:24:18', '2019-07-17 07:51:34', '0000-00-00 00:00:00'),
(23, 'adminnnn', 'asdasdasd', '7a814956ffe8036b4adf55ef0d84cac09d00e76f', 'admin', 'maged.ibrahem1@gmail.com', '2019-07-17 07:05:56', '2019-07-17 07:05:56', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_files`
--
ALTER TABLE `temp_files`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `temp_files`
--
ALTER TABLE `temp_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
