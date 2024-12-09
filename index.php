<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Wags &amp; Whiskers</title>
    <link rel="icon" type="image/x-icon" href="/images/wandw-favicon.svg">

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/index.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/fadein.css" rel="stylesheet">

    <!-- Custom JS -->
    <script src="js/header.js" defer></script>
    <script src="js/fadein.js" defer></script>

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
                        <li><a href="index.html" class="active">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="products.html">Products</a></li>
                        <li><a href="adoption.php">Adoption</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="articles.html">Articles</a></li>
                        <li class="login-signup">
                            <a href="login.php">Login</a>
                            <a href="register.php">Sign Up</a>
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
    <!-- Hero -->
    <main class="fade-in pet-shop-section">
        <section class="hero-section">
            <div class="container">
                <div class="row hero-content">
                    <div class="col-md-6">
                        <img src="images/wagsandwhiskerslogo1.png" alt="Logo" class="hero-image" loading="lazy">
                    </div>
                    <div class="col-md-6 hero-text">
                        <h1 class="hero-title">Your One-Stop Shop for All Things Pets!</h1>
                        <p class="hero-description">Whether you're looking for nutritious food, fun toys, or comfy
                            bedding, we've got you covered.</p>
                        <a href="products.html" class="cta-button btn">Shop Now</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Why Us  -->
        <section class="fade-in why-choose-us-section">
            <div class="why-choose-us-content">
                <div class="why-choose-us-image-container">
                    <img src="images/general/dogs.jpg" alt="Dogs" class="why-choose-us-image" loading="lazy">
                </div>
                <div class="why-choose-us-text">
                    <h2 class="why-choose-us-title">Why Choose Us?</h2>
                    <ul class="why-choose-us-list">
                        <li>Quality Products</li>
                        <li>Expert Advice</li>
                        <li>Affordable Prices</li>
                        <li>Local & Loved</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Have a Question-->
        <section class="fade-in contact-section">
            <div class="contact-content">
                <div class="contact-info">
                    <h2 class="contact-title">Have a Question?</h2>
                    <p class="contact-description">Contact us at 251-678-345 or fill out our contact form.</p>
                    <a href="contact.html" class="cta-button">Contact Us</a>
                </div>
                <div class="contact-image-container">
                    <img src="images/general/upsidedowncat.jpg" alt="cat" class="contact-image" loading="lazy">
                </div>
            </div>
        </section>

        <body>
            <div class="fade-in deals-container">
                <h1 class="deals-title">Top Deals</h1>
                <div class="deals">
                    <!-- Cat Food Deal -->
                    <div class="deal">
                        <h2>25% off<br>Cat Food</h2>
                        <button>Shop Now</button>
                        <img src="images/products/catfood.png" alt="A bowl of cat food">
                    </div>
                    <!-- Cat Toys Deal -->
                    <div class="deal">
                        <h2>10% off<br>Cat Toys</h2>
                        <button>Shop Now</button>
                        <img src="images/products/cattoy.png" alt="Cat toys">
                    </div>
                    <!-- Dog Treats Deal -->
                    <div class="deal">
                        <h2>15% off<br>Dog Treats</h2>
                        <button>Shop Now</button>
                        <img src="images/products/dogtreat.png" alt="Dog treats">
                    </div>
                </div>
            </div>
        </body>

</html>
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
<script src="js/index.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>