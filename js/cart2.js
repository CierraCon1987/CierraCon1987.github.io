    const cartKey = currentUser ? `cart_${currentUser}` : 'cart_guest';
    let cartItems = JSON.parse(localStorage.getItem(cartKey)) || [];

    function validateForm() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const zipCodeRegex = /^[A-Z]\d[A-Z]\s?\d[A-Z]\d$/i;
        const phoneRegex = /^\+?\d{10,15}$/;
        const nameRegex = /^[a-zA-Z\s'-]+$/;
    
        const email = document.getElementById('billing-email-address').value;
        const firstName = document.getElementById('billing-first-name').value;
        const lastName = document.getElementById('billing-last-name').value;
        const addressLine1 = document.getElementById('billing-address-line-1').value;
        const zipCode = document.getElementById('billing-zip-code').value;
        const mobilePhone = document.getElementById('billing-mobile-phone').value;
    
        let isValid = true;
        let errorMessage = '';
    
        if (!emailRegex.test(email)) {
            isValid = false;
            errorMessage += 'Invalid email format.\n';
        }
        if (!firstName.trim() || !nameRegex.test(firstName)) {
            isValid = false;
            errorMessage += 'First name is required and must contain only letters, spaces, apostrophes, or hyphens.\n';
        }
        if (!lastName.trim() || !nameRegex.test(lastName)) {
            isValid = false;
            errorMessage += 'Last name is required and must contain only letters, spaces, apostrophes, or hyphens.\n';
        }
        if (!addressLine1.trim()) {
            isValid = false;
            errorMessage += 'Address Line 1 is required.\n';
        }
        if (!zipCodeRegex.test(zipCode)) {
            isValid = false;
            errorMessage += 'Invalid zip code format.\n';
        }
        if (!phoneRegex.test(mobilePhone)) {
            isValid = false;
            errorMessage += 'Invalid phone number format.\n';
        }
    
        if (!isValid) {
            alert(errorMessage);
        }
    
        return isValid;
    }
    

    function displayCart() {
        const cartContainer = document.getElementById("cart-items");
        const cartSummaryElement = document.querySelector(".cart-summary");
    
        if (!cartContainer || !cartSummaryElement) return;
    
        cartContainer.innerHTML = '';
        cartSummaryElement.innerHTML = '';
        let total = 0;
    
        if (cartItems.length === 0) {
            cartContainer.innerHTML = "<p>Your cart is empty!</p>";
            cartSummaryElement.innerHTML = `
                <p>Your cart is empty. Please add products to proceed to checkout.</p>
            `;
            return;
        }
    
        cartItems.forEach((item, index) => {
            const quantity = item.quantity || 1;
            const itemTotal = item.price * quantity;
            total += itemTotal;
    
            const cartItem = document.createElement("div");
            cartItem.classList.add("cart-item");
            cartItem.innerHTML = `
                <p><strong>${item.title}</strong></p>
                <p>Price: $${item.price.toFixed(2)}</p>
                <p>
                    Quantity: 
                    <input type="number" min="1" value="${quantity}" 
                        onchange="updateQuantity(${index}, this.value)">
                </p>
                <p>Item Total: $${itemTotal.toFixed(2)}</p>
                <button onclick="removeItem(${index})" class="btn btn-danger btn-sm">Remove</button>
            `;
            cartContainer.appendChild(cartItem);
        });
    
        const provincesAndCities = {
            "AB": ["Calgary", "Edmonton", "Red Deer"],
            "BC": ["Vancouver", "Victoria", "Kelowna"],
            "MB": ["Winnipeg", "Brandon"],
            "NB": ["Fredericton", "Moncton", "Saint John"],
            "NL": ["St. John's", "Corner Brook"],
            "NS": ["Halifax", "Sydney"],
            "ON": ["Toronto", "Ottawa", "Hamilton"],
            "PE": ["Charlottetown", "Summerside"],
            "QC": ["Montreal", "Quebec City"],
            "SK": ["Saskatoon", "Regina"],
            "NT": ["Yellowknife"],
            "NU": ["Iqaluit"],
            "YT": ["Whitehorse"]
        };
    
        function updateCities(type) {
            const province = document.getElementById(`${type}-province`).value;
            const citySelect = document.getElementById(`${type}-city`);
        
            if (!citySelect) return;
        
            citySelect.innerHTML = '';
        
            const defaultCityOption = new Option('Choose your city', '', true, true);
            citySelect.add(defaultCityOption);
        
            if (province && provincesAndCities[province]) {
                provincesAndCities[province].forEach(city => {
                    citySelect.add(new Option(city, city));
                });
            }
        
            const selectedCity = citySelect.dataset.selectedCity || '';
            if (selectedCity && provincesAndCities[province]?.includes(selectedCity)) {
                citySelect.value = selectedCity;
            } else {
                citySelect.selectedIndex = 0;
            }
        
            delete citySelect.dataset.selectedCity;
        }
        
        function populateProvincesAndCities() {
            const billingProvince = document.getElementById('billing-province');
            const billingCity = document.getElementById('billing-city');
            const shippingProvince = document.getElementById('shipping-province');
            const shippingCity = document.getElementById('shipping-city');
        
            if (!billingProvince || !shippingProvince) return;
        
            const defaultOption = new Option('Choose your province', '', true, true);
            billingProvince.add(defaultOption.cloneNode(true));
            shippingProvince.add(defaultOption.cloneNode(true));
        
            Object.keys(provincesAndCities).forEach(province => {
                const option = new Option(province, province);
                billingProvince.add(option.cloneNode(true));
                shippingProvince.add(option.cloneNode(true));
            });
        
            billingProvince.addEventListener('change', () => updateCities('billing'));
            shippingProvince.addEventListener('change', () => updateCities('shipping'));
        
            if (billingProvince.value) {
                updateCities('billing');
            }
            if (shippingProvince.value) {
                updateCities('shipping');
            }
        }
        

        cartSummaryElement.innerHTML = `
        <form method="post" action="checkout.php" onsubmit="return validateForm()">
            <input type="hidden" id="cartTotalInput" name="cart_total" value="${Math.round(total * 100)}">
            <p>Total: $${total.toFixed(2)}</p>
            <div class="billing-shipping-section mb-4">
                <h4>Billing Address</h4>
                <div class="form-group">
                    <label for="billing-email-address">Email Address *</label>
                    <input type="email" id="billing-email-address" name="billing_email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="billing-first-name">First Name *</label>
                    <input type="text" id="billing-first-name" name="billing_first_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="billing-address-line-1">Address Line 1 *</label>
                    <input type="text" id="billing-address-line-1" name="billing_address_line_1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="billing-address-line-2">Address Line 2</label>
                    <input type="text" id="billing-address-line-2" name="billing_address_line_2" class="form-control">
                </div>
                <div class="form-group">
                    <label for="billing-zip-code">Zip Code *</label>
                    <input type="text" id="billing-zip-code" name="billing_zip_code" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="billing-province">Province *</label>
                    <select id="billing-province" name="billing_province" class="form-control" required></select>
                </div>
                <div class="form-group">
                    <label for="billing-city">City *</label>
                    <select id="billing-city" name="billing_city" class="form-control" required></select>
                </div>
                <div class="form-group">
                    <label for="billing-mobile-phone">Mobile Phone *</label>
                    <input type="text" id="billing-mobile-phone" name="billing_mobile_phone" class="form-control" required>
                </div>
            </div>
            <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" id="use_same_address" name="use_same_address" checked>
                <label class="form-check-label" for="use-same-address">Use Billing Address for Shipping</label>
            </div>
            <div class="billing-shipping-section mb-4" id="shipping-address-section">
                <h4>Shipping Address</h4>
                <div class="form-group">
                    <label for="shipping-address-line-1">Address Line 1 *</label>
                    <input type="text" id="shipping-address-line-1" name="shipping_address_line_1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="shipping-address-line-2">Address Line 2</label>
                    <input type="text" id="shipping-address-line-2" name="shipping_address_line_2" class="form-control">
                </div>
                <div class="form-group">
                    <label for="shipping-zip-code">Zip Code *</label>
                    <input type="text" id="shipping-zip-code" name="shipping_zip_code" class="form-control">
                </div>
                <div class="form-group">
                    <label for="shipping-province">Province *</label>
                    <select id="shipping-province" name="shipping_province" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="shipping-city">City *</label>
                    <select id="shipping-city" name="shipping_city" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="shipping-mobile-phone">Mobile Phone *</label>
                    <input type="text" id="shipping-mobile-phone" name="shipping_mobile_phone" class="form-control">
                </div>
            </div>
            <button class="btn btn-primary cartBtn">Proceed to Checkout</button>
        </form>
    `;

        populateProvincesAndCities();

        document.getElementById('shipping-address-section').style.display = 'none';

        document.getElementById('use_same_address').addEventListener('change', function () {
            const isChecked = this.checked;
            const shippingAddressSection = document.getElementById('shipping-address-section');
            const shippingFields = shippingAddressSection.querySelectorAll('input, select');
        
            if (isChecked) {
                shippingAddressSection.style.display = 'none';
                shippingFields.forEach(field => {
                    field.setAttribute('disabled', 'true');
                });
            } else {
                shippingAddressSection.style.display = 'block';
                shippingFields.forEach(field => {
                    field.setAttribute('required', 'true');
                    field.removeAttribute('disabled'); 
                });
                shippingFields.forEach(field => field.value = ''); 
            }
        });

        document.querySelector('form').addEventListener('submit', function (event) {
            const shippingAddressSection = document.getElementById('shipping-address-section');
            const shippingFields = shippingAddressSection.querySelectorAll('input, select');
            let isValid = true;
        
            if (shippingAddressSection.style.display !== 'none') {
                shippingFields.forEach(field => {
                    if (field.hasAttribute('required') && !field.value.trim()) {
                        isValid = false;
                        alert(`${field.name} is required.`);
                    }
                });
            }
        
            if (!isValid) {
                event.preventDefault();
            }
        });
        
    }



