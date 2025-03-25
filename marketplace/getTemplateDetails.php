<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

$templateId = $_GET['id'];

$sql = "SELECT * FROM code_templates WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $templateId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $template = $result->fetch_assoc();
    echo json_encode($template);
} else {
    echo json_encode(['error' => 'Template not found']);
}

$stmt->close();
$conn->close();
