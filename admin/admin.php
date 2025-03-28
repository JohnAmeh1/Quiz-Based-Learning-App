<?php
include("./assets/header_admin.php");

// Database Connection
$conn = new mysqli("localhost", "root", "", "learning_app");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle quiz upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['quizFile'])) {
        $fileTmpPath = $_FILES['quizFile']['tmp_name'];
        $fileName = $_FILES['quizFile']['name'];
        $fileType = $_FILES['quizFile']['type'];
        $course_id = $_POST['course_id'];

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
            foreach ($quizData as &$quiz) {
                $quiz['options'] = json_encode($quiz['options']);
            }
        }

        foreach ($quizData as $quiz) {
            $stmt = $conn->prepare("INSERT INTO quizzes (course_id, question, options, correct_option) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $course_id, $quiz['question'], $quiz['options'], $quiz['correct']);
            $stmt->execute();
        }

        echo "<div id='successAlert' class='fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg'>
                <span class='font-semibold'>Quiz added successfully</span>
                <button id='dismissAlert' class='ml-4 text-green-700'>
                    <i class='fas fa-times'></i>
                </button>
            </div>";
    }

    // Handle single quiz deletion
    if (isset($_POST['delete_quiz'])) {
        $quiz_id = intval($_POST['quiz_id']);
        $stmt = $conn->prepare("DELETE FROM quizzes WHERE id = ?");
        $stmt->bind_param("i", $quiz_id);
        if ($stmt->execute()) {
            echo "<div id='successAlert' class='fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg'>
                    <span class='font-semibold'>Quiz deleted successfully</span>
                    <button id='dismissAlert' class='ml-4 text-green-700'>
                        <i class='fas fa-times'></i>
                    </button>
                </div>";
        }
    }

    // Handle bulk quiz deletion
    if (isset($_POST['bulk_delete']) && isset($_POST['selected_quizzes'])) {
        $selected_quizzes = $_POST['selected_quizzes'];
        $placeholders = implode(',', array_fill(0, count($selected_quizzes), '?'));
        $types = str_repeat('i', count($selected_quizzes));

        $stmt = $conn->prepare("DELETE FROM quizzes WHERE id IN ($placeholders)");
        $stmt->bind_param($types, ...$selected_quizzes);
        if ($stmt->execute()) {
            echo "<div id='successAlert' class='fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg z-50 alert-container'>
            <div class='flex items-center'>
                <span class='font-semibold'>Deleted " . count($selected_quizzes) . " quiz questions</span>
                <button data-dismiss='alert' class='ml-4 text-green-700 hover:text-green-900'>
                    <i class='fas fa-times'></i>
                </button>
            </div>
        </div>";
        }
    }
}

