<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user_name'])) {
    error_log("User is not logged in.");
    die("User is not logged in.");
}

require 'db_user_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = $_SESSION['user_name'];
    $billingAddress1 = isset($_POST['billing_address_line_1']) ? trim($_POST['billing_address_line_1']) : '';
    $billingAddress2 = isset($_POST['billing_address_line_2']) ? trim($_POST['billing_address_line_2']) : '';
    $billingCity = isset($_POST['billing_city']) ? trim($_POST['billing_city']) : '';
    $billingProvince = isset($_POST['billing_province']) ? trim($_POST['billing_province']) : '';
    $billingZipCode = isset($_POST['billing_zip_code']) ? trim($_POST['billing_zip_code']) : '';
    $billingMobilePhone = isset($_POST['billing_mobile_phone']) ? trim($_POST['billing_mobile_phone']) : '';

    $useSameAddress = isset($_POST['use_same_address']) && $_POST['use_same_address'] === "on";

    if ($useSameAddress) {
        $shippingAddress1 = $billingAddress1;
        $shippingAddress2 = $billingAddress2;
        $shippingCity = $billingCity;
        $shippingProvince = $billingProvince;
        $shippingZipCode = $billingZipCode;
        $shippingMobilePhone = $billingMobilePhone;
    } else {
        $shippingAddress1 = isset($_POST['shipping_address_line_1']) ? trim($_POST['shipping_address_line_1']) : '';
        $shippingAddress2 = isset($_POST['shipping_address_line_2']) ? trim($_POST['shipping_address_line_2']) : '';
        $shippingCity = isset($_POST['shipping_city']) ? trim($_POST['shipping_city']) : '';
        $shippingProvince = isset($_POST['shipping_province']) ? trim($_POST['shipping_province']) : '';
        $shippingZipCode = isset($_POST['shipping_zip_code']) ? trim($_POST['shipping_zip_code']) : '';
        $shippingMobilePhone = isset($_POST['shipping_mobile_phone']) ? trim($_POST['shipping_mobile_phone']) : '';
    }

    error_log("User Name: $userName");
    error_log("Billing Address 1: $billingAddress1");
    error_log("Billing Address 2: $billingAddress2");
    error_log("Billing City: $billingCity");
    error_log("Billing Province: $billingProvince");
    error_log("Billing Zip Code: $billingZipCode");
    error_log("Billing Mobile Phone: $billingMobilePhone");

    if ($useSameAddress) {
        error_log("Using same address for shipping.");
    } else {
        error_log("Shipping Address 1: $shippingAddress1");
        error_log("Shipping Address 2: $shippingAddress2");
        error_log("Shipping City: $shippingCity");
        error_log("Shipping Province: $shippingProvince");
        error_log("Shipping Zip Code: $shippingZipCode");
        error_log("Shipping Mobile Phone: $shippingMobilePhone");
    }

    try {
        $stmt = $conn->prepare("
            UPDATE users SET 
                billing_address_line_1 = :billingAddress1,
                billing_address_line_2 = :billingAddress2,
                billing_city = :billingCity,
                billing_province = :billingProvince,
                billing_zip_code = :billingZipCode,
                billing_mobile_phone = :billingMobilePhone,
                shipping_address_line_1 = :shippingAddress1,
                shipping_address_line_2 = :shippingAddress2,
                shipping_city = :shippingCity,
                shipping_province = :shippingProvince,
                shipping_zip_code = :shippingZipCode,
                shipping_mobile_phone = :shippingMobilePhone
            WHERE name = :userName
        ");
        $stmt->execute([
            'billingAddress1' => $billingAddress1,
            'billingAddress2' => $billingAddress2,
            'billingCity' => $billingCity,
            'billingProvince' => $billingProvince,
            'billingZipCode' => $billingZipCode,
            'billingMobilePhone' => $billingMobilePhone,
            'shippingAddress1' => $shippingAddress1,
            'shippingAddress2' => $shippingAddress2,
            'shippingCity' => $shippingCity,
            'shippingProvince' => $shippingProvince,
            'shippingZipCode' => $shippingZipCode,
            'shippingMobilePhone' => $shippingMobilePhone,
            'userName' => $userName
        ]);

        error_log("User information updated successfully.");
    } catch (PDOException $e) {
        error_log("Error updating user information: " . $e->getMessage());
        die("Error updating user information.");
    }
}
?>
