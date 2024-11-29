// Products Info
let originalProducts = [];
let filteredProducts = [];
let displayedCount = 0; // Tracks how many products are currently displayed
let productsPerPage = 8;
let selectedProductId = null;

document.addEventListener("DOMContentLoaded", function () {
  
  // Fetch product data
  fetch('js/products.json')
    .then(response => response.json())
    .then(data => {
      originalProducts = Object.keys(data).map(key => ({
        id: key,
        ...data[key]
      }));
      filteredProducts = [...originalProducts]; // Initially, no filtering
      displayProducts(displayedCount, productsPerPage);
    })
    .catch(error => console.error('Error loading product data:', error));

  document.getElementById('productOverlay').style.display = 'none';

  // Check overlay state on page load
  const overlayState = sessionStorage.getItem('overlayOpen');
  if (overlayState === 'true') {
    document.getElementById('productOverlay').style.display = 'flex';
  } else {
    document.getElementById('productOverlay').style.display = 'none';
  }

  // Add event listeners for search and sorting
  document.getElementById("search").addEventListener("input", filterProducts);
  document.getElementById("sort-price").addEventListener("change", filterProducts);
  document.getElementById("sort-category").addEventListener("change", filterProducts);
  document.getElementById("see-more-btn").addEventListener("click", loadMoreProducts);

  // Event listener for overlay closing (combined)
  const overlay = document.getElementById('productOverlay');
  overlay.addEventListener('click', function (event) {
    if (event.target === overlay) {
      closeOverlay(); // Close when clicking on the overlay background
    }
  });

  // Close button listener (prevents overlay close when clicked)
  const closeButton = document.getElementById('closebutton');
  if (closeButton) {
    closeButton.addEventListener('click', function (event) {
      event.stopPropagation(); // Prevent click event from propagating to overlay
      closeOverlay();
    });
  }
});

// Close Overlay 
function closeOverlay() {
  document.getElementById('productOverlay').style.display = 'none';
  sessionStorage.setItem('overlayOpen', 'false');
}

// Display Products
function displayProducts(startIndex, count) {
  const productContainer = document.getElementById("product-container");

  // Get products to display based on the filtered products array
  const productsToDisplay = filteredProducts.slice(startIndex, startIndex + count);

  // If no products to display, hide the "See More" button
  if (productsToDisplay.length === 0) {
    document.getElementById('see-more-btn').style.display = 'none'; 
  } else {
    productsToDisplay.forEach(product => {
      const productElement = document.createElement("div");
      productElement.classList.add("product-card");
      productElement.setAttribute('data-product-id', product.id);
      productElement.innerHTML = `
        <img src="${product.images[0]}" alt="${product.title}">
        <h3>${product.title}</h3>
        <p>${product.shortdes}</p>
        <p class="price">${product.price}</p>
      `;
      productElement.addEventListener('click', showProductOverlay); // Add event listener for overlay
      productContainer.appendChild(productElement);
    });
  }

  // Check if there are more products to load
  if (startIndex + count < filteredProducts.length) {
    document.getElementById('see-more-btn').style.display = 'block';
  } else {
    document.getElementById('see-more-btn').style.display = 'none';
  }
}

// Load More Products
function loadMoreProducts() {
  displayedCount += productsPerPage; // Increase the number of displayed products
  displayProducts(displayedCount, productsPerPage); // Display the next set of products
}

// Filter Products
function filterProducts() {
  const searchTerm = document.getElementById("search").value.toLowerCase();
  const sortOrder = document.getElementById("sort-price").value;
  const selectedCategory = document.getElementById("sort-category").value;

  filteredProducts = [...originalProducts]; // Reset to original products first

  // Search filter
  if (searchTerm) {
    filteredProducts = filteredProducts.filter(product =>
      product.title.toLowerCase().includes(searchTerm)
    );
  }

  // Category filter
  if (selectedCategory) {
    filteredProducts = filteredProducts.filter(product =>
      product.category.toLowerCase() === selectedCategory.toLowerCase()
    );
  }

  // Sort by Price
  if (sortOrder) {
    filteredProducts.sort((a, b) => {
      return sortOrder === "asc" ? a.price - b.price : b.price - a.price;
    });
  }

  // Reset the displayed count and show the first page of filtered products
  displayedCount = 0;
  displayProducts(displayedCount, productsPerPage);
}

// Show Product Overlay
function showProductOverlay(event) {
  selectedProductId = this.getAttribute('data-product-id');
  const product = originalProducts.find(p => p.id === selectedProductId);

  if (product) {
    document.getElementById('overlayImage').src = product.images[0];
    document.getElementById('overlayTitle').textContent = product.title;
    document.getElementById('overlayDescription').textContent = product.shortdes;
    document.getElementById('overlayPrice').textContent = `$${product.price}`;

    const featuresList = document.getElementById('overlayFeatures');
    featuresList.innerHTML = '';
    product.features.forEach(feature => {
      const listItem = document.createElement('li');
      listItem.textContent = feature;
      featuresList.appendChild(listItem);
    });

    document.getElementById('productOverlay').style.display = 'flex';
    sessionStorage.setItem('overlayOpen', 'true');

    resetAddToCartButton(); // Reset the button state before adding functionality

    // Add to Cart button
    const addToCartButton = document.getElementById('addToCartOverlay');
    addToCartButton.onclick = function () {
      addToCart(product);
    };
  } else {
    console.error(`Product with ID ${selectedProductId} not found.`);
  }
}

// Reset Add to Cart Button
function resetAddToCartButton() {
  const addToCartButton = document.getElementById('addToCartOverlay');
  addToCartButton.textContent = "Add to Cart";
  const successMessage = document.getElementById('success-message');
  if (successMessage) successMessage.remove(); // Remove any existing success message
}

// Add to Cart
function addToCart(product) {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const productIndex = cart.findIndex(item => item.id === product.id);

  if (productIndex > -1) {
    cart[productIndex].quantity += 1;
  } else {
    cart.push({ id: product.id, quantity: 1 });
  }

  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartDisplay();
  showSuccessMessage();
}

// Update Cart Display
function updateCartDisplay() {
  const cartCountElement = document.getElementById('cart-count');
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
  cartCountElement.textContent = totalItems;
}

// Show Success Message
function showSuccessMessage() {
  const successMessage = document.createElement('div');
  successMessage.id = 'success-message';
  successMessage.textContent = 'Added to Cart!';
  successMessage.style.color = 'red';
  successMessage.style.fontWeight = 'bold';

  const addToCartButton = document.getElementById('addToCartOverlay');
  addToCartButton.textContent = 'Added to Cart'; // Update button text

  setTimeout(() => {
    successMessage.remove();
    resetAddToCartButton(); 
  }, 5000);

  addToCartButton.parentNode.appendChild(successMessage);
}

// Reset Add to Cart Button
function resetAddToCartButton() {
  const addToCartButton = document.getElementById('addToCartOverlay');
  addToCartButton.textContent = "Add to Cart";
  const successMessage = document.getElementById('success-message');
  if (successMessage) successMessage.remove();
}

// Initialize Cart Display on Page Load
document.addEventListener("DOMContentLoaded", function () {
  updateCartDisplay(); // Ensure the cart count reflects the stored cart state
});