<?php
$current_page = basename(__FILE__);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Wags &amp; Whiskers</title>
    <link rel="icon" type="image/x-icon" href="/images/wandw-favicon.svg">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- Custom CSS -->
    <link href="css/products.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/fadein.css" rel="stylesheet">

    <!-- Custom JS -->
    <script src="js/products.js" defer></script>
    <script src="js/fadein.js" defer></script>
</head>

<body>
    <?php
        $current_page = basename(__FILE__);
        include 'shared/header.php';
    ?>

    <main>
        <br>
        <!-- Hero Section -->
        <section id="hero" class="fade-in d-flex align-items-center">
            <div class="container hero-container text-center position-relative">
                <h1>Products</h1>
            </div>
        </section>

        <!-- Filter Section -->
        <div class="filter-container">
            <input type="text" id="search" placeholder="Search products...">
            <select id="sort-price">
                <option value="">Sort by Price</option>
                <option value="asc">Low to High</option>
                <option value="desc">High to Low</option>
            </select>
            <div>
                <label for="sort-category">Sort by Category:</label>
                <select id="sort-category">
                    <option value="">All</option>
                    <option value="Dog">Dog</option>
                    <option value="Cat">Cat</option>
                    <option value="Other">Other</option>
                </select>
            </div>
        </div>

        <div id="product-container"></div>
        <button id="see-more-btn" style="">See More</button>

        <!-- Overlay -->
        <div id="productOverlay">
            <div id="productOverlayContent">
                <button id="closebutton">Close</button>
                <img id="overlayImage" alt="Product Image">
                <h3 id="overlayTitle"></h3>
                <p id="overlayDescription"></p>
                <p id="overlayPrice"></p>
                <ul id="overlayFeatures"></ul>
                <div class="button-container">
                    <input id="overlayQuantity" type="number" min="1" value="1">
                    <button id="addToCartOverlay">Add to Cart</button>
                    <!-- <button id="viewFullProduct">View Full Product</button> -->
                </div>
                <p class="cart-message"></p>
            </div>
        </div>
    </main>

    <?php include 'shared/footer.php'; ?>
</body>

</html>
