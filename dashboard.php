<?php
include("./php/all_files.php");
include("./assets/user_auth.php");

if ($_SESSION['auth']) {
} else {
    header("location: ./index.php");
    die;
}

$user_data = getUser();

$user_id = $user_data['id'];
?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        EduQuest - Dashboard
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7169117931522379"
        crossorigin="anonymous"></script>
    <link rel="icon" href="./img/brain.jpg">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<!-- Floating Action Button Container -->
<?php include("./assets/fab.php"); ?>
<div id="preloader" class="fixed inset-0 flex flex-col items-center justify-center bg-gray-100 z-50">
    <!-- Icon or Logo -->
    <img src="./img/brain.jpg"
        alt="Quiz Icon"
        class="w-16 h-16 animate-grow-shrink mb-4 rounded-full shadow-lg border-2 border-blue-400 p-1">
    <!-- Loading Text -->
    <p class="text-gray-700 text-lg font-medium animate-pulse">
        Loading...
    </p>
</div>


<body class="bg-gradient-to-r from-blue-50 to-blue-100 font-roboto">

    <nav id="content" class="hidden bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <!-- Logo -->
                    <div class="flex items-center justify-center">
                        <span class="flex items-center mx-auto py-3 px-6 rounded-full shadow-lg bg-gradient-to-r from-blue-600 to-blue-800">
                            <!-- Logo Section -->
                            <img
                                alt="EduQuest Logo"
                                class="w-14 h-14 rounded-full border-2 border-white shadow-sm"
                                src="./img/brain.jpg" />
                            <!-- Brand Name -->
                            <span class="ml-4 text-2xl font-bold text-white">
                                EduQuest
                            </span>
                        </span>
                    </div>

                    <!-- Primary Nav -->
                    <div class="hidden lg:flex items-center space-x-1">
                        <a class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg" href="./dashboard.php">
                            Home
                        </a>

                        <a href="./courses.php" class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg">
                            Courses
                        </a>

                        <!-- About Dropdown -->
                        <div class="relative">
                            <!-- Dropdown Trigger -->
                            <button id="pagesDropdownButton" class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg focus:outline-none">
                                Pages
                                <i class="fas fa-chevron-down ml-2 text-sm"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="pagesDropdownMenu" class="absolute hidden bg-white shadow-lg rounded-lg mt-2 w-48 z-10 border border-gray-300">
                                <a href="./pages/about.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">About Us</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Our Team</a>
                                <a href="./pages/contact.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Contact Us</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Company History</a>
                                <a href="./videos/index.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                                    Tutorial Videos
                                </a>
                                <a href="./code_playground/playground.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                                    Code Playground
                                </a>
                            </div>
                        </div>

                        <a class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg" href="./pages/Learner_Mentor.php">
                            Mentorship
                        </a>

                        <!-- Community Link -->
                        <a class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg" href="./forum/index.php">
                            Community
                        </a>
                    </div>
                </div>

                <!-- Secondary Nav -->
                <div class="lg:flex items-center space-x-1 hidden">
                    <a href="./profile_page.php" class="flex items-center gap-4 py-3 px-4 rounded-lg shadow-md border border-blue-500 bg-blue-50 hover:bg-blue-100 hover:shadow-lg transition-all duration-300 ease-in-out space-x-3">
                        <span class="text-lg font-semibold text-blue-600 hover:text-blue-800">
                            <i class="fas fa-user-circle text-gray pe-2"></i><?= $user_data['username'] ?>
                        </span>
                    </a>
                    <a class="py-3 px-4 bg-red-600 text-white rounded hover:bg-red-500" href="./logout.php">
                        logout
                    </a>
                </div>

                <!-- Mobile Button -->
                <div class="lg:hidden flex items-center">
                    <button id="mobileMenuButton" class="mobile-menu-button">
                        <i class="fas fa-bars text-gray-700"></i>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="lg:hidden hidden mt-4 bg-white shadow-lg rounded-lg py-2">
            <a class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out" href="./dashboard.php">
                Home
            </a>

            <!-- Tutorials Dropdown -->
            <div class="relative">
                <!-- Dropdown Trigger -->
                <button onclick="toggleMobileDropdown('tutorialsDropdown')" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out focus:outline-none flex justify-between items-center">
                    Tutorials
                    <i id="tutorialsDropdownIcon" class="fas fa-chevron-down text-sm transition-transform duration-300"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="tutorialsDropdown" class="hidden pl-4">
                    <a href="./courses.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                        Courses
                    </a>
                    <a href="./videos/index.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                        Tutorial Videos
                    </a>
                    <a href="./code_playground/playground.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                        Code Playground
                    </a>
                </div>
            </div>

            <!-- Pages Dropdown -->
            <div class="relative">
                <button onclick="toggleMobileDropdown('pagesDropdown')" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out focus:outline-none">
                    Pages
                    <i class="fas fa-chevron-down float-right mt-1 text-sm"></i>
                </button>
                <div id="pagesDropdown" class="hidden pl-4">
                    <a href="./pages/about.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">About Us</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Our Team</a>
                    <a href="./pages/contact.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Contact Us</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Company History</a>
                </div>
            </div>

            <a class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out" href="./pages/Learner_Mentor.php">
                Mentorship
            </a>

            <a class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out" href="./forum/index.php">
                Community
            </a>

            <!-- Secondary Nav (Mobile) -->
            <div class="mt-4 border-t border-gray-200 pt-2">
                <a href="./profile_page.php" class="block bg-blue-600 px-4 py-2 text-white hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                    <i class="fas fa-user-circle text-gray pe-2"></i><?= $user_data['username'] ?>
                </a>
                <a class="block bg-red-600 px-4 py-2 text-white hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out" href="./logout.php">
                    Logout
                </a>
            </div>
        </div>

    </nav>


    <section class="relative bg-blue-600 text-white">
        <img
            alt="A group of diverse people learning programming together on laptops and whiteboards"
            class="w-full h-full object-cover opacity-50"
            height="600"
            src="https://storage.googleapis.com/a1aa/image/No3oX7jKvuLnIV1FCeUVehk76jVj2MJcf09uYTPY2KbwrM3nA.jpg"
            width="1920" />
        <div class="absolute inset-0 flex flex-col justify-center items-center text-center p-5">
            <lottie-player src="./lottie/cap.json" background="transparent" speed="0.5" loop autoplay style="width: 150px; height: 150px;"></lottie-player>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight">
                Master Programming with Our Expert-Led Courses
            </h1>
            <p class="mt-4 text-base md:text-lg lg:text-xl leading-relaxed max-w-[64%]">
                Join thousands of learners and start your journey to becoming a programming expert. Our courses are designed to be engaging, interactive, and comprehensive.
            </p>

            <a class="mt-6 px-6 py-3 bg-white text-blue-600 font-bold rounded-full hover:bg-gray-200" href="./courses.php">
                Get Started
            </a>
        </div>
    </section>

    <section class="bg-white py-10">
        <div class="container mx-auto">
            <div class="flex flex-col justify-center items-center text-center p-5">
                <lottie-player
                    src="./lottie/books_and_cap.json"
                    background="transparent"
                    speed="1.5"
                    style="width: 50px; height: 50px;"
                    loop
                    autoplay>
                </lottie-player>
                <h2 class="text-3xl font-bold text-center mb-6 relative">
                    Our <span class="relative inline-block">
                        Popular
                        <span class="block w-full h-1 bg-gray-900 rounded-full mt-0.5"></span>
                    </span> Courses
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-gray-100 p-5 rounded shadow">
                    <img alt="A person working on a data analysis project with charts and graphs on the screen" class="mb-4 w-full h-auto" src="https://storage.googleapis.com/a1aa/image/hUTFf7AVTxSrPq9PejefX5XQtDee3RxUYeXSYkfp3RWwzVm7TA.jpg" />
                    <h3 class="text-xl font-bold mb-2">Web Development</h3>
                    <p class="mb-4 text-sm md:text-base">
                        Learn to build modern, responsive websites using HTML, CSS, and JavaScript.
                    </p>
                    <a class="text-blue-600 hover:underline text-sm md:text-base" href="./courses.php">Learn More</a>
                </div>
                <div class="bg-gray-100 p-5 rounded shadow">
                    <img alt="A person working on a data analysis project with charts and graphs on the screen" class="mb-4 w-full h-auto" src="https://storage.googleapis.com/a1aa/image/UrfdtoEbKXQQH6EuH8fnGzPqtzzVEVjzpqdApxDuUw62Vm7TA.jpg" />
                    <h3 class="text-xl font-bold mb-2">Data Science</h3>
                    <p class="mb-4 text-sm md:text-base">
                        Master data analysis, visualization, and machine learning with Python.
                    </p>
                    <a class="text-blue-600 hover:underline text-sm md:text-base" href="./courses.php">Learn More</a>
                </div>
                <div class="bg-gray-100 p-5 rounded shadow">
                    <img alt="A person developing a mobile app with code and design tools on the screen" class="mb-4 w-full h-auto" src="https://storage.googleapis.com/a1aa/image/EbQGP7agl0rZA9TpIzW4k25HlhaonGfGgVelVSzvSf9krM3nA.jpg" />
                    <h3 class="text-xl font-bold mb-2">Mobile Development</h3>
                    <p class="mb-4 text-sm md:text-base">
                        Create stunning mobile applications for Android and iOS using Flutter and React Native.
                    </p>
                    <a class="text-blue-600 hover:underline text-sm md:text-base" href="./courses.php">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-600 text-white py-10">
        <div class="container mx-auto">
            <div class="flex flex-col justify-center items-center text-center p-5">

                <lottie-player
                    src="./lottie/books_and_cap.json"
                    background="transparent"
                    speed="1.5"
                    style="width: 50px; height: 50px;"
                    loop
                    autoplay>
                </lottie-player>
                <h2 class="text-3xl font-bold text-center mb-6 relative">
                    Why <span class="relative inline-block">
                        Choose
                        <span class="block w-full h-1 bg-white rounded-full mt-0.5"></span>
                    </span> Us?
                </h2>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <i class="fas fa-chalkboard-teacher text-4xl mb-4">
                    </i>
                    <h3 class="text-xl font-bold mb-2">
                        Expert Instructors
                    </h3>
                    <p>
                        Learn from industry experts with years of experience in their fields.
                    </p>
                </div>
                <div class="text-center">
                    <i class="fas fa-laptop-code text-4xl mb-4">
                    </i>
                    <h3 class="text-xl font-bold mb-2">
                        Hands-On Learning
                    </h3>
                    <p>
                        Engage in interactive projects and real-world scenarios to apply your knowledge.
                    </p>
                </div>
                <div class="text-center">
                    <i class="fas fa-certificate text-4xl mb-4">
                    </i>
                    <h3 class="text-xl font-bold mb-2">
                        Certification
                    </h3>
                    <p>
                        Earn certificates to showcase your skills and advance your career.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">
        <div class="flex flex-col justify-center items-center text-center p-5">
            <lottie-player
                src="./lottie/books_and_cap.json"
                background="transparent"
                speed="1.5"
                style="width: 50px; height: 50px;"
                loop
                autoplay>
            </lottie-player>
            <h2 class="text-3xl font-bold text-center mb-6 relative">
                What <span class="relative inline-block">
                    Our Students
                    <span class="block w-full h-1 bg-gray-900 rounded-full mt-0.5"></span>
                </span> Say
            </h2>

        </div>

        <div class="reviews-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Reviews will be injected here by AJAX -->
        </div>
        <a href="./pages/reviews_page.php"
            class="inline-block px-6 py-3 mt-4 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 
                    focus:outline-none focus:ring-2 focus:ring-blue-400">More</a>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/fab.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script>
        // Function to fetch reviews and display them
        function fetchReviews() {
            $.ajax({
                type: "GET",
                url: "./assets/reviews.php", // Path to the reviews.php script
                success: function(response) {
                    const reviews = JSON.parse(response);

                    if (reviews.length === 0) {
                        // No reviews found
                        $(".reviews-container").html("<p>No reviews yet.</p>");
                    } else {
                        let reviewsHtml = "";
                        reviews.forEach((review) => {
                            // Build the HTML structure for each review
                            reviewsHtml += `
                        <div class="bg-gray-100 p-4 rounded-lg flex flex-col items-center text-center">
                            <div class="flex flex-col items-center mb-2">
                                
                                <div>
                                    <div 
            class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-500 text-white font-bold ms-4 mr-3"
            style="font-size: 1rem;"
        >
            ${review.name.charAt(0).toUpperCase()}
        </div>
                                    <p class="text-xs text-gray-500">${review.created_at}</p>
                                </div>
                            </div>
                            <p class="font-normal text-base">"${review.message}"</p>
                            <div class="flex items-center mt-4 mb-2 text-xl">
                                ${getStars(review.rating)}
                            </div>
                        </div>

                        `;
                        });

                        // Insert the reviews into the page
                        $(".reviews-container").html(reviewsHtml);
                    }
                },
                error: function() {
                    $(".reviews-container").html('<div class="bg-red-500 text-white p-3 rounded">An error occurred while fetching reviews.</div>');
                }
            });
        }

        // Function to render the stars based on rating
        function getStars(rating) {
            let starsHtml = "";
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    starsHtml += '<i class="fas fa-star text-yellow-500"></i>';
                } else {
                    starsHtml += '<i class="far fa-star text-yellow-500"></i>';
                }
            }
            return starsHtml;
        }

        // Call fetchReviews when the page loads
        $(document).ready(function() {
            fetchReviews();
        });





        // Dropdown toggle function
        const pagesDropdownButton = document.getElementById('pagesDropdownButton');
        const pagesDropdownMenu = document.getElementById('pagesDropdownMenu');

        pagesDropdownButton.addEventListener('click', () => {
            pagesDropdownMenu.classList.toggle('hidden'); // Toggle the dropdown visibility
        });

        // Close the dropdown if clicked outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.relative')) {
                pagesDropdownMenu.classList.add('hidden');
            }
        });

        // function toggleDropdown() {
        //     const dropdownMenu = document.getElementById('dropdownMenu');
        //     dropdownMenu.classList.toggle('hidden');
        // }

        function toggleDropdown() {
            console.log('Dropdown Toggled'); // Debugging log
            const dropdownMenu = document.getElementById('dropdownMenu');
            console.log('Dropdown Menu:', dropdownMenu); // Debugging log
            dropdownMenu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            const dropdown = document.getElementById('dropdown');
            if (!dropdown.contains(event.target)) {
                const dropdownMenu = document.getElementById('dropdownMenu');
                dropdownMenu.classList.add('hidden');
            }
        });

        // Mobile menu toggle function
        // Toggle Mobile Menu
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Toggle Mobile Dropdown
        function toggleMobileDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const dropdownIcon = document.getElementById(`${dropdownId}Icon`);

            // Toggle dropdown visibility
            dropdown.classList.toggle('hidden');

            // Rotate chevron icon
            if (dropdownIcon) {
                dropdownIcon.classList.toggle('rotate-180');
            }
        }


        // JavaScript to hide preloader after the page loads
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            const content = document.getElementById('content');

            setTimeout(() => {
                preloader.style.display = 'none'; // Hide preloader
                content.classList.remove('hidden'); // Show main content
            }, 1500); // Adjust the duration of the preloader here
        });
    </script>

    <?php include("./assets/footer_1.php") ?>
</body>

</html>