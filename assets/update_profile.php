<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $bio = $conn->real_escape_string($_POST["bio"]);
    $fb = $conn->real_escape_string($_POST["fb"]);
    $tw = $conn->real_escape_string($_POST["tw"]);
    $yt = $conn->real_escape_string($_POST["yt"]);

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

    $sql = "UPDATE users SET username='$username', email='$email', bio='$bio', fb='$fb', tw='$tw', yt='$yt' WHERE id='$userId'";

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

    return null;
}

?>
// header('Content-Type: application/json');

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "learning_app";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     echo json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]);
//     exit;
// }

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $userId = intval($_POST['id']);
//     $username = $conn->real_escape_string($_POST["username"]);
//     $email = $conn->real_escape_string($_POST["email"]);
//     $bio = $conn->real_escape_string($_POST["bio"]);
//     $fb = $conn->real_escape_string($_POST["fb"]);
//     $tw = $conn->real_escape_string($_POST["tw"]);
//     $yt = $conn->real_escape_string($_POST["yt"]);

//     if (empty($username) || empty($email)) {
//         echo json_encode(['error' => 'Username and Email are required.']);
//         exit;
//     }

//     $sql = "UPDATE users SET username='$username', email='$email', bio='$bio', fb='$fb', tw='$tw', yt='$yt' WHERE id=$userId";
//     if ($conn->query($sql) === TRUE) {
//         echo json_encode('Profile updated successfully!');
//     } else {
//         echo json_encode(['error' => 'Error updating profile: ' . $conn->error]);
//     }
// } else {
//     echo json_encode(['error' => 'Invalid request method.']);
// }

// $conn->close();
// ?>
