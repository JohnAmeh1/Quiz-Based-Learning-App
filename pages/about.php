<?php
include("./assets/header_pages.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us - EduQuest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="icon" href="./img/brain.jpg">
</head>

<body class="bg-gradient-to-r from-blue-50 to-blue-100 font-roboto leading-relaxed">

    <main class="container mx-auto px-4 py-16">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <img src="./img/about.jpg" alt="About Us Illustration with a Brain and Knowledge Icons" class="mx-auto w-48 h-48 mb-6 rounded-full shadow-lg" />
            <h2 class="text-5xl font-bold text-gray-800 mb-6">About Us</h2>
            <p class="text-xl text-gray-600 mx-auto max-w-3xl">
                Empowering learners through innovative quizzes and personalized online tutoring. We are committed to making education more interactive, accessible, and personalized.
            </p>
        </div>

        <!-- Mission Section -->
        <section class="mb-16">
            <h3 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Our Mission</h3>
            <p class="text-gray-600 text-lg leading-relaxed text-center max-w-2xl mx-auto">
                At EduQuest, our mission is to make learning engaging and accessible for everyone. We believe education should be interactive, fun, and tailored to individual needs. Combining cutting-edge technology with a passion for teaching, we create unique learning experiences.
            </p>
        </section>

        <!-- What We Offer Section -->
        <section class="bg-gray-100 py-12 mb-16">
            <h3 class="text-3xl font-semibold text-gray-800 mb-6 text-center">What We Offer</h3>
            <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-8 px-4">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-500 p-4 text-white rounded-full shadow-md">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h8M8 6h8M8 14h8M8 18h8"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800">Interactive Quizzes</h4>
                        <p class="text-gray-600 mt-2">Reinforce learning through interactive quizzes that assess your knowledge and progress.</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-green-500 p-4 text-white rounded-full shadow-md">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h1m2 4h1V8h-1m-4 12V12m0 4h1m0 0v8h1m-2-2h1M5 3v18M9 3v18m4-6h4m-6-2h6"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800">Expert Online Tutoring</h4>
                        <p class="text-gray-600 mt-2">Receive tailored tutoring sessions from experts in your field, helping you reach your personal goals.</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-red-500 p-4 text-white rounded-full shadow-md">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l5 5 5-5"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800">Supportive Community</h4>
                        <p class="text-gray-600 mt-2">Join a vibrant community of learners and educators to share knowledge, ask questions, and support each other’s learning journey.</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-yellow-500 p-4 text-white rounded-full shadow-md">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800">Progress Tracking</h4>
                        <p class="text-gray-600 mt-2">Track your progress, set goals, and stay on top of your learning journey with our easy-to-use tools.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Story Section -->
        <section class="mb-16">
            <h3 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Our Story</h3>
            <p class="text-gray-600 text-lg text-center max-w-3xl mx-auto">
                Founded by a John Ameh, a passionate educator and technology expert, EduQuest was created to revolutionize traditional learning methods. We began with the vision of a platform that merges education and technology, and today, EduQuest helps thousands of learners achieve their personal and academic goals.
            </p>
        </section>

        <!-- Join Us Section -->
        <section class="bg-blue-500 text-white text-center py-16 mb-16 rounded-lg shadow-lg">
            <h3 class="text-3xl font-semibold mb-6">Join Us</h3>
            <p class="text-lg mb-6">
                Ready to take your learning to the next level? Join EduQuest today and begin your educational journey with us.
            </p>
            <a href="../courses.php" class="px-8 py-3 bg-yellow-500 text-gray-800 font-semibold rounded-full shadow-md hover:bg-yellow-600 transition duration-300">
                Get Started
            </a>
        </section>
    </main>

    <?php include("./assets/footer_pages.php") ?>
</body>

</html>