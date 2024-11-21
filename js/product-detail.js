// Get Product Details
const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('id');

console.log("Product ID from URL:", productId);

let currentImageIndex = 0;

function updateCarousel(images) {
    const carouselContainer = document.getElementById('carousel-images');
    if (images && images.length > 0) {
        carouselContainer.innerHTML = '';
        const imgElement = document.createElement('img');
        imgElement.src = images[currentImageIndex];
        imgElement.className = 'carousel-image';
        imgElement.alt = `Product Image ${currentImageIndex + 1}`;
        carouselContainer.appendChild(imgElement);
    }
}

// Get info from JSON File
fetch('/js/products.json')
    .then(response => response.json())
    .then(products => {
        const product = products[productId];
        if (product) {
            console.log("Product data:", product);
            document.getElementById('product-title').innerText = product.title;
            document.getElementById('product-price').innerText = `$${product.price}`;
            document.getElementById('product-description').innerText = product.description;

            // Video Source
            const videoElement = document.getElementById('product-video');
            if (product.video) {
                videoElement.querySelector("source").src = product.video;
                videoElement.style.display = 'block';
                videoElement.load();
            } else {
                videoElement.style.display = 'none';
            }

            // Image Carousel
            if (product.images && product.images.length > 0) {
                updateCarousel(product.images);

                document.getElementById('nextBtn').addEventListener('click', () => {
                    currentImageIndex = (currentImageIndex + 1) % product.images.length;
                    updateCarousel(product.images);
                });
                document.getElementById('prevBtn').addEventListener('click', () => {
                    currentImageIndex = (currentImageIndex - 1 + product.images.length) % product.images.length;
                    updateCarousel(product.images);
                });
            } else {
                console.error("No images found for the carousel.");
            }

            // Features List
            const featuresList = document.getElementById('features-list');
            featuresList.innerHTML = '';
            product.features.forEach(feature => {
                const listItem = document.createElement('li');
                listItem.innerText = feature;
                featuresList.appendChild(listItem);
            });

            // Function to add the product to the cart
            function addToCart(productId) {
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                const productIndex = cart.findIndex(item => item.id === productId);

                if (productIndex === -1) {
                    cart.push({
                        id: productId,
                        quantity: 1
                    });
                    console.log("Product added to cart:", productId);
                } else {
                    cart[productIndex].quantity += 1;
                    console.log("Product quantity updated:", productId);
                }

                localStorage.setItem('cart', JSON.stringify(cart));

                showSuccessMessage();
            }

            // Function to show success message
            function showSuccessMessage() {
                const messageElement = document.createElement('div');
                messageElement.className = 'cart-success-message';
                messageElement.textContent = 'Added to Cart!';
                messageElement.style.color = 'red';
                messageElement.style.fontWeight = 'bold';
                messageElement.style.marginTop = '10px';

                const productDetailsSection = document.querySelector('.product-details');
                productDetailsSection.appendChild(messageElement);

                // Remove  message after 5 seconds
                setTimeout(() => {
                    messageElement.remove();
                }, 5000);
            }

            // Add to Cart Button
            const addToCartButton = document.getElementById('addToCartButton');
            if (addToCartButton) {
                addToCartButton.addEventListener('click', () => {
                    addToCart(productId);
                });
            }

        } else {
            console.error("Product not found with ID:", productId);
            document.body.innerHTML = "<h2>Product not found</h2>";
        }
    })
    .catch(error => {
        console.error("Error fetching product data:", error);
        document.body.innerHTML = "<h2>Error loading product details</h2>";
    });

// Back to Products button
const backToProductsBtn = document.getElementById('backToProductsBtn');
if (backToProductsBtn) {
    backToProductsBtn.addEventListener('click', () => {
        window.location.href = 'products.html'; // Redirect to the products page
    });
}
