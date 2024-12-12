// Redirect to Home page on successful login
function handleLogin(event) {
    event.preventDefault(); // Prevent form submission

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const messageBox = document.getElementById('message-box');

    // Reset message box display
    messageBox.style.display = 'none';

    // Basic validation
    if (email === '' || password === '') {
        showMessage('Please enter both email and password.', 'error');
        return;
    }

    // Placeholder authentication (replace this with actual login logic)
    if (email === 'user@example.com' && password === 'password123') {
        showMessage('Login successful! Redirecting...', 'success');
        setTimeout(() => {
            window.location.href = "home.html";
        }, 2000); // Delay for redirection
    } else {
        showMessage('Invalid email or password. Please try again.', 'error');
    }
}

// Function to display messages with specific colors
function showMessage(message, type) {
    const messageBox = document.getElementById('message-box');
    messageBox.textContent = message;
    messageBox.className = 'message-box ' + (type === 'success' ? 'success-message' : 'error-message');
    messageBox.style.display = 'block';
}

// Function to handle 'Forgot Password'
function forgotPassword() {
    showMessage('Forgot password functionality is currently not available.', 'error');
}

// Function to save 'Remember Me' status
function rememberMeStatus() {
    const rememberMe = document.getElementById('rememberMe').checked;
    if (rememberMe) {
        showMessage('You will be remembered!', 'success');
    }
}
