<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db_user_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_name'] = $user['name'];
        header('Location: index.php');
        exit;
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Wags & Whiskers</title>
    <link rel="icon" type="image/x-icon" href="images/wandw-favicon.svg">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/fadein.css" rel="stylesheet">
    <script src="js/header.js" defer></script>
    <script src="js/fadein.js" defer></script>
</head>
<body>
    <?php include 'shared/header.php'; ?>

    <main>
        <div class="container">
            <div class="fade-in login-form">
                <h1 class="welcome-text">Welcome Back!</h1>
                <img src="images/wandw-logo-large.svg" alt="Pet Image" class="pet-image">
                <form method="POST">
                    <h2 class="login-header">Login</h2>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                    </div>
                    <div class="form-options">
                        <div class="form-check">
                            <input type="checkbox" id="rememberMe">
                            <label for="rememberMe">Remember me</label>
                        </div>
                    </div>
                    <?php if (!empty($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
                    <button type="submit" class="login-button">Login</button>
                </form>
                <div class="new-user-link">
                    <span>New user?</span> <a href="register.php">Create account</a>
                </div>
            </div>
        </div>
    </main>

    <?php include 'shared/footer.php'; ?>
</body>
</html>
