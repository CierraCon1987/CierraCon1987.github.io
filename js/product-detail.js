// Fetch product ID from URL parameters
const urlParams = new URLSearchParams(window.location.search);
const productId = urlParams.get('id');

console.log("Product ID from URL:", productId);

// Fetch product data from JSON
fetch('./js/products.json') 
    .then(response => response.json())
    .then(products => {
        const product = products[productId];
        if (product) {
            console.log("Prodct Data:", product);
        }

        //console.log("Products loaded from JSON:", products);
        
        //if (products[productId]) {
            //const product = products[productId];
            //console.log("Product data:", product);

            // Set product title, price, description, and item number
            document.getElementById('product-title').innerText = product.title;
            document.getElementById('product-price').innerText = `$${product.price.toFixed(2)}`;
            document.getElementById('product-description').innerText = product.description;
            document.getElementById('item-number').innerText = `Item ${productId}`;

            // Populate product features
            //const featuresList = document.createElement('ul');
            //product.features.forEach(feature => {
                //const li = document.createElement('li');
                //li.innerText = feature;
                //featuresList.appendChild(li);
            //});
            //document.getElementById('product-features').appendChild(featuresList);

            // Set video source if it exists
            const videoElement = document.getElementById('product-video');
            if (product.video) {
                videoElement.querySelector("source").src = product.video;
                videoElement.style.display = 'block';
                videoElement.load();
                //videoElement.children[0].src = product.video;  
                //videoElement.style.display = 'block';          
            } else {
                videoElement.style.display = 'none';           
            }            
       // } else {
            // Display message if the product was not found
           // document.body.innerHTML = "<h2>Product not found</h2>";
            //console.error("Product not found for ID:", productId);
       // }
    //})
    //.catch(error => {
        // Handle errors when loading product data
       // console.error("Error fetching product data:", error);
       // document.body.innerHTML = "<h2>Error loading product details</h2>";
   // });

    // Set image carousel
    const carouselContainer = document.getElementById('carousel-images');
    if (product.images && product.images.length > 0) {
        carouselContainer.innerHTML = ''; // Clear any existing images
        product.images.forEach((imgPath, index) => {
            const imgElement = document.createElement('img');
            imgElement.src = imgPath;
            imgElement.className = 'carousel-image';
            carouselContainer.appendChild(imgElement);
        });
    } else {
        console.error("No images found for the carousel.");
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
