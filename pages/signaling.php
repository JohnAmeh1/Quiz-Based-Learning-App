
<?php


// header('Content-Type: application/json');

// // Database configuration
// $db_host = 'localhost';
// $db_user = 'root';
// $db_pass = '';
// $db_name = 'learning_app';

// try {
//     // Create connection
//     $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

//     // Check connection
//     if ($conn->connect_error) {
//         throw new Exception('Database connection failed');
//     }

//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         // Get raw POST data
//         $data = json_decode(file_get_contents('php://input'), true);

//         // Validate required fields
//         if (empty($data['type']) || empty($data['sender']) || empty($data['recipient'])) {
//             echo json_encode(['error' => 'Missing required fields']);
//             exit;
//         }

//         // Prepare statement based on message type
//         $stmt = $conn->prepare("INSERT INTO webrtc_signaling 
//                                 (sender, recipient, type, sdp, candidate, call_type, timestamp) 
//                                 VALUES (?, ?, ?, ?, ?, ?, NOW())");

//         $sdp = $data['sdp'] ?? null;
//         $candidate = $data['candidate'] ?? null;
//         $callType = $data['callType'] ?? null;

//         $stmt->bind_param(
//             "ssssss",
//             $data['sender'],
//             $data['recipient'],
//             $data['type'],
//             $sdp,
//             $candidate,
//             $callType
//         );

//         if ($stmt->execute()) {
//             echo json_encode(['status' => 'success']);
//         } else {
//             echo json_encode(['error' => 'Failed to store message']);
//         }

//         $stmt->close();
//         exit;
//     } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
//         // Validate required parameters
//         if (empty($_GET['recipient'])) {
//             echo json_encode(['error' => 'Missing recipient parameter']);
//             exit;
//         }

//         $recipient = $_GET['recipient'];
//         $since = $_GET['since'] ?? 0;

//         // Get messages for recipient since specified timestamp
//         $stmt = $conn->prepare("SELECT * FROM webrtc_signaling 
//                                WHERE recipient = ? AND timestamp > FROM_UNIXTIME(?)
//                                ORDER BY timestamp ASC");
//         $stmt->bind_param("si", $recipient, $since);
//         $stmt->execute();
//         $result = $stmt->get_result();

//         $messages = [];
//         while ($row = $result->fetch_assoc()) {
//             $messages[] = [
//                 'type' => $row['type'],
//                 'sender' => $row['sender'],
//                 'recipient' => $row['recipient'],
//                 'sdp' => $row['sdp'],
//                 'candidate' => json_decode($row['candidate'], true), // Decode candidate JSON
//                 'callType' => $row['call_type'],
//                 'timestamp' => strtotime($row['timestamp'])
//             ];
//         }

//         // Delete retrieved messages to keep table clean
//         $deleteStmt = $conn->prepare("DELETE FROM webrtc_signaling WHERE recipient = ? AND timestamp <= NOW()");
//         $deleteStmt->bind_param("s", $recipient);
//         $deleteStmt->execute();
//         $deleteStmt->close();

//         echo json_encode($messages);
//         exit;
//     } else {
//         echo json_encode(['error' => 'Invalid request method']);
//     }
// } catch (Exception $e) {
//     echo json_encode(['error' => $e->getMessage()]);
// } finally {
//     $conn->close();
// }


header('Content-Type: application/json');

// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'learning_app';

try {
    // Create connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception('Database connection failed');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get raw POST data
        $data = json_decode(file_get_contents('php://input'), true);

        // Validate required fields
        if (empty($data['type']) || empty($data['sender']) || empty($data['recipient'])) {
            echo json_encode(['error' => 'Missing required fields']);
            exit;
        }

        // Prepare statement based on message type
        $stmt = $conn->prepare("INSERT INTO webrtc_signaling 
                                (sender, recipient, type, sdp, candidate, call_type, timestamp) 
                                VALUES (?, ?, ?, ?, ?, ?, NOW())");

        $sdp = $data['sdp'] ?? null;
        $candidate = isset($data['candidate']) ? json_encode($data['candidate']) : null; // Ensure candidate is JSON-encoded
        $callType = $data['callType'] ?? null;

        $stmt->bind_param(
            "ssssss",
            $data['sender'],
            $data['recipient'],
            $data['type'],
            $sdp,
            $candidate,
            $callType
        );

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['error' => 'Failed to store message']);
        }

        $stmt->close();
        exit;

    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Validate required parameters
        if (empty($_GET['recipient'])) {
            echo json_encode(['error' => 'Missing recipient parameter']);
            exit;
        }

        $recipient = $_GET['recipient'];
        $since = $_GET['since'] ?? 0;

        // Get messages for recipient since specified timestamp
        $stmt = $conn->prepare("SELECT * FROM webrtc_signaling 
                               WHERE recipient = ? AND timestamp > FROM_UNIXTIME(?)
                               ORDER BY timestamp ASC");
        $stmt->bind_param("si", $recipient, $since);
        $stmt->execute();
        $result = $stmt->get_result();

        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = [
                'type' => $row['type'],
                'sender' => $row['sender'],
                'recipient' => $row['recipient'],
                'sdp' => $row['sdp'],
                'candidate' => json_decode($row['candidate'], true), // Decode candidate JSON
                'callType' => $row['call_type'],
                'timestamp' => strtotime($row['timestamp'])
            ];
        }

        // Delete retrieved messages to keep table clean
        $deleteStmt = $conn->prepare("DELETE FROM webrtc_signaling WHERE recipient = ? AND timestamp <= NOW()");
        $deleteStmt->bind_param("s", $recipient);
        $deleteStmt->execute();
        $deleteStmt->close();

        echo json_encode($messages);
        exit;

    } else {
        echo json_encode(['error' => 'Invalid request method']);
    }

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    $conn->close();
}