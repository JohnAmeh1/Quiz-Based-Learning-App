<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connect with Mentors</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-100">

  <div class="flex min-h-screen">
    <!-- Left: User Dashboard -->
    <div class="w-1/4 bg-white p-6 shadow-lg">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">User Dashboard</h2>
      <div class="mb-6">
        <p class="text-gray-600">Welcome back, Ameh!</p>
        <p class="text-gray-600">Your current level: Intermediate</p>
      </div>

      <div>
        <h3 class="text-xl font-semibold text-gray-800">Recent Activities</h3>
        <ul class="mt-2">
          <li class="text-gray-700">Completed quiz on Web Security</li>
          <li class="text-gray-700">Updated profile settings</li>
        </ul>
      </div>
    </div>

    <!-- Right: Mentors List -->
    <div class="w-3/4 p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Connect with Mentors</h2>

      <!-- Filter Section -->
      <div class="mb-6 flex items-center space-x-4">
        <input type="text" placeholder="Search mentors..." class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <select class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option>All Categories</option>
          <option>Web Development</option>
          <option>Data Science</option>
          <option>Cybersecurity</option>
        </select>
        <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Filter</button>
      </div>

      <!-- Mentors List -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-xl font-semibold text-gray-800">John Doe</h3>
          <p class="text-gray-600 mt-2">Cybersecurity Expert</p>
          <p class="text-gray-600 mt-2">Available for mentorship in: Network Security, Ethical Hacking</p>
          <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Connect</button>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-xl font-semibold text-gray-800">Jane Smith</h3>
          <p class="text-gray-600 mt-2">Data Science Specialist</p>
          <p class="text-gray-600 mt-2">Available for mentorship in: Machine Learning, Data Analysis</p>
          <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Connect</button>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-xl font-semibold text-gray-800">Michael Johnson</h3>
          <p class="text-gray-600 mt-2">Full Stack Developer</p>
          <p class="text-gray-600 mt-2">Available for mentorship in: Web Development, JavaScript</p>
          <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Connect</button>
        </div>

        <!-- Add more mentors here -->
      </div>
    </div>
  </div>

</body>
</html>
