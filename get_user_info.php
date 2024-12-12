<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user_name'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

require 'db_user_config.php';

try {
    $userName = $_SESSION['user_name'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = :name");
    $stmt->execute(['name' => $userName]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
