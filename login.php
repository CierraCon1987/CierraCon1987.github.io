<?php
// Include database connection file
include 'database_connection.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)):'';
    $password = isset($_POST['password']) ? $_POST['password'] :'';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (empty($errors)) {
        // Check if email exists in the database
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashedPassword);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Successful login, redirect to homepage
                header("Location: index.php");
                exit();
            } else {
                $errors[] = "Invalid password.";
            }
        } else {
            // Redirect unregistered user to signup page
            header("Location: register.php?message=new_user");
            exit();
        }
    }
}
?>
<?php if (isset($_GET['message']) && $_GET['message'] == 'new_user'): ?>
    <p class="error-message">Email not found. Please <a href="register.php">sign up</a>.</p>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Wags &amp; Whiskers</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/CierraCon1987.github.io/images/wandw-favicon.svg">
    
    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Custom CSS -->
    <link href="css/login.css " rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/fadein.css" rel="stylesheet">

    <!-- Custom JS -->
    <script src="js/header.js" defer></script>
    <script src="js/fadein.js" defer></script>

</head>

<body>
    <header class="page-header">
        <video autoplay muted loop id="background-video">
            <source src="http://localhost/CierraCon1987.github.io/images/videos/wandw-header-vid.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="header-content">
            <div class="logo">
                <a href="index.html"><img src="http://localhost/CierraCon1987.github.io/images/wandw-logo-large.svg" alt="logo"></a>
            </div>
            <div id="google_translate_element"></div>
            <div class="link-salute">
                <div class="links">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="products.html">Products</a></li>
                        <li><a href="adoption.html">Adoption</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="articles.html">Articals</a></li>
                        <li class="login-signup">
                            <a href="login.php"class="active">Login</a>
                            <a href="register.php">Sign Up</a>
                        </li>
                        <li class="cart-icon">
                            <a href="cart.html"><img src="http://localhost/CierraCon1987.github.io/images/general/shopping_cart_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" alt="Cart" style="width: 24px; height: 24px;"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="salute">
            <h3>Welcome to</h3>
            <h1>Wags &amp; Whiskers!</h1>
            <p id="tagline">Caring for Your Pets, One Wag at a Time</p>
        </div>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'en,hi,fr,es,gu,af,zh-CN,ja,pa,ml',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');
            }
            </script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    </header>
    <main>
        <div class="container">
            <div class="fade-in login-form">
                <h1 class="welcome-text">Welcome Back!</h1>
                <img src="http://localhost/CierraCon1987.github.io/images/wandw-logo-large.svg" alt="Pet Image" class="pet-image">
                <form action="login.php" method="POST">
                <h2 class="login-header">Login</h2>

<!-- Email Input -->
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">

    <?php if (!empty($errors['email'])): ?>
            <p class="error-message"><?php echo $errors['email']; ?></p>
        <?php endif; ?>
</div>

<!-- Password Input -->
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
    <?php if (!empty($errors['password'])): ?>
            <p class="error-message"><?php echo $errors['password']; ?></p>
        <?php endif; ?>
</div>

<!-- Remember Me and Forgot Password Links -->
<div class="form-options">
    <div class="form-check">
        <input type="checkbox" id="rememberMe" onclick="rememberMeStatus()">
        <label for="rememberMe">Remember me</label>
    </div>
    <a href="#" class="forgot-password" onclick="forgotPassword()">Forgot password?</a>
</div>

<!-- Login Button -->
<button type="submit"class="login-button">Login</button>
</form>

<!-- New User Sign-Up Link -->
<div class="new-user-link">
<span>New user?</span> <a href="register.php">Create account</a>
</div>
</div>
</div>
</main>
<footer>
<div class="link-section">
<div class="company-info">
<h2>Social Media</h2>
<p>
Follow us on social media for the latest updates,
pet care tips, and exclusive offers! Stay connected with Wags
&amp; Whiskers and join our community of pet lovers.
</p>
<div class="social-icon">
<img src="images/socials/socials-facebook.svg" alt="facebook icon">
<img src="images/socials/socials-x.svg" alt="x icon">
<img src="images/socials/socials-instagram.svg" alt="instagram icon">
<img src="images/socials/socials-pinterest.svg" alt="pinterest icon">
<img src="images/socials/socials-youtube.svg" alt="youtube icon">
<img src="images/socials/socials-tiktok.svg" alt="tiktok icon">
<img src="images/socials/socials-whatsapp.svg" alt="whatsapp icon">
</div>
</div>

<div class="quick-link">
<h2>Company</h2>
<ul>
<li><a href="index.html">Home</a></li>
<li><a href="about.html">About</a></li>
<li><a href="products.html">Products</a></li>
<li><a href="adoption.html">Adoption</a></li>
<li><a href="contact.html">Contact</a></li>
<li><a href="articles.html">Articles</a></li>
</ul>
</div>

<div class="legal">
<h2>Legal</h2>
<ul>
<li><a href="#">Privacy Policy</a></li>
<li><a href="#">Terms of Services</a></li>
<li><a href="#">Refunds</a></li>
<li><a href="#">Guarantee</a></li>
<li><a href="#">Shipping</a></li>
</ul>
</div>

<div class="brand-logo">
<a href="index.html"><img src="images/wandw-logo-large.svg" alt="logo"></a>
</div>
</div>

<div class="copy-right-section">
<div class="right-section">
Copyright &copy; 2024 Wags &amp; Whiskers. All right reserved.
</div>

<div class="cookies">
<a href="#">Cookies Settings</a>
<a href="#">Cookies Policy</a>
</div>
</div>
</footer>
</body>

</html>