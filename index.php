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
    <?php 
    $page_title = "Home";
    $active_page = "home";
    include 'shared/header.php'; ?>

    <main class="fade-in pet-shop-section">
        <section class="hero-section">
            <div class="container">
                <div class="row hero-content">
                    <div class="col-md-6">
                        <img src="images/wagsandwhiskerslogo1.png" alt="Logo" class="hero-image" loading="lazy">
                    </div>
                    <div class="col-md-6 hero-text">
                        <h1 class="hero-title">Your One-Stop Shop for All Things Pets!</h1>
                        <p class="hero-description">Whether you're looking for nutritious food, fun toys, or comfy bedding, we've got you covered.</p>
                        <a href="products.php" class="cta-button btn">Shop Now</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Why Choose Us Section -->
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
        <!-- Contact Section -->
        <section class="fade-in contact-section">
            <div class="contact-content">
                <div class="contact-info">
                    <h2 class="contact-title">Have a Question?</h2>
                    <p class="contact-description">Contact us at 251-678-345 or fill out our contact form.</p>
                    <a href="contact.php" class="cta-button">Contact Us</a>
                </div>
                <div class="contact-image-container">
                    <img src="images/general/upsidedowncat.jpg" alt="Cat" class="contact-image" loading="lazy">
                </div>
            </div>
        </section>
        <!-- Top Deals Section
        <section class="fade-in deals-container">
            <h1 class="deals-title">Top Deals</h1>
            <div class="deals">
                Cat Food Deal
                <div class="deal">
                    <h2>25% off<br>Cat Food</h2>
                    <button>Shop Now</button>
                    <img src="images/products/catfood.png" alt="A bowl of cat food">
                </div>
                Cat Toys Deal
                <div class="deal">
                    <h2>10% off<br>Cat Toys</h2>
                    <button>Shop Now</button>
                    <img src="images/products/cattoy.png" alt="Cat toys">
                </div>
                Dog Treats Deal -->
                <!-- <div class="deal">
                    <h2>15% off<br>Dog Treats</h2>
                    <button>Shop Now</button>
                    <img src="images/products/dogtreat.png" alt="Dog treats">
                </div>
            </div> -->
        </section>
    </main>

    <?php include 'shared/footer.php'; ?>

    <script src="js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
