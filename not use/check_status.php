<?php
$room = $_GET['room'];
$data = json_decode(file_get_contents("calls.json"), true);

if ($data['room'] === $room && $data['status'] === "accepted") {
    echo json_encode(["status" => "accepted"]);
} else {
    echo json_encode(["status" => "pending"]);
}
?>
