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
    <link rel="icon" href="./img/brain.jpg">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <footer class="bg-gray-800 text-white p-4 py-10 mt-10">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <h3 class="text-xl font-bold mb-4">
                    EduQuest
                </h3>
                <p>
                    Join thousands of learners and start your journey to becoming a programming expert.
                    Our courses are designed to be engaging, interactive, and comprehensive.
                </p>
                <button id="toTopButton"
                    class="fixed bottom-4 left-4 p-5 inline-block px-6 py-3 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 transition-transform transform hover:scale-105 
                    focus:outline-none focus:ring-2 focus:ring-blue-400">
                    ↑
                </button>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">
                    Quick Links
                </h3>
                <ul>
                    <li class="mb-2">
                        <a class="hover:underline" href="../dashboard.php">
                            Home
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="hover:underline" href="../courses.php">
                            Courses
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="hover:underline" href="../pages/about.php">
                            About
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="hover:underline" href="./pages/reviews_page.php">
                            Leave a review
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">
                    Resources
                </h3>
                <ul>
                    <li class="mb-2">
                        <a class="hover:underline" href="#">
                            Blog
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="hover:underline" href="#">
                            FAQs
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="hover:underline" href="../pages/contact.php">
                            Contact Support
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="hover:underline" href="#">
                            Privacy Policy
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">
                    Follow Us
                </h3>
                <div class="flex space-x-4">
                    <a class="hover:text-gray-400" href="#">
                        <i class="fab fa-facebook-f">
                        </i>
                    </a>
                    <a class="hover:text-gray-400" href="#">
                        <i class="fab fa-twitter">
                        </i>
                    </a>
                    <a class="hover:text-gray-400" href="#">
                        <i class="fab fa-linkedin-in">
                        </i>
                    </a>
                    <a class="hover:text-gray-400" href="#">
                        <i class="fab fa-instagram">
                        </i>
                    </a>
                </div>
            </div>
        </div>
        <div class="container mx-auto text-center mt-10">
            <p>
                © 2024 EduQuest. All rights reserved.
            </p>
        </div>
    </footer>
    <script>
        // Scroll to top function
        const toTopButton = document.getElementById("toTopButton");
        toTopButton.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });

        // Show or hide the button based on scroll position
        window.addEventListener("scroll", () => {
            if (window.scrollY > 200) {
                toTopButton.style.display = "block";
            } else {
                toTopButton.style.display = "none";
            }
        });

        // Initially hide the button
        toTopButton.style.display = "none";
    </script>
</body>

</html>