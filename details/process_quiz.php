<?php

include("./php/all_files.php");
include("./assets/user_auth.php");

header("Content-Type: application/json"); // Ensure JSON response

// Debugging settings
error_reporting(E_ALL);
ini_set('display_errors', 1); // Show errors for debugging
ini_set('log_errors', 1);
ini_set('error_log', 'error_log.txt'); // Log errors

// Database connection
$conn = new mysqli("localhost", "root", "", "learning_app");
if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Get user data
$user_data = getUser();
if (!$user_data || !isset($user_data['id'])) {
    echo json_encode(["error" => "User not logged in."]);
    $conn->close();
    exit;
}

$user_id = intval($user_data['id']); // Ensure user_id is an integer
$course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0; // Get course ID from the form

if ($course_id <= 0) {
    echo json_encode(["error" => "Invalid course ID."]);
    $conn->close();
    exit;
}

// Initialize variables
$score = 0;
$total = 0;
$game_points = 0;

// Check if $_POST is empty
if (empty($_POST)) {
    echo json_encode(["error" => "No quiz answers submitted."]);
    $conn->close();
    exit;
}

// Process quiz answers
foreach ($_POST as $key => $value) {
    if (strpos($key, "quiz_") === 0) {
        $quiz_id = intval(str_replace("quiz_", "", $key)); // Extract quiz ID

        // Fetch correct answer from the database
        $stmt = $conn->prepare("SELECT correct_option FROM quizzes WHERE id = ?");
        if (!$stmt) {
            echo json_encode(["error" => "Database query failed: " . $conn->error]);
            $conn->close();
            exit;
        }

        $stmt->bind_param("i", $quiz_id);
        $stmt->execute();
        $stmt->bind_result($correct_option);
        $stmt->fetch();
        $stmt->close();

        if ($correct_option !== null && trim(strtolower($value)) === trim(strtolower($correct_option))) {
            $score++; // Increment score for correct answers
            $game_points += 50; // Add points for correct answers
        }

        $total++; // Increment total questions
    }
}

// Update user's score (increment game points) only for the current user
$updateStmt = $conn->prepare("UPDATE users SET score = score + ? WHERE id = ?");
if (!$updateStmt) {
    echo json_encode(["error" => "Failed to update user score: " . $conn->error]);
    $conn->close();
    exit;
}

$updateStmt->bind_param("ii", $game_points, $user_id);
$updateStmt->execute();
$updateStmt->close();

// Check if the user has scored at least 950 game points
if ($game_points >= 950) {
    // Fetch the course name
    $courseQuery = $conn->prepare("SELECT name FROM courses WHERE id = ?");
    if (!$courseQuery) {
        echo json_encode(["error" => "Failed to fetch course details: " . $conn->error]);
        $conn->close();
        exit;
    }

    $courseQuery->bind_param("i", $course_id);
    $courseQuery->execute();
    $courseQuery->bind_result($course_name);
    $courseQuery->fetch();
    $courseQuery->close();

    // Mark the course as completed for the user
    $insertStmt = $conn->prepare("INSERT INTO user_completed_courses (user_id, course_id, name) VALUES (?, ?, ?)");
    if (!$insertStmt) {
        echo json_encode(["error" => "Failed to mark course as completed: " . $conn->error]);
        $conn->close();
        exit;
    }

    $insertStmt->bind_param("iis", $user_id, $course_id, $course_name);
    $insertStmt->execute();
    $insertStmt->close();

    // Redirect to certificates.php
    echo json_encode([
        "redirect" => "../certificates.php?course_id=" . $course_id,
        "score" => $score,
        "total" => $total,
        "game_points" => $game_points
    ]);
    $conn->close();
    exit;
}

// Close database connection
$conn->close();

// Return JSON response
echo json_encode([
    "score" => $score,
    "total" => $total,
    "game_points" => $game_points
]);

exit(); // Prevent extra output