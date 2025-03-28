<?php
// Database connection details
$host = 'localhost';
$username = 'root'; // Change to your MySQL username
$password = ''; // Change to your MySQL password
$database = 'learning_app';

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
}

// Fetch data for dashboard stats
$response = [];

// Total users
$totalUsersQuery = "SELECT COUNT(*) AS totalUsers FROM users WHERE account_type != 'admin'";
$totalUsersResult = $conn->query($totalUsersQuery);
$response['totalUsers'] = $totalUsersResult->fetch_assoc()['totalUsers'] ?? 0;

// New signups (last 30 days)
$newSignupsQuery = "SELECT COUNT(*) AS newSignups FROM users WHERE signup_date >= NOW() - INTERVAL 30 DAY AND account_type != 'admin'";
$newSignupsResult = $conn->query($newSignupsQuery);
$response['newSignups'] = $newSignupsResult->fetch_assoc()['newSignups'] ?? 0;

// Weekly signups (last 7 days)
$weeklySignupsQuery = "SELECT COUNT(*) AS weeklySignups FROM users WHERE signup_date >= NOW() - INTERVAL 7 DAY AND account_type != 'admin'";
$weeklySignupsResult = $conn->query($weeklySignupsQuery);
$response['weeklySignups'] = $weeklySignupsResult->fetch_assoc()['weeklySignups'] ?? 0;

// Total feedback received
$feedbackReceivedQuery = "SELECT COUNT(*) AS feedbackReceived FROM reviews";
$feedbackReceivedResult = $conn->query($feedbackReceivedQuery);
$response['feedbackReceived'] = $feedbackReceivedResult->fetch_assoc()['feedbackReceived'] ?? 0;

// Total contacts
$totalContactQuery = "SELECT COUNT(*) AS contacts FROM contact";
$totalContactResult = $conn->query($totalContactQuery);
$response['contacts'] = $totalContactResult->fetch_assoc()['contacts'] ?? 0;

// Total courses
$totalCoursesQuery = "SELECT COUNT(*) AS totalCourses FROM courses";
$totalCoursesResult = $conn->query($totalCoursesQuery);
$response['totalCourses'] = $totalCoursesResult->fetch_assoc()['totalCourses'] ?? 0;

// Close the database connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
