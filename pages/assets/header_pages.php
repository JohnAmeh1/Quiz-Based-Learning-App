<?php
include("./php/all_files.php");
include("./assets/user_auth.php");

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
</head>

<body>
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <!-- Logo -->
                    <div>
                        <a class="flex items-center py-5 px-2 text-gray-700 hover:text-gray-900" href="">
                            <img alt="Logo of the website" class="h-8 mr-2" height="20" src="./img/eduquest-sololearn-inspired.jpg" width="300" />
                        </a>
                    </div>
                    <!-- Primary Nav -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a class="py-5 px-3 text-gray-700 hover:text-gray-900" href="../dashboard.php">
                            Home
                        </a>

                        <a class="py-5 px-3 text-gray-700 hover:text-gray-900" href="../courses.php">
                            Courses
                        </a>
                        <!-- About Dropdown -->
                        <div class="relative">
                            <button id="pagesDropdownButton" class="py-5 px-3 text-gray-700 hover:text-gray-900 focus:outline-none">
                                pages
                                <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                            <div id="pagesDropdownMenu" class="absolute hidden bg-white shadow-lg rounded-lg mt-2 w-48 z-10 border border-gray-300">
                                <a href="./about.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">About Us</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Our Team</a>
                                <a href="./contact.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Contact Us</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Company History</a>
                            </div>
                        </div>

                        <a class="py-5 px-3 text-gray-700 hover:text-gray-900" href="Learner_Mentor.php">
                            Connect With Mentor
                        </a>
                        <a class="py-5 px-3 text-gray-700 hover:text-gray-900" href="../forum/index.php">
                            Commmunity
                        </a>
                    </div>
                </div>

                <!-- Secondary Nav -->
                <div class="md:flex items-center space-x-1 hidden">
                    <a class="py-2 px-3 bg-blue-500 text-white rounded hover:bg-blue-400" href="../logout.php">
                        logout
                    </a>
                    <a href="../profile_page.php" class="border-2 border-gray-300 rounded-lg hover:bg-gray-400 p-2 py-2 px-3 text-gray hover:text-white-400">
                        <i class="fas fa-user-circle text-gray pe-2"></i><?= $user_data['username'] ?>
                    </a>
                </div>

                <!-- Mobile Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobileMenuButton" class="mobile-menu-button">
                        <i class="fas fa-bars text-gray-700"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="mobile-menu hidden md:hidden">
            <a class="block py-2 px-4 text-sm hover:bg-gray-200" href="../dashboard.php">
                Home
            </a>
            <a class="block py-2 px-4 text-sm hover:bg-gray-200" href="../courses.php">
                Courses
            </a>

            <div class="relative block px-2 text-sm hover:bg-gray-200">
                <button id="pagesDropdownButton" class="py-5 px-3 text-gray-700 hover:text-gray-900 focus:outline-none">
                    pages
                    <i class="fas fa-chevron-down ml-2"></i>
                </button>
                <div id="pagesDropdownMenu" class="absolute hidden bg-white shadow-lg rounded-lg mt-2 w-48 z-10 border border-gray-300">
                    <a href="./about.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">About Us</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Our Team</a>
                    <a href="./contact.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Contact Us</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Company History</a>
                </div>
            </div>

            <a class="block py-2 px-4 text-sm hover:bg-gray-200" href="../learner_mentor.php">
                Connect With Mentor
            </a>
            <a class="block py-2 px-4 text-sm hover:bg-gray-200" href="../forum/index.php">
                Community
            </a>
            <a class="block py-2 px-4 text-sm hover:bg-gray-200" href="../logout.php">
                logout
            </a>
            <a href="../profile_page.php" class="block py-2 px-4 text-sm hover:bg-gray-200">
                Profile
                <i class="fas fa-user-circle text-gray pe-2"></i><?= $user_data['username'] ?>
            </a>
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

        // Mobile menu toggle function
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden'); // Toggle mobile menu visibility
        });

        // Close mobile menu if clicked outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('#mobileMenuButton') && !event.target.closest('#mobileMenu')) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>

</body>

</html>