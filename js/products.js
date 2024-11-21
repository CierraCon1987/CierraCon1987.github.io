// Products Info
let originalProducts = [];
let selectedProductId = null;

document.addEventListener("DOMContentLoaded", function () {
  // Fetch product data
  fetch('js/products.json')
    .then(response => response.json())
    .then(data => {
      // Convert products object to an array
      originalProducts = Object.keys(data).map(key => ({
        id: key,
        ...data[key]
      }));
      displayProducts(originalProducts);
    })
    .catch(error => console.error('Error loading product data:', error));

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
});

// Display Products
function displayProducts(filteredProducts) {
  const productContainer = document.getElementById("product-container");
  productContainer.innerHTML = ""; // Clear existing products

  if (filteredProducts.length === 0) {
    // Display a message if no products match
    productContainer.innerHTML = "<p>No products match your search.</p>";
    return;
  }

  filteredProducts.forEach(product => {
    const productElement = document.createElement("div");
    productElement.classList.add("product-card");
    productElement.setAttribute('data-product-id', product.id);
    productElement.innerHTML = `
      <img src="${product.images[0]}" alt="${product.title}">
        <h3>${product.title}</h3>
        <p>${product.description}</p>
        <p class="price">${product.price}</p>
    `;
    productContainer.appendChild(productElement);
  });

  // Add click event listeners to show overlay
  document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('click', showProductOverlay);
  });
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

  let filteredProducts = [...originalProducts];

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
  displayProducts(filteredProducts);
}

document.getElementById("sort-category").addEventListener("change", filterProducts);

// Show Overlay
function showProductOverlay() {
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

// Event listeners for overlay closing
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

// Add to Cart
function addToCart(productId) {

  const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
  const productIndex = cart.findIndex(item => item.id === productId);

  if (productIndex > -1) {
    cart[productIndex].quantity += 1;
  } else {
    cart.push({ id: productId, quantity: 1 });
  }

  sessionStorage.setItem('cart', JSON.stringify(cart));
  updateCartDisplay();
}

// Update Cart Display
function updateCartDisplay() {
  const cartCountElement = document.getElementById('cart-count');
  const cart = JSON.parse(sessionStorage.getItem('cart')) || [];

  const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

  if (cartCountElement) {
    cartCountElement.textContent = totalItems > 0 ? totalItems : '';
    cartCountElement.style.display = totalItems > 0 ? 'block' : 'none';
  }
}

document.addEventListener('DOMContentLoaded', updateCartDisplay);