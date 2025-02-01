<?php
include("./assets/header_admin.php");

// $host = "localhost";
// $user = "root";
// $password = "";
// $dbname = "learning_app";

// $conn = new mysqli($host, $user, $password, $dbname);

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $course_id = $_POST['course_id'];
//     $question = $_POST['question'];
//     $points = $_POST['points'];
//     $correct_option = $_POST['correct_option'];
//     $options = $_POST['options'];

//     // Insert Question
//     $stmt = $conn->prepare("INSERT INTO questions (course_id, question, points, correct_option) VALUES (?, ?, ?, ?)");
//     $stmt->bind_param("isii", $course_id, $question, $points, $correct_option);
//     $stmt->execute();
//     $question_id = $stmt->insert_id;

//     // Insert Options
//     foreach ($options as $option) {
//         $stmt = $conn->prepare("INSERT INTO options (question_id, option_text) VALUES (?, ?)");
//         $stmt->bind_param("is", $question_id, $option);
//         $stmt->execute();
//     }

//     echo "
//     <div id='successAlert' class='fixed top-4 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg'>
//         <div class='flex items-center justify-between'>
//             <span class='font-semibold'>Quiz added successfully</span>
//             <button id='dismissAlert' class='ml-4 text-green-700'>
//                 <i class='fas fa-times'></i>
//             </button>
//         </div>
//     </div>";
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['quizFile'])) {

    $question = $quiz['question'];
    $options = json_encode($quiz['options']);
    $correct = $quiz['correct'];

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
                // $stmt->bind_param("sss", $quiz['question'], json_encode($quiz['options']), $quiz['correct']);
                $stmt->bind_param("sss", $question, $options, $correct);
                $stmt->execute();
            }
            echo "
    <div id='successAlert' class='fixed top-4 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg'>
        <div class='flex items-center justify-between'>
            <span class='font-semibold'>Quiz added successfully</span>
            <button id='dismissAlert' class='ml-4 text-green-700'>
                <i class='fas fa-times'></i>
            </button>
        </div>
    </div>";
        }
        // For CSV: parse the CSV and handle similarly.
    } else {
        echo "Invalid file type. Please upload a JSON or CSV file.";
    }
} else {
    echo "<div id='successAlert' class='fixed top-4 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg'>
        <div class='flex items-center justify-between'>
            <span class='font-semibold'>No File Uploaded</span>
            <button id='dismissAlert' class='ml-4 text-green-700'>
                <i class='fas fa-times'></i>
            </button>
        </div>
    </div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-4">
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Create Quiz</h1>
            <form id="uploadForm" enctype="multipart/form-data" method="post">
                <div class="mb-4">
                    <label for="file_upload" class="block text-gray-700 font-medium mb-2">Upload a JSON / CSV File (.json, .csv)</label>
                    <input type="file" id="quizFile" name="quizFile" accept=".json,.csv" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="course_id" class="block text-gray-700 font-medium mb-2">Course</label>
                    <select name="course_id" id="course_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none
                     focus:ring-2 focus:ring-blue-500">
                        <?php
                        // $result = $conn->query("SELECT * FROM courses");
                        // while ($row = $result->fetch_assoc()) {
                        //     echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        // }
                        $result = $conn->query("SELECT * FROM courses");
                        if (!$result) {
                            die("Error in query: " . $conn->error); // Debugging: show query error
                        }

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                            }
                        } else {
                            echo "<option value=''>No courses available</option>";
                        }
                        ?>
                    </select>
                </div>
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="w-full inline-block px-6 py-3 mt-4 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 transition-transform transform hover:scale-105 
                    focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Add Quiz
                    </button>
                </div>
            </form>

        </div>
    </div>
    <script>
        // Set timeout to hide the alert after 5 seconds (5000ms)
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 5000);

        // Optional: Dismiss the alert manually when the button is clicked
        document.getElementById('dismissAlert').addEventListener('click', function() {
            document.getElementById('successAlert').style.display = 'none';
        });
    </script>
</body>

</html>