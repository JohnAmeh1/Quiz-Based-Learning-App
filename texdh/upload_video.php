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

    $target_dir = "uploads/videos/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO videos (title, description, video_path, user_id) VALUES ('$title', '$description', '$target_file', '$user_id')";
        if ($conn->query($sql) === TRUE) {
            echo "Video uploaded successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading the video.";
    }
}
$conn->close();
