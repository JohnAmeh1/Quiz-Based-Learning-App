<?php
include("./assets/header_admin.php");
$conn = new mysqli("localhost", "root", "", "learning_app");

// Fetch all contacts
$contacts_query = $conn->query("SELECT * FROM contact ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contacts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
    <style>
        @media (max-width: 640px) {
            .responsive-table {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .responsive-table thead {
                display: none;
            }

            .responsive-table tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #e2e8f0;
                border-radius: 0.375rem;
            }

            .responsive-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem;
                border-bottom: 1px solid #e2e8f0;
            }

            .responsive-table td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #4a5568;
                margin-right: 1rem;
            }

            .action-buttons {
                justify-content: flex-end !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Contact Messages</h1>
            <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 text-sm sm:px-4 sm:py-2 sm:text-base rounded-lg w-full sm:w-auto">
                    <i class="fas fa-print mr-2"></i> Print
                </button>
                <button onclick="exportToCSV()" class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 text-sm sm:px-4 sm:py-2 sm:text-base rounded-lg w-full sm:w-auto">
                    <i class="fas fa-file-export mr-2"></i> Export CSV
                </button>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="responsive-table">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while ($contact = $contacts_query->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 whitespace-nowrap" data-label="ID"><?= htmlspecialchars($contact['id']) ?></td>
                                <td class="px-4 py-4 whitespace-nowrap" data-label="Name"><?= htmlspecialchars($contact['username']) ?></td>
                                <td class="px-4 py-4 whitespace-nowrap" data-label="Email">
                                    <a href="mailto:<?= htmlspecialchars($contact['email']) ?>" class="text-blue-500 hover:underline">
                                        <?= htmlspecialchars($contact['email']) ?>
                                    </a>
                                </td>
                                <td class="px-4 py-4" data-label="Message">
                                    <div class="truncate max-w-xs" title="<?= htmlspecialchars($contact['message']) ?>">
                                        <?= htmlspecialchars(substr($contact['message'], 0, 50)) ?>...
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap" data-label="Date"><?= date('M d, Y h:i A', strtotime($contact['created_at'])) ?></td>
                                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium action-buttons">
                                    <button onclick="viewMessage(<?= $contact['id'] ?>)"
                                        class="text-indigo-600 hover:text-indigo-900 mr-4"
                                        title="View">
                                        <i class="fas fa-eye"></i> <span class="hidden sm:inline">View</span>
                                    </button>
                                    <button onclick="confirmDelete(<?= $contact['id'] ?>)"
                                        class="text-red-600 hover:text-red-900"
                                        title="Delete">
                                        <i class="fas fa-trash"></i> <span class="hidden sm:inline">Delete</span>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Message View Modal -->
    <div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl max-h-[80vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <!-- <h3 class="text-xl font-bold" id="modalSubject"></h3>  -->
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mb-4">
                <p class="font-semibold">From: <span id="modalSender"></span></p>
                <p class="text-sm text-gray-500" id="modalDate"></p>
            </div>
            <div class="border-t pt-4">
                <p class="whitespace-pre-line" id="modalMessage"></p>
            </div>
            <div class="mt-6 flex justify-end">
                <button onclick="closeModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // View full message
        function viewMessage(id) {
            fetch('./assets/get_contact_message.php?id=' + id)
                .then(response => {
                    // First check if the response is OK (status 200-299)
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // Then check if the content type is JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new TypeError("Oops, we didn't get JSON!");
                    }
                    return response.json();
                })
                .then(data => {
                    // Check if there's an error in the JSON response
                    if (data.error) {
                        throw new Error(data.error);
                    }

                    // Populate the modal with data
                    // document.getElementById('modalSubject').textContent = data.subject || 'No Subject';
                    document.getElementById('modalSender').textContent =
                        (data.username || 'Unknown') + ' <' + (data.email || 'no email') + '>';
                    document.getElementById('modalDate').textContent =
                        'Sent on ' + new Date(data.created_at).toLocaleString();
                    document.getElementById('modalMessage').textContent = data.message;
                    document.getElementById('messageModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading message: ' + error.message);
                });
        }

        function closeModal() {
            document.getElementById('messageModal').classList.add('hidden');
        }

        // Delete contact message
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this contact message?')) {
                fetch('./assets/delete_contact.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'id=' + id
                    })
                    .then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            alert('Failed to delete message');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        // Export to CSV
        function exportToCSV() {
            fetch('./assets/export_contacts.php')
                .then(response => response.blob())
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'contacts_export_' + new Date().toISOString().slice(0, 10) + '.csv';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);
                });
        }
    </script>
</body>

</html>