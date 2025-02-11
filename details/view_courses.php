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
            background-color: rgb(248, 250, 252);
            border-radius: 8px;
            padding: 5px;
            overflow-x: auto;
            border: 1px solid rgb(226, 232, 240);
        }

        code {
            font-size: 12px;
        }
    </style>
    <title><?= $course['name'] ?> - Tutorial</title>
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
                firstTab.classList.add('bg-indigo-100');
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
                    tabs.forEach(t => t.classList.remove('bg-indigo-100'));

                    // Show the clicked tab's content
                    document.querySelector(`#${tab.dataset.tab}`).classList.remove('hidden');

                    // Set the active state on the clicked tab
                    tab.classList.add('bg-indigo-100');
                });
            });
        });
    </script>
</head>

<body class="font-sans bg-white">
    <div class="flex h-screen">
        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed md:relative w-64 md:w-1/4 bg-slate-100 h-screen overflow-y-auto -left-64 md:left-0 transition-all duration-300 ease-in-out z-50 md:block border-r border-slate-200">
            <div class="p-5 relative">
                <!-- Close button for mobile -->
                <button id="sidebar-close" class="absolute top-4 right-4 text-slate-600 hover:text-slate-800 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <h2 class="text-xl font-bold sm:text-normal mb-5 text-slate-800"><?= $course['name'] ?> Tutorial</h2>
                <ul>
                    <?php while ($section = $sections_query->fetch_assoc()): ?>
                        <li class="mb-1">
                            <button data-tab="section-<?= $section['id'] ?>"
                                class="focus:outline-none focus:ring-2 focus:ring-indigo-500 block w-full text-left px-3 py-2 text-slate-700 hover:bg-indigo-50 rounded transition duration-150">
                                <?= $section['section_title'] ?>
                            </button>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col bg-white min-h-screen">
            <!-- Content Area with Proper Scrolling -->
            <div class="flex-1 overflow-y-auto">
                <!-- Toggle Button -->
                <button id="sidebar-toggle"
                    class="p-4 bg-indigo-600 text-white fixed top-4 left-4 z-50 md:hidden rounded-full shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <?php
                $sections_query->data_seek(0);
                while ($section = $sections_query->fetch_assoc()):
                    $subtitles_query = $conn->query("SELECT * FROM subtitles WHERE section_id = {$section['id']} ORDER BY id ASC");
                ?>
                    <section id="section-<?= $section['id'] ?>" data-content class="hidden p-8">
                        <h2 class="text-2xl font-semibold mb-4 text-slate-800"><?= $section['section_title'] ?></h2>

                        <?php while ($subtitle = $subtitles_query->fetch_assoc()): ?>
                            <article class="mb-8 bg-white rounded-lg shadow-sm p-6">
                                <h3 class="text-xl font-medium text-slate-700 mb-2"><?= $subtitle['subtitle'] ?></h3>
                                <p class="text-slate-600 leading-relaxed mb-4"><?= nl2br($subtitle['content']) ?></p>
                                <pre class="bg-slate-50"><code class="text-slate-800">Code Example: <br><br><?= nl2br(htmlspecialchars($subtitle['code_snippet'])) ?></code></pre>
                            </article>
                        <?php endwhile; ?>
                    </section>
                <?php endwhile; ?>
            </div>

            <div class="flex justify-between items-center p-4 bg-slate-50 border-t border-slate-200">
                <button id="prevTab"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150">
                    Previous
                </button>
                <button id="nextTab"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150">
                    Next
                </button>
            </div>
        </main>
    </div>

    <script>
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
                tabs.forEach(tab => tab.classList.remove('bg-indigo-100'));

                // Show the current tab content
                tabContents[currentTabIndex].classList.remove('hidden');
                tabs[currentTabIndex].classList.add('bg-indigo-100');

                // Update button states
                prevButton.disabled = currentTabIndex === 0;
                nextButton.disabled = currentTabIndex === tabs.length - 1;

                // Visual feedback for disabled state
                if (prevButton.disabled) {
                    prevButton.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    prevButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }

                if (nextButton.disabled) {
                    nextButton.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    nextButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }
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

            // Tab click handlers
            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    currentTabIndex = index;
                    updateTabs();
                });
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.querySelector('#sidebar');
            const sidebarToggle = document.querySelector('#sidebar-toggle');
            const sidebarClose = document.querySelector('#sidebar-close');
            const overlay = document.querySelector('#sidebar-overlay');

            function openSidebar() {
                sidebar.classList.remove('-left-64');
                sidebar.classList.add('left-0');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('left-0');
                sidebar.classList.add('-left-64');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }

            sidebarToggle.addEventListener('click', openSidebar);
            sidebarClose.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);

            // Close sidebar when clicking a tab on mobile
            const tabButtons = document.querySelectorAll('[data-tab]');
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    if (window.innerWidth < 768) { // md breakpoint
                        closeSidebar();
                    }
                });
            });

            // Handle resize events
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('-left-64');
                    sidebar.classList.remove('left-0');
                    overlay.classList.add('hidden');
                    document.body.style.overflow = '';
                } else {
                    sidebar.classList.remove('left-0');
                    sidebar.classList.add('-left-64');
                }
            });
        });
    </script>
</body>

</html>