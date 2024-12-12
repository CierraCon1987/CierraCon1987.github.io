document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registerForm");
    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirmPassword");

    // Regex patterns for validation
    const namePattern = /^[a-zA-Z\s]{2,50}$/;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

    // Message box for success message
    const messageBox = document.createElement("div");
    messageBox.className = "success-message";
    messageBox.innerText = "Account created successfully!";
    document.body.appendChild(messageBox);
    messageBox.style.display = "none"; // Hide initially

    function validateName() {
        if (!namePattern.test(nameInput.value)) {
            setError(nameInput, "Name must be between 2 and 50 letters.");
            return false;
        }
        setSuccess(nameInput);
        return true;
    }

    function validateEmail() {
        if (!emailPattern.test(emailInput.value)) {
            setError(emailInput, "Please enter a valid email.");
            return false;
        }
        setSuccess(emailInput);
        return true;
    }

    function validatePassword() {
        if (!passwordPattern.test(passwordInput.value)) {
            setError(passwordInput, "Password must be at least 8 characters and include a letter and a number.");
            return false;
        }
        setSuccess(passwordInput);
        return true;
    }

    function validateConfirmPassword() {
        if (confirmPasswordInput.value !== passwordInput.value) {
            setError(confirmPasswordInput, "Passwords do not match.");
            return false;
        }
        setSuccess(confirmPasswordInput);
        return true;
    }

    function setError(input, message) {
        const formGroup = input.parentElement;
        formGroup.classList.add("error");
        formGroup.classList.remove("success");
        const errorDisplay = formGroup.querySelector("small");
        if (errorDisplay) {
            errorDisplay.innerText = message;
        } else {
            const errorElement = document.createElement("small");
            errorElement.innerText = message;
            formGroup.appendChild(errorElement);
        }
    }

    function setSuccess(input) {
        const formGroup = input.parentElement;
        formGroup.classList.add("success");
        formGroup.classList.remove("error");
        const errorDisplay = formGroup.querySelector("small");
        if (errorDisplay) {
            errorDisplay.innerText = "";
        }
    }

    form.addEventListener("submit", (e) => {
        const isNameValid = validateName();
        const isEmailValid = validateEmail();
        const isPasswordValid = validatePassword();
        const isConfirmPasswordValid = validateConfirmPassword();

        if (isNameValid && isEmailValid && isPasswordValid && isConfirmPasswordValid) {
            messageBox.style.display = "block";  // Show success message
            setTimeout(() => {
                messageBox.style.display = "none";  // Hide message after 3 seconds
                window.location.href = "login-register.html"; // Redirect to login page
            }, 3000);
        } else {
            alert("Please correct the errors in the form.");
        }
    });

    nameInput.addEventListener("input", validateName);
    emailInput.addEventListener("input", validateEmail);
    passwordInput.addEventListener("input", validatePassword);
    confirmPasswordInput.addEventListener("input", validateConfirmPassword);
});
