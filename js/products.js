// Filters Info
// Sorting function based on the `sortOrder` value
document.getElementById("sort-price").addEventListener("change", function() {
  const sortOrder = this.value;
});

// Filter products based on `searchTerm`
document.getElementById("search").addEventListener("input", function() {
  const searchTerm = this.value.toLowerCase();
});

// JavaScript to toggle additional products
document.addEventListener("DOMContentLoaded", function () {
  const maxInitialProducts = 4;

  // Hide additional products initially
  document.querySelectorAll(".tab-pane").forEach(tabPane => {
      const productCards = tabPane.querySelectorAll(".product-card");
      productCards.forEach((card, index) => {
          if (index >= maxInitialProducts) card.style.display = "none";
      });
  });
});



// Show More Button Info
function showMoreProducts(button) {
  const tabPane = button.closest(".tab-pane");
  const hiddenCards = tabPane.querySelectorAll(".product-card[style*='display: none']");

  // Show 4 more products, or all remaining if less than 4
  hiddenCards.forEach((card, index) => {
      if (index < 4) card.style.display = "block";
  });

  // Hide "See More" button if all products are now shown
  if (hiddenCards.length <= 4) button.style.display = "none";
}



// Product and Overlay Info
// Product and Overlay Info
document.addEventListener("DOMContentLoaded", function() {
  // Load the product data
  fetch('js/products.json')
    .then(response => response.json())
    .then(data => {
      window.productData = data;
    })
    .catch(error => console.error('Error loading product data:', error));
});

let selectedProductId = null; // To store the ID of the selected product

// Add click event listeners to each product card
document.querySelectorAll('.product-card').forEach(card => {
  card.addEventListener('click', function() {
    selectedProductId = this.getAttribute('data-product-id');
    
    // Get the product details from the loaded JSON data
    const product = window.productData[selectedProductId];
    
    if (product) {
      // Populate the overlay with the product data
      document.getElementById('overlayImage').src = product.image;
      document.getElementById('overlayTitle').textContent = product.title;
      document.getElementById('overlayDescription').textContent = product.description;
      document.getElementById('overlayPrice').textContent = `$${product.price}`;
      
      // Add features to the list
      const featuresList = document.getElementById('overlayFeatures');
      featuresList.innerHTML = ''; // Clear existing features
      product.features.forEach(feature => {
        const listItem = document.createElement('li');
        listItem.textContent = feature;
        featuresList.appendChild(listItem);
      });
      
      // Show the overlay
      document.getElementById('productOverlay').style.display = 'flex';
    } else {
      console.error(`Product with ID ${selectedProductId} not found.`);
    }
  });
});

// "View Full Product" button functionality
document.getElementById('viewFullProduct').addEventListener('click', function() {
  if (selectedProductId) {
    // Redirect to the product-detail.html page with the selected product ID
    window.location.href = `product-detail.html?id=${selectedProductId}`;
  } else {
    console.error('ERROR: Page does not exist - No product selected.');
  }
});

// Overlay and Close Button Functionality
const overlay = document.getElementById('productOverlay');
const closeButton = document.getElementById('close-button');

// Close the overlay function
function closeOverlay() {
  overlay.style.display = 'none';
}

// Close overlay when clicking outside overlay content
overlay.addEventListener('click', function(event) {
  if (event.target === overlay) {
    closeOverlay();
  }
});

// Close overlay when clicking the close button
closeButton.addEventListener('click', closeOverlay);
