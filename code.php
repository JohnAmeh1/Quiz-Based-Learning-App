<!-- leaderboard -->
<?php
// include("./ajaxPhp/navs.php");
// include("./assets/leaderboard.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .leaderboard {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .user {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .user:last-child {
            border-bottom: none;
        }

        .highlight {
            background-color: #ffefc2;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="leaderboard">
        <h1>Leaderboard</h1>
        <h2>Top 2 Users</h2>
        <?php if ($topUsersResult->num_rows > 0): ?>
            <?php while ($row = $topUsersResult->fetch_assoc()): ?>
                <div class="user">
                    <span><?php echo htmlspecialchars($row['username']); ?></span>
                    <span><?php echo htmlspecialchars($row['score']); ?></span>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No users found.</p>
        <?php endif; ?>

        <h2>Your Position</h2>
        <?php if ($currentUserResult->num_rows > 0): ?>
            <?php while ($row = $currentUserResult->fetch_assoc()): ?>
                <div class="user highlight">
                    <span><?php echo htmlspecialchars($row['username']); ?> (Position: <?php echo htmlspecialchars($row['position']); ?>)</span>
                    <span><?php echo htmlspecialchars($row['score']); ?></span>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Current user not found.</p>
        <?php endif; ?>
    </div>
</body>

</html>

<!-- 1 -->
<?php
// Database connection

// include("./php/all_files.php");

$userId = $_SESSION['auth'];
$query = "SELECT * from users where user_id = '$userId' LIMIT 1";

$DB = new Database();
$result = $DB->read($query);
if ($result) {
    $user_data = $result[0];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamifiedlearningapp";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get top 2 users
$topUsersQuery = "SELECT username, score FROM users ORDER BY score DESC LIMIT 5";
$topUsersResult = $conn->query($topUsersQuery);

// Get current user's position (replace 1 with your user's ID)
$user_id = $user_data["id"];
$currentUserId = $user_id; // Replace with the logged-in user's ID
$userPositionQuery = "
    SELECT username, score, FIND_IN_SET(score, (SELECT GROUP_CONCAT(score ORDER BY score DESC) FROM users)) AS position 
    FROM users 
    WHERE id = $currentUserId";
$currentUserResult = $conn->query($userPositionQuery);

$conn->close();
?>
<!-- l php  -->


<!-- dashboard  -->
<!-- navs  -->
<?php
include("./php/all_files.php");


$login = new Login();
$data = $login->val($_SESSION['allx']);


?>
<!-- navs  -->
<?php
include("./ajaxPhp/navs.php");
include("./ajaxPhp/user_auth.php");
include("./Php/submit.php");
include("./ajaxPhp/leaderboard.php");
$postnew = new Submit();
$pp = $postnew->user_pp();
$user_data = getUser();

$user_id = $user_data['id'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduQuest - Dashboard</title>
    <link href="./bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <!-- <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <!-- <link href="./assets/style.css" type="text/css" rel="stylesheet"> -->
    <link rel="icon" href="./img/eduquest-logo__1_-removebg-preview.png" alt="">
    <style>
        body {
            background-color: rgb(229, 229, 229);
            /* background: linear-gradient(120deg, #0f0c29, #302b63, #24243e); */
            color: #fff;
            /* font-family: 'Orbitron', sans-serif; */
            overflow-x: hidden;
        }

        .navbar {
            background-color: #fff;
        }

        .navbar-brand img {
            width: 180px;
        }

        .nav-link {
            color: purple !important;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #f39c12 !important;
        }

        .card {
            background: #fff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            /* box-shadow: 0 0 10px #39ff14; */
            /* color: #fff; */
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            /* box-shadow: 0 0 20px #39ff14; */
        }

        .grid-section h2 {
            /* font-family: 'Press Start 2P', cursive; */
            color: purple;
        }

        .card-title {
            font-size: 1.5rem;
            color: #f39c12;
        }

        .btn {
            background: #39ff14;
            border: none;
            color: #000;
            transition: background 0.3s, color 0.3s;
        }

        .btn:hover {
            background: #f39c12;
            color: #fff;
        }

        .social-links a {
            font-size: 1.5rem;
        }

        .modal-content {
            background: rgba(0, 0, 0, 0.9);
            border: 2px solid #39ff14;
        }

        .modal-title {
            color: #39ff14;
        }

        .form-control {
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            border: 1px solid #39ff14;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .form-control:focus {
            box-shadow: 0 0 10px #39ff14;
            border-color: #39ff14;
        }

        .card-icon {
            font-size: 40px;
            color: #f39c12;
        }

        .user {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            background-color: #ebe4e4;
            font-size: 17px;
        }

        .user_score {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            background-color: #ebe4e4;
            font-size: 17px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <!-- Logo Section -->
            <a class="navbar-brand text-white" href="./dashboard.php">
                <img src="./img/eduquest-sololearn-inspired-removebg-preview (1).png" alt="Logo" style="width: 180px;">
            </a>

            <!-- Navbar Toggler -->
            <button class="navbar-toggler" style="background-color: blueviolet;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Centered Dropdowns -->
                <ul class="navbar-nav mx-auto">
                    <!-- Dropdown for Courses -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" style="color:#4A4E69;" id="coursesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Courses
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="coursesDropdown">
                            <li><a class="dropdown-item" href="#">Web Development</a></li>
                            <li><a class="dropdown-item" href="#">Python Programming</a></li>
                            <li><a class="dropdown-item" href="#">Data Science</a></li>
                            <li><a class="dropdown-item" href="./courses.php">View All →</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown for Compilers -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color:#4A4E69;" href="#" id="achievementsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Compilers
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="achievementsDropdown">
                            <li><a class="dropdown-item" href="./compilers/html_compiler.php">Web Development</a></li>
                            <li><a class="dropdown-item" href="#">Badges</a></li>
                            <li><a class="dropdown-item" href="#">Leaderboard</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color:#4A4E69;" href="#" id="achievementsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Discuss
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="achievementsDropdown">
                            <li><a class="dropdown-item" href="./forum/index.php">Forum</a></li>
                            <li><a class="dropdown-item" href="#">Help</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#4A4E69;" href="./marketplace/marketPlace.php" id="marketplace" role="button" aria-expanded="false">
                            Marketplace
                        </a>
                        <!-- <ul class="dropdown-menu" aria-labelledby="marketplaceDropdown">
                            <li><a class="dropdown-item" href="#">Code Market Place</a></li>
                            <li><a class="dropdown-item" href="#">Job Board</a></li>
                        </ul> -->
                    </li>
                </ul>

                <!-- Profile Section -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" style="color:#4A4E69;" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-lg me-1"></i> Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <!-- <li><a class="dropdown-item" href="./dashboard.php">View Profile</a></li> -->
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <a href="./logout.php" class="rounded-2 bg-danger text-white btn-sm dropdown-item">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 py-5">
        <!-- Profile Header -->
        <div class="card shadow rounded-circle-lg mb-4 text-center">
            <div class="card-body">
                <!-- Profile Image -->
                <?php if ($pp != null): ?>
                    <?php foreach ($pp as $pic): ?>
                        <?php if ($pic['user_id'] === $user_data['user_id']): ?>
                            <div class="mb-4">
                                <img src="pp/<?= $pic['image_path'] ?>" class="profile-img rounded-circle"
                                    alt="User Profile Image" style="width: 180px; height: 180px; object-fit: cover; 
                                     border: 4px solid #f8f9fa;">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Profile Info -->
                <div class="mb-4">
                    <h1 class="h4 fw-bold mb-2"><i>hi,</i> <?= $user_data['username'] ?>!</h1>
                    <p class="text-muted mb-3"><?= $user_data['bio'] ?></p>
                    <div class="social-links">
                        <a href="#" class="text-decoration-none text-primary mx-2"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-decoration-none text-primary mx-2"><i class="fab fa-linkedin fa-lg"></i></a>
                        <a href="#" class="text-decoration-none text-dark mx-2"><i class="fab fa-github fa-lg"></i></a>
                    </div>
                </div>

                <!-- Stats Row -->
                <div class="row g-2 mt-2">
                    <div class="col-4">
                        <div class="p-3 border rounded-lg">
                            <h6 class="fw-bold mb-1">Points</h6>
                            <p class="h5  fw-bold mb-0">⭐<?= $user_data['score'] ?> XP</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border rounded-lg">
                            <h6 class="fw-bold mb-1">Followers</h6>
                            <p class="h5 text-primary fw-bold mb-0">120</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 border rounded-lg">
                            <h6 class="fw-bold mb-1">Following</h6>
                            <p class="h5 text-primary fw-bold mb-0">75</p>
                        </div>
                    </div>
                </div>

                <!-- Edit Button -->
                <a href="#" class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fas fa-pencil-alt"></i> Edit Profile
                </a>
            </div>
        </div>
        <div class="grid-section">
            <h2>Explore Your Learning Journey</h2>
            <div class="row g-4">
                <!-- Courses -->
                <div class="col-md-4">
                    <div class="card custom-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-book card-icon"></i>
                            <h5 class="card-title mt-3">Courses</h5>
                            <p class="card-text">Track your progress in various programming courses and keep learning.</p>
                            <a href="./courses.php"><button class="btn btn-primary">View Courses</button></a>
                        </div>
                    </div>
                </div>

                <!-- Achievements -->
                <div class="col-md-4">
                    <div class="card custom-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-trophy card-icon"></i>
                            <h5 class="card-title mt-3">Leaderboard</h5>
                            <!-- <p class="card-text">Showcase the badges and awards you've earned so far.</p> -->
                            <table class="leaderboard">
                                <h6 class="align-items-start d-flex">Top 2 Users</h6>
                                <?php if ($topUsersResult->num_rows > 0): ?>
                                    <?php
                                    $rowCount = 0; // Initialize a counter
                                    $totalRows = $topUsersResult->num_rows; // Get the total number of rows
                                    ?>
                                    <?php while ($row = $topUsersResult->fetch_assoc()): ?>
                                        <?php $rowCount++; // Increment the counter 
                                        ?>
                                        <div class="user">
                                            <span class=""><b><?php echo htmlspecialchars($row['username']); ?></b></span>
                                            <span class="position"><i class="fas fa-trophy text-warning"></i> <b><?php echo htmlspecialchars($row['score']); ?><span class="text-warning">XP</span></b></span>
                                            <br>
                                            <br>
                                        </div>
                                        <?php if ($rowCount < $totalRows): ?>
                                            <hr>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <p>No users found.</p>
                                <?php endif; ?>

                                <h6 class="align-items-start d-flex">Your Position</h6>
                                <?php if ($currentUserResult->num_rows > 0): ?>
                                    <?php while ($row = $currentUserResult->fetch_assoc()): ?>
                                        <div class="user_score">
                                            <span class=""><b><?php echo htmlspecialchars($row['username']); ?></b> (Position: <?php echo htmlspecialchars($row['position']); ?>)</span>
                                            <span class="position"><i class="fas fa-trophy text-warning"></i> <b><?php echo htmlspecialchars($row['score']); ?><span class="text-warning">XP</span></b></span>
                                        </div>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <p>Current user not found.</p>
                                <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Code Bits -->
                <div class="col-md-4">
                    <div class="card custom-card h-100"
                        <div class="card-body text-center">
                        <i class="fas fa-code card-icon"></i>
                        <h5 class="card-title mt-3">Code Arena</h5>
                        <p class="card-text">Challenge yourself with coding tasks.</p>
                        <button class="btn btn-primary">Enter Arena</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-light" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-profile-form">
                        <div id="response-message" class="mt-3"></div>
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" id="username" name="username"
                                placeholder="Username: <?= $user_data['username'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control mb-3" id="email" name="email"
                                placeholder="Email: <?= $user_data['email'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" id="bio" name="bio"
                                placeholder="Bio: <?= $user_data['bio'] ?>">
                        </div>
                        <button type="button" class="btn btn-primary w-100" onclick="updateProfile()">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="./bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script> -->
    <script>
        function updateProfile() {
            var userId = <?= $user_id ?>;
            var username = document.getElementById("username").value;
            var email = document.getElementById("email").value;
            var bio = document.getElementById("bio").value;

            $.ajax({
                type: "POST",
                url: "./ajaxPhp/update_profile.php",
                data: {
                    id: userId,
                    username: username,
                    email: email,
                    bio: bio,
                },
                success: function(response) {
                    $("#response-message").html('<div class="alert alert-success">' + response + '</div>');
                    window.location.href = "dashboard.php"
                    // window.location.reload();
                },
                error: function() {
                    $("#response-message").html('<div class="alert alert-danger">An error occurred.</div>');
                }
            });
        }
    </script>
</body>

</html>


<!-- single part with question  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page with Toggleable Sidebar</title>
    <link href="../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" href="../img/eduquest-logo__1_-removebg-preview.png" alt="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: rgb(229, 229, 229);
            margin-top: 4%;
            color: #000;
            overflow-x: hidden;
        }

        .navbar {
            background-color: #fff;
        }

        .navbar-brand img {
            width: 180px;
        }

        .nav-link {
            color: purple !important;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #f39c12 !important;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
                /* position: fixed; */
                top: 0;
                left: 0;
                width: 100%;
                height: 30vh;
                z-index: 1000;
                background-color: #343a40;
                overflow-y: auto;
                padding-top: 50px;
            }

            .sidebar.active {
                display: block;
            }
        }

        /* .sidebar{
            
            background-color: black;

        } */
        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .btn-custom {
            background-color: blueviolet;
            outline: none;
            color: #fff;
            border-radius: 15px;
            padding: 15px;
            border: none;
        }

        .col-lg-10 {
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">

            <a class="navbar-brand text-white" href="../dashboard.php">
                <img src="../img/eduquest-sololearn-inspired-removebg-preview (1).png" alt="Logo" style="width: 180px;">
            </a>

            <button class="navbar-toggler" style="background-color:blueviolet;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" style="color:#4A4E69;" id="coursesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Courses
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="coursesDropdown">
                            <li><a class="dropdown-item" href="#">Web Development</a></li>
                            <li><a class="dropdown-item" href="#">Python Programming</a></li>
                            <li><a class="dropdown-item" href="#">Data Science</a></li>
                            <li><a class="dropdown-item" href="../courses.php">View All →</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color:#4A4E69;" href="#" id="achievementsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Compilers
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="achievementsDropdown">
                            <li><a class="dropdown-item" href="../compilers/html_compiler.php">Web Development</a></li>
                            <li><a class="dropdown-item" href="#">Badges</a></li>
                            <li><a class="dropdown-item" href="#">Leaderboard</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color:#4A4E69;" href="#" id="achievementsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Discuss
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="achievementsDropdown">
                            <li><a class="dropdown-item" href="../forum/index.php">Forum</a></li>
                            <li><a class="dropdown-item" href="#">Help</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#4A4E69;" href="../marketplace/marketPlace.php" id="marketplace" role="button" aria-expanded="false">
                            Marketplace
                        </a>

                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" style="color:#4A4E69;" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-lg me-1"></i> Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">

                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <a href="../logout.php" class="rounded-2 bg-danger text-white btn-sm dropdown-item">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row ">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar col-lg-2 col-md-3 bg-dark vh-100 text-light p-4">
            <h2 class="fs-4 pt-4">Quiz Topics</h2>
            <ul class="list-unstyled mt-4">
                <li class="mb-2"><a href="#" class="text-light text-decoration-none topic-link" data-target="topic1">Topic 1</a></li>
                <li class="mb-2"><a href="#" class="text-light text-decoration-none topic-link" data-target="topic2">Topic 2</a></li>
                <li class="mb-2"><a href="#" class="text-light text-decoration-none topic-link" data-target="topic3">Topic 3</a></li>
                <li class="mb-2"><a href="#" class="text-light text-decoration-none topic-link" data-target="topic4">Topic 4</a></li>
                <li class="mb-2"><a href="#" class="text-light text-decoration-none topic-link" data-target="topic5">Topic 5</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-lg-10 col-md-9 p-4">
            <button id="toggleSidebar" style="margin-top: 10%;" class="btn-custom d-md-none mb-4">
                <i class="fas fa-bars"></i> Toggle Sidebar
            </button>

            <!-- Section: Default Content -->
            <!-- <section id="default-content" class="content-section active">
                <h1 class="fs-3 fw-bold mb-4">Section 1: HTML </h1>
                <p>Select a topic from the sidebar to start the quiz.</p>
            </section> -->

            <!-- Section: Topic 1 -->
            <section id="topic1" class="content-section active bg-white rounded shadow p-4">
                <h1 class="fs-3 fw-bold mb-4">HTML</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, ex nihil corporis deserunt quos obcaecati, saepe illum modi voluptate, provident hic
                    praesentium. Beatae, quod. Eos ut delectus, adipisci debitis non reiciendis, cumque voluptatem, tempore iusto numquam laboriosam. Fuga, dignissimos.
                    Quibusdam maiores similique qui exercitationem accusantium obcaecati dolorum necessitatibus ea impedit quasi deserunt quod, repellat adipisci! Ullam
                    error quos deserunt. Inventore, vel nobis. Nulla voluptatum velit ut eos, blanditiis dignissimos quo ratione, provident sunt obcaecati voluptatem,
                    quas ab eveniet placeat. Dignissimos aspernatur delectus nisi libero deserunt dolore possimus qui totam eum praesentium, impedit inventore? In illum
                    nesciunt itaque quas beatae fugiat, sint tempora ea iusto illo voluptate iure vero natus quam delectus magni inventore amet culpa veniam! Praesentium
                    aspernatur nisi sapiente magni officia maiores quibusdam reiciendis voluptate ipsa aliquid sed eum, esse assumenda enim ullam repellendus magnam distinctio
                    facilis tempora veniam similique corporis. Nihil modi natus architecto eveniet sed ipsam quos vero accusantium nobis cumque officia voluptatem, ducimus
                    perferendis, pariatur enim, delectus corrupti corporis. Temporibus distinctio corrupti sit fugiat quae, culpa similique veritatis reiciendis nemo harum
                    obcaecati dolorem, voluptates dolores modi tempore eaque, qui aut dignissimos fugit voluptatibus ipsam ex impedit eum libero. Deserunt, nisi sunt expedita
                </p>

                <p class="mb-3 fs-4 justify-content-center text-center">What does HTML stand for?</p>
                <form method="post" onsubmit="return false;">
                    <div class="form-check">
                        <button class="btn btn-primary" onclick="checkAnswer(this)" value="HyperText Markup Language" id="q1a">HyperText Markup Language</button>
                    </div>
                    <div class="form-check">
                        <button class="btn btn-primary" onclick="checkAnswer(this)" value="HyperText Machine Language" id="q1b">HyperText Machine Language</button>
                    </div>
                    <div class="form-check">
                        <button class="btn btn-primary" onclick="checkAnswer(this)" value="HyperTool Markup Language" id="q1c">HyperTool Markup Language</button>
                    </div>
                    <div class="form-check">
                        <button class="btn btn-primary" onclick="checkAnswer(this)" value="HyperText and Links Markup Language" id="q1d">HyperText and Links Markup Language</button>
                    </div>

                </form>
            </section>

            <!-- Section: Topic 2 -->
            <section id="topic2" class="content-section">
                <h1 class="fs-3 fw-bold mb-4">Topic 2</h1>
                <p>This is the content for Topic 2.</p>
                <p>Question: What is the capital of Germany?</p>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" id="berlin" name="question2" value="berlin">
                    <label class="form-check-label" for="berlin">Berlin</label>
                </div>
                <button class="btn btn-primary">Submit</button>
            </section>

            <!-- Section: Topic 3 -->
            <section id="topic3" class="content-section">
                <h1 class="fs-3 fw-bold mb-4">Topic 3</h1>
                <p>This is the content for Topic 3.</p>
                <p>Question: What is the capital of Spain?</p>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" id="madrid" name="question3" value="madrid">
                    <label class="form-check-label" for="madrid">Madrid</label>
                </div>
                <button class="btn btn-primary">Submit</button>
            </section>

            <!-- Additional Sections: Topics 4 & 5 -->
            <section id="topic4" class="content-section">
                <h1 class="fs-3 fw-bold mb-4">Topic 4</h1>
                <p>This is the content for Topic 4.</p>
            </section>
            <section id="topic5" class="content-section">
                <h1 class="fs-3 fw-bold mb-4">Topic 5</h1>
                <p>This is the content for Topic 5.</p>
            </section>
        </div>
    </div>

    <script>
        // Sidebar toggle functionality
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Content toggle functionality
        const topicLinks = document.querySelectorAll('.topic-link');
        const sections = document.querySelectorAll('.content-section');

        topicLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Hide all sections
                sections.forEach(section => {
                    section.classList.remove('active');
                });

                // Show the selected section
                const targetId = this.getAttribute('data-target');
                const targetSection = document.getElementById(targetId);
                targetSection.classList.add('active');
            });
        });
    </script>
    <script src="../bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function checkAnswer(button) {
            const correctAnswer = "HyperText Markup Language";
            if (button.value === correctAnswer) {
                alert("Correct!");
            } else {
                alert("Wrong!");
            }
        }
    </script>
