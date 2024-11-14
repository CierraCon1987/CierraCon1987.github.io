// Filters Info
// Sorting function based on the `sortOrder` value
document.getElementById("sort-price").addEventListener("change", function () {
  const sortOrder = this.value;
});

// Filter products based on `searchTerm`
document.getElementById("search").addEventListener("input", function () {
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

  hiddenCards.forEach((card, index) => {
    if (index < 4) card.style.display = "block";
  });
  if (hiddenCards.length <= 4) button.style.display = "none";
}



// Product and Overlay Info
document.addEventListener("DOMContentLoaded", function () {
  fetch('js/products.json')
    .then(response => response.json())
    .then(data => {
      window.productData = data;
    })
    .catch(error => console.error('Error loading product data:', error));
  });

  let selectedProductId = null;

  document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('click', function () {
      selectedProductId = this.getAttribute('data-product-id');
      
      const product = window.productData[selectedProductId];

      if (product) {
        document.getElementById('overlayImage').src = product.image;
        document.getElementById('overlayTitle').textContent = product.title;
        document.getElementById('overlayDescription').textContent = product.description;
        document.getElementById('overlayPrice').textContent = `$${product.price}`;

        // Add features to the list
        const featuresList = document.getElementById('overlayFeatures');
        featuresList.innerHTML = '';
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

  document.getElementById('viewFullProduct').addEventListener('click', function() {
    if (selectedProductId) {
      window.location.href = `product-detail.html?id=${selectedProductId}`;
    } else {
      console.error('No product selected.');
    }
  });

  // Overlay and Close Button Functionality
  const overlay = document.getElementById('productOverlay');
  const closeButton = document.getElementById('closebutton');

  // Close the overlay function
  function closeOverlay() {
    overlay.style.display = 'none';
  }

  // Close overlay when clicking outside overlay content
  overlay.addEventListener('click', function (event) {
    if (event.target === overlay) {
      closeOverlay();
    }
  });

  // Close overlay when clicking the close button
  closeButton.addEventListener('click', function (event) {
    event.stopPropagation();
    closeOverlay();
  });


// "View Full Product" button functionality
document.addEventListener("DOMContentLoaded", function()
{
  const viewFullProductButton = document.getElementById('viewFullProduct');
  viewFullProductButton.addEventListener('click', function() {
    if (selectedProductId) {
      window.location.href = `product-detail.html?id=${selectedProductId}`;
    } else {
      console.error('ERROR: Page does not exist - No product selected.');
    }
  });
});
