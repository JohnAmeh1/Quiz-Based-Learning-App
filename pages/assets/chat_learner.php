<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save a new message
    $sender = $_POST['sender'];
    $recipient = $_POST['recipient'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO messages (sender, recipient, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $sender, $recipient, $message);
    $stmt->execute();
    echo "Message sent";
    exit;
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['users'])) {
        // Fetch only mentors
        $stmt = $conn->prepare("SELECT username, account_type FROM users WHERE account_type = 'mentor'");
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        echo json_encode($users);
        exit;
    } else {
        // Fetch chat messages between users
        $sender = $_GET['sender'];
        $recipient = $_GET['recipient'];

        $stmt = $conn->prepare("SELECT * FROM messages WHERE (sender = ? AND recipient = ?) OR (sender = ? AND recipient = ?) ORDER BY timestamp ASC");
        $stmt->bind_param("ssss", $sender, $recipient, $recipient, $sender);
        $stmt->execute();
        $result = $stmt->get_result();

        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }

        echo json_encode($messages);
        exit;
    }
}

$conn->close();
