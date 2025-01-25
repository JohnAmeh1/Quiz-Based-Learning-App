<?php
include("./header_2.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Topic Detail
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-roboto">
    <div class="container mx-auto p-4">

        <main class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Content Area -->
            <section class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Introduction to Python
                </h2>
                <article class="prose max-w-none">
                    <h3>
                        Theory
                    </h3>
                    <p>
                        Python is a high-level, interpreted programming language known for its simplicity and readability. It supports multiple programming paradigms, including procedural, object-oriented, and functional programming.
                    </p>
                    <h3>
                        Code Example
                    </h3>
                    <pre class="bg-gray-100 p-4 items-start rounded-lg overflow-x-auto">
                        <code class="language-python">
                        # This is a simple Python program
                        def greet(name):
                            return f"Hello, {name}!"

                        print(greet("World"))
                        </code>
                    </pre>
                    <h3>
                        Video Tutorial
                    </h3>
                    <div class="aspect-w-16 aspect-h-9 mb-4">
                        <iframe allowfullscreen="" class="w-full h-full" src="https://www.youtube.com/embed/rfscVS0vtbw">
                        </iframe>
                    </div>
                    <h3>
                        Interactive Editor
                    </h3>
                    <div class="bg-gray-100 p-4 rounded-lg mb-4">
                        <textarea class="w-full h-32 p-2 border border-gray-300 rounded-lg" placeholder="Write your Python code here...">
</textarea>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-2">
                            Run Code
                        </button>
                    </div>
                </article>
            </section>
            <!-- Quiz Prompt -->
            <section class="bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Quiz
                </h2>
                <p class="mb-4">
                    Test your knowledge on this topic by taking the quiz.
                </p>
                <a href="./pages/quiz.php?course_id={$course['id']}" class="bg-blue-500 text-white px-4 py-2 rounded-lg" href="#">
                    Take Quiz
                </a>
            </section>
            <!-- Discussion/Comment Section -->
            <section class="lg:col-span-3 bg-white p-4 rounded-lg shadow-md mt-4">
                <h2 class="text-xl font-semibold mb-4">
                    Discussion
                </h2>
                <div class="space-y-4">
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <img alt="User avatar" class="w-10 h-10 rounded-full mr-3" height="50" src="https://storage.googleapis.com/a1aa/image/mKVIY3gc40bgEtHZx8RuJ9l3Mjrw7cy0DAOcjqK81QBA1e9JA.jpg" width="50" />
                            <div>
                                <p class="text-sm font-medium">
                                    John Doe
                                </p>
                                <p class="text-xs text-gray-500">
                                    2 hours ago
                                </p>
                            </div>
                        </div>
                        <p>
                            Can someone explain the difference between lists and tuples in Python?
                        </p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <img alt="User avatar" class="w-10 h-10 rounded-full mr-3" height="50" src="https://storage.googleapis.com/a1aa/image/mKVIY3gc40bgEtHZx8RuJ9l3Mjrw7cy0DAOcjqK81QBA1e9JA.jpg" width="50" />
                            <div>
                                <p class="text-sm font-medium">
                                    Jane Smith
                                </p>
                                <p class="text-xs text-gray-500">
                                    1 day ago
                                </p>
                            </div>
                        </div>
                        <p>
                            Great tutorial! I found the code examples very helpful.
                        </p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex items-center mb-2">
                            <img alt="User avatar" class="w-10 h-10 rounded-full mr-3" height="50" src="https://storage.googleapis.com/a1aa/image/mKVIY3gc40bgEtHZx8RuJ9l3Mjrw7cy0DAOcjqK81QBA1e9JA.jpg" width="50" />
                            <div>
                                <p class="text-sm font-medium">
                                    Alice Johnson
                                </p>
                                <p class="text-xs text-gray-500">
                                    3 days ago
                                </p>
                            </div>
                        </div>
                        <p>
                            How do I install Python on Windows?
                        </p>
                    </div>
                </div>
                <div class="mt-4">
                    <textarea class="w-full h-24 p-2 border border-gray-300 rounded-lg" placeholder="Add a comment...">
</textarea>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-2">
                        Post Comment
                    </button>
                </div>
            </section>
        </main>
    </div>
</body>

</html>