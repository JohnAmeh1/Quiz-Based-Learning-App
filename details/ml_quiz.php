<?php
include("./header_2.php");

?>



<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Quiz Page
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-roboto">
    <div class="container mx-auto p-4">
        <header class="flex justify-between items-center py-4">
            <h1 class="text-2xl font-bold">
                Quiz
            </h1>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <a class="text-blue-500" href="#">
                            Home
                        </a>
                    </li>
                    <li>
                        <a class="text-blue-500" href="#">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a class="text-blue-500" href="#">
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <main class="bg-white p-4 rounded-lg shadow-md">
            <!-- Timer -->
            <div class="flex justify-between items-center mb-4">
                <div class="text-lg font-semibold">
                    Time Remaining: <span id="timer" class="text-red-500">10:00</span>
                </div>
                <div class="text-lg font-semibold">
                    Question 1 of 5
                </div>
            </div>
            <!-- Progress Bar -->
            <div class="relative pt-1 mb-4">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200">
                            20%
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-semibold inline-block text-blue-600">
                            20% Completed
                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200">
                    <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500" style="width:20%">
                    </div>
                </div>
            </div>
            <!-- Question Area -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">
                    What is the output of the following Python code?
                </h2>
                <pre class="bg-gray-100 p-4 rounded-lg overflow-x-auto">
                    <code class="language-python">
                    print("Hello, World!")
                    </code>
                </pre>
                <div class="mt-4">
                    <label class="block mb-2">
                        <input class="mr-2" name="question1" type="radio" value="A" />
                        A) Hello, World!
                    </label>
                    <label class="block mb-2">
                        <input class="mr-2" name="question1" type="radio" value="B" />
                        B) Hello World
                    </label>
                    <label class="block mb-2">
                        <input class="mr-2" name="question1" type="radio" value="C" />
                        C) Hello, World
                    </label>
                    <label class="block mb-2">
                        <input class="mr-2" name="question1" type="radio" value="D" />
                        D) Error
                    </label>
                </div>
            </div>
            <!-- Navigation Buttons -->
            <div class="flex justify-between">
                <button class="bg-gray-500 text-white px-4 py-2 rounded-lg">
                    Previous
                </button>
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Next
                </button>
            </div>
        </main>
    </div>
    <script>
        // Timer script
        let time = 600; // 10 minutes in seconds
        const timerElement = document.getElementById('timer');

        function updateTimer() {
            const minutes = Math.floor(time / 60);
            const seconds = time % 60;
            timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            if (time > 0) {
                time--;
            } else {
                clearInterval(timerInterval);
                alert('Time is up!');
            }
        }

        const timerInterval = setInterval(updateTimer, 1000);
    </script>
</body>

</html>