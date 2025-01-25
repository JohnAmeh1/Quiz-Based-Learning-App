<?php
include("./assets/header_pages.php");

$conn = new mysqli("localhost", "root", "", "learning_app");

if (isset($_GET['course_id'])) {
    $course_id = intval($_GET['course_id']);
    $course_query = $conn->query("SELECT * FROM courses WHERE id = $course_id");
    $course = $course_query->fetch_assoc();

    // Fetch all sections for the selected course
    $sections_query = $conn->query("SELECT * FROM sections WHERE course_id = $course_id ORDER BY id ASC");
} else {
    echo "No course selected.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        pre {
            background-color:rgb(236, 235, 235);;
            /* background-color: #f5f5f5; */
            /* Light gray background */
            border-radius: 8px;
            /* Rounded corners */
            padding: 5px;
            /* Padding inside the block */
            overflow-x: auto;
            /* Horizontal scroll for long code */
        }

        code {
            /* font-family: 'Courier New', Courier, monospace; */
            /* Monospace font for code */
            font-size: 12px;
            
            /* Slightly smaller font size */
        }
    </style>
    <title><?= $course['name'] ?> - Course Content</title>
    <link href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-autoloader.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('[data-tab]');
            const tabContents = document.querySelectorAll('[data-content]');
            const sidebar = document.querySelector('aside');
            const toggleButton = document.querySelector('#sidebar-toggle');

            // Sidebar toggle for small screens
            toggleButton.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
            });

            // Automatically activate the first tab
            const firstTab = tabs[0];
            if (firstTab) {
                firstTab.classList.add('bg-blue-300');
                const firstContent = document.querySelector(`#${firstTab.dataset.tab}`);
                if (firstContent) {
                    firstContent.classList.remove('hidden');
                }
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Hide all tab contents
                    tabContents.forEach(content => content.classList.add('hidden'));

                    // Remove active state from all tabs
                    tabs.forEach(t => t.classList.remove('bg-gray-300'));

                    // Show the clicked tab's content
                    document.querySelector(`#${tab.dataset.tab}`).classList.remove('hidden');

                    // Set the active state on the clicked tab
                    tab.classList.add('bg-gray-300');
                });
            });
        });
    </script>
</head>

<body class="font-sans bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar Toggle Button for Small Screens -->


        <!-- Sidebar -->
        <aside class="w-1/4 bg-stone-300 p-5 overflow-y-auto hidden md:block">
            <h2 class="text-xl font-bold sm:text-normal mb-5"><?= $course['name'] ?> Content</h2>
            <ul>
                <?php while ($section = $sections_query->fetch_assoc()): ?>
                    <li class="mb-1">
                        <button data-tab="section-<?= $section['id'] ?>" class="focus:outline-none focus:ring-2 focus:ring-gray-500 block w-full text-left px-3 py-2 text-gray-900 hover:bg-gray-300 rounded">
                            <?= $section['section_title'] ?>
                        </button>
                    </li>
                <?php endwhile; ?>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 overflow-y-auto bg-gray-200">
            <!-- Toggle Button -->
            <button id="sidebar-toggle"
                class="p-4 bg-gray-800 text-white fixed top-4 left-4 z-50 md:hidden rounded-full shadow-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                <i class="fas fa-bars text-white text-lg"></i>
            </button>

            <?php
            // Reset the pointer to fetch sections again
            $sections_query->data_seek(0);
            while ($section = $sections_query->fetch_assoc()):
                // Fetch subtitles and content for each section
                $subtitles_query = $conn->query("SELECT * FROM subtitles WHERE section_id = {$section['id']} ORDER BY id ASC");
            ?>
                <section id="section-<?= $section['id'] ?>" data-content class="hidden">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800"><?= $section['section_title'] ?></h2>

                    <?php while ($subtitle = $subtitles_query->fetch_assoc()): ?>
                        <article class="mb-8">
                            <h3 class="text-xl font-medium text-gray-700 mb-2"><?= $subtitle['subtitle'] ?></h3>
                            <p class="text-gray-600 leading-relaxed"><?= nl2br($subtitle['content']) ?></p>
                            <pre class="bg-stone-100"><code class=""><?= nl2br(htmlspecialchars($subtitle['code_snippet'])) ?></code></pre>
                        </article>
                    <?php endwhile; ?>
                </section>
            <?php endwhile; ?>
            <div class="flex justify-between items-center bg-gray-200 p-4">
                <button
                    id="prevTab"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                    Prev
                </button>
                <button
                    id="nextTab"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                    Next
                </button>
            </div>
        </main>

    </div>

    <script>
        // Automatically display the first tab content on page load
        const firstTab = document.querySelector('[data-tab]');
        if (firstTab) {
            firstTab.click();
        }

        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('[data-tab]');
            const tabContents = document.querySelectorAll('[data-content]');
            const prevButton = document.querySelector('#prevTab');
            const nextButton = document.querySelector('#nextTab');

            let currentTabIndex = 0;

            const updateTabs = () => {
                // Hide all tab contents
                tabContents.forEach(content => content.classList.add('hidden'));

                // Remove active state from all tabs
                tabs.forEach(tab => tab.classList.remove('bg-gray-300'));

                // Show the current tab content
                tabContents[currentTabIndex].classList.remove('hidden');
                tabs[currentTabIndex].classList.add('bg-gray-300');
            };

            // Initialize the first tab
            if (tabs.length > 0) {
                updateTabs();
            }

            // Event listeners for Prev and Next buttons
            prevButton.addEventListener('click', () => {
                if (currentTabIndex > 0) {
                    currentTabIndex--;
                    updateTabs();
                }
            });

            nextButton.addEventListener('click', () => {
                if (currentTabIndex < tabs.length - 1) {
                    currentTabIndex++;
                    updateTabs();
                }
            });

            // Also make sure clicking tabs updates the currentTabIndex
            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    currentTabIndex = index;
                    updateTabs();
                });
            });
        });
    </script>
</body>

</html>