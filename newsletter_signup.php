<?php
$host = 'localhost';
$db_name = 'wagsandwhiskers';
$username = 'root';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(trim($_POST['newsletterEmail']));

    // Validate email
    if (empty($email)) {
        echo "<p style='color: red;'>Please enter an email address.</p>";
        exit;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p style='color: red;'>Invalid email format.</p>";
        exit;
    }

    // Database connection
    $conn = new mysqli($host, $username, $password, $db_name);
    if ($conn->connect_error) {
        echo "<p style='color: red;'>Database connection failed.</p>";
        exit;
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO newsletter_subscriptions (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "<p style='color: green; text-align: center;'>Thank you for subscribing to our newsletter!</p>";
    } else {
        if ($conn->errno === 1062) { // Duplicate email
            echo "<p style='color: red; text-align: center;'>This email is already subscribed.</p>";
        } else {
            echo "<p style='color: red; text-align: center;'>An error occurred. Please try again later.</p>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
