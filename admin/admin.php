<?php
include("./assets/header_admin.php");

// Database Connection
$conn = new mysqli("localhost", "root", "", "learning_app");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['quizFile'])) {
    $fileTmpPath = $_FILES['quizFile']['tmp_name'];
    $fileName = $_FILES['quizFile']['name'];
    $fileType = $_FILES['quizFile']['type'];
    $course_id = $_POST['course_id']; // Get selected course

    // Allowed file types
    $allowedTypes = ['application/json', 'text/csv', 'text/plain'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "<div id='successAlert' class='fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg'>
                <span class='font-semibold'>Invalid file type. Please upload JSON, CSV, or TXT.</span>
                <button id='dismissAlert' class='ml-4 text-green-700'>
                    <i class='fas fa-times'></i>
                </button>
            </div>";
        exit();
    }

    $fileContent = file_get_contents($fileTmpPath);
    $quizData = [];

    if ($fileType === 'application/json') {
        $quizData = json_decode($fileContent, true);

        // Ensure options are always JSON-encoded
        foreach ($quizData as &$quiz) {
            $quiz['options'] = json_encode($quiz['options']);
        }
    }

    // Insert quizzes into the database
    foreach ($quizData as $quiz) {
        $stmt = $conn->prepare("INSERT INTO quizzes (course_id, question, options, correct_option) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $course_id, $quiz['question'], $quiz['options'], $quiz['correct']); // No extra json_encode()
        $stmt->execute();
    }


    echo "<div id='successAlert' class='fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg'>
            <span class='font-semibold'>Quiz added successfully</span>
            <button id='dismissAlert' class='ml-4 text-green-700'>
                <i class='fas fa-times'></i>
            </button>
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
            <form enctype="multipart/form-data" method="post">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Upload JSON / TXT / CSV File</label>
                    <input type="file" name="quizFile" accept=".json,.txt,.csv" class="border p-2 rounded-lg w-full" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Select Course</label>
                    <select name="course_id" class="w-full border p-2 rounded-lg">
                        <?php
                        $result = $conn->query("SELECT * FROM courses");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
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