function updateQuantity(index, newQuantity) {
    const quantity = parseInt(newQuantity, 10);
    if (quantity > 0 && index >= 0 && index < cartItems.length) {
        cartItems[index].quantity = quantity;
        localStorage.setItem(cartKey, JSON.stringify(cartItems));
        displayCart();
    }
}

function removeItem(index) {
    if (index >= 0 && index < cartItems.length) {
        cartItems.splice(index, 1);
        localStorage.setItem(cartKey, JSON.stringify(cartItems));
        displayCart();
    }
}

function addToCart(product) {
    if (!currentUser) {
        window.location.href = "login-register.php";
        return;
    }

    const existingIndex = cartItems.findIndex(item => item.id === product.id);
    if (existingIndex > -1) {
        cartItems[existingIndex].quantity += 1;
    } else {
        cartItems.push({
            id: product.id,
            title: product.title,
            price: product.price,
            quantity: 1
        });
    }
    localStorage.setItem(cartKey, JSON.stringify(cartItems));
    displayCart();
    showSuccessMessage();
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

document.addEventListener("DOMContentLoaded", function () {
    function updateCities(type) {
        const province = document.getElementById(`${type}-province`).value;
        const citySelect = document.getElementById(`${type}-city`);
        if (!citySelect) return;

        citySelect.innerHTML = '';

        const defaultCityOption = new Option('Choose your city', '', true, true);
        citySelect.add(defaultCityOption);

        if (province && provincesAndCities[province]) {
            provincesAndCities[province].forEach(city => {
                citySelect.add(new Option(city, city));
            });
        }

        const selectedCity = citySelect.dataset.selectedCity || '';
        if (selectedCity && provincesAndCities[province]?.includes(selectedCity)) {
            citySelect.value = selectedCity;
        } else {
            citySelect.selectedIndex = 0;
        }

        delete citySelect.dataset.selectedCity;
    }

    const provincesAndCities = {
        "AB": ["Calgary", "Edmonton", "Red Deer"],
        "BC": ["Vancouver", "Victoria", "Kelowna"],
        "MB": ["Winnipeg", "Brandon"],
        "NB": ["Fredericton", "Moncton", "Saint John"],
        "NL": ["St. John's", "Corner Brook"],
        "NS": ["Halifax", "Sydney"],
        "ON": ["Toronto", "Ottawa", "Hamilton"],
        "PE": ["Charlottetown", "Summerside"],
        "QC": ["Montreal", "Quebec City"],
        "SK": ["Saskatoon", "Regina"],
        "NT": ["Yellowknife"],
        "NU": ["Iqaluit"],
        "YT": ["Whitehorse"]
    };

    fetch('get_user_info.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            const billingFields = {
                email: document.getElementById('billing-email-address'),
                firstName: document.getElementById('billing-first-name'),
                lastName: document.getElementById('billing-last-name'),
                addressLine1: document.getElementById('billing-address-line-1'),
                addressLine2: document.getElementById('billing-address-line-2'),
                zipCode: document.getElementById('billing-zip-code'),
                mobilePhone: document.getElementById('billing-mobile-phone')
            };

            const shippingFields = {
                email: document.getElementById('shipping-email-address'),
                firstName: document.getElementById('shipping-first-name'),
                lastName: document.getElementById('shipping-last-name'),
                addressLine1: document.getElementById('shipping-address-line-1'),
                addressLine2: document.getElementById('shipping-address-line-2'),
                zipCode: document.getElementById('shipping-zip-code'),
                mobilePhone: document.getElementById('shipping-mobile-phone')
            };

            const billingProvince = document.getElementById('billing-province');
            const billingCity = document.getElementById('billing-city');
            const shippingProvince = document.getElementById('shipping-province');
            const shippingCity = document.getElementById('shipping-city');

            billingFields.email.value = data.email || '';
            billingFields.firstName.value = data.name || '';
            billingFields.addressLine1.value = data.billing_address_line_1 || '';
            billingFields.addressLine2.value = data.billing_address_line_2 || '';
            billingFields.zipCode.value = data.billing_zip_code || '';
            billingFields.mobilePhone.value = data.billing_mobile_phone || '';
            billingProvince.value = data.billing_province || '';
            billingCity.dataset.selectedCity = data.billing_city || '';

       
            shippingFields.addressLine1.value = data.shipping_address_line_1 || '';
            shippingFields.addressLine2.value = data.shipping_address_line_2 || '';
            shippingFields.zipCode.value = data.shipping_zip_code || '';
            shippingFields.mobilePhone.value = data.shipping_mobile_phone || '';
            shippingProvince.value = data.shipping_province || '';
            shippingCity.dataset.selectedCity = data.shipping_city || '';

            const useSameAddressCheckbox = document.getElementById('use_same_address');
            const shippingAddressSection = document.getElementById('shipping-address-section');

            if (data.use_same_address === '1') {
                useSameAddressCheckbox.checked = true;
                shippingAddressSection.style.display = 'none';
                shippingAddressSection.querySelectorAll('input, select').forEach(field => {
                    field.setAttribute('disabled', 'true');
                });
            } else {
                useSameAddressCheckbox.checked = false;
                shippingAddressSection.style.display = 'block';
                shippingAddressSection.querySelectorAll('input, select').forEach(field => {
                    field.removeAttribute('disabled');
                });
            }

            updateCities('billing');
            if (!useSameAddressCheckbox.checked) {
                updateCities('shipping');
            }

            useSameAddressCheckbox.addEventListener('change', function () {
                const isChecked = this.checked;
                if (isChecked) {
                    shippingAddressSection.style.display = 'none';
                    shippingAddressSection.querySelectorAll('input, select').forEach(field => {
                        field.setAttribute('disabled', 'true');
                        field.value = '';
                    });
                } else {
                    shippingAddressSection.style.display = 'block';
                    shippingAddressSection.querySelectorAll('input, select').forEach(field => {
                        field.removeAttribute('disabled');
                        field.setAttribute('required', 'true');
                    });
                }
            });
        })

    displayCart();
});

