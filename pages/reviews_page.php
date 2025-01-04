<?php
include("./assets/header_pages.php");

$user_data = getUser();
$user_id = $user_data['id'];
?>


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

    <main class="grid grid-cols-1 lg:grid-cols-3 gap-4">
      <!-- Write a Review -->
      <section class="lg:col-span-1 bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Write a Review</h2>
        <form class="" id="reviews-form" enctype="multipart/form-data" method="post">
          <div id="response-message" class="my-4"></div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2" for="name">
              Name
            </label>
            <input
              class="w-full p-2 border border-gray-300 rounded-lg"
              id="name" name="name"
              type="text" value="<?= $user_data['username'] ?>" />
          </div>
          <div class="mb-4">
            <label
              class="block text-sm font-medium mb-2"
              for="email">
              Email
            </label>
            <input
              class="w-full p-2 border border-gray-300 rounded-lg"
              id="email" name="email"
              type="email" value="<?= $user_data['email'] ?>" />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2" for="rating">
              Rating
            </label>
            <select
              class="w-full p-2 border border-gray-300 rounded-lg"
              id="rating" name="rating">
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
              for="message">
              Review
            </label>
            <textarea
              class="w-full p-2 border border-gray-300 rounded-lg"
              id="message" name="message"
              rows="4"></textarea>
          </div>
          <div class="text-center">
            <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-lg" onclick="review()">
              Submit Review
            </button>
          </div>
        </form>

      </section>
      <!-- Read Reviews -->
      <section class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">

        <h2 class="text-3xl font-bold text-center mb-6">
            User Reviews
        </h2>
        <div class="reviews-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Reviews will be injected here by AJAX -->
        </div>
    </section>
    
    </main>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function review() {
      // Get values from the form fields
      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const rating = document.getElementById("rating").value;
      const message = document.getElementById("message").value;

      // Perform a simple client-side validation
      if (!name || !email || !rating || !message) {
        alert("Please fill out all fields.");
        return;
      }

      // AJAX request to send data to reviews.php
      $.ajax({
        type: "POST",
        url: "./assets/reviews.php", // Update with the correct path
        data: {
          name: name,
          email: email,
          rating: rating,
          message: message
        },
        success: function(response) {
          const res = JSON.parse(response);
          if (res.error) {
            // Show error message
            $("#response-message").html(`<div class="bg-red-500 text-white p-3 rounded">${res.error}</div>`);
          } else {
            // Show success message
            $("#response-message").html(`<div class="bg-green-500 text-white p-3 rounded">${res}</div>`);
            setTimeout(function() {
              // Redirect after success
              window.location.href = "./reviews_page.php";
            }, 1000); // 2 seconds delay
          }
        },
        error: function() {
          // Show generic error message in case of AJAX failure
          $("#response-message").html('<div class="bg-red-500 text-white p-3 rounded">An error occurred. Please try again.</div>');
        }
      });
    }


    // Function to fetch reviews and display them
    function fetchReviews() {
      $.ajax({
        type: "GET",
        url: "./assets/reviews.php", // Path to the reviews.php script
        success: function(response) {
          const reviews = JSON.parse(response);

          if (reviews.length === 0) {
            // No reviews found
            $(".reviews-container").html("<p>No reviews yet.</p>");
          } else {
            let reviewsHtml = "";
            reviews.forEach((review) => {
              // Build the HTML structure for each review
              reviewsHtml += `
              <div class="bg-gray-100 p-4 rounded-lg">
                <div class="flex flex-col items-start mb-2">
                    <img alt="User avatar of ${review.name}" class="w-10 h-10 rounded-full mr-3" height="50" src="https://storage.googleapis.com/a1aa/image/mKVIY3gc40bgEtHZx8RuJ9l3Mjrw7cy0DAOcjqK81QBA1e9JA.jpg" width="50" />
                    <div>
                    <p class="text-sm font-medium">${review.name}</p>
                    <p class="text-xs text-gray-500">${review.created_at}</p> <!-- Adjust for your date format -->
                    </div>
                </div>
                <p>${review.message}</p>
                <div class="flex items-start mb-2">
                    ${getStars(review.rating)}
                </div>
                </div>

            `;
            });

            // Insert the reviews into the page
            $(".reviews-container").html(reviewsHtml);
          }
        },
        error: function() {
          $(".reviews-container").html('<div class="bg-red-500 text-white p-3 rounded">An error occurred while fetching reviews.</div>');
        }
      });
    }

    // Function to render the stars based on rating
    function getStars(rating) {
      let starsHtml = "";
      for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
          starsHtml += '<i class="fas fa-star text-yellow-500"></i>';
        } else {
          starsHtml += '<i class="far fa-star text-yellow-500"></i>';
        }
      }
      return starsHtml;
    }

    // Call fetchReviews when the page loads
    $(document).ready(function() {
      fetchReviews();
    });
  </script>
  <?php include("./assets/footer_pages.php") ?>

</body>

</html>