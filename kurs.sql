-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2019 at 12:20 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kurs`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `street_number` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street_name`, `street_number`, `city`, `country`, `user_id`) VALUES
(1, 'Bla bla bla', '15', 'Podgorica', 'Crna Gora', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Projekat 1', 'Lorem ipsum sut dolorem', '2019-11-20 18:24:18', '2019-11-20 18:24:18'),
(2, 'Project 2', 'Description of second project.', '2019-11-20 18:24:18', '2019-11-20 18:24:18'),
(3, 'Project 3', 'This is description of Project 3.', '2019-11-20 18:24:46', '2019-11-20 18:24:46'),
(4, 'Novi projekat', 'Bla bla bla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Novi projekat 2 - update verzija', 'Nista - novo', '2019-11-25 17:45:12', '2019-11-25 18:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `project_id`, `user_id`, `created_at`, `updated_at`, `is_completed`) VALUES
(1, 'Task 1', 'Lorem ipsum', 1, 1, '2019-11-27 18:22:51', '2019-11-27 18:22:51', 0),
(22, 'Probni task', 'sdfdgfdg jlhkgh;k h;g ;kj h;gh ;kjgh ;kjg;k ;kj ;kg kj ', 3, 4, '2019-12-01 00:47:40', '2019-12-01 00:47:40', 0),
(23, 'Probni task', 'sdfdgfdg jlhkgh;k h;g ;kj h;gh ;kjgh ;kjg;k ;kj ;kg kj ', 1, 5, '2019-12-01 01:02:04', '2019-12-01 01:02:04', 1),
(24, 'Zelena poruka', 'hgkjfdjkvb hd;gkjfdj;k b;khd;kgjfd;jkb ;kjhd jbjkdhfhdf', 5, 6, '2019-12-01 01:20:41', '2019-12-01 01:20:41', 1),
(25, 'Pokusaj taska', 'jsklsjf idoif lkgkjfd nkdgbkjfd lfkjbgjkf', 3, 6, '2019-12-01 21:54:19', '2019-12-01 21:54:19', 1),
(26, 'Probni task', 'Nekakav obicni tekst za zauzimanje prostora', 4, 6, '2019-12-06 23:16:17', '2019-12-06 23:16:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `birth_date`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Lazar', 'Radinovic', 'lazar@test.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', '1993-11-20', 'male', '2019-11-18 17:37:25', '2019-11-18 17:37:25'),
(4, 'Marko', 'Markovic', 'marko@test.com', '202cb962ac59075b964b07152d234b70', '2019-11-21', 'male', '2019-11-20 18:25:36', '2019-11-20 18:25:36'),
(5, 'Petar', 'Petrovic', 'petar@test.com', '202cb962ac59075b964b07152d234b70', '2019-11-08', 'male', '2019-11-20 18:26:03', '2019-11-20 18:26:03'),
(6, 'Milena', 'Milenovic', 'milena@test.com', '202cb962ac59075b964b07152d234b70', '2019-11-05', 'female', '2019-11-20 18:26:27', '2019-11-20 18:26:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
