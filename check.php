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

// Fetch user data
$user_data = getUser();
$user_id = $user_data['id'];

// Verify payment with Paystack
$reference = $_GET['reference'];
$verified = $_GET['verified'];

if ($verified === 'verified') {
    // Update user badge to 'verified'
    $update_query = $conn->prepare("UPDATE users SET badge = 'verified' WHERE id = ?");
    $update_query->bind_param("i", $user_id);

    if ($update_query->execute()) {
        // echo "
        // <div class='fixed top-4 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg'>
        //     <div class='flex items-center justify-between'>
        //         <span class='font-semibold'>Payment successful! You are now verified.</span>
        //     </div>
        // </div>";

        // Redirect to courses page after 3 seconds
        header("Refresh: 0.5; url=./courses.php");
    } else {
        echo "Error updating user badge: " . $conn->error;
    }

    $update_query->close();
    $conn->close();
    exit;
}
