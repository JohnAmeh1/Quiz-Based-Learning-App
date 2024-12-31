<?php
include("./assets/header_pages.php");

$user_data = getUser();
$user_id = $user_data['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="icon" href="./img/brain.jpg">
    <title>Contact Us</title>
</head>

<body class="bg-gray-100">

    <!-- Contact Section -->
    <section class="py-16 px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-8">Contact Us</h1>
            <p class="text-lg text-gray-700 mb-12">We would love to hear from you! Please use the form below to send us any questions, suggestions, or feedback.</p>

            <!-- Contact Form -->
            <form action="" method="post" id="contact-form" class="bg-white p-8 shadow-lg rounded-lg">
                <div id="response-message" class="mt-4"></div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-lg mb-2">Your Name</label>
                    <input type="text" id="username" name="username" class="w-full p-3 border border-gray-300 rounded-md" value="<?= $user_data['username'] ?>" readonly>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-lg mb-2">Your Email</label>
                    <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-md" value="<?= $user_data['email'] ?>" readonly>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 text-lg mb-2">Your Message</label>
                    <textarea id="message" name="message" rows="4" class="w-full p-3 border border-gray-300 rounded-md" required></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-400" onclick="contact()">Send Message</button>
            </form>

            <!-- Contact Info -->
            <!-- <div class="mt-12">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Our Contact Information</h2>
                <p class="text-lg text-gray-700">If you'd prefer, you can reach us via the following methods:</p>
                <ul class="mt-4 space-y-3">
                    <li class="text-lg text-gray-700"><i class="fas fa-phone-alt mr-2"></i>+123 456 7890</li>
                    <li class="text-lg text-gray-700"><i class="fas fa-envelope mr-2"></i>support@eduquest.com</li>
                    <li class="text-lg text-gray-700"><i class="fas fa-map-marker-alt mr-2"></i>1234 Learning St, Education City, Country</li>
                </ul>
            </div> -->
        </div>
    </section>

    <!-- Footer -->
    <?php include("./assets/footer_pages.php") ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function contact() {
            const userId = <?= $user_id ?>;
            const username = document.getElementById("username").value;
            const email = document.getElementById("email").value;
            const message = document.getElementById("message").value;

            $.ajax({
                type: "POST",
                url: "./assets/contact_us.php",
                data: {
                    id: userId,
                    username: username,
                    email: email,
                    message: message,
                },
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.error) {
                        $("#response-message").html(`<div class="bg-red-500 text-white p-3 rounded">${res.error}</div>`);
                    } else {
                        $("#response-message").html(`<div class="bg-green-500 text-white p-3 rounded">${res}</div>`);
                        setTimeout(() => window.location.href = "./contact.php", 3000);
                    }
                },
                error: function() {
                    $("#response-message").html('<div class="bg-red-500 text-white p-3 rounded">An error occurred. Please try again.</div>');
                }
            });
        }
    </script>
</body>

</html>