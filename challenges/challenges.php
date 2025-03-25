<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Practice Page
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
                Practice Page
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
        <main class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Challenge List -->
            <section class="lg:col-span-1 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Coding Challenges
                </h2>
                <ul class="space-y-2">
                    <li class="bg-gray-100 p-2 rounded-lg">
                        <a class="flex justify-between items-center" href="#">
                            <span>
                                Easy: Print "Hello, World!"
                            </span>
                            <span class="text-green-500">
                                Easy
                            </span>
                        </a>
                    </li>
                    <li class="bg-gray-100 p-2 rounded-lg">
                        <a class="flex justify-between items-center" href="#">
                            <span>
                                Medium: Fibonacci Sequence
                            </span>
                            <span class="text-yellow-500">
                                Medium
                            </span>
                        </a>
                    </li>
                    <li class="bg-gray-100 p-2 rounded-lg">
                        <a class="flex justify-between items-center" href="#">
                            <span>
                                Hard: Sorting Algorithm
                            </span>
                            <span class="text-red-500">
                                Hard
                            </span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- Coding Area -->
            <section class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Challenge: Print "Hello, World!"
                </h2>
                <div class="mb-4">
                    <h3 class="text-lg font-medium mb-2">
                        Description
                    </h3>
                    <p>
                        Write a Python program that prints "Hello, World!" to the console.
                    </p>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium mb-2">
                        Code Editor
                    </h3>
                    <textarea class="w-full h-48 p-2 border border-gray-300 rounded-lg" placeholder="Write your Python code here...">
                        print("Hello, World!")
                    </textarea>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-2">
                        Run Code
                    </button>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium mb-2">
                        Output
                    </h3>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <pre>
                            Hello, World!
                        </pre>
                    </div>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium mb-2">
                        Hints
                    </h3>
                    <p class="bg-gray-100 p-2 rounded-lg">
                        Use the print function to display text in Python.
                    </p>
                </div>
            </section>
        </main>
    </div>
</body>

</html>