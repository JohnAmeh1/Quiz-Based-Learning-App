let jitsiAPI;
let roomName;

let currentRoom = null;
let checkCallInterval = null;

// ✅ Select Mentor
function selectMentor(username) {
  currentRecipient = username;
  console.log("Selected Mentor:", username);
}

// ✅ Learner Starts Call
async function startCall() {
  if (!currentRecipient) {
    alert("Please select a mentor first!");
    return;
  }

  currentRoom = `room-${currentRecipient}-${Date.now()}`;

  try {
    const response = await fetch("signaling.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        recipient: currentRecipient,
        room: currentRoom,
        status: "pending",
      }),
    });

    const data = await response.json();
    if (data.status === "success") {
      alert("Calling " + currentRecipient + "...");
      checkIncomingCall();
    } else {
      console.error("Call failed:", data.error);
    }
  } catch (error) {
    console.error("Error starting call:", error);
  }
}

// ✅ Mentor Receives Call
async function checkIncomingCalls() {
  try {
    const response = await fetch(`signaling.php?recipient=${currentRecipient}`);
    const data = await response.json();

    console.log("Incoming Call Data:", data);

    if (data.room) {
      document.getElementById("incomingCall").innerHTML = `
        <p>Incoming Call from Learner</p>
        <button onclick="acceptCall('${data.room}')">Accept</button>
      `;
    }
  } catch (error) {
    console.error("Error checking incoming calls:", error);
  }
}

// ✅ Mentor Accepts Call
async function acceptCall(room) {
  try {
    await fetch("signaling.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ room: room, status: "accepted" }),
    });

    console.log("Call accepted! Joining room...");
    joinCall(room);
  } catch (error) {
    console.error("Error accepting call:", error);
  }
}

// ✅ Check if Learner Can Join Call
function checkIncomingCall() {
  checkCallInterval = setInterval(async () => {
    try {
      const response = await fetch(
        `signaling.php?recipient=${currentRecipient}`
      );
      const data = await response.json();

      if (data.status === "accepted") {
        clearInterval(checkCallInterval);
        joinCall(data.room);
      }
    } catch (error) {
      console.error("Error checking call status:", error);
    }
  }, 3000);
}

// ✅ Join Jitsi Call
function joinCall(room) {
  document.getElementById("callContainer").innerHTML = `
    <h2>Call Started</h2>
    <iframe src="https://meet.jit.si/${room}" width="800" height="500" allow="camera; microphone; fullscreen"></iframe>
  `;
}
