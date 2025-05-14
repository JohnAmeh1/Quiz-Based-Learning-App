-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 01:27 AM
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
(10, 'Java', 'Java is a high-level, general-purpose, memory-safe, object-oriented programming language. It is intended to let programmers write once, run anywhere', 'uploads/what-is-java-image.png', '2025-03-27 22:45:11', 0),
(12, 'Javascript', 'JavaScript (JS) is a lightweight interpreted (or just-in-time compiled) programming language with first-class functions. While it is most well-known as the scripting language for Web pages, many non-browser environments also use it, such as Node.js, Apache CouchDB and Adobe Acrobat.', 'uploads/js.jpeg', '2025-04-20 00:03:55', 0),
(13, 'Python', 'Python is a high-level, general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation.', 'uploads/python.jpeg', '2025-04-20 00:04:53', 0);

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
(9, 'awe', 'Johnee', 'Yh', '2025-03-28 03:48:42', 0);

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
(11, 10, 'Introduction to Java', '2025-04-20 00:33:16'),
(12, 10, 'Java Fundamentals', '2025-04-20 00:33:16'),
(13, 10, 'Working with Java Basics', '2025-04-20 00:33:16'),
(14, 10, 'Advanced Java Concepts', '2025-04-20 00:33:16'),
(15, 10, 'Real-world Applications of Java', '2025-04-20 00:33:16'),
(16, 10, 'Java for Beginners', '2025-04-20 00:33:16'),
(17, 10, 'Java Intermediate Level', '2025-04-20 00:33:16'),
(18, 10, 'Java Expert Techniques', '2025-04-20 00:33:16'),
(19, 10, 'Mastering Java', '2025-04-20 00:33:16'),
(20, 10, 'Java Project Workshop', '2025-04-20 00:33:16'),
(21, 10, 'Best Practices in Java', '2025-04-20 00:33:16'),
(23, 10, 'Java Challenges and Solutions', '2025-04-20 00:33:16'),
(24, 10, 'Debugging Java Programs', '2025-04-20 00:33:16'),
(25, 10, 'Java Libraries and Tools', '2025-04-20 00:33:16'),
(26, 10, 'Setting Up Your Java Environment', '2025-04-20 00:33:16'),
(27, 10, 'Writing Clean Code in Java', '2025-04-20 00:33:16'),
(28, 10, 'Java Syntax and Semantics', '2025-04-20 00:33:16'),
(29, 10, 'Handling Errors in Java', '2025-04-20 00:33:16'),
(30, 10, 'Optimizing Java Performance', '2025-04-20 00:33:16'),
(31, 10, 'Security in Java Programming', '2025-04-20 00:33:16'),
(32, 10, 'Scalability in Java Projects', '2025-04-20 00:33:16'),
(33, 10, 'Deploying Java Applications', '2025-04-20 00:33:16'),
(34, 10, 'Exploring Java Frameworks', '2025-04-20 00:33:16'),
(35, 10, 'Hands-on Java Examples', '2025-04-20 00:33:16'),
(36, 10, 'Java Final Project', '2025-04-20 00:33:16'),
(37, 10, 'Tips and Tricks for Java', '2025-04-20 00:33:16'),
(38, 10, 'Java Interview Questions', '2025-04-20 00:33:16'),
(39, 10, 'Java Ecosystem Overview', '2025-04-20 00:33:16'),
(40, 10, 'Next Steps After Learning Java', '2025-04-20 00:33:16');

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
(3, 11, 'What is Java?', 'Java is a high-level, class-based, object-oriented programming language designed to have as few implementation dependencies as possible. It was originally developed by James Gosling at Sun Microsystems (now owned by Oracle Corporation) in 1995. Java applications are typically compiled to bytecode that can run on any Java virtual machine (JVM) regardless of the underlying computer architecture. Java is widely used for building enterprise-scale web applications, Android mobile apps, desktop applications, embedded systems, and more. The language emphasizes readability, portability, and security, making it one of the most popular programming languages in the world.', ''),
(4, 11, 'Java Syntax Basics', 'Java syntax forms the foundation of writing Java programs. It follows a C-style syntax but with stronger object-oriented principles. A basic Java program consists of classes containing methods, with the main method serving as the entry point. Java is case-sensitive, uses semicolons to terminate statements, and curly braces to define blocks of code. Understanding Java syntax is crucial as it enforces strict rules that help prevent common programming errors. The language uses a static type system which requires all variables to be declared with their data types before use, contributing to code reliability and maintainability.', 'class Main {\n    public static void main(String[] args) {\n        checkJavaInstallation();\n    }\n\n    static void checkJavaInstallation() {\n        System.out.println(\"Java Version: \" + System.getProperty(\"java.version\"));\n        System.out.println(\"JRE Home: \" + System.getProperty(\"java.home\"));\n        System.out.println(\"Class Path: \" + System.getProperty(\"java.class.path\"));\n    }\n}'),
(5, 11, 'Setting Up Java Environment', 'To begin Java development, you need to set up the Java Development Kit (JDK) which includes the Java Runtime Environment (JRE), compiler, and other essential tools. The latest version can be downloaded from Oracle\'s official website. After installation, configure the PATH environment variable to access Java commands from any directory. Modern Integrated Development Environments (IDEs) like IntelliJ IDEA, Eclipse, or NetBeans provide comprehensive tools for Java development including code completion, debugging, and project management. Understanding the Java build process and being able to compile and run programs from the command line are fundamental skills for any Java developer.', 'class Main {\n    public static void main(String[] args) {\n        checkJavaInstallation();\n    }\n\n    static void checkJavaInstallation() {\n        System.out.println(\"Java Version: \" + System.getProperty(\"java.version\"));\n        System.out.println(\"JRE Home: \" + System.getProperty(\"java.home\"));\n        System.out.println(\"Class Path: \" + System.getProperty(\"java.class.path\"));\n    }\n}'),
(6, 12, 'Primitive Data Types', 'Java has eight primitive data types that serve as the building blocks for data manipulation. These include four integer types (byte, short, int, long), two floating-point types (float, double), one character type (char), and one boolean type (boolean). Each type has a specific size and range of values it can represent. Primitive types are stored directly in memory and are not objects, making them more efficient for simple values. Understanding these types is crucial as they determine how much memory is allocated, what values can be stored, and what operations can be performed on them. Java also provides wrapper classes for each primitive type to enable object-oriented features when needed.', 'class Main {\n    public static void main(String[] args) {\n        demonstratePrimitives();\n    }\n\n    static void demonstratePrimitives() {\n        // Integer types\n        byte smallNumber = 127;          // 8-bit (-128 to 127)\n        short mediumNumber = 32767;      // 16-bit (-32,768 to 32,767)\n        int normalNumber = 2147483647;   // 32-bit (-2^31 to 2^31-1)\n        long bigNumber = 9223372036854775807L; // 64-bit (suffix with L)\n        \n        // Floating-point types\n        float decimalNumber = 3.14f;     // 32-bit (suffix with f)\n        double preciseDecimal = 3.141592653589793; // 64-bit\n        \n        // Other types\n        char letter = \'A\';               // 16-bit Unicode character\n        boolean flag = true;             // true or false\n        \n        System.out.println(\"Byte value: \" + smallNumber);\n    }\n}'),
(7, 12, 'Variables and Constants', 'Variables in Java are named memory locations that store data values during program execution. They must be declared with a specific type before use and can be initialized at declaration or later. Java supports various variable scopes: class variables (static fields), instance variables (non-static fields), local variables (declared within methods), and parameters. Constants are variables whose values cannot change after initialization, declared using the final keyword. Naming conventions recommend using camelCase for variables and UPPER_CASE for constants. Understanding variable scope and lifetime is essential for writing correct and efficient Java programs.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateVariables();\n    }\n\n    // Class/static variable\n    static int classCount = 0;\n    \n    // Instance variable\n    String instanceName;\n    \n    static void demonstrateVariables() {\n        // Local variable\n        int localNumber = 42;\n        \n        // Constant (final variable)\n        final double PI = 3.14159;\n        \n        Main demo = new Main();\n        demo.instanceName = \"Example\";\n        \n        System.out.println(\"Local number: \" + localNumber);\n        System.out.println(\"PI constant: \" + PI);\n        System.out.println(\"Instance name: \" + demo.instanceName);\n        System.out.println(\"Class count: \" + classCount);\n    }\n}'),
(8, 12, 'Type Conversion and Casting', 'Java supports both implicit (widening) and explicit (narrowing) type conversions. Widening conversions happen automatically when converting a smaller type to a larger compatible type (e.g., int to double) as no data loss occurs. Narrowing conversions require explicit casting and may result in data loss or precision reduction. Java also supports type promotion in expressions, where operands are automatically promoted to a common type before operation. Understanding type conversion rules is crucial for preventing unexpected behavior in arithmetic operations and method calls. The instanceof operator helps check object types before casting to avoid ClassCastException.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateConversions();\n    }\n\n    static void demonstrateConversions() {\n        // Widening conversion (automatic)\n        int intValue = 100;\n        long longValue = intValue;       // No casting needed\n        double doubleValue = longValue;   // No casting needed\n        \n        // Narrowing conversion (requires explicit cast)\n        double pi = 3.14159;\n        int approxPi = (int) pi;         // Explicit cast, loses decimal part\n        \n        // Type promotion in expressions\n        byte b = 42;\n        char c = \'a\';\n        short s = 1024;\n        int i = 50000;\n        float f = 5.67f;\n        double d = .1234;\n        double result = (f * b) + (i / c) - (d * s);\n        \n        System.out.println(\"Approximate PI: \" + approxPi);\n        System.out.println(\"Expression result: \" + result);\n    }\n}'),
(9, 13, 'Arithmetic Operators', 'Java provides a comprehensive set of arithmetic operators for performing mathematical calculations. The basic operators include addition (+), subtraction (-), multiplication (*), division (/), and modulus (%). The division operator behaves differently with integers (truncates decimal) versus floating-point numbers. The modulus operator returns the remainder after division and is particularly useful for cyclic operations. Java also includes increment (++) and decrement (--) operators that modify a variable\'s value by 1. These operators can be used in both prefix and postfix forms, affecting when the operation occurs in statement evaluation. Understanding operator precedence is essential for writing correct mathematical expressions.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateOperators();\n    }\n\n    static void demonstrateOperators() {\n        int a = 10;\n        int b = 3;\n        \n        // Basic arithmetic operations\n        System.out.println(\"a + b = \" + (a + b));  // 13\n        System.out.println(\"a - b = \" + (a - b));  // 7\n        System.out.println(\"a * b = \" + (a * b));  // 30\n        System.out.println(\"a / b = \" + (a / b));  // 3 (integer division)\n        System.out.println(\"a % b = \" + (a % b));  // 1 (remainder)\n        \n        // Floating-point division\n        System.out.println(\"a / (double)b = \" + (a / (double)b)); // 3.333...\n        \n        // Increment/decrement operators\n        int c = 5;\n        System.out.println(\"Postfix c++: \" + (c++)); // Prints 5, then increments\n        System.out.println(\"Prefix ++c: \" + (++c));  // Increments, then prints 7\n        \n        // Operator precedence example\n        int result = 10 + 5 * 3;  // Multiplication has higher precedence\n        System.out.println(\"10 + 5 * 3 = \" + result); // 25, not 45\n    }\n}'),
(10, 13, 'Comparison Operators', 'Comparison operators (also called relational operators) are used to compare two values and return a boolean result (true or false). Java provides six comparison operators: equal to (==), not equal to (!=), greater than (>), less than (<), greater than or equal to (>=), and less than or equal to (<=). These operators are fundamental for controlling program flow through conditional statements. When comparing objects, == checks for reference equality (same memory location), while the equals() method should be used for content equality. Understanding the difference between primitive and object comparison is crucial for writing correct Java code.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateComparisons();\n    }\n\n    static void demonstrateComparisons() {\n        int x = 10;\n        int y = 20;\n        int z = 10;\n        \n        // Primitive comparisons\n        System.out.println(\"x == y: \" + (x == y));  // false\n        System.out.println(\"x != y: \" + (x != y));  // true\n        System.out.println(\"x > y: \" + (x > y));    // false\n        System.out.println(\"x < y: \" + (x < y));    // true\n        System.out.println(\"x >= z: \" + (x >= z));  // true\n        System.out.println(\"y <= z: \" + (y <= z));  // false\n        \n        // Object comparison\n        String s1 = \"hello\";\n        String s2 = \"hello\";\n        String s3 = new String(\"hello\");\n        \n        System.out.println(\"s1 == s2: \" + (s1 == s2));       // true (string pool)\n        System.out.println(\"s1 == s3: \" + (s1 == s3));       // false (different objects)\n        System.out.println(\"s1.equals(s3): \" + (s1.equals(s3))); // true (same content)\n        \n        // Practical use in conditionals\n        if (x < y) {\n            System.out.println(\"x is less than y\");\n        }\n    }\n}'),
(11, 13, 'Logical Operators', 'Logical operators perform boolean logic operations and are used to combine multiple conditions. Java provides three main logical operators: AND (&&), OR (||), and NOT (!). The && operator returns true only if both operands are true, while || returns true if at least one operand is true. The ! operator inverts the boolean value. Java uses short-circuit evaluation for && and || - if the first operand determines the result, the second isn\'t evaluated. There are also non-short-circuit versions (& and |) that always evaluate both operands. These operators are essential for creating complex conditions in control statements and loops.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateLogic();\n    }\n\n    static void demonstrateLogic() {\n        boolean a = true;\n        boolean b = false;\n        boolean c = true;\n        \n        // Basic logical operations\n        System.out.println(\"a && b: \" + (a && b));  // false\n        System.out.println(\"a || b: \" + (a || b));  // true\n        System.out.println(\"!a: \" + (!a));          // false\n        \n        // Short-circuit evaluation\n        System.out.println(\"Short-circuit AND:\");\n        if (false && someMethod()) {  // someMethod() never called\n            System.out.println(\"This will not execute\");\n        }\n        \n        System.out.println(\"Non-short-circuit AND:\");\n        if (false & someMethod()) {   // someMethod() always called\n            System.out.println(\"This will not execute\");\n        }\n        \n        // Complex condition\n        int age = 25;\n        boolean hasLicense = true;\n        boolean isDrunk = false;\n        \n        if (age >= 18 && hasLicense && !isDrunk) {\n            System.out.println(\"Allowed to drive\");\n        } else {\n            System.out.println(\"Not allowed to drive\");\n        }\n    }\n    \n    static boolean someMethod() {\n        System.out.println(\"Method executed\");\n        return true;\n    }\n}'),
(12, 14, 'Object-Oriented Programming', 'Object-Oriented Programming (OOP) in Java is built on four fundamental principles: encapsulation, inheritance, polymorphism, and abstraction. Encapsulation bundles data and methods into classes while hiding implementation details. Inheritance allows classes to inherit properties and behaviors from parent classes. Polymorphism enables objects to take on many forms through method overriding and interfaces. Abstraction simplifies complex reality by modeling classes appropriate to the problem domain. These principles promote code reuse, modularity, and maintainability. Understanding OOP is essential for designing robust Java applications that can evolve with changing requirements.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateOOP();\n    }\n\n    static class Animal {  // Abstraction\n        private String name; // Encapsulation\n        \n        public Animal(String name) {\n            this.name = name;\n        }\n        \n        public void makeSound() {  // Polymorphism (to be overridden)\n            System.out.println(\"Some generic animal sound\");\n        }\n        \n        public String getName() {  // Encapsulation (getter)\n            return name;\n        }\n    }\n    \n    static class Dog extends Animal {  // Inheritance\n        public Dog(String name) {\n            super(name);\n        }\n        \n        @Override\n        public void makeSound() {  // Polymorphism (method overriding)\n            System.out.println(getName() + \" says: Woof!\");\n        }\n    }\n    \n    static void demonstrateOOP() {\n        Animal myDog = new Dog(\"Rex\");  // Polymorphism (Animal reference to Dog)\n        myDog.makeSound();\n    }\n}'),
(13, 14, 'Exception Handling', 'Exception handling in Java provides a robust mechanism to handle runtime errors gracefully, preventing program crashes. Java exceptions are objects representing error conditions that disrupt normal program flow. Checked exceptions must be declared or handled, while unchecked exceptions (RuntimeException and its subclasses) don\'t require explicit handling. The try-catch-finally blocks are used to handle exceptions, with try enclosing code that might throw exceptions, catch handling specific exception types, and finally executing cleanup code regardless of exceptions. Proper exception handling improves program reliability and makes debugging easier by providing meaningful error information.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateHandling();\n    }\n\n    static void readFile(String filename) {\n        try {\n            // Simulate file reading that might fail\n            if (filename == null) {\n                throw new IllegalArgumentException(\"Filename cannot be null\");\n            }\n            System.out.println(\"Reading file: \" + filename);\n            // Simulate file not found\n            throw new java.io.FileNotFoundException(\"File not found\");\n        } catch (IllegalArgumentException e) {\n            System.err.println(\"Input error: \" + e.getMessage());\n        } catch (java.io.FileNotFoundException e) {\n            System.err.println(\"File error: \" + e.getMessage());\n        } catch (Exception e) {\n            System.err.println(\"Unexpected error: \" + e.getMessage());\n        } finally {\n            System.out.println(\"Cleanup operations complete\");\n        }\n    }\n    \n    static void demonstrateHandling() {\n        readFile(null);\n        readFile(\"data.txt\");\n    }\n}'),
(14, 14, 'Collections Framework', 'The Java Collections Framework provides a unified architecture for storing and manipulating groups of objects. Key interfaces include List (ordered collection), Set (unique elements), Queue (FIFO ordering), and Map (key-value pairs). Common implementations are ArrayList (resizable array), LinkedList (doubly-linked list), HashSet (hash table), TreeSet (balanced tree), HashMap (hash table), and TreeMap (balanced tree). The framework includes algorithms for sorting, searching, and other common operations. Generics ensure type safety by allowing collections to work with specific types. Understanding the collections framework is essential for efficient data management in Java applications.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateCollections();\n    }\n\n    static void demonstrateCollections() {\n        // List example\n        java.util.List<String> names = new java.util.ArrayList<>();\n        names.add(\"Alice\");\n        names.add(\"Bob\");\n        names.add(\"Charlie\");\n        System.out.println(\"List: \" + names);\n        \n        // Set example (unique elements)\n        java.util.Set<Integer> numbers = new java.util.HashSet<>();\n        numbers.add(1);\n        numbers.add(2);\n        numbers.add(1);  // Duplicate ignored\n        System.out.println(\"Set: \" + numbers);\n        \n        // Map example (key-value pairs)\n        java.util.Map<String, Integer> ageMap = new java.util.HashMap<>();\n        ageMap.put(\"Alice\", 25);\n        ageMap.put(\"Bob\", 30);\n        System.out.println(\"Alice age: \" + ageMap.get(\"Alice\"));\n        \n        // Sorting with Collections utility\n        java.util.Collections.sort(names);\n        System.out.println(\"Sorted list: \" + names);\n        \n        // Iterating with enhanced for loop\n        System.out.println(\"Names:\");\n        for (String name : names) {\n            System.out.println(\"- \" + name);\n        }\n    }\n}'),
(16, 15, 'File Handling in Java', 'File handling in Java is accomplished through I/O streams from the java.io package. The File class represents file system paths, while FileReader/FileWriter handle text files and FileInputStream/FileOutputStream handle binary files. Buffered wrappers (BufferedReader/BufferedWriter) improve performance. Java NIO (New I/O) provides more advanced file operations through the Files and Paths classes. Proper file handling includes checking file existence, handling permissions, managing resources with try-with-resources, and proper exception handling. Understanding file I/O is essential for data persistence, configuration management, and log file processing.', 'class Main {\n    public static void main(String[] args) {\n        readAndWriteFile();\n        demonstrateNIO();\n    }\n\n    static void readAndWriteFile() {\n        // Using try-with-resources to automatically close resources\n        try (java.io.BufferedReader reader = new java.io.BufferedReader(\n               new java.io.FileReader(\"input.txt\"));\n             java.io.BufferedWriter writer = new java.io.BufferedWriter(\n               new java.io.FileWriter(\"output.txt\"))) {\n            \n            System.out.println(\"Reading input.txt and writing to output.txt\");\n            String line;\n            while ((line = reader.readLine()) != null) {\n                // Process each line (example: convert to uppercase)\n                String processedLine = line.toUpperCase();\n                writer.write(processedLine);\n                writer.newLine();\n            }\n            \n            System.out.println(\"File processing complete\");\n        } catch (java.io.FileNotFoundException e) {\n            System.err.println(\"Error: Input file not found\");\n        } catch (java.io.IOException e) {\n            System.err.println(\"Error processing file: \" + e.getMessage());\n        }\n    }\n    \n    static void demonstrateNIO() {\n        try {\n            // Using Java NIO for simpler file operations\n            java.nio.file.Path path = java.nio.file.Paths.get(\"input.txt\");\n            byte[] bytes = java.nio.file.Files.readAllBytes(path);\n            String content = new String(bytes);\n            System.out.println(\"File content: \" + content);\n        } catch (java.io.IOException e) {\n            System.err.println(\"NIO Error: \" + e.getMessage());\n        }\n    }\n}'),
(17, 15, 'Database Connectivity with JDBC', 'JDBC (Java Database Connectivity) is an API for connecting Java applications to relational databases. It provides methods to query and update data using standard SQL. The basic steps include: loading the JDBC driver, establishing a connection, creating statements, executing queries, processing results, and closing resources. PreparedStatement prevents SQL injection by separating SQL structure from parameters. Connection pooling improves performance in production environments. Transactions ensure data integrity through commit and rollback operations. JDBC supports metadata access for database schema information. Understanding JDBC is fundamental for building data-driven applications in Java.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateDatabaseOperations();\n    }\n\n    static void demonstrateDatabaseOperations() {\n        // Database connection parameters\n        String url = \"jdbc:mysql://localhost:3306/mydatabase\";\n        String username = \"user\";\n        String password = \"password\";\n        \n        // Using try-with-resources for automatic resource management\n        try (java.sql.Connection connection = \n               java.sql.DriverManager.getConnection(url, username, password)) {\n            \n            System.out.println(\"Connected to database\");\n            \n            // Create table if not exists\n            try (java.sql.Statement stmt = connection.createStatement()) {\n                stmt.executeUpdate(\"CREATE TABLE IF NOT EXISTS users (\" +\n                                  \"id INT PRIMARY KEY AUTO_INCREMENT, \" +\n                                  \"name VARCHAR(50) NOT NULL, \" +\n                                  \"email VARCHAR(100))\");\n            }\n            \n            // Insert data using PreparedStatement (prevents SQL injection)\n            String insertSQL = \"INSERT INTO users (name, email) VALUES (?, ?)\";\n            try (java.sql.PreparedStatement pstmt = \n                   connection.prepareStatement(insertSQL)) {\n                pstmt.setString(1, \"Alice\");\n                pstmt.setString(2, \"alice@example.com\");\n                pstmt.executeUpdate();\n                \n                pstmt.setString(1, \"Bob\");\n                pstmt.setString(2, \"bob@example.com\");\n                pstmt.executeUpdate();\n            }\n            \n            // Query data\n            try (java.sql.Statement stmt = connection.createStatement();\n                 java.sql.ResultSet rs = \n                   stmt.executeQuery(\"SELECT id, name, email FROM users\")) {\n                \n                System.out.println(\"Users in database:\");\n                while (rs.next()) {\n                    int id = rs.getInt(\"id\");\n                    String name = rs.getString(\"name\");\n                    String email = rs.getString(\"email\");\n                    System.out.printf(\"%d: %s <%s>%n\", id, name, email);\n                }\n            }\n            \n        } catch (java.sql.SQLException e) {\n            System.err.println(\"Database error: \" + e.getMessage());\n        }\n    }\n}'),
(18, 16, 'Your First Java Program', 'The traditional \"Hello World\" program is the starting point for learning Java. It demonstrates the basic structure of a Java application: a class definition containing a main method, which is the entry point for program execution. The System.out.println() method outputs text to the console. This simple program introduces key concepts like class declaration, method definition, and statement termination. Understanding this basic structure is essential before moving to more complex programs. Beginners should practice creating, compiling, and running this program to become familiar with the Java development cycle.', 'class Main {\n    public static void main(String[] args) {\n        // The main method is where program execution begins\n        // This statement prints text to the console\n        System.out.println(\"Hello, World!\");\n        \n        // Additional simple output\n        System.out.println(\"Welcome to Java programming!\");\n        System.out.println(\"This is my first Java program.\");\n        \n        // Demonstrating basic arithmetic\n        int x = 5;\n        int y = 7;\n        System.out.println(\"The sum of \" + x + \" and \" + y + \" is \" + (x + y));\n    }\n}'),
(19, 16, 'Understanding Main Method', 'The main method is the entry point for Java applications and must be declared as public static void with a String array parameter. The public modifier makes it accessible, static allows invocation without creating an instance, void indicates no return value, and String[] args receives command-line arguments. The JVM calls this method to start program execution. Understanding the main method\'s structure and purpose is fundamental for Java beginners. Command-line arguments can be accessed through the args array, allowing user input when launching the program. The main method typically creates objects and coordinates program flow.', 'class Main {\n    // Standard main method signature\n    public static void main(String[] args) {\n        System.out.println(\"Program started with \" + args.length + \" arguments\");\n        \n        // Display command-line arguments\n        if (args.length > 0) {\n            System.out.println(\"Arguments received:\");\n            for (int i = 0; i < args.length; i++) {\n                System.out.println((i+1) + \": \" + args[i]);\n            }\n        } else {\n            System.out.println(\"No arguments provided\");\n        }\n        \n        // Demonstrate main method as program coordinator\n        initializeProgram();\n        processData();\n        cleanup();\n    }\n    \n    static void initializeProgram() {\n        System.out.println(\"Initializing program resources\");\n    }\n    \n    static void processData() {\n        System.out.println(\"Processing data\");\n    }\n    \n    static void cleanup() {\n        System.out.println(\"Cleaning up resources\");\n    }\n}'),
(23, 17, 'Date and Time API', 'Java 8 introduced a modern Date and Time API in the java.time package to address shortcomings of the old Date and Calendar classes. Key classes include LocalDate (date without time), LocalTime (time without date), LocalDateTime (date and time), ZonedDateTime (date and time with timezone), and Instant (machine-readable timestamp). The DateTimeFormatter class handles parsing and formatting. The API is immutable and thread-safe, with clear separation between human-readable and machine time representations. Duration and Period classes represent time amounts. Understanding this API is essential for any application dealing with dates and times.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateDateTime();\n    }\n\n    static void demonstrateDateTime() {\n        // Current date and time\n        java.time.LocalDate today = java.time.LocalDate.now();\n        java.time.LocalTime now = java.time.LocalTime.now();\n        System.out.println(\"Today: \" + today);\n        System.out.println(\"Now: \" + now);\n        \n        // Creating specific dates\n        java.time.LocalDate birthday = java.time.LocalDate.of(1990, 5, 15);\n        System.out.println(\"Birthday: \" + birthday);\n        \n        // Date arithmetic\n        java.time.LocalDate nextWeek = today.plusDays(7);\n        java.time.LocalDate nextMonth = today.plusMonths(1);\n        System.out.println(\"Next week: \" + nextWeek);\n        System.out.println(\"Next month: \" + nextMonth);\n        \n        // Date comparison\n        System.out.println(\"Is today after birthday? \" + today.isAfter(birthday));\n        \n        // Day of week\n        System.out.println(\"Day of week: \" + today.getDayOfWeek());\n        \n        // Formatting\n        java.time.format.DateTimeFormatter formatter = \n            java.time.format.DateTimeFormatter.ofPattern(\"dd/MM/yyyy\");\n        System.out.println(\"Formatted date: \" + today.format(formatter));\n        \n        // Parsing\n        String dateStr = \"25/12/2023\";\n        java.time.LocalDate christmas = \n            java.time.LocalDate.parse(dateStr, formatter);\n        System.out.println(\"Parsed date: \" + christmas);\n        \n        // Time zones\n        java.time.ZonedDateTime nowInTokyo = \n            java.time.ZonedDateTime.now(java.time.ZoneId.of(\"Asia/Tokyo\"));\n        System.out.println(\"Current time in Tokyo: \" + nowInTokyo);\n        \n        // Duration between times\n        java.time.LocalTime start = java.time.LocalTime.of(9, 0);\n        java.time.LocalTime end = java.time.LocalTime.of(17, 30);\n        java.time.Duration duration = java.time.Duration.between(start, end);\n        System.out.println(\"Work duration: \" + duration.toHours() + \" hours\");\n    }\n}'),
(24, 18, 'Multithreading in Java', 'Java provides built-in support for multithreaded programming through the Thread class and Runnable interface. Threads allow concurrent execution of code segments, enabling better CPU utilization and responsive applications. The Java Memory Model defines how threads interact through memory, with concepts like visibility and happens-before relationships. Synchronization mechanisms like synchronized blocks and volatile variables prevent race conditions. Java 5+ introduced higher-level concurrency utilities in java.util.concurrent package. Understanding thread lifecycle, priorities, and coordination techniques is essential for writing correct and efficient concurrent programs.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateThreads();\n    }\n\n    static class Counter {\n        private int count = 0;\n        \n        synchronized void increment() {\n            count++;\n        }\n        \n        int getCount() {\n            return count;\n        }\n    }\n\n    static void demonstrateThreads() {\n        Counter counter = new Counter();\n        \n        Runnable task = () -> {\n            for (int i = 0; i < 1000; i++) {\n                counter.increment();\n            }\n        };\n        \n        Thread thread1 = new Thread(task);\n        Thread thread2 = new Thread(task);\n        \n        thread1.start();\n        thread2.start();\n        \n        try {\n            thread1.join();\n            thread2.join();\n        } catch (InterruptedException e) {\n            Thread.currentThread().interrupt();\n        }\n        \n        System.out.println(\"Final count: \" + counter.getCount());\n    }\n}'),
(25, 18, 'Design Patterns in Java', 'Design patterns are proven solutions to common software design problems. In Java, patterns are implemented using language features like classes, interfaces, and inheritance. Creational patterns (Singleton, Factory, Builder) handle object creation. Structural patterns (Adapter, Decorator, Facade) deal with object composition. Behavioral patterns (Observer, Strategy, Command) manage object collaboration. Java APIs use many patterns internally (Iterator in Collections, Factory in JDBC). Understanding patterns improves code quality, promotes reusability, and facilitates communication among developers through shared vocabulary.', 'class Main {\n    public static void main(String[] args) {\n        demonstratePatterns();\n    }\n\n    // Singleton pattern implementation\n    static class DatabaseConnection {\n        private static DatabaseConnection instance;\n        \n        private DatabaseConnection() {}\n        \n        static synchronized DatabaseConnection getInstance() {\n            if (instance == null) {\n                instance = new DatabaseConnection();\n            }\n            return instance;\n        }\n        \n        void connect() {\n            System.out.println(\"Connected to database\");\n        }\n    }\n\n    // Factory pattern implementation\n    interface Shape {\n        void draw();\n    }\n    \n    static class Circle implements Shape {\n        public void draw() {\n            System.out.println(\"Drawing Circle\");\n        }\n    }\n    \n    static class ShapeFactory {\n        Shape getShape(String type) {\n            if (\"CIRCLE\".equalsIgnoreCase(type)) {\n                return new Circle();\n            }\n            throw new IllegalArgumentException(\"Unknown shape type\");\n        }\n    }\n\n    static void demonstratePatterns() {\n        // Singleton usage\n        DatabaseConnection conn = DatabaseConnection.getInstance();\n        conn.connect();\n        \n        // Factory usage\n        ShapeFactory factory = new ShapeFactory();\n        Shape shape = factory.getShape(\"CIRCLE\");\n        shape.draw();\n    }\n}'),
(26, 18, 'Java Reflection API', 'Reflection allows Java code to examine and modify runtime behavior of classes, interfaces, fields and methods. The Class class is the entry point for reflection, obtained via getClass() or Class.forName(). Reflection enables dynamic class loading, inspection of class members, method invocation, and field access. While powerful, reflection should be used judiciously due to performance overhead and security implications. Common uses include dependency injection frameworks, serialization libraries, and testing tools. Java 9+ introduced module system restrictions that limit reflection access to improve security.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateReflection();\n    }\n\n    static class SampleClass {\n        private String secret = \"hidden\";\n        \n        void display(String message) {\n            System.out.println(\"Message: \" + message);\n        }\n    }\n\n    static void demonstrateReflection() {\n        try {\n            // Get Class object\n            Class<?> clazz = Class.forName(\"Main$SampleClass\");\n            \n            // Create instance\n            Object instance = clazz.getDeclaredConstructor().newInstance();\n            \n            // Access private field\n            java.lang.reflect.Field field = clazz.getDeclaredField(\"secret\");\n            field.setAccessible(true);\n            System.out.println(\"Secret value: \" + field.get(instance));\n            \n            // Invoke method\n            java.lang.reflect.Method method = clazz.getMethod(\"display\", String.class);\n            method.invoke(instance, \"Hello via Reflection\");\n            \n        } catch (Exception e) {\n            System.err.println(\"Reflection error: \" + e.getMessage());\n        }\n    }\n}'),
(28, 19, 'Java Performance Tuning', 'Java performance optimization involves multiple aspects: JVM tuning, efficient algorithms, proper data structures, and coding best practices. Key techniques include minimizing object creation, using primitives when possible, proper sizing of collections, efficient I/O operations, and concurrent programming. Profiling tools (VisualVM, JProfiler) help identify bottlenecks. JVM flags control heap size, garbage collection, and just-in-time compilation. Microbenchmarking with JMH provides reliable performance measurements. Performance tuning requires balancing memory usage, CPU utilization, and responsiveness based on application requirements.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateOptimizations();\n    }\n\n    static void demonstrateOptimizations() {\n        // String concatenation optimization\n        long start = System.currentTimeMillis();\n        String result = \"\";\n        for (int i = 0; i < 10000; i++) {\n            result += i;  // Creates new String each time\n        }\n        long duration = System.currentTimeMillis() - start;\n        System.out.println(\"String concatenation time: \" + duration + \"ms\");\n        \n        // StringBuilder optimization\n        start = System.currentTimeMillis();\n        StringBuilder builder = new StringBuilder();\n        for (int i = 0; i < 10000; i++) {\n            builder.append(i);\n        }\n        duration = System.currentTimeMillis() - start;\n        System.out.println(\"StringBuilder time: \" + duration + \"ms\");\n        \n        // Collection sizing optimization\n        java.util.List<Integer> numbers = new java.util.ArrayList<>(10000); // Pre-size\n        start = System.currentTimeMillis();\n        for (int i = 0; i < 10000; i++) {\n            numbers.add(i);\n        }\n        duration = System.currentTimeMillis() - start;\n        System.out.println(\"Presized ArrayList time: \" + duration + \"ms\");\n    }\n}'),
(29, 19, 'Java Security Best Practices', 'Java security encompasses multiple layers: language features (access modifiers), cryptography APIs, secure coding practices, and JVM security manager. Key practices include input validation, secure password handling (using char[]), preventing SQL injection (PreparedStatement), secure serialization, proper exception handling (no sensitive info leakage), and timely updates. The Java Security Manager (deprecated in Java 17) enforced sandboxing. Modern security focuses on libraries like BouncyCastle for cryptography, OAuth/OIDC for authentication, and HTTPS for transport security. Understanding security principles is crucial for developing robust applications.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateSecurity();\n    }\n\n    static void demonstrateSecurity() {\n        // Secure password handling\n        char[] password = readPassword();\n        try {\n            authenticate(password);\n        } finally {\n            // Clear sensitive data from memory\n            java.util.Arrays.fill(password, \'\\0\');\n        }\n        \n        // Secure random numbers\n        java.security.SecureRandom random = new java.security.SecureRandom();\n        byte[] token = new byte[32];\n        random.nextBytes(token);\n        System.out.println(\"Secure token: \" + java.util.Base64.getEncoder().encodeToString(token));\n    }\n    \n    static char[] readPassword() {\n        // In real apps, use Console.readPassword()\n        return \"secret\".toCharArray();\n    }\n    \n    static void authenticate(char[] password) {\n        // Authentication logic\n        System.out.println(\"Authenticating with password\");\n    }\n}'),
(30, 20, 'Project Requirements Analysis', 'Effective Java projects begin with thorough requirements analysis. This involves identifying stakeholders, defining functional requirements (features), non-functional requirements (performance, security), and constraints. Use cases and user stories help capture requirements from different perspectives. Requirements should be SMART (Specific, Measurable, Achievable, Relevant, Time-bound). Proper analysis prevents scope creep and ensures the project solves the right problems. Documentation tools like Javadoc and UML diagrams communicate requirements to developers. Agile methodologies emphasize iterative requirements refinement throughout the project lifecycle.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateRequirements();\n    }\n\n    static void demonstrateRequirements() {\n        // Example requirements for a library management system\n        String[] functionalRequirements = {\n            \"Users can search for books by title, author, or ISBN\",\n            \"Librarians can check books in and out\",\n            \"System sends overdue notices\",\n            \"Reports show popular books and user activity\"\n        };\n        \n        String[] nonFunctionalRequirements = {\n            \"System must handle 100 concurrent users\",\n            \"Response time under 2 seconds for searches\",\n            \"Data backup daily\",\n            \"Role-based access control\"\n        };\n        \n        System.out.println(\"Functional Requirements:\");\n        for (String req : functionalRequirements) {\n            System.out.println(\"- \" + req);\n        }\n        \n        System.out.println(\"\nNon-Functional Requirements:\");\n        for (String req : nonFunctionalRequirements) {\n            System.out.println(\"- \" + req);\n        }\n    }\n}'),
(31, 20, 'Project Implementation Strategy', 'A solid implementation strategy breaks the project into manageable components with clear dependencies. Common approaches include layered architecture (presentation, business, data), modular design (Java 9+ modules), and package-by-feature organization. Build tools (Maven, Gradle) manage dependencies and build process. Version control (Git) tracks changes. Continuous integration automates testing and deployment. Implementation should follow coding standards, include unit tests, and document public APIs. Regular code reviews maintain quality. Agile methodologies recommend iterative implementation with frequent integration and stakeholder feedback.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateStructure();\n    }\n\n    static void demonstrateStructure() {\n        // Example project structure documentation\n        String structure = \"\"\"\n        src/\n        ├── main/\n        │   ├── java/\n        │   │   ├── com.library/\n        │   │   │   ├── controllers/   # Web controllers\n        │   │   │   ├── services/      # Business logic\n        │   │   │   ├── repositories/  # Data access\n        │   │   │   ├── models/        # Domain objects\n        │   │   │   └── LibraryApp.java # Main class\n        │   └── resources/             # Config files\n        └── test/                      # Unit tests\n            └── java/\n                └── com.library/       # Mirror main structure\n        \"\"\";\n        \n        System.out.println(\"Recommended Project Structure:\");\n        System.out.println(structure);\n    }\n}'),
(32, 20, 'Project Testing and Review', 'Comprehensive testing ensures software quality and prevents regressions. Unit tests (JUnit) verify individual components. Integration tests check component interactions. Functional tests validate requirements. Test coverage tools (JaCoCo) measure code exercised by tests. Code reviews identify issues before merging. Static analysis tools (SpotBugs) detect potential bugs. Performance testing evaluates scalability. User acceptance testing confirms requirements are met. Continuous integration runs tests automatically. Effective testing requires designing testable code with dependency injection and clear interfaces. Documentation should explain how to run tests and interpret results.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateTesting();\n    }\n\n    static void demonstrateTesting() {\n        // Example test cases for a Book class\n        class Book {\n            String title;\n            String author;\n            \n            Book(String title, String author) {\n                this.title = title;\n                this.author = author;\n            }\n            \n            String getDisplayName() {\n                return title + \" by \" + author;\n            }\n        }\n        \n        // Simple unit test\n        Book book = new Book(\"Effective Java\", \"Joshua Bloch\");\n        String displayName = book.getDisplayName();\n        \n        System.out.println(\"Running tests...\");\n        System.out.println(\"Test 1: \" + (\"Effective Java by Joshua Bloch\".equals(displayName) ? \"PASS\" : \"FAIL\"));\n        System.out.println(\"Test 2: \" + (book.title != null ? \"PASS\" : \"FAIL\"));\n        System.out.println(\"Test 3: \" + (book.author != null ? \"PASS\" : \"FAIL\"));\n    }\n}'),
(33, 21, 'Clean Code Principles', 'Clean code is readable, maintainable, and efficient. Key principles include: meaningful names, small methods with single responsibility, minimal comments (self-documenting code), consistent formatting, and proper error handling. Avoid magic numbers, deep nesting, and code duplication. Follow SOLID principles: Single Responsibility, Open-Closed, Liskov Substitution, Interface Segregation, Dependency Inversion. Tools like Checkstyle enforce coding standards. Clean code reduces bugs, eases maintenance, and improves team productivity. Code reviews help spread clean code practices across the team.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateCleanCode();\n    }\n\n    // Good example of clean code\n    static class Circle {\n        private final double radius;\n        \n        Circle(double radius) {\n            this.radius = radius;\n        }\n        \n        double calculateArea() {\n            return Math.PI * radius * radius;\n        }\n        \n        double calculateCircumference() {\n            return 2 * Math.PI * radius;\n        }\n    }\n\n    // Poor example for comparison\n    static class BadCircle {\n        private double r;\n        \n        BadCircle(double r) { this.r = r; }\n        \n        double a() { return 3.14159 * r * r; } // Magic number, unclear method name\n    }\n\n    static void demonstrateCleanCode() {\n        Circle circle = new Circle(5.0);\n        System.out.printf(\"Area: %.2f, Circumference: %.2f%n\",\n                         circle.calculateArea(), circle.calculateCircumference());\n    }\n}'),
(34, 21, 'Effective Java Practices', 'Joshua Bloch\'s \"Effective Java\" outlines best practices for Java development. Key items include: favor composition over inheritance, use immutable objects where possible, prefer interfaces to abstract classes, use enums for constants, override equals/hashCode/toString consistently, use checked exceptions judiciously, avoid finalizers, use standard libraries, optimize judiciously. These practices result in robust, flexible, and maintainable code. The book covers Java features up to Java 9, with newer editions addressing later versions. Following these practices helps avoid common pitfalls and leverages Java\'s strengths effectively.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateBestPractices();\n    }\n\n    // Item 17: Minimize mutability\n    static final class ImmutablePoint {\n        private final double x;\n        private final double y;\n        \n        ImmutablePoint(double x, double y) {\n            this.x = x;\n            this.y = y;\n        }\n        \n        double x() { return x; }\n        double y() { return y; }\n        \n        ImmutablePoint translate(double dx, double dy) {\n            return new ImmutablePoint(x + dx, y + dy);\n        }\n    }\n\n    // Item 1: Use static factory methods\n    static class Complex {\n        private final double real;\n        private final double imaginary;\n        \n        private Complex(double real, double imaginary) {\n            this.real = real;\n            this.imaginary = imaginary;\n        }\n        \n        static Complex fromReal(double real) {\n            return new Complex(real, 0);\n        }\n        \n        static Complex fromImaginary(double imaginary) {\n            return new Complex(0, imaginary);\n        }\n    }\n\n    static void demonstrateBestPractices() {\n        ImmutablePoint point = new ImmutablePoint(1.0, 2.0);\n        ImmutablePoint moved = point.translate(3.0, 4.0);\n        System.out.printf(\"Moved from (%.1f,%.1f) to (%.1f,%.1f)%n\",\n                         point.x(), point.y(), moved.x(), moved.y());\n        \n        Complex realNumber = Complex.fromReal(5.0);\n        Complex imaginaryNumber = Complex.fromImaginary(3.0);\n    }\n}');
INSERT INTO `subtitles` (`id`, `section_id`, `subtitle`, `content`, `code_snippet`) VALUES
(35, 21, 'Code Documentation', 'Good documentation explains the \"why\" behind code, not just the \"what\". Javadoc comments describe classes, methods, and fields for API consumers. Use `@param`, `@return`, and `@throws` tags consistently. Package-level documentation explains overall architecture. Keep comments up-to-date with code changes. README files explain project setup and usage. Change logs track modifications. Documentation should be concise, accurate, and targeted to its audience (developers, users, or maintainers). Tools like Maven site plugin generate HTML documentation from Javadoc. Well-documented code is easier to understand, use, and maintain.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateDocumentation();\n    }\n\n    /**\n     * Calculates the factorial of a non-negative integer.\n     * \n     * @param n the number to calculate factorial for (must be >= 0)\n     * @return the factorial of n\n     * @throws IllegalArgumentException if n is negative\n     */\n    static long factorial(int n) {\n        if (n < 0) {\n            throw new IllegalArgumentException(\"n must be non-negative\");\n        }\n        long result = 1;\n        for (int i = 2; i <= n; i++) {\n            result *= i;\n        }\n        return result;\n    }\n\n    static void demonstrateDocumentation() {\n        System.out.println(\"Factorial of 5: \" + factorial(5));\n        try {\n            System.out.println(\"Factorial of -1: \" + factorial(-1));\n        } catch (IllegalArgumentException e) {\n            System.out.println(\"Correctly caught: \" + e.getMessage());\n        }\n    }\n}'),
(39, 23, 'Common Java Pitfalls', 'Java has several common pitfalls that can trap developers: using == instead of equals() for objects, mutable static fields causing thread-safety issues, memory leaks from unclosed resources or static collections, improper exception handling swallowing errors, floating-point precision issues, and integer overflow. Other traps include forgetting to override hashCode() when overriding equals(), using StringBuffer unnecessarily (instead of StringBuilder), and misunderstanding string immutability. Awareness of these pitfalls helps write more robust code. Static analysis tools can detect many of these issues automatically.', 'class Main {\n    public static void main(String[] args) {\n        demonstratePitfalls();\n    }\n\n    static void demonstratePitfalls() {\n        // Pitfall 1: String comparison with ==\n        String s1 = \"hello\";\n        String s2 = new String(\"hello\");\n        System.out.println(\"String equality with ==: \" + (s1 == s2)); // false\n        System.out.println(\"String equality with equals(): \" + s1.equals(s2)); // true\n        \n        // Pitfall 2: Mutable static field\n        class Counter {\n            static int count = 0;\n            void increment() { count++; }\n        }\n        \n        Counter c1 = new Counter();\n        Counter c2 = new Counter();\n        c1.increment();\n        System.out.println(\"Unexpected shared count: \" + c2.count); // 1\n        \n        // Pitfall 3: Integer overflow\n        int max = Integer.MAX_VALUE;\n        System.out.println(\"Integer overflow: \" + (max + 1)); // Wraps to negative\n        \n        // Pitfall 4: Floating point precision\n        System.out.println(\"Floating point math: \" + (0.1 + 0.2)); // Not exactly 0.3\n    }\n}'),
(40, 23, 'Debugging Techniques', 'Effective Java debugging involves multiple techniques: using IDE debuggers (breakpoints, stepping, watches), logging (SLF4J, java.util.logging), stack trace analysis, conditional execution, and assertions. Remote debugging connects to running applications. Memory analyzers (Eclipse MAT) diagnose leaks. Thread dumps identify concurrency issues. JVM tools (jstack, jmap, jstat) provide runtime insights. Unit tests can isolate bugs. Binary search helps locate code changes that introduced bugs. A systematic approach (reproduce, isolate, fix, verify) is more effective than random changes. Understanding the problem is key before attempting solutions.', 'class Main {\n    public static void main(String[] args) {\n        debugCode();\n    }\n\n    static void debugCode() {\n        // Example buggy code\n        int[] numbers = {1, 2, 3, 4, 5};\n        int sum = 0;\n        \n        System.out.println(\"Starting debugging session...\");\n        \n        // Using print statements (simple debugging)\n        System.out.println(\"Array length: \" + numbers.length);\n        for (int i = 0; i <= numbers.length; i++) { // Bug: should be < not <=\n            System.out.println(\"Processing index \" + i);\n            sum += numbers[i]; // Will throw ArrayIndexOutOfBoundsException\n        }\n        \n        // Better: use assertions\n        assert sum == 15 : \"Incorrect sum calculation\";\n        \n        System.out.println(\"Sum: \" + sum);\n    }\n}'),
(42, 24, 'Using Debugger Tools', 'Modern IDEs like IntelliJ IDEA and Eclipse provide powerful debuggers with features like: breakpoints (line, conditional, exception), stepping (into, over, out), variable inspection, expression evaluation, and multi-thread debugging. The debugger connects to the JVM through JPDA (Java Platform Debugger Architecture). Hot code replacement allows modifying code during debugging. Remote debugging connects to applications running elsewhere. Memory analyzers examine heap dumps. Profilers identify performance bottlenecks. Mastering debugger tools significantly reduces troubleshooting time and provides insights into program behavior.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateDebugging();\n    }\n\n    static void demonstrateDebugging() {\n        System.out.println(\"Starting debugger demonstration...\");\n        \n        // Set breakpoint on the next line in your IDE\n        int result = calculateFactorial(5);\n        System.out.println(\"Factorial of 5: \" + result);\n        \n        // Complex object for inspection\n        class Person {\n            String name;\n            int age;\n            \n            Person(String name, int age) {\n                this.name = name;\n                this.age = age;\n            }\n        }\n        \n        Person alice = new Person(\"Alice\", 30);\n        Person bob = new Person(\"Bob\", 25);\n        \n        // Conditional breakpoint can be set here (e.g., when age > 28)\n        System.out.println(\"Person 1: \" + alice.name);\n        System.out.println(\"Person 2: \" + bob.name);\n    }\n    \n    static int calculateFactorial(int n) {\n        if (n <= 1) return 1;\n        return n * calculateFactorial(n - 1); // Step into this recursive call\n    }\n}'),
(45, 25, 'Introduction to Java Libraries', 'Java libraries are pre-written code modules that help developers perform common tasks efficiently. This section introduces the most widely used Java libraries, such as Apache Commons and Google Guava, and explains their applications in real-world projects.', 'class Main {\n    public static void main(String[] args) {\n        useLibrary();\n    }\n\n    void useLibrary() { \n        // Example: Using Apache Commons StringUtils \n        String result = org.apache.commons.lang3.StringUtils.capitalize(\"hello\"); \n        System.out.println(result); \n    } \n}'),
(46, 25, 'Popular Java Tools and Their Uses', 'Java development is supported by a variety of tools that streamline the build, testing, and deployment processes. This section explores tools like Maven for dependency management, Gradle for build automation, and JUnit for unit testing.', 'class Main {\n    public static void main(String[] args) {\n        useMaven();\n    }\n\n    void useMaven() { \n        // Example: Maven build configuration \n        // pom.xml is used to define dependencies and build settings \n    } \n}'),
(47, 25, 'How to Choose the Right Library for Your Project', 'Selecting the right library for your Java project can significantly impact its success. This section provides guidelines for evaluating libraries based on factors like performance, community support, and compatibility with your project requirements.', 'class Main {\n    public static void main(String[] args) {\n        compareLibraries();\n    }\n\n    void compareLibraries() { \n        // Example: Comparing two libraries \n        int result1 = LibraryA.performTask(); \n        int result2 = LibraryB.performTask(); \n        System.out.println(\"LibraryA: \" + result1 + \", LibraryB: \" + result2); \n    } \n}'),
(48, 26, 'Installing Java Development Kit (JDK)', 'The Java Development Kit (JDK) is essential for developing and running Java applications. This section provides a step-by-step guide to installing the JDK on various operating systems, including Windows, macOS, and Linux.', 'class Main {\n    public static void main(String[] args) {\n        checkJDKVersion();\n    }\n\n    void checkJDKVersion() { \n        // Example: Checking JDK version \n        String version = System.getProperty(\"java.version\"); \n        System.out.println(\"JDK Version: \" + version); \n    } \n}'),
(49, 26, 'Configuring Your IDE for Java Development', 'An Integrated Development Environment (IDE) like IntelliJ IDEA or Eclipse can greatly enhance your productivity. This section explains how to configure these IDEs for Java development, including setting up project structures and enabling useful plugins.', 'class Main {\n    public static void main(String[] args) {\n        setupIntelliJ();\n    }\n\n    void setupIntelliJ() { \n        // Example: IDE configuration \n        // Configure project SDK and enable plugins \n    } \n}'),
(50, 26, 'Setting Up Environment Variables for Java', 'Environment variables like PATH and JAVA_HOME are crucial for running Java applications from the command line. This section teaches you how to set these variables on different operating systems to ensure smooth Java development.', 'class Main {\n    public static void main(String[] args) {\n        setEnvironmentVariables();\n    }\n\n    void setEnvironmentVariables() { \n        // Example: Setting environment variables \n        // export JAVA_HOME=/usr/lib/jvm/java-11-openjdk \n        // export PATH=$PATH:$JAVA_HOME/bin \n    } \n}'),
(51, 27, 'Principles of Clean Code in Java', 'Clean code is easy to read, understand, and maintain. This section introduces the SOLID principles (Single Responsibility, Open/Closed, Liskov Substitution, Interface Segregation, and Dependency Inversion) and explains how they apply to Java development.', 'class Main {\n    public static void main(String[] args) {\n        applySOLID();\n    }\n\n    void applySOLID() { \n        // Example: Single Responsibility Principle \n        class User { \n            void save() { \n                // Save user to database \n            } \n        } \n    } \n}'),
(52, 27, 'Best Practices for Naming Conventions', 'Consistent naming conventions improve code readability and maintainability. This section covers Java naming conventions for classes, methods, variables, and constants, along with examples of good and bad practices.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateNaming();\n    }\n\n    void demonstrateNaming() { \n        // Example: Naming variables and methods \n        int userCount = 10; \n        void calculateTotalPrice() { \n            // Method logic \n        } \n    } \n}'),
(53, 28, 'Understanding Java Syntax Basics', 'Java syntax is the set of rules that define how Java programs are written and interpreted. This section covers the fundamental syntax rules, including how to write classes, methods, and statements in Java.', 'class Main {\n    public static void main(String[] args) {\n        basicSyntax();\n    }\n\n    void basicSyntax() { \n        // Example: Basic Java syntax \n        System.out.println(\"Hello, World!\"); \n    } \n}'),
(54, 28, 'Exploring Java Data Types and Variables', 'Java supports both primitive and reference data types. This section explains the differences between these types, how to declare variables, and how to use them effectively in your programs.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateDataTypes();\n    }\n\n    void demonstrateDataTypes() { \n        // Example: Declaring variables \n        int number = 10; \n        String text = \"Java\"; \n        System.out.println(\"Number: \" + number + \", Text: \" + text); \n    } \n}'),
(55, 28, 'Control Flow Statements in Java', 'Control flow statements allow you to dictate the order in which your code is executed. This section covers if-else statements, loops (for, while, do-while), and switch statements, with examples of their usage.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateControlFlow();\n    }\n\n    void demonstrateControlFlow() { \n        // Example: Using a for loop \n        for (int i = 0; i < 5; i++) { \n            System.out.println(\"Iteration: \" + i); \n        } \n    } \n}'),
(56, 29, 'Introduction to Exception Handling', 'Exception handling is a critical aspect of Java programming that allows you to manage runtime errors gracefully. This section introduces the concept of exceptions and how to use try-catch blocks to handle them.', 'class Main {\n    public static void main(String[] args) {\n        handleException();\n    }\n\n    void handleException() { \n        // Example: Try-catch block \n        try { \n            int result = 10 / 0; \n        } catch (ArithmeticException e) { \n            System.out.println(\"Error: \" + e.getMessage()); \n        } \n    } \n}'),
(57, 29, 'Try-Catch Blocks and Exception Types', 'Java provides a variety of built-in exception types to handle different kinds of errors. This section explains how to use try-catch blocks to handle multiple exceptions and ensure your program remains robust.', 'class Main {\n    public static void main(String[] args) {\n        handleMultipleExceptions();\n    }\n\n    void handleMultipleExceptions() { \n        // Example: Handling multiple exceptions \n        try { \n            int[] array = new int[5]; \n            array[10] = 50; \n        } catch (ArrayIndexOutOfBoundsException e) { \n            System.out.println(\"Array Error: \" + e.getMessage()); \n        } catch (Exception e) { \n            System.out.println(\"General Error: \" + e.getMessage()); \n        } \n    } \n}'),
(58, 29, 'Custom Exceptions in Java', 'Sometimes, built-in exceptions are not sufficient for your application’s needs. This section teaches you how to create and use custom exceptions to handle specific error scenarios in your Java programs.', 'class Main {\n    public static void main(String[] args) {\n        useCustomException();\n    }\n\n    void useCustomException() { \n        // Example: Defining a custom exception \n        class MyException extends Exception { \n            MyException(String message) { \n                super(message); \n            } \n        } \n        try { \n            throw new MyException(\"Custom Error\"); \n        } catch (MyException e) { \n            System.out.println(\"Caught: \" + e.getMessage()); \n        } \n    } \n}'),
(59, 30, 'Identifying Performance Bottlenecks', 'Performance bottlenecks can slow down your Java applications. This section explains how to identify these bottlenecks using profiling tools and techniques, ensuring your code runs efficiently.', 'class Main {\n    public static void main(String[] args) {\n        identifyBottlenecks();\n    }\n\n    void identifyBottlenecks() { \n        // Example: Profiling Java code \n        long startTime = System.currentTimeMillis(); \n        // Code to profile \n        long endTime = System.currentTimeMillis(); \n        System.out.println(\"Time taken: \" + (endTime - startTime) + \"ms\"); \n    } \n}'),
(60, 30, 'Memory Management in Java', 'Java’s garbage collection mechanism automatically manages memory, but understanding how it works can help you optimize your applications. This section covers memory management concepts, including heap and stack memory, and how to minimize memory leaks in your Java applications.', 'class Main {\n    public static void main(String[] args) {\n        manageMemory();\n    }\n\n    void manageMemory() { \n        // Example: Understanding memory allocation \n        String[] largeArray = new String[100000]; \n        // Simulate memory usage \n    } \n}'),
(61, 30, 'Using Caching to Improve Performance', 'Caching is a technique that can significantly enhance the performance of your Java applications by storing frequently accessed data in memory. This section discusses various caching strategies and libraries, such as Ehcache and Caffeine.', 'class Main {\n    public static void main(String[] args) {\n        useCaching();\n    }\n\n    void useCaching() { \n        // Example: Simple caching implementation \n        java.util.Map<String, String> cache = new java.util.HashMap<>(); \n        cache.put(\"key\", \"value\"); \n        System.out.println(\"Cached Value: \" + cache.get(\"key\")); \n    } \n}'),
(62, 31, 'Introduction to Java Collections', 'The Java Collections Framework provides a set of classes and interfaces for storing and manipulating groups of objects. This section introduces the core interfaces like List, Set, and Map, and their implementations.', 'class Main {\n    public static void main(String[] args) {\n        demonstrateCollections();\n    }\n\n    void demonstrateCollections() { \n        // Example: Using ArrayList \n        java.util.List<String> list = new java.util.ArrayList<>(); \n        list.add(\"Java\"); \n        list.add(\"Collections\"); \n        System.out.println(\"List: \" + list); \n    } \n}'),
(63, 31, 'Working with Lists in Java', 'Lists are ordered collections that allow duplicate elements. This section covers how to create, modify, and iterate over lists using ArrayList and LinkedList, along with their advantages and disadvantages.', 'class Main {\n    public static void main(String[] args) {\n        useArrayList();\n    }\n\n    void useArrayList() { \n        // Example: ArrayList operations \n        java.util.List<String> arrayList = new java.util.ArrayList<>(); \n        arrayList.add(\"Item1\"); \n        arrayList.add(\"Item2\"); \n        for (String item : arrayList) { \n            System.out.println(item); \n        } \n    } \n}'),
(64, 31, 'Understanding Sets and Their Applications', 'Sets are collections that do not allow duplicate elements. This section explains how to use HashSet and TreeSet, their performance characteristics, and when to choose one over the other.', 'class Main {\n    public static void main(String[] args) {\n        useHashSet();\n    }\n\n    void useHashSet() { \n        // Example: HashSet operations \n        java.util.Set<String> hashSet = new java.util.HashSet<>(); \n        hashSet.add(\"Element1\"); \n        hashSet.add(\"Element2\"); \n        System.out.println(\"Set: \" + hashSet); \n    } \n}'),
(65, 32, 'Introduction to Java Streams', 'Java Streams provide a powerful way to process sequences of elements. This section introduces the Stream API, its benefits, and how to use it for functional-style operations on collections.', 'class Main {\n    public static void main(String[] args) {\n        useStreams();\n    }\n\n    void useStreams() { \n        // Example: Stream operations \n        java.util.List<String> names = java.util.Arrays.asList(\"Alice\", \"Bob\", \"Charlie\"); \n        names.stream().filter(name -> name.startsWith(\"A\")).forEach(System.out::println); \n    } \n}'),
(66, 32, 'Functional Interfaces and Lambda Expressions', 'Functional interfaces are interfaces with a single abstract method, and they can be implemented using lambda expressions. This section explains how to create and use functional interfaces in Java.', 'class Main {\n    public static void main(String[] args) {\n        useLambda();\n    }\n\n    void useLambda() { \n        // Example: Lambda expression \n        Runnable runnable = () -> System.out.println(\"Running in a thread\"); \n        new Thread(runnable).start(); \n    } \n}'),
(67, 32, 'Collecting Results with Streams', 'The collect() method in the Stream API allows you to accumulate elements into collections. This section covers how to use collectors to transform and gather results from streams.', 'class Main {\n    public static void main(String[] args) {\n        collectResults();\n    }\n\n    void collectResults() { \n        // Example: Collecting results \n        java.util.List<String> names = java.util.Arrays.asList(\"Alice\", \"Bob\", \"Charlie\"); \n        java.util.List<String> filteredNames = names.stream().filter(name -> name.startsWith(\"A\")).collect(java.util.stream.Collectors.toList()); \n        System.out.println(\"Filtered Names: \" + filteredNames); \n    } \n}'),
(68, 33, 'Understanding Java Threads', 'Threads allow concurrent execution of code in Java, enabling better resource utilization. This section covers the basics of creating and managing threads, including the Thread class and Runnable interface.', 'class Main {\n    public static void main(String[] args) {\n        createThread();\n    }\n\n    void createThread() { \n        // Example: Creating a thread \n        Thread thread = new Thread(() -> System.out.println(\"Thread is running\")); \n        thread.start(); \n    } \n}'),
(69, 33, 'Synchronization in Java', 'Synchronization is crucial for preventing data inconsistency when multiple threads access shared resources. This section explains how to use synchronized methods and blocks to ensure thread safety.', 'class Main {\n    public static void main(String[] args) {\n        synchronizedMethod();\n    }\n\n    void synchronizedMethod() { \n        // Example: Synchronized block \n        synchronized(this) { \n            System.out.println(\"Synchronized block executed\"); \n        } \n    } \n}'),
(70, 33, 'Using Executors for Thread Management', 'The Executor framework simplifies thread management in Java by providing a pool of threads. This section discusses how to use Executors for executing tasks asynchronously and managing thread lifecycles.', 'class Main {\n    public static void main(String[] args) {\n        useExecutor();\n    }\n\n    void useExecutor() { \n        // Example: Using ExecutorService \n        java.util.concurrent.ExecutorService executor = java.util.concurrent.Executors.newFixedThreadPool(2); \n        executor.submit(() -> System.out.println(\"Task executed\")); \n        executor.shutdown(); \n    } \n}'),
(71, 34, 'Introduction to Java Networking', 'Java provides a rich set of APIs for networking, allowing applications to communicate over the internet. This section introduces the basics of networking in Java, including sockets and URLs.', 'class Main {\n    public static void main(String[] args) {\n        createSocket();\n    }\n\n    void createSocket() { \n        // Example: Creating a socket \n        try (java.net.Socket socket = new java.net.Socket(\"www.example.com\", 80)) { \n            System.out.println(\"Connected to server\"); \n        } catch (java.io.IOException e) { \n            e.printStackTrace(); \n        } \n    } \n}'),
(72, 34, 'Working with URLs and HTTP', 'Java makes it easy to work with URLs and perform HTTP requests. This section covers how to use the URL class to connect to web resources and retrieve data.', 'class Main {\n    public static void main(String[] args) {\n        fetchData();\n    }\n\n    void fetchData() { \n        // Example: Fetching data from a URL \n        try { \n            java.net.URL url = new java.net.URL(\"http://www.example.com\"); \n            java.io.BufferedReader in = new java.io.BufferedReader(new java.io.InputStreamReader(url.openStream())); \n            String inputLine; \n            while ((inputLine = in.readLine()) != null) { \n                System.out.println(inputLine); \n            } \n            in.close(); \n        } catch (java.io.IOException e) { \n            e.printStackTrace(); \n        } \n    } \n}'),
(73, 34, 'Creating a Simple Web Server', 'Java can be used to create simple web servers using the built-in HTTP server. This section demonstrates how to set up a basic web server to handle HTTP requests.', 'class Main {\n    public static void main(String[] args) {\n        startServer();\n    }\n\n    void startServer() { \n        // Example: Simple HTTP server \n        com.sun.net.httpserver.HttpServer server = com.sun.net.httpserver.HttpServer.create(new java.net.InetSocketAddress(8000), 0); \n        server.createContext(\"/test\", exchange -> { \n            String response = \"Hello, World!\"; \n            exchange.sendResponseHeaders(200, response.length()); \n            exchange.getResponseBody().write(response.getBytes()); \n            exchange.close(); \n        }); \n        server.start(); \n    } \n}'),
(74, 35, 'Understanding Java Security', 'Java provides a robust security framework that helps protect applications from various threats. This section introduces the key concepts of Java security, including the Java Security Manager and permissions.', 'class Main {\n    public static void main(String[] args) {\n        checkPermissions();\n    }\n\n    void checkPermissions() { \n        // Example: Checking permissions \n        SecurityManager sm = System.getSecurityManager(); \n        if (sm != null) { \n            sm.checkRead(\"somefile.txt\"); \n        } \n    } \n}'),
(75, 35, 'Implementing Secure Authentication', 'Authentication is a critical aspect of application security. This section discusses various authentication mechanisms in Java, including username/password authentication and token-based authentication.', 'class Main {\n    public static void main(String[] args) {\n        authenticateUser();\n    }\n\n    void authenticateUser() { \n        String username = \"admin\";\n        String password = \"password\";\n        // Example: Simple authentication \n        if (username.equals(\"admin\") && password.equals(\"password\")) { \n            System.out.println(\"Authenticated\"); \n        } else { \n            System.out.println(\"Authentication failed\"); \n        } \n    } \n}'),
(76, 35, 'Data Encryption Techniques', 'Data encryption is essential for protecting sensitive information. This section covers common encryption algorithms in Java, such as AES and RSA, and demonstrates how to encrypt and decrypt data.', 'class Main {\n    public static void main(String[] args) {\n        encryptData();\n    }\n\n    void encryptData() { \n        // Example: AES encryption \n        try {\n            javax.crypto.spec.SecretKeySpec key = new javax.crypto.spec.SecretKeySpec(\"1234567890123456\".getBytes(), \"AES\"); \n            javax.crypto.Cipher cipher = javax.crypto.Cipher.getInstance(\"AES\"); \n            cipher.init(javax.crypto.Cipher.ENCRYPT_MODE, key); \n            byte[] encrypted = cipher.doFinal(\"Hello\".getBytes()); \n            System.out.println(\"Encrypted Data: \" + java.util.Arrays.toString(encrypted)); \n        } catch (Exception e) {\n            e.printStackTrace();\n        }\n    } \n}'),
(77, 36, 'Writing Maintainable Code', 'Maintainable code is crucial for long-term project success. This section provides best practices for writing maintainable Java code, including code organization, documentation, and refactoring techniques.', 'class Main {\n    public static void main(String[] args) {\n        refactorCode();\n    }\n\n    void refactorCode() { \n        // Example: Refactoring for clarity \n        String result = calculateTotalPrice(); \n        System.out.println(\"Total Price: \" + result); \n    } \n    \n    String calculateTotalPrice() { \n        return \"100\"; \n    } \n}'),
(78, 36, 'Effective Unit Testing', 'Unit testing is vital for ensuring code quality. This section discusses best practices for writing effective unit tests in Java using JUnit, including test case design and mocking dependencies.', 'class Main {\n    public static void main(String[] args) {\n        testCalculateTotal();\n    }\n\n    void testCalculateTotal() { \n        // Example: Unit test \n        assert calculateTotal() == 100 : \"Test failed\"; \n    } \n    \n    int calculateTotal() { \n        return 100; \n    } \n}'),
(79, 36, 'Version Control with Git', 'Version control is essential for managing code changes. This section introduces Git, covering basic commands and workflows for tracking changes and collaborating with others.', 'class Main {\n    public static void main(String[] args) {\n        commitChanges();\n    }\n\n    void commitChanges() { \n        // Example: Git commit \n        System.out.println(\"git commit -m \\\"Initial commit\\\"\"); \n    } \n}'),
(80, 37, 'Introduction to Java GUI', 'Java provides several libraries for creating graphical user interfaces (GUIs). This section introduces Swing and JavaFX, explaining their features and how to create basic GUI applications.', 'class Main {\n    public static void main(String[] args) {\n        createFrame();\n    }\n\n    void createFrame() { \n        // Example: Creating a simple JFrame \n        javax.swing.JFrame frame = new javax.swing.JFrame(\"Hello GUI\"); \n        javax.swing.JButton button = new javax.swing.JButton(\"Click Me\"); \n        button.addActionListener(e -> System.out.println(\"Button Clicked\")); \n        frame.add(button); \n        frame.setSize(300, 200); \n        frame.setDefaultCloseOperation(javax.swing.JFrame.EXIT_ON_CLOSE); \n        frame.setVisible(true); \n    } \n}'),
(81, 37, 'Event Handling in Java GUI', 'Event handling is crucial for interactive applications. This section covers how to handle user events such as button clicks, mouse movements, and keyboard inputs in Java GUI applications.', 'class Main {\n    public static void main(String[] args) {\n        handleButtonClick();\n    }\n\n    void handleButtonClick() { \n        // Example: Handling button click \n        javax.swing.JButton button = new javax.swing.JButton(\"Submit\"); \n        button.addActionListener(e -> System.out.println(\"Submitted\")); \n    } \n}'),
(82, 37, 'Layout Managers in Java', 'Layout managers control the arrangement of components in a GUI. This section explains different layout managers like FlowLayout, BorderLayout, and GridLayout, and how to use them effectively.', 'class Main {\n    public static void main(String[] args) {\n        setLayout();\n    }\n\n    void setLayout() { \n        // Example: Using BorderLayout \n        javax.swing.JFrame frame = new javax.swing.JFrame(); \n        frame.setLayout(new java.awt.BorderLayout()); \n        frame.add(new javax.swing.JButton(\"North\"), java.awt.BorderLayout.NORTH); \n        frame.add(new javax.swing.JButton(\"South\"), java.awt.BorderLayout.SOUTH); \n        frame.setSize(400, 300); \n        frame.setVisible(true); \n    } \n}'),
(83, 38, 'Introduction to JDBC', 'Java Database Connectivity (JDBC) is an API for connecting and executing queries with databases. This section introduces JDBC concepts and how to set up a connection to a database.', 'class Main {\n    public static void main(String[] args) {\n        connectToDatabase();\n    }\n\n    void connectToDatabase() { \n        // Example: Connecting to a database \n        try { \n            java.sql.Connection connection = java.sql.DriverManager.getConnection(\"jdbc:mysql://localhost:3306/mydb\", \"user\", \"password\"); \n            System.out.println(\"Connected to database\"); \n        } catch (java.sql.SQLException e) { \n            e.printStackTrace(); \n        } \n    } \n}'),
(84, 38, 'Executing SQL Queries with JDBC', 'This section covers how to execute SQL queries using JDBC, including SELECT, INSERT, UPDATE, and DELETE operations, along with handling results.', 'class Main {\n    public static void main(String[] args) {\n        executeQuery();\n    }\n\n    void executeQuery() { \n        // Example: Executing a SQL query \n        try { \n            java.sql.Connection connection = java.sql.DriverManager.getConnection(\"jdbc:mysql://localhost:3306/mydb\", \"user\", \"password\");\n            java.sql.Statement statement = connection.createStatement(); \n            java.sql.ResultSet resultSet = statement.executeQuery(\"SELECT * FROM users\"); \n            while (resultSet.next()) { \n                System.out.println(\"User: \" + resultSet.getString(\"username\")); \n            } \n        } catch (java.sql.SQLException e) { \n            e.printStackTrace(); \n        } \n    } \n}'),
(86, 39, 'Introduction to Java Web Technologies', 'Java provides a robust platform for web development, including servlets, JSP, and frameworks like Spring. This section introduces these technologies and their roles in building web applications.', 'class Main {\n    public static void main(String[] args) {\n        setupServlet();\n    }\n\n    void setupServlet() { \n        // Example: Basic servlet setup \n        @javax.servlet.annotation.WebServlet(\"/hello\") \n        class HelloServlet extends javax.servlet.http.HttpServlet { \n            protected void doGet(javax.servlet.http.HttpServletRequest request, javax.servlet.http.HttpServletResponse response) throws javax.servlet.ServletException, java.io.IOException { \n                response.getWriter().println(\"Hello, World!\"); \n            } \n        } \n    } \n}'),
(87, 39, 'Building RESTful Services with Spring', 'Spring Framework simplifies the development of RESTful web services. This section covers how to create REST APIs using Spring Boot, including routing and handling requests.', 'class Main {\n    public static void main(String[] args) {\n        // Example REST controller would be auto-run by Spring Boot\n        System.out.println(\"Spring Boot application would run the REST controller\");\n    }\n\n    @org.springframework.web.bind.annotation.RestController \n    public class ApiController { \n        @org.springframework.web.bind.annotation.GetMapping(\"/api/greet\") \n        public String greet() { \n            return \"Hello from REST API\"; \n        } \n    } \n}'),
(88, 39, 'Handling Form Data in Java Web Applications', 'Handling form data is essential for web applications. This section explains how to process form submissions in Java web applications using servlets and Spring.', 'class Main {\n    public static void main(String[] args) {\n        // Example form handling would be auto-run by Spring Boot\n        System.out.println(\"Spring Boot application would handle the form submission\");\n    }\n\n    @org.springframework.web.bind.annotation.RestController \n    public class FormController { \n        @org.springframework.web.bind.annotation.PostMapping(\"/submit\") \n        public String handleForm(@org.springframework.web.bind.annotation.RequestParam String name) { \n            return \"Form submitted by: \" + name; \n        } \n    } \n}'),
(89, 40, 'Introduction to Java Testing', 'Testing is crucial for ensuring the reliability of Java applications. This section introduces various testing frameworks and methodologies, including unit testing and integration testing.', 'class Main {\n    public static void main(String[] args) {\n        runTests();\n    }\n\n    void runTests() { \n        // Example: Running a simple test \n        assert true : \"Test should pass\"; \n    } \n}'),
(90, 40, 'Debugging Techniques in Java', 'Debugging is an essential skill for developers. This section covers common debugging techniques in Java, including using IDE debuggers and logging.', 'class Main {\n    public static void main(String[] args) {\n        debugCode();\n    }\n\n    void debugCode() { \n        // Example: Using a logger \n        java.util.logging.Logger logger = java.util.logging.Logger.getLogger(Main.class.getName()); \n        logger.info(\"Debugging information\"); \n    } \n}'),
(91, 40, 'Test-Driven Development (TDD)', 'Test-Driven Development (TDD) is a software development approach that emphasizes writing tests before code. This section explains the TDD cycle and its benefits.', 'class Main {\n    public static void main(String[] args) {\n        tddCycle();\n    }\n\n    void tddCycle() { \n        // Example: TDD cycle \n        writeTest(); \n        writeCode(); \n        refactor(); \n    } \n    \n    void writeTest() { \n        // Test logic \n    } \n    \n    void writeCode() { \n        // Code logic \n    } \n    \n    void refactor() {\n        // Refactoring logic\n    }\n}');

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
(20, 'user_67c62fdc6f212', 'awe', 'John Ameh', 'johnameh107@gmail.com', '12345678', 'Learning Enthusiast | Comprehensive Learning Fan', '5465067c62fdc6f23e.jpeg', 'learner', 'Normal', 3800, 1, '[]', 'fb', 'tw', 'yt', NULL, 0, '2025-03-03 23:40:28'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `source_codes`
--
ALTER TABLE `source_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subtitles`
--
ALTER TABLE `subtitles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

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
