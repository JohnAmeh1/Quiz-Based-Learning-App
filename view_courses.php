<?php
include("./assets/header_1.php");

// Fetch course_id from the URL
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Load course content from the JSON file
$json_file = __DIR__ . '/course_content.json'; // Path to the JSON file
$courses = json_decode(file_get_contents($json_file), true);

// Find the course with the matching ID
$course = null;
foreach ($courses as $c) {
    if ($c['id'] === $course_id) {
        $course = $c;
        break;
    }
}

if (!$course) {
    die("Course not found.");
}
?>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title><?= htmlspecialchars($course['name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
            <!-- Course Content -->
            <main class="flex-1 bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($course['name']) ?></h1>
                <p class="text-gray-700 mb-6"><?= htmlspecialchars($course['description']) ?></p>

                <?php foreach ($course['content'] as $content): ?>
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-4"><?= htmlspecialchars($content['title']) ?></h2>
                        <?php foreach ($content['sections'] as $section): ?>
                            <div class="mb-6">
                                <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($section['title']) ?></h3>
                                <p class="text-gray-700 mb-4"><?= nl2br(htmlspecialchars($section['content'])) ?></p>
                                <?php if (!empty($section['code_snippet'])): ?>
                                    <pre class="bg-gray-800 text-white p-4 rounded-lg"><code><?= htmlspecialchars($section['code_snippet']) ?></code></pre>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

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
                        <?php foreach ($courses as $course): ?>
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

                                <?php if (in_array($course['id'], $completed_courses)): ?>
                                    <!-- Course Completed Message -->
                                    <div class="w-full text-center px-6 py-3 mt-1 text-white bg-gray-500 rounded-lg shadow-md">
                                        Course Completed
                                    </div>
                                <?php else: ?>
                                    <?php if ($course['is_premium']): ?>
                                        <?php if ($user_badge === 'verified'): ?>
                                            <!-- Start Course Button for Verified Users -->
                                            <!-- <a href="./details/view_courses.php?course_id=<?= $course['id'] ?>"
                                                class="w-full inline-block text-center px-6 py-3 mt-1 text-white bg-gradient-to-r 
            from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
            hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                                Start Course
                                            </a> -->
                                            <a href="./view_courses.php?course_id=<?= $course['id'] ?>"
                                                class="w-full inline-block text-center px-6 py-3 mt-1 text-white bg-gradient-to-r 
    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
    hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                                Start Coursess
                                            </a>
                                        <?php else: ?>
                                            <!-- Premium Course Access Denied for Unverified Users -->
                                            <a href="./payment.php?course_id=<?= $course['id'] ?>"
                                                class="w-full inline-block text-center px-6 py-3 mt-1 text-white bg-amber-600 rounded-lg shadow-md hover:bg-amber-700 transition duration-150">
                                                <i class="fa-solid fa-bolt me-1"></i>Pro Access
                                            </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <!-- Start Course Button for Non-Premium Courses -->
                                        <a href="./details/view_courses.php?course_id=<?= $course['id'] ?>"
                                            class="w-full inline-block text-center px-6 py-3 mt-1 text-white bg-gradient-to-r 
        from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
        hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                            Start Course
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>
</body>

</html>