</body>

</html>


<!-- update profile ajax -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamifiedlearningapp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $bio = $conn->real_escape_string($_POST["bio"]);

    if (empty($username)) {
        echo json_encode(['error' => 'Username is required.']);
        exit;
    }
    if (empty($email)) {
        echo json_encode(['error' => 'Email address is required.']);
        exit;
    }
    if (empty($bio)) {
        echo json_encode(['error' => 'Bio is required.']);
        exit;
    }

    $sql = "UPDATE users SET username='$username', email='$email', bio='$bio' WHERE id='$userId'";

    if ($conn->query($sql) === TRUE) {

        $updatedUser = fetchUserData($userId);

        echo json_encode('Profile updated successfully!');
    } else {
        echo json_encode(['error' => 'Error updating profile: ' . $conn->error]);
    }
} else {
    echo json_encode(['error' => 'Invalid request!']);
}

$conn->close();

function fetchUserData($userId)
{
    global $conn;

    $userId = intval($userId);

    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        return $userData;
    }

    return null; // Return null if user data is not found
}
?>

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "allx";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_SESSION['username'])) {
        echo "User not logged in.";
        exit();
    }

    $user_id = $_SESSION['username']['user_id'];
    $Id = $_SESSION['username']['id'];

    $sqlDeleteUser = "DELETE FROM users WHERE user_id = '$user_id'";
    $sqlDeletePost = "DELETE FROM user WHERE id = '$Id'";

    if ($conn->query($sqlDeleteUser) === TRUE) {
        session_destroy();
        echo "success";
    } else {
        echo "Error deleting account: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

<script>
    function updateProfile() {
        var userId = <?php echo $user_id; ?>;
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var name = document.getElementById("name").value;
        var number = document.getElementById("number").value;

        $.ajax({
            type: "POST",
            url: "./ajaxPhp/update_profile.php",
            data: {
                id: userId,
                username: username,
                email: email,
                name: name,
                number: number
            },
            success: function(response) {
                var responseMessage = $("#response-message");

                var successMessage = $('<div>').addClass('alert alert-success').text(response);

                responseMessage.html(successMessage);

                setTimeout(function() {
                    successMessage.hide();
                }, 3000);

                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function(error) {
                console.log("Error: " + error);
            }
        });
    }


    //delete account code 
    $(document).ready(function() {
        $("#deleteAccountBtn").click(function() {
            if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
                $.ajax({
                    type: "POST",
                    url: "./ajaxPhp/delete_account.php",
                    success: function(response) {
                        if (response === "success") {
                            window.location.href = "./index.php";
                        } else {
                            alert("Error deleting account: " + response);
                        }
                    },
                    error: function(error) {
                        console.log("Error: " + error);
                    }
                });
            }
        });
    });
</script>
<!-- user auth  -->
<?php

function getUser()
{
    $userId = $_SESSION['auth'];
    $query = "SELECT * from users where user_id = '$userId' LIMIT 1";

    $DB = new Database();
    $result = $DB->read($query);
    if ($result) {
        $user_data = $result[0];
        return $user_data;
    }
}

// signup 

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
        $number = $_POST["number"];
        $gender = $_POST["gender"];
        $password = $_POST["password"];

        if (empty($username)) {
            $em = "Username Is Required";
            header("location: signup.php?error=$em");
            exit;
        }
        if (empty($name)) {
            $em = "Full Name Is Required";
            header("location: signup.php?error=$em");
            exit;
        }
        if (empty($email)) {
            $em = "Email Address Is Required";
            header("location: signup.php?error=$em");
            exit;
        }
        if (empty($number)) {
            $em = "Phone Number Is Required";
            header("location: signup.php?error=$em");
            exit;
        }
        if (empty($gender)) {
            $em = "A Valid Gender Is Required";
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="css/mdb.min.css" />

    <link rel="stylesheet" href="css/admin.css" />
    <link href="./bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.css" rel="stylesheet">

    <link href="./bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="./stylez.css"> -->
    <link rel="icon" href="./img/13.png">
    <script src="./bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        .body {
            overflow: hidden;
            /* Prevent default body scrollbar due to fixed background */
        }

        .carousel-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .login-container {
            position: relative;
            z-index: 1;
        }
    </style>

    <title>Signup</title>
</head>

<body>
    <div class="carousel-container">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">

                    <img src="./img/car1.jpg" class="d-block w-100" alt="Slide 1">
                </div>
                <div class="carousel-item">

                    <img src="./img/car2.jpg" class="d-block w-100" alt="Slide 2">
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid login-container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-10 shadow rounded ">
                <div class="p-3">
                    <div class="">
                        <form enctype="multipart/form-data" class="card-body" method="post">
                            <h2 class="text-center card-title text-dark mb-4 d-flex justify-content-start"
                                style="font-size: 30px;">SIGN UP</h2>
                            <div class="row text-secondary">
                                <div class="col">
                                    <small>
                                        By continuing you agree to the Policy and Rules
                                    </small>
                                </div>
                                <div class="col">
                                    <!-- <div class="mt-3 d-flex justify-content-end" style="font-size: 14px;"> -->
                                    <small class="text-secondary">Already Have an Account?</small> <a href="index.php"
                                        style="text-decoration: none;font-family: 'Edu TAS Beginner', cursive;"
                                        class="text-success ms-1">Login Here</a>
                                    <!-- </div> -->
                                </div>
                            </div>

                            <!-- <small class="text-dark d-block" style="font-size: 12px;">Please note that the way the Matriculation Number is entered is how it will be saved.</small> -->

                            <!-- if (!empty($errorMessages)) {
                                 foreach ($errorMessages as $errorMessage) {
                                     echo "<div class='alert alert-warning' role='alert'>$errorMessage</div>";
                                 }
                             } -->
                            <?php if (isset($_GET['error'])) { ?>
                                <div class='alert alert-warning' role="alert">
                                    <i class="fas fa-x fa fw"></i>
                                    <?php echo htmlspecialchars($_GET['error']); ?>
                                </div>
                            <?php } ?>
                            <?php if (isset($_GET['success'])) { ?>
                                <div class='alert alert-success' role="alert">
                                    <i class="fas fa-check fa fw"></i>
                                    <?php echo htmlspecialchars($_GET['success']); ?>
                                </div>
                            <?php } ?>


                            <div class="row">
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                    <label for="username" class="form-label ms-2">Username</label>
                                </div>
                                <div class="form-floating mb-3 col-6">
                                    <input type="text" class="form-control" name="name" placeholder="Full Name">
                                    <label for="name" class="form-label ms-2">Full Name</label>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email"
                                    placeholder="Enter Your Email Address">
                                <label for="email" class="form-label">Email Address</label>
                            </div>

                            <div class="form-floating mb-3 ">
                                <input type="tel" class="form-control" name="number" placeholder="Number"
                                    maxlength="11">
                                <label for="number" class="form-label">Phone Number</label>
                            </div>

                            <div class="form-check mb-3">
                                <label class="form-check-label pe-4 m-auto text-dark">
                                    <input type="radio" class="form-check-input m-auto" name="gender" value="Male">Male
                                </label>
                                <label class="form-check-label pe-4 m-auto text-dark">
                                    <input type="radio" class="form-check-input m-auto" name="gender"
                                        value="Female">Female
                                </label>
                            </div>

                            <input type="file" id="image_path" name="image_path" accept="image/*"
                                class="form-control mb-3">

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password"
                                    placeholder="Enter Your Password" maxlength="15">
                                <label for="password" class="form-label">Password</label>
                            </div>

                            <div class="d-grid">
                                <input type="submit" name="signup" class="btn btn-primary" value="Sign-Up"
                                    style="font-size: 20px;">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="./bootstrap-5.3.1-dist/bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var carousel = new bootstrap.Carousel(document.getElementById('carouselExample'), {
                interval: 3000,
                pause: 'hover',
                wrap: true
            });
        });
    </script>
