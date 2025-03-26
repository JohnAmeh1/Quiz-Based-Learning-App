<?php
include("./php/all_files.php");
include("./assets/user_auth.php");

if ($_SESSION['auth']) {
} else {
    header("location: ../index.php");
    die;
}

$user_data = getUser();

$user_id = $user_data['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="icon" href="../img/brain.jpg">
    <style>
        @keyframes grow-shrink {

            0%,
            100% {
                transform: scale(1);
                /* Normal size */
            }

            50% {
                transform: scale(1.2);
                /* Grow */
            }
        }

        .animate-grow-shrink {
            animation: grow-shrink 1.5s infinite ease-in-out;
        }
    </style>
</head>

<body>
    <div id="preloader" class="fixed inset-0 flex flex-col items-center justify-center bg-gray-100 z-50">
        <!-- Icon or Logo -->
        <img src="../img/brain.jpg"
            alt="Quiz Icon"
            class="w-16 h-16 animate-grow-shrink mb-4 rounded-full shadow-lg border-2 border-blue-400 p-1">
        <!-- Loading Text -->
        <p class="text-gray-700 text-lg font-medium animate-pulse">
            Loading...
        </p>
    </div>
    <nav id="content" class="hidden bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
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
                        <a class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg" href="../dashboard.php">
                            Home
                        </a>

                        <!-- Courses Link -->
                        <div class="relative" id="dropdown">
                            <!-- Dropdown Trigger -->
                            <button onclick="toggleDropdown()" class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg focus:outline-none">
                                Tutorials
                                <i class="fas fa-chevron-down ml-2 text-sm"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="dropdownMenu" class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-lg py-2 hidden">
                                <a href="../courses.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                                    Courses
                                </a>
                                <a href="../videos/index.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                                    Tutorial Videos
                                </a>
                                <a href="../code_playground/playground.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                                    Code Playground
                                </a>
                            </div>
                        </div>
                        <!-- About Dropdown -->
                        <div class="relative">
                            <!-- Dropdown Trigger -->
                            <button id="pagesDropdownButton" class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg focus:outline-none">
                                Pages
                                <i class="fas fa-chevron-down ml-2 text-sm"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="pagesDropdownMenu" class="absolute hidden bg-white shadow-lg rounded-lg mt-2 w-48 z-10 border border-gray-300">
                                <a href="./about.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">About Us</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Our Team</a>
                                <a href="./contact.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Contact Us</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Company History</a>
                            </div>
                        </div>

                        <a class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg" href="./Learner_Mentor.php">
                            Mentorship
                        </a>

                        <!-- Community Link -->
                        <a class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg" href="../forum/index.php">
                            Community
                        </a>
                    </div>
                </div>

                <!-- Secondary Nav -->
                <div class="lg:flex items-center space-x-1 hidden">
                    <a href="../profile_page.php" class="flex items-center gap-4 py-3 px-4 rounded-lg shadow-md border border-blue-500 bg-blue-50 hover:bg-blue-100 hover:shadow-lg transition-all duration-300 ease-in-out space-x-3">
                        <span class="text-lg font-semibold text-blue-600 hover:text-blue-800">
                            <i class="fas fa-user-circle text-gray pe-2"></i><?= $user_data['username'] ?>
                        </span>
                    </a>
                    <a class="py-3 px-4 bg-red-600 text-white rounded hover:bg-red-500" href="../logout.php">
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
            <a class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out" href="../dashboard.php">
                Home
            </a>

            <!-- Tutorials Dropdown -->
            <div class="relative">
                <button onclick="toggleMobileDropdown('tutorialsDropdown')" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out focus:outline-none">
                    Tutorials
                    <i class="fas fa-chevron-down float-right mt-1 text-sm"></i>
                </button>
                <div id="tutorialsDropdown" class="hidden pl-4">
                    <a href="../courses.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                        Courses
                    </a>
                    <a href="../videos/index.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                        Tutorial Videos
                    </a>
                    <a href="../code_playground/playground.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
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
                    <a href="./about.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">About Us</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Our Team</a>
                    <a href="./pages/contact.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Contact Us</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">Company History</a>
                </div>
            </div>

            <a class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out" href="./Learner_Mentor.php">
                Mentorship
            </a>

            <a class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out" href="../forum/index.php">
                Community
            </a>

            <!-- Secondary Nav (Mobile) -->
            <div class="mt-4 border-t border-gray-200 pt-2">
                <a href="../profile_page.php" class="block bg-blue-600 px-4 py-2 text-white hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out">
                    <i class="fas fa-user-circle text-gray pe-2"></i><?= $user_data['username'] ?>
                </a>
                <a class="block bg-red-600 px-4 py-2 text-white hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 ease-in-out" href="../logout.php">
                    Logout
                </a>
            </div>
        </div>

    </nav>

    <script>
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

        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
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

        // Toggle Mobile Dropdowns
        function toggleMobileDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }

        // Close Mobile Menu When Clicking Outside
        document.addEventListener('click', (event) => {
            if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
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

</body>

</html>