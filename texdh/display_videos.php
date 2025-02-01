<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch videos
$sql = "SELECT id, title, description, video_path FROM videos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Uploaded Videos</h1>
    </header>

    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='card'>
                    <h2>" . htmlspecialchars($row['title']) . "</h2>
                    <p>" . htmlspecialchars($row['description']) . "</p>
                    <video controls width='100%'>
                        <source src='" . htmlspecialchars($row['video_path']) . "' type='video/mp4'>
                        Your browser does not support the video tag.
                    </video>
                </div>";
            }
        } else {
            echo "<p>No videos available.</p>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2024 E-commerce Platform</p>
    </footer>
</body>

</html>

<?php
$conn->close();
?>
