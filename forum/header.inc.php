<?php defined('APP') or die('direct script access denied!'); ?>

<body>
	<div id="preloader" class="fixed inset-0 flex flex-col items-center justify-center bg-gray-100 z-50">
		<!-- Icon or Logo -->
		<img src="./img/brain.jpg"
			alt="Quiz Icon"
			class="w-16 h-16 animate-grow-shrink mb-4 rounded-full shadow-lg border-2 border-blue-400 p-1">
		<!-- Loading Text -->
		<p class="text-gray-700 text-lg font-medium animate-pulse">
			Loading...
		</p>
	</div>

	<header id="content" class=" bg-white shadow-lg">
		<div class="max-w-6xl mx-auto px-4">
			<div class="flex justify-between">
				<div class="flex space-x-4">
					<!-- Logo -->
					<div>
						<a
							class="flex items-center gap-4 m-1 py-3 px-4 rounded-full shadow-md border border-blue-500 bg-blue-50 hover:bg-blue-100 hover:shadow-lg transition-all duration-300 ease-in-out"
							href="./dashboard.php">
							<!-- Logo Section -->
							<img
								alt="EduQuest Logo"
								class="w-12 h-12 rounded-full border border-blue-400 shadow-sm"
								src="./img/brain.jpg" />
							<!-- Brand Name -->
							<span class="text-lg font-semibold text-blue-600 hover:text-blue-800">
								EduQuest
							</span>
						</a>
					</div>

					<!-- Primary Nav -->
					<div class="hidden lg:flex items-center space-x-1">
						<a class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg" href="../dashboard.php">
							Home
						</a>

						<!-- Courses Link -->
						<a class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg" href="../courses.php">
							Courses
						</a>
						<!-- About Dropdown -->
						<div class="relative">
							<button id="pagesDropdownButton" class="py-4 px-5 text-gray-800 hover:text-blue-600 focus:outline-none font-semibold text-lg flex items-center space-x-2 transition-all duration-300 ease-in-out">
								pages
								<i class="fas fa-chevron-down ml-2"></i>
							</button>
							<div id="pagesDropdownMenu" class="absolute hidden bg-white shadow-lg rounded-lg mt-2 w-48 z-10 border border-gray-300">
								<a href="../pages/about.php" class="block font-semibold px-4 py-2 text-gray-700 hover:bg-gray-100">About Us</a>
								<a href="#" class="block font-semibold px-4 py-2 text-gray-700 hover:bg-gray-100">Our Team</a>
								<a href="../pages/contact.php" class="block font-semibold px-4 py-2 text-gray-700 hover:bg-gray-100">Contact Us</a>
								<a href="#" class="block font-semibold px-4 py-2 text-gray-700 hover:bg-gray-100">Company History</a>
							</div>
						</div>

						<a class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg" href="../pages/Learner_Mentor.php">
							Mentorship
						</a>

						<!-- Community Link -->
						<a class="py-4 px-5 text-gray-800 hover:text-blue-600 transition-all duration-300 ease-in-out font-semibold text-lg" href="./index.php">
							Community
						</a>
					</div>
				</div>

				<!-- Secondary Nav -->
				<div class="lg:flex items-center space-x-1 hidden">
					<a href="../profile_page.php" class="flex items-center gap-4 py-3 px-4 rounded-lg shadow-md border border-blue-500 bg-blue-50 hover:bg-blue-100 hover:shadow-lg transition-all duration-300 ease-in-out space-x-3">
						<span class="text-lg font-semibold text-blue-600 hover:text-blue-800">
							<i class="fas fa-user-circle text-gray pe-2"></i><?= $_SESSION['USER']['username'] ?>
						</span>
					</a>
					<a class="py-3 px-4 bg-red-600 text-white rounded hover:bg-red-500" href="../logout.php">
						logout
					</a>
				</div>

				<!-- Mobile Button -->
				<div class="lg:hidden flex items-center">
					<button id="mobileMenuButton" class="mobile-menu-button">
						<i class="fas fa-bars text-gray-700"></i>
					</button>
				</div>
			</div>
		</div>

		<!-- Mobile Menu -->
		<div id="mobileMenu" class="mobile-menu hidden lg:hidden bg-gray-800 text-white">
			<a class="block py-3 px-5 text-lg hover:bg-gray-700 transition-all duration-300" href="../dashboard.php">
				Home
			</a>

			<a class="block py-3 px-5 text-lg hover:bg-gray-700 transition-all duration-300" href="../courses.php">
				Courses
			</a>

			<a href="../pages/about.php" class="block px-5 py-3 text-lg hover:bg-gray-700 transition-all duration-300">About Us</a>
			<a href="#" class="block px-5 py-3 text-lg hover:bg-gray-700 transition-all duration-300">Our Team</a>
			<a href="../pages/contact.php" class="block px-5 py-3 text-lg hover:bg-gray-700 transition-all duration-300">Contact Us</a>
			<a href="#" class="block px-5 py-3 text-lg hover:bg-gray-700 transition-all duration-300">Company History</a>
			<a class="block py-3 px-5 text-lg hover:bg-gray-700 transition-all duration-300" href="../pages/learner_mentor.php">
				Connect With Mentor
			</a>
			<a class="py-5 px-5 text-lg hover:bg-gray-700 transition-all duration-300" href="./index.php">
				Community
			</a>
			<a class="block py-3 px-5 text-lg bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-all duration-300" href="../logout.php">
				Logout
			</a>

			<!-- Refined Profile Link -->
			<a href="../profile_page.php" class="block py-3 px-5 text-lg flex items-center space-x-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300">
				<i class="fas fa-user-circle text-2xl"></i>
				<span><?= $_SESSION['USER']['username'] ?></span>
			</a>
		</div>

	</header>
