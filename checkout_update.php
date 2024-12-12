<?php
session_start();
require 'db_user_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("User is not logged in.");
    }

    $userId = $_SESSION['user_id'];
    $billingAddress1 = trim($_POST['billing_address_line_1']);
    $billingAddress2 = trim($_POST['billing_address_line_2']);
    $billingCity = trim($_POST['billing_city']);
    $billingProvince = trim($_POST['billing_province']);
    $billingZipCode = trim($_POST['billing_zip_code']);
    $billingMobilePhone = trim($_POST['billing_mobile_phone']);
    $useSameAddress = isset($_POST['use_same_address']);

    if ($useSameAddress) {
        $shippingAddress1 = $billingAddress1;
        $shippingAddress2 = $billingAddress2;
        $shippingCity = $billingCity;
        $shippingProvince = $billingProvince;
        $shippingZipCode = $billingZipCode;
        $shippingMobilePhone = $billingMobilePhone;
    } else {
        $shippingAddress1 = trim($_POST['shipping_address_line_1']);
        $shippingAddress2 = trim($_POST['shipping_address_line_2']);
        $shippingCity = trim($_POST['shipping_city']);
        $shippingProvince = trim($_POST['shipping_province']);
        $shippingZipCode = trim($_POST['shipping_zip_code']);
        $shippingMobilePhone = trim($_POST['shipping_mobile_phone']);
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
            WHERE id = :userId
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
            'userId' => $userId
        ]);

        header('Location: confirmation.php');
        exit;
    } catch (PDOException $e) {
        die("Error updating user information: " . $e->getMessage());
    }
}
?>
