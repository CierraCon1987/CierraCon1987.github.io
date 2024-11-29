document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed');

    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        console.log('Cart count element found!');
    } else {
        console.log('Cart count element not found!');
    }

    // Function to update the cart count
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];  // Retrieve the cart from localStorage
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);  // Calculate total quantity

    const cartCountElement = document.getElementById('cart-count');

    if (totalItems > 0) {
        cartCountElement.textContent = totalItems;  // Update the count
        cartCountElement.style.display = 'inline-block';  // Show the count
    } else {
        cartCountElement.style.display = 'none';  // Hide if no items
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const logos = document.querySelectorAll('.logo img, .brand-logo img');
    
    logos.forEach(logo => {
        logo.addEventListener('mouseover', () => {
            logo.classList.add('wiggle-effect');
        });

        // Remove the wiggle effect once the animation is done
        logo.addEventListener('animationend', () => {
            logo.classList.remove('wiggle-effect');
        });
    });

    // Function to update the cart count
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];  // Retrieve the cart from localStorage

        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);  // Calculate total quantity

        const cartCountElement = document.getElementById('cart-count');

        if (cartCountElement) {  // Check if the cart count element exists
            if (totalItems > 0) {
                cartCountElement.textContent = totalItems;  // Update the count
                cartCountElement.style.display = 'inline-block';  // Show the count
            } else {
                cartCountElement.style.display = 'none';  // Hide if no items
            }
        } else {
            console.error('Cart count element not found!');
        }
    }

    // Function to add item to the cart
    function addToCart(productId) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const productIndex = cart.findIndex(item => item.id === productId);

        if (productIndex === -1) {
            cart.push({ id: productId, quantity: 1 });
        } else {
            cart[productIndex].quantity += 1;
        }

        localStorage.setItem('cart', JSON.stringify(cart));  // Save updated cart to localStorage

        updateCartCount();  // Update cart count in header
    }

    // Run when the page loads to initialize the cart count
    updateCartCount();

    // Example of cart icon click behavior
    const cartLink = document.querySelector('.cart-icon a');
    if (cartLink) {
        cartLink.addEventListener('click', function(e) {
            // Optionally, show cart items or redirect to cart page
            console.log('Cart clicked, items:', JSON.parse(localStorage.getItem('cart')));
        });
    }
});
});