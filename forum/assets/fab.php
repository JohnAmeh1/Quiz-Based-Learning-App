<div class="fixed bottom-6 right-6 flex flex-col items-end space-y-2">
    <!-- Chatbot Modal (Hidden Initially) -->
    <div id="chatbot-modal"
        class="hidden absolute bottom-20 right-0 bg-white p-4 rounded-lg shadow-lg w-72">
        <h2 class="text-lg font-bold mb-2">Chatbot</h2>
        <div id="chatbot-messages" class="h-40 overflow-y-auto border p-2 rounded bg-gray-100 text-sm">
            <p class="text-gray-600">🤖 Hello! How can I assist you today?</p>
        </div>
        <textarea id="chatbot-input" class="w-full border rounded p-2 mt-2" placeholder="Type your message..."></textarea>
        <div class="flex justify-between mt-2">
            <button id="send-chatbot" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Send</button>
            <button id="close-chatbot" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Close</button>
        </div>
    </div>

    <!-- Quick Links Modal (Hidden Initially) -->
    <div id="quick-links-modal"
        class="hidden absolute bottom-20 right-0 bg-white p-4 rounded-lg shadow-lg w-72">
        <h2 class="text-lg font-bold mb-2">Quick Links</h2>
        <ul class="space-y-1">
            <!-- <li><a href="./faq.php" class="text-blue-600 hover:underline" aria-disabled="true">📌 FAQs</a></li> -->
            <li><a href="../dashboard.php" class="text-blue-600 hover:underline" aria-disabled="true">🏠 Home</a></li>
            <!-- <li><a href="./support.php" class="text-blue-600 hover:underline">🛠 Support</a></li> -->
            <li><a href="../pages/contact.php" class="text-blue-600 hover:underline">📞 Contact Us</a></li>
        </ul>
        <div class="flex justify-end mt-2">
            <button id="close-quick-links" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Close</button>
        </div>
    </div>

    <!-- Chatbot & Quick Links (Hidden Initially) -->
    <div id="fab-options" class="hidden flex flex-col items-end space-y-2 mb-2">
        <!-- Chatbot Button -->
        <button id="chatbot-btn"
            class="bg-green-600 hover:bg-green-700 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg transition">
            <i class="fas fa-robot text-xl"></i>
        </button>

        <!-- Quick Links Button -->
        <button id="quick-links-btn"
            class="bg-blue-600 hover:bg-blue-700 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg transition">
            <i class="fas fa-link text-xl"></i>
        </button>
    </div>

    <!-- Main Floating Action Button -->
    <button id="fab-main"
        class="bg-blue-600 hover:bg-blue-700 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg transition">
        <i class="fas fa-plus text-2xl transition-transform"></i>
    </button>
</div>