document.getElementById("upload-form").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch("upload.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json()) // Parse the response as JSON
    .then((data) => {
      const responseMessage = document.getElementById("response-message");
      if (data.error) {
        responseMessage.innerHTML = `<div class="bg-red-500 text-white p-3 rounded">${data.error}</div>`;
      } else {
        responseMessage.innerHTML = `<div class="bg-green-500 text-white p-3 rounded">${data.message}</div>`;
        setTimeout(function () {
          window.location.href = "./index.php";
        }, 1000);
      }
    })
    .catch((error) => {
      const responseMessage = document.getElementById("response-message");
      responseMessage.innerHTML =
        '<div class="bg-red-500 text-white p-3 rounded">An error occurred. Please try again.</div>';
      console.error("Error:", error);
    });
});

// Function to load templates
function loadTemplates() {
  const templatesList = document.getElementById("templates-list");
  templatesList.innerHTML = '<p class="text-gray-700">Loading templates...</p>';

  fetch("view.php")
    .then((response) => response.json())
    .then((data) => {
      templatesList.innerHTML = ""; // Clear loading message
      data.forEach((template) => {
        const templateDiv = document.createElement("div");
        templateDiv.innerHTML = `
  <div class="relative">
    <!-- Premium Badge and Category -->
    <div class="absolute top-0 left-0 bg-yellow-500 text-white text-xs font-bold px-4 py-1 rounded-br-lg z-10">
      PREMIUM
    </div>
    <div class="absolute top-0 right-0 bg-gray-800 text-white text-xs font-bold px-4 py-1 rounded-bl-lg z-10">
      WORDPRESS
    </div>
    
    <!-- Thumbnail with overlay -->
    <div class="w-full h-48 overflow-hidden group relative">
      <img src="uploads/${
        template.thumbnail
      }" alt="Thumbnail" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
      <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
        <div class="opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
          <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300 mx-1">
            Preview
          </button>
          <a href="details.php?id=${
            template.id
          }" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-300 mx-1">
            Details
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="p-5">
    <!-- Title -->
    <h3 class="text-lg font-bold text-gray-800 mb-2 hover:text-blue-600 transition-colors duration-300">${
      template.title
    }</h3>

    <!-- Description -->
    <div class="flex">
      <p class="text-gray-600 text-sm mb-4 line-clamp-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>${template.description}
      </p>
      <a href="details.php?id=${
        template.id
      }" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-300 mx-1">
            Details
          </a>
    </div>

    <!-- Screenshots Gallery -->
    <div class="grid grid-cols-3 gap-2 mb-5">
      ${
        template.screenshot1
          ? `<img src="uploads/${template.screenshot1}" alt="Screenshot 1" class="h-16 w-full object-cover rounded-md border border-gray-200 hover:border-blue-500 cursor-pointer transition-all duration-300">`
          : ""
      }
      ${
        template.screenshot2
          ? `<img src="uploads/${template.screenshot2}" alt="Screenshot 2" class="h-16 w-full object-cover rounded-md border border-gray-200 hover:border-blue-500 cursor-pointer transition-all duration-300">`
          : ""
      }
      ${
        template.screenshot3
          ? `<img src="uploads/${template.screenshot3}" alt="Screenshot 3" class="h-16 w-full object-cover rounded-md border border-gray-200 hover:border-blue-500 cursor-pointer transition-all duration-300">`
          : ""
      }
    </div>

    <!-- Price and CTA -->
    <div class="flex justify-between items-center border-t border-gray-200 pt-4">
      <div>
        <span class="text-sm text-gray-500 line-through">$59.99</span>
        <div class="text-green-600 font-bold text-xl">$39.99</div>
        <div class="text-xs text-gray-500">License: Regular</div>
      </div>
      <a href="download.php?file=${template.file_name}" 
         class="bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700 transition-colors duration-300 font-medium shadow-md">
        Purchase
      </a>
    </div>

    <!-- Tags -->
    <div class="flex flex-wrap mt-4 text-xs">
      <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full mr-1 mb-1 hover:bg-gray-200 cursor-pointer transition-colors">wordpress</span>
      <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full mr-1 mb-1 hover:bg-gray-200 cursor-pointer transition-colors">theme</span>
      <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full mr-1 mb-1 hover:bg-gray-200 cursor-pointer transition-colors">ecommerce</span>
      <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full mr-1 mb-1 hover:bg-gray-200 cursor-pointer transition-colors">responsive</span>
    </div>
  </div>
`;

        // Append the templateDiv to the desired container in your HTML
        document.getElementById("template-container").appendChild(templateDiv); // Or append it to a specific container
        // templatesList.appendChild(templateDiv);
      });
    })
    .catch((error) => {
      console.error("Error loading templates:", error);
      templatesList.innerHTML =
        '<p class="text-red-500">Failed to load templates. Please try again.</p>';
    });
}

// Form submission handler
document.getElementById("upload-form").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch("upload.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        alert(data.message);
        loadTemplates(); // Refresh the template list
      } else {
        alert("Error: " + data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("An error occurred. Please try again.");
    });
});

// Load templates when the page loads
document.addEventListener("DOMContentLoaded", function () {
  loadTemplates();
});
