// cart.js
let cartItems = JSON.parse(localStorage.getItem("cart")) || [];

function displayCart() {
    const cartContainer = document.getElementById("cart-items");
    const cartTotalElement = document.getElementById("cart-total");
    cartContainer.innerHTML = '';
    let total = 0;
    
    if (cartItems.length === 0) {
        cartContainer.innerHTML = "<p>Your cart is empty!</p>";
        cartTotalElement.textContent = "Total: $0.00";
        return;
    }

    cartItems.forEach((item, index) => {
        const quantity = item.quantity || 1;
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        cartContainer.innerHTML += `
            <div class="cart-item">
             <p><strong>${item.title}</strong></p>
                <p>Price: $${item.price.toFixed(2)}</p>
                <p>Quantity: <input type="number" min="1" value="${quantity}" 
                    onchange="updateQuantity(${index}, this.value)"></p>
                <p>Item Total: $${itemTotal.toFixed(2)}</p>
                <button onclick="removeItem(${index})" class="btn btn-danger btn-sm">Remove</button>
            </div>
        `;
    });

    cartTotalElement.textContent = `Total: $${total.toFixed(2)}`;
    localStorage.setItem("cart", JSON.stringify(cartItems));
}

function addToCart(product) {
    const existingItemIndex = cartItems.findIndex(item => item.title === product.title);

    if (existingItemIndex >= 0) {
        cartItems[existingItemIndex].quantity += 1;
    } else {
        product.quantity = 1; 
        cartItems.push(product);
    }

    localStorage.setItem("cart", JSON.stringify(cartItems));

    const overlay = document.getElementById("productOverlay");
    const addToCartButton = overlay.querySelector("#addToCartOverlay");
    const messageElement = overlay.querySelector(".cart-message");

    messageElement.textContent = "Added to Cart!";
    messageElement.style.color = "red"; 

    setTimeout(() => {
        messageElement.textContent = "";
    }, 5000);
}

function updateQuantity(index, quantity) {
    cartItems[index].quantity = parseInt(quantity);
    displayCart();
}

function removeItem(index) {
    cartItems.splice(index, 1);
    displayCart();
}

function proceedToCheckout() {
    window.location.href = 'checkout.html';
}

window.onload = displayCart;


// Back to Products button
const backButton = document.getElementById('backToProductsBtn');

backButton.addEventListener("click", function() {
    window.location.href = "products.html";
});
