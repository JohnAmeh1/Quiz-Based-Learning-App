<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $user_id = 1; // Replace with logged-in user ID

    $sql = "INSERT INTO jobs (title, description, user_id) VALUES ('$title', '$description', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        echo "Job posted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
