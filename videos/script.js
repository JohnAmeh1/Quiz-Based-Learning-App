document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("sidebar");
  const sidebarToggle = document.getElementById("sidebarToggle");
  const sidebarOverlay = document.getElementById("sidebarOverlay");
  const sidebarClose = document.getElementById("sidebarClose"); // New close button
  const searchButton = document.getElementById("searchButton");
  const searchInput = document.getElementById("searchInput");
  const videoGrid = document.getElementById("videoGrid");

  // Sidebar toggle for mobile
  sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("-translate-x-full");
    sidebarOverlay.classList.toggle("hidden");
  });

  // Close sidebar when overlay is clicked
  sidebarOverlay.addEventListener("click", () => {
    sidebar.classList.add("-translate-x-full");
    sidebarOverlay.classList.add("hidden");
  });
  // Hide sidebar when close button is clicked
  sidebarClose.addEventListener("click", () => {
    sidebar.classList.add("-translate-x-full");
    sidebarOverlay.classList.add("hidden");
  });

  // Function to fetch and display videos
  const fetchVideos = async (query) => {
    try {
      const response = await fetch(
        `api.php?query=${encodeURIComponent(query)}`
      );
      const data = await response.json();

      if (data.error) {
        videoGrid.innerHTML = `<p class="text-red-500">${data.error}</p>`;
        return;
      }

      // Clear previous videos
      videoGrid.innerHTML = "";

      // Display new videos
      data.items.forEach((item) => {
        const videoId = item.id.videoId;
        const videoTitle = item.snippet.title;
        const videoThumbnail = item.snippet.thumbnails.medium.url;

        const videoCard = `
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="${videoThumbnail}" alt="${videoTitle}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-2">${videoTitle}</h3>
                            <a
                                href="https://www.youtube.com/watch?v=${videoId}"
                                target="_blank"
                                class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800"
                            >
                                Watch video
                            </a>
                        </div>
                    </div>
                `;

        videoGrid.innerHTML += videoCard;
      });
    } catch (error) {
      videoGrid.innerHTML = `<p class="text-red-500">Failed to load videos. Please try again later.</p>`;
    }
  };

  // Initial load with default query
  fetchVideos("programming");

  // Search button click event
  searchButton.addEventListener("click", () => {
    const query = searchInput.value.trim();
    if (query) {
      fetchVideos(query);
    }
  });

  // Allow pressing Enter to search
  searchInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      const query = searchInput.value.trim();
      if (query) {
        fetchVideos(query);
      }
    }
  });
});
