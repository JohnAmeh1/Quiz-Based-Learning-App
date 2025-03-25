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
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $code_template = $_FILES['code_template'];
    $thumbnail = $_FILES['thumbnail'];
    $screenshot1 = $_FILES['screenshot1'];
    $screenshot2 = $_FILES['screenshot2'];
    $screenshot3 = $_FILES['screenshot3'];

    // File upload handling
    $target_dir = "uploads/";

    // Upload code template
    $code_template_file = $target_dir . basename($code_template["name"]);
    move_uploaded_file($code_template["tmp_name"], $code_template_file);

    // Upload thumbnail
    $thumbnail_file = $target_dir . basename($thumbnail["name"]);
    move_uploaded_file($thumbnail["tmp_name"], $thumbnail_file);

    // Upload screenshots
    $screenshot1_file = !empty($screenshot1["name"]) ? $target_dir . basename($screenshot1["name"]) : null;
    $screenshot2_file = !empty($screenshot2["name"]) ? $target_dir . basename($screenshot2["name"]) : null;
    $screenshot3_file = !empty($screenshot3["name"]) ? $target_dir . basename($screenshot3["name"]) : null;

    if ($screenshot1_file) move_uploaded_file($screenshot1["tmp_name"], $screenshot1_file);
    if ($screenshot2_file) move_uploaded_file($screenshot2["tmp_name"], $screenshot2_file);
    if ($screenshot3_file) move_uploaded_file($screenshot3["tmp_name"], $screenshot3_file);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO code_templates (title, description, file_name, thumbnail, screenshot1, screenshot2, screenshot3) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $title, $description, $code_template["name"], $thumbnail["name"], $screenshot1["name"], $screenshot2["name"], $screenshot3["name"]);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['status' => 'success', 'message' => 'Template uploaded successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
$conn->close();
