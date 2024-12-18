<?php
// session_start();
include("./php/all_files.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["username"]) && isset($_POST["password"])) {

        $login = new Login();
        $results = $login->evaluate($_POST);

        $username = $_POST["username"];

        $password = $_POST["password"];

        if (empty($username)) {
            $em = "Username Is Required";
            header("location: index.php?error=$em");
            exit;
        } else if (empty($password)) {
            $em = "Password is required";
            header("location: index.php?error=$em");
            exit;
        }

        $login = new Login();
        $results = $login->evaluate($_POST);

        if ($results != "") {
            $em = "Incorrect Details, Please try again";
            header("location: index.php?error=$em");
            exit;
        } elseif ($results == "") {
            header("location: ./dashboard.php");
            die;
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
        EduQuest - Login
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="icon" href="./img/brain.jpg">
</head>

<body class="bg-gray-100 font-roboto">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <div class="flex justify-center mb-6">
                <img alt="Logo of the quiz-based learning app, featuring a stylized brain with question marks" class="w-24 h-24" height="100" src="./img/brain.jpg" width="100" />
            </div>
            <h2 class="text-2xl font-bold text-center mb-6">
                Welcome to EduQuest
            </h2>
            <div class="flex justify-center mb-6">
                <button class="text-lg font-medium text-gray-700 border-b-2 border-blue-500 px-4 py-2" id="loginTab">
                    Login
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

            <div id="loginForm" >
                <form method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700" for="sername">
                            Username
                        </label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="username" name="username" placeholder="Enter your username" type="text" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700" for="password">
                            Password
                        </label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password" placeholder="Enter your password" type="password" />
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <input class="h-4 w-4 text-blue-600" id="rememberMe" type="checkbox" />
                            <label class="ml-2 text-gray-700" for="rememberMe">
                                Remember me
                            </label>
                        </div>
                        <a class="text-blue-500" href="./signup.php">
                            Create Account?
                        </a>
                    </div>

                    <input type="submit" name="login" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600" value="Login" style="font-size: 20px;">
                </form>
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