<?php include 'shared/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link href="css/header.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }
        .success-message {
            text-align: center;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px #01a089;
            border:2px solid #ff6347;
            max-width: 400px;
            width: 90%;
            margin: 50px auto 0; 
        }
        .success-icon i {
            font-size: 80px;
            color: #f47c6b;
            animation: scaleUp 0.5s ease-in-out;
        }
        .success-message h1 {
            color: #4CAF50;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .success-message p {
            font-weight: 400;
            color: #555;
        }
        .redirect-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        .redirect-button:hover {
            background: #388E3C;
        }
        .progress-bar {
            width: 100%;
            background: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 20px;
        }
        .progress-bar span {
            display: block;
            height: 10px;
            width: 0;
            background: #4CAF50;
            animation: progress 5s linear forwards;
        }
        @keyframes progress {
            to {
                width: 100%;
            }
        }
        @keyframes scaleUp {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }
        .faq-contact {
            margin-top: 30px;
            text-align: center;
        }
        .faq-contact h3 {
            color: #4CAF50;
            margin-bottom: 10px;
        }
        .faq-contact p {
            font-weight: 400;
            color: #555;
        }
        .faq-contact a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: 500;
        }
        .faq-contact a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .success-message {
                padding: 20px;
            }
        }
    </style>
    <script>
        if (typeof Storage !== 'undefined') {
            const cartKey = localStorage.getItem('currentUser') ? `cart_${localStorage.getItem('currentUser')}` : 'cart_guest';
            localStorage.removeItem(cartKey);
        }

        // Redirect to index page after 5 seconds
       /* setTimeout(function() {
            window.location.href = "index.php";
        }, 10000);*/
    </script>
</head>
<body>
    <div class="success-message">
        <div class="success-icon">
        <i class="fas fa-check-circle"></i> 
        </div>
        <h1>Payment Successful!</h1>
        <p>Thank you for your purchase. You will be redirected shortly.</p>
        <div class="progress-bar">
            <span></span>
        </div>
        <a href="index.php" class="redirect-button">Go to Home</a>
    </div>

    <!-- FAQ Section -->
    <div class="faq-contact">
        <h3>Need Help?</h3>
        <p>If you have any questions or issues, please <a href="contact.php">contact us</a>.</p>
    </div>
</body>
</html>
<?php include 'shared/footer.php'; ?>
