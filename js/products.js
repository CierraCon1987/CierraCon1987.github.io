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
  document.getElementById("productOverlay").addEventListener("click", closeOverlay);
  document.getElementById('closebutton').addEventListener('click', function (event) {
    event.stopPropagation();
    closeOverlay();
  });
});

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
        <p>${product.description}</p>
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

  console.log("Filtering products...");
  console.log("Search Term:", searchTerm);
  console.log("Sort Order:", sortOrder);
  console.log("Selected Category:", selectedCategory);

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

  console.log("filtered products:", filteredProducts);

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
    document.getElementById('overlayDescription').textContent = product.description;
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

    // Add to Cart button
    const addToCartButton = document.getElementById('addToCartOverlay');
    addToCartButton.onclick = function () {
      addToCart(product);
    };
  } else {
    console.error(`Product with ID ${selectedProductId} not found.`);
  }
}

// Close Overlay
function closeOverlay() {
  document.getElementById('productOverlay').style.display = 'none';
  sessionStorage.setItem('overlayOpen', 'false');
}

// Add to Cart
function addToCart(product) {
  const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
  const productIndex = cart.findIndex(item => item.id === product.id);

  if (productIndex > -1) {
    cart[productIndex].quantity += 1;
  } else {
    cart.push({ id: product.id, quantity: 1 });
  }

  sessionStorage.setItem('cart', JSON.stringify(cart));
  updateCartDisplay();
  showSuccessMessage();
}

// Show Success Message
function showSuccessMessage() {
  const successMessage = document.getElementById('success-message');

  if (!successMessage) {
    const messageElement = document.createElement('div');
    messageElement.id = 'success-message';
    messageElement.textContent = 'Added to Cart!';
    messageElement.style.color = 'red';
    messageElement.style.fontWeight = 'bold';
    messageElement.style.marginTop = '10px';

    const addToCartButton = document.getElementById('addToCartOverlay');
    if (addToCartButton) {
      addToCartButton.parentNode.appendChild(messageElement);
    }

    // Remove message after 5 seconds
    setTimeout(() => {
      messageElement.remove();
    }, 5000);
  }
}

// Update Cart Display
function updateCartDisplay() {
  const cartCountElement = document.getElementById('cart-count');
  const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
  const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
  cartCountElement.textContent = totalItems;
}

// Event listeners for overlay closing (existing function, no changes needed)
const overlay = document.getElementById('productOverlay');
overlay.addEventListener('click', function (event) {
  if (event.target === overlay) closeOverlay();
});

document.getElementById('closebutton').addEventListener('click', function (event) {
  event.stopPropagation();
  closeOverlay();
});

// View Full Product
document.getElementById('viewFullProduct').addEventListener('click', function () {
  if (selectedProductId) {
    window.location.href = `product-detail.html?id=${selectedProductId}`;
  } else {
    console.error('ERROR: No product selected.');
  }
});
