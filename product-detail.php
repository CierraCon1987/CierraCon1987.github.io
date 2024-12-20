<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Wags &amp; Whiskers</title>
    <link rel="icon" type="image/x-icon" href="/images/wandw-favicon.svg">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link href="/css/header.css" rel="stylesheet">
    <link href="/css/product-detail.css" rel="stylesheet">
    <link href="/css/fadein.css" rel="stylesheet">

    <!-- Custom JS -->
    <script src="/js/header.js" defer></script>
    <script src="/js/product-detail.js" defer></script>
    <script src="/js/fadein.js" defer></script>

    <!-- Custom JSON -->
    <script src="/js/products.json" defer></script>

</head>

<body>
    <header class="page-header">
        <video autoplay muted loop id="background-video">
            <source src="../images/videos/wandw-header-vid.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="header-content">
            <div class="logo">
                <a href="index.html"><img src="/images/wandw-logo-large.svg" alt="logo"></a>
            </div>
            <div id="google_translate_element"></div>
            <div class="link-salute">
                <div class="links">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="products.html" class="active">Products</a></li>
                        <li><a href="adoption.html">Adoption</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="articles.html">Articles</a></li>
                        <li class="login-signup">
                            <a href="login-register.html">Login</a>
                            <a href="register.html">Sign Up</a>
                        </li>
                        <li class="cart-icon">
                            <a href="cart.html">
                                <img src="/images/general/shopping_cart_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png" alt="Cart" style="width: 24px; height: 24px;">
                            </a>
                            <span id="cart-count" style="position: absolute; top: -5px; right: -10px; background-color: red; color: white; font-size: 12px; font-weight: bold; border-radius: 50%; padding: 2px 6px; display: none;">0</span>
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

    <button id="backToProductsBtn">Back to Products</button>

    <main class="product-container">

        <section class="video-section">
            <video id="product-video" controls style="display: none;">
                <source id="video-source" src="" type="video/mp4">
                <source id="video-source" src="" type="video/webm">
                <source id="video-source" src="" type="video/ogg">
                Your browser does not support the video tag.
            </video>

            <div class="carousel">
                <button id="prevBtn" class="carousel-btn">&lt;</button>
                <div id="carousel-images"></div>
                <button id="nextBtn" class="carousel-btn">&gt;</button>
            </div>
        </section>
    
        <section class="product-details">
            <h1 id="product-title"></h1>
            <p id="product-price"></p>
            <p id="product-description"></p>
            <span id="item-number"></span>
    
            <div id="product-features">
                <ul id="features-list"></ul>
            </div>
    
            <button class="custom-btn" id="addToCartButton">Add to Cart</button>
            <p class="cart-message"></p>

        </section>
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