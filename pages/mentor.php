<?php
ob_start();
include("./assets/header_mentor.php");

$user_data = getUser();

if ($user_data['badge'] !== 'verified') {
  header("location: ./payment_mentor.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduQuest - Mentorship Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50">
  <!-- Main Content -->
  <div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Dashboard Header -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-2">Mentorship Dashboard</h1>
      <p class="text-gray-600">Welcome back, <?= $user_data['username'] ?>! Manage your students and sessions here.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
          <div class="p-3 bg-blue-100 rounded-full">
            <i class="fas fa-users text-blue-600 text-xl"></i>
          </div>
          <div class="ml-4">
            <h3 class="text-gray-500 text-sm">Active Students</h3>
            <p class="text-2xl font-semibold text-gray-800">24</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
          <div class="p-3 bg-green-100 rounded-full">
            <i class="fas fa-calendar-check text-green-600 text-xl"></i>
          </div>
          <div class="ml-4">
            <h3 class="text-gray-500 text-sm">Sessions This Week</h3>
            <p class="text-2xl font-semibold text-gray-800">12</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
          <div class="p-3 bg-purple-100 rounded-full">
            <i class="fas fa-star text-purple-600 text-xl"></i>
          </div>
          <div class="ml-4">
            <h3 class="text-gray-500 text-sm">Average Rating</h3>
            <p class="text-2xl font-semibold text-gray-800">4.8</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Student List -->
      <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow">
          <div class="p-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Your Students</h2>
          </div>
          <div class="p-4">
            <div class="relative">
              <input type="text" placeholder="Search students..." class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
            </div>
            <div class="mt-4 space-y-4">
              <!-- Student Items -->
              <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg cursor-pointer transition-colors">
                <ul id="userList" class="space-y-2 overflow-y-auto">

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Chat Section -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow h-[600px] flex flex-col">
          <!-- <div class="p-4 border-b border-gray-200 flex items-center">
            <img src="/api/placeholder/40/40" alt="Current Student" class="w-10 h-10 rounded-full">
            <div class="ml-3">
              <h3 class="font-medium text-gray-800">Sarah Johnson</h3>
              <p class="text-sm text-gray-500">Last active: 2 mins ago</p>
            </div>
            <div class="ml-auto flex space-x-3">
              <button class="p-2 hover:bg-gray-100 rounded-full">
                <i class="fas fa-video text-gray-600"></i>
              </button>
              <button class="p-2 hover:bg-gray-100 rounded-full">
                <i class="fas fa-phone text-gray-600"></i>
              </button>
            </div>
          </div> -->

          <!-- Chat Messages -->
          <div class="flex-1 p-4 overflow-y-auto space-y-4" id="chatBox">

          </div>

          <!-- Message Input -->
          <div class="p-4 border-t border-gray-200">
            <div class="flex space-x-3">
              <!-- <button class="p-2 hover:bg-gray-100 rounded-full">
                <i class="fas fa-paperclip text-gray-600"></i>
              </button> -->
              <input type="text" id="messageInput" placeholder="Type your message..." class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors" id="sendButton">
                <i class="fas fa-paper-plane mr-2"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Upcoming Sessions -->
    <!-- <div class="mt-8">
      <div class="bg-white rounded-lg shadow">
        <div class="p-4 border-b border-gray-200">
          <h2 class="text-xl font-semibold text-gray-800">Upcoming Sessions</h2>
        </div>
        <div class="p-4">
          <div class="overflow-x-auto">
            <table class="min-w-full">
              <thead>
                <tr class="bg-gray-50">
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Topic</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">Sarah Johnson</td>
                  <td class="px-6 py-4 whitespace-nowrap">Feb 2, 2025</td>
                  <td class="px-6 py-4 whitespace-nowrap">10:00 AM</td>
                  <td class="px-6 py-4 whitespace-nowrap">Project Review</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <button class="text-blue-600 hover:text-blue-800">
                      <i class="fas fa-video mr-2"></i>Join
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> -->
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
                    
                    <button class=" p-2 flex justify-between items-center bg-white p-[10px] rounded-lg w-80" onclick="selectUser('${user.username}')">
                      <span class="text-gray-800 font-semibold">${user.username}</span>
                      <span><i class="fa-solid fa-message text-blue-600"></i></span>
                    </button>
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
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: new URLSearchParams({
            sender,
            recipient: currentRecipient,
            message
          })
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