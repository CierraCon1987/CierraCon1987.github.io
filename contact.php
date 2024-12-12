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

    <!-- EmailJS SDK -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script type="text/javascript">
        (function () {
            emailjs.init("QN6ZWMxgzovaNwPuL"); // Tu clave pública de EmailJS
        })();
    </script>

    <!-- Custom JS -->
    <script src="js/header.js" defer></script>
    <script src="js/fadein.js" defer></script>
    <script src="js/contact.js" defer></script>
</head>

<body>
    <?php
        $current_page = basename(__FILE__);
        include 'shared/header.php';
    ?>

    <main>
        <section class="fade-in contact-us">
            <h1>Contact Us</h1>
            <p>We're here to help! Whether you have a question about your order,
                need advice on the best products for your furry friend,
                or just want to say hello, we'd love to hear from you!
                Our dedicated team of pet lovers is always ready to assist.</p>

            <div class="fade-in contact-grid">
                <div class="contact-image">
                    <img src="images/wandw-storefront.webp" alt="Wags & Whiskers Store">
                </div>

                <div class="contact-form">
                    <h2>Reach Out</h2><br>
                    <p>How can we help you? Feel free to reach out to us through
                        the contact form below or visit our store for all your
                        pet care needs. You can also connect with us on social media or give us a call.
                        We're committed to making sure you and your pets are happy and well taken care of.</p><br>
                    <form novalidate>
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" required>
                        <span class="error-message" id="nameError"></span>

                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" placeholder="519-555-5555" required>
                        <span class="error-message" id="phoneError"></span>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="youremail@email.com" required>
                        <span class="error-message" id="emailError"></span>

                        <label for="topic">Topic:</label>
                        <select id="topic" name="topic" required>
                            <option value="Select an option">Select an option</option>
                            <option value="Custom Order">Custom Order</option>
                            <option value="Billing/Shipping/Account">Billing/Shipping/Account</option>
                            <option value="General Question">General Question</option>
                            <option value="Other">Other</option>
                        </select>
                        <span class="error-message" id="topicError"></span>

                        <div id="customTopicContainer" style="display: none;">
                            <label for="customTopic">Please specify:</label>
                            <input type="text" id="customTopic" name="customTopic">
                            <span class="error-message" id="customTopicError"></span>
                        </div>

                        <label for="message">Message:</label>
                        <textarea id="message" name="message" required></textarea>
                        <span class="error-message" id="messageError"></span>

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>

        <div class="fade-in contact-lower">
            <div class="address-statement">
                <p>We're proud to serve <strong>Kitchener, Ontario</strong>.
                    Feel free to come down and visit us at <strong>123 King St.</strong>
                </p>
            </div>

            <div class="support-hours">
                <h3>Customer Support Hours:</h3>
                <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                <p>Saturday: 10:00 AM - 4:00 PM</p>
                <p>Sunday: Closed</p>
                <p>We strive to respond to all inquiries within 24 hours.</p>
            </div>
        </div>

        <div class="fade-in contact-map">
            <iframe src="https://maps.google.com/maps?q=123%20King%20St%20Kitchener&t=&z=13&ie=UTF8&iwloc=&output=embed"
                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

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
                    <li><img src="images/general/paw-icon-trans.png"> Expert advice on pet care, training, and nutrition</li>
                    <li><img src="images/general/paw-icon-trans.png"> Heartwarming stories and adorable pet features</li>
                </ul>
            </div>

            <h2 class="newsletter-header">Stay Connected with Wags &amp; Whiskers!</h2>
            <form class="newsletter-signup" novalidate>
                <label for="newsletterEmail">Subscribe to our newsletter today and never miss out on the latest from Wags &amp; Whiskers!</label>
                <div class="input-button-wrapper">
                    <input type="email" id="newsletterEmail" name="newsletterEmail" placeholder="Enter your email" required>
                    <button type="submit">Subscribe</button>
                </div>
                <span class="error-message" id="newsletterEmailError"></span>
            </form>
        </section>
    </main>

    <?php include 'shared/footer.php'; ?>
</body>

</html>
