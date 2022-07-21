-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 06:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `addeddate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `author`, `description`, `addeddate`) VALUES
(1, 'Comment System in PHP', 'admin', 'So, if you have to switch your project to use another database, PDO makes the process easy. You only have to change the connection string and a few queries. With MySQLi, you will need to rewrite the entire code - queries included.\r\n\r\n', '2022-07-13 14:49:30'),
(2, 'Why and how did you use an online discussion forum?', 'admin', 'I used a discussion forum to offer students a structured opportunity to interact with each other online around exam time. For the purpose of reviewing for the exam students posted questions they had about course material, and other students answered them in the online forum. I also agreed to weigh in on student comments after each question had received at least one response from another student. I had a few reasons for my decision to use the forum in this way. First, I knew that I would not have enough time to answer all of my students’ questions around exam time as I was preparing for my own qualifying exams during the same semester. I was also fairly certain that my students could be effective in teaching each other and answering one another’s questions; I wanted them to depend more on each other and less on me in the time leading up to the exam. By using an online discussion, I hoped to encourage collaboration and to give students a structured opportunity to work together to find the answers to questions that they were having difficulty with. This activity would also have another desired benefit — it would help students to practice writing and explaining concepts prior to doing so on the exam.', '2022-07-21 16:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `comment_id`, `name`, `description`, `date`) VALUES
(1, 1, 0, 'Rakesh kumar', 'testing comment', '2022-07-12 17:41:16'),
(3, 1, 1, 'rakesh kumar', 'testing reply', '2022-07-12 17:41:16'),
(4, 1, 1, 'raju', 'testing first comment 2nd reply', '2022-07-12 17:41:16'),
(5, 1, 0, 'deepak', 'testing 2nd comment', '2022-07-12 17:41:16'),
(6, 1, 3, 'rakesh', '2nd nested reply', '2022-07-12 17:41:16'),
(7, 1, 4, 'Sachin', 'testing first comment 2nd reply 2nd', '2022-07-12 17:41:16'),
(8, 1, 7, 'Deepak Mathur', 'testing first comment 2nd reply 3rd', '2022-07-12 17:41:16'),
(9, 1, 5, 'Jatin', 'testing 2nd comment reply 1st', '2022-07-12 17:41:16'),
(10, 1, 9, 'Vivek', 'testing 2nd comment reply 2nd comment', '2022-07-12 17:41:16'),
(11, 1, 5, 'Reyansh', 'testing deepak 2nd reply', '2022-07-12 17:41:16'),
(23, 2, 0, 'achref', 'thanks for give student a chance to show them concept !', '2022-07-21 16:43:29'),
(24, 2, 23, 'achref', 'Hope you enjoy it !', '2022-07-21 16:43:55'),
(25, 2, 24, 'achref', 'good luck !', '2022-07-21 16:44:05'),
(26, 2, 0, 'achref', 'thanks give us this platform', '2022-07-21 16:45:09'),
(27, 2, 26, 'achref', 'yeah enjoy it !', '2022-07-21 16:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` bigint(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `Name`, `email`, `subject`, `message`) VALUES
(5, 'yinqin ooi', 'weiyi1089@gmail.com', 'problem', 'qweqwe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT 2,
  `isActive` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `email`, `password`, `mobile`, `image`, `roleid`, `isActive`, `created_at`, `updated_at`) VALUES
(23, 'achref', 'admin123', 'admin123@gmail.com', 'f4542db9ba30f7958ae42c113dd87ad21fb2eddb', '0125781143', '', 1, 0, '2022-07-07 13:22:39', '2022-07-07 13:22:39'),
(24, 'ahmed', 'test1', 'achme@gmail.com', '056eafe7cf52220de2df36845b8ed170c67e23e3', '012123543', 'default-avatar.png', 2, 0, '2022-07-07 13:22:39', '2022-07-07 13:22:39'),
(25, 'Fathi', 'fathiA', 'fathianh@gmail.com', '3ea543d29ad3c1c09fcfbdda3f2f0617c50ab138', '0195467282', '', 2, 0, '2022-07-07 13:22:39', '2022-07-07 13:22:39'),
(26, 'Makrem', 'makrem', 'makrem@gmail.com', '3ea543d29ad3c1c09fcfbdda3f2f0617c50ab138', '0184255177', '', 2, 0, '2022-07-07 13:22:39', '2022-07-07 13:22:39'),
(27, 'Sirin', 'Sirin', 'Sirin@gmail.com', '3ea543d29ad3c1c09fcfbdda3f2f0617c50ab138', '0102388888', '', 2, 0, '2022-07-07 13:22:39', '2022-07-07 13:22:39'),
(32, NULL, 'name1', 'useremail1@mail.com', 'f4542db9ba30f7958ae42c113dd87ad21fb2eddb', NULL, NULL, 2, 0, '2022-07-20 10:01:32', '2022-07-20 10:01:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'role_id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
