<?php
// include("./php/all_files.php");
// include("./assets/user_auth.php");
// $user_data = getUser();

// $user_id = $user_data['id'];
// // Database connection (Replace these credentials with your actual database details)
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "learning_app";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Fetch user details
// $sql = "SELECT name FROM users WHERE id = $user_id"; // Assuming table name is 'users'
// $result = $conn->query($sql);
// $user_name = $user_data['username']; // Default value if no result
// $name = $user_data['name']; // Default value if no result

// if ($result->num_rows > 0) {
//     // Fetching the name
//     $row = $result->fetch_assoc();
//     $user_name = $row['name'];
// }

// $conn->close();

include("./php/all_files.php");
include("./assets/user_auth.php");

$user_data = getUser();
if (!$user_data || !isset($user_data['id'])) {
    die("User not logged in.");
}

$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

if ($course_id === 0) {
    die("Invalid course ID.");
}

// Fetch course details
$conn = new mysqli("localhost", "root", "", "learning_app");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$name = $user_data['name'];

$course_query = $conn->query("SELECT * FROM courses WHERE id = $course_id");
$course = $course_query->fetch_assoc();
if (!$course) {
    die("Course not found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet"> <!-- Cursive Font -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet"> <!-- Serif Font -->
    <link rel="icon" href="./img/brain.jpg">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        .certificate-border {
            border: 15px solid transparent;
            border-image: linear-gradient(45deg, #1e3a8a, #3b82f6);
            border-image-slice: 1;
        }

        .watermark {
            position: absolute;
            opacity: 0.1;
            font-size: 120px;
            font-weight: 700;
            transform: rotate(-45deg);
            color: #1e3a8a;
            pointer-events: none;
        }

        .watermarks {
            position: absolute;
            opacity: 0.1;
            font-size: 120px;
            font-weight: 700;
            transform: rotate(-45deg);
            color: #1e3a8a;
            pointer-events: none;
        }
    </style>
</head>

<body class="bg-gray-50 p-4">

    <div class="min-h-screen flex justify-center items-center px-4 sm:px-6 lg:px-8">
        <div id="certificate" class="bg-white certificate-border shadow-2xl rounded-lg w-full max-w-7xl px-10 py-12 relative">
            <!-- Watermark -->
            <div class="watermark absolute inset-0 flex items-center justify-center">
                <img src="./img/award-ribbon_24908-54794.avif" alt="" width="630px" height="630px">
            </div>
            <div class="watermarks absolute inset-0 flex items-center justify-center">
                CERTIFIED
            </div>

            <!-- Certificate Header -->
            <div class="text-center mb-8">
                <div class="flex items-center justify-center">
                    <span class="flex items-center mx-auto py-3 px-6 rounded-full shadow-lg bg-gradient-to-r from-blue-600 to-blue-800">
                        <!-- Logo Section -->
                        <img
                            alt="EduQuest Logo"
                            class="w-14 h-14 rounded-full border-2 border-white shadow-sm"
                            src="./img/brain.jpg" />
                        <!-- Brand Name -->
                        <span class="ml-4 text-2xl font-bold text-white">
                            EduQuest
                        </span>
                    </span>
                </div>

                <h1 class="text-5xl sm:text-6xl font-bold text-blue-900 mt-6 mb-4">Certificate of Completion</h1>
                <p class="text-xl sm:text-2xl font-medium text-gray-600">This is to certify that</p>
            </div>

            <!-- Certificate Body -->
            <div class="text-center mb-10">
                <h2 class="text-6xl sm:text-7xl font-bold text-blue-900 mb-6" style="font-family: 'Dancing Script', cursive;"><?php echo $name; ?></h2>
                <p class="text-2xl sm:text-3xl text-gray-700 mb-6">Has successfully completed the course</p>
                <!-- <h3 class="text-4xl sm:text-5xl font-bold text-blue-800 mb-6">Web Development 101</h3> -->
                <h3 class="text-4xl sm:text-5xl font-bold text-blue-800 mb-6"><?php echo htmlspecialchars($course['name']); ?></h3>
                <!-- <p class="text-lg text-gray-500">Course Duration: 6 Weeks</p> -->
            </div>

            <!-- Certificate Footer -->
            <div class="mt-12 border-t-2 border-gray-200 pt-8">
                <!-- Signature Section -->
                <div class="flex justify-between items-center">
                    <div class="text-left">
                        <img src="./img/download.jpeg" alt="" width="130px" height="130px">
                        <!-- <p class="text-sm text-gray-600">Date of Completion:</p>
                        <p class="text-lg font-semibold text-gray-800"><?php echo date("F j, Y"); ?></p> -->
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Chief Security Officer</p>
                        <p class="text-sm font-semibold text-gray-600">Ameh John</p>
                        <img src="./img/signature.png" alt="Signature" class="w-32 h-auto mt-2">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Download Buttons -->
    <div class="fixed bottom-0 left-0 right-0 py-4 bg-white shadow-lg">
        <div class="flex justify-center space-x-4">
            <button onclick="downloadAsImage()" class="bg-green-600 text-white py-3 px-8 rounded-lg shadow-md hover:bg-green-700 text-lg font-semibold transition duration-300">Download as Image</button>
            <button onclick="downloadAsPDF()" class="bg-blue-600 text-white py-3 px-8 rounded-lg shadow-md hover:bg-blue-700 text-lg font-semibold transition duration-300">Download as PDF</button>
            <button class="bg-gray-600 text-white py-3 px-8 rounded-lg shadow-md hover:bg-gray-700 text-lg font-semibold transition duration-300"><a href="./courses.php">Back To Courses Page</a></button>
        </div>
    </div>

    <!-- Script to Download Certificate as Image or PDF -->
    <script>
        function downloadAsImage() {
            html2canvas(document.querySelector("#certificate")).then(canvas => {
                const link = document.createElement('a');
                link.download = 'certificate-of-completion.png';
                link.href = canvas.toDataURL();
                link.click();
            });
        }

        function downloadAsPDF() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF('landscape');

            html2canvas(document.querySelector("#certificate")).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = doc.internal.pageSize.getWidth();
                const imgHeight = doc.internal.pageSize.getHeight();
                doc.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                doc.save('certificate-of-completion.pdf');
            });
        }
    </script>

</body>

</html>