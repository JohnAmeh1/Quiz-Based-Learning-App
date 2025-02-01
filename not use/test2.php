<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="quizContainer"></div>
    <button id="submitQuiz">Submit Quiz</button>
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     // Fetch quiz data via an API or endpoint
        //     fetch("fetch_quiz.php")
        //         .then(response => response.json())
        //         .then(data => {
        //             const quizContainer = document.getElementById("quizContainer");
        //             let quizHTML = "";

        //             data.forEach((quiz, index) => {
        //                 quizHTML += `
        //                 <div class="quiz-question">
        //                     <p>${index + 1}. ${quiz.question}</p>
        //                     ${quiz.options.map((option, i) => `
        //                         <label>
        //                             <input type="radio" name="quiz-${index}" value="${option}">
        //                             ${option}
        //                         </label>
        //                     `).join('')}
        //                 </div>
        //             `;
        //             });

        //             quizContainer.innerHTML = quizHTML;
        //         });
        // });
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch quiz data via an API or endpoint
            fetch("fetch_quiz.php")
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    const quizContainer = document.getElementById("quizContainer");
                    if (data.length === 0) {
                        quizContainer.innerHTML = "<p>No quizzes available at the moment.</p>";
                        return;
                    }

                    let quizHTML = "";

                    data.forEach((quiz, index) => {
                        quizHTML += `
                    <div class="quiz-question">
                        <p>${index + 1}. ${quiz.question}</p>
                        ${quiz.options.map((option, i) => `
                            <label>
                                <input type="radio" name="quiz-${index}" value="${option}">
                                ${option}
                            </label>
                        `).join('')}
                    </div>
                `;
                    });

                    quizContainer.innerHTML = quizHTML;
                })
                .catch(error => {
                    console.error("Error fetching quizzes:", error);
                    document.getElementById("quizContainer").innerHTML = "<p>Failed to load quizzes. Please try again later.</p>";
                });
        });

        document.getElementById("submitQuiz").addEventListener("click", function() {
            const answers = {};

            document.querySelectorAll(".quiz-question").forEach((quiz, index) => {
                const selectedOption = quiz.querySelector(`input[name = "quiz-${index}"]: checked`);
                if (selectedOption) {
                    answers[index] = selectedOption.value;
                }
            });

            // Send answers to server
            fetch("submit_quiz.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(answers),
                })
                .then(response => response.json())
                .then(data => {
                    alert(`Your score is: ${data.score}`)
                });
        });
    </script>
</body>

</html>