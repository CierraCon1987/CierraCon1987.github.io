<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Wags & Whiskers</title>
    <link rel="icon" type="image/x-icon" href="images/wandw-favicon.svg">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
</head>
<body>
    <?php
        $current_page = basename(__FILE__);
        include 'shared/header.php';
    ?>

    <main>
        <a href="products.php"><button id="backToProductsBtn">Back to Products</button></a>
        <section class="cart-container">
            <h1>Your Shopping Cart</h1>
            <div id="cart-items"></div>
            <div class="cart-summary">
        </div>
        </section>
    </main>
    <?php include 'shared/footer.php'; ?>
    <script src="js/cart2.js" defer></script>
</body>
</html>
