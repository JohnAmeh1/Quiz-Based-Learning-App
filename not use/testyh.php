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
  <script src="https://meet.jit.si/external_api.js"></script>
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
    <!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
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
    </div> -->

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
          <h2>Start a Call</h2>
          <input type="text" id="mentorUsername" placeholder="Enter Mentor Username">
          <button onclick="startCall()">Call Mentor</button>

          <div id="incomingCall"></div>
          <div id="callContainer"></div>


          <div id="jitsi-container" style="display: none;">
            <div id="jitsi-meet" style="width: 100%; height: 500px;"></div>
            <button onclick="endCall()">End Call</button>
          </div>

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

    let jitsiAPI;
    let roomName;

    // ✅ Start a Call (Learner)
    async function startCall(mentorUsername) {
      const roomID = Math.random().toString(36).substring(2, 15); // Generate unique room ID

      const requestData = {
        recipient: mentorUsername, // Mentor's username
        room: roomID
      };

      const response = await fetch("signaling.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(requestData)
      });

      const result = await response.json();
      console.log("Call Started:", result);

      if (result.status === "success") {
        window.location.href = `https://meet.jit.si/${roomID}`; // Redirect to Jitsi meeting
      }
    }


    // ✅ Join a Call (Mentor)
    function joinCall(room) {
      roomName = room;
      launchJitsi(roomName);
    }

    // ✅ Launch Jitsi Meeting
    function launchJitsi(room) {
      const domain = "meet.jit.si";
      const options = {
        roomName: room,
        width: "100%",
        height: "100%",
        parentNode: document.getElementById("jitsi-meet"),
        configOverwrite: {
          startWithAudioMuted: false,
          startWithVideoMuted: false
        },
      };

      jitsiAPI = new JitsiMeetExternalAPI(domain, options);
      document.getElementById("jitsi-container").style.display = "block";
    }

    // ✅ End Call
    function endCall() {
      if (jitsiAPI) {
        jitsiAPI.dispose();
        document.getElementById("jitsi-container").style.display = "none";
      }
    }

    // ✅ Notify Mentor via PHP
    async function notifyMentor(mentorUsername, room) {
      await fetch("signaling.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          recipient: mentorUsername,
          room: room
        })
      });
      alert("Calling " + mentorUsername + "...");
    }

    function acceptCall(room) {
      fetch("accept_call.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            room: room
          }),
        })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            window.location.href = `https://meet.jit.si/${room}`; // Join call
          }
        })
        .catch((error) => console.error("Error accepting call:", error));
    }


    // ✅ Check for Incoming Calls (Mentor Side)
    async function checkIncomingCalls() {
      try {
        const response = await fetch(`signaling.php?recipient=${sender}`);
        const data = await response.json();

        console.log("Incoming Call Data:", data); // Debugging log

        if (data.room) {
          document.getElementById("incomingCall").innerHTML = `
                <p>Incoming Call from Learner</p>
                <button onclick="joinCall('${data.room}')">Accept</button>
            `;
        }
      } catch (error) {
        console.error("Error checking incoming calls:", error);
      }
    }
    // ✅ Check for calls every 3 seconds
    setInterval(checkIncomingCalls, 3000);
  </script>
</body>

</html>





<!-- learner mentor  -->


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
  <script src="https://meet.jit.si/external_api.js"></script>
  <script src="./jitsi.js"></script>
  <style>
    #userList {
      max-height: 500px;
      /* Adjust based on your design */
      overflow-y: auto;
    }
  </style>
</head>

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


      <div id="incomingCall"></div>
      <div id="callContainer"></div>

      <div id="jitsi-container" style="display: none;">
        <div id="jitsi-meet" style="width: 100%; height: 500px;"></div>
        <button onclick="endCall()">End Call</button>
      </div>


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
    <button 
      class="mt-2 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
      onclick="startCall()">
      Call Mentor
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