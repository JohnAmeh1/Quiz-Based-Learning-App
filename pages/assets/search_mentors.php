<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the search term from the request
$searchTerm = isset($_GET['query']) ? $_GET['query'] : '';

$sql = "SELECT * FROM users WHERE username LIKE ?";
$stmt = $conn->prepare($sql);
$search = "%" . $searchTerm . "%";
$stmt->bind_param("s", $search);
// $stmt->bind_param("ss", $search, $search);
$stmt->execute();
$result = $stmt->get_result();

// Prepare the response
$mentors = [];
while ($row = $result->fetch_assoc()) {
  $mentors[] = $row;
}

$stmt->close();
$conn->close();

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($mentors);
