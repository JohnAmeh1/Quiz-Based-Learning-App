<?php include("./assets/header_1.php") ?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Learning App Dashboard
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />

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

            <!-- Main Dashboard -->
            <main class="flex-1 bg-white shadow-lg rounded-lg p-6 ml-6">
                <h2 class="text-2xl font-bold mb-4">
                    Course Dashboard
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Course Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                        <img alt="Thumbnail of a web development course, showing a computer screen with code" class="w-full h-40 object-cover rounded mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/OozDBMYeBv3VQCcCZUKmYM3SPny2YwQ5TGZfZ2AVzqxk1I7TA.jpg" width="300" />
                        <h3 class="text-xl font-bold mb-2">
                            Web Development
                        </h3>
                        <p class="text-gray-700 mb-4">
                            Learn the basics of HTML, CSS, and JavaScript to build your own websites.
                        </p>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring">
                            Start Course
                        </button>
                    </div>
                    <!-- Course Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                        <img alt="Thumbnail of a data science course, showing a graph and data points" class="w-full h-40 object-cover rounded mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/TD77mkfKkn0ncCAjjjN21rAuMDCDUmjO8UjjdgTE6aLxak9JA.jpg" width="300" />
                        <h3 class="text-xl font-bold mb-2">
                            Data Science
                        </h3>
                        <p class="text-gray-700 mb-4">
                            Dive into data analysis, visualization, and machine learning with Python.
                        </p>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring">
                            Start Course
                        </button>
                    </div>
                    <!-- Course Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                        <img alt="Thumbnail of a machine learning course, showing a neural network diagram" class="w-full h-40 object-cover rounded mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/f8w1hTQXwTVyQyiVanoSxvkEFlvzun4ca68Uug6l88eg1I7TA.jpg" width="300" />
                        <h3 class="text-xl font-bold mb-2">
                            Machine Learning
                        </h3>
                        <p class="text-gray-700 mb-4">
                            Understand the fundamentals of machine learning and build your own models.
                        </p>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring">
                            Start Course
                        </button>
                    </div>
                    <!-- Course Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                        <img alt="Thumbnail of a mobile development course, showing a smartphone with app icons" class="w-full h-40 object-cover rounded mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/BUzArCyvLYYqClw4r97hHFAYBv3ZaNWmEwIm0QkFmNFXNyeJA.jpg" width="300" />
                        <h3 class="text-xl font-bold mb-2">
                            Mobile Development
                        </h3>
                        <p class="text-gray-700 mb-4">
                            Create mobile applications for Android and iOS using modern frameworks.
                        </p>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring">
                            Start Course
                        </button>
                    </div>
                    <!-- Course Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                        <img alt="Thumbnail of a game development course, showing a game controller and a game scene" class="w-full h-40 object-cover rounded mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/JZ8tAI1ozGZfWqMTfEufwxlPWhpCQuLVZROpjDib6dIKrR2nA.jpg" width="300" />
                        <h3 class="text-xl font-bold mb-2">
                            Game Development
                        </h3>
                        <p class="text-gray-700 mb-4">
                            Learn to design and develop your own video games using Unity and Unreal Engine.
                        </p>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring">
                            Start Course
                        </button>
                    </div>
                    <!-- Course Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                        <img alt="Thumbnail of a cyber security course, showing a lock and a shield" class="w-full h-40 object-cover rounded mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/VNvYg8IJObKdMZBUrx5tPKaTwiOgTtZsW0d5fBEKbL5vak9JA.jpg" width="300" />
                        <h3 class="text-xl font-bold mb-2">
                            Cyber Security
                        </h3>
                        <p class="text-gray-700 mb-4">
                            Protect systems and networks from cyber threats and attacks.
                        </p>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring">
                            Start Course
                        </button>
                    </div>
                    <!-- Course Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                        <img alt="Thumbnail of a cloud computing course, showing a cloud icon and server racks" class="w-full h-40 object-cover rounded mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/JsfMnBfIryt0UEmopyu1NyccXk6mSDkIUOHY1z6wSfpDrR2nA.jpg" width="300" />
                        <h3 class="text-xl font-bold mb-2">
                            Cloud Computing
                        </h3>
                        <p class="text-gray-700 mb-4">
                            Explore cloud services and architecture with AWS, Azure, and Google Cloud.
                        </p>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring">
                            Start Course
                        </button>
                    </div>
                    <!-- Course Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                        <img alt="Thumbnail of a DevOps course, showing a DevOps lifecycle diagram" class="w-full h-40 object-cover rounded mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/4QIDaZWXqextdiyQKGkPVUaCCHKaDpsPfUGPbDSNMYFj1I7TA.jpg" width="300" />
                        <h3 class="text-xl font-bold mb-2">
                            DevOps
                        </h3>
                        <p class="text-gray-700 mb-4">
                            Implement continuous integration and delivery pipelines with DevOps tools.
                        </p>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring">
                            Start Course
                        </button>
                    </div>
                    <!-- Course Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                        <img alt="Thumbnail of an AI &amp; Robotics course, showing a robot and AI brain" class="w-full h-40 object-cover rounded mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/A24F6vVVcW5KLpF8E4dBrDShXaPLQ66ebtABmTLKxr2tak9JA.jpg" width="300" />
                        <h3 class="text-xl font-bold mb-2">
                            AI &amp; Robotics
                        </h3>
                        <p class="text-gray-700 mb-4">
                            Build intelligent systems and robots using AI and machine learning.
                        </p>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring">
                            Start Course
                        </button>
                    </div>
                    <!-- Course Card -->
                    <div class="bg-gray-100 p-4 rounded-lg shadow transition-transform transform hover:scale-105">
                        <img alt="Thumbnail of a blockchain course, showing a blockchain network diagram" class="w-full h-40 object-cover rounded mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/sWPdvXpuV95jF14P2l8gXLtSkZZfZjhWLKharuo9vfqd1I7TA.jpg" width="300" />
                        <h3 class="text-xl font-bold mb-2">
                            Blockchain
                        </h3>
                        <p class="text-gray-700 mb-4">
                            Understand blockchain technology and develop decentralized applications.
                        </p>
                        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring">
                            Start Course
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- <script>
        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");

        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    </script> -->
    <?php include("./assets/footer_1.php") ?>
</body>

</html>