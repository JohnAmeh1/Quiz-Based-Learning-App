<?php
// Database connection (Update with your own credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];

    // Prevent SQL Injection
    $user_id = mysqli_real_escape_string($conn, $user_id);

    // Check if user exists
    $checkQuery = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Delete the user
        $deleteQuery = "DELETE FROM users WHERE user_id = '$user_id'";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "User deleted successfully.";
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
    } else {
        echo "User not found.";
    }
}

mysqli_close($conn);

// Close the database connection
// $conn->close();
