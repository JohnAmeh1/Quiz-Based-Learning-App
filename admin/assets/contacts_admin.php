<?php
// Database connection (Make sure to update with your own credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle POST request (Insert review)
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $rating = $conn->real_escape_string($_POST['rating']);
    $message = $conn->real_escape_string($_POST['message']);

    // SQL Query to insert review data into the database
    $sql = "INSERT INTO reviews (name, email, rating, message) VALUES ('$name', '$email', '$rating', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode("Review submitted successfully!");
    } else {
        echo json_encode(["error" => "Error: " . $sql . "<br>" . $conn->error]);
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Handle GET request (Fetch reviews)
    $sql = "SELECT * FROM contact ORDER BY RAND()"; // Make sure to have a `created_at` field in the table

    $result = $conn->query($sql);

    $reviews = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    }

    // Return reviews in JSON format
    echo json_encode($reviews);
}

// Close the database connection
$conn->close();
