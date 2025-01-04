<?php
include("./php/all_files.php");
include("./assets/user_auth.php");
$user_data = getUser();

$user_id = $user_data['id'];
// Database connection (Replace these credentials with your actual database details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$sql = "SELECT name FROM users WHERE id = $user_id"; // Assuming table name is 'users'
$result = $conn->query($sql);
$user_name = $user_data['username']; // Default value if no result

if ($result->num_rows > 0) {
    // Fetching the name
    $row = $result->fetch_assoc();
    $user_name = $row['name'];
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
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet"> <!-- Cursive Font -->
    <link rel="icon" href="./img/brain.jpg">
</head>

<body class="bg-gray-100 p-4">

    <div class="min-h-screen flex justify-center items-center bg-gray-50 px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-100 shadow-2xl rounded-xl w-full max-w-4xl px-6 py-8 border-4 border-blue-500 relative">
            <!-- Certificate Header -->
            <div class="text-center mb-6">
                <div class="flex items-center justify-center">
                    <span
                        class="flex items-center mx-auto py-3 px-4 w-50 rounded-full shadow-md border border-blue-500 bg-blue-50">
                        <!-- Logo Section -->
                        <img
                            alt="EduQuest Logo"
                            class="w-12 h-12 rounded-full border border-blue-400 shadow-sm"
                            src="./img/brain.jpg" />
                        <!-- Brand Name -->
                        <span class="ml-4 text-lg font-semibold text-blue-600 hover:text-blue-800">
                            EduQuest
                        </span>
                    </span>
                </div>

                <h1 class="text-4xl sm:text-5xl font-extrabold text-blue-600 mb-2">Certificate of Completion</h1>
                <p class="text-lg sm:text-xl font-medium text-gray-700">This is to certify that</p>
            </div>

            <!-- Certificate Body -->
            <div class="text-center mb-8">
                <h2 class="text-5xl sm:text-6xl font-semibold text-blue-800 mb-4" style="font-family: 'Dancing Script', cursive;"><?php echo $user_name; ?></h2> <!-- Cursive for name -->
                <p class="text-xl sm:text-2xl text-gray-600 mb-4">Has successfully completed the course</p>
                <h3 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-4">Web Development 101</h3>
                <!-- <p class="text-lg text-gray-500">Course Duration: 6 Weeks</p> -->
            </div>

            <!-- Certificate Footer -->
            <div class="block mt-10 border-t-2 pt-6">
                <!-- Signature Section -->
                <div class="text-right space-y-4">
                    <div class="flex items-center justify-end space-x-4">
                        <span class="text-sm sm:text-base border-b-2 border-gray-800 pb-1">Signature</span>
                        <span class="text-xs text-gray-600">Instructor</span>
                    </div>
                </div>
            </div>

            <!-- Optional Watermark -->
            <div class="absolute inset-0 flex items-center justify-center opacity-10">
                <h1 class="text-9xl sm:text-8xl font-extrabold text-blue-300 transform rotate-12">CERTIFIED</h1>
            </div>

        </div>
    </div>

    <!-- Download Button -->
    <div class="fixed bottom-0 left-0 right-0 py-4 bg-gray-100">
        <div class="flex justify-center">
            <button onclick="downloadCertificate()" class="bg-blue-500 text-white py-3 px-6 rounded-full shadow-lg hover:bg-blue-600 text-lg">Download Certificate</button>
        </div>
    </div>

    <!-- jsPDF Script to Download Certificate -->
    <script>
        function downloadCertificate() {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            // Add certificate title and content
            doc.setFont("helvetica", "normal");
            doc.setFontSize(22);
            doc.text("Certificate of Completion", 105, 30, {
                align: "center"
            });

            doc.setFont("helvetica", "normal");
            doc.setFontSize(16);
            doc.text("This is to certify that", 105, 50, {
                align: "center"
            });

            // User's name with a cursive font
            doc.setFont("courier", "italic");
            doc.setFontSize(30);
            doc.text("<?php echo $user_name; ?>", 105, 70, {
                align: "center"
            });

            // Course details
            doc.setFont("helvetica", "normal");
            doc.setFontSize(18);
            doc.text("Has successfully completed the course", 105, 90, {
                align: "center"
            });

            doc.setFont("helvetica", "bold");
            doc.setFontSize(22);
            doc.text("Web Development 101", 105, 110, {
                align: "center"
            });

            doc.setFont("helvetica", "normal");
            doc.setFontSize(14);
            doc.text("Course Duration: 6 Weeks", 105, 130, {
                align: "center"
            });

            // Footer with signature and date
            doc.setFont("helvetica", "normal");
            doc.setFontSize(12);
            doc.text("Date of Completion: " + new Date().toLocaleDateString(), 20, 180);
            doc.text("Signature: ______________________", 140, 180);

            // Save the PDF file
            doc.save('certificate-of-completion.pdf');
        }
    </script>

</body>

</html>