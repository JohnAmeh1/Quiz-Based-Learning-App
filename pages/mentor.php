<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connect with Mentors</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-100">

  <div class="flex min-h-screen">
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

    <div class="w-3/4 p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Connect with Mentors</h2>


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

      </div>
    </div>
  </div>

</body>
</html> -->


<?php

include("./assets/header_pages.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Messaging</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="bg-white shadow-lg rounded-lg flex">
            
            <div class="w-1/4 border-r border-gray-300 p-4">
                <h2 class="text-lg font-bold mb-4">Contacts</h2>
                <ul id="userList" class="space-y-2">
                    
                </ul>
            </div>

            <div class="w-3/4 flex flex-col">
                <div class="flex-grow p-4 overflow-y-auto bg-gray-100" id="chatBox">
                    <p class="text-gray-500 text-center">Select a contact to start chatting</p>
                </div>
                <div class="border-t border-gray-300 p-4 flex items-center">
                    <input 
                        id="messageInput" 
                        type="text" 
                        placeholder="Type a message..." 
                        class="flex-grow border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300 mr-2"
                        disabled
                    />
                    <button 
                        id="sendButton" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
                        disabled
                    >
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sender = "<?= $user_data['username'] ?>";
        let currentRecipient = null;

        const userList = document.getElementById("userList");
        const chatBox = document.getElementById("chatBox");
        const messageInput = document.getElementById("messageInput");
        const sendButton = document.getElementById("sendButton");

        async function fetchUsers() {
            const response = await fetch("chat_mentor.php?users=true");
            const users = await response.json();

            userList.innerHTML = users
                .filter(user => user.username !== sender)
                .map(user => `
                    <li>
                        <button class="w-full text-left p-2 bg-gray-100 hover:bg-gray-200 rounded-lg" onclick="selectUser('${user.username}')">
                            ${user.username} (${user.role})
                        </button>
                    </li>
                `).join("");
        }

        async function fetchMessages() {
            if (!currentRecipient) return;

            const response = await fetch(`chat_mentor.php?sender=${sender}&recipient=${currentRecipient}`);
            const messages = await response.json();

            chatBox.innerHTML = messages.map(msg => `
                <div class="${msg.sender === sender ? 'text-right' : 'text-left'}">
                    <div class="inline-block bg-${msg.sender === sender ? 'blue' : 'gray'}-100 text-${msg.sender === sender ? 'blue' : 'gray'}-800 p-2 rounded-lg mb-2">
                        <strong>${msg.sender}:</strong> ${msg.message}
                    </div>
                </div>
            `).join("");
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        async function sendMessage() {
            const message = messageInput.value.trim();
            if (message && currentRecipient) {
                await fetch("chat_mentor.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: new URLSearchParams({ sender, recipient: currentRecipient, message })
                });
                messageInput.value = "";
                fetchMessages();
            }
        }

        function selectUser(username) {
            currentRecipient = username;
            chatBox.innerHTML = "<p class='text-gray-500 text-center'>Loading messages...</p>";
            messageInput.disabled = false;
            sendButton.disabled = false;
            fetchMessages();
        }

        sendButton.addEventListener("click", sendMessage);
        setInterval(fetchMessages, 2000);
        fetchUsers();
    </script>
</body>
</html>

