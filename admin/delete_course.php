<?php
include("./assets/header_admin.php");
$conn = new mysqli("localhost", "root", "", "learning_app");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = intval($_POST['course_id']);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete from subtitles first (child table)
        $conn->query("DELETE FROM subtitles WHERE section_id IN (SELECT id FROM sections WHERE course_id = $course_id)");

        // Then delete from sections
        $conn->query("DELETE FROM sections WHERE course_id = $course_id");

        // Finally delete the course
        $conn->query("DELETE FROM courses WHERE id = $course_id");

        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}
