<?php
// Database connection

// include("./php/all_files.php");

$userId = $_SESSION['auth'];
$query = "SELECT * from users where user_id = '$userId' LIMIT 1";

$DB = new Database();
$result = $DB->read($query);
if ($result){
    $user_data = $result[0];
}
$user_data = getUser();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user = $user_data['account_type'];


// Get top 2 users
$topUsersQuery = "SELECT username, score FROM users where account_type = '$user' ORDER BY score DESC LIMIT 3";
$topUsersResult = $conn->query($topUsersQuery);

// Get current user's position (replace 1 with your user's ID)
$user_id = $user_data["id"];
$currentUserId = $user_id; // Replace with the logged-in user's ID
$userPositionQuery = "
    SELECT username, score, FIND_IN_SET(score, (SELECT GROUP_CONCAT(score ORDER BY score DESC) FROM users)) AS position 
    FROM users 
    WHERE id = $currentUserId";
$currentUserResult = $conn->query($userPositionQuery);

$conn->close();
?>