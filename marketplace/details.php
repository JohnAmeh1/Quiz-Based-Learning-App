<?php
// Fetch template details based on the ID in the URL
$templateId = $_GET['id'] ?? null;

if (!$templateId) {
    die("Template ID is missing.");
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch template details
$sql = "SELECT * FROM code_templates WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $templateId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $template = $result->fetch_assoc();
} else {
    die("Template not found.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Details - EduQuest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-gray-800">EduQuest</div>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-700 hover:text-blue-600">Home</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Templates</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Upload</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="relative">
                <!-- Thumbnail -->
                <div class="w-full h-64 overflow-hidden rounded-lg">
                    <img src="uploads/<?= $template['thumbnail'] ?>" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="mt-6">
                <!-- Title -->
                <h1 class="text-3xl font-bold text-gray-800 mb-4"><?= $template['title'] ?></h1>

                <!-- Description -->
                <p class="text-gray-600 text-lg mb-6"><?= $template['description'] ?></p>

                <!-- Screenshots -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <?php if ($template['screenshot1']) : ?>
                        <img src="uploads/<?= $template['screenshot1'] ?>" alt="Screenshot 1" class="w-full h-48 object-cover rounded-lg">
                    <?php endif; ?>
                    <?php if ($template['screenshot2']) : ?>
                        <img src="uploads/<?= $template['screenshot2'] ?>" alt="Screenshot 2" class="w-full h-48 object-cover rounded-lg">
                    <?php endif; ?>
                    <?php if ($template['screenshot3']) : ?>
                        <img src="uploads/<?= $template['screenshot3'] ?>" alt="Screenshot 3" class="w-full h-48 object-cover rounded-lg">
                    <?php endif; ?>
                </div>

                <!-- Download Button -->
                <a href="download.php?file=<?= $template['file_name'] ?>" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-300 font-medium">
                    Download Template
                </a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>