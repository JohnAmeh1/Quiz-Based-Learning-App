<?php
include("./php/all_files.php");
include("./assets/header_admin.php");
include("./assets/user_auth.php");

// $user_id = $user_data['id'];

$user_data = getUser();
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

<body class="bg-gradient-to-r from-blue-50 to-blue-100 font-roboto">
  <div class="container mx-auto p-4">

    <main class="bg-white shadow-lg rounded-lg p-6">
     
      <!-- Read Reviews -->
      <!-- <section class="lg:col-span-2 bg-white p-4 rounded-lg shadow-md"> -->

        <h2 class="text-3xl font-bold text-center mb-6">
          User Reviews
        </h2>
        <div class="reviews-container overflow-y-auto h-48 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <!-- Reviews will be injected here by AJAX -->
        </div>
      <!-- </section>  -->

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
        url: "./assets/reviews_admin.php", // Update with the correct path
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
              window.location.href = "./reviews_page_admin.php";
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
        url: "./assets/reviews_admin.php", // Path to the reviews.php script
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
              <div class="hidden md:block bg-gray-100 p-2 rounded-lg cursor-pointer" onclick="openModal('${review.name}', '${review.created_at}', '${review.message}', ${review.rating})">
    <div class="flex flex-col items-start mb-2">
        <div 
            class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-500 text-white font-bold mr-3"
            style="font-size: 1rem;"
        >
            ${review.name.charAt(0).toUpperCase()}
        </div>
        <div>
            <p class="text-md font-medium">${review.name}</p>
            <p class="text-xs text-gray-500">${review.created_at}</p>
        </div>
    </div>
    <p class="text-base">"${review.message}"</p>
    <div class="flex items-start mb-2 text-xl">
        ${getStars(review.rating)}
    </div>
</div>


      <div class="block md:hidden bg-gray-200 p-7 flex justify-between items-center bg-white p-[10px] rounded-lg w-64 cursor-pointer" onclick="openModal('${review.name}', '${review.created_at}', '${review.message}', ${review.rating})">
    <span class="text-gray-800 font-semibold">${review.name}</span>
    <div>
                ${getStars(review.rating)}
    </div>
  </div>

<div id="reviewModal" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex flex-col items-center text-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 sm:w-2/3 lg:w-1/3">
        <div class="flex justify-between items-center mb-4">
            <h2 id="modalName" class="text-xl font-semibold mb-2"></h2>
            <button class="text-gray-500 hover:text-gray-800" onclick="closeModal()">×</button>
        </div>
        <p id="modalDate" class="text-xs text-gray-500 mb-2"></p>
        <p id="modalMessage" class="text-base mb-4">""</p>
        <div id="modalRating" class="mb-4 text-xl"></div>
        <button class="flex bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="closeModal()">Close</button>
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

    function openModal(name, date, message, rating) {
      document.getElementById("modalName").textContent = name;
      document.getElementById("modalDate").textContent = date;
      document.getElementById("modalMessage").textContent = message;

      const ratingContainer = document.getElementById("modalRating");
      ratingContainer.innerHTML = getStars(rating); // Call your getStars function for the rating display

      document.getElementById("reviewModal").classList.remove("hidden");
    }

    // Close modal
    function closeModal() {
      document.getElementById("reviewModal").classList.add("hidden");
    }
  </script>
  

</body>

</html>