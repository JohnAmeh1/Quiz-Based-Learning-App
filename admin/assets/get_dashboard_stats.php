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
$totalUsersQuery = "SELECT COUNT(*) AS totalUsers FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$response['totalUsers'] = $totalUsersResult->fetch_assoc()['totalUsers'] ?? 0;

$newSignupsQuery = "SELECT COUNT(*) AS newSignups FROM users WHERE signup_date >= NOW() - INTERVAL 30 DAY";
$newSignupsResult = $conn->query($newSignupsQuery);
$response['newSignups'] = $newSignupsResult->fetch_assoc()['newSignups'] ?? 0;

// Total Feedback Received (Example, modify according to your logic)
$feedbackReceivedQuery = "SELECT COUNT(*) AS feedbackReceived FROM reviews";
$feedbackReceivedResult = $conn->query($feedbackReceivedQuery);
$response['feedbackReceived'] = $feedbackReceivedResult->fetch_assoc()['feedbackReceived'] ?? 0;

$weeklySignupsQuery = "SELECT COUNT(*) AS weeklySignups FROM users WHERE signup_date >= NOW() - INTERVAL 7 DAY";
$weeklySignupsResult = $conn->query($weeklySignupsQuery);
$response['weeklySignups'] = $weeklySignupsResult->fetch_assoc()['weeklySignups'] ?? 0;

$totalContact = "SELECT COUNT(*) AS contacts FROM contact";
$totalContactResult = $conn->query($totalContact);
$response['contacts'] = $totalContactResult->fetch_assoc()['contacts'] ?? 0;

// // Close the database connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
