// cart.js
let cartItems = JSON.parse(localStorage.getItem("cart")) || [];

function displayCart() {
    const cartContainer = document.getElementById("cart-items");
    cartContainer.innerHTML = '';
    let total = 0;

    cartItems.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        cartContainer.innerHTML += `
            <div class="cart-item">
                <p>${item.name}</p>
                <p>Price: $${(item.price / 100).toFixed(2)}</p>
                <p>Quantity: <input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)"></p>
                <p>Total: $${(itemTotal / 100).toFixed(2)}</p>
                <button onclick="removeItem(${index})" class="btn btn-danger btn-sm">Remove</button>
            </div>
        `;
    });

    document.getElementById("cart-total").textContent = `Total: $${(total / 100).toFixed(2)}`;
    localStorage.setItem("cart", JSON.stringify(cartItems));
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

// Cierra - Cart.js - Will talk :)

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
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        cartContainer.innerHTML += `
            <div class="cart-item">
                <p><strong>${item.name}</strong></p>
                <p>Price: $${(item.price / 100).toFixed(2)}</p>
                <p>Quantity: <input type="number" min="1" value="${item.quantity}" 
                    onchange="updateQuantity(${index}, this.value)"></p>
                <p>Item Total: $${(itemTotal / 100).toFixed(2)}</p>
                <button onclick="removeItem(${index})" class="btn btn-danger btn-sm">Remove</button>
            </div>
        `;
    });

    cartTotalElement.textContent = `Total: $${(total / 100).toFixed(2)}`;
    localStorage.setItem("cart", JSON.stringify(cartItems));
}

function updateQuantity(index, quantity) {
    const parsedQuantity = parseInt(quantity, 10);
    if (isNaN(parsedQuantity) || parsedQuantity < 1) {
        alert("Invalid quantity");
        return;
    }
    cartItems[index].quantity = parsedQuantity;
    displayCart();
}

function removeItem(index) {
    cartItems.splice(index, 1);
    displayCart();
}

function proceedToCheckout() {
    if (cartItems.length === 0) {
        alert("Your cart is empty!");
        return;
    }
    window.location.href = 'checkout.html';
}

window.onload = displayCart;
