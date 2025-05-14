<?php
$data = json_decode(file_get_contents("php://input"), true);
$room = $data['room'];

file_put_contents("calls.json", json_encode(["room" => $room, "status" => "accepted"]));

echo json_encode(["status" => "success"]);
?>
