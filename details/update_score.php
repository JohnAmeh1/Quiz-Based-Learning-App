<?php
include("./assets/header_pages.php");
$conn = new mysqli("localhost", "root", "", "learning_app");

// Fetch user data
$user_data = getUser();
if (!$user_data || !isset($user_data['id'])) {
    die(json_encode(['success' => false, 'message' => 'User not logged in.']));
}

// Get points from POST data
$points = isset($_POST['points']) ? intval($_POST['points']) : 0;

// Update user score
$stmt = $conn->prepare("UPDATE users SET score = score + ? WHERE id = ?");
$stmt->bind_param("ii", $points, $user_data['id']);
$success = $stmt->execute();

if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update score']);
}
