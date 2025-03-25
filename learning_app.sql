-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 01:32 PM
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
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `id` int(11) NOT NULL,
  `caller` varchar(255) NOT NULL,
  `callee` varchar(255) NOT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calls`
--

INSERT INTO `calls` (`id`, `caller`, `callee`, `status`, `timestamp`) VALUES
(1, 'Johnee', 'awe', 'accepted', '2025-03-05 01:28:43'),
(2, 'Johnee', 'awe', 'rejected', '2025-03-05 01:41:56');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_premium` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`, `created_at`, `is_premium`) VALUES
(1, 'HTML', 'HTML (HyperText Markup Language) is the standard markup language for creating web pages. Learn how to structure content on the web.', 'uploads/logo-2582748_640.webp', '2025-03-12 00:16:54', 0),
(2, 'CSS', 'CSS (Cascading Style Sheets) is used to style and layout web pages. Learn how to make your web pages visually appealing.', 'uploads/919826.png', '2025-03-12 00:25:45', 0);

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
(8, 'Adole', 'awe', 'hi', '2025-03-15 23:35:44', 0);

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
(3, 'user_67c62fdc6f212', 'hi', '2025-03-08 02:14:41', 2, 0),
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

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `course_id`, `question`, `options`, `correct_option`) VALUES
(1, '2', 'What does PHP stand for?', '[\"Personal Home Page\",\"PHP: Hypertext Preprocessor\",\"Private Hosting Protocol\",\"Programming HTML Pages\"]', 'PHP: Hypertext Preprocessor'),
(2, '2', 'Which function is used to print text in PHP?', '[\"echo\",\"print\",\"printf\",\"All of the above\"]', 'All of the above'),
(3, '2', 'How do you declare a variable in PHP?', '[\"$variable_name\",\"var variable_name\",\"variable_name = value\",\"declare variable_name\"]', '$variable_name'),
(4, '2', 'Which of the following is NOT a valid PHP data type?', '[\"Boolean\",\"Integer\",\"String\",\"Character\"]', 'Character'),
(5, '2', 'Which PHP superglobal is used to collect form data?', '[\"$_POST\",\"$_SESSION\",\"$_COOKIE\",\"$_GET\"]', '$_POST'),
(6, '2', 'What will count([1, 2, 3, 4]) return?', '[\"3\",\"4\",\"5\",\"Error\"]', '4'),
(7, '2', 'Which function is used to check if a variable is set?', '[\"isset()\",\"empty()\",\"is_null()\",\"defined()\"]', 'isset()'),
(8, '2', 'What is the correct way to open a file in PHP?', '[\"fopen(\'file.txt\', \'r\');\",\"open(\'file.txt\');\",\"file_open(\'file.txt\', \'r\');\",\"open_file(\'file.txt\');\"]', 'fopen(\'file.txt\', \'r\');'),
(9, '2', 'Which function is used to include a file and continue execution even if the file is missing?', '[\"include\",\"require\",\"require_once\",\"include_once\"]', 'include'),
(10, '2', 'Which function is used to end a session in PHP?', '[\"session_end()\",\"session_destroy()\",\"session_stop()\",\"session_close()\"]', 'session_destroy()'),
(11, '2', 'Which keyword is used to define a class in PHP?', '[\"class\",\"function\",\"object\",\"define\"]', 'class'),
(12, '2', 'How do you create a new object in PHP?', '[\"$obj = new ClassName();\",\"$obj = ClassName();\",\"ClassName $obj = new();\",\"$obj = class(ClassName);\"]', '$obj = new ClassName();'),
(13, '2', 'Which PHP function is used to sanitize user input?', '[\"filter_input()\",\"sanitize_input()\",\"escape_string()\",\"html_escape()\"]', 'filter_input()'),
(14, '2', 'Which function is used to hash passwords securely in PHP?', '[\"md5()\",\"sha1()\",\"password_hash()\",\"crypt()\"]', 'password_hash()'),
(15, '2', 'Which SQL command is used to retrieve data?', '[\"SELECT\",\"UPDATE\",\"DELETE\",\"INSERT\"]', 'SELECT'),
(16, '2', 'Which function is used to connect to a MySQL database in PHP?', '[\"mysqli_connect()\",\"mysql_connect()\",\"pdo_connect()\",\"connect()\"]', 'mysqli_connect()'),
(17, '2', 'Which PHP function is used to redirect a user to another page?', '[\"redirect()\",\"header()\",\"goto()\",\"forward()\"]', 'header()'),
(18, '2', 'How do you prevent SQL injection in PHP?', '[\"Using prepared statements\",\"Escaping user input with addslashes()\",\"Disabling user input\",\"Allowing only admin users\"]', 'Using prepared statements'),
(19, '2', 'What does isset($var) return if $var is null?', '[\"true\",\"false\",\"null\",\"1\"]', 'false'),
(20, '2', 'What does isset($var) return if $var is null?', '[\"true\",\"false\",\"null\",\"1\"]', 'false');

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
(1, 1, 'Introduction to HTML', '2025-03-12 00:17:58'),
(2, 1, 'HTML Basics', '2025-03-12 00:18:15'),
(3, 2, 'Introduction to CSS', '2025-03-12 00:26:32'),
(4, 2, 'CSS Box Model', '2025-03-12 00:26:45');

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
(1, 1, 'What is HTML?', 'HTML stands for HyperText Markup Language. It is the standard markup language for creating web pages.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n</head>\n<body>\n    <h1>My First Heading</h1>\n    <p>My first paragraph.</p>\n</body>\n</html>'),
(2, 1, 'HTML Elements', 'HTML elements are the building blocks of HTML pages. They are represented by tags.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n</head>\n<body>\n<p>This is a paragraph.</p>\n<a href=\"https://www.example.com\">This is a link</a>\n</body>\n</html>'),
(3, 1, 'HTML Attributes', 'Attributes provide additional information about HTML elements.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n</head>\n<body>\n<img src=\"image.jpg\" alt=\"Description of image\">\n</body>\n</html>'),
(4, 2, 'Headings', 'HTML headings are defined with the <h1> to <h6> tags.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n</head>\n<body>\n<h1>Heading 1</h1>\n<h2>Heading 2</h2>\n</body>\n</html>'),
(5, 2, 'Paragraphs', 'Paragraphs are defined with the <p> tag.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n</head>\n<body>\n<p>This is a paragraph.</p>\n</body>\n</html>'),
(6, 2, 'Links', 'Links are defined with the <a> tag.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n</head>\n<body>\n<a href=\"https://www.example.com\">Visit Example</a>\n</body>\n</html>'),
(7, 3, 'What is CSS?', 'CSS stands for Cascading Style Sheets. It is used to style HTML elements.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n<style>\n.body-class {\n    background-color: lightblue;\n}\n</style>\n</head>\n<body class=\"body-class\">\n</body>\n</html>'),
(8, 3, 'CSS Syntax', 'CSS rules consist of a selector and a declaration block.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n<style>\np {\n    color: red;\n    font-size: 16px;\n}\n</style>\n</head>\n<body>\n<p>hello</p>\n</body>\n</html>'),
(9, 3, 'CSS Selectors', 'Selectors are used to target HTML elements for styling.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n<style>\n.class {\n    color: blue;\n}\n#id {\n    color: green;\n}\n</style>\n</head>\n<body>\n<span class=\"class\">hello world!!</span>\n<span id=\"id\"> hello world!!</span>\n</body>\n</html>'),
(10, 4, 'Margin and Padding', 'Margin is the space outside the element, while padding is the space inside the element.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n<style>\n.div-class {\n    margin: 10px;\n    padding: 20px;\n}\n</style>\n</head>\n<body>\n<div class=\"div-class\">\n<p>margin</p>\n</div>\n</body>\n</html>\n'),
(11, 4, 'Border', 'Borders can be styled using CSS.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n<style>\n.div-class-2 {\n    border: 2px solid black;\n}\n</style>\n</head>\n<body>\n<div class=\"div-class-2\">\n<p>Borders</p>\n</body>\n</html>'),
(12, 4, 'Box Sizing', 'The box-sizing property controls how the total width and height of an element is calculated.', '<!DOCTYPE html>\n<html>\n<head>\n    <title>Page Title</title>\n<style>\n.div-class-3 {\n    box-sizing: border-box;\n}\n</style>\n</head>\n<body>\n<div class=\"div-class-3\">\n<span> Border-box</span>\n</div>\n</body>\n</html>');

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
(20, 'user_67c62fdc6f212', 'awe', 'John Ameh', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '5465067c62fdc6f23e.jpeg', 'learner', 'verified', 3700, 1, '[]', 'fb', 'tw', 'yt', NULL, 0, '2025-03-03 23:40:28'),
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

--
-- Dumping data for table `user_completed_courses`
--

INSERT INTO `user_completed_courses` (`id`, `user_id`, `course_id`, `name`, `completed_at`) VALUES
(1, 20, 2, 'CSS', '2025-03-18 01:12:18');

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
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `code_templates`
--
ALTER TABLE `code_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `source_codes`
--
ALTER TABLE `source_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subtitles`
--
ALTER TABLE `subtitles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_completed_courses`
--
ALTER TABLE `user_completed_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
