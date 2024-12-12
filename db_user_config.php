<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Wags";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SHOW DATABASES LIKE '$dbname'");
    if ($stmt->rowCount() === 0) {
        $conn->exec("CREATE DATABASE $dbname");
    }
    $conn->exec("USE $dbname");

    $stmt = $conn->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() === 0) {
        $conn->exec("
            CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                billing_address_line_1 VARCHAR(255) DEFAULT NULL,
                billing_address_line_2 VARCHAR(255) DEFAULT NULL,
                billing_city VARCHAR(255) DEFAULT NULL,
                billing_province VARCHAR(255) DEFAULT NULL,
                billing_zip_code VARCHAR(10) DEFAULT NULL,
                billing_mobile_phone VARCHAR(20) DEFAULT NULL,
                shipping_address_line_1 VARCHAR(255) DEFAULT NULL,
                shipping_address_line_2 VARCHAR(255) DEFAULT NULL,
                shipping_city VARCHAR(255) DEFAULT NULL,
                shipping_province VARCHAR(255) DEFAULT NULL,
                shipping_zip_code VARCHAR(10) DEFAULT NULL,
                shipping_mobile_phone VARCHAR(20) DEFAULT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");
    } else {
        $columns = [
            'billing_address_line_1', 'billing_address_line_2', 'billing_city', 'billing_province',
            'billing_zip_code', 'billing_mobile_phone', 'shipping_address_line_1', 'shipping_address_line_2',
            'shipping_city', 'shipping_province', 'shipping_zip_code', 'shipping_mobile_phone'
        ];
        foreach ($columns as $column) {
            $stmt = $conn->query("SHOW COLUMNS FROM users LIKE '$column'");
            if ($stmt->rowCount() === 0) {
                $conn->exec("ALTER TABLE users ADD COLUMN $column VARCHAR(255) DEFAULT NULL");
            }
        }
    }
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}
?>
