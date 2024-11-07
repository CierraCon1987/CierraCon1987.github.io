// Fetch product ID from URL parameters
const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('id');

// Fetch product data from JSON (simulating a database call until we have our database up and running)
fetch('/js/products.json')
    .then(response => response.json())
    .then(products => {
        if (products[productId]) {
            const product = products[productId];
            
            // Set product title, price, description, and item number
            document.getElementById('product-title').innerText = product.title;
            document.getElementById('product-price').innerText = `$${product.price.toFixed(2)}`;
            document.getElementById('product-description').innerText = product.description;
            document.getElementById('item-number').innerText = `Item ${productId}`;

            // Populate product features
            const featuresList = document.createElement('ul');
            product.features.forEach(feature => {
                const li = document.createElement('li');
                li.innerText = feature;
                featuresList.appendChild(li);
            });
            document.getElementById('product-features').appendChild(featuresList);

            // Set video source if it exists
            const videoElement = document.getElementById('product-video');
            if (product.video) {
                videoElement.children[0].src = product.video;  
                videoElement.style.display = 'block';          
            } else {
                videoElement.style.display = 'none';           
            }
        } else {
            document.body.innerHTML = "<h2>Product not found</h2>";
        }
    })
    .catch(error => {
        console.error("Error fetching product data:", error);
        document.body.innerHTML = "<h2>Error loading product details</h2>";
    });