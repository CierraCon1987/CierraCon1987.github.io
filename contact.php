<?php

$host = 'localhost'; 
$db_name = 'wagsandwhiskers'; 
$username = 'root'; 
$password = ''; 

$errors = [];
$emailSent = false;

$name = $phone = $email = $topic = $message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $full_name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $topic = htmlspecialchars($_POST['topic']);
    $message = htmlspecialchars($_POST['message']);

    // Validate form fields
    if (empty($full_name) || empty($phone) || empty($email) || empty($topic) || empty($message)) {
        $errors[] = "Please fill in all required fields.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
        $errors[] = "Invalid phone number format. Use XXX-XXX-XXXX.";
    }

    // Only insert data if no errors
    if (empty($errors)) {
        // Use PHPMailer to send email via SMTP - Code is here but we are just faking it.
        /*$mail = new PHPMailer(true);
        try {
            Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cierra@onpro.com';
            $mail->Password = 'ONPro@2023';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('cierra@onpro.com', 'Contact Form');
            $mail->addAddress('cierra@onpro.com'); 

            // Content
            $mail->isHTML(false);
            $mail->Subject = 'New Contact Form Submission';
            $mail->Body    = "Name: $name\nPhone: $phone\nEmail: $email\nTopic: $topic\nCustom Topic: $customTopic\nMessage: $message";

            $mail->send();
        */

        $emailSent = true; // Simulate email being sent successfully

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'wagsandwhiskers');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to insert data into the contact_submission table
        $sql = "INSERT INTO contact_submissions (full_name, phone, email, topic, message)
                VALUES (?, ?, ?, ?, ?)";

        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $full_name, $phone, $email, $topic, $message);

        if ($stmt->execute()) {
            $emailSent = true;
            $name = $phone = $email = $topic = $message = "";
        } else {
            $errors[] = "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();

    } else {
        // Output errors if any
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | Wags &amp; Whiskers</title>
    <link rel="icon" type="image/x-icon" href="/images/wandw-favicon.svg">

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/contact.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/fadein.css" rel="stylesheet">

    <!-- Custom JS -->
    <script src="js/header.js" defer></script>
    <script src="js/fadein.js" defer></script>

</head>

<body>
    <header class="page-header">
        <video autoplay muted loop id="background-video">
            <source src="http://localhost/CierraCon1987.github.io/images/videos/wandw-header-vid.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="header-content">
            <div class="logo">
                <a href="index.html"><img src="http://localhost/CierraCon1987.github.io/images/wandw-logo-large.svg" alt="logo"></a>
            </div>
            <div id="google_translate_element"></div>
            <div class="link-salute">
                <div class="links">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="products.html">Products</a></li>
                        <li><a href="adoption.html">Adoption</a></li>
                        <li><a href="contact.php" class="active">Contact</a></li>
                        <li><a href="articles.html">Articles</a></li>
                        <li class="login-signup">
                            <a href="login-register.html">Login</a>
                            <a href="register.html">Sign Up</a>
                        </li>
                        <li class="cart-icon">
                            <a href="cart.html">
                                <img src="http://localhost/CierraCon1987.github.io/images/general/shopping_cart_24dp_FFFFFF_FILL0_wght400_GRAD0_opsz24.png"
                                    alt="Cart" style="width: 24px; height: 24px;">
                            </a>
                            <span id="cart-count"
                                style="position: absolute; top: -5px; right: -10px; background-color: red; color: white; font-size: 12px; font-weight: bold; border-radius: 50%; padding: 2px 6px; display: none;">0</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="salute">
            <h3>Welcome to</h3>
            <h1>Wags &amp; Whiskers!</h1>
            <p id="tagline">Caring for Your Pets, One Wag at a Time</p>
        </div>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'en,hi,fr,es,gu,af,zh-CN,ja,pa,ml',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                }, 'google_translate_element');
            }
        </script>
        <script type="text/javascript"
            src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    </header>

    <main>
        <section class="fade-in contact-us">
            <h1>Contact Us</h1>
            <p>We're here to help! Whether you have a question about your order,
                need advice on the best products for your furry friend,
                or just want to say hello, we'd love to hear from you!
                Our dedicated team of pet lovers is always ready to assist.</p>

            <div class="fade-in contact-grid">
                <!-- Left Side: Image -->
                <div class="contact-image">
                    <img src="images/wandw-storefront.webp" alt="Wags & Whiskers Store">
                </div>

                <!-- Right Side: Contact Form -->
                <section class="form-container">
                    <form method="POST" id="contactForm" onsubmit="return validateForm()">
                        <div class="form-field">
                            <label for="name">Full Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
                        </div>

                        <div class="form-field">
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" name="phone" placeholder="555-555-5555" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
                            <span id="phoneError" style="color:red;"></span>
                        </div>

                        <div class="form-field">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="email@email.com" value="<?php echo isset($email) ? $email : ''; ?>" required>
                            <span id="emailError" style="color:red;"></span>
                        </div>

                        <div class="form-field">
                            <label for="topic">Topic:</label>
                            <select id="topic" name="topic" required>
                                <option value="General Inquiry" <?php echo (isset($topic) && $topic == 'General Inquiry') ? 'selected' : ''; ?>>General Inquiry</option>
                                <option value="Custom Order" <?php echo (isset($topic) && $topic == 'Custom Order') ? 'selected' : ''; ?>>Custom Order</option>
                                <option value="Accounting" <?php echo (isset($topic) && $topic == 'Accounting') ? 'selected' : ''; ?>>Accounting</option>
                                <option value="Billing" <?php echo (isset($topic) && $topic == 'Billing') ? 'selected' : ''; ?>>Billing</option>
                                <option value="Other" <?php echo (isset($topic) && $topic == 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label for="message">Message:</label>
                            <textarea id="message" name="message" placeholder="Let us know how we can help!" required><?php echo isset($message) ? $message : ''; ?></textarea>
                        </div>

                        <div class="form-field">
                            <input type="submit" value="Submit">
                        </div>

                        <?php if ($emailSent): ?>
                            <div id="confirmation-message">
                                <h3>Thank You!</h3>
                                <p>Your message has been submitted. Our team will get back to you within 24-48 hours.</p>
                            </div>
                        <?php endif; ?>

                        <?php 
                        if (!empty($errors)) {
                            foreach ($errors as $error) {
                                echo "<p class='error-message'>$error</p>";
                            }
                        }
                        ?>
                    </form>
                </section>
            </div>
                <script>
                    function validateForm() {
                        // Clear previous error messages
                        document.getElementById('phoneError').innerText = '';
                        document.getElementById('emailError').innerText = '';

                        let isValid = true;
                        let phone = document.getElementById('phone').value;
                        let email = document.getElementById('email').value;

                        // Validate phone number
                        let phonePattern = /^\d{3}-\d{3}-\d{4}$/;
                        if (!phone.match(phonePattern)) {
                            document.getElementById('phoneError').innerText = 'Invalid phone number format. Use XXX-XXX-XXXX.';
                            isValid = false;
                        }

                        // Validate email
                        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                        if (!email.match(emailPattern)) {
                            document.getElementById('emailError').innerText = 'Invalid email format.';
                            isValid = false;
                        }

                        return isValid;
                    }
                </script>

                    <div class="fade-in contact-lower">
                        <!-- Left Side: Address -->
                        <div class="address-statement">
                            <p>We're proud to serve <strong>Kitchener, Ontario</strong>. Feel free to come down and visit us at <strong>123 King St.</strong></p>
                        </div>

                        <!-- Right Side: Support Hours -->
                        <div class="support-hours">
                            <h3>Customer Support Hours:</h3>
                            <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                            <p>Saturday: 10:00 AM - 4:00 PM</p>
                            <p>Sunday: Closed</p>
                            <p>We strive to respond to all inquiries within 24 hours.</p>
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="fade-in contact-map">
                        <iframe src="https://maps.google.com/maps?q=123%20King%20St%20Kitchener&t=&z=13&ie=UTF8&iwloc=&output=embed" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>

                    <!-- Newsletter Section -->
                    <section class="fade-in newsletter">
                        <h3>Join Our Pet-Loving Community!</h3>
                        <p>Subscribe to the Wags &amp; Whiskers newsletter and be the first
                            to know about exclusive offers, new products,
                            and helpful pet care tips! Whether you're a proud pet parent or
                            just love animals, we've got exciting content tailored just for you.</p>
                        <div class="sub-list">
                            <h4>What you'll get:</h4>
                            <ul>
                                <li><img src="images/general/paw-icon-trans.png"> Special promotions and discounts</li>
                                <li><img src="images/general/paw-icon-trans.png"> New product launches</li>
                                <li><img src="images/general/paw-icon-trans.png"> Expert advice on pet care, training, and nutrition
                                </li>
                                <li><img src="images/general/paw-icon-trans.png"> Heartwarming stories and adorable pet features
                                </li>

                            </ul>
                        </div>

                        <section class="newsletter">
                            <h2 class="newsletter-header">Stay Connected with Wags &amp; Whiskers!</h2>
                            <form class="newsletter-signup" id="newsletterForm" novalidate>
                                <label for="newsletterEmail">Subscribe to our newsletter today and never miss out on the latest from
                                    Wags &amp; Whiskers!</label>
                                <div class="input-button-wrapper">
                                    <input type="email" id="newsletterEmail" name="newsletterEmail" placeholder="Enter your email" required>
                                    <button type="submit">Subscribe</button>
                                </div>
                            </form>
                            <div id="newsletterMessage"></div>
                        </section>

                            <script>
                                document.getElementById('newsletterForm').addEventListener('submit', function (event) {
                                    event.preventDefault(); // Prevent form from refreshing the page

                                    const emailInput = document.getElementById('newsletterEmail');
                                    const email = emailInput.value.trim();
                                    const messageDiv = document.getElementById('newsletterMessage');

                                    // Clear previous messages
                                    messageDiv.innerHTML = '';

                                    // Basic validation
                                    if (!email) {
                                        messageDiv.innerHTML = '<p style="color: red;">Please enter an email address.</p>';
                                        return;
                                    }

                                    // AJAX request
                                    const formData = new FormData();
                                    formData.append('newsletterEmail', email);

                                    fetch('newsletter_signup.php', {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.text())
                                    .then(data => {
                                        // Display the response message
                                        messageDiv.innerHTML = data;
                                        if (data.includes("Thank you")) {
                                            emailInput.value = ''; 
                                        }
                                    })
                                    .catch(error => {
                                        messageDiv.innerHTML = '<p style="color: red;">An error occurred. Please try again later.</p>';
                                        console.error('Error:', error);
                                    });
                                });
                            </script>

                    </section>
        </section>

    </main>
<footer>
        <div class="link-section">
            <div class="company-info">
                <h2>Social Media</h2>
                <p>
                    Follow us on social media for the latest updates,
                    pet care tips, and exclusive offers! Stay connected with Wags
                    &amp; Whiskers and join our community of pet lovers.
                </p>
                <div class="social-icon">
                    <img src="images/socials/socials-facebook.svg" alt="facebook icon">
                    <img src="images/socials/socials-x.svg" alt="x icon">
                    <img src="images/socials/socials-instagram.svg" alt="instagram icon">
                    <img src="images/socials/socials-pinterest.svg" alt="pinterest icon">
                    <img src="images/socials/socials-youtube.svg" alt="youtube icon">
                    <img src="images/socials/socials-tiktok.svg" alt="tiktok icon">
                    <img src="images/socials/socials-whatsapp.svg" alt="whatsapp icon">
                </div>
            </div>

            <div class="quick-link">
                <h2>Company</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="products.html">Products</a></li>
                    <li><a href="adoption.html">Adoption</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="articles.html">Articles</a></li>
                </ul>
            </div>

            <div class="legal">
                <h2>Legal</h2>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Services</a></li>
                    <li><a href="#">Refunds</a></li>
                    <li><a href="#">Guarantee</a></li>
                    <li><a href="#">Shipping</a></li>
                </ul>
            </div>

            <div class="brand-logo">
                <a href="index.html"><img src="images/wandw-logo-large.svg" alt="logo"></a>
            </div>
        </div>

        <div class="copy-right-section">
            <div class="right-section">
                Copyright &copy; 2024 Wags &amp; Whiskers. All right reserved.
            </div>

            <div class="cookies">
                <a href="#">Cookies Settings</a>
                <a href="#">Cookies Policy</a>
            </div>
        </div>
    </footer>
</body>
</html>
