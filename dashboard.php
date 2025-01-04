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

<body class="bg-gradient-to-r from-blue-50 to-blue-100 font-roboto">
    <?php include("./assets/header_1.php") ?>
    <section class="relative bg-blue-600 text-white">
        <img
            alt="A group of diverse people learning programming together on laptops and whiteboards"
            class="w-full h-full object-cover opacity-50"
            height="600"
            src="https://storage.googleapis.com/a1aa/image/No3oX7jKvuLnIV1FCeUVehk76jVj2MJcf09uYTPY2KbwrM3nA.jpg"
            width="1920" />
        <div class="absolute inset-0 flex flex-col justify-center items-center text-center p-5">
            <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_uaxzlx1d.json" background="transparent" speed="1" loop autoplay style="width: 200px; height: 200px;"></lottie-player>
            <h1 class="text-4xl md:text-6xl font-bold">Master Programming with Our Expert-Led Courses</h1>
            <p class="mt-4 text-lg md:text-2xl">
                Join thousands of learners and start your journey to becoming a programming expert. Our courses are designed to be engaging, interactive, and comprehensive.
            </p>
            <a class="mt-6 px-6 py-3 bg-white text-blue-600 font-bold rounded-full hover:bg-gray-200" href="./courses.php">
                Get Started
            </a>
        </div>
    </section>

    <section class="bg-white py-10">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-6">
                Our Popular Courses
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-gray-100 p-5 rounded shadow">
                    <img alt="A person working on a data analysis project with charts and graphs on the screen" class="mb-4 w-full h-auto" src="https://storage.googleapis.com/a1aa/image/hUTFf7AVTxSrPq9PejefX5XQtDee3RxUYeXSYkfp3RWwzVm7TA.jpg" />
                    <h3 class="text-xl font-bold mb-2">Web Development</h3>
                    <p class="mb-4 text-sm md:text-base">
                        Learn to build modern, responsive websites using HTML, CSS, and JavaScript.
                    </p>
                    <a class="text-blue-600 hover:underline text-sm md:text-base" href="#">Learn More</a>
                </div>
                <div class="bg-gray-100 p-5 rounded shadow">
                    <img alt="A person working on a data analysis project with charts and graphs on the screen" class="mb-4 w-full h-auto" src="https://storage.googleapis.com/a1aa/image/UrfdtoEbKXQQH6EuH8fnGzPqtzzVEVjzpqdApxDuUw62Vm7TA.jpg" />
                    <h3 class="text-xl font-bold mb-2">Data Science</h3>
                    <p class="mb-4 text-sm md:text-base">
                        Master data analysis, visualization, and machine learning with Python.
                    </p>
                    <a class="text-blue-600 hover:underline text-sm md:text-base" href="#">Learn More</a>
                </div>
                <div class="bg-gray-100 p-5 rounded shadow">
                    <img alt="A person developing a mobile app with code and design tools on the screen" class="mb-4 w-full h-auto" src="https://storage.googleapis.com/a1aa/image/EbQGP7agl0rZA9TpIzW4k25HlhaonGfGgVelVSzvSf9krM3nA.jpg" />
                    <h3 class="text-xl font-bold mb-2">Mobile Development</h3>
                    <p class="mb-4 text-sm md:text-base">
                        Create stunning mobile applications for Android and iOS using Flutter and React Native.
                    </p>
                    <a class="text-blue-600 hover:underline text-sm md:text-base" href="#">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-600 text-white py-10">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-6">
                Why Choose Us?
            </h2>
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
    <!-- <section class="container mx-auto py-10">
        <h2 class="text-3xl font-bold text-center mb-6">
            What Our Students Say
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-100 p-5 rounded shadow">
                <img alt="Portrait of a happy student giving a thumbs up" class="w-16 h-16 rounded-full mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/EwiQcTeSwR34MCMoI7OAkLWRZ70u15dqReJewejqd2QVXZuPB.jpg" width="100" />
                <p class="italic mb-4">
                    "This platform has transformed my career. The courses are well-structured and the instructors are amazing!"
                </p>
                <p class="font-bold text-center">
                    - Jane Doe
                </p>
            </div>
            <div class="bg-gray-100 p-5 rounded shadow">
                <img alt="Portrait of a smiling student with a laptop" class="w-16 h-16 rounded-full mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/LoM6cuhw2EaLCNClR8NL0Q9YbGI1Z1BVOSaf9ssIIhe5Vm7TA.jpg" width="100" />
                <p class="italic mb-4">
                    "I love the hands-on projects. They really help me understand the concepts better."
                </p>
                <p class="font-bold text-center">
                    - John Smith
                </p>
            </div>
            <div class="bg-gray-100 p-5 rounded shadow">
                <img alt="Portrait of a student holding a certificate" class="w-16 h-16 rounded-full mx-auto mb-4" height="100" src="https://storage.googleapis.com/a1aa/image/ThFCZnhQMO4lKNqH2pHzhxVeYHoqneR0uOOXGOlGPyk0Vm7TA.jpg" width="100" />
                <p class="italic mb-4">
                    "The certification has helped me land my dream job. Highly recommend this platform!"
                </p>
                <p class="font-bold text-center">
                    - Emily Johnson
                </p>
            </div>
        </div>
    </section> -->

    <!-- Reviews Section -->
    <section class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">

        <h2 class="text-3xl font-bold text-center mb-6">
            What Our Students Say
        </h2>
        <div class="reviews-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Reviews will be injected here by AJAX -->
        </div>
        <a href="./pages/reviews_page.php"
            class="inline-block px-6 py-3 mt-4 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 transition-transform transform hover:scale-105 
                    focus:outline-none focus:ring-2 focus:ring-blue-400">More</a>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                <img alt="User avatar of ${review.name}" 
                                    class="w-10 h-10 rounded-full mb-2" 
                                    height="50" 
                                    src="https://storage.googleapis.com/a1aa/image/mKVIY3gc40bgEtHZx8RuJ9l3Mjrw7cy0DAOcjqK81QBA1e9JA.jpg" 
                                    width="50" />
                                <div>
                                    <p class="text-md font-semibold">${review.name}</p>
                                    <p class="text-xs text-gray-500">${review.created_at}</p>
                                </div>
                            </div>
                            <p>"${review.message}"</p>
                            <div class="flex items-center mb-2">
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
    </script>

    <?php include("./assets/footer_1.php") ?>
</body>

</html>