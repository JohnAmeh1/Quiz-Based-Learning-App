<?php
$conn = new mysqli("localhost", "root", "", "learning_app");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;
if ($course_id === 0) {
    die("Invalid course ID.");
}

$course_query = $conn->query("SELECT * FROM courses WHERE id = $course_id");
$course = $course_query->fetch_assoc();
if (!$course) {
    die("Course not found.");
}

$result = $conn->query("SELECT * FROM quizzes WHERE course_id = $course_id");
$quizzes = $result->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz - EduQuest</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="./img/brain.jpg">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f8ff, #e6f2ff);
        }

        .quiz-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        @media (min-width: 1024px) {
            .quiz-layout {
                grid-template-columns: 1fr 1fr;
            }
        }

        .quiz-progress {
            background: linear-gradient(to right, #4b6cb7, #182848);
            height: 6px;
            border-radius: 10px;
            transition: width 0.5s ease-in-out;
        }

        .quiz-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(100, 149, 237, 0.1);
            padding: 1.5rem;
            overflow-y: auto;
            max-height: 70vh;
        }

        .quiz-container {
            background: linear-gradient(145deg, #ffffff, #f9fafb);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(100, 149, 237, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .quiz-question {
            background: linear-gradient(145deg, #f9fafb, #ffffff);
            border-radius: 12px;
            margin-bottom: 1rem;
            padding: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .quiz-option {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            background: rgba(240, 248, 255, 0.6);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .quiz-option:hover {
            background: rgba(135, 206, 250, 0.1);
            transform: translateX(10px);
        }

        .quiz-option input:checked+span {
            color: #4169e1;
            font-weight: bold;
        }

        .difficulty-badge {
            background: linear-gradient(to right,
                    <?php
                    switch ($course['difficulty']) {
                        case 'Beginner':
                            echo '#4caf50, #81c784';
                            break;
                        case 'Intermediate':
                            echo '#ff9800, #ffb74d';
                            break;
                        case 'Advanced':
                            echo '#f44336, #ef9a9a';
                            break;
                        default:
                            echo '#2196f3, #64b5f6';
                    }
                    ?>);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .submit-button {
            background: linear-gradient(to right, rgb(38, 73, 226), rgb(35, 65, 154));
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-align: center;
            width: 100%;
        }

        .submit-button:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 15px rgba(135, 206, 250, 0.3);
        }

        @media (max-width: 640px) {
            .quiz-section {
                padding: 1rem;
            }

            .quiz-question {
                padding: 0.75rem;
            }

            .quiz-option {
                padding: 0.5rem;
            }

            .submit-button {
                padding: 0.5rem 1rem;
            }
        }

        #timer {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1e3a8a;
            /* Blue-900 */
            background-color: #f0f8ff;
            /* Light blue background */
            padding: 0.5rem 1rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="quiz-container w-full max-w-6xl">
            <div class="p-4 lg:p-6 flex flex-col lg:flex-row justify-between items-center">
                <div class="text-center lg:text-left mb-4 lg:mb-0">
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-800"><?php echo htmlspecialchars($course['name']); ?> Quiz</h1>
                </div>
                <div class="text-xl font-bold text-gray-800">
                    Time Remaining: <span id="timer">05:00</span>
                </div>
                <!-- <div class="difficulty-badge">
                    <?php echo htmlspecialchars($course['difficulty']); ?> Level
                </div> -->
            </div>
            <div class="quiz-progress" id="progressBar"></div>

            <div class="quiz-layout">
                <div class="quiz-section">
                    <h2 class="text-xl lg:text-2xl font-bold mb-4 lg:mb-6 text-gray-800">Quiz Questions</h2>

                    <form id="quizForm">
                        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
                        <?php foreach ($quizzes as $index => $quiz): ?>
                            <div class="quiz-question">
                                <p class="text-lg font-semibold mb-4">
                                    <?php echo htmlspecialchars($quiz['question']); ?>
                                </p>
                                <div class="space-y-2">
                                    <?php
                                    $options = json_decode($quiz['options'], true);
                                    foreach ($options as $option):
                                    ?>
                                        <label class="quiz-option">
                                            <input type="radio"
                                                name="quiz_<?php echo $quiz['id']; ?>"
                                                value="<?php echo htmlspecialchars($option); ?>"
                                                class="mr-3">
                                            <span class="text-gray-700">
                                                <?php echo htmlspecialchars($option); ?>
                                            </span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <button type="submit" class="submit-button">
                            Submit Quiz
                        </button>
                    </form>
                </div>

                <div class="quiz-section">
                    <h2 class="text-xl lg:text-2xl font-bold mb-4 lg:mb-6 text-gray-800">Quiz Overview</h2>
                    <div id="quizInfo" class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600">Total Questions: <?php echo count($quizzes); ?></p>
                        <p class="text-gray-600">Course: <?php echo htmlspecialchars($course['name']); ?></p>
                        <div id="scoreResult" class="mt-4 hidden">
                            <h3 class="text-lg lg:text-xl font-semibold mb-2">Results</h3>
                            <p>Score: <span id="scoreValue"></span>/<span id="totalValue"></span></p>
                            <p>Points Earned: <span id="pointsValue"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Timer logic
        let timeLeft = 300; // 20 seconds for testing (change to 300 for 5 minutes)
        const timerElement = document.getElementById("timer");

        // Function to update the timer display
        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                submitQuizAndRedirect(); // Submit the quiz and redirect when time runs out
            } else {
                timeLeft--;
            }
        }

        // Start the timer
        const timerInterval = setInterval(updateTimer, 1000);

        // Function to submit the quiz and redirect
        // function submitQuizAndRedirect() {
        //     const form = document.getElementById("quizForm");
        //     let formData = new FormData(form);

        //     // Show a message before submitting
        //     const messageElement = document.createElement("p");
        //     messageElement.id = "timeoutMessage";
        //     messageElement.className = "text-red-600 font-bold mt-4";
        //     messageElement.textContent = "Time's up! Submitting quiz...";
        //     document.getElementById("quizInfo").appendChild(messageElement);

        //     // Submit the quiz
        //     fetch("process_quiz.php", {
        //             method: "POST",
        //             body: formData
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.error) {
        //                 alert("Error: " + data.error);
        //             } else {
        //                 // Display the quiz results
        //                 document.getElementById("scoreResult").classList.remove("hidden");
        //                 document.getElementById("scoreValue").textContent = data.score;
        //                 document.getElementById("totalValue").textContent = data.total;
        //                 document.getElementById("pointsValue").textContent = data.game_points;

        //                 // Show a countdown message for redirection
        //                 let countdown = 2;
        //                 const countdownElement = document.createElement("p");
        //                 countdownElement.id = "countdown";
        //                 countdownElement.className = "text-gray-600 mt-4";
        //                 countdownElement.textContent = `Redirecting to courses page in ${countdown} seconds...`;
        //                 document.getElementById("quizInfo").appendChild(countdownElement);

        //                 // Start the countdown
        //                 const countdownInterval = setInterval(() => {
        //                     countdown--;
        //                     countdownElement.textContent = `Redirecting to courses page in ${countdown} seconds...`;

        //                     // Redirect after 2 seconds
        //                     if (countdown <= 0) {
        //                         clearInterval(countdownInterval);
        //                         window.location.href = "../courses.php"; // Redirect to the courses page
        //                     }
        //                 }, 1000);
        //             }
        //         })
        //         .catch(error => {
        //             console.error("Fetch error:", error);
        //             alert("An unexpected error occurred while processing your quiz.");
        //         });
        // }

        function submitQuizAndRedirect() {
    const form = document.getElementById("quizForm");
    let formData = new FormData(form);

    // Show a message before submitting
    const messageElement = document.createElement("p");
    messageElement.id = "timeoutMessage";
    messageElement.className = "text-red-600 font-bold mt-4";
    messageElement.textContent = "Time's up! Submitting quiz...";
    document.getElementById("quizInfo").appendChild(messageElement);

    // Submit the quiz
    fetch("process_quiz.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        // Check if the response is JSON
        const contentType = response.headers.get("content-type");
        if (contentType && contentType.includes("application/json")) {
            return response.json();
        } else {
            // If the response is not JSON, throw an error
            return response.text().then(text => {
                throw new Error(`Expected JSON, got: ${text}`);
            });
        }
    })
    .then(data => {
        if (data.error) {
            alert("Error: " + data.error);
        } else {
            // Display the quiz results
            document.getElementById("scoreResult").classList.remove("hidden");
            document.getElementById("scoreValue").textContent = data.score;
            document.getElementById("totalValue").textContent = data.total;
            document.getElementById("pointsValue").textContent = data.game_points;

            // Show a countdown message for redirection
            let countdown = 2;
            const countdownElement = document.createElement("p");
            countdownElement.id = "countdown";
            countdownElement.className = "text-gray-600 mt-4";
            countdownElement.textContent = `Redirecting to courses page in ${countdown} seconds...`;
            document.getElementById("quizInfo").appendChild(countdownElement);

            // Start the countdown
            const countdownInterval = setInterval(() => {
                countdown--;
                countdownElement.textContent = `Redirecting to courses page in ${countdown} seconds...`;

                // Redirect after 2 seconds
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = "../courses.php"; // Redirect to the courses page
                }
            }, 1000);
        }
    })
    .catch(error => {
        console.error("Fetch error:", error);
        alert("An unexpected error occurred while processing your quiz. Please check the console for details.");
    });
}

        // Function to handle manual submission
        function submitQuiz() {
            const form = document.getElementById("quizForm");
            let formData = new FormData(form);

            fetch("process_quiz.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert("Error: " + data.error);
                    } else if (data.redirect) {
                        // Display the quiz results
                        document.getElementById("scoreResult").classList.remove("hidden");
                        document.getElementById("scoreValue").textContent = data.score;
                        document.getElementById("totalValue").textContent = data.total;
                        document.getElementById("pointsValue").textContent = data.game_points;

                        // Show a countdown message for redirection
                        let countdown = 5;
                        const countdownElement = document.createElement("p");
                        countdownElement.id = "countdown";
                        countdownElement.className = "text-gray-600 mt-4";
                        countdownElement.textContent = `Redirecting to certificates page in ${countdown} seconds...`;
                        document.getElementById("quizInfo").appendChild(countdownElement);

                        // Start the countdown
                        const countdownInterval = setInterval(() => {
                            countdown--;
                            countdownElement.textContent = `Redirecting to certificates page in ${countdown} seconds...`;

                            // Redirect after 5 seconds
                            if (countdown <= 0) {
                                clearInterval(countdownInterval);
                                window.location.href = data.redirect;
                            }
                        }, 1000);
                    } else {
                        // Display the quiz results
                        document.getElementById("scoreResult").classList.remove("hidden");
                        document.getElementById("scoreValue").textContent = data.score;
                        document.getElementById("totalValue").textContent = data.total;
                        document.getElementById("pointsValue").textContent = data.game_points;
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                    alert("An unexpected error occurred while processing your quiz.");
                });
        }

        // Handle manual submission
        document.getElementById("quizForm").addEventListener("submit", function(event) {
            event.preventDefault();
            clearInterval(timerInterval); // Stop the timer
            submitQuiz(); // Submit the quiz
        });
    </script>
</body>

</html>