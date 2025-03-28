<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli("localhost", "root", "", "learning_app");
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Check if ID parameter exists
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['error' => 'Invalid contact ID']);
    exit;
}

$id = intval($_GET['id']);

// Prepare and execute query
$stmt = $conn->prepare("SELECT * FROM contact WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['error' => 'Contact message not found']);
} else {
    $contact = $result->fetch_assoc();
    echo json_encode([
        'subject' => $contact['subject'] ?? null,
        'username' => $contact['username'] ?? null,
        'email' => $contact['email'] ?? null,
        'message' => $contact['message'] ?? null,
        'created_at' => $contact['created_at'] ?? null
    ]);
}

$conn->close();
