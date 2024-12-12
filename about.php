<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Wags &amp; Whiskers</title>
    <link rel="icon" type="image/x-icon" href="/images/wandw-favicon.svg">
    
    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
 
    <!-- Custom CSS -->
    <link href="css/about.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/fadein.css" rel="stylesheet">

    <!-- Custom JS -->
    <script src="js/header.js" defer></script>
    <script src="js/fadein.js" defer></script>
</head>

<body>
    <?php
        $current_page = basename(__FILE__);
        include 'shared/header.php';
    ?>

    <main>
        <!-- About Us Section -->
        <section class="fade-in about-us-section">
            <div class="container">
                <section class="row align-items-center mission-section">
                    <div class="col-md-6 mission-text">
                        <h2 class="mission-title">Founded in 2010, Wags & Whiskers started with a simple mission:</h2>
                        <p class="mission-description">Create a place where pet owners could find everything they need to give their pets a healthy and happy life.</p>
                    </div>
                    <div class="col-md-6">
                        <img src="images/general/dog and cat.jpg" alt="Wags & Whiskers store front" class="mission-image img-fluid">
                    </div>
                </section>
                <!-- The Team -->
                <h2 class="fade-in team-section-title">Meet the Team</h2>
                <section class="row team-members">
                    <article class="col-md-4 team-member">
                        <img src="images/general/man.jpg" alt="Mike Smith" class="team-member-image img-fluid rounded-circle">
                        <h3 class="team-member-name">Mike Smith <span class="team-member-title">Store Manager</span></h3>
                    </article>

                    <article class="col-md-4 team-member">
                        <img src="images/general/jessica.jpg" alt="Jessica Harper" class="team-member-image img-fluid rounded-circle">
                        <h3 class="team-member-name">Jessica Harper <span class="team-member-title">Owner</span></h3>
                    </article>

                    <article class="col-md-4 team-member">
                        <img src="images/general/avery.jpg" alt="Avery Quinn" class="team-member-image img-fluid rounded-circle">
                        <h3 class="team-member-name">Avery Quinn <span class="team-member-title">Product Specialist</span></h3>
                    </article>
                </section>
                <!-- Store Description -->
                <section class="fade-in row about-store mt-4">
                    <div class="col-md-6 store-text">
                        <p class="store-description">
                            Over the years, <strong>Wags & Whiskers</strong> has grown from a small local shop to a trusted name in the pet care community.
                            We're proud to serve <strong>Kitchener, Ontario</strong>. Feel free to come down and visit us at <strong>123 King St.</strong>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img src="images/general/map.png" alt="Store Image" class="store-image img-fluid">
                    </div>
                </section>
            </div>
        </section>
    </main>

    <?php include 'shared/footer.php'; ?>

    <script src="js/about.js"></script>
</body>

</html>
