
<?php
require('config.inc.php');
require('functions.php');

$post_id = $_GET['id'] ?? 0;

$query = "select * from posts where id = '$post_id' limit 1";
$row = query($query);

if ($row) {
    $row = $row[0];
    $id = $row['user_id'];
    $query = "select * from users where user_id = '$id' limit 1";
    $user_row = query($query);

    if ($user_row) {
        $row['user'] = $user_row[0];
        $row['user']['image'] = get_image($user_row[0]['image_path']);
    }
}

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
    <meta name="description" content="View and discuss posts on EduQuest Community Forum">
    <title>EduQuest - Discussion Thread</title>
    
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
                        'slide-up': 'slideUp 0.3s ease-out',
                    },
                },
            },
        }
    </script>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .hide {
            display: none;
        }
        
        .comment-card {
            transition: all 0.2s ease;
        }
        
        .comment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans min-h-screen">
    <?php include('header.inc.php') ?>
    
    <main class="container mx-auto px-4 py-8">
        <?php include('success.alert.inc.php') ?>
        <?php include('fail.alert.inc.php') ?>
        
        <?php if (!empty($row)): ?>
            <!-- Main Post -->
			<div id="post_<?= $row['id'] ?>" row="<?= htmlspecialchars(json_encode($row)) ?>" class="bg-white rounded-lg shadow-sm mb-8 animate-fade-in">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <a href="profile.php?id=<?= $row['user']['user_id'] ?? 0 ?>" 
                           class="flex items-center space-x-3">
                            <img src="<?= $row['user']['image'] ?>" 
                                 alt="Profile" 
                                 class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">
                                    <?= $row['user']['username'] ?? 'Unknown' ?>
                                </h2>
                                <span class="text-sm text-gray-500">
                                    <?= date("jS M, Y H:i:s a", strtotime($row['date'])) ?>
                                </span>
                            </div>
                        </a>
                        
                        <?php if (i_own_post($row)): ?>
                            <div class="flex items-center space-x-4">
                                <button onclick="postedit.show(<?= $row['id'] ?>)" 
                                        class="inline-flex items-center text-primary-600 hover:text-primary-700">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit
                                </button>
                                <button onclick="mypost.delete(<?= $row['id'] ?>)" 
                                        class="inline-flex items-center text-red-600 hover:text-red-700">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    Delete
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="prose max-w-none text-gray-700">
                        <?= nl2br(htmlspecialchars($row['post'])) ?>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <section class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Comments</h2>
                
                <?php if (logged_in()): ?>
                    <form onsubmit="mycomment.submit(event)" method="post" class="mb-8">
                        <div class="flex space-x-4">
                            <textarea 
                                placeholder="Add to the discussion..." 
                                name="post" 
                                class="js-comment-input flex-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                rows="3"
                            ></textarea>
                            <button class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-100">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Comment
                            </button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="bg-gray-50 rounded-lg p-6 text-center mb-8">
                        <i class="fas fa-lock text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Join the Discussion</h3>
                        <p class="text-gray-600 mb-4">Sign in to share your thoughts on this post</p>
                        <button onclick="login.show()" 
                                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-100">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In
                        </button>
                    </div>
                <?php endif; ?>
                
                <div class="js-comments space-y-4">
                    <div class="text-center py-8 animate-pulse">
                        <div class="inline-block rounded-full bg-primary-100 p-4">
                            <i class="fas fa-spinner fa-spin text-primary-600 text-xl"></i>
                        </div>
                        <p class="mt-4 text-gray-600">Loading comments...</p>
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="flex justify-between items-center mt-6 pt-6 border-t border-gray-200">
                    <button onclick="mycomment.prev_page()" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-primary-100">
                        <i class="fas fa-chevron-left mr-2"></i>
                        Previous
                    </button>
                    <span class="js-page-number text-sm font-medium text-gray-700">Page 1</span>
                    <button onclick="mycomment.next_page()" 
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-primary-100">
                        Next
                        <i class="fas fa-chevron-right ml-2"></i>
                    </button>
                </div>
            </section>
            
        <?php else: ?>
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <i class="fas fa-exclamation-circle text-4xl text-red-500 mb-4"></i>
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Post Not Found</h2>
                <p class="text-gray-600">This post may have been removed or doesn't exist.</p>
                <a href="index.php" 
                   class="inline-flex items-center px-4 py-2 mt-4 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-100">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Forums
                </a>
            </div>
        <?php endif; ?>
    </main>
    
    <?php include('login.inc.php') ?>
    <?php include('signup.inc.php') ?>
    <?php include('post.edit.inc.php') ?>
    
    <!-- Comment Card Template -->
    <div class="js-comment-card hide">
        <div class="comment-card bg-white p-4 rounded-lg border border-gray-200 animate-slide-up">
            <div class="flex items-center justify-between mb-3">
                <a href="#" class="js-profile-link flex items-center space-x-3">
                    <img src="assets/images/user.jpg" class="js-image w-10 h-10 rounded-full object-cover">
                    <span class="js-username font-medium text-gray-900"></span>
                </a>
                <span class="js-date text-sm text-gray-500"></span>
            </div>
            
            <div class="js-comment text-gray-700 mb-4"></div>
            
            <div class="js-action-buttons flex items-center justify-end space-x-4">
                <button class="js-edit-button inline-flex items-center text-primary-600 hover:text-primary-700">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </button>
                <button class="js-delete-button inline-flex items-center text-red-600 hover:text-red-700">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Delete
                </button>
            </div>
        </div>
    </div>
    
    <script>
        var page_number = <?= $page ?>;
        var post_id = <?= $post_id ?>;
    </script>
    <script src="./assets/js/mypost.js?v3"></script>
    <script src="./assets/js/mycomment.js?v3"></script>
</body>
</html>