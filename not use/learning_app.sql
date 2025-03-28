-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 05:28 AM
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
-- Table structure for table `code_templates`
--

CREATE TABLE `code_templates` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `thumbnail` varchar(255) DEFAULT NULL,
  `screenshot1` varchar(255) DEFAULT NULL,
  `screenshot2` varchar(255) DEFAULT NULL,
  `screenshot3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `code_templates`
--

INSERT INTO `code_templates` (`id`, `title`, `description`, `file_name`, `uploaded_at`, `thumbnail`, `screenshot1`, `screenshot2`, `screenshot3`) VALUES
(1, 'John', 'qeb', 'ngrok-v3-stable-windows-amd64.zip', '2025-03-18 05:08:32', 'dp.jpeg', 'IMG-20230817-WA0000.jpg', '1st.jpg', 'agile image.jpeg'),
(2, 'John', 'tyk', 'ngrok-v3-stable-windows-amd64.zip', '2025-03-18 05:14:58', 'dp.jpeg', 'ei_1714520539869-removebg~2.png', 'ei_1714520539869-removebg~2.png', 'dp.jpeg'),
(3, 'mobile template landing page', 'ttt', 'ngrok-v3-stable-windows-amd64.zip', '2025-03-18 12:16:50', 'certificate-of-completion.png', 'certificate-of-completion.png', '1080.jpg', 'certificate-of-completion.png'),
(4, 'mobile template landing page', 'ttt', 'ngrok-v3-stable-windows-amd64.zip', '2025-03-18 12:16:50', 'certificate-of-completion.png', 'certificate-of-completion.png', '1080.jpg', 'certificate-of-completion.png');

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
(2, 'john', 'johnameh@gmail.com', 'very well', '2025-10-09 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_premium` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`, `created_at`, `is_premium`) VALUES
(10, 'Java', 'Java is a high-level, general-purpose, memory-safe, object-oriented programming language. It is intended to let programmers write once, run anywhere', 'uploads/what-is-java-image.png', '2025-03-27 22:45:11', 0);

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
(1, 'Johnameh', 'Johnameh29', 'hi', '2025-02-01 21:33:41', 0),
(2, 'Johnameh', 'Johnameh29', 'yh', '2025-02-01 22:14:30', 0),
(3, 'Johnameh29', 'Johnameh', 'hi', '2025-02-01 22:20:15', 0),
(4, 'Johnameh', 'Johnameh29', 'yh', '2025-02-05 02:37:53', 0),
(5, 'Johnameh29', 'Johnameh', 'what', '2025-02-05 02:38:09', 0),
(6, 'awe', 'Johnee', 'hi', '2025-03-05 00:17:37', 0),
(7, 'Johnee', 'awe', 'yh', '2025-03-05 00:41:46', 0),
(8, 'Adole', 'awe', 'hi', '2025-03-15 23:35:44', 0),
(9, 'awe', 'Johnee', 'Yh', '2025-03-28 03:48:42', 0),
(10, 'Johnee', 'awe', 'yh', '2025-03-28 04:02:52', 0),
(11, 'awe', 'dan', 'Yes', '2025-03-28 04:19:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(500) NOT NULL,
  `post` text NOT NULL,
  `date` datetime NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `comments` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post`, `date`, `parent_id`, `comments`) VALUES
(4, 'user_67c62fdc6f212', 'Good morning', '2025-03-08 02:33:33', 0, 1),
(6, 'user_67c62fdc6f212', 'Good day', '2025-03-18 02:02:33', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`options`)),
  `correct_option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_payments`
--

CREATE TABLE `quiz_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `payment_reference` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
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

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `email`, `rating`, `message`, `created_at`) VALUES
(1, 'john', 'joe@gmail.com', 5, 'hi', '2025-12-12'),
(2, 'awe', 'johnameh107@gmail.com', 5, 'yes', '2025-03-18');

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
(9, 10, 'Java Intro', '2025-03-27 22:50:50'),
(10, 10, 'Java Syntax', '2025-03-27 22:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `source_codes`
--

CREATE TABLE `source_codes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `source_codes`
--

