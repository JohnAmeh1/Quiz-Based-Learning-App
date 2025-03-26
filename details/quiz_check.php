<?php
// session_start();
include("./php/all_files.php");
include("./assets/user_auth.php");

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Redirect if user is not authenticated
if (!$_SESSION['auth']) {
    header("location: ./index.php");
    die;
}

// Get payment details
$reference = $_GET['reference'];
$email = $_GET['email'];
$course_id = intval($_GET['course_id']);
$amount = floatval($_GET['amount']);
$user_data = getUser();
$user_id = $user_data['id'];

// Verify payment with Paystack (you should implement actual verification)
// For now, we'll assume payment is successful

// Record the payment in database
$insert_query = $conn->prepare("INSERT INTO quiz_payments (user_id, course_id, payment_reference, amount, payment_status) VALUES (?, ?, ?, ?, 'completed')");
$insert_query->bind_param("iisd", $user_id, $course_id, $reference, $amount);

if ($insert_query->execute()) {
    // Payment recorded successfully, redirect to quiz
    header("location: ./view_courses.php?course_id=$course_id");
} else {
    echo "Error recording payment: " . $conn->error;
}

$insert_query->close();
$conn->close();
