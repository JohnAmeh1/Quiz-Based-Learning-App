<?php
// session_start();

include("./php/all_files.php");
include("./assets/user_auth.php");

// Check if user is logged in
if (!isset($_SESSION['auth'])) {
    die(json_encode(['success' => false, 'message' => 'User not authenticated']));
}

// Get course ID from POST data
$course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
if ($course_id === 0) {
    die(json_encode(['success' => false, 'message' => 'Invalid course ID']));
}

// Get user ID
$user_data = getUser();
if (!$user_data || !isset($user_data['id'])) {
    die(json_encode(['success' => false, 'message' => 'User data not found']));
}
$user_id = $user_data['id'];

try {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "learning_app");
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    // Delete the payment record
    $stmt = $conn->prepare("DELETE FROM quiz_payments WHERE user_id = ? AND course_id = ?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ii", $user_id, $course_id);

    if ($stmt->execute()) {
        $affected_rows = $stmt->affected_rows;
        if ($affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Payment record deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No payment record found to delete']);
        }
    } else {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    // Log the error for debugging
    error_log("Error in delete_quiz_payment.php: " . $e->getMessage());

    // Return a generic error message to the client
    echo json_encode(['success' => false, 'message' => 'An error occurred while processing your request']);
}
