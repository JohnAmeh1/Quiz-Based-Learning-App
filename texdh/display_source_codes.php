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

// Fetch source codes
$sql = "SELECT id, title, description, price, file_path FROM source_codes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Source Codes</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Available Source Codes</h1>
    </header>

    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='card'>
                    <h2>" . htmlspecialchars($row['title']) . "</h2>
                    <p>" . htmlspecialchars($row['description']) . "</p>
                    <p><strong>Price:</strong> $" . number_format($row['price'], 2) . "</p>
                    <a href='" . htmlspecialchars($row['file_path']) . "' download>Download</a>
                </div>";
            }
        } else {
            echo "<p>No source codes available.</p>";
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
