<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($host, $user, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answers = $_POST['answers'];
    $course_id = $_POST['course_id'];
    $total_score = 0; // Initialize total score

    foreach ($answers as $question_id => $selected_option) {
        // Fetch correct option and points for the question
        $question_query = $conn->query("SELECT correct_option, points FROM questions WHERE id = $question_id");
        if ($question_query && $question_query->num_rows > 0) {
            $question = $question_query->fetch_assoc();

            // Check if the selected option matches the correct option
            if ((int)$selected_option === (int)$question['correct_option']) {
                $total_score += (int)$question['points']; // Add points if correct
            }
        } else {
            echo "Error fetching question ID: $question_id<br>";
        }
    }

    // Redirect to the results page with the total score
    header("Location: quiz_results.php?score=$total_score&course_id=$course_id");
    exit;
}
