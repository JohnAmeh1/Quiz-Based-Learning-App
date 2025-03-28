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

    #preloader {
      position: fixed;
      inset: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: rgba(243, 244, 246, 0.9);
      z-index: 9999;
    }
  </style>
</head>
<?php include("./mentorship/fab.php"); ?>

<body class="font-sans bg-gray-100">
 
  <div class="grid grid-cols-12 min-h-screen gap-4 p-4">
    <!-- Central Content -->
    <div class="col-span-12 lg:col-span-8 bg-white p-6 shadow-lg">
      <div class="flex items-center justify-between mb-6 relative">
        <h2 class="text-lg font-bold text-gray-800">Connect with Mentors</h2>
        <button id="clearButton" class="absolute right-3 top-1/2 transform -translate-y-1/2 px-2 py-1 text-xl text-gray-500 hover:text-gray-700">
          <i class="fa-solid fa-trash text-red-500"></i>
        </button>
      </div>

      <div class="mb-6 flex items-center space-x-4 relative">
        <input id="searchBar" type="text" placeholder="Search mentors..."
          class="w-10/12 p-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button id="searchButton" class="px-4 py-2 text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-md shadow-md hover:from-indigo-600 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>

      <div id="searchResults" class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-5 mb-5"></div>
      <div id="userList" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </div>

    <!-- Right Sidebar -->
    <div id="rightSidebar" class="col-span-12 lg:col-span-4 bg-white p-6 shadow-lg lg:flex flex-col w-full">
      <h3 class="text-xl font-bold text-gray-800 mb-4">Chat Section</h3>
      <div class="p-4 border-b border-gray-200 flex items-end">
        <div id="currentMentorInfo" class="flex-1">
          <h3 class="font-medium text-gray-800" id="currentMentorName">No mentor selected</h3>
          <p class="text-sm text-gray-500" id="mentorStatus"></p>
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

      <div class="h-96 overflow-y-auto bg-gray-50 p-4 rounded-lg border border-gray-200" id="chatBox">
        <p class="text-gray-500 text-center">Select a mentor to start chatting</p>
      </div>
      <div class="mt-4 flex">
        <input id="messageInput" type="text" placeholder="Type a message..."
          class="flex-grow border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300" disabled>
        <button id="sendButton" class="px-4 py-2 text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-md hover:from-indigo-600 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400" disabled>
          <i class="fa-regular fa-paper-plane"></i>
        </button>
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
    let currentMentor = null;
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
    const currentMentorName = document.getElementById("currentMentorName");
    const mentorStatus = document.getElementById("mentorStatus");
    const searchBar = document.getElementById("searchBar");
    const searchButton = document.getElementById("searchButton");
    const clearButton = document.getElementById("clearButton");
    const searchResults = document.getElementById("searchResults");

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
    const toggleVideoBtn = document.getElementById('toggleVideoBtn');
    const toggleAudioBtn = document.getElementById('toggleAudioBtn');
    const endCallBtn = document.getElementById('endCallBtn');
    const acceptCallBtn = document.getElementById('acceptCallBtn');
    const rejectCallBtn = document.getElementById('rejectCallBtn');

    // WebRTC Functions
    async function startCall(callType) {
      if (!currentMentor) {
        alert('Please select a mentor first');
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
          recipient: currentMentor,
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
        currentMentor = sender;
        currentMentorName.textContent = sender;

        // Set up accept/reject handlers
        acceptCallBtn.onclick = async () => {
          incomingCallModal.classList.add('hidden');
          await acceptIncomingCall(offer, sender, callType);
        };

        rejectCallBtn.onclick = () => {
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
          recipient: currentMentor,
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
      callRecipientName.textContent = currentMentor;
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
          if (videoTrack.enabled) {
            toggleVideoBtn.classList.remove('bg-gray-200');
            toggleVideoBtn.classList.add('bg-blue-500', 'text-white');
          } else {
            toggleVideoBtn.classList.add('bg-gray-200');
            toggleVideoBtn.classList.remove('bg-blue-500', 'text-white');
          }
        }
      }
    }

    function toggleAudio() {
      if (localStream) {
        const audioTrack = localStream.getAudioTracks()[0];
        if (audioTrack) {
          audioTrack.enabled = !audioTrack.enabled;
          if (audioTrack.enabled) {
            toggleAudioBtn.classList.remove('bg-gray-200');
            toggleAudioBtn.classList.add('bg-blue-500', 'text-white');
          } else {
            toggleAudioBtn.classList.add('bg-gray-200');
            toggleAudioBtn.classList.remove('bg-blue-500', 'text-white');
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
      if (currentMentor) {
        sendSignalingMessage({
          type: 'hangup',
          sender,
          recipient: currentMentor
        });
      }
    }

    // Signaling functions
    async function sendSignalingMessage(message) {
      try {
        const response = await fetch(config.signalingEndpoint, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(message)
        });

        if (!response.ok) {
          throw new Error('Network response was not ok');
        }

        const data = await response.json();
        if (data.error) {
          throw new Error(data.error);
        }
      } catch (error) {
        console.error('Error sending signaling message:', error);
      }
    }

    function startSignalingPolling() {
      let lastChecked = 0;

      signalingInterval = setInterval(async () => {
        try {
          const response = await fetch(`${config.signalingEndpoint}?recipient=${sender}&since=${lastChecked}`);

          if (!response.ok) {
            throw new Error('Network response was not ok');
          }

          // Check if response is JSON
          const contentType = response.headers.get('content-type');
          if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Received non-JSON response');
          }

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

    // Chat Functions
    async function fetchMentors() {
      try {
        const response = await fetch("./assets/chat_learner.php?users=true");

        if (!response.ok) {
          throw new Error('Network response was not ok');
        }

        const mentors = await response.json();

        userList.innerHTML = mentors.map(mentor => `
          <div class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
            <h3 class="text-xl font-semibold text-gray-800">${mentor.username}</h3>
            <p class="text-gray-600 mt-2">${mentor.account_type}</p>
            <button class="mt-4 px-4 py-2 text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-md shadow-md hover:from-indigo-600 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400"
              onclick="selectMentor('${mentor.username}')">
              Connect
            </button>
          </div>
        `).join("");
      } catch (error) {
        console.error('Error fetching mentors:', error);
      }
    }

    async function fetchMessages() {
      if (!currentMentor) return;

      try {
        const response = await fetch(`./assets/chat_learner.php?sender=${sender}&recipient=${currentMentor}`);

        if (!response.ok) {
          throw new Error('Network response was not ok');
        }

        const messages = await response.json();

        chatBox.innerHTML = messages.map(msg => `
          <div class="${msg.sender === sender ? "text-right" : "text-left"}">
            <div class="inline-block bg-${msg.sender === sender ? "blue" : "gray"}-100 text-${msg.sender === sender ? "blue" : "gray"}-800 p-2 rounded-lg mb-2">
              <strong>${msg.sender}:</strong> ${msg.message}
            </div>
          </div>
        `).join("");
        chatBox.scrollTop = chatBox.scrollHeight;
      } catch (error) {
        console.error('Error fetching messages:', error);
      }
    }

    async function sendMessage() {
      const message = messageInput.value.trim();
      if (message && currentMentor) {
        try {
          const response = await fetch("./assets/chat_learner.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
              sender,
              recipient: currentMentor,
              message,
            }),
          });

          if (!response.ok) {
            throw new Error('Network response was not ok');
          }

          messageInput.value = "";
          fetchMessages();
        } catch (error) {
          console.error('Error sending message:', error);
        }
      }
    }

    function selectMentor(username) {
      currentMentor = username;
      currentMentorName.textContent = username;
      mentorStatus.textContent = "Online";

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

    async function searchMentors() {
      const searchTerm = searchBar.value.trim();
      searchResults.innerHTML = '<p class="text-gray-500">Loading...</p>';

      try {
        const response = await fetch(`./assets/search_mentors.php?query=${encodeURIComponent(searchTerm)}`);

        if (!response.ok) {
          throw new Error('Network response was not ok');
        }

        const data = await response.json();

        searchResults.innerHTML = '';

        if (data.length > 0) {
          data.forEach(mentor => {
            const card = document.createElement('div');
            card.className = 'mentor-card bg-gray-100 p-4 rounded-lg flex justify-between items-center shadow-md hover:shadow-xl transition-shadow duration-300';
            card.innerHTML = `
              <h3 class="text-xl font-semibold text-gray-800">${mentor.username}</h3>
              <button onclick="selectMentor('${mentor.username}')"><i class="fa-solid fa-message text-blue-600"></i></button>
            `;
            searchResults.appendChild(card);
          });
        } else {
          searchResults.innerHTML = `<p class="text-red-500 text-center">No mentors found matching "${searchTerm}"</p>`;
        }
      } catch (error) {
        console.error('Error searching mentors:', error);
        searchResults.innerHTML = `<p class="text-red-500 text-center">An error occurred while searching</p>`;
      }
    }

    function clearSearch() {
      searchBar.value = '';
      searchResults.innerHTML = '';
    }

    // Initialize the page
    document.addEventListener('DOMContentLoaded', () => {
      // Hide preloader after 1 second
      setTimeout(() => {
        document.getElementById('preloader').style.display = 'none';
      }, 1000);

      // Initialize chat and calling
      fetchMentors();
      setInterval(fetchMessages, 2000);

      // Start polling for signaling messages
      startSignalingPolling();

      // Set up event listeners
      videoCallBtn.addEventListener('click', () => startCall('video'));
      audioCallBtn.addEventListener('click', () => startCall('audio'));
      sendButton.addEventListener('click', sendMessage);
      messageInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage();
      });
      searchButton.addEventListener('click', searchMentors);
      clearButton.addEventListener('click', clearSearch);
      toggleVideoBtn.addEventListener('click', toggleVideo);
      toggleAudioBtn.addEventListener('click', toggleAudio);
      endCallBtn.addEventListener('click', endCall);

      // Clean up on page unload
      window.addEventListener('beforeunload', () => {
        if (signalingInterval) clearInterval(signalingInterval);
        endCall();
      });
    });
  </script>
</body>

</html>