-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 11:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learning_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `username`, `email`, `message`, `created_at`) VALUES
(1, 'john', 'johnameh@gmail.com', 'very', '2025-10-09 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(1, 'HTML', 'HTML (HyperText Markup Language) is the standard markup language used for creating and structuring web page content.', 'uploads/peakpx.jpg', '2025-01-24 16:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(200) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) DEFAULT NULL,
  `recipient` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `recipient`, `message`, `timestamp`, `is_read`) VALUES
(1, 'Johnydrille', 'John29', 'hi', '2025-01-20 06:40:35', 0),
(2, 'Johnydrille', 'Johnydrille', 'yh', '2025-01-20 06:46:28', 0),
(3, 'Johnydrille', 'Johnydrille', 'yh', '2025-01-20 06:53:31', 0),
(4, 'Johnydrille', 'Johnydrille', 'send', '2025-01-20 06:53:55', 0),
(5, 'John29', 'Johnydrille', 'what', '2025-01-20 06:55:05', 0),
(6, 'Johnydrille', 'John29', 'yh my bad', '2025-01-20 06:55:16', 0),
(7, 'John29', 'Johnydrille', 'no need to shout', '2025-01-20 06:55:28', 0),
(8, 'Johnydrille', 'John29', 'i wasn\'t', '2025-01-20 06:55:41', 0),
(9, 'John29', 'Johnydrille', 'sorry', '2025-01-20 06:55:49', 0),
(10, 'Johnydrille', 'John29', 'Thank you', '2025-01-20 06:56:02', 0),
(11, 'Johnydrille', 'John29', 'get', '2025-01-20 09:17:07', 0),
(12, 'John29', 'Johnydrille', 'i get', '2025-01-20 09:18:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `post` text NOT NULL,
  `date` datetime NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `comments` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post`, `date`, `parent_id`, `comments`) VALUES
(1, 1, 'This is my first post', '2023-02-06 16:30:16', 0, 0),
(2, 1, 'this is my second post', '2023-02-06 16:49:15', 0, 0),
(3, 1, 'this is my third post', '2023-02-06 16:50:19', 0, 0),
(4, 1, 'this is my fourth post', '2023-02-06 17:07:56', 0, 1),
(5, 1, 'post number 5', '2023-02-06 17:17:48', 0, 0),
(6, 4, 'a post by mary and some other guy', '2023-02-10 16:31:06', 0, 0),
(10, 4, 'a comment by mary', '2023-02-10 20:59:06', 0, 0),
(11, 4, 'another post by mary', '2023-02-10 20:59:51', 0, 5),
(13, 4, 'a real comment by mary', '2023-02-10 21:11:26', 11, 0),
(14, 4, 'a second comment by mary', '2023-02-10 21:11:48', 11, 0),
(15, 4, 'a third comment', '2023-02-10 21:13:08', 11, 0),
(16, 4, 'a comment on eathornes post', '2023-02-10 21:14:25', 4, 0),
(17, 1, 'a comment by eathorne', '2023-02-10 21:18:13', 11, 0),
(18, 5, 'Hi, this is my first post as john doe', '2023-02-10 23:20:02', 0, 1),
(19, 5, 'a comment by john does on his own post', '2023-02-10 23:20:17', 18, 0),
(20, 5, 'hey there guys', '2023-02-10 23:20:30', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `question` varchar(230) NOT NULL,
  `options` varchar(255) NOT NULL,
  `correct_option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `section_title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `course_id`, `section_title`, `created_at`) VALUES
(1, 1, 'Introduction', '2025-01-24 18:03:19'),
(2, 1, 'yh', '2025-01-24 18:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `source_codes`
--

CREATE TABLE `source_codes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subtitles`
--

CREATE TABLE `subtitles` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `code_snippet` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subtitles`
--

INSERT INTO `subtitles` (`id`, `section_id`, `subtitle`, `content`, `code_snippet`) VALUES
(1, 2, 'what is html', 'w34ety', '<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <title>Document</title>\n</head>\n<body>\n    yes\n</body>\n</html>'),
(2, 2, 'testing', 'q3w4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `account_type` varchar(30) NOT NULL,
  `score` int(11) DEFAULT 0,
  `level` int(11) DEFAULT 1,
  `completed_courses` text DEFAULT '[]',
  `fb` varchar(50) NOT NULL,
  `tw` varchar(50) NOT NULL,
  `yt` varchar(50) NOT NULL,
  `date` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `signup_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `name`, `email`, `password`, `bio`, `image_path`, `account_type`, `score`, `level`, `completed_courses`, `fb`, `tw`, `yt`, `date`, `is_active`, `signup_date`) VALUES
(1, 'user_6760c8bb991ae', 'Johnameh29', 'John Ameh ', 'johnameh29@gmail.com', '12345678', 'learning Enthusiast', '973556760c8bb991e5.jpg', 'admin', 0, 1, '[]', '', '', '', '2025-01-04', 0, '2025-01-25 19:21:37'),
(10, 'user_67740ff1c88fd', 'Johnydrille', 'John Ameh ', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '3604167740ff1c8924.jpeg', 'mentor', 0, 1, '[]', 'fb', 'tw', 'yt', '2025-01-04', 0, '2025-01-25 19:21:37'),
(14, 'user_67790f88dc895', 'John29', 'John Ameh ', 'johnameh2@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '9931067790f88dc972.jpeg', 'learner', 0, 1, '[]', 'fb', 'tw', 'yt', NULL, 0, '2025-01-25 19:21:37'),
(31, 'user_67740ff1c88fd', 'Johnydrille', 'John Ameh ', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '3604167740ff1c8924.jpeg', 'mentor', 0, 1, '[]', 'fb', 'tw', 'yt', '2025-01-04', 0, '2025-01-25 19:21:37'),
(32, 'user_67740ff1c88fd', 'Johnydrille', 'John Ameh ', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '3604167740ff1c8924.jpeg', 'mentor', 0, 1, '[]', 'fb', 'tw', 'yt', '2025-01-04', 0, '2025-01-25 19:21:37'),
(33, 'user_67740ff1c88fd', 'Johnydrille', 'John Ameh ', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '3604167740ff1c8924.jpeg', 'mentor', 0, 1, '[]', 'fb', 'tw', 'yt', '2025-01-04', 0, '2025-01-25 19:21:37'),
(34, 'user_67740ff1c88fd', 'Johnydrille', 'John Ameh ', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '3604167740ff1c8924.jpeg', 'mentor', 0, 1, '[]', 'fb', 'tw', 'yt', '2025-01-04', 0, '2025-01-25 19:21:37'),
(35, 'user_67740ff1c88fd', 'Johnydrille', 'John Ameh ', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '3604167740ff1c8924.jpeg', 'mentor', 0, 1, '[]', 'fb', 'tw', 'yt', '2025-01-04', 0, '2025-01-25 19:21:37'),
(36, 'user_67740ff1c88fd', 'Johnydrille', 'John Ameh ', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '3604167740ff1c8924.jpeg', 'mentor', 0, 1, '[]', 'fb', 'tw', 'yt', '2025-01-04', 0, '2025-01-25 19:21:37'),
(40, 'user_67952c51b6337', 'Johny', 'John Ameh ', 'johnameh@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '2132067952c51c1f33.png', 'admin', 0, 1, '[]', 'fb', 'tw', 'yt', NULL, 0, '2024-01-25 19:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_progress`
--

CREATE TABLE `user_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `points_earned` int(11) DEFAULT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `comments` (`comments`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `source_codes`
--
ALTER TABLE `source_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subtitles`
--
ALTER TABLE `subtitles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_progress`
--
ALTER TABLE `user_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `source_codes`
--
ALTER TABLE `source_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subtitles`
--
ALTER TABLE `subtitles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user_progress`
--
ALTER TABLE `user_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `source_codes`
--
ALTER TABLE `source_codes`
  ADD CONSTRAINT `source_codes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subtitles`
--
ALTER TABLE `subtitles`
  ADD CONSTRAINT `subtitles_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
