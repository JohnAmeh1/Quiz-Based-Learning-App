<?php
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set("display_errors", 1);

$file = "calls.json";
$requests = json_decode(file_get_contents($file), true) ?? [];

// ✅ Handle Learner Calling Mentor
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data["recipient"]) && isset($data["room"]) && isset($data["status"])) {
        $requests[$data["recipient"]] = [
            "room" => $data["room"],
            "status" => $data["status"]
        ];
        file_put_contents($file, json_encode($requests, JSON_PRETTY_PRINT));
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["error" => "Invalid request"]);
    }
    exit;
}

// ✅ Check for Incoming Calls
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["recipient"])) {
    $recipient = $_GET["recipient"];
    
    if (isset($requests[$recipient])) {
        echo json_encode($requests[$recipient]);
    } else {
        echo json_encode(["status" => "no_call"]);
    }
    exit;
}

echo json_encode(["error" => "Invalid request"]);
?>
