<?php

require('config.inc.php');
require('functions.php');

$page = $_GET['page'] ?? 1;
$page = (int)$page;

if ($page < 1)
	$page = 1;

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>EduQuest - Community Forum</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
	<script src="https://cdn.tailwindcss.com"></script>
	<link
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
		rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap"
		rel="stylesheet" />
	<link rel="icon" href="./img/brain.jpg">
</head>

<body class="overflow-y-hidden ">

	<style>
		@keyframes appear {
			0% {
				opacity: 0;
			}

			100% {
				opacity: 1;
			}
		}

		.hide {
			display: none;
		}

		@keyframes grow-shrink {

			0%,
			100% {
				transform: scale(1);
				/* Normal size */
			}

			50% {
				transform: scale(1.2);
				/* Grow */
			}
		}

		.animate-grow-shrink {
			animation: grow-shrink 1.5s infinite ease-in-out;
		}
	</style>
	<section class="bg-gray-100 font-roboto flex-col ">

		<?php include('header.inc.php') ?>
		<div class="flex h-screen p-4 flex-1 flex flex-col md:flex-row">
			<!-- Main Content -->
			<div class="flex-1 flex flex-col p-4 mb-5 ">
				<?php include('success.alert.inc.php') ?>
				<?php include('fail.alert.inc.php') ?>

				<h1 class="text-xl font-bold mb-2">Posts</h1>
				<section class="js-posts rounded shadow mb-4 w-full p-1 overflow-y-auto">
					<div style="padding:10px;text-align:center;">Loading posts....</div>
				</section>

				<div class="flex justify-between items-center bg-gray-200 p-4">
					<button onclick="mypost.prev_page()" class="cursor-pointer px-4 py-2 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 
                    focus:outline-none focus:ring-2 focus:ring-blue-400">
						Prev page
					</button>
					<div class="js-page-number">Page 1</div>
					<button onclick="mypost.next_page()" class="cursor-pointer px-4 py-2 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 
                    focus:outline-none focus:ring-2 focus:ring-blue-400">
						Next page
					</button>
				</div>
			</div>

			<!-- Right Bar -->
			<?php if (logged_in()): ?> 
				<form onsubmit="mypost.submit(event)" method="post" class=" w-full md:w-1/3 p-4 bg-gray-200 overflow-y-auto order-first md:order-none">
					<div class="bg-white p-4 rounded shadow">
						<textarea placeholder="What's on your mind?" name="post" class="js-post-input w-full p-2 border rounded mb-2" rows="4"></textarea>
						<button class=" px-4 py-2 rounded w-full inline-block text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 
                    focus:outline-none focus:ring-2 focus:ring-blue-400"><i class="fa-solid fa-paper-plane"></i></button>
					</div>
				</form>
			<?php else: ?>
				<div class="w-1/3 p-4 bg-gray-200 text-center">
					<i class="bi bi-info-circle-fill"></i>
					<div onclick="login.show()" style="cursor:pointer;">
						You're not logged in <br>Click here to login and post
					</div>
				</div>
			<?php endif; ?>
		</div>

		<br><br>
		<?php include('signup.inc.php') ?>
		<?php include('login.inc.php') ?>
		<?php include('post.edit.inc.php') ?>
	</section>

	<!--post card template-->
	<div class="js-post-card hide bg-white p-2 rounded shadow mb-2">
		<a href="#" class="js-profile-link flex justify-between mb-2">
			<img src="assets/images/user.jpg" class="js-image class_47">
			<h2 class="js-username text-gray-500 text-sm">
				Jane Name
			</h2>
		</a>
		<div class="">

			<div class="js-post ">
				is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets c
			</div>
			<div class="flex justify-between items-center">
				<h4 class="js-date text-gray-500 " style="font-size: 10px;">
					3rd Jan 23 14:35 pm
				</h4>
				<div class="flex items-center">
					<i class="cursor-pointer fa-solid fa-comment text-blue-500 text-md mr-1"></i>
					<!-- <i class="bi bi-chat-left-dots text-gray-500 text-md mr-2"></i> -->
					<div class="js-comment-link cursor-pointer text-blue-500 text-md">
						Comments
					</div>
				</div>

			</div>

		</div>
	</div>


</body>

<script>
	var page_number = <?= $page ?>;
	var home_page = true;
</script>
<script src="./assets/js/mypost.js?v3"></script>

</html>