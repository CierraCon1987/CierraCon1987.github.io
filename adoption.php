<?php
// Include any required PHP configurations or start a session if needed
// Example: session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Wags &amp; Whiskers</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/CierraCon1987.github.io/images/wandw-favicon.svg">

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/adoption.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/fadein.css" rel="stylesheet">

    <!-- Custom JS -->
   <script src="js/header.js" defer></script>
    <script src="js/fadein.js" defer></script> 
    <script src="js/adoption.js" defer></script>
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
                        <li><a href="adoption.php">Adoption</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="articles.html">Articals</a></li>
                        <li class="login-signup">
                            <a href="login.php">Login</a>
                            <a href="register.php" class="active">Sign Up</a>
                        </li>
                        <li class="cart-icon">
                            <a href="cart.html"><img
                                    src="http://localhost/CierraCon1987.github.io/images/general/shopping_cart_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png"
                                    alt="Cart" style="width: 24px; height: 24px;"></a>
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
        <div class="fade-in adoption-container">
            <!-- Search Section -->
            <div class="search-section">
                <h1>Search Rescued Pet in Your Area</h1>
                <div class="search-bar">
                    <label for="location-select" class="sr-only">Select Location</label>
                    <select id="location-select" class="search-input">
                        <option value="" disabled selected>Location</option>
                        <option value="Kitchener">Kitchener, ON</option>
                        <option value="Waterloo">Waterloo, ON</option>
                        <option value="Cambridge">Cambridge, ON</option>
                    </select>
                    <span style="color: whitesmoke;">or</span>
                    <label for="rescue-name" class="sr-only">Enter Rescue Name</label>
                    <input id="rescue-name" type="text" class="search-input" placeholder="Rescue Name">
                    <button class="search-button" aria-label="Search for Rescued Pets">Search</button>
                </div>
            </div>

            <!-- Cards Section -->
            <div class="fade-in cards-wrapper">
                <?php
                // Define an array with rescued pet information
                $rescues = [
                    [
                        'name' => 'DORSET RESCUE KITTENS',
                        'location' => 'Kitchener',
                        'email' => 'dorsetrescuekittens@hotmail.com',
                        'image' => 'images/other logo/dorset.jpeg',
                        'link' => 'https://www.dorsetrescuekittens.ca/kitten-application'
                    ],
                    [
                        'name' => 'GRAND RIVER ANIMAL RESCUE',
                        'location' => 'Kitchener',
                        'email' => 'grandriverrescue@hotmail.com',
                        'image' => 'images/other logo/grand.jpeg',
                        'link' => 'https://www.grandriverallbreedrescue.ca/'
                    ],
                    [
                        'name' => 'HOBO HEAVEN RESCUE',
                        'location' => 'Cambridge',
                        'email' => 'hoboheavenrescue.ca',
                        'image' => 'images/other logo/hobo.jpeg',
                        'link' => 'https://hobohavenrescue.ca/current-dogs'
                    ],
                    [
                        'name' => 'TORONTO CAT RESCUE',
                        'location' => 'Waterloo',
                        'email' => 'info@torontocatrescue.ca',
                        'image' => 'images/other logo/TCR.png',
                        'link' => 'https://www.torontocatrescue.ca/adopt-a-cat'
                    ],
                    [
                        'name' => 'GOLDEN RESCUE',
                        'location' => 'Cambridge',
                        'email' => 'info@torontocatrescue.ca',
                        'image' => 'images/other logo/golden.png',
                        'link' => 'https://www.goldenrescue.ca/our-goldens/adopt-3/'
                    ],
                    [
                        'name' => 'BOOSTEN RESCUE',
                        'location' => 'Waterloo',
                        'email' => '1-833-287-2364',
                        'image' => 'images/other logo/boostan.jpeg',
                        'link' => 'https://bostonterrierrescuecanada.com/adoptable-dogs/'
                    ],
                    [
                        'name' => 'DOG TALES',
                        'location' => 'Kitchener',
                        'email' => 'info@dogtales.ca',
                        'image' => 'images/other logo/dogtales.jpg',
                        'link' => 'https://www.dogtales.ca/'
                    ],
                    [
                        'name' => 'FULL CIRCLE RESCUE',
                        'location' => 'Kitchener',
                        'email' => '473-657-8999',
                        'image' => 'images/other logo/polish.png',
                        'link' => 'https://fullcirclerescue.ca/so-you-want-to-adopt/'
                    ]
                ];
                
                // Loop through the rescues array and render each card dynamically
                foreach ($rescues as $rescue) {
                    echo "
                    <div class='rescue-card'>
                        <div class='weblogo'>
                            <img src='{$rescue['image']}' alt='{$rescue['name']}'>
                        </div>
                        <div class='rescue-details'>
                            <h3>{$rescue['name']}</h3>
                            <p><span class='icon'><i class='fas fa-home'></i></span>{$rescue['location']}</p>
                            <p><span class='icon'><i class='fas fa-envelope'></i></span>{$rescue['email']}</p>
                        </div>
                        <a href='{$rescue['link']}' target='_blank' class='view-pet'>View Pet</a>
                    </div>";
                }
                ?>
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
                    <li><a href="adoption.php">Adoption</a></li>
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
