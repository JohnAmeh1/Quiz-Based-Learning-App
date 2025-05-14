<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $userAnswers = json_decode(file_get_contents("php://input"), true);
//     $score = 0;

//     $conn = new mysqli("localhost", "root", "", "learning_app");

//     foreach ($userAnswers as $quizId => $answer) {
//         $stmt = $conn->prepare("SELECT correct_option FROM quizzes WHERE id = ?");
//         $stmt->bind_param("i", $quizId);
//         $stmt->execute();
//         $result = $stmt->get_result()->fetch_assoc();

//         if ($result['correct_option'] === $answer) {
//             $score++;
//         }
//     }

//     echo json_encode(["score" => $score]);
// }


header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "learning_app");

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$result = $conn->query("SELECT id, question, options FROM quizzes");
$quizzes = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $row['options'] = json_decode($row['options']); // Decode options JSON
        $quizzes[] = $row;
    }
}

echo json_encode($quizzes); // Return an empty array if no quizzes found
$conn->close();
?>