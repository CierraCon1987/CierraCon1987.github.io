<?php
require_once 'database_connection.php'; // Make sure to connect to your database

$user_id = 1; // Example user ID; in practice, retrieve the logged-in user’s ID.
$total_amount = 79.96; // Replace with the actual total calculated from cart items.

// Create a new order
$order_stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
$order_stmt->execute([$user_id, $total_amount]);
$order_id = $pdo->lastInsertId();

// Insert Billing Address
$billing_stmt = $pdo->prepare("INSERT INTO billing_addresses (order_id, name, address, city, zip_code, country) VALUES (?, ?, ?, ?, ?, ?)");
$billing_stmt->execute([$order_id, $data['billing_name'], $data['billing_address'], $data['billing_city'], $data['billing_zip'], 'Country']);

// Insert Shipping Address
$shipping_stmt = $pdo->prepare("INSERT INTO shipping_addresses (order_id, name, address, city, zip_code, country) VALUES (?, ?, ?, ?, ?, ?)");
$shipping_stmt->execute([$order_id, $data['shipping_name'], $data['shipping_address'], $data['shipping_city'], $data['shipping_zip'], 'Country']);

?>


