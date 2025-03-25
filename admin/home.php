<?php include("./assets/header_admin.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .stat-card {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: white;
            transition: box-shadow 0.2s ease-in-out, transform 0.2s ease-in-out;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .stat-card h2 {
            font-size: 1rem;
            color: #4B5563;
            margin-bottom: 8px;
        }

        .stat-card p {
            font-size: 2.25rem;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-10 px-6">
        <header class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
            <p class="text-gray-600 mt-2">Gain insights into user activity and analytics</p>
        </header>

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users -->
            <div class="stat-card bg-white shadow-lg rounded-lg p-5">
                <h2 class="font-bold text-lg flex items-center">
                    <i class="fa-regular fa-user me-2 text-xl text-blue-500"></i>Total Users
                </h2>
                <div class="flex justify-between items-bottom mt-4">
                    <p class="text-2xl font-semibold text-blue-500 mr-20" id="totalUsers">0</p>
                    <a href="./users.php"
                        class="text-gray-500 hover:text-red-500 transition-all duration-200 ml-20">
                        <i class="fa-solid fa-arrow-right text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- New Sign ps -->
            <div class="stat-card">
                <h2 class="font-bold"><i class="fa-regular fa-user-circle me-2 text-xl text-purple-500"></i>New Sign Ups</h2>
                <p class="text-purple-600" id="newSignups">0</p>
            </div>


            <!-- Weekly Sign ups -->
            <div class="stat-card">
                <h2 class="font-bold"><i class="fa-regular fa-bookmark me-2 text-xl text-yellow-500"></i>Weekly Sign Ups</h2>
                <p class="text-yellow-600" id="weeklySignups">0</p>
            </div>

            <!-- Total Feedback Received -->
            <div class="stat-card bg-white shadow-lg rounded-lg p-5">
                <h2 class="font-bold text-lg flex items-center">
                    <i class="fa-regular fa-pen-to-square text-xl text-red-500 me-2"></i>
                    Feedback Received
                </h2>
                <div class="flex justify-between items-bottom mt-4">
                    <p class="text-2xl font-semibold text-red-500 mr-20" id="feedbackReceived">0</p>
                    <a href="./reviews_page_admin.php"
                        class="text-gray-500 hover:text-red-500 transition-all duration-200 ml-20">
                        <i class="fa-solid fa-arrow-right text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Contacts-->
            <div class="stat-card">
                <h2 class="font-bold"><i class="fa-regular fa-clipboard me-2 text-xl text-green-500"></i>Contacts</h2>

                <div class="flex justify-between items-bottom mt-4">
                    <p class="text-2xl font-semibold text-green-500 mr-20" id="contacts">0</p>
                    <!-- <a href="./contacts_admin_page.php"
                        class="text-gray-500 hover:text-green-500 transition-all duration-200 ml-20">
                        <i class="fa-solid fa-arrow-right text-xl"></i>
                    </a> -->
                </div>
            </div>
        </section>
    </div>

    <script>
        async function fetchData() {
            try {
                const response = await fetch('./assets/get_dashboard_stats.php'); // Fetch data from PHP backend
                const data = await response.json();

                document.getElementById('totalUsers').textContent = data.totalUsers || 0;
                document.getElementById('newSignups').textContent = data.newSignups || 0;
                document.getElementById('feedbackReceived').textContent = data.feedbackReceived || 0;
                document.getElementById('weeklySignups').textContent = data.weeklySignups || 0;
                document.getElementById('contacts').textContent = data.contacts || 0;
            } catch (error) {
                console.error('Error fetching dashboard stats:', error);
            }
        }

        // Fetch data on page load
        fetchData();
    </script>
</body>

</html>