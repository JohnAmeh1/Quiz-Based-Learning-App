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
    <?php include("./assets/header_1.php") ?>
    <section class="container mx-auto mt-5 p-5">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2">
                <h1 class="text-4xl font-bold mb-4">
                    Master Programming with Our Expert-Led Courses
                </h1>
                <p class="mb-4">
                    Join thousands of learners and start your journey to becoming a programming expert. Our courses are designed to be engaging, interactive, and comprehensive.
                </p>
                <a class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" href="#">
                    Get Started
                </a>
            </div>
            <div class="md:w-1/2 mt-5 md:mt-0">
                <img alt="A group of diverse people learning programming together on laptops and whiteboards" height="400" src="https://storage.googleapis.com/a1aa/image/No3oX7jKvuLnIV1FCeUVehk76jVj2MJcf09uYTPY2KbwrM3nA.jpg" width="600" />
            </div>
        </div>
    </section>
    <section class="bg-white py-10">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center mb-6" >
                Our Popular Courses
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-100 p-5 rounded shadow">
                    <img alt="A person coding on a laptop with code visible on the screen" class="mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/hUTFf7AVTxSrPq9PejefX5XQtDee3RxUYeXSYkfp3RWwzVm7TA.jpg" width="500" />
                    <h3 class="text-xl font-bold mb-2">
                        Web Development
                    </h3>
                    <p class="mb-4">
                        Learn to build modern, responsive websites using HTML, CSS, and JavaScript.
                    </p>
                    <a class="text-blue-600 hover:underline" href="#">
                        Learn More
                    </a>
                </div>
                <div class="bg-gray-100 p-5 rounded shadow">
                    <img alt="A person working on a data analysis project with charts and graphs on the screen" class="mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/UrfdtoEbKXQQH6EuH8fnGzPqtzzVEVjzpqdApxDuUw62Vm7TA.jpg" width="500" />
                    <h3 class="text-xl font-bold mb-2">
                        Data Science
                    </h3>
                    <p class="mb-4">
                        Master data analysis, visualization, and machine learning with Python.
                    </p>
                    <a class="text-blue-600 hover:underline" href="#">
                        Learn More
                    </a>
                </div>
                <div class="bg-gray-100 p-5 rounded shadow">
                    <img alt="A person developing a mobile app with code and design tools on the screen" class="mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/EbQGP7agl0rZA9TpIzW4k25HlhaonGfGgVelVSzvSf9krM3nA.jpg" width="500" />
                    <h3 class="text-xl font-bold mb-2">
                        Mobile Development
                    </h3>
                    <p class="mb-4">
                        Create stunning mobile applications for Android and iOS using Flutter and React Native.
                    </p>
                    <a class="text-blue-600 hover:underline" href="#">
                        Learn More
                    </a>
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
    <section class="container mx-auto py-10">
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
    </section>
    <?php include("./assets/footer_1.php") ?>
</body>

</html>