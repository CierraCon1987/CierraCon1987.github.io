document.addEventListener('DOMContentLoaded', async function() {
    // Load cart items and display them on the checkout page
    loadCartItems();

    // Initialize Stripe Payment Element
    await initializePaymentElement();
});

const stripe = Stripe('pk_test_51QKimLFKwZttl2HpFxwCkknkPgNkGrR7P4IPdI111iJxp0twjX296BwVMTGE7HyFRz4kg9e17VOgP1zJ4lu5E2sW00i1bBCF5r'); // Replace with your actual Stripe publishable key

// Function to initialize Stripe Payment Element
async function initializePaymentElement() {
    const items = JSON.parse(localStorage.getItem('cart')) || [];
    const totalAmount = calculateTotalAmount();

    // Fetch clientSecret from your server
    const response = await fetch('create-checkout-session.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ items, totalAmount })
    });

    const { clientSecret, error } = await response.json();

    if (error) {
        document.getElementById('error-message').textContent = error;
        return;
    }

    // Initialize Stripe Elements with the clientSecret
    const elements = stripe.elements({ clientSecret });
    const paymentElement = elements.create('payment');
    paymentElement.mount('#payment-element');
}

// Function to calculate the total amount in the cart
function calculateTotalAmount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    return cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
}

// Function to load cart items on the checkout page
function loadCartItems() {
    const cartItemsContainer = document.getElementById("cart-items");
    const cart = JSON.parse(localStorage.getItem("cart")) || [];

    cartItemsContainer.innerHTML = ''; // Clear any existing items

    cart.forEach((item) => {
        const itemElement = document.createElement("div");
        itemElement.className = "cart-item";
        itemElement.innerHTML = `<strong>${item.name}</strong> - $${(item.price / 100).toFixed(2)} x ${item.quantity}`;
        cartItemsContainer.appendChild(itemElement);

        const itemTotalElement = document.createElement("p");
        itemTotalElement.className = "item-total";
        itemTotalElement.textContent = `Item Total: $${((item.price * item.quantity) / 100).toFixed(2)}`;
        cartItemsContainer.appendChild(itemTotalElement);
    });

    // Display total amount
    const totalAmount = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
    document.getElementById("cart-total").textContent = `Total: $${(totalAmount / 100).toFixed(2)}`;
}

// Form submission handler
document.getElementById('checkout-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const elements = stripe.elements();

    // Confirm payment
    const { error } = await stripe.confirmPayment({
        elements,
        confirmParams: {
            return_url: 'https://your-website.com/success.html', // Replace with your success page URL
        },
    });

    // Display error if any
    if (error) {
        document.getElementById('error-message').textContent = error.message;
    }
});
