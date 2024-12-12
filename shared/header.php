<?php
$current_page = basename($_SERVER['PHP_SELF']);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="page-header">
    <video autoplay muted loop id="background-video">
        <source src="images/videos/wandw-header-vid.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="header-content">
        <div class="logo">
            <a href="index.php"><img src="images/wandw-logo-large.svg" alt="logo"></a>
        </div>
        <div id="google_translate_element"></div>
        <div class="link-salute">
            <div class="links">
                <ul>
                    <li><a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a></li>
                    <li><a href="about.php" class="<?= $current_page == 'about.php' ? 'active' : '' ?>">About</a></li>
                    <li><a href="products.php" class="<?= $current_page == 'products.php' ? 'active' : '' ?>">Products</a></li>
                    <li><a href="adoption.php" class="<?= $current_page == 'adoption.php' ? 'active' : '' ?>">Adoption</a></li>
                    <li><a href="contact.php" class="<?= $current_page == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
                    <li><a href="articles.php" class="<?= $current_page == 'articles.php' ? 'active' : '' ?>">Articles</a></li>
                    <?php if (isset($_SESSION['user_name'])): ?>
                        <li><a href="#" class="username">Hello, <?= htmlspecialchars($_SESSION['user_name']) ?></a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="login-signup">
                            <a href="login-register.php" class="<?= $current_page == 'login-register.php' ? 'active' : '' ?>">Login</a>
                            <a href="register.php" class="<?= $current_page == 'register.php' ? 'active' : '' ?>">Sign Up</a>
                        </li>
                    <?php endif; ?>
                    <li class="cart-icon">
                        <a href="cart.php" class="<?= $current_page == 'cart.php' ? 'active' : '' ?>">
                            <img src="images/general/shopping_cart_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" alt="Cart" style="width: 24px; height: 24px;">
                        </a>
                        <span id="cart-count">0</span>
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
    <script>
        const isLoggedIn = <?php echo isset($_SESSION['user_name']) ? 'true' : 'false'; ?>;
        const currentUser = <?php echo isset($_SESSION['user_name']) ? json_encode($_SESSION['user_name']) : 'null'; ?>;

        if (isLoggedIn) {
            console.log(`Logged in as: ${currentUser}`);
        } else {
            console.log('User is not logged in.');
        }
    </script>

    <script>

        function updateCartDisplay() {
            const cartCountElement = document.getElementById('cart-count');
            const cartKey = currentUser ? `cart_${currentUser}` : 'cart_guest';
            const cart = JSON.parse(localStorage.getItem(cartKey)) || [];
            const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);

            cartCountElement.textContent = totalItems;
            cartCountElement.style.display = totalItems > 0 ? 'inline' : 'none';
        }

        document.addEventListener('DOMContentLoaded', updateCartDisplay);
    </script>
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
