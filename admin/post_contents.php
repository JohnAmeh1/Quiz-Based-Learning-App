<?php
include("./assets/header_admin.php");

$conn = new mysqli("localhost", "root", "", "learning_app");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = intval($_POST['course_id']);
    $sections = $_POST['sections'];

    foreach ($sections as $section) {
        $section_title = $section['section_title'];
        $stmt = $conn->prepare("INSERT INTO sections (course_id, section_title) VALUES (?, ?)");
        $stmt->bind_param("is", $course_id, $section_title);
        $stmt->execute();
        $section_id = $stmt->insert_id;

        // Loop through each subtitle, content, and code snippet for this section
        foreach ($section['titles'] as $index => $subtitle) {
            $content = $section['contents'][$index];
            $code_snippet = $section['code_snippets'][$index]; // Access code snippet based on index
            $stmt = $conn->prepare("INSERT INTO subtitles (section_id, subtitle, content, code_snippet) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $section_id, $subtitle, $content, $code_snippet);
            $stmt->execute();
        }
    }

    // echo "Course content added successfully!";
    echo "<div id='successAlert' class='fixed top-4 right-4 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg'>
        <div class='flex items-center justify-between'>
            <span class='font-semibold'>Course content added successfully</span>
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
    <title>Add Course Content</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto mt-5 mb-5 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Course Content</h1>
        <form method="POST" class="space-y-6">
            <div>
                <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">Select Course</label>
                <select name="course_id" id="course_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <?php
                    $courses = $conn->query("SELECT * FROM courses");
                    while ($course = $courses->fetch_assoc()) {
                        echo "<option value='{$course['id']}'>{$course['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div id="section-container" class="space-y-6">
                <div class="section-item space-y-4">
                    <label class="block text-sm font-medium text-gray-700">Section Title</label>
                    <input type="text" name="sections[0][section_title]" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <div class="subtitle-group space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Subtitle</label>
                        <input type="text" name="sections[0][titles][]" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        <label class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="sections[0][contents][]" rows="5" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>

                        <label class="block text-sm font-medium text-gray-700">Code Snippet</label>
                        <textarea name="sections[0][code_snippets][]" rows="5"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none font-mono bg-gray-100"></textarea>
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <button type="button" onclick="addTitleContentGroup(this, 0)"
                            class="mt-4 px-4 py-2 bg-orange-500 text-white rounded-lg shadow hover:bg-yellow-600 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            Add Another Subtitle & Content
                        </button>
                        <button type="button" onclick="addSection()"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                            Add Another Section
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mt-6">
                <!-- <button type="button" onclick="addSection()"
                    class="px-4 py-2 bg-indigo-500 text-white rounded-lg shadow hover:bg-indigo-600 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    Add Another Section
                </button> -->
                <button type="submit"
                    class="w-full inline-block px-6 py-3 mt-4 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 transition-transform transform hover:scale-105 
                    focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Save Content
                </button>
            </div>
        </form>
    </div>

    <script>
        let sectionIndex = 0;

        function addSection() {
            sectionIndex++;
            const sectionContainer = document.getElementById('section-container');
            const newSection = document.createElement('div');
            newSection.classList.add('section-item', 'space-y-4');
            newSection.innerHTML = `
                <h2 class="text-lg font-medium text-gray-800">Section ${sectionIndex + 1}</h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Section Title</label>
                    <input type="text" name="sections[${sectionIndex}][section_title]" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="subtitle-group space-y-4">
                    <label class="block text-sm font-medium text-gray-700">Subtitle</label>
                    <input type="text" name="sections[${sectionIndex}][titles][]" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <label class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="sections[${sectionIndex}][contents][]" rows="5" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>

                    <label class="block text-sm font-medium text-gray-700">Code Snippet</label>
                    <textarea name="sections[${sectionIndex}][code_snippets][]" rows="5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none font-mono bg-gray-100"></textarea>
                </div>

                <button type="button" onclick="addTitleContentGroup(this, ${sectionIndex})"
                    class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    Add Another Subtitle & Content
                </button>
            `;
            sectionContainer.appendChild(newSection);
        }

        function addTitleContentGroup(button, sectionIndex) {
            const sectionItem = button.closest('.section-item');
            const titleContentGroup = document.createElement('div');
            titleContentGroup.classList.add('subtitle-group', 'space-y-4', 'mt-6');
            titleContentGroup.innerHTML = `
                <label class="block text-sm font-medium text-gray-700">Subtitle</label>
                <input type="text" name="sections[${sectionIndex}][titles][]" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">

                <label class="block text-sm font-medium text-gray-700">Content</label>
                <textarea name="sections[${sectionIndex}][contents][]" rows="5" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>

                <label class="block text-sm font-medium text-gray-700">Code Snippet</label>
                <textarea name="sections[${sectionIndex}][code_snippets][]" rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none font-mono bg-gray-100"></textarea>
            `;
            sectionItem.appendChild(titleContentGroup);
        }


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