</body>

</html>


<!-- quiz results page  -->


<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Quiz Result
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-roboto">
    <div class="container mx-auto p-4">
        <header class="flex justify-between items-center py-4">
            <h1 class="text-2xl font-bold">
                Quiz Result
            </h1>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <a class="text-blue-500" href="#">
                            Home
                        </a>
                    </li>
                    <li>
                        <a class="text-blue-500" href="#">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a class="text-blue-500" href="#">
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <main class="bg-white p-4 rounded-lg shadow-md">
            <!-- Overall Score -->
            <div class="text-center mb-4">
                <h2 class="text-3xl font-semibold mb-2">
                    Your Score: 80%
                </h2>
                <p class="text-lg text-gray-600">
                    You answered 4 out of 5 questions correctly.
                </p>
            </div>
            <!-- Time Taken -->
            <div class="text-center mb-4">
                <h3 class="text-xl font-semibold mb-2">
                    Time Taken: 8 minutes 30 seconds
                </h3>
            </div>
            <!-- Correct/Incorrect Breakdown -->
            <div class="mb-4">
                <h3 class="text-xl font-semibold mb-2">
                    Breakdown
                </h3>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2">
                        </i>
                        Question 1: Correct
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2">
                        </i>
                        Question 2: Correct
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-times-circle text-red-500 mr-2">
                        </i>
                        Question 3: Incorrect
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2">
                        </i>
                        Question 4: Correct
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2">
                        </i>
                        Question 5: Correct
                    </li>
                </ul>
            </div>
            <!-- Detailed Explanations -->
            <div class="mb-4">
                <h3 class="text-xl font-semibold mb-2">
                    Detailed Explanations
                </h3>
                <div class="bg-gray-100 p-4 rounded-lg mb-2">
                    <h4 class="text-lg font-medium mb-1">
                        Question 3: What is the output of the following Python code?
                    </h4>
                    <pre class="bg-gray-200 p-2 rounded-lg overflow-x-auto">
