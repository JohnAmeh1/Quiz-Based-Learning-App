document.getElementById("fab-main").addEventListener("click", function () {
    let options = document.getElementById("fab-options");
    let icon = document.querySelector("#fab-main i");
    options.classList.toggle("hidden");
    icon.classList.toggle("rotate-45");
  });
  
  document.getElementById("chatbot-btn").addEventListener("click", function () {
    document.getElementById("chatbot-modal").classList.toggle("hidden");
  });
  
  document
    .getElementById("quick-links-btn")
    .addEventListener("click", function () {
      document.getElementById("quick-links-modal").classList.toggle("hidden");
    });
  
  document.getElementById("close-chatbot").addEventListener("click", function () {
    document.getElementById("chatbot-modal").classList.add("hidden");
  });
  
  document
    .getElementById("close-quick-links")
    .addEventListener("click", function () {
      document.getElementById("quick-links-modal").classList.add("hidden");
    });
  
  const chatbotResponses = {
    hello: "Hello! How can I assist you with your learning?",
    hi: "Hello! How can I assist you with your learning?",
    "how does this work":
      "Our platform allows you to take quizzes, track progress, and access tutoring sessions!",
    "how do i use the app":
      "Our platform allows you to take quizzes, track progress, and access tutoring sessions!",
    "how do i use the website":
      "Our platform allows you to take quizzes, track progress, and access tutoring sessions!",
    "how do i use eduquest":
      "Our platform allows you to take quizzes, track progress, and access tutoring sessions!",
    "how to start a course":
      "Simply navigate to our courses section and select a category to begin!",
    "how do i get started":
      "Simply navigate to our courses section and select a category to begin!",
    "how to take a quiz":
      "Simply navigate to our courses section and select a category to begin!",
    "what courses do you offer":
      "We offer a variety of courses, Simply navigate to our courses section and pick one",
    "contact support":
      "You can reach support via the 'Support' section in quick links.",
    default:
      "I'm not sure about that. Try asking about quizzes, tutoring, or support.",
  };
  
  document.getElementById("send-chatbot").addEventListener("click", function () {
    let userInput = document
      .getElementById("chatbot-input")
      .value.trim()
      .toLowerCase();
    if (userInput === "") return;
  
    let chatbotMessages = document.getElementById("chatbot-messages");
  
    // Display user message
    chatbotMessages.innerHTML += `<p class="text-blue-600 text-right">You: ${userInput}</p>`;
  
    // Generate bot response
    let response = chatbotResponses[userInput] || chatbotResponses["default"];
    setTimeout(() => {
      chatbotMessages.innerHTML += `<p class="text-gray-600">🤖 ${response}</p>`;
      chatbotMessages.scrollTop = chatbotMessages.scrollHeight; // Auto-scroll to latest message
    }, 500);
  
    document.getElementById("chatbot-input").value = ""; // Clear input field
  });
  
  document.getElementById("close-chatbot").addEventListener("click", function () {
    document.getElementById("chatbot-modal").classList.add("hidden");
  });
  