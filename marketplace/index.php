<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduQuest - Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        #upload-form-container {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .hidden {
            opacity: 0;
            transform: translateY(-20px);
            pointer-events: none;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-gray-800">EduQuest</div>
                <div class="flex space-x-4 items-center">
                    <a href="#" class="text-gray-700 hover:text-blue-600">Home</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Templates</a>

                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-6">
        <button id="toggle-form-button" class="text-gray-700 hover:text-blue-600 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Code Templates Marketplace</h1>

        <!-- Upload Form (Toggleable) -->
        <div id="upload-form-container" class="hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Upload Your Code Template</h2>
                <form id="upload-form">
                    <div id="response-message" class="my-4"></div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input type="text" name="title" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" rows="4" required></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Code Template (ZIP)</label>
                            <input type="file" name="code_template" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail Image</label>
                            <input type="file" name="thumbnail" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Screenshot 1</label>
                            <input type="file" name="screenshot1" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Screenshot 2</label>
                            <input type="file" name="screenshot2" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Screenshot 3</label>
                            <input type="file" name="screenshot3" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <button type="submit" class="mt-6 w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-300">Upload Template</button>
                </form>
            </div>
        </div>

        <!-- Available Templates Section -->
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Available Templates</h2>
        <div id="templates-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Templates will be dynamically loaded here -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white shadow-lg mt-12">
        <div class="container mx-auto px-6 py-4">
            <div class="text-center text-gray-600">
                &copy; 2023 EduQuest. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Toggle Form Visibility
        const toggleFormButton = document.getElementById('toggle-form-button');
        const uploadFormContainer = document.getElementById('upload-form-container');

        toggleFormButton.addEventListener('click', () => {
            uploadFormContainer.classList.toggle('hidden');
        });
    </script>
    <script src="./main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>