<?php
// Database connection (Update with your own credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Handle GET request (Fetch contacts)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // SQL Query to fetch contacts
    $sql = "SELECT name, message, created_at FROM contact ORDER BY created_at DESC"; // Fetch only required fields

    $result = $conn->query($sql);

    if (!$result) {
        echo json_encode(["error" => "Error fetching contacts: " . $conn->error]);
        exit;
    }

    $contacts = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Ensure all required fields are present
            $row['name'] = $row['name'] ?? 'Unknown'; // Default to 'Unknown' if name is missing
            $row['message'] = $row['message'] ?? ''; // Default to empty string if message is missing
            $row['created_at'] = $row['created_at'] ?? date('Y-m-d H:i:s'); // Default to current timestamp if missing
            $contacts[] = $row;
        }
    }

    // Return contacts in JSON format
    echo json_encode($contacts);
}

// Close the database connection
$conn->close();
