<?php
include("./assets/header_1.php");

$host = "localhost";
$user = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($host, $user, $password, $dbname);

// $host = "localhost";
// $user = "root";
// $password = "";
// $dbname = "learning_app";

// $conn = new mysqli($host, $user, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $course_name = $_POST['course_name'];
//     $course_description = $_POST['course_description'];
//     $course_image = "";

//     if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] === UPLOAD_ERR_OK) {
//         $upload_dir = "uploads/";
//         if (!is_dir($upload_dir)) {
//             mkdir($upload_dir, 0777, true);
//         }
//         $file_name = basename($_FILES['course_image']['name']);
//         $target_file = $upload_dir . $file_name;

//         if (move_uploaded_file($_FILES['course_image']['tmp_name'], $target_file)) {
//             $course_image = $target_file;
//         } else {
//             echo "Error uploading file.";
//             exit;
//         }
//     }

//     $stmt = $conn->prepare("INSERT INTO courses (name, description, image) VALUES (?, ?, ?)");
//     $stmt->bind_param("sss", $course_name, $course_description, $course_image);

//     if ($stmt->execute()) {
//         echo "
//     <div id='successAlert' class='fixed top-4 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg'>
//         <div class='flex items-center justify-between'>
//             <span class='font-semibold'>Course added successfully</span>
//             <button id='dismissAlert' class='ml-4 text-green-700'>
//                 <i class='fas fa-times'></i>
//             </button>
//         </div>
//     </div>";
//     } else {
//         echo "Error: " . $stmt->error;
//     }

//     $stmt->close();
// }

$courses = [];
$result = $conn->query("SELECT * FROM courses ORDER BY created_at DESC");
if ($result->num_rows > 0) {
    $courses = $result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();

// Fetch Courses
// $courses = $conn->query("SELECT * FROM courses");


?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Courses Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Main Content -->
        <div class="container mx-auto flex flex-1 py-6">

            <!-- Main Dashboard -->
            <main class="flex-1 bg-white shadow-lg rounded-lg p-6 ml-6">
                <h2 class="text-2xl font-bold mb-4">Course Dashboard</h2>

                <?php if (isset($course)): ?>
                    <h1><?= htmlspecialchars($course['name']) ?></h1>
                    <p><?= htmlspecialchars($course['description']) ?></p>
                    <?php while ($content = $contents->fetch_assoc()): ?>
                        <h2><?= htmlspecialchars($content['title']) ?></h2>
                        <p><?= nl2br(htmlspecialchars($content['content'])) ?></p>
                    <?php endwhile; ?>
                    <a href="./course.php">Back to Courses</a>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php // while ($course = $courses->fetch_assoc()): 
                        foreach ($courses as $course):
                        ?>
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <?php
                                // Handle image path or fallback to placeholder
                                $imagePath = !empty($course['image']) ? './admin/' . $course['image'] : 'https://placehold.co/300x200';
                                ?>
                                <img alt="Course Thumbnail"
                                    class="w-full h-40 object-cover rounded mb-4"
                                    src="<?= htmlspecialchars($imagePath) ?>" />
                                <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($course['name']) ?></h3>
                                <p class="text-gray-700 mb-4"><?= htmlspecialchars($course['description']) ?></p>
                                <a href="./details/view_courses.php?course_id=<?= $course['id'] ?>"
                                    class="w-full inline-block text-center px-6 py-3 mt-1 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 
                    focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    Start Course
                                </a>
                            </div>
                        <?php //endwhile; 
                        endforeach; ?>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>
</body>

</html>