<code class="language-python">
print("Hello, World!")
</code>
</pre>
                    <p class="text-sm text-gray-600">
                        Your Answer: Hello World
                    </p>
                    <p class="text-sm text-gray-600">
                        Correct Answer: Hello, World!
                    </p>
                    <p class="text-sm text-gray-600">
                        Explanation: The print function in Python outputs the string exactly as it is, including punctuation.
                    </p>
                </div>
            </div>
            <!-- Actions -->
            <div class="flex justify-between">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Retake Quiz
                </button>
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg">
                    Next Steps
                </button>
            </div>
        </main>
    </div>
</body>

</html>




<!-- Achievements and Badges -->
<section class="lg:col-span-3 bg-white p-4 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">
        Achievements and Badges
    </h2>
    <div class="flex flex-wrap space-x-4">
        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <i class="fas fa-medal text-yellow-500 text-3xl mb-2">
            </i>
            <p class="text-sm font-medium">
                Python Master
            </p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <i class="fas fa-trophy text-yellow-500 text-3xl mb-2">
            </i>
            <p class="text-sm font-medium">
                JavaScript Pro
            </p>
        </div>
        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <i class="fas fa-star text-yellow-500 text-3xl mb-2">
            </i>
            <p class="text-sm font-medium">
                Data Structures Guru
            </p>
        </div>
    </div>
