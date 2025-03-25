<?php
// Database connection (Update with your own credentials)
include("./assets/header_admin.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learning_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL Query to fetch specific columns from the users table
$sql = "SELECT user_id, name, username, email, account_type, badge, signup_date FROM users WHERE account_type != 'admin'";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Error fetching data: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users Table</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Users Table Data</h1>
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Wrap the table in a scrollable container -->
            <div class="overflow-x-auto overflow-y-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider whitespace-nowrap">#</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider whitespace-nowrap">User ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider whitespace-nowrap">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider whitespace-nowrap">Username</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider whitespace-nowrap">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider whitespace-nowrap">Account Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider whitespace-nowrap">Badge</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider whitespace-nowrap">Signup Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        // Check if there are any rows in the result
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='hover:bg-gray-50 transition-colors'>";
                                echo "<td class='px-4 py-3 text-sm text-gray-900 whitespace-nowrap'>$counter</td>";
                                echo "<td class='px-4 py-3 text-sm text-gray-900 whitespace-nowrap'>" . htmlspecialchars($row['user_id']) . "</td>";
                                echo "<td class='px-4 py-3 text-sm text-gray-900 whitespace-nowrap'>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td class='px-4 py-3 text-sm text-gray-900 whitespace-nowrap'>" . htmlspecialchars($row['username']) . "</td>";
                                echo "<td class='px-4 py-3 text-sm text-gray-900 whitespace-nowrap'>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td class='px-4 py-3 text-sm text-gray-900 whitespace-nowrap'>" . htmlspecialchars($row['account_type']) . "</td>";
                                echo "<td class='px-4 py-3 text-sm text-gray-900 whitespace-nowrap'>" . htmlspecialchars($row['badge']) . "</td>";
                                echo "<td class='px-4 py-3 text-sm text-gray-900 whitespace-nowrap'>" . htmlspecialchars($row['signup_date']) . "</td>";
                                echo "<td class='px-4 py-3 text-sm text-gray-900 whitespace-nowrap'>
                                    <button onclick='deleteUser(\"" . $row['user_id'] . "\")' class='bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition-colors whitespace-nowrap'>
                                        Delete User
                                    </button>
                                </td>";
                                echo "</tr>";
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='9' class='px-4 py-3 text-sm text-gray-900 text-center'>No data found in the users table.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                $.ajax({
                    type: "POST",
                    url: "./assets/delete_user.php", // Path to the delete script
                    data: {
                        user_id: userId
                    },
                    success: function(response) {
                        alert(response); // Show success or error message
                        location.reload(); // Reload the page to reflect changes
                    },
                    error: function() {
                        alert("An error occurred while deleting the user.");
                    }
                });
            }
        }
    </script>
</body>

</html>
<?php
// Close the database connection
$conn->close();
?>