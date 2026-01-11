<?php
// session_start();
include("./php/all_files.php");
include("./assets/user_auth.php");


$host = "localhost";
$user = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($host, $user, $password, $dbname);

// Redirect if user is not authenticated
if (!$_SESSION['auth']) {
    header("location: ./index.php");
    die;
}

// Check if course_id is provided
if (!isset($_GET['course_id'])) {
    header("location: ../courses.php");
    die;
}

$course_id = intval($_GET['course_id']);

$course_query = $conn->query("SELECT * FROM courses WHERE id = $course_id");
$course = $course_query->fetch_assoc();
$course_name = $course['name'];

// Fetch user data
$user_data = getUser();
$userName = $user_data['username'];
$email = $user_data['email'];
$price = 15000; // Price in Naira for the quiz
$naira = "&#x20A6;"; // Naira symbol
$ngn = "NGN"; // Currency code
$user_id = $user_data['id'];

// Check if user has already paid for this quiz
$payment_check = $conn->prepare("SELECT * FROM quiz_payments WHERE user_id = ? AND course_id = ? AND payment_status = 'completed'");
$payment_check->bind_param("ii", $user_id, $course_id);
$payment_check->execute();
$result = $payment_check->get_result();

if ($result->num_rows > 0) {
    // User has already paid, redirect to quiz
    header("location: ./view_courses.php?course_id=$course_id");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="./img/brain.jpg">
    <title><?php echo $course_name; ?>- Quiz Payment</title>
    <style>
        #submit-button {
            background: linear-gradient(to right, rgb(38, 73, 226), rgb(35, 65, 154));
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">
    <div class="max-w-4xl w-full mx-auto p-6">
        <!-- Header Section -->
        <header class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Pay for Quiz Access</h1>
            <p class="text-lg text-gray-600">Gain access to this course's quiz by making a payment.</p>
        </header>

        <!-- Main Content -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 hover-scale">
            <!-- Quiz Details -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Quiz Access Benefits</h2>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Full access to course quiz</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Instant results and feedback</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Certificate of completion</span>
                    </div>
                </div>
            </div>

            <!-- Price Section -->
            <div class="border-t border-b border-gray-200 py-8 mb-8">
                <div class="flex justify-center items-baseline">
                    <span class="text-5xl font-extrabold text-gray-900"><?php echo $naira . $price; ?></span>
                </div>
                <p class="text-center text-gray-600 mt-4">One-time payment for quiz access</p>
            </div>

            <!-- Payment Button -->
            <div class="text-center">
                <button id="submit-button" onclick="payWithPaystack()">
                    Pay Now
                </button>
                <p class="mt-4 text-sm text-gray-600">Secure payment powered by Paystack</p>
            </div>
        </div>

        <!-- Trust Badges (same as before) -->
    </div>

    <!-- Paystack Integration -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        const email = '<?php echo $email; ?>';
        const amount = <?php echo $price; ?> * 100;
        const userName = '<?php echo $userName; ?>';
        const courseId = <?php echo $course_id; ?>;

        function payWithPaystack() {
            const handler = PaystackPop.setup({
                key: '',
                email: email,
                amount: amount,
                currency: "NGN",
                ref: '' + Math.floor((Math.random() * 1000000000) + 1),
                metadata: {
                    custom_fields: [{
                            display_name: "User Email",
                            variable_name: "email",
                            value: email
                        },
                        {
                            display_name: "Course ID",
                            variable_name: "course_id",
                            value: courseId
                        }
                    ]
                },
                callback: function(response) {
                    const reference = response.reference;
                    window.location.href = 'quiz_check.php?reference=' + reference +
                        '&username=' + userName +
                        '&email=' + email +
                        '&course_id=' + courseId +
                        '&amount=' + (amount / 100);
                },
                onClose: function() {
                    alert('Payment window closed');
                }
            });
            handler.openIframe();
        }
    </script>
</body>

</html>