</section>


<!-- admin panel  -->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Admin Panel
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-roboto">
    <div class="container mx-auto p-4">
        <header class="flex justify-between items-center py-4">
            <h1 class="text-2xl font-bold">
                Admin Panel
            </h1>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <a class="text-blue-500" href="#">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="text-blue-500" href="#">
                            Users
                        </a>
                    </li>
                    <li>
                        <a class="text-blue-500" href="#">
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <main class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Manage Quizzes and Topics -->
            <section class="lg:col-span-1 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Manage Quizzes and Topics
                </h2>
                <div class="mb-4">
                    <h3 class="text-lg font-medium mb-2">
                        Add New Topic
                    </h3>
                    <form>
                        <div class="mb-2">
                            <label class="block text-sm font-medium mb-1" for="topic-name">
                                Topic Name
                            </label>
                            <input class="w-full p-2 border border-gray-300 rounded-lg" id="topic-name" type="text" />
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-medium mb-1" for="topic-description">
                                Description
                            </label>
                            <textarea class="w-full p-2 border border-gray-300 rounded-lg" id="topic-description" rows="3">
                            </textarea>
                        </div>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                            Add Topic
                        </button>
                    </form>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium mb-2">
                        Update/Delete Topic
                    </h3>
                    <form>
                        <div class="mb-2">
                            <label class="block text-sm font-medium mb-1" for="select-topic">
                                Select Topic
                            </label>
                            <select class="w-full p-2 border border-gray-300 rounded-lg" id="select-topic">
                                <option>
                                    Python Basics
                                </option>
                                <option>
                                    JavaScript Fundamentals
                                </option>
                                <option>
                                    Data Structures
                                </option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-medium mb-1" for="update-description">
                                Update Description
                            </label>
                            <textarea class="w-full p-2 border border-gray-300 rounded-lg" id="update-description" rows="3">
                            </textarea>
                        </div>
                        <div class="flex space-x-2">
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg">
                                Update
                            </button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded-lg">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </section>
            <!-- Monitor User Performance and Feedback -->
            <section class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Monitor User Performance and Feedback
                </h2>
                <div class="mb-4">
                    <h3 class="text-lg font-medium mb-2">
                        User Performance
                    </h3>
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2">
                                    User
                                </th>
                                <th class="px-4 py-2">
                                    Topic
                                </th>
                                <th class="px-4 py-2">
                                    Progress
                                </th>
                                <th class="px-4 py-2">
                                    Score
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-gray-100">
                                <td class="border px-4 py-2">
                                    John Doe
                                </td>
                                <td class="border px-4 py-2">
                                    Python Basics
                                </td>
                                <td class="border px-4 py-2">
                                    75%
                                </td>
                                <td class="border px-4 py-2">
                                    80%
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">
                                    Jane Smith
                                </td>
                                <td class="border px-4 py-2">
                                    JavaScript Fundamentals
                                </td>
                                <td class="border px-4 py-2">
                                    50%
                                </td>
                                <td class="border px-4 py-2">
                                    70%
                                </td>
                            </tr>
                            <tr class="bg-gray-100">
                                <td class="border px-4 py-2">
                                    Alice Johnson
                                </td>
                                <td class="border px-4 py-2">
                                    Data Structures
                                </td>
                                <td class="border px-4 py-2">
                                    30%
                                </td>
                                <td class="border px-4 py-2">
                                    60%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium mb-2">
                        User Feedback
                    </h3>
                    <div class="space-y-2">
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="text-sm font-medium">
                                John Doe
                            </p>
                            <p class="text-xs text-gray-500">
                                2 hours ago
                            </p>
                            <p>
                                The Python Basics topic is very informative and well-structured.
                            </p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="text-sm font-medium">
                                Jane Smith
                            </p>
                            <p class="text-xs text-gray-500">
                                1 day ago
                            </p>
                            <p>
                                I found the JavaScript Fundamentals topic a bit challenging. More examples would be helpful.
                            </p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="text-sm font-medium">
                                Alice Johnson
                            </p>
                            <p class="text-xs text-gray-500">
                                3 days ago
                            </p>
                            <p>
                                The Data Structures topic is great, but the quizzes could be more diverse.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Analytics on App Usage -->
            <section class="lg:col-span-3 bg-white p-4 rounded-lg shadow-md mt-4">
                <h2 class="text-xl font-semibold mb-4">
                    Analytics on App Usage
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                        <h3 class="text-lg font-medium mb-2">
                            Total Users
                        </h3>
                        <p class="text-3xl font-bold">
                            150
                        </p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                        <h3 class="text-lg font-medium mb-2">
                            Active Users
                        </h3>
                        <p class="text-3xl font-bold">
                            75
                        </p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                        <h3 class="text-lg font-medium mb-2">
                            Topics Completed
                        </h3>
                        <p class="text-3xl font-bold">
                            200
                        </p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                        <h3 class="text-lg font-medium mb-2">
                            Quizzes Taken
                        </h3>
                        <p class="text-3xl font-bold">
                            300
                        </p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                        <h3 class="text-lg font-medium mb-2">
                            Average Score
                        </h3>
                        <p class="text-3xl font-bold">
                            85%
                        </p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg text-center">
                        <h3 class="text-lg font-medium mb-2">
                            Feedback Received
                        </h3>
                        <p class="text-3xl font-bold">
                            50
                        </p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>


