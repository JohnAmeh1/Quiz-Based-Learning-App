<?php
include("./assets/header_pages.php");
$conn = new mysqli("localhost", "root", "", "learning_app");

// Fetch user data
$user_data = getUser();
if (!$user_data || !isset($user_data['id'])) {
    die("User not logged in.");
}
$user_badge = $user_data['badge'] ?? ''; // Fetch user badge

// Check if course_id and section_id are provided in the URL
if (isset($_GET['course_id']) && isset($_GET['section_id'])) {
    $course_id = intval($_GET['course_id']); // Sanitize the input
    $section_id = intval($_GET['section_id']); // Sanitize the input

    // Fetch the course details
    $course_query = $conn->query("SELECT * FROM courses WHERE id = $course_id");
    $course = $course_query->fetch_assoc();

    // Check if the course exists
    if (!$course) {
        die("Course not found.");
    }

    // Check if the course is premium and user is verified
    if ($course['is_premium'] && $user_badge !== 'verified') {
        die("You need to be a verified user to access this premium course.");
    }

    // Fetch the specific subtitle based on section_id
    $subtitle_query = $conn->query("SELECT * FROM subtitles WHERE id = $section_id AND section_id IN (SELECT id FROM sections WHERE course_id = $course_id)");
    $subtitle = $subtitle_query->fetch_assoc();

    // Check if the subtitle exists
    if (!$subtitle) {
        die("Subtitle not found.");
    }
} else {
    die("No course or subtitle selected."); // Exit if no course_id or section_id is provided
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Viewer - <?= htmlspecialchars($course['name']) ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/prism.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .editor-container {
            height: 300px;
        }

        .output-container {
            min-height: 150px;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .flex-responsive {
                flex-direction: column;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Display Subtitle -->
            <section class="p-8 border-b">

                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Left Column: Code Editor -->
                    <div class="w-full md:w-1/2">
                        <!-- Editor Title -->
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Editor</h4>
                        <div class="w3-code">
                            <textarea id="code-editor" contenteditable="true" class="w-full h-[500px] p-4 font-mono text-gray-200 bg-gray-900 outline-none resize-none"><?= htmlspecialchars($subtitle['code_snippet']) ?></textarea>
                
                        </div>
                        <div class="p-4 bg-gray-100 mt-4 flex justify-between flex-responsive">
                            <!-- Run Button -->
                            <button id="run-btn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center mr-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Run
                            </button>

                            <!-- Download Button
                            <button id="download-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 18h6"></path>
                                </svg>
                                Download
                            </button> -->
                        </div>
                    </div>

                    <!-- Right Column: Output Container -->
                    <div class="w-full md:w-1/2">
                        <!-- Output Title -->
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Output</h4>
                        <div class="p-4 output-container bg-gray-100 h-[500px] overflow-y-auto">
                            <div id="output-content" class="font-mono whitespace-pre-wrap"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const runButton = document.getElementById('run-btn');
            // const downloadButton = document.getElementById('download-btn');
            const editor = document.getElementById('code-editor');
            const outputContent = document.getElementById('output-content');

            // Get the language of the code snippet (from PHP)
            const codeLanguage = "<?= htmlspecialchars($course['name']) ?>";

            // Run Button Functionality
            runButton.addEventListener('click', async () => {
                const code = editor.value;
                outputContent.innerHTML = '<div class="text-gray-500">Running code...</div>';

                try {
                    const response = await fetch('run_code.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            code: code,
                            language: codeLanguage // Pass the detected language
                        })
                    });
                    const result = await response.json();
                    if (result.error) {
                        outputContent.innerHTML = `<div class="text-red-600">Error: ${result.error}</div>`;
                    } else {
                        outputContent.textContent = result.output;
                    }
                } catch (error) {
                    outputContent.innerHTML = `<div class="text-red-600">Failed to execute: ${error.message}</div>`;
                }
            });

            
        });
    </script>
</body>

</html>