</body>
<!-- <header class="class_2">
	<div class="class_3">
		<img src="assets/images/slack.png" class="class_4">
	</div>
	<div class="item_class_0 class_5">
		<div class="item_class_1 class_6">
			<svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path d="m22 16.75c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm0-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm0-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75z" fill-rule="nonzero">
				</path>
			</svg>
		</div>
		<div class="item_class_2 class_7">
			<a href="index.php" class="class_8">
				Forum
			</a>
			<a href="#" class="class_8">
				About us
			</a>
			<a href="#" class="class_8">
				Contact us
			</a>
		</div>
	</div>
	<div class="class_9" style="display:flex;align-items: center;justify-content: center;">
		<?php if (logged_in()): ?>
			<a href="profile.php">
				<img src="<?= get_image($_SESSION['USER']['image_path']) ?>" class="class_10">
			</a>
			<a href="profile.php">
				<span>Hi, <?= $_SESSION['USER']['username'] ?></span>
			</a>
		<?php else: ?>
			<span style="cursor:pointer;" onclick="login.show()">Login</span>
		<?php endif; ?>

	</div>
</header> -->
<script>
	var user = {

		logout: function() {

			let form = new FormData();
			form.append('data_type', 'logout');
			var ajax = new XMLHttpRequest();

			ajax.addEventListener('readystatechange', function() {

				if (ajax.readyState == 4) {
					if (ajax.status == 200) {
						let obj = JSON.parse(ajax.responseText);
						alert(obj.message);

						window.location.href = "index.php";
					} else {
						alert("Please check your internet connection");
					}
				}
			});

			ajax.open('post', 'ajax.inc.php', true);
			ajax.send(form);
		}
	};

	// Dropdown toggle function
	const pagesDropdownButton = document.getElementById('pagesDropdownButton');
	const pagesDropdownMenu = document.getElementById('pagesDropdownMenu');

	pagesDropdownButton.addEventListener('click', () => {
		pagesDropdownMenu.classList.toggle('hidden'); // Toggle the dropdown visibility
	});

	// Close the dropdown if clicked outside
	document.addEventListener('click', (event) => {
		if (!event.target.closest('.relative')) {
			pagesDropdownMenu.classList.add('hidden');
		}
	});

	// Mobile menu toggle function
	const mobileMenuButton = document.getElementById('mobileMenuButton');
	const mobileMenu = document.getElementById('mobileMenu');

	mobileMenuButton.addEventListener('click', () => {
		mobileMenu.classList.toggle('hidden'); // Toggle mobile menu visibility
	});

	// Close mobile menu if clicked outside
	document.addEventListener('click', (event) => {
		if (!event.target.closest('#mobileMenuButton') && !event.target.closest('#mobileMenu')) {
			mobileMenu.classList.add('hidden');
		}
	});
	// JavaScript to hide preloader after the page loads
	window.addEventListener('load', () => {
		const preloader = document.getElementById('preloader');
		const content = document.getElementById('content');

		setTimeout(() => {
			preloader.style.display = 'none'; // Hide preloader
			content.classList.remove('hidden'); // Show main content
		}, 1500); // Adjust the duration of the preloader here
	});
</script>