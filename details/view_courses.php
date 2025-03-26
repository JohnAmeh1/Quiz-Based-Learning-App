<?php
include("./assets/header_pages.php");
$conn = new mysqli("localhost", "root", "", "learning_app");

// Fetch user data
$user_data = getUser();
if (!$user_data || !isset($user_data['id'])) {
    die("User not logged in.");
}
$user_badge = $user_data['badge'] ?? ''; // Fetch user badge

if (isset($_GET['course_id'])) {
    $course_id = intval($_GET['course_id']);
    $course_query = $conn->query("SELECT * FROM courses WHERE id = $course_id");
    $course = $course_query->fetch_assoc();

    // Check if the course is premium and user is verified
    if ($course['is_premium'] && $user_badge !== 'verified') {
        die("You need to be a verified user to access this premium course.");
    }

    // Fetch all sections for the selected course
    $sections_query = $conn->query("SELECT * FROM sections WHERE course_id = $course_id ORDER BY id ASC");
} else {
    echo "No course selected.";
    exit;
}

$quiz_payment_check = $conn->prepare("SELECT * FROM quiz_payments WHERE user_id = ? AND course_id = ? AND payment_status = 'completed'");
$quiz_payment_check->bind_param("ii", $user_data['id'], $course_id);
$quiz_payment_check->execute();
$quiz_payment_result = $quiz_payment_check->get_result();
$has_paid_for_quiz = $quiz_payment_result->num_rows > 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $course['name'] ?> - EduQuest</title>
    <link href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* W3Schools-like code block styling */
        .w3-code {
            background-color: #f1f1f1;
            border-left: 4px solid #4CAF50;
            padding: 16px;
            overflow: auto;
            font-family: Consolas, "Courier New", monospace;
            font-size: 14px;
            line-height: 1.5;
            color: #000;
            margin: 20px 0;
        }

        .w3-viewbutton {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            float: right;
            margin-top: -10px;
            margin-right: 5px;
        }

        .w3-viewbutton:hover {
            background-color: #1e88e5;
        }

        .output-container {
            background-color: #f1f1f1;
            border-left: 4px solid #2196F3;
            padding: 16px;
            margin: 20px 0;
            font-family: Consolas, "Courier New", monospace;
            font-size: 14px;
            line-height: 1.5;
            color: #000;
        }
    </style>
</head>

<body class="font-sans bg-white">
    <div class="flex h-screen">
        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed md:relative w-64 md:w-1/4 bg-slate-100 h-screen overflow-y-auto transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50 border-r border-slate-200 shadow-lg">
            <div class="p-5 relative">
                <!-- Close button for mobile -->
                <button id="sidebar-close" class="absolute top-4 right-4 text-slate-600 hover:text-slate-800 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-xl font-bold sm:text-normal mb-5 text-slate-800"><?= $course['name'] ?></h2>
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
        <main class="flex-1 flex flex-col bg-white min-h-screen overflow-hidden mt-5">
            <div class="flex justify-end p-4">

                <?php if ($has_paid_for_quiz): ?>
                    <a href="quiz.php?course_id=<?= isset($course['id']) ? htmlspecialchars($course['id']) : '' ?>"
                        target = "_blank" class="inline-block px-6 py-3 mt-4 text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Take Quiz
                    </a>
                <?php else: ?>
                    <a href="./quiz_payment.php?course_id=<?= isset($course['id']) ? htmlspecialchars($course['id']) : '' ?>"
                        class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 cursor-pointer">
                        Pay for Quiz
                    </a>
                <?php endif; ?>

            </div>
            <div class="flex-1 overflow-y-auto p-4">
                <button id="sidebar-toggle"
                    class="p-2 fixed top-18 left-3 z-50 text-gray-900 bg-white border-2 border-gray-900 rounded-full shadow-lg hover:bg-blue-700 hover:text-white hover:border-white transition duration-150">
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
                                <div class="w3-code">
                                    <pre><code class="language-php overflow-x-auto overflow-y-auto"><?= htmlspecialchars($subtitle['code_snippet']) ?></code></pre>
                                    <!-- <a href="view_code.php?section_id=<?= $subtitle['id'] ?>" class="w3-viewbutton">View</a> -->
                                    <a href="view_code.php?course_id=<?= htmlspecialchars($course['id']) ?>&section_id=<?= htmlspecialchars($subtitle['id']) ?>" target="_blank" class="w3-viewbutton">View</a>

                                    <!-- <a href="view_code.php?course_id=<?= $course['id'] ?>&section_id=<?= $subtitle['id'] ?>" target="_blank"  class="w3-viewbutton">View</a> -->

                                </div>
                            </article>
                        <?php endwhile; ?>
                    </section>
                <?php endwhile; ?>
            </div>
            <div class="flex justify-between items-center p-4 bg-slate-50 border-t border-slate-200">
                <button id="prevTab"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed"
                    aria-label="Previous Tab"
                    disabled>
                    Previous
                </button>
                <button id="nextTab"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed"
                    aria-label="Next Tab">
                    Next
                </button>
            </div>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('[data-tab]');
            const tabContents = document.querySelectorAll('[data-content]');
            const prevButton = document.getElementById('prevTab');
            const nextButton = document.getElementById('nextTab');
            let currentTabIndex = 0;

            const showTab = (index) => {
                tabContents.forEach(content => content.classList.add('hidden'));
                tabs.forEach(tab => tab.classList.remove('bg-indigo-100'));
                const selectedTabContent = document.querySelector(`#${tabs[index].dataset.tab}`);
                if (selectedTabContent) {
                    selectedTabContent.classList.remove('hidden');
                }
                tabs[index].classList.add('bg-indigo-100');
                prevButton.disabled = index === 0;
                nextButton.disabled = index === tabs.length - 1;
            };

            showTab(currentTabIndex);

            prevButton.addEventListener('click', () => {
                if (currentTabIndex > 0) {
                    currentTabIndex--;
                    showTab(currentTabIndex);
                }
            });

            nextButton.addEventListener('click', () => {
                if (currentTabIndex < tabs.length - 1) {
                    currentTabIndex++;
                    showTab(currentTabIndex);
                }
            });

            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    currentTabIndex = index;
                    showTab(currentTabIndex);
                });
            });
        });
    </script>
</body>

</html>