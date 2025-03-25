<?php
include("./php/all_files.php");
include("./assets/user_auth.php");

if (!$_SESSION['auth']) {
    header("location: ./index.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="icon" href="../img/brain.jpg">
    <style>
        @keyframes grow-shrink {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        .animate-grow-shrink {
            animation: grow-shrink 1.5s infinite ease-in-out;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <!-- <div id="preloader" class="fixed inset-0 flex items-center justify-center bg-gray-100 z-50">
        <img src="./img/brain.jpg" alt="Quiz Icon" class="w-16 h-16 animate-grow-shrink mb-4 rounded-full shadow-lg border-2 border-blue-400 p-1">
        <p class="text-gray-700 text-lg font-medium animate-pulse">Loading...</p>
    </div> -->

    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center">
                <!-- Logo Section -->
                <div class="flex items-center">
                    <span class="flex items-center py-3 px-6 rounded-full shadow-lg bg-gradient-to-r from-blue-600 to-blue-800">
                        <img alt="EduQuest Logo" class="w-14 h-14 rounded-full border-2 border-white shadow-sm" src="./img/brain.jpg" />
                        <span class="ml-4 text-2xl font-bold text-white">EduQuest</span>
                    </span>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button id="mobileMenuButton" aria-label="Toggle Menu" aria-expanded="false" aria-controls="mobileMenu"
                        class="mobile-menu-button focus:outline-none">
                        <i class="fas fa-bars text-gray-700 text-xl"></i>
                    </button>
                </div>

                <!-- Secondary Nav (Profile and Logout) -->
                <div class="hidden lg:flex items-center space-x-4">
                    <span class="flex items-center gap-4 py-3 px-4 rounded-lg shadow-md border border-blue-500 bg-blue-50 hover:bg-blue-100 hover:shadow-lg transition-all duration-300 ease-in-out space-x-3">
                        <span class="text-lg font-semibold text-blue-600 hover:text-blue-800">
                            <i class="fas fa-user-circle text-gray pe-2"></i><?= htmlspecialchars($user_data['username']) ?>
                        </span>
                    </span>
                    <a class="py-3 px-4 bg-red-600 text-white rounded hover:bg-red-500" href="../logout.php">
                        Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden bg-gray-800 text-white">
            <div class="px-4 py-2">
                <a href="../profile_page.php" class="block py-3 px-4 text-lg flex items-center space-x-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300">
                    <i class="fas fa-user-circle text-2xl"></i>
                    <span><?= htmlspecialchars($user_data['username']) ?></span>
                </a>
                <a href="../logout.php" class="block py-3 px-4 text-lg bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-all duration-300 mt-2">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Script -->
    <script>
        // Mobile menu toggle function
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuButton.addEventListener('click', () => {
            const expanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !expanded);
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu if clicked outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('#mobileMenuButton') && !event.target.closest('#mobileMenu')) {
                mobileMenuButton.setAttribute('aria-expanded', 'false');
                mobileMenu.classList.add('hidden');
            }
        });

        // Automatically hide preloader after page load
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            const content = document.querySelector('nav');

            setTimeout(() => {
                if (preloader) preloader.style.display = 'none'; // Hide preloader
                content.classList.remove('hidden'); // Show main content
            }, 1500); // Adjust the duration of the preloader here
        });
    </script>
</body>

</html>