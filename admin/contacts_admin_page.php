<?php
include("./php/all_files.php");
include("./assets/header_admin.php");
include("./assets/user_auth.php");

$user_data = getUser();
$user_id = $user_data['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Contacts</title>
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
      <!-- Read contacts -->
      <h2 class="text-3xl font-bold text-center mb-6">Contacts</h2>
      <div class="contacts-container overflow-y-auto h-96 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Contacts will be injected here by AJAX -->
      </div>
    </main>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function contact() {
      const userId = <?= $user_id ?>;
      const username = document.getElementById("username").value;
      const email = document.getElementById("email").value;
      const message = document.getElementById("message").value;

      $.ajax({
        type: "POST",
        url: "./assets/contact_us.php",
        data: {
          id: userId,
          username: username,
          email: email,
          message: message,
        },
        success: function(response) {
          const res = JSON.parse(response);
          if (res.error) {
            $("#response-message").html(`<div class="bg-red-500 text-white p-3 rounded">${res.error}</div>`);
          } else {
            $("#response-message").html(`<div class="bg-green-500 text-white p-3 rounded">${res}</div>`);
            setTimeout(() => window.location.href = "./contact.php", 3000);
          }
        },
        error: function() {
          $("#response-message").html('<div class="bg-red-500 text-white p-3 rounded">An error occurred. Please try again.</div>');
        }
      });
    }

    function fetchContacts() {
      $.ajax({
        type: "GET",
        url: "./assets/contacts_admin.php", // Path to the contacts.php script
        success: function(response) {
          const contacts = JSON.parse(response);

          if (contacts.length === 0) {
            // No contacts found
            $(".contacts-container").html("<p>No contacts yet.</p>");
          } else {
            let contactsHtml = "";
            contacts.forEach((contact) => {
              // Build the HTML structure for each contact
              contactsHtml += `
              <div class="hidden md:block bg-gray-100 p-2 rounded-lg cursor-pointer" onclick="openModal('${contact.username}', '${contact.created_at}', '${contact.message}', ${contact.rating})">
    <div class="flex flex-col items-start mb-2">
        <div 
            class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-500 text-white font-bold mr-3"
            style="font-size: 1rem;"
        >
            ${contact.username.charAt(0).toUpperCase()}
        </div>
        <div>
            <p class="text-md font-medium">${contact.username}</p>
            <p class="text-xs text-gray-500">${contact.created_at}</p>
        </div>
    </div>
    <p class="text-base">"${contact.message}"</p>
    <div class="flex items-start mb-2 text-xl">
        ${getStars(contact.rating)}
    </div>
</div>


      <div class="block md:hidden bg-gray-200 p-7 flex justify-between items-center bg-white p-[10px] rounded-lg w-64 cursor-pointer" onclick="openModal('${contact.username}', '${contact.created_at}', '${contact.message}', ${contact.rating})">
    <span class="text-gray-800 font-semibold">${contact.username}</span>
    <div>
                ${getStars(contact.rating)}
    </div>
  </div>

<div id="contactModal" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex flex-col items-center text-center justify-center z-50">
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

            // Insert the contacts into the page
            $(".contacts-container").html(contactsHtml);
          }
        },
        error: function() {
          $(".contacts-container").html('<div class="bg-red-500 text-white p-3 rounded">An error occurred while fetching contacts.</div>');
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

    // Call fetchContacts when the page loads
    $(document).ready(function() {
      fetchContacts();
    });

    function openModal(name, date, message, rating) {
      document.getElementById("modalName").textContent = name;
      document.getElementById("modalDate").textContent = date;
      document.getElementById("modalMessage").textContent = message;

      const ratingContainer = document.getElementById("modalRating");
      ratingContainer.innerHTML = getStars(rating); // Call your getStars function for the rating display

      document.getElementById("contactModal").classList.remove("hidden");
    }

    // Close modal
    function closeModal() {
      document.getElementById("contactModal").classList.add("hidden");
    }
  </script>
</body>

</html>