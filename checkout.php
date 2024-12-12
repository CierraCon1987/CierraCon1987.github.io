<?php
include 'update_user_info.php';
require __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_total'])) {
    $totalAmount = (int)$_POST['cart_total'];

    if ($totalAmount <= 0) {
        echo "Invalid cart total amount.";
        http_response_code(400);
        exit;
    }

    $stripeSecretKey = 'sk_test_Hrs6SAopgFPF0bZXSN3f6ELN';

    \Stripe\Stripe::setApiKey($stripeSecretKey);

    try {
        $checkout_session = \Stripe\Checkout\Session::create([
            "payment_method_types" => ["card"],
            "mode" => "payment",
            "line_items" => [
                [
                    "quantity" => 1,
                    "price_data" => [
                        "currency" => "usd",
                        "unit_amount" => $totalAmount,
                        "product_data" => [
                            "name" => "Shopping Cart"
                        ]
                    ]
                ]
            ],
            "success_url" => "http://localhost/wags/success.php",
            "cancel_url" => "http://localhost/wags/cart.php"
        ]);

        http_response_code(303);
        header("Location: " . $checkout_session->url);
    } catch (Exception $e) {
        echo "Error creating Stripe Checkout Session: " . $e->getMessage();
        http_response_code(500);
    }
} else {
    echo "Invalid request. Please submit the form correctly.";
    http_response_code(400);
}
