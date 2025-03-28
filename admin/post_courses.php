<?php
include("./assets/header_admin.php");

$host = "localhost";
$user = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];
    $is_premium = isset($_POST['is_premium']) ? 1 : 0; // Check if the course is premium
    $course_image = "";

    if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_name = basename($_FILES['course_image']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['course_image']['tmp_name'], $target_file)) {
            $course_image = $target_file;
        } else {
            echo "Error uploading file.";
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO courses (name, description, image, is_premium) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $course_name, $course_description, $course_image, $is_premium);

    if ($stmt->execute()) {
        echo "
    <div id='successAlert' class='fixed top-4 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg'>
        <div class='flex items-center justify-between'>
            <span class='font-semibold'>Course added successfully</span>
            <button id='dismissAlert' class='ml-4 text-green-700'>
                <i class='fas fa-times'></i>
            </button>
        </div>
    </div>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


$courses = [];
$result = $conn->query("SELECT * FROM courses ORDER BY created_at DESC");
if ($result->num_rows > 0) {
    $courses = $result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();

?>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Admin - Add Courses
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-roboto">
    <div class="container mx-auto p-4">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-2/3 px-4 mb-4 lg:mb-0">
                <div class="bg-white shadow-md rounded-lg p-6">

                    <h1 class="text-2xl font-bold mb-4">
                        Add New Course
                    </h1>
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="course-title">
                                Course Title
                            </label>
                            <input name="course_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="course-title" placeholder="Enter course title" type="text" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="course-description">
                                Course Description
                            </label>
                            <textarea name="course_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="course-description" placeholder="Enter course description"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="course-image">
                                Course Image
                            </label>
                            <input name="course_image" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="course-image" type="file" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="course-premium">
                                Premium Course
                            </label>
                            <input name="is_premium" class="form-checkbox h-5 w-5 text-blue-600" id="course-premium" type="checkbox" />
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="w-full inline-block px-6 py-3 mt-4 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 transition-transform transform hover:scale-105 
                    focus:outline-none focus:ring-2 focus:ring-blue-400" type="submit">
                                Add Course
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="w-full lg:w-1/3 px-4">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4">Added Courses</h2>
                    <div class="space-y-4">
                        <?php foreach ($courses as $course): ?>
                            <a href="./post_contents.php">
                                <div class="flex items-center space-x-4">
                                    <img alt="Course Thumbnail" class="w-16 h-16 rounded" src="<?= htmlspecialchars($course['image'] ?: 'https://placehold.co/100x100') ?>" />
                                    <div>
                                        <h3 class="text-lg font-semibold"><?= htmlspecialchars($course['name']) ?></h3>
                                        <!-- <p class="text-gray-600"><?= htmlspecialchars($course['description']) ?></p> -->
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                        <?php if (empty($courses)): ?>
                            <p class="text-gray-700 bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg shadow-md font-semibold">
                                No courses added yet.
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


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