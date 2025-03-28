// Shared WebRTC configuration for both mentor and learner
const webrtcConfig = {
  iceServers: [
    { urls: "stun:stun.l.google.com:19302" },
    // Add your TURN servers here for production
  ],
  signalingServer: "signaling.php",
  callTimeout: 30000, // 30 seconds
};

// Shared WebRTC functions
class WebRTCHelper {
  constructor(username) {
    this.username = username;
    this.peerConnection = null;
    this.localStream = null;
    this.remoteStream = null;
    this.currentCallRecipient = null;
    this.callType = null; // 'video' or 'audio'
  }

  async initLocalStream(video = true) {
    try {
      this.localStream = await navigator.mediaDevices.getUserMedia({
        video: video,
        audio: true,
      });
      return this.localStream;
    } catch (error) {
      console.error("Error accessing media devices:", error);
      throw error;
    }
  }

  createPeerConnection() {
    this.peerConnection = new RTCPeerConnection(webrtcConfig);

    // Add local stream tracks if available
    if (this.localStream) {
      this.localStream.getTracks().forEach((track) => {
        this.peerConnection.addTrack(track, this.localStream);
      });
    }

    // Handle remote stream
    this.peerConnection.ontrack = (event) => {
      this.remoteStream = event.streams[0];
      this.onRemoteStream(this.remoteStream);
    };

    // ICE candidate handling
    this.peerConnection.onicecandidate = (event) => {
      if (event.candidate) {
        this.sendSignalingMessage({
          type: "candidate",
          candidate: event.candidate,
        });
      }
    };

    // Connection state changes
    this.peerConnection.onconnectionstatechange = () => {
      if (
        this.peerConnection.connectionState === "disconnected" ||
        this.peerConnection.connectionState === "failed"
      ) {
        this.onCallEnded();
      }
    };
  }

  async startCall(recipient, callType = "video") {
    this.currentCallRecipient = recipient;
    this.callType = callType;

    try {
      await this.initLocalStream(callType === "video");
      this.createPeerConnection();

      const offer = await this.peerConnection.createOffer();
      await this.peerConnection.setLocalDescription(offer);

      this.sendSignalingMessage({
        type: "offer",
        sdp: offer.sdp,
        callType: callType,
      });

      this.onCallStarted(recipient, callType);
    } catch (error) {
      console.error("Error starting call:", error);
      this.onCallFailed(error);
    }
  }

  async handleOffer(offer, sender) {
    this.currentCallRecipient = sender;
    this.callType = offer.callType;

    try {
      await this.initLocalStream(offer.callType === "video");
      this.createPeerConnection();

      await this.peerConnection.setRemoteDescription(
        new RTCSessionDescription({
          type: "offer",
          sdp: offer.sdp,
        })
      );

      const answer = await this.peerConnection.createAnswer();
      await this.peerConnection.setLocalDescription(answer);

      this.sendSignalingMessage({
        type: "answer",
        sdp: answer.sdp,
      });

      this.onCallStarted(sender, offer.callType);
    } catch (error) {
      console.error("Error handling offer:", error);
      this.onCallFailed(error);
    }
  }

  async handleAnswer(answer) {
    if (!this.peerConnection) return;
    await this.peerConnection.setRemoteDescription(
      new RTCSessionDescription({
        type: "answer",
        sdp: answer.sdp,
      })
    );
  }

  async handleCandidate(candidate) {
    if (!this.peerConnection) return;
    await this.peerConnection.addIceCandidate(new RTCIceCandidate(candidate));
  }

  endCall() {
    if (this.peerConnection) {
      this.peerConnection.close();
      this.peerConnection = null;
    }

    if (this.localStream) {
      this.localStream.getTracks().forEach((track) => track.stop());
      this.localStream = null;
    }

    if (this.remoteStream) {
      this.remoteStream.getTracks().forEach((track) => track.stop());
      this.remoteStream = null;
    }

    if (this.currentCallRecipient) {
      this.sendSignalingMessage({
        type: "hangup",
      });
    }

    this.onCallEnded();
  }

  sendSignalingMessage(message) {
    message.sender = this.username;
    message.recipient = this.currentCallRecipient;

    fetch(webrtcConfig.signalingServer, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(message),
    }).catch((error) =>
      console.error("Error sending signaling message:", error)
    );
  }

  // These methods should be overridden by the UI
  onCallStarted(recipient, callType) {}
  onCallFailed(error) {}
  onCallEnded() {}
  onRemoteStream(stream) {}
  onIncomingCall(sender, callType) {}
}

// Poll for signaling messages
function startSignalingPolling(username, callback) {
  let lastCheck = 0;

  const poll = async () => {
    try {
      const response = await fetch(
        `${webrtcConfig.signalingServer}?recipient=${username}&since=${lastCheck}`
      );
      const messages = await response.json();

      if (messages.length > 0) {
        lastCheck = Math.floor(Date.now() / 1000);
        messages.forEach((message) => callback(message));
      }
    } catch (error) {
      console.error("Error polling signaling server:", error);
    }

    setTimeout(poll, 2000);
  };

  poll();
}
