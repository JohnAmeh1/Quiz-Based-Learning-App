<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Reviews</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap"
    rel="stylesheet" />
</head>

<body class="bg-gray-100 font-roboto">
  <div class="container mx-auto p-4">
    <header class="flex justify-between items-center py-4">
      <h1 class="text-2xl font-bold">Reviews</h1>
      <nav>
        <ul class="flex space-x-4">
          <li>
            <a class="text-blue-500" href="#"> Home </a>
          </li>
          <li>
            <a class="text-blue-500" href="#"> Dashboard </a>
          </li>
          <li>
            <a class="text-blue-500" href="#"> Profile </a>
          </li>
        </ul>
      </nav>
    </header>
    <main class="grid grid-cols-1 lg:grid-cols-3 gap-4">
      <!-- Write a Review -->
      <section class="lg:col-span-1 bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Write a Review</h2>
        <form>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2" for="reviewer-name">
              Name
            </label>
            <input
              class="w-full p-2 border border-gray-300 rounded-lg"
              id="reviewer-name"
              type="text" />
          </div>
          <div class="mb-4">
            <label
              class="block text-sm font-medium mb-2"
              for="reviewer-email">
              Email
            </label>
            <input
              class="w-full p-2 border border-gray-300 rounded-lg"
              id="reviewer-email"
              type="email" />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2" for="review-rating">
              Rating
            </label>
            <select
              class="w-full p-2 border border-gray-300 rounded-lg"
              id="review-rating">
              <option>1 Star</option>
              <option>2 Stars</option>
              <option>3 Stars</option>
              <option>4 Stars</option>
              <option>5 Stars</option>
            </select>
          </div>
          <div class="mb-4">
            <label
              class="block text-sm font-medium mb-2"
              for="review-message">
              Review
            </label>
            <textarea
              class="w-full p-2 border border-gray-300 rounded-lg"
              id="review-message"
              rows="4"></textarea>
          </div>
          <div class="text-center">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
              Submit Review
            </button>
          </div>
        </form>
      </section>
      <!-- Read Reviews -->
      <section class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">User Reviews</h2>
        <div class="space-y-4">
          <div class="bg-gray-100 p-4 rounded-lg">
            <div class="flex items-center mb-2">
              <img
                alt="User avatar of John Doe"
                class="w-10 h-10 rounded-full mr-3"
                height="50"
                src="https://storage.googleapis.com/a1aa/image/mKVIY3gc40bgEtHZx8RuJ9l3Mjrw7cy0DAOcjqK81QBA1e9JA.jpg"
                width="50" />
              <div>
                <p class="text-sm font-medium">John Doe</p>
                <p class="text-xs text-gray-500">2 hours ago</p>
              </div>
            </div>
            <div class="flex items-center mb-2">
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star text-yellow-500"> </i>
            </div>
            <p>
              This platform is amazing! The tutorials are very detailed and
              easy to follow.
            </p>
          </div>
          <div class="bg-gray-100 p-4 rounded-lg">
            <div class="flex items-center mb-2">
              <img
                alt="User avatar of Jane Smith"
                class="w-10 h-10 rounded-full mr-3"
                height="50"
                src="https://storage.googleapis.com/a1aa/image/mKVIY3gc40bgEtHZx8RuJ9l3Mjrw7cy0DAOcjqK81QBA1e9JA.jpg"
                width="50" />
              <div>
                <p class="text-sm font-medium">Jane Smith</p>
                <p class="text-xs text-gray-500">1 day ago</p>
              </div>
            </div>
            <div class="flex items-center mb-2">
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star-half-alt text-yellow-500"> </i>
            </div>
            <p>Great content, but I wish there were more advanced topics.</p>
          </div>
          <div class="bg-gray-100 p-4 rounded-lg">
            <div class="flex items-center mb-2">
              <img
                alt="User avatar of Alice Johnson"
                class="w-10 h-10 rounded-full mr-3"
                height="50"
                src="https://storage.googleapis.com/a1aa/image/mKVIY3gc40bgEtHZx8RuJ9l3Mjrw7cy0DAOcjqK81QBA1e9JA.jpg"
                width="50" />
              <div>
                <p class="text-sm font-medium">Alice Johnson</p>
                <p class="text-xs text-gray-500">3 days ago</p>
              </div>
            </div>
            <div class="flex items-center mb-2">
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="fas fa-star text-yellow-500"> </i>
              <i class="far fa-star text-yellow-500"> </i>
            </div>
            <p>Very helpful and easy to understand. Highly recommend!</p>
          </div>
        </div>
      </section>
    </main>
  </div>

</body>

</html>