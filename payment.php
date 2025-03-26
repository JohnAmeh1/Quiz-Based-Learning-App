<?php
// session_start();
include("./php/all_files.php");
include("./assets/user_auth.php");

// Redirect if user is not authenticated
if (!$_SESSION['auth']) {
    header("location: ./index.php");
    die;
}

// Fetch user data
$user_data = getUser();
$userName = $user_data['username'];
$email  = $user_data['email'];
$price = 10000; // Price in Naira
$naira = "&#x20A6;"; // Naira symbol
$ngn = "NGN"; // Currency code
$user_id = $user_data['id'];

// Redirect if user is already verified
if ($user_data['badge'] == 'verified') {
    // Redirect to the view_courses.php page of the selected course
    if (isset($_GET['course_id'])) {
        $course_id = intval($_GET['course_id']);
        header("location: ./details/view_courses.php?course_id=$course_id");
    } else {
        // If no course_id is provided, redirect to the general courses page
        header("location: courses.php");
    }
    die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgrade to Pro Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="icon" href="./img/brain.jpg">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #4f46e5, #9333ea);
        }

        .hover-scale {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-scale:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .trust-badge {
            transition: transform 0.3s ease;
        }

        .trust-badge:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">
    <div class="max-w-4xl w-full mx-auto p-6">
        <!-- Header Section -->
        <header class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Upgrade to <span class="gradient-text bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Pro Account</span></h1>
            <p class="text-lg text-gray-600">Unlock exclusive features and take your learning experience to the next level.</p>
        </header>

        <!-- Main Content -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 hover-scale">
            <!-- Plan Details -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Pro Membership Benefits</h2>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Access to all premium courses</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Personalized learning dashboard</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Priority support and mentorship</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Exclusive community access</span>
                    </div>
                </div>
            </div>

            <!-- Price Section -->
            <div class="border-t border-b border-gray-200 py-8 mb-8">
                <div class="flex justify-center items-baseline">
                    <span class="text-5xl font-extrabold text-gray-900"><?php echo $naira . $price; ?></span>
                    <!-- <span class="text-gray-600 ml-2">/year</span> -->
                </div>
                <p class="text-center text-gray-600 mt-4">One-time payment for membership</p>
            </div>

            <!-- Payment Button -->
            <div class="text-center">
                <button class="px-8 py-4 rounded-lg font-semibold text-lg text-white gradient-bg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" onclick="payWithPaystack()">
                    Upgrade Now
                </button>
                <p class="mt-4 text-sm text-gray-600">Secure payment powered by Paystack</p>
            </div>
        </div>

        <!-- Trust Badges -->
        <div class="flex justify-center space-x-8 mb-12">
            <div class="text-center trust-badge">
                <div class="bg-gray-100 p-4 rounded-full mb-2">
                    <svg class="h-6 w-6 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-600">Secure Payment</span>
            </div>
            <div class="text-center trust-badge">
                <div class="bg-gray-100 p-4 rounded-full mb-2">
                    <svg class="h-6 w-6 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-600">Money-back Guarantee</span>
            </div>
            <div class="text-center trust-badge">
                <div class="bg-gray-100 p-4 rounded-full mb-2">
                    <svg class="h-6 w-6 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-600">24/7 Support</span>
            </div>
        </div>
    </div>

    <!-- Paystack Integration -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        const email = '<?php echo $email; ?>';
        const amount = <?php echo $price; ?> * 100; // Paystack accepts the amount in kobo (1 NGN = 100 kobo)
        const userName = '<?php echo $userName; ?>';
        const verified = 'verified';

        function payWithPaystack() {
            const handler = PaystackPop.setup({
                // key: 'pk_test_fdeb97ce15dc119e28cc589fcb24fac669b14f81', // Replace with your Paystack public key
                key: 'pk_live_4f399bf20785fe69402e909561b671795972e56c',
                email: email,
                amount: amount, // Amount in kobo
                currency: "NGN",
                ref: '' + Math.floor((Math.random() * 1000000000) + 1), // Generate a unique transaction reference
                metadata: {
                    custom_fields: [{
                        display_name: "User Email",
                        variable_name: "email",
                        value: email
                    }]
                },
                callback: function(response) {
                    // Payment was successful
                    const reference = response.reference;
                    window.location.href = 'check.php?reference=' + reference + '&username=' + userName + '&verified=' + verified + '&email=' + email;
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