// Get all courses with quizzes
$coursesWithQuizzes = $conn->query("
    SELECT c.id, c.name, COUNT(q.id) as quiz_count 
    FROM courses c
    LEFT JOIN quizzes q ON c.id = q.course_id
    GROUP BY c.id
    HAVING quiz_count > 0
    ORDER BY c.name
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
    <style>
        .rotate-90 {
            transform: rotate(90deg);
        }

        .transition-transform {
            transition: transform 0.2s ease-in-out;
        }

        @media (max-width: 640px) {
            .quiz-container {
                flex-direction: column;
                gap: 1rem;
            }

            .quiz-section {
                width: 100%;
            }

            .quiz-actions {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-4">
        <!-- Alert Section -->
        <div id="successAlert" class="hidden fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg z-50">
            <span class="font-semibold" id="alertMessage"></span>
            <button id="dismissAlerts" class="ml-4 text-green-700">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="quiz-container flex flex-col lg:flex-row gap-6">
            <!-- Left Side - Quiz Upload -->
            <div class="quiz-section lg:w-1/2 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Upload New Quiz</h2>
                <form enctype="multipart/form-data" method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Upload JSON / TXT / CSV File</label>
                        <input type="file" name="quizFile" accept=".json,.txt,.csv" class="border p-2 rounded-lg w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Select Course</label>
                        <select name="course_id" class="w-full border p-2 rounded-lg">
                            <?php
                            $result = $conn->query("SELECT * FROM courses ORDER BY name");
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

            <!-- Right Side - Quiz Management -->
            <div class="quiz-section lg:w-1/2 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Manage Existing Quizzes</h2>

                <?php if ($coursesWithQuizzes->num_rows > 0): ?>
                    <form method="post" id="bulkDeleteForm">
                        <div class="quiz-actions flex justify-between items-center mb-4">
                            <button type="button" id="selectAllBtn" class="text-blue-500 hover:text-blue-700 text-sm">
                                <i class="far fa-square mr-1"></i> Select All
                            </button>
                            <button type="submit" name="bulk_delete" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600"
                                onclick="return confirm('Are you sure you want to delete the selected questions?')">
                                <i class="fas fa-trash mr-1"></i> Delete Selected
                            </button>
                        </div>

                        <div class="space-y-4">
                            <?php while ($course = $coursesWithQuizzes->fetch_assoc()): ?>
                                <div class="border rounded-lg overflow-hidden">
                                    <button type="button" class="quiz-course-toggle w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-gray-100">
                                        <div class="flex items-center">
                                            <h3 class="font-semibold text-lg"><?= htmlspecialchars($course['name']) ?></h3>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded ml-2">
                                                <?= $course['quiz_count'] ?> questions
                                            </span>
                                        </div>
                                        <i class="fas fa-chevron-down transition-transform"></i>
                                    </button>

                                    <div class="quiz-list hidden p-4">
                                        <?php
                                        // Get quizzes for this course
                                        $quizzes = $conn->query("SELECT * FROM quizzes WHERE course_id = {$course['id']} ORDER BY id");
                                        ?>

                                        <div class="space-y-2">
                                            <?php while ($quiz = $quizzes->fetch_assoc()): ?>
                                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded">
                                                    <div class="flex items-center w-4/5">
                                                        <input type="checkbox" name="selected_quizzes[]" value="<?= $quiz['id'] ?>"
                                                            class="mr-3 h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                                        <div class="truncate">
                                                            <?= htmlspecialchars($quiz['question']) ?>
                                                        </div>
                                                    </div>
                                                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this quiz question?')" class="ml-2">
                                                        <input type="hidden" name="quiz_id" value="<?= $quiz['id'] ?>">
                                                        <input type="hidden" name="delete_quiz" value="1">
                                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-info-circle text-3xl mb-2"></i>
                        <p>No quizzes found for any courses</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Handle alerts
        function showAlert(message, isError = false) {
            const alert = document.getElementById('successAlert');
            const alertMessage = document.getElementById('alertMessage');

            alertMessage.textContent = message;
            alert.classList.remove('hidden');

            if (isError) {
                alert.classList.remove('bg-green-100', 'border-green-500', 'text-green-700');
                alert.classList.add('bg-red-100', 'border-red-500', 'text-red-700');
            } else {
                alert.classList.remove('bg-red-100', 'border-red-500', 'text-red-700');
                alert.classList.add('bg-green-100', 'border-green-500', 'text-green-700');
            }

            setTimeout(() => {
                alert.classList.add('hidden');
            }, 5000);
        }

        document.addEventListener('click', function(e) {
            if (e.target.closest('[data-dismiss="alert"]')) {
                e.target.closest('.alert-container').remove();
            }
        });

        // Dismiss alert manually
        document.getElementById('dismissAlert').addEventListener('click', function() {
            document.getElementById('successAlert').classList.add('hidden');
        });

        // Show any PHP-generated alerts
        <?php if (isset($_GET['success'])): ?>
            showAlert("<?= $_GET['success'] ?>");
        <?php elseif (isset($_GET['error'])): ?>
            showAlert("<?= $_GET['error'] ?>", true);
        <?php endif; ?>

        // Toggle quiz sections
        document.querySelectorAll('.quiz-course-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const quizList = button.nextElementSibling;
                const icon = button.querySelector('i');

                quizList.classList.toggle('hidden');
                icon.classList.toggle('rotate-90');
            });
        });

        // Select all checkboxes
        document.getElementById('selectAllBtn').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[name="selected_quizzes[]"]');
            const icon = this.querySelector('i');

            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

            checkboxes.forEach(checkbox => {
                checkbox.checked = !allChecked;
            });

            if (allChecked) {
                icon.classList.remove('fa-check-square');
                icon.classList.add('fa-square');
            } else {
                icon.classList.remove('fa-square');
                icon.classList.add('fa-check-square');
            }
        });
    </script>
</body>

</html>