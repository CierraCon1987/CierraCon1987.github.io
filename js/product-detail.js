// Get Product Details
const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('id');

console.log("Product ID from URL:", productId);

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
            const carouselContainer = document.getElementById('carousel-images');
            if (product.images && product.images.length > 0) {
                carouselContainer.innerHTML = '';
                product.images.forEach((imgPath, index) => {
                    const imgElement = document.createElement('img');
                    imgElement.src = imgPath;
                    imgElement.className = 'carousel-image';
                    carouselContainer.appendChild(imgElement);
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
        } else {
            console.error("Product not found with ID:", productId);
            document.body.innerHTML = "<h2>Product not found</h2>";
        }
    })
    .catch(error => {
        console.error("Error fetching product data:", error);
        document.body.innerHTML = "<h2>Error loading product details</h2>";
    });