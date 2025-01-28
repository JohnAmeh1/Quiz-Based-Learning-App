<?php
include("./php/all_files.php");
include("./php/user_auth_2.php");
if($_SESSION['auth']){

}else{
    header("location: ./index.php");
    die;
}

$user_data = getUser();

$user_id = $user_data['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="icon" href="./img/brain.jpg">
    <!-- <link rel="icon" href="../img/eduquest-logo_1_-removebg-preview.png"> -->
</head>


<body>

<nav class="bg-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between">
            <div class="flex space-x-4">
                <!-- Logo -->
                <div>
                    <a class="flex items-center py-5 px-2 text-gray-700 hover:text-gray-900" href="#">
                        <img alt="Logo of the website" class="h-8 mr-2" height="20" src="./img/eduquest-sololearn-inspired.jpg" width="300" />
                    </a>
                </div>
                <!-- Primary Nav -->
                <div class="hidden md:flex items-center space-x-1">
                    <a class="py-5 px-3 text-gray-700 hover:text-gray-900" href="#">
                        Home
                    </a>
                    <a class="py-5 px-3 text-gray-700 hover:text-gray-900" href="#">
                        About
                    </a>
                    <a class="py-5 px-3 text-gray-700 hover:text-gray-900" href="#">
                        Services
                    </a>
                    <a class="py-5 px-3 text-gray-700 hover:text-gray-900" href="#">
                        Contact
                    </a>
                </div>
            </div>
            <!-- Secondary Nav -->
            <div class="md:flex items-center space-x-1 hidden">

                <a class="py-2 px-3 bg-blue-500 text-white rounded hover:bg-blue-400" href="../logout.php">
                    logout
                </a>
                <!-- <a class="py-2 px-3 bg-white-500 text-black rounded hover:bg-gray-400 hover:text-white-400" >
                    </a> -->
                <a href="../profile_page.php" class="border-2 border-gray-300 rounded-lg hover:bg-gray-400 p-2 py-2 px-3 text-gray hover:text-white-400">
                    <i class="fas fa-user-circle text-gray pe-2"></i><?= $user_data['username'] ?>
                </a>
            </div>
            <!-- Mobile Button -->
            <div class="md:hidden flex items-center">
                <button class="mobile-menu-button">
                    <i class="fas fa-bars text-gray-700">
                    </i>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div class="mobile-menu hidden md:hidden">
        <a class="block py-2 px-4 text-sm hover:bg-gray-200" href="#">
            Home
        </a>
        <a class="block py-2 px-4 text-sm hover:bg-gray-200" href="#">
            About
        </a>
        <a class="block py-2 px-4 text-sm hover:bg-gray-200" href="#">
            Services
        </a>
        <a class="block py-2 px-4 text-sm hover:bg-gray-200" href="#">
            Contact
        </a>
        <a class="block py-2 px-4 text-sm hover:bg-gray-200" href="../logout.php">
            logout
        </a>
        <a href="../profile_page.php" class="block py-2 px-4 text-sm hover:bg-gray-200">
            <i class="fas fa-user-circle text-gray pe-2"></i><?= $user_data['username'] ?>
        </a>
        
    </div>
</nav>

</html>