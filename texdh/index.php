<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-commerce Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">
  <header class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-6 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-3xl font-extrabold">E-commerce Platform</h1>
      <nav class="space-x-6">
        <a href="index.php" class="hover:underline">Home</a>
        <a href="upload_source_code.html" class="hover:underline">Upload</a>
        <a href="post_job.html" class="hover:underline">Jobs</a>
        <a href="upload_video.html" class="hover:underline">Videos</a>
      </nav>
    </div>
  </header>

  <main class="container mx-auto py-12">
    <section class="text-center bg-white shadow-xl rounded-xl p-10 mb-10">
      <h2 class="text-4xl font-bold mb-6 text-blue-700">Welcome to the E-commerce Platform</h2>
      <p class="text-lg mb-8 text-gray-700">Buy source codes, hire developers, or share and watch videos.</p>
      <div class="flex flex-wrap justify-center space-x-4">
        <a href="index.php" class="border border-blue-600 text-blue-600 py-2 px-4 rounded-lg shadow hover:bg-blue-500 hover:text-white">Home</a>
        <a href="upload_source_code.html" class="border border-blue-600 text-blue-600 py-2 px-4 rounded-lg shadow hover:bg-blue-500 hover:text-white">Upload</a>
        <a href="post_job.html" class="border border-blue-600 text-blue-600 py-2 px-4 rounded-lg shadow hover:bg-blue-500 hover:text-white">Jobs</a>
        <a href="upload_video.html" class="border border-blue-600 text-blue-600 py-2 px-4 rounded-lg shadow hover:bg-blue-500 hover:text-white">Videos</a>
      </div>
    </section>
  </main>

  <?php
  include("./footer_eccommerce.php");
  ?>
</body>

</html>