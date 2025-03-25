<?php
include("./assets/header_pages.php");

$user_data = getUser();
$user_id = $user_data['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>EduQuest - Reviews</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
</head>

<body class="bg-gradient-to-r from-blue-50 to-blue-100 font-roboto">
  <div class="container mx-auto p-4">
    <main class="grid grid-cols-1 lg:grid-cols-3 gap-4">
      <!-- Write a Review -->
      <section class="lg:col-span-1 bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Write a Review</h2>
        <form id="reviews-form" enctype="multipart/form-data" method="post">
          <div id="response-message" class="my-4"></div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2" for="name">Name</label>
            <input class="w-full p-2 border border-gray-300 rounded-lg" id="name" name="name" type="text" value="<?= $user_data['username'] ?>" />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2" for="email">Email</label>
            <input class="w-full p-2 border border-gray-300 rounded-lg" id="email" name="email" type="email" value="<?= $user_data['email'] ?>" />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2" for="rating">Rating</label>
            <select class="w-full p-2 border border-gray-300 rounded-lg" id="rating" name="rating">
              <option value="1">1 Star</option>
              <option value="2">2 Stars</option>
              <option value="3">3 Stars</option>
              <option value="4">4 Stars</option>
              <option value="5">5 Stars</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2" for="message">Review</label>
            <textarea class="w-full p-2 border border-gray-300 rounded-lg" id="message" name="message" rows="4"></textarea>
          </div>
          <div class="text-center">
            <button type="button" class="inline-block px-6 py-3 mt-4 text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 hover:to-blue-500 transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400" onclick="review()">
              Submit Review
            </button>
          </div>
        </form>
      </section>

      <!-- Read Reviews -->
      <section class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-center mb-6">User Reviews</h2>
        <div class="reviews-container overflow-y-auto h- grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <!-- Reviews will be injected here by AJAX -->
        </div>
      </section>
    </main>
  </div>

  <!-- Modal Structure -->
  <div id="reviewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
      <div class="flex items-start mb-4">
        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-500 text-white font-bold mr-3">
          <span id="modalAvatar"></span>
        </div>
        <div>
          <p class="text-md font-medium text-gray-800" id="modalName"></p>
          <p class="text-xs text-gray-500" id="modalDate"></p>
        </div>
      </div>
      <p class="text-base text-gray-700 mb-4" id="modalMessage"></p>
      <div class="flex items-center text-xl text-yellow-500" id="modalRating"></div>
      <button onclick="closeModal()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">
        Close
      </button>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function review() {
      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const rating = document.getElementById("rating").value;
      const message = document.getElementById("message").value;

      if (!name || !email || !rating || !message) {
        alert("Please fill out all fields.");
        return;
      }

      $.ajax({
        type: "POST",
        url: "./assets/reviews.php",
        data: {
          name: name,
          email: email,
          rating: rating,
          message: message
        },
        success: function(response) {
          const res = JSON.parse(response);
          if (res.error) {
            $("#response-message").html(`<div class="bg-red-500 text-white p-3 rounded">${res.error}</div>`);
          } else {
            $("#response-message").html(`<div class="bg-green-500 text-white p-3 rounded">${res}</div>`);
            setTimeout(function() {
              window.location.href = "./reviews_page.php";
            }, 1000);
          }
        },
        error: function() {
          $("#response-message").html('<div class="bg-red-500 text-white p-3 rounded">An error occurred. Please try again.</div>');
        }
      });
    }

    function fetchReviews() {
      $.ajax({
        type: "GET",
        url: "./assets/reviews.php",
        success: function(response) {
          const reviews = JSON.parse(response);

          if (reviews.length === 0) {
            $(".reviews-container").html("<p>No reviews yet.</p>");
          } else {
            let reviewsHtml = "";

            reviews.forEach((review) => {
              reviewsHtml += `
                <div class="hidden md:block bg-gray-100 p-3 rounded-lg cursor-pointer" onclick="openModal('${review.name}', '${review.created_at}', '${review.message}', ${review.rating})">
                  <div class="flex flex-col items-start mb-2">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-500 text-white font-bold mr-3" style="font-size: 1rem;">
                      ${review.name.charAt(0).toUpperCase()}
                    </div>
                    <div>
                      <p class="text-md font-medium">${review.name}</p>
                      <p class="text-xs text-gray-500">${review.created_at}</p>
                    </div>
                  </div>
                  <p class="text-base mb-1">"${review.message}"</p>
                  <div class="flex items-start text-xl">
                    ${getStars(review.rating)}
                  </div>
                </div>

                <div class="block md:hidden bg-gray-200 p-2 flex justify-between items-center bg-white rounded-lg cursor-pointer" onclick="openModal('${review.name}', '${review.created_at}', '${review.message}', ${review.rating})">
                  <span class="text-gray-800 font-semibold">${review.name}</span>
                  <div>
                    ${getStars(review.rating)}
                  </div>
                </div>
              `;
            });

            $(".reviews-container").html(reviewsHtml);
          }
        },
        error: function() {
          $(".reviews-container").html('<div class="bg-red-500 text-white p-3 rounded">An error occurred while fetching reviews.</div>');
        }
      });
    }

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

    function openModal(name, date, message, rating) {
      document.getElementById("modalAvatar").textContent = name.charAt(0).toUpperCase();
      document.getElementById("modalName").textContent = name;
      document.getElementById("modalDate").textContent = date;
      document.getElementById("modalMessage").textContent = `"${message}"`;
      document.getElementById("modalRating").innerHTML = getStars(rating);

      document.getElementById("reviewModal").classList.remove("hidden");
    }

    function closeModal() {
      document.getElementById("reviewModal").classList.add("hidden");
    }

    $(document).ready(function() {
      fetchReviews();
    });
  </script>

  <?php include("./assets/footer_pages.php") ?>
</body>

</html>