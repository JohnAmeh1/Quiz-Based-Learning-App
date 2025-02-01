<?php

include("./php/all_files.php");
// include("./assets/header_pages.php");
$DB = new Database();

if (isset($_GET['reference']) && isset($_GET['username']) && isset($_GET['verified']) && isset($_GET['email'])) {
    $reference = $_GET['reference'];
    $username = $_GET['username'];
    $verified = $_GET['verified'];
    $email = $_GET['email'];

    $paidUser = $username;

    // Fetch all users with role 'marketing'
    $usersQuery = "SELECT * FROM users WHERE email = '$email'";
    $users = $DB->read($usersQuery);

    // Update the user's base plan
    $updateBasePlanQuery = "UPDATE users SET badge = 'verified' WHERE email = '$email'";
    $DB->save($updateBasePlanQuery);

    // Redirect to the game page
    header("Location: mentor.php");
    exit();

} else {
    echo "Invalid request.";
}
