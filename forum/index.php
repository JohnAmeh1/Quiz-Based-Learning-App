<?php
require('config.inc.php');
require('functions.php');

$page = $_GET['page'] ?? 1;
$page = (int)$page;

if ($page < 1) {
    $page = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="EduQuest Community Forum - Share and learn together">
    <title>EduQuest - Community Forum</title>
    
    <!-- Fonts and Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="./img/brain.jpg">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        },
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                    },
                },
            },
        }
    </script>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .post-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        
        .hide {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <?php include('header.inc.php') ?>
    
    <main class="container mx-auto px-4 py-8 min-h-screen">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="flex-1">
                <?php include('success.alert.inc.php') ?>
                <?php include('fail.alert.inc.php') ?>
                
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Community Posts</h1>
                    <?php if (logged_in()): ?>
                        <button onclick="document.querySelector('.js-post-input').focus()" 
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-100">
                            <i class="fas fa-pen-to-square mr-2"></i>
                            New Post
                        </button>
                    <?php endif; ?>
                </div>
                
                <section class="js-posts space-y-4 mb-6 w-full p-1 overflow-y-auto">
                    <div class="text-center py-8 animate-pulse">
                        <div class="inline-block rounded-full bg-primary-100 p-4">
                            <i class="fas fa-spinner fa-spin text-primary-600 text-xl"></i>
                        </div>
                        <p class="mt-4 text-gray-600">Loading posts...</p>
                    </div>
                </section>
                
                <!-- Pagination -->
                <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm">
                    <button onclick="mypost.prev_page()" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-primary-100">
                        <i class="fas fa-chevron-left mr-2"></i>
                        Previous
                    </button>
                    <span class="js-page-number text-sm font-medium text-gray-700">Page 1</span>
                    <button onclick="mypost.next_page()" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-primary-100">
                        Next
                        <i class="fas fa-chevron-right ml-2"></i>
                    </button>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <?php if (logged_in()): ?>
                    <form onsubmit="mypost.submit(event)" method="post" class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Create a Post</h2>
                        <textarea 
                            placeholder="Share your thoughts with the community..." 
                            name="post" 
                            class="js-post-input w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                            rows="4"
                        ></textarea>
                        <button class="mt-4 w-full inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-100">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Post
                        </button>
                    </form>
                <?php else: ?>
                    <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                        <i class="fas fa-lock text-4xl text-gray-400 mb-4"></i>
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">Join the Discussion</h2>
                        <p class="text-gray-600 mb-4">Sign in to share your thoughts and engage with the community</p>
                        <button onclick="login.show()" 
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-100">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
    <?php include('signup.inc.php') ?>
    <?php include('login.inc.php') ?>
    <?php include('post.edit.inc.php') ?>
    
    <!-- Post Card Template -->
    <div class="js-post-card hide">
        <div class="post-card bg-white p-6 rounded-lg shadow-sm animate-fade-in">
            <div class="flex items-center justify-between mb-4">
                <a href="#" class="js-profile-link flex items-center space-x-3">
                    <img src="assets/images/user.jpg" class="js-image w-10 h-10 rounded-full">
                    <span class="js-username text-sm font-medium text-gray-900"></span>
                </a>
                <span class="js-date text-sm text-gray-500"></span>
            </div>
            
            <p class="js-post text-gray-700 mb-4"></p>
            
            <div class="flex items-center justify-end">
                <div class="js-comment-link inline-flex items-center text-sm text-primary-600 hover:text-primary-700 cursor-pointer">
                    <i class="fas fa-comment mr-2"></i>
                    Comments
                </div>
            </div>
        </div>
    </div>
    
    <script>
        var page_number = <?= $page ?>;
        var home_page = true;
    </script>
    <script src="./assets/js/mypost.js?v3"></script>
</body>
</html>