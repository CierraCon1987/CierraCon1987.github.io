console.log("Showing");
let originalProducts = [];
let filteredProducts = [];
let displayedCount = 0;
let productsPerPage = 8;
let selectedProductId = null;

const cartKey = currentUser ? `cart_${currentUser}` : 'cart_guest';
let cartItems = JSON.parse(localStorage.getItem(cartKey)) || [];

document.addEventListener("DOMContentLoaded", function () {
    closeOverlay();

    fetch('js/products.json')
        .then(response => response.json())
        .then(data => {
            originalProducts = Object.keys(data).map(key => ({
                id: key,
                ...data[key]
            }));
            filteredProducts = [...originalProducts];
            displayProducts(displayedCount, productsPerPage);
        })
        .catch(error => console.error('Error loading product data:', error));

    document.getElementById("search").addEventListener("input", filterProducts);
    document.getElementById("sort-price").addEventListener("change", filterProducts);
    document.getElementById("sort-category").addEventListener("change", filterProducts);
    document.getElementById("see-more-btn").addEventListener("click", loadMoreProducts);

    const overlay = document.getElementById('productOverlay');
    overlay.addEventListener('click', function (event) {
        if (event.target === overlay) {
            closeOverlay();
        }
    });

    const closeButton = document.getElementById('closebutton');
    if (closeButton) {
        closeButton.addEventListener('click', function (event) {
            event.stopPropagation();
            closeOverlay();
        });
    }
});

function closeOverlay() {
    const overlay = document.getElementById('productOverlay');
    if (overlay) {
        overlay.style.display = 'none';
        const quantityInput = document.getElementById('overlayQuantity');
        quantityInput.value = 1;
        sessionStorage.setItem('overlayOpen', 'false');
    }
}

function displayProducts(startIndex, count) {
    const productContainer = document.getElementById("product-container");
    const productsToDisplay = filteredProducts.slice(startIndex, startIndex + count);

    if (productsToDisplay.length === 0) {
        document.getElementById('see-more-btn').style.display = 'none';
        return;
    }

    productsToDisplay.forEach(product => {
        const productElement = document.createElement("div");
        productElement.classList.add("product-card");
        productElement.setAttribute('data-product-id', product.id);
        productElement.innerHTML = `
            <img src="${product.images[0]}" alt="${product.title}">
            <h3>${product.title}</h3>
            <p>${product.shortdes}</p>
            <p class="price">$${product.price.toFixed(2)}</p>
        `;
        productElement.addEventListener('click', showProductOverlay);
        productContainer.appendChild(productElement);
    });

    document.getElementById('see-more-btn').style.display =
        startIndex + count < filteredProducts.length ? 'block' : 'none';
}

function loadMoreProducts() {
    displayedCount += productsPerPage;
    displayProducts(displayedCount, productsPerPage);
}

function filterProducts() {
    const searchTerm = document.getElementById("search").value.toLowerCase();
    const sortOrder = document.getElementById("sort-price").value;
    const selectedCategory = document.getElementById("sort-category").value;

    filteredProducts = [...originalProducts];

    if (searchTerm) {
        filteredProducts = filteredProducts.filter(product =>
            product.title.toLowerCase().includes(searchTerm)
        );
    }

    if (selectedCategory) {
        filteredProducts = filteredProducts.filter(product =>
            product.category.toLowerCase() === selectedCategory.toLowerCase()
        );
    }

    if (sortOrder) {
        filteredProducts.sort((a, b) => {
            return sortOrder === "asc" ? a.price - b.price : b.price - a.price;
        });
    }

    const productContainer = document.getElementById("product-container");
    productContainer.innerHTML = '';
    displayedCount = 0;
    displayProducts(displayedCount, productsPerPage);
}

function showProductOverlay() {
    selectedProductId = this.getAttribute('data-product-id');
    const product = originalProducts.find(p => p.id === selectedProductId);

    if (product) {
        document.getElementById('overlayImage').src = product.images[0];
        document.getElementById('overlayTitle').textContent = product.title;
        document.getElementById('overlayDescription').textContent = product.shortdes;
        document.getElementById('overlayPrice').textContent = `$${product.price.toFixed(2)}`;

        const featuresList = document.getElementById('overlayFeatures');
        featuresList.innerHTML = '';
        product.features.forEach(feature => {
            const listItem = document.createElement('li');
            listItem.textContent = feature;
            featuresList.appendChild(listItem);
        });

        const quantityInput = document.getElementById('overlayQuantity');
        quantityInput.value = 1;

        document.getElementById('productOverlay').style.display = 'flex';
        sessionStorage.setItem('overlayOpen', 'true');

        resetAddToCartButton();

        const addToCartButton = document.getElementById('addToCartOverlay');
        addToCartButton.onclick = function () {
            const quantity = parseInt(quantityInput.value, 10);
            console.log("Selected quantity:", quantity); // Depuración
            if (quantity > 0) {
                addToCart(product, quantity);
            } else {
                alert('Please enter a valid quantity.');
            }
        };
    }
}

function addToCart(product, quantity = 1) {
    console.log("Adding to cart:", product, "Quantity:", quantity); // Depuración
    if (!currentUser) {
        window.location.href = "login-register.php";
        return;
    }

    const existingIndex = cartItems.findIndex(item => item.id === product.id);

    if (existingIndex > -1) {
        console.log("Product already in cart. Current quantity:", cartItems[existingIndex].quantity); // Depuración
        cartItems[existingIndex].quantity += quantity;
        console.log("Updated quantity:", cartItems[existingIndex].quantity); // Depuración
    } else {
        console.log("Product not in cart. Adding new item."); // Depuración
        cartItems.push({
            id: product.id,
            title: product.title,
            price: product.price,
            quantity: quantity
        });
    }

    localStorage.setItem(cartKey, JSON.stringify(cartItems));
    closeOverlay();
    showSuccessMessage();
    updateCartDisplay();
}


function showSuccessMessage() {
    const successMessage = document.createElement('div');
    successMessage.id = 'success-message';
    successMessage.textContent = 'Added to Cart!';
    successMessage.style.position = 'fixed';
    successMessage.style.top = '10px';
    successMessage.style.right = '10px';
    successMessage.style.padding = '10px';
    successMessage.style.backgroundColor = 'green';
    successMessage.style.color = 'white';
    successMessage.style.borderRadius = '5px';
    successMessage.style.zIndex = '1000';

    document.body.appendChild(successMessage);

    setTimeout(() => {
        successMessage.remove();
    }, 2000);
}

function resetAddToCartButton() {
    const addToCartButton = document.getElementById('addToCartOverlay');
    addToCartButton.textContent = "Add to Cart";
    const successMessage = document.getElementById('success-message');
    if (successMessage) successMessage.remove();
}

function updateCartDisplay() {
    const cartCountElement = document.getElementById('cart-count');
    const totalItems = cartItems.reduce((acc, item) => acc + item.quantity, 0);
    cartCountElement.textContent = totalItems;
    cartCountElement.style.display = totalItems > 0 ? 'inline' : 'none';
}
