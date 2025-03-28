<?php
include("./assets/header_admin.php");
$conn = new mysqli("localhost", "root", "", "learning_app");

// Fetch all courses
$courses_query = $conn->query("SELECT * FROM courses ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
    <style>
        @media (max-width: 767px) {
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
                text-align: right;
            }

            .responsive-table td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #4a5568;
                margin-right: 1rem;
                float: left;
            }

            .action-buttons {
                justify-content: flex-end !important;
            }

            .status-badge {
                margin-left: auto;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Manage Courses</h1>
            <a href="post_courses.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg w-full sm:w-auto text-center">
                <i class="fas fa-plus mr-2"></i> Add New Course
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="responsive-table">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php while ($course = $courses_query->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 whitespace-nowrap" data-label="ID"><?= htmlspecialchars($course['id']) ?></td>
                                <td class="px-4 py-4 whitespace-nowrap" data-label="Name"><?= htmlspecialchars($course['name']) ?></td>
                                <td class="px-4 py-4" data-label="Description">
                                    <div class="truncate max-w-xs">
                                        <?= htmlspecialchars(substr($course['description'], 0, 50)) ?>...
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap" data-label="Status">
                                    <span class="status-badge px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?= $course['is_premium'] ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                                        <?= $course['is_premium'] ? 'Premium' : 'Free' ?>
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium action-buttons">
                                    <button onclick="togglePremium(<?= $course['id'] ?>, <?= $course['is_premium'] ? 0 : 1 ?>)"
                                        class="text-indigo-600 hover:text-indigo-900 mr-4"
                                        title="<?= $course['is_premium'] ? 'Make Free' : 'Make Premium' ?>">
                                        <i class="fas fa-exchange-alt"></i> <span class="hidden sm:inline"><?= $course['is_premium'] ? 'Make Free' : 'Make Premium' ?></span>
                                    </button>
                                    <button onclick="confirmDelete(<?= $course['id'] ?>)"
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

    <script>
        async function togglePremium(courseId, newStatus) {
            try {
                const response = await fetch('update_course_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `course_id=${courseId}&is_premium=${newStatus}`
                });

                if (response.ok) {
                    location.reload(); // Refresh to show changes
                } else {
                    alert('Failed to update course status');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred');
            }
        }

        function confirmDelete(courseId) {
            if (confirm('Are you sure you want to delete this course? This will also delete all its sections and content.')) {
                deleteCourse(courseId);
            }
        }

        async function deleteCourse(courseId) {
            try {
                const response = await fetch('delete_course.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `course_id=${courseId}`
                });

                if (response.ok) {
                    location.reload(); // Refresh to show changes
                } else {
                    alert('Failed to delete course');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred');
            }
        }
    </script>
</body>

</html>