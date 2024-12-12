<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db_user_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } elseif ($password !== $confirmPassword) {
        $error_message = "Passwords do not match.";
    } else {
        try {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $userExists = $stmt->fetchColumn() > 0;

            if ($userExists) {
                $error_message = "Email is already registered.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
                $stmt->execute([
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashedPassword
                ]);

                $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                $_SESSION['user_name'] = $user['name'];
                header('Location: index.php');
                exit;
            }
        } catch (PDOException $e) {
            $error_message = "Registration failed. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Wags & Whiskers</title>
    <link rel="icon" type="image/x-icon" href="images/wandw-favicon.svg">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/register.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/fadein.css" rel="stylesheet">
    <script src="js/header.js" defer></script>
    <script src="js/fadein.js" defer></script>
</head>

<body>
    <?php include 'shared/header.php'; ?>

    <main>
        <div class="fade-in register-container">
            <h2 class="welcome-title">Welcome</h2>
            <img src="images/wandw-logo-large.svg" alt="Pet Image" class="pet-image">
            <h3 class="thank-you-text">Thank You for Joining <br> WAGS & WHISKERS Family</h3>
            <h4 class="signup-header">Sign Up</h4>

            <form id="registerForm" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm your password" required>
                </div>
                <?php if (!empty($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
                <button type="submit" class="create-account-btn">Create Account</button>
            </form>

            <div class="login-link">
                <p>Already have an account? <a href="login-register.php">Login</a></p>
            </div>
        </div>
    </main>

    <?php include 'shared/footer.php'; ?>
</body>

</html>
