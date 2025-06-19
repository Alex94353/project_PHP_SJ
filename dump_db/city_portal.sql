-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Št 19.Jún 2025, 13:07
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `city_portal`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `tag_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `tickets`
--

INSERT INTO `tickets` (`id`, `title`, `description`, `image`, `tag_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'dxsvsfdfc', 'sdzcf', 'uploads/68498e2ee7fe70.59788368-blog_3.jpg', 2, 9, '2025-06-11 14:09:50', '0000-00-00 00:00:00'),
(5, 'sdxzvdsfcv', 'sdxzfvsdcfv', 'uploads/68498e698b3c13.48421326-slide_2.jpg', 1, 10, '2025-06-11 14:10:49', '0000-00-00 00:00:00'),
(10, 'xfcgdv', 'dfxgbvdf', 'uploads/6853ef0fe53706.58625732-blog_3.jpg', 3, 13, '2025-06-19 11:05:51', '2025-06-19 11:05:51');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `ticket_tags`
--

CREATE TABLE `ticket_tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `background` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `ticket_tags`
--

INSERT INTO `ticket_tags` (`id`, `label`, `background`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Dokončené', '#0f0', '#fff', '2025-05-05 22:29:09', '2025-05-05 20:29:09'),
(2, 'Prebieha', '#e1ff00', '#000000', '2025-05-05 22:30:02', '2025-05-05 20:30:02'),
(3, 'Vytvorené', '#006eff', '#fcfcfc', '2025-06-19 12:56:28', '2025-06-19 10:56:28'),
(4, 'Zamietnuté', '#c20000', '#000000', '2025-06-19 05:44:24', '2025-06-19 03:44:24');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `date_of_birth`, `password`, `group_id`, `created_at`, `updated_at`) VALUES
(9, 'Alek', 'Bykov', 'alex2001@gmail.com', '1998-01-20', '$2y$10$ovPdM6BWr7qzUEpG67hO8eI3S/YZGsgfNm4fMYP4hm/9Xq3aq8rMa', 2, '2025-06-11 14:09:18', '2025-06-11 14:09:18'),
(10, 'Al', 'Bykov', 'alex@gmail.com', '1998-01-20', '$2y$10$V4gsz7XWXpWqsVz1K.D5mOpydEIqQW/Ml3aOcPHzZY6k4t8xPuStu', 1, '2025-06-11 14:10:24', '2025-06-11 14:10:24'),
(12, 'A', 'Bykov', 'alex007@gmail.com', '2025-06-14', '$2y$10$qdBd0l4DniqzUrvckZajJeL98DM7ppzibztUNOXRR/UxVwAomDBMC', 2, '2025-06-19 10:44:23', '2025-06-19 10:44:23'),
(13, 'Aleksei', 'Bykov', 'alex20011998@gmail.com', '1998-01-20', '$2y$10$maxCr64.3hlffB2fQt/6yuQCkjYVcrO7MXvdVcDE/W4sbnPXizJue', 1, '2025-06-19 10:49:23', '2025-06-19 10:49:23');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `user_groups`
--

INSERT INTO `user_groups` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Administrátor', '2025-05-05 20:24:17', '2025-06-19 06:34:39'),
(2, 'Občan', '2025-05-05 20:24:46', '2025-05-05 20:24:46'),
(3, 'editor', '2025-06-19 10:58:57', '2025-06-19 10:58:57');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexy pre tabuľku `ticket_tags`
--
ALTER TABLE `ticket_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexy pre tabuľku `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `ticket_tags` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
