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
  <style>
    /* #userList {
      max-height: 500px;
      overflow-y: auto;
    }

    #videoCallModal,
    #incomingCallModal {
      z-index: 1000;
    }

    .call-btn {
      transition: all 0.3s ease;
    }

    .call-btn:hover {
      transform: scale(1.1);
    } */
    #userList {
      max-height: 500px;
      overflow-y: auto;
    }

    #videoCallModal,
    #incomingCallModal {
      z-index: 1000;
    }

    .call-btn {
      transition: all 0.3s ease;
    }

    .call-btn:hover {
      transform: scale(1.1);
    }
  </style>
</head>
<?php include("./mentorship/fab.php"); ?>

<body class="bg-gray-50">
  <div id="preloader" class="fixed inset-0 flex flex-col items-center justify-center bg-gray-100 z-50">
    <img src="./img/brain.jpg" alt="Quiz Icon" class="w-16 h-16 animate-grow-shrink mb-4 rounded-full shadow-lg border-2 border-blue-400 p-1">
    <p class="text-gray-700 text-lg font-medium animate-pulse">Loading...</p>
  </div>

  <!-- Main Content -->
  <div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Dashboard Header -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-2">Mentorship Dashboard</h1>
      <p class="text-gray-600">Welcome back, <?= $user_data['username'] ?>! Manage your students and sessions here.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Student List -->
      <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow">
          <div class="p-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Students</h2>
          </div>
          <div class="p-4">
            <div class="relative">
              <input type="text" id="studentSearch" placeholder="Search students..." class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
            </div>
            <div class="mt-4 space-y-2">
              <ul id="userList" class="space-y-2 overflow-y-auto max-h-[500px]"></ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Chat Section -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow h-[600px] flex flex-col">
          <div class="p-4 border-b border-gray-200 flex items-end">
            <div id="currentRecipientInfo" class="flex-1">
              <h3 class="font-medium text-gray-800" id="currentRecipientName">No student selected</h3>
              <p class="text-sm text-gray-500" id="recipientStatus"></p>
            </div>
            <div class="flex space-x-3">
              <button id="videoCallBtn" class="p-2 hover:bg-gray-100 rounded-full call-btn" disabled>
                <i class="fas fa-video text-gray-400"></i>
              </button>
              <button id="audioCallBtn" class="p-2 hover:bg-gray-100 rounded-full call-btn" disabled>
                <i class="fas fa-phone text-gray-400"></i>
              </button>
            </div>
          </div>

          <div class="flex-1 p-4 overflow-y-auto space-y-4" id="chatBox">
            <p class="text-gray-500 text-center">Select a student to start chatting</p>
          </div>

          <div class="p-4 border-t border-gray-200">
            <div class="flex space-x-3">
              <input type="text" id="messageInput" placeholder="Type your message..." class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" disabled>
              <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors" id="sendButton" disabled>
                <i class="fas fa-paper-plane mr-2"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Video Call Modal -->
  <div id="videoCallModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg w-11/12 md:w-3/4 lg:w-2/3 h-3/4 flex flex-col">
      <div class="p-4 border-b flex justify-between items-center">
        <h3 class="text-xl font-semibold">
          <span id="callTypeIndicator"></span> with
          <span id="callRecipientName"></span>
        </h3>
        <div class="flex space-x-2">
          <button id="toggleVideoBtn" class="p-2 bg-gray-200 rounded-full call-btn">
            <i class="fas fa-video"></i>
          </button>
          <button id="toggleAudioBtn" class="p-2 bg-gray-200 rounded-full call-btn">
            <i class="fas fa-microphone"></i>
          </button>
          <button id="endCallBtn" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 call-btn">
            End Call
          </button>
        </div>
      </div>
      <div class="flex-1 flex flex-col md:flex-row p-4 gap-4">
        <div class="flex-1 bg-black rounded-lg relative">
          <video id="remoteVideo" autoplay playsinline class="w-full h-full object-cover rounded-lg"></video>
        </div>
        <div class="w-full md:w-1/3 bg-black rounded-lg relative">
          <video id="localVideo" autoplay playsinline muted class="w-full h-full object-cover rounded-lg"></video>
        </div>
      </div>
      <div class="p-4 border-t text-center text-gray-600" id="callDuration">
        00:00
      </div>
    </div>
  </div>

  <!-- Incoming Call Modal -->
  <div id="incomingCallModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-80 text-center">
      <h3 class="text-xl font-semibold mb-2" id="incomingCallerName"></h3>
      <p class="text-gray-600 mb-4" id="incomingCallType"></p>
      <div class="flex justify-center space-x-4">
        <button id="acceptCallBtn" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 call-btn">
          Accept
        </button>
        <button id="rejectCallBtn" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 call-btn">
          Reject
        </button>
      </div>
    </div>
  </div>

  <script src="./mentorship/fab.js"></script>
  <script>
    // Configuration
    const config = {
      iceServers: [{
          urls: "stun:stun.l.google.com:19302"
        },
        {
          urls: "stun:stun1.l.google.com:19302"
        },
        {
          urls: "stun:stun2.l.google.com:19302"
        }
      ],
      signalingEndpoint: './signaling.php',
      pollingInterval: 2000
    };

    // Global variables
    const sender = "<?= $user_data['username'] ?>";
    let currentRecipient = null;
    let peerConnection = null;
    let localStream = null;
    let remoteStream = null;
    let callStartTime = null;
    let callDurationInterval = null;
    let signalingInterval = null;

    // DOM Elements
    const userList = document.getElementById("userList");
    const chatBox = document.getElementById("chatBox");
    const messageInput = document.getElementById("messageInput");
    const sendButton = document.getElementById("sendButton");
    const videoCallBtn = document.getElementById("videoCallBtn");
    const audioCallBtn = document.getElementById("audioCallBtn");
    const currentRecipientName = document.getElementById("currentRecipientName");
    const recipientStatus = document.getElementById("recipientStatus");
    const studentSearch = document.getElementById("studentSearch");

    // Call modal elements
    const videoCallModal = document.getElementById('videoCallModal');
    const incomingCallModal = document.getElementById('incomingCallModal');
    const localVideo = document.getElementById('localVideo');
    const remoteVideo = document.getElementById('remoteVideo');
    const callRecipientName = document.getElementById('callRecipientName');
    const callTypeIndicator = document.getElementById('callTypeIndicator');
    const callDuration = document.getElementById('callDuration');
    const incomingCallerName = document.getElementById('incomingCallerName');
    const incomingCallType = document.getElementById('incomingCallType');

    // Initialize the application
    document.addEventListener('DOMContentLoaded', () => {
      // Hide preloader
      setTimeout(() => {
        document.getElementById('preloader').style.display = 'none';
      }, 1000);

      // Initialize chat and user list
      fetchUsers();
      setInterval(fetchMessages, 2000);

      // Start signaling polling
      startSignalingPolling();
    });

    // Fetch users list
    async function fetchUsers() {
      try {
        const response = await fetch("chat_mentor.php?users=true");
        const users = await response.json();

        userList.innerHTML = users
          .filter(user => user.username !== sender)
          .map(user => `
            <li class="p-2 hover:bg-gray-50 rounded-lg cursor-pointer transition-colors">
              <button class="w-full flex justify-between items-center" onclick="selectUser('${user.username}')">
                <span class="text-gray-800 font-semibold">${user.username}</span>
                <span><i class="fa-solid fa-message text-blue-600"></i></span>
              </button>
            </li>
          `).join("");

        // Add search functionality
        studentSearch.addEventListener('input', (e) => {
          const searchTerm = e.target.value.toLowerCase();
          const items = userList.querySelectorAll('li');

          items.forEach(item => {
            const username = item.textContent.toLowerCase();
            item.style.display = username.includes(searchTerm) ? 'block' : 'none';
          });
        });
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    }

    // Fetch chat messages
    async function fetchMessages() {
      if (!currentRecipient) return;

      try {
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
      } catch (error) {
        console.error('Error fetching messages:', error);
      }
    }

    // Send chat message
    async function sendMessage() {
      const message = messageInput.value.trim();
      if (message && currentRecipient) {
        try {
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
        } catch (error) {
          console.error('Error sending message:', error);
        }
      }
    }

    // Select a user to chat with
    function selectUser(username) {
      currentRecipient = username;
      currentRecipientName.textContent = username;
      recipientStatus.textContent = "Online"; // You would update this with real status

      // Enable chat and call buttons
      messageInput.disabled = false;
      sendButton.disabled = false;
      videoCallBtn.disabled = false;
      audioCallBtn.disabled = false;

      // Update call button icons
      videoCallBtn.innerHTML = '<i class="fas fa-video text-blue-600"></i>';
      audioCallBtn.innerHTML = '<i class="fas fa-phone text-blue-600"></i>';

      // Load messages
      chatBox.innerHTML = "<p class='text-gray-500 text-center'>Loading messages...</p>";
      fetchMessages();
    }

    // WebRTC Functions
    async function startCall(callType) {
      if (!currentRecipient) {
        alert('Please select a student first');
        return;
      }

      try {
        // Get local media
        localStream = await navigator.mediaDevices.getUserMedia({
          video: callType === 'video',
          audio: true
        });

        // Create peer connection
        peerConnection = new RTCPeerConnection(config.iceServers);

        // Add local stream to connection
        localStream.getTracks().forEach(track => {
          peerConnection.addTrack(track, localStream);
        });

        // Set up event handlers
        peerConnection.onicecandidate = handleICECandidateEvent;
        peerConnection.ontrack = handleTrackEvent;
        peerConnection.onconnectionstatechange = handleConnectionStateChange;

        // Create offer
        const offer = await peerConnection.createOffer();
        await peerConnection.setLocalDescription(offer);

        // Send offer to the other peer
        await sendSignalingMessage({
          type: 'offer',
          sender,
          recipient: currentRecipient,
          sdp: offer.sdp,
          callType
        });

        // Show call UI
        showCallUI(callType, 'outgoing');

      } catch (error) {
        console.error('Error starting call:', error);
        alert('Failed to start call: ' + error.message);
        endCall();
      }
    }

    async function handleIncomingCall(offer, sender, callType) {
      try {
        // Show incoming call UI
        incomingCallerName.textContent = sender;
        incomingCallType.textContent = `${callType === 'video' ? 'Video' : 'Audio'} Call`;
        incomingCallModal.classList.remove('hidden');

        // Store call info for when user accepts
        currentRecipient = sender;
        currentRecipientName.textContent = sender;

        // Set up accept/reject handlers
        document.getElementById('acceptCallBtn').onclick = async () => {
          incomingCallModal.classList.add('hidden');
          await acceptIncomingCall(offer, sender, callType);
        };

        document.getElementById('rejectCallBtn').onclick = () => {
          incomingCallModal.classList.add('hidden');
          sendSignalingMessage({
            type: 'reject',
            sender,
            recipient: sender
          });
        };

      } catch (error) {
        console.error('Error handling incoming call:', error);
      }
    }

    async function acceptIncomingCall(offer, sender, callType) {
      try {
        // Get local media
        localStream = await navigator.mediaDevices.getUserMedia({
          video: callType === 'video',
          audio: true
        });

        // Create peer connection
        peerConnection = new RTCPeerConnection(config.iceServers);

        // Add local stream to connection
        localStream.getTracks().forEach(track => {
          peerConnection.addTrack(track, localStream);
        });

        // Set up event handlers
        peerConnection.onicecandidate = handleICECandidateEvent;
        peerConnection.ontrack = handleTrackEvent;
        peerConnection.onconnectionstatechange = handleConnectionStateChange;

        // Set remote description
        await peerConnection.setRemoteDescription(new RTCSessionDescription({
          type: 'offer',
          sdp: offer.sdp
        }));

        // Create answer
        const answer = await peerConnection.createAnswer();
        await peerConnection.setLocalDescription(answer);

        // Send answer to the other peer
        await sendSignalingMessage({
          type: 'answer',
          sender,
          recipient: sender,
          sdp: answer.sdp
        });

        // Show call UI
        showCallUI(callType, 'incoming');

      } catch (error) {
        console.error('Error accepting call:', error);
        alert('Failed to accept call: ' + error.message);
        endCall();
      }
    }

    function handleICECandidateEvent(event) {
      if (event.candidate) {
        sendSignalingMessage({
          type: 'candidate',
          sender,
          recipient: currentRecipient,
          candidate: event.candidate
        });
      }
    }

    function handleTrackEvent(event) {
      remoteStream = event.streams[0];
      remoteVideo.srcObject = remoteStream;
    }

    function handleConnectionStateChange() {
      if (peerConnection) {
        switch (peerConnection.connectionState) {
          case 'disconnected':
          case 'failed':
          case 'closed':
            endCall();
            break;
        }
      }
    }

    async function handleAnswer(answer) {
      if (!peerConnection) return;

      try {
        const remoteDesc = new RTCSessionDescription({
          type: 'answer',
          sdp: answer.sdp
        });
        await peerConnection.setRemoteDescription(remoteDesc);
      } catch (error) {
        console.error('Error handling answer:', error);
      }
    }

    async function handleCandidate(candidate) {
      if (!peerConnection) return;

      try {
        await peerConnection.addIceCandidate(new RTCIceCandidate(candidate));
      } catch (error) {
        console.error('Error handling ICE candidate:', error);
      }
    }

    function showCallUI(callType, direction) {
      callRecipientName.textContent = currentRecipient;
      callTypeIndicator.textContent = callType === 'video' ? 'Video Call' : 'Audio Call';
      videoCallModal.classList.remove('hidden');

      // Show local video if it's a video call
      if (callType === 'video') {
        localVideo.srcObject = localStream;
      } else {
        localVideo.srcObject = null;
      }

      // Start call timer
      callStartTime = new Date();
      updateCallDuration();
      callDurationInterval = setInterval(updateCallDuration, 1000);

      // Set up end call button
      document.getElementById('endCallBtn').onclick = endCall;

      // Set up toggle buttons
      document.getElementById('toggleVideoBtn').onclick = toggleVideo;
      document.getElementById('toggleAudioBtn').onclick = toggleAudio;
    }

    function updateCallDuration() {
      const now = new Date();
      const duration = Math.floor((now - callStartTime) / 1000);
      const minutes = Math.floor(duration / 60).toString().padStart(2, '0');
      const seconds = (duration % 60).toString().padStart(2, '0');
      callDuration.textContent = `${minutes}:${seconds}`;
    }

    function toggleVideo() {
      if (localStream) {
        const videoTrack = localStream.getVideoTracks()[0];
        if (videoTrack) {
          videoTrack.enabled = !videoTrack.enabled;
          const btn = document.getElementById('toggleVideoBtn');
          if (videoTrack.enabled) {
            btn.classList.remove('bg-gray-200');
            btn.classList.add('bg-blue-500', 'text-white');
          } else {
            btn.classList.add('bg-gray-200');
            btn.classList.remove('bg-blue-500', 'text-white');
          }
        }
      }
    }

    function toggleAudio() {
      if (localStream) {
        const audioTrack = localStream.getAudioTracks()[0];
        if (audioTrack) {
          audioTrack.enabled = !audioTrack.enabled;
          const btn = document.getElementById('toggleAudioBtn');
          if (audioTrack.enabled) {
            btn.classList.remove('bg-gray-200');
            btn.classList.add('bg-blue-500', 'text-white');
          } else {
            btn.classList.add('bg-gray-200');
            btn.classList.remove('bg-blue-500', 'text-white');
          }
        }
      }
    }

    function endCall() {
      // Clean up media streams
      if (localStream) {
        localStream.getTracks().forEach(track => track.stop());
        localStream = null;
      }

      if (remoteStream) {
        remoteStream.getTracks().forEach(track => track.stop());
        remoteStream = null;
      }

      // Clean up peer connection
      if (peerConnection) {
        peerConnection.close();
        peerConnection = null;
      }

      // Clear call timer
      if (callDurationInterval) {
        clearInterval(callDurationInterval);
        callDurationInterval = null;
      }

      // Hide modals
      videoCallModal.classList.add('hidden');
      incomingCallModal.classList.add('hidden');

      // Clear video elements
      localVideo.srcObject = null;
      remoteVideo.srcObject = null;

      // Notify the other peer
      if (currentRecipient) {
        sendSignalingMessage({
          type: 'hangup',
          sender,
          recipient: currentRecipient
        });
      }
    }

    // Signaling functions
    async function sendSignalingMessage(message) {
      try {
        await fetch(config.signalingEndpoint, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(message)
        });
      } catch (error) {
        console.error('Error sending signaling message:', error);
      }
    }

    function startSignalingPolling() {
      let lastChecked = 0;

      signalingInterval = setInterval(async () => {
        try {
          const response = await fetch(`${config.signalingEndpoint}?recipient=${sender}&since=${lastChecked}`);
          const messages = await response.json();

          if (messages.length > 0) {
            lastChecked = Math.floor(Date.now() / 1000);

            for (const message of messages) {
              switch (message.type) {
                case 'offer':
                  await handleIncomingCall(message, message.sender, message.callType);
                  break;
                case 'answer':
                  await handleAnswer(message);
                  break;
                case 'candidate':
                  await handleCandidate(message.candidate);
                  break;
                case 'hangup':
                case 'reject':
                  endCall();
                  alert(`Call ended: ${message.type === 'hangup' ? 'Other party hung up' : 'Call rejected'}`);
                  break;
              }
            }
          }
        } catch (error) {
          console.error('Error polling signaling messages:', error);
        }
      }, config.pollingInterval);
    }

    // Event listeners
    videoCallBtn.addEventListener('click', () => startCall('video'));
    audioCallBtn.addEventListener('click', () => startCall('audio'));
    sendButton.addEventListener('click', sendMessage);
    messageInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') sendMessage();
    });

    // Clean up on page unload
    window.addEventListener('beforeunload', () => {
      if (signalingInterval) clearInterval(signalingInterval);
      endCall();
    });
  </script>
</body>

</html>