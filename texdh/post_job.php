<?php
include("./php/all_files.php");

$userId = $_SESSION['auth'];
$query = "SELECT * from users where user_id = '$userId' LIMIT 1";

$DB = new Database();
$result = $DB->read($query);
if ($result) {
    $user_data = $result[0];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

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
    $link = $_POST["link"];
    $user_id = $user_data["user_id"]; // Replace with logged-in user ID

    $sql = "INSERT INTO jobs (title, description, link, user_id) VALUES ('$title', '$description', '$link', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        echo "Job posted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
