<?php
include("./assets/header_1.php");
include("./assets/leaderboard.php");
include("./php/submit.php");

$postnew = new Submit();
$pp = $postnew->user_pp();
$user_data = getUser();

$user_id = $user_data['id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        EduQuest - Profile
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="icon" href="./img/brain.jpg">
</head>

<body class="bg-gradient-to-r from-blue-50 to-blue-100 font-roboto">
    <?php  ?>

    <div class="container mx-auto p-4">
        <!-- Profile Header -->
        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col items-center">

            <?php if ($pp != null): ?>
                <?php foreach ($pp as $pic): ?>
                    <?php if ($pic['user_id'] === $user_data['user_id']): ?>

                        <img src="pp/<?= $pic['image_path'] ?>" class="w-32 h-32 rounded-full mx-auto mb-4"
                            alt="User Profile Image">

                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="text-center">
                <div class="text-3xl text-gray-800">
                    <span class="text-3xl font-bold">
                        hi,
                    </span>
                    <i class="font-medium"> <?= $user_data['username'] ?></i> !
                </div>

                <p class="text-gray-600">
                    <!-- Web Developer -->
                    Learning Enthusiast
                </p>
                <div class="mt-4">
                    <a class="text-blue-500 hover:underline" href="<?= $user_data['fb'] ?>">
                        <i class="fab fa-twitter"></i>

                    </a>
                    <a class="text-blue-500 hover:underline ml-4" href="<?= $user_data['fb'] ?>">
                        <i class="fab fa-linkedin"></i>

                    </a>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="mt-6 bg-white shadow-lg rounded-lg">
            <nav class="flex flex-col md:flex-row">
                <a class="py-4 px-6 text-center text-gray-700 hover:bg-gray-200 hover:text-gray-900 border-b md:border-b-0 md:border-r cursor-pointer" onclick="openModal()">
                    Edit Profile
                </a>
                <a class="py-4 px-6 text-center text-gray-700 hover:bg-gray-200 hover:text-gray-900" onclick="openSettingsModal()">
                    Settings
                </a>
            </nav>
        </div>
        <!-- edit profile  -->
        <div id="editProfileModal" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 sm:w-2/3 lg:w-1/3">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Edit Profile</h2>
                    <button class="text-gray-500 hover:text-gray-800" onclick="closeModal()">×</button>
                </div>
                <form class="mt-2" id="edit-profile-form" method="post">
                    <div id="response-message" class="mt-2"></div>

                    <!-- Username Field -->
                    <div class="mb-2 flex space-x-4">
                        <!-- Username Field -->
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700" for="username">Username</label>
                            <input type="text" id="username" name="username" class="mt-1 block w-full border rounded-md py-2 px-3" placeholder="<?= $user_data['username'] ?>">
                        </div>

                        <!-- Email Field -->
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700" for="email">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full border rounded-md py-2 px-3" placeholder="<?= $user_data['email'] ?>">
                        </div>
                    </div>

                    <!-- Bio Field -->
                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-700" for="bio">Bio</label>
                        <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border rounded-md py-2 px-3" placeholder="<?= $user_data['bio'] ?>"></textarea>
                    </div>

                    <!-- Social Media Fields -->
                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-700" for="fb">Facebook Link</label>
                        <input type="text" id="fb" name="fb" class="block w-full border rounded-md py-2 px-3" placeholder="<?= $user_data['fb'] ?>">
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-700" for="tw">Twitter Link</label>
                        <input type="text" id="tw" name="tw" class="block w-full border rounded-md py-2 px-3" placeholder="<?= $user_data['tw'] ?>">
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm font-medium text-gray-700" for="yt">YouTube Link</label>
                        <input type="text" id="yt" name="yt" class="block w-full border rounded-md py-2 px-3" placeholder="<?= $user_data['yt'] ?>">
                    </div>

                    <!-- Save Changes Button -->
                    <button type="button" class="w-full px-6 py-3 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 transition-transform transform hover:scale-105 
                    focus:outline-none focus:ring-2 focus:ring-blue-400" onclick="update_Profile()">Save Changes</button>
                </form>
            </div>
        </div>
        <div id="settingsModal" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 sm:w-2/3 lg:w-1/3">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Settings</h2>
                    <button onclick="closeSettingsModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Profile Settings -->
                <div class="mb-4">
                    <label for="deactivateAccount" class="block text-sm font-medium text-gray-700">Deactivate Account</label>
                    <p class="text-xs text-gray-500">Deactivating your account will permanently disable it.</p>
                    <button id="deactivateAccount" class="w-full inline-block px-6 py-3 mt-2 text-white bg-red-500 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                        Deactivate Account
                    </button>
                </div>

                <!-- Notification Settings -->
                <!-- <div class="mb-4">
                    <label for="notifications" class="block text-sm font-medium text-gray-700">Email Notifications</label>
                    <select id="notifications" name="notifications" class="mt-1 block w-full border rounded-md py-2 px-3">
                        <option value="all">All</option>
                        <option value="mentions">Mentions Only</option>
                        <option value="none">None</option>
                    </select>
                </div> -->

                <!-- Theme Settings -->
                <div class="mb-4">
                    <label for="theme" class="block text-sm font-medium text-gray-700">Select Theme</label>
                    <select id="theme" name="theme" class="mt-1 block w-full border rounded-md py-2 px-3">
                        <option value="light">Light</option>
                        <option value="dark">Dark</option>
                    </select>
                </div>

            </div>
        </div>


        <!-- Profile Content Grid -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- About Me -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    About Me
                </h3>
                <p class="text-gray-700 mb-4">
                    <?= $user_data['bio'] ?>
                </p>

                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    Skills
                </h3>
                <ul class="list-disc list-inside text-gray-700 mb-4">
                    <li>
                        HTML
                    </li>
                    <li>
                        CSS
                    </li>
                    <li>
                        JavaScript
                    </li>
                    <li>
                        React
                    </li>
                    <li>
                        Node.js
                    </li>
                </ul>
            </div>
            <!-- Recent Activity -->
            <!-- <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    Recent Activity
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <img alt="Icon representing a completed course" class="w-10 h-10 rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/W5rrtHZAKhaIJN5ZcXN3szPcjpeYfUQZNWSVu5zyjk03hJ7TA.jpg" width="40" />
                        <div class="ml-4">
                            <p class="text-gray-700">
                                Completed the course
                                <span class="font-bold text-gray-800">
                                    Introduction to HTML
                                </span>
                            </p>
                            <p class="text-gray-500 text-sm">
                                2 days ago
                            </p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <img alt="Icon representing a completed challenge" class="w-10 h-10 rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/RXXIzDZIZcZeXqL5chETKnzyeifBXP07zr60eh0fHcfaewk9JA.jpg" width="40" />
                        <div class="ml-4">
                            <p class="text-gray-700">
                                Completed the challenge
                                <span class="font-bold text-gray-800">
                                    JavaScript Basics
                                </span>
                            </p>
                            <p class="text-gray-500 text-sm">
                                5 days ago
                            </p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <img alt="Icon representing a new achievement" class="w-10 h-10 rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/zRfhY12jFVWqJyh0Pwba05xQjsxNxP43GUggGVISmQH8wk9JA.jpg" width="40" />
                        <div class="ml-4">
                            <p class="text-gray-700">
                                Earned the badge
                                <span class="font-bold text-gray-800">
                                    React Developer
                                </span>
                            </p>
                            <p class="text-gray-500 text-sm">
                                1 week ago
                            </p>
                        </div>
                    </li>
                </ul>
            </div> -->
            <!-- Courses -->
            <!-- <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    Courses
                </h3>
                <ul class="list-disc list-inside text-gray-700 mb-4">
                    <li>
                        Introduction to HTML
                    </li>
                    <li>
                        Advanced CSS Techniques
                    </li>
                    <li>
                        JavaScript for Beginners
                    </li>
                    <li>
                        React Development
                    </li>
                    <li>
                        Node.js and Express
                    </li>
                </ul>
            </div> -->
            <!-- Achievements -->
            <!-- <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    Achievements
                </h3>
                <ul class="list-disc list-inside text-gray-700 mb-4">
                    <li>
                        Completed 100+ coding challenges
                    </li>
                    <li>
                        Top 10% in JavaScript course
                    </li>
                    <li>
                        Certified React Developer
                    </li>
                    <li>
                        Contributor to open-source projects
                    </li>
                </ul>
            </div> -->
            <!-- Leaderboard -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                    Leaderboard
                </h3>
                <h6 class="text-2xl font-bold text-gray-800 mb-4 text-lg">
                    Top 3 Users
                </h6>
                <ul class="list-decimal list-inside text-gray-600 mb-4">
                    <?php if ($topUsersResult->num_rows > 0): ?>
                        <?php
                        $rowCount = 0; // Initialize a counter
                        $totalRows = $topUsersResult->num_rows; // Get the total number of rows
                        ?>
                        <?php while ($row = $topUsersResult->fetch_assoc()): ?>
                            <?php $rowCount++; // Increment the counter 
                            ?>
                            <li>
                                <span class=""><b><?php echo htmlspecialchars($row['username']); ?></b></span>
                                <span class=""> - <b><?php echo htmlspecialchars($row['score']); ?><span class="text-amber-500">XP</span></b></span>
                                <br>
                                <br>
                            </li>
                            <?php if ($rowCount < $totalRows): ?>
                                <hr>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No users found.</p>
                    <?php endif; ?>
                    <h6 class="text-2xl font-bold text-gray-800 mb-4 text-lg">
                        Your Position
                    </h6>
                    <?php if ($currentUserResult->num_rows > 0): ?>
                        <?php while ($row = $currentUserResult->fetch_assoc()): ?>
                            <div class="user_score">
                                <span class=""><b><?php echo htmlspecialchars($row['username']); ?></b> (Position: <?php echo htmlspecialchars($row['position']); ?>)</span>
                                <span class=""> - <b><?php echo htmlspecialchars($row['score']); ?><span class="text-amber-500">XP</span></b></span>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>Current user not found.</p>
                    <?php endif; ?>
                    <a href="./pages/leaderboard_page.php"
                        class="inline-block px-6 py-3 mt-4 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 transition-transform transform hover:scale-105 
                    focus:outline-none focus:ring-2 focus:ring-blue-400">View All</a>
                </ul>
            </div>
        </div>
    </div>
    <?php include("./assets/footer_1.php") ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function update_Profile() {
            const userId = <?= $user_id ?>;
            const username = document.getElementById("username").value;
            const email = document.getElementById("email").value;
            const bio = document.getElementById("bio").value;
            const fb = document.getElementById("fb").value;
            const tw = document.getElementById("tw").value;
            const yt = document.getElementById("yt").value;

            $.ajax({
                type: "POST",
                url: "./assets/update_profile.php",
                data: {
                    id: userId,
                    username: username,
                    email: email,
                    bio: bio,
                    fb: fb,
                    tw: tw,
                    yt: yt,
                },
                success: function(response) {
                    const res = JSON.parse(response);
                    if (res.error) {
                        $("#response-message").html(`<div class="bg-red-500 text-white p-3 rounded">${res.error}</div>`);
                    } else {
                        $("#response-message").html(`<div class="bg-green-500 text-white p-3 rounded">${res}</div>`);
                        setTimeout(() => window.location.href = "./profile_page.php", 2000);
                    }
                },
                error: function() {
                    $("#response-message").html('<div class="bg-red-500 text-white p-3 rounded">An error occurred. Please try again.</div>');
                }
            });
        }


        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");

        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });

        function openModal() {
            document.getElementById('editProfileModal').classList.remove('hidden');
            document.getElementById('editProfileModal').classList.add('flex');
        }

        // Function to close modal
        function closeModal() {
            document.getElementById('editProfileModal').classList.remove('flex');
            document.getElementById('editProfileModal').classList.add('hidden');
        }

        function openSettingsModal() {
            document.getElementById('settingsModal').classList.remove('hidden');
        }

        // Function to close the settings modal
        function closeSettingsModal() {
            document.getElementById('settingsModal').classList.add('hidden');
        }
        $(document).ready(function () {
            $("#deactivateAccount").click(function () {
                if (confirm("Are you sure you want to deactivate your account? This action cannot be undone.")) {
                    $.ajax({
                        type: "POST",
                        url: "./assets/delete_account.php",
                        success: function (response) {
                            if (response === "success") {
                                window.location.location = "./index.php";
                            } else {
                                alert("Error deleting account: " + response);
                            }
                        },
                        error: function (error) {
                            console.log("Error: " + error);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>