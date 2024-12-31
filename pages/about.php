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

<body class="bg-gray-100 font-roboto">

    <main class="container mx-auto px-4 py-10">
        <div class="text-center mb-8">
            <img src="./img/about.jpg" alt="About Us Illustration with a Brain and Knowledge Icons" class="mx-auto w-48 h-48 mb-4" />
            <h2 class="text-4xl font-bold text-gray-800 mb-4">About Us</h2>
            <p class="text-lg text-gray-600">
                Empowering learners through innovative quizzes and personalized online tutoring.
            </p>
        </div>

        <section class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
            <p class="text-gray-600 leading-relaxed">
                At EduQuest, our mission is to make learning engaging and accessible for everyone. We believe that
                education should be interactive, fun, and tailored to each individual’s needs. Our platform combines
                cutting-edge technology with a passion for teaching to create a unique learning experience.
            </p>
        </section>

        <section class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">What We Offer</h3>
            <ul class="list-disc list-inside text-gray-600 space-y-2">
                <li>Interactive quizzes to reinforce learning and assess knowledge.</li>
                <li>Expert online tutoring tailored to your unique goals.</li>
                <li>A supportive community of learners and educators.</li>
                <li>Progress tracking to help you stay on top of your goals.</li>
            </ul>
        </section>

        <section class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Story</h3>
            <p class="text-gray-600 leading-relaxed">
                Founded by a team of educators and tech enthusiasts, EduQuest was born out of a desire to revolutionize
                traditional learning methods. We started with the idea of creating a platform that combines the best of
                technology and education, and today, EduQuest is helping thousands of learners achieve their goals.
            </p>
        </section>

        <section class="text-center">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Join Us</h3>
            <p class="text-gray-600 mb-6">
                Ready to take your learning to the next level? Join EduQuest and start your journey today.
            </p>
            <a href="courses.php" class="px-6 py-2 bg-blue-500 text-white font-medium rounded-lg shadow hover:bg-blue-600">
                Get Started
            </a>
        </section>
    </main>

    <?php include("./assets/footer_pages.php") ?>
</body>

</html>
