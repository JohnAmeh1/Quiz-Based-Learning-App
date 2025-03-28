<?php
include("./assets/header_admin.php");
$conn = new mysqli("localhost", "root", "", "learning_app");

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="contacts_export.csv"');

$output = fopen('php://output', 'w');

// Write CSV headers
fputcsv($output, ['ID', 'Name', 'Email', 'Subject', 'Message', 'Date']);

// Fetch and write data
$query = "SELECT * FROM contact ORDER BY created_at DESC";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['id'],
        $row['name'],
        $row['email'],
        $row['subject'],
        $row['message'],
        $row['created_at']
    ]);
}

fclose($output);
exit;
