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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['quizFile'])) {
    $fileTmpPath = $_FILES['quizFile']['tmp_name'];
    $fileName = $_FILES['quizFile']['name'];
    $fileType = $_FILES['quizFile']['type'];

    // Check file type (e.g., only JSON or CSV)
    $allowedTypes = ['application/json', 'text/csv'];
    if (in_array($fileType, $allowedTypes)) {
        $fileContent = file_get_contents($fileTmpPath);

        // Save to the database (example for JSON)
        if ($fileType === 'application/json') {
            $quizData = json_decode($fileContent, true); // Decode JSON to PHP array

            // Assume a 'quizzes' table exists
            $conn = new mysqli("localhost", "root", "", "learning_app");
            foreach ($quizData as $quiz) {
                $stmt = $conn->prepare("INSERT INTO quizzes (question, options, correct_option) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $quiz['question'], json_encode($quiz['options']), $quiz['correct']);
                $stmt->execute();
            }
            echo "Quiz uploaded successfully!";
        }
        // For CSV: parse the CSV and handle similarly.
    } else {
        echo "Invalid file type. Please upload a JSON or CSV file.";
    }
} else {
    echo "No file uploaded.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form id="uploadForm" enctype="multipart/form-data" method="post" >
        <label for="quizFile">Upload Quiz File:</label>
        <input type="file" id="quizFile" name="quizFile" accept=".json,.csv" required>
        <button type="submit">Upload</button>
    </form>
</body>

</html>