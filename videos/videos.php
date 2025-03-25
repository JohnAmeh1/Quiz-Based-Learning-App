<?php
include("./assets/header_1.php");
$lang = $_GET['lang'] ?? 'JavaScript'; // Default to JavaScript if no language is specified
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($lang) ?> Videos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans">
    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

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
        <main class="flex-1 flex flex-col min-h-screen overflow-y-auto mt-5">
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="container mx-auto px-4">
                    <div class="flex justify-between items-center py-4">
                        <div class="flex items-center">
                            <button id="sidebarToggle" class="md:hidden p-2 mr-3 text-gray-600 hover:text-gray-800 rounded-md hover:bg-gray-100 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <h1 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($lang) ?> Videos</h1>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Video Grid -->
            <div class="container mx-auto px-4 pb-8">
                <div id="videoGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Videos will be dynamically loaded here -->
                </div>
            </div>
        </main>
    </div>

    <script>
        // Sidebar toggle for mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarClose = document.getElementById('sidebarClose'); // New close button

        // Toggle sidebar on button click
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });

        // Hide sidebar when overlay is clicked
        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        // Hide sidebar when close button is clicked
        sidebarClose.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        // Fetch videos for the selected language
        const fetchVideos = async (query) => {
            try {
                const response = await fetch(`api.php?query=${encodeURIComponent(query)}`);
                const data = await response.json();

                if (data.error) {
                    videoGrid.innerHTML = `<p class="text-red-500">${data.error}</p>`;
                    return;
                }

                // Clear previous videos
                videoGrid.innerHTML = "";

                // Display new videos
                data.items.forEach((item) => {
                    // Use the medium thumbnail if available, otherwise fall back to the default thumbnail
                    const thumbnailUrl = item.snippet.thumbnails.medium?.url || item.snippet.thumbnails.default.url;

                    const videoCard = `
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:shadow-lg">
                    
                    <img src="${thumbnailUrl}" alt="${item.snippet.title}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">${item.snippet.title}</h3>
                        <p class="text-gray-600 text-sm mb-2">${item.snippet.description}</p>
                        <a
                            href="https://www.youtube.com/watch?v=${item.id.videoId}"
                            target="_blank"
                            class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800"
                        >
                            Watch Video
                        </a>
                    </div>
                </div>
            `;

                    videoGrid.innerHTML += videoCard;
                });
            } catch (error) {
                console.error('Error fetching videos:', error);
                videoGrid.innerHTML = `<p class="text-red-500">Failed to load videos. Please try again later.</p>`;
            }
        };

        // Initial load with default query
        const lang = "<?= $lang ?>";
        fetchVideos(lang);
    </script>
</body>

</html>