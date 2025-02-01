<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_SESSION['username'])) {
        echo "User not logged in.";
        exit();
    }

    $user_id = $_SESSION['username']['user_id'];
    $Id = $_SESSION['username']['id'];

    $sqlDeleteUser = "DELETE FROM users WHERE user_id = '$user_id'";
    $sqlDeletePost = "DELETE FROM user WHERE id = '$Id'";

    if ($conn->query($sqlDeleteUser) === TRUE) {
        session_destroy();
        echo "Account deleted successfully";
    } else {
        echo "Error deleting account: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>