<!-- help & support  -->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Help and Support
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-roboto">
    <div class="container mx-auto p-4">
        <header class="flex justify-between items-center py-4">
            <h1 class="text-2xl font-bold">
                Help and Support
            </h1>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <a class="text-blue-500" href="#">
                            Home
                        </a>
                    </li>
                    <li>
                        <a class="text-blue-500" href="#">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="text-blue-500" href="#">
                            Profile
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <main class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- FAQs -->
            <section class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Frequently Asked Questions
                </h2>
                <div class="space-y-4">
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h3 class="text-lg font-medium mb-2">
                            How do I reset my password?
                        </h3>
                        <p>
                            To reset your password, go to the login page and click on "Forgot Password." Follow the instructions to reset your password.
                        </p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h3 class="text-lg font-medium mb-2">
                            How do I update my profile information?
                        </h3>
                        <p>
                            To update your profile information, go to your profile page and click on "Edit Profile." Make the necessary changes and save.
                        </p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h3 class="text-lg font-medium mb-2">
                            How do I contact support?
                        </h3>
                        <p>
                            You can contact support by filling out the contact form on this page or by using the live chat feature.
                        </p>
                    </div>
                </div>
            </section>
            <!-- Contact Form -->
            <section class="lg:col-span-1 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Contact Support
                </h2>
                <form>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="name">
                            Name
                        </label>
                        <input class="w-full p-2 border border-gray-300 rounded-lg" id="name" type="text" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="email">
                            Email
                        </label>
                        <input class="w-full p-2 border border-gray-300 rounded-lg" id="email" type="email" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="message">
                            Message
                        </label>
                        <textarea class="w-full p-2 border border-gray-300 rounded-lg" id="message" rows="4">
                        </textarea>
                    </div>
                    <div class="text-center">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                            Submit
                        </button>
                    </div>
                </form>
            </section>
            <!-- Tutorials and Documentation -->
            <section class="lg:col-span-3 bg-white p-4 rounded-lg shadow-md mt-4">
                <h2 class="text-xl font-semibold mb-4">
                    Tutorials and Documentation
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h3 class="text-lg font-medium mb-2">
                            Getting Started
                        </h3>
                        <p>
                            Learn how to get started with our platform, including account setup and basic navigation.
                        </p>
                        <a class="text-blue-500" href="#">
                            Read More
                        </a>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h3 class="text-lg font-medium mb-2">
                            Using the Dashboard
                        </h3>
                        <p>
                            Understand how to use the dashboard to track your progress and access various features.
                        </p>
                        <a class="text-blue-500" href="#">
                            Read More
                        </a>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <h3 class="text-lg font-medium mb-2">
                            Advanced Features
                        </h3>
                        <p>
                            Explore advanced features like quizzes, coding challenges, and more.
                        </p>
                        <a class="text-blue-500" href="#">
                            Read More
                        </a>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>



