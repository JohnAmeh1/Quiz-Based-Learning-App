<?php
include("./php/all_files.php");
include("./assets/user_auth.php");

if ($_SESSION['auth']) {
} else {
    header("location: ./index.php");
    die;
}

$user_data = getUser();
$userName = $user_data['username'];
$email  = $user_data['email'];
$price = 10000;
$naira = "&#x20A6;";
$ngn = "NGN";
$user_id = $user_data['id'];

if ($user_data['badge'] == 'verified') {
    header("location: mentor.php");
    die;
} else {
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap"
        rel="stylesheet" />
    <link rel="icon" href="./img/brain.jpg">
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto p-6">
        <!-- Header Section -->
        <header class="text-center mb-12 mt-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Teacher Mentorship Program</h1>
            <p class="text-lg text-gray-600">Invest in your teaching career and expand your reach</p>
        </header>

        <!-- Main Content -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <!-- Plan Details -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Professional Mentorship Package</h2>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Platform visibility to thousands of students</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Personalized mentor profile</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-700">Direct student messaging system</span>
                    </div>
                </div>
            </div>

            <!-- Price Section -->
            <div class="border-t border-b border-gray-200 py-8 mb-8">
                <div class="flex justify-center items-baseline">
                    <span class="text-5xl font-extrabold text-gray-900"><?php echo $naira . $price; ?></span>
                    <span class="text-gray-600 ml-1">/year</span>
                </div>
                <p class="text-center text-gray-600 mt-4">One-time payment for annual membership</p>
            </div>

            <!-- Payment Button -->
            <div class="text-center">
                <button class="px-8 py-4 rounded-lg font-semibold text-lg text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 
                    focus:outline-none focus:ring-2 focus:ring-blue-400" onclick="payWithPaystack()">
                    Pay with Paystack
                </button>
                <p class="mt-4 text-sm text-gray-600">Secure payment powered by Paystack</p>
            </div>
        </div>

        <!-- Trust Badges -->
        <div class="flex justify-center space-x-8 mb-12">
            <div class="text-center">
                <div class="bg-gray-100 p-4 rounded-full mb-2">
                    <svg class="h-6 w-6 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-600">Secure Payment</span>
            </div>
            <div class="text-center">
                <div class="bg-gray-100 p-4 rounded-full mb-2">
                    <svg class="h-6 w-6 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-600">Money-back Guarantee</span>
            </div>
            <div class="text-center">
                <div class="bg-gray-100 p-4 rounded-full mb-2">
                    <svg class="h-6 w-6 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-600">24/7 Support</span>
            </div>
        </div>
    </div>


    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        const email = '<?php echo $email; ?>';
        const amount = <?php echo $price; ?> * 100; // Paystack accepts the amount in kobo (1 NGN = 100 kobo)
        const userName = '<?php echo $userName; ?>';
        const verified = 'verified';

        function debounce(func, wait = 1000) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        function payWithPaystack() {
            const handler = PaystackPop.setup({
                key: 'pk_test_fdeb97ce15dc119e28cc589fcb24fac669b14f81',
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


        const debouncePayWithPaystack = debounce(payWithPaystack);
    </script>
</body>

</html>