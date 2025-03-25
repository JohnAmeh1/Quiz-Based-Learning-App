<!-- Setup YouTube API
Get a YouTube API Key:

Go to the Google Cloud Console.

Create a new project.

Enable the YouTube Data API v3.

Generate an API key.

Restrict the API Key:

Restrict the API key to only allow requests from your domain and to the YouTube Data API. -->
<?php
include("./assets/header_1.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduQuest - Tutorial Videos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<?php include("./assets/fab.php"); ?>

<body class="bg-gray-50 font-sans">

    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
    <!-- <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div> -->

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed md:relative w-72 bg-white h-screen shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50 overflow-y-auto">
            <div class="p-6">
                <button id="sidebarClose" class="md:hidden absolute top-4 right-4 text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
                <div class="flex items-center space-x-2 mb-8">
                    <i class="fas fa-code text-blue-600 text-2xl"></i>
                    <h2 class="text-xl font-bold text-gray-800">Programming Hub</h2>
                </div>

                <div class="mb-6">
                    <h3 class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">Popular Topics</h3>
                    <ul>
                        <li class="mb-1">
                            <a href="videos.php?lang=JavaScript" class="w-full text-left py-2 px-3 hover:bg-blue-50 hover:text-blue-600 rounded-md flex items-center transition-colors">
                                <i class="fab fa-js-square text-yellow-500 mr-3"></i>
                                JavaScript
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="videos.php?lang=Python" class="w-full text-left py-2 px-3 hover:bg-blue-50 hover:text-blue-600 rounded-md flex items-center transition-colors">
                                <i class="fab fa-python text-blue-500 mr-3"></i>
                                Python
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="videos.php?lang=PHP" class="w-full text-left py-2 px-3 hover:bg-blue-50 hover:text-blue-600 rounded-md flex items-center transition-colors">
                                <i class="fab fa-php text-purple-500 mr-3"></i>
                                PHP
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="videos.php?lang=Java" class="w-full text-left py-2 px-3 hover:bg-blue-50 hover:text-blue-600 rounded-md flex items-center transition-colors">
                                <i class="fab fa-java text-red-500 mr-3"></i>
                                Java
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="videos.php?lang=C" class="w-full text-left py-2 px-3 hover:bg-blue-50 hover:text-blue-600 rounded-md flex items-center transition-colors">
                                <i class="fas fa-code text-green-500 mr-3"></i>
                                C
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">Additional Resources</h3>
                    <ul>
                        <!-- <li class="mb-1">
                            <a href="#" class="w-full text-left py-2 px-3 hover:bg-blue-50 hover:text-blue-600 rounded-md flex items-center transition-colors">
                                <i class="fas fa-book mr-3 text-gray-500"></i>
                                Documentation
                            </a>
                        </li> -->
                        <li class="mb-1">
                            <a href="../forum/index.php" class="w-full text-left py-2 px-3 hover:bg-blue-50 hover:text-blue-600 rounded-md flex items-center transition-colors">
                                <i class="fas fa-users mr-3 text-gray-500"></i>
                                Community
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="../courses.php" class="w-full text-left py-2 px-3 hover:bg-blue-50 hover:text-blue-600 rounded-md flex items-center transition-colors">
                                <i class="fas fa-graduation-cap mr-3 text-gray-500"></i>
                                Tutorials
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-h-screen overflow-y-auto mt-5 mb-5">
            <button id="sidebarToggle" class="md:hidden p-2 fixed top-18 right-4 z-50 text-gray-900 bg-white hover:text-gray-800 rounded-md border border-2 rounded-full hover:bg-gray-100 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <!-- Search Bar -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-6">
                <div class="container mx-auto px-4 py-12">
                    <h2 class="text-3xl font-bold mb-2">Discover the Best Programming Videos</h2>
                    <p class="text-blue-100 mb-6">Learn from industry experts and enhance your coding skills</p>
                    <div class="relative max-w-2xl mx-auto">
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search for programming languages, frameworks, or topics..."
                            class="w-full p-4 pl-12 pr-16 rounded-lg shadow-lg focus:outline-none text-gray-800" />
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <button
                            id="searchButton"
                            class="absolute inset-y-0 right-0 px-6 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 transition-colors flex items-center">
                            <i class="fas fa-search text-gray-400"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Featured Categories -->
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-wrap -mx-2 mb-8">
                    <div class="w-full md:w-1/4 px-2 mb-4">
                        <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 text-white rounded-lg shadow-md p-4 h-full flex flex-col justify-between transition-transform hover:scale-105">
                            <div>
                                <i class="fab fa-js-square text-4xl mb-2"></i>
                                <h3 class="font-bold text-xl">JavaScript</h3>
                                <p class="text-yellow-100 text-sm">Frontend & Backend tutorials</p>
                            </div>
                            <a href="videos.php?lang=JavaScript" class="mt-4 bg-white text-yellow-500 rounded-md py-1 px-3 text-sm font-medium hover:bg-yellow-100 transition-colors">
                                Explore
                            </a>
                        </div>
                    </div>
                    <div class="w-full md:w-1/4 px-2 mb-4">
                        <div class="bg-gradient-to-br from-blue-400 to-blue-600 text-white rounded-lg shadow-md p-4 h-full flex flex-col justify-between transition-transform hover:scale-105">
                            <div>
                                <i class="fab fa-python text-4xl mb-2"></i>
                                <h3 class="font-bold text-xl">Python</h3>
                                <p class="text-blue-100 text-sm">Data Science & Web Dev</p>
                            </div>
                            <a href="videos.php?lang=Python" class="mt-4 bg-white text-blue-500 rounded-md py-1 px-3 text-sm font-medium hover:bg-blue-100 transition-colors">
                                Explore
                            </a>
                        </div>
                    </div>
                    <div class="w-full md:w-1/4 px-2 mb-4">
                        <div class="bg-gradient-to-br from-purple-400 to-purple-600 text-white rounded-lg shadow-md p-4 h-full flex flex-col justify-between transition-transform hover:scale-105">
                            <div>
                                <i class="fab fa-php text-4xl mb-2"></i>
                                <h3 class="font-bold text-xl">PHP</h3>
                                <p class="text-purple-100 text-sm">Backend & WordPress</p>
                            </div>
                            <a href="videos.php?lang=PHP" class="mt-4 bg-white text-purple-500 rounded-md py-1 px-3 text-sm font-medium hover:bg-purple-100 transition-colors">
                                Explore
                            </a>
                        </div>
                    </div>
                    <div class="w-full md:w-1/4 px-2 mb-4">
                        <div class="bg-gradient-to-br from-green-400 to-green-600 text-white rounded-lg shadow-md p-4 h-full flex flex-col justify-between transition-transform hover:scale-105">
                            <div>
                                <i class="fas fa-code text-4xl mb-2"></i>
                                <h3 class="font-bold text-xl">C</h3>
                                <p class="text-green-100 text-sm">Game Dev & Systems</p>
                            </div>
                            <a href="videos.php?lang=C" class="mt-4 bg-white text-green-500 rounded-md py-1 px-3 text-sm font-medium hover:bg-green-100 transition-colors">
                                Explore
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Grid -->
            <div class="container mx-auto px-4 pb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Popular Videos</h2>
                    <!-- <div>
                        <select class="border rounded-md px-3 py-1 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option>Most Popular</option>
                            <option>Newest</option>
                            <option>Highest Rated</option>
                        </select>
                    </div> -->
                </div>

                <div id="videoGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Videos will be dynamically loaded here -->
                </div>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/fab.js"></script>

</body>

</html>