<!-- settings -->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Settings
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-roboto">
    <div class="container mx-auto p-4">
        <header class="flex justify-between items-center py-4">
            <h1 class="text-2xl font-bold">
                Settings
            </h1>
            <nav>
                <ul class="flex space-x-4">
                    <li>
                        <a class="text-blue-500" href="#">
                            Home
                        </a>
                    </li>
                    <li>
                        <a class="text-blue-500" href="#">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="text-blue-500" href="#">
                            Profile
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <main class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Notification Preferences -->
            <section class="lg:col-span-1 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Notification Preferences
                </h2>
                <form>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="email-notifications">
                            Email Notifications
                        </label>
                        <select class="w-full p-2 border border-gray-300 rounded-lg" id="email-notifications">
                            <option>
                                Enabled
                            </option>
                            <option>
                                Disabled
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="app-notifications">
                            App Notifications
                        </label>
                        <select class="w-full p-2 border border-gray-300 rounded-lg" id="app-notifications">
                            <option>
                                Enabled
                            </option>
                            <option>
                                Disabled
                            </option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                            Save Changes
                        </button>
                    </div>
                </form>
            </section>
            <!-- Privacy Settings -->
            <section class="lg:col-span-1 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Privacy Settings
                </h2>
                <form>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="profile-visibility">
                            Profile Visibility
                        </label>
                        <select class="w-full p-2 border border-gray-300 rounded-lg" id="profile-visibility">
                            <option>
                                Public
                            </option>
                            <option>
                                Private
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="search-engine-indexing">
                            Search Engine Indexing
                        </label>
                        <select class="w-full p-2 border border-gray-300 rounded-lg" id="search-engine-indexing">
                            <option>
                                Enabled
                            </option>
                            <option>
                                Disabled
                            </option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                            Save Changes
                        </button>
                    </div>
                </form>
            </section>
            <!-- Account Management -->
            <section class="lg:col-span-1 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">
                    Account Management
                </h2>
                <form>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="current-password">
                            Current Password
                        </label>
                        <input class="w-full p-2 border border-gray-300 rounded-lg" id="current-password" type="password" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="new-password">
                            New Password
                        </label>
                        <input class="w-full p-2 border border-gray-300 rounded-lg" id="new-password" type="password" />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2" for="confirm-password">
                            Confirm New Password
                        </label>
                        <input class="w-full p-2 border border-gray-300 rounded-lg" id="confirm-password" type="password" />
                    </div>
                    <div class="text-center mb-4">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                            Change Password
                        </button>
                    </div>
                </form>
                <div class="text-center">
                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg">
                        Delete Account
                    </button>
                </div>
            </section>
        </main>
    </div>
