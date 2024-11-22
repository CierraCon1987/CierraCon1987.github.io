// Load cart items from localStorage or initialize an empty array
let cartItems = JSON.parse(localStorage.getItem("cart")) || [];

// Function to display cart items
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

    let cartContent = '';
    cartItems.forEach((item, index) => {
        const quantity = item.quantity || 1;
        const itemTotal = item.price * quantity;
        total += itemTotal;

        cartContent += `
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

    cartContainer.innerHTML = cartContent;
    cartTotalElement.textContent = `Total: $${total.toFixed(2)}`;
    localStorage.setItem("cart", JSON.stringify(cartItems));
}

// Function to add an item to the cart
function addToCart(productId) {

    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const productIndex = cart.findIndex(item => item.id === product.id);

    if (productIndex > -1) {
        cart[productIndex].quantity += 1; // Increment quantity if product exists
      } else {
        cart.push({ id: product.id, title: product.title, price: product.price, quantity: 1 });
      }

      localStorage.setItem('cart', JSON.stringify(cart));

      updateCartDisplay();
      showSuccessMessage();
    }
// Update Cart Display
function updateCartDisplay() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');
    const cartCountElement = document.getElementById('cart-count');
  
    // Reset cart items display
    cartItemsContainer.innerHTML = '';
  
    let totalItems = 0;
    let totalPrice = 0;
  
    // Populate cart items and calculate totals
    cart.forEach(item => {
      const itemTotalPrice = item.price * item.quantity;
      totalItems += item.quantity;
      totalPrice += itemTotalPrice;
  
      // Create a cart item element
      const cartItem = document.createElement('div');
      cartItem.classList.add('cart-item');
      cartItem.innerHTML = `
        <div class="cart-item-details">
          <p>${item.title}</p>
          <p>Price: $${item.price.toFixed(2)}</p>
          <p>Quantity: ${item.quantity}</p>
        </div>
        <button class="remove-item-btn" data-id="${item.id}">Remove</button>
      `;
  
      // Add event listener to remove item button
      cartItem.querySelector('.remove-item-btn').addEventListener('click', function () {
        removeCartItem(item.id);
      });
  
      cartItemsContainer.appendChild(cartItem);
    });
  
    // Update total price and item count
    cartTotalElement.textContent = `Total: $${totalPrice.toFixed(2)}`;
    cartCountElement.textContent = totalItems;
  }
  
  // Remove Cart Item
  function removeCartItem(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.id !== productId); // Remove the item with the given ID
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay(); // Refresh the cart display
  }
  
  // Show Success Message
  function showSuccessMessage() {
    const successMessage = document.createElement('div');
    successMessage.id = 'success-message';
    successMessage.textContent = 'Added to Cart!';
    successMessage.style.color = 'green';
    successMessage.style.fontWeight = 'bold';
  
    const addToCartButton = document.getElementById('addToCartOverlay');
    addToCartButton.textContent = 'Added to Cart'; // Update button text
  
    setTimeout(() => {
      successMessage.remove();
      resetAddToCartButton(); 
    }, 5000);
  
    addToCartButton.parentNode.appendChild(successMessage);
  }
  
  // Reset Add to Cart Button
  function resetAddToCartButton() {
    const addToCartButton = document.getElementById('addToCartOverlay');
    addToCartButton.textContent = "Add to Cart";
    const successMessage = document.getElementById('success-message');
    if (successMessage) successMessage.remove();
  }
  
  // Proceed to Checkout
  function proceedToCheckout() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart.length === 0) {
      alert('Your cart is empty. Please add items before proceeding to checkout.');
      return;
    }
    // Redirect to checkout page or implement checkout logic
    window.location.href = 'checkout.html';
  }
  
  // Initialize Cart Display on Page Load
  document.addEventListener("DOMContentLoaded", function () {
    updateCartDisplay(); // Ensure the cart reflects the stored cart state
  });

// Handle "Back to Products" button functionality
const backButton = document.getElementById('backToProductsBtn');
if (backButton) {
    backButton.addEventListener("click", function () {
        window.location.href = "products.html";
    });
}