INSERT INTO `source_codes` (`id`, `title`, `description`, `price`, `file_path`, `user_id`) VALUES
(1, 'wjbj', 'jqle', 2345, 'uploads/codesconfig.inc.php', 'user_679e443c50d54'),
(2, 'nmrvmer', ' rhk3w', 2345, 'uploads/codesfail.alert.inc.php', 'user_679e443c50d54');

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
(1, 9, 'What is Java?', 'Java is a popular programming language, created in 1995.\r\n\r\nIt is owned by Oracle, and more than 3 billion devices run Java.\r\n\r\nIt is used for:\r\n\r\n1. Mobile applications (specially Android apps)\r\n2. Desktop applications\r\n3. Web applications\r\n4. Web servers and application servers\r\n5 .Games\r\n6. Database connection\r\nAnd much, much more!', ''),
(2, 10, 'Java Syntax', 'We use the following code to print \"Hello World\" to the screen:', 'class Main {\r\n  public static void main(String[] args) {\r\n    System.out.println(\"Hello World\");\r\n  }\r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `account_type` varchar(30) NOT NULL,
  `badge` varchar(255) NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
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

INSERT INTO `users` (`id`, `user_id`, `username`, `name`, `email`, `password`, `bio`, `image_path`, `account_type`, `badge`, `score`, `level`, `completed_courses`, `fb`, `tw`, `yt`, `date`, `is_active`, `signup_date`) VALUES
(20, 'user_67c62fdc6f212', 'awe', 'John Ameh', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '5465067c62fdc6f23e.jpeg', 'learner', 'Normal', 3700, 1, '[]', 'fb', 'tw', 'yt', NULL, 0, '2025-03-03 23:40:28'),
(21, 'user_45iuriu576ooaiw', 'Johnee', 'John Ameh', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '5465067c62fdc6f23e.jpeg', 'mentor', 'verified', 0, 1, '[]', 'fb', 'tw', 'yt', NULL, 0, '2025-03-03 23:40:28'),
(23, 'user_45jrf455mnv89', 'Johnameh', 'John Ameh', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '5465067c62fdc6f23e.jpeg', 'admin', 'verified', 0, 1, '[]', 'fb', 'tw', 'yt', NULL, 0, '2025-03-03 23:40:28'),
(24, 'user_67c8fa7f94c54', 'test', 'John Ameh', 'johnamehyh@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '7951167c8fa7f94dac.jpeg', 'learner', 'Normal', 0, 1, '[]', 'fb', 'tw', 'yt', NULL, 0, '2025-03-06 02:29:35'),
(25, 'user_67c8faaa1a984', 'dan', 'John Ameh', 'johnameh1070@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '2669967c8faaa1a996.jpg', 'mentor', 'verified', 0, 1, '[]', 'fb', 'tw', 'yt', NULL, 0, '2025-03-06 02:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_completed_courses`
--

CREATE TABLE `user_completed_courses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `webrtc_signaling`
--

CREATE TABLE `webrtc_signaling` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `type` enum('offer','answer','candidate','hangup','reject') NOT NULL,
  `sdp` text DEFAULT NULL,
  `candidate` text DEFAULT NULL,
  `call_type` enum('video','audio') DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `webrtc_signaling`
--

INSERT INTO `webrtc_signaling` (`id`, `sender`, `recipient`, `type`, `sdp`, `candidate`, `call_type`, `timestamp`) VALUES
(279, 'awe', 'dan', 'hangup', NULL, NULL, NULL, '2025-03-28 05:12:01'),
(280, 'awe', 'dan', 'hangup', NULL, NULL, NULL, '2025-03-28 05:12:24'),
(281, 'awe', 'dan', 'hangup', NULL, NULL, NULL, '2025-03-28 05:12:47'),
(282, 'awe', 'dan', 'hangup', NULL, NULL, NULL, '2025-03-28 05:13:51'),
(283, 'awe', 'dan', 'hangup', NULL, NULL, NULL, '2025-03-28 05:14:16'),
(284, 'awe', 'dan', 'hangup', NULL, NULL, NULL, '2025-03-28 05:18:24'),
(285, 'awe', 'dan', 'hangup', NULL, NULL, NULL, '2025-03-28 05:20:23'),
(286, 'awe', 'dan', 'hangup', NULL, NULL, NULL, '2025-03-28 05:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `webrtc_signaling_1`
--

CREATE TABLE `webrtc_signaling_1` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `type` enum('offer','answer','candidate','hangup','reject') NOT NULL,
  `sdp` text DEFAULT NULL,
  `candidate` text DEFAULT NULL,
  `call_type` varchar(20) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `webrtc_signaling_1`
--

INSERT INTO `webrtc_signaling_1` (`id`, `sender`, `recipient`, `type`, `sdp`, `candidate`, `call_type`, `timestamp`) VALUES
(1, 'awe', 'dan', 'offer', 'v=0\r\no=- 604298286231344206 2 IN IP4 127.0.0.1\r\ns=-\r\nt=0 0\r\na=group:BUNDLE 0\r\na=extmap-allow-mixed\r\na=msid-semantic: WMS 505c5ff3-7d7c-4ae2-9d84-1303d5b47217\r\nm=audio 9 UDP/TLS/RTP/SAVPF 111 63 9 0 8 13 110 126\r\nc=IN IP4 0.0.0.0\r\na=rtcp:9 IN IP4 0.0.0.0\r\na=ice-ufrag:JsGz\r\na=ice-pwd:mESMufxzS+haZJ73NEN0wayY\r\na=ice-options:trickle\r\na=fingerprint:sha-256 B3:EA:F8:EA:A0:BB:BC:11:B9:8F:C7:45:C0:CB:BB:F5:EA:FB:E4:28:AE:0C:47:65:0B:9F:C3:C3:87:E2:05:47\r\na=setup:actpass\r\na=mid:0\r\na=extmap:1 urn:ietf:params:rtp-hdrext:ssrc-audio-level\r\na=extmap:2 http://www.webrtc.org/experiments/rtp-hdrext/abs-send-time\r\na=extmap:3 http://www.ietf.org/id/draft-holmer-rmcat-transport-wide-cc-extensions-01\r\na=extmap:4 urn:ietf:params:rtp-hdrext:sdes:mid\r\na=sendrecv\r\na=msid:505c5ff3-7d7c-4ae2-9d84-1303d5b47217 009efc38-23c2-49c8-a879-e47f88b96080\r\na=rtcp-mux\r\na=rtcp-rsize\r\na=rtpmap:111 opus/48000/2\r\na=rtcp-fb:111 transport-cc\r\na=fmtp:111 minptime=10;useinbandfec=1\r\na=rtpmap:63 red/48000/2\r\na=fmtp:63 111/111\r\na=rtpmap:9 G722/8000\r\na=rtpmap:0 PCMU/8000\r\na=rtpmap:8 PCMA/8000\r\na=rtpmap:13 CN/8000\r\na=rtpmap:110 telephone-event/48000\r\na=rtpmap:126 telephone-event/8000\r\na=ssrc:992876071 cname:vDYYnWZ8NAxm9a+g\r\na=ssrc:992876071 msid:505c5ff3-7d7c-4ae2-9d84-1303d5b47217 009efc38-23c2-49c8-a879-e47f88b96080\r\n', NULL, 'audio', '2025-03-28 02:25:30'),
(2, 'awe', 'dan', 'candidate', NULL, 'Array', NULL, '2025-03-28 02:25:30'),
(3, 'awe', 'dan', 'candidate', NULL, 'Array', NULL, '2025-03-28 02:25:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `code_templates`
--
ALTER TABLE `code_templates`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `quiz_payments`
--
ALTER TABLE `quiz_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user_completed_courses`
--
ALTER TABLE `user_completed_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

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
-- Indexes for table `webrtc_signaling`
--
ALTER TABLE `webrtc_signaling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webrtc_signaling_1`
--
ALTER TABLE `webrtc_signaling_1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipient` (`recipient`),
  ADD KEY `sender` (`sender`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `code_templates`
--
ALTER TABLE `code_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_payments`
--
ALTER TABLE `quiz_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `source_codes`
--
ALTER TABLE `source_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subtitles`
--
ALTER TABLE `subtitles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_completed_courses`
--
ALTER TABLE `user_completed_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `webrtc_signaling`
--
ALTER TABLE `webrtc_signaling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `webrtc_signaling_1`
--
ALTER TABLE `webrtc_signaling_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `quiz_payments`
--
ALTER TABLE `quiz_payments`
  ADD CONSTRAINT `quiz_payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `quiz_payments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subtitles`
--
ALTER TABLE `subtitles`
  ADD CONSTRAINT `subtitles_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_completed_courses`
--
ALTER TABLE `user_completed_courses`
  ADD CONSTRAINT `user_completed_courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_completed_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