</body>

</html>

// const number = '<?php echo $number; ?>';
<!-- paystack  -->
<?php
$prices = "8000";
$email = $_SESSION['username']["email"];
$username = $_SESSION['username']['username'];

?>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    function payWithPaystack() {
        const api = "pk_test_fdeb97ce15dc119e28cc589fcb24fac669b14f81";
        var handler = PaystackPop.setup({
            key: api,
            email: '<?php echo $email; ?>',
            amount: <?php echo $prices * 100; ?>,
            currency: "NGN",
            ref: '' + Math.floor((Math.random() * 1000000000) + 1),
            firstname: "<?php echo $username; ?>",
            metadata: {
                custom_fields: [{
                    display_name: "<?php echo $username; ?>",
                }]
            },
            callback: function(response) {
                const referenced = response.reference;
                // const randomCode = generateRandomCode();
                window.location.href = 'home.php';
            },
            onClose: function() {
                alert('window closed');
            }
        });

        handler.openIframe();
    }

    // function generateRandomCode() {
    //     // Generate a random code using a UUID library or another suitable method
    //     // For demonstration purposes, using a simple random string generator
    //     const randomString = Math.random().toString(36).substring(7);
    //     return randomString;
    // }
</script>




<!-- process_quiz  -->
<?php
include("./php/all_files.php");
include("./assets/user_auth.php");

header("Content-Type: application/json"); // Ensure JSON response

// Debugging settings
error_reporting(E_ALL);
ini_set('display_errors', 1); // Show errors for debugging
ini_set('log_errors', 1);
ini_set('error_log', 'error_log.txt'); // Log errors

// Database connection
$conn = mysqli_connect("localhost", "root", "", "learning_app");
if (!$conn) {
    echo json_encode(["error" => "Connection failed: " . mysqli_connect_error()]);
    exit;
}

// Get user data
$user_data = getUser();
if (!$user_data || !isset($user_data['user_id'])) {
    echo json_encode(["error" => "User not logged in."]);
    exit;
}

$user_id = intval($user_data['id']); // Ensure user_id is an integer
$score = 0;
$total = 0;
$game_points = 0;

// Check if $_POST is empty
if (empty($_POST)) {
    echo json_encode(["error" => "No quiz answers submitted."]);
    exit;
}

foreach ($_POST as $key => $value) {
    if (strpos($key, "quiz_") === 0) {
        $quiz_id = intval(str_replace("quiz_", "", $key)); // Extract quiz ID

        // Fetch correct answer from the database
        $query = "SELECT correct_option FROM quizzes WHERE id = $quiz_id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo json_encode(["error" => "Database query failed."]);
            exit;
        }

        $row = mysqli_fetch_assoc($result);
        if ($row && isset($row['correct_option'])) {
            $correct_option = trim(strtolower($row['correct_option']));
            if ($correct_option === trim(strtolower($value))) {
                $score++; // Increment score for correct answers
                $game_points += 50; // Add points for correct answers
            }
        }
        $total++; // Increment total questions
    }
}

// Update user's score only if they exist
$update_query = "UPDATE users SET score = score + $game_points WHERE id = $user_id";
$update_result = mysqli_query($conn, $update_query);

if (!$update_result) {
    echo json_encode(["error" => "Failed to update user score."]);
    exit;
}

mysqli_close($conn); // Close database connection

// Return JSON response
echo json_encode([
    "score" => $score,
    "total" => $total,
    "game_points" => $game_points
]);

exit(); // Prevent extra output
