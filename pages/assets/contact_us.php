<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $message = $conn->real_escape_string($_POST["message"]);
    $timestamp = date("Y-m-d H:i:s"); // Get current timestamp

    if (empty($username)) {
        echo json_encode(['error' => 'Username is required.']);
        exit;
    }
    if (empty($email)) {
        echo json_encode(['error' => 'Email address is required.']);
        exit;
    }
    if (empty($message)) {
        echo json_encode(['error' => 'Message is required.']);
        exit;
    }

    // Insert query with timestamp
    $sql = "INSERT INTO contact (username, email, message, created_at) VALUES ('$username', '$email', '$message', '$timestamp')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode('Message sent successfully!');
    } else {
        echo json_encode(['error' => 'Error sending message: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Invalid request!']);
}

$conn->close();
