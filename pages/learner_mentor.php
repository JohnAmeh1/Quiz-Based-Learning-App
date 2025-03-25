<?php
include("./assets/header_pages.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connect with Mentors</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    #userList {
      max-height: 500px;
      /* Adjust based on your design */
      overflow-y: auto;
    }
  </style>
</head>
<?php include("./assets/fab.php"); ?>

<body class="font-sans bg-gray-100">
  <div class="grid grid-cols-12 min-h-screen gap-4 p-4">

    <!-- Central Content (Mentor Connection) -->
    <div class="col-span-12 lg:col-span-8 bg-white p-6 shadow-lg">
      <div class="flex items-center justify-between mb-6 relative">
        <h2 class="text-lg font-bold text-gray-800">Connect with Mentors</h2>
        <button
          id="clearButton"
          class="absolute right-3 top-1/2 transform -translate-y-1/2 px-2 py-1 text-xl text-gray-500 hover:text-gray-700 focus:outline-none">
          <i class="fa-solid fa-trash text-red-500"></i>
        </button>
      </div>
      <!-- <h2 class="text-2xl font-bold text-gray-800 mb-6">Connect with Mentors</h2> -->

      <div class="mb-6 flex items-center space-x-4 relative">
        <input
          id="searchBar"
          type="text"
          placeholder="Search mentors..."
          class="w-10/12 p-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <button
          id="searchButton"
          class="px-4 py-2 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-md shadow-md hover:from-indigo-600 
                    hover:to-blue-500 
                    focus:outline-none focus:ring-2 focus:ring-blue-400">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>

      <div id="searchResults" class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-5 mb-5"></div>
      <div id="userList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </div>

    <!-- Right Sidebar -->
    <div
      id="rightSidebar"
      class="col-span-12 lg:col-span-4 bg-white p-6 shadow-lg lg:flex flex-col w-full">
      <h3 class="text-xl font-bold text-gray-800 mb-4">Chat Section</h3>
      <div class="h-96 overflow-y-auto bg-gray-50 p-4 rounded-lg border border-gray-200" id="chatBox">
        <p class="text-gray-500 text-center">Select a mentor to start chatting</p>
      </div>
      <div class="mt-4 flex overflow-y-auto fixed-bottom">
        <input
          id="messageInput"
          type="text"
          placeholder="Type a message..."
          class="flex-grow border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300"
          disabled />
        <button
          id="sendButton"
          class="px-4 py-2 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 
                    hover:to-blue-500 
                    focus:outline-none focus:ring-2 focus:ring-blue-400"
          disabled style="cursor: pointer;">
          <i class="fa-regular fa-paper-plane"></i>
        </button>
      </div>
    </div>

  </div>
  <script src="./assets/fab.js"></script>
  <script>
    const sender = "<?= $user_data['username'] ?>";
    let currentRecipient = null;

    const userList = document.getElementById("userList");
    const chatBox = document.getElementById("chatBox");
    const messageInput = document.getElementById("messageInput");
    const sendButton = document.getElementById("sendButton");

    async function fetchUsers() {
      const response = await fetch("./assets/chat_learner.php?users=true");
      const users = await response.json();

      userList.innerHTML = users
        .map(
          (user) => `
          
      <div class="hidden md:block bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
        <h3 class="text-xl font-semibold text-gray-800">${user.username}</h3>
        <p class="text-gray-600 mt-2">${user.account_type}</p>
        <button
          class="mt-4 px-4 py-2 text-white bg-gradient-to-r 
                    from-blue-500 to-indigo-600 rounded-md shadow-md hover:from-indigo-600 
                    hover:to-blue-500 
                    focus:outline-none focus:ring-2 focus:ring-blue-400"
          onclick="selectUser('${user.username}')">
          Connect
        </button>
      </div>

      <div class="block md:hidden bg-gray-200 p-7 flex justify-between items-center bg-white p-[10px] rounded-lg w-64">
    <span class="text-gray-800 font-semibold">${user.username}</span>
    <button onclick="selectUser('${user.username}')"><i class="fa-solid fa-message text-blue-600"></i></button>
  </div>
  
    `
        )
        .join("");
    }

    async function fetchMessages() {
      if (!currentRecipient) return;

      const response = await fetch(
        `./assets/chat_learner.php?sender=${sender}&recipient=${currentRecipient}`
      );
      const messages = await response.json();

      chatBox.innerHTML = messages
        .map(
          (msg) => `
    <div class="${
      msg.sender === sender ? "text-right" : "text-left"
    }">
        <div class="inline-block bg-${
          msg.sender === sender ? "blue" : "gray"
        }-100 text-${
          msg.sender === sender ? "blue" : "gray"
        }-800 p-2 rounded-lg mb-2">
            <strong>${msg.sender}:</strong> ${msg.message}
        </div>
    </div>
  `
        )
        .join("");

      chatBox.scrollTop = chatBox.scrollHeight;
    }

    async function sendMessage() {
      const message = messageInput.value.trim();
      if (message && currentRecipient) {
        await fetch("./assets/chat_learner.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
            sender,
            recipient: currentRecipient,
            message,
          }),
        });
        messageInput.value = "";
        fetchMessages();
      }
    }

    function selectUser(username) {
      currentRecipient = username;
      chatBox.innerHTML =
        "<p class='text-gray-500 text-center'>Loading messages...</p>";
      messageInput.disabled = false;
      sendButton.disabled = false;
      fetchMessages();
    }

    sendButton.addEventListener("click", sendMessage);

    // Auto-refresh messages every 2 seconds
    setInterval(fetchMessages, 2000);

    // Fetch users on page load
    fetchUsers();
    document.getElementById('searchButton').addEventListener('click', function() {
      const searchTerm = document.getElementById('searchBar').value.trim();


      const searchResults = document.getElementById('searchResults');
      searchResults.innerHTML = '<p class="text-gray-500">Loading...</p>';


      fetch(`./assets/search_mentors.php?query=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(data => {
          searchResults.innerHTML = '';

          if (data.length > 0) {
            data.forEach(mentor => {
              const card = document.createElement('div');
              card.className = 'mentor-card bg-gray-100 p-4 rounded-lg flex justify-between block items-center shadow-md hover:shadow-xl transition-shadow duration-300';
              card.innerHTML = `
              <h3 class="text-xl font-semibold text-gray-800">${mentor.username}</h3>
              <button onclick="selectUser('${mentor.username}')"><i class="fa-solid fa-message text-blue-600"></i></button>
              
            `;
              searchResults.appendChild(card);
            });
          } else {
            searchResults.innerHTML = `<p class="text-red-500 text-center">No mentors found matching "${searchTerm}"</p>`;
          }
        })
        .catch(error => {
          console.error('Error fetching mentors:', error);
          searchResults.innerHTML = `<p class="text-red-500 text-center">An error occurred while fetching results.</p>`;
        });
    });
    document.getElementById('clearButton').addEventListener('click', function() {

      document.getElementById('searchBar').value = '';


      const searchResults = document.getElementById('searchResults');
      searchResults.innerHTML = '';


      fetchUsers();
    });
  </script>
</body>

</html>