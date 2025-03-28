<?php
include("./assets/header_admin.php");
$conn = new mysqli("localhost", "root", "", "learning_app");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = intval($_POST['course_id']);
    $is_premium = intval($_POST['is_premium']);

    $stmt = $conn->prepare("UPDATE courses SET is_premium = ? WHERE id = ?");
    $stmt->bind_param("ii", $is_premium, $course_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}
