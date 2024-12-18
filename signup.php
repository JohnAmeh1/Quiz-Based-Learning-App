<?php
include("./php/all_files.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $signup = new Signup();
    $resultt = $signup->evaluate($_POST);


    if (isset($_POST["email"]) && isset($_POST["password"])) {


        $login = new Login();
        $results = $login->evaluate($_POST);

        $username = $_POST["username"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (empty($username)) {
            $em = "Username Is Required";
            header("location: signup.php?error=$em");
            exit;
        }
        if (empty($name)) {
            $em = "Full name Is Required";
            header("location: signup.php?error=$em");
            exit;
        }
        if (empty($email)) {
            $em = "Email Address Is Required";
            header("location: signup.php?error=$em");
            exit;
        }
        if (strlen($password) < 8) {
            $em = "Password cannot be less than 8 characters";
            header("location: signup.php?error=$em");
            exit;
        } else if (empty($password)) {
            $em = "Password is required";
            header("location: signup.php?error=$em");
            exit;
        }


        if ($resultt != "") {
            if ($resultt == "User with this Username already exists") {
                $em = "User with this Username already exists";
                header("location: signup.php?error=$em");
            }
        }


        if ($resultt == "User with this Email Address already exists") {
            $em = "User with this Email Address already exists";
            header("location: signup.php?error=$em");
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Quiz Learning App - Login/Signup
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <title>
        EduQuest - Sign Up
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="icon" href="./img/brain.jpg">
</head>

<body class="bg-gray-100 font-roboto">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 m-4 max-w-md w-full">
            <div class="flex justify-center mb-6">
                <img alt="Logo of the quiz-based learning app, featuring a stylized brain with question marks" class="w-24 h-24" height="100" src="./img/brain.jpg" width="100" />
            </div>
            <h2 class="text-2xl font-bold text-center mb-6">
                Welcome to EduQuest
            </h2>
            <div class="flex justify-center mb-6">
                <button class="text-lg font-medium text-gray-700 border-b-2 border-blue-500 px-4 py-2" id="loginTab">
                    Create Account
                </button>
            </div>
            <?php if (isset($_GET['error'])) { ?>
                <div id="error-alert" class="flex items-center justify-between p-4 mb-4 text-sm text-white bg-red-500 rounded shadow" role="alert">
                    <span class="flex items-center">
                        <i class="fas fa-x fa-fw mr-2"></i>
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </span>
                    <button onclick="dismissAlert('error-alert')" class="ml-4 text-white hover:text-red-300 focus:outline-none">
                        ✕
                    </button>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div id="success-alert" class="flex items-center justify-between p-4 mb-4 text-sm text-white bg-green-500 rounded shadow" role="alert">
                    <span class="flex items-center">
                        <i class="fas fa-check fa-fw mr-2"></i>
                        <?php echo htmlspecialchars($_GET['success']); ?>
                    </span>
                    <button onclick="dismissAlert('success-alert')" class="ml-4 text-white hover:text-green-300 focus:outline-none">
                        ✕
                    </button>
                </div>
            <?php } ?>


            <div class="signupForm">
                <form enctype="multipart/form-data" method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700" for="signupPp">
                            Profile Picture
                        </label>
                        <input type="file" id="image_path" name="image_path" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700" for="signupUsername">
                            Username
                        </label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="signupUsername" name="username" placeholder="Enter a username" type="text" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700" for="signupName">
                            Name
                        </label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="signupName" name="name" placeholder="Enter your name" type="text" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700" for="signupEmail">
                            Email
                        </label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="signupEmail" name="email" placeholder="Enter your email" type="email" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700" for="signupPassword">
                            Password
                        </label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="signupPassword" name="password" placeholder="Create a password" maxlength="8" type="password" />
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <input class="h-4 w-4 text-blue-600" id="rememberMe" type="checkbox" />
                            <label class="ml-2 text-gray-700" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <a class="text-blue-500" href="./index.php">
                            Login Here
                        </a>
                    </div>
                    <input type="submit" name="signup" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600" value="Sign-Up"
                        style="font-size: 20px;">
                </form>
                <div class="text-center mt-6">
                    <p class="text-gray-700">
                        Or continue with
                    </p>
                    <div class="flex justify-center mt-4">
                        <button class="bg-gray-100 p-2 rounded-full mx-2 hover:bg-gray-200">
                            <i class="fab fa-google text-xl text-gray-700">
                            </i>
                        </button>
                        <button class="bg-gray-100 p-2 rounded-full mx-2 hover:bg-gray-200">
                            <i class="fab fa-facebook text-xl text-gray-700">
                            </i>
                        </button>
                        <button class="bg-gray-100 p-2 rounded-full mx-2 hover:bg-gray-200">
                            <i class="fab fa-twitter text-xl text-gray-700">
                            </i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function dismissAlert(alertId) {
            const alert = document.getElementById(alertId);
            alert.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                alert.style.display = 'none';
            }, 300); // Matches the duration of the transition
        }
    </script>

</body>

</html>