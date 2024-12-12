<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption | Wags &amp; Whiskers</title>
    <link rel="icon" type="image/x-icon" href="/images/wandw-favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/adoption.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/fadein.css" rel="stylesheet">

    <!-- Custom JS -->
    <script src="js/header.js" defer></script>
    <script src="js/fadein.js" defer></script>
    <script src="js/adoption.js" defer></script>
</head>

<body>
    <?php
        $current_page = basename(__FILE__);
        include 'shared/header.php';
    ?>

    <main>
        <div class="fade-in adoption-container">
            <div class="search-section">
                <h1>Search Rescued Pet in Your Area</h1>
                <div class="search-bar">
                    <label for="location-select" class="sr-only">Select Location</label>
                    <select id="location-select" class="search-input">
                        <option value="" disabled selected>Location</option>
                        <option value="Kitchener">Kitchener, ON</option>
                        <option value="Waterloo">Waterloo, ON</option>
                        <option value="Cambridge">Cambridge, ON</option>
                    </select>
                    <span style="color: whitesmoke;">or</span>
                    <label for="rescue-name" class="sr-only">Enter Rescue Name</label>
                    <input id="rescue-name" type="text" class="search-input" placeholder="Rescue Name">
                    <button class="search-button" aria-label="Search for Rescued Pets">Search</button>
                </div>
            </div>

            <div class="fade-in cards-wrapper">
                <div class="rescue-card">
                    <div class="weblogo">
                        <img src="images/other logo/dorset.jpeg" alt="Dorset Rescue">
                    </div>
                    <div class="rescue-details">
                        <h3>DORSET RESCUE KITTENS</h3>
                        <p><span class="icon"><i class="fas fa-home"></i></span>Kitchener, ON</p>
                        <p><span class="icon"><i class="fas fa-envelope"></i></span>dorsetrescuekittens@hotmail.com</p>
                    </div>
                    <a href="https://www.dorsetrescuekittens.ca/kitten-application" target="_blank" class="view-pet">View Pet</a>
                </div>
                <div class="rescue-card">
                    <div class="weblogo">
                        <img src="images/other logo/grand.jpeg" alt="Grand River Rescue">
                    </div>
                    <div class="rescue-details">
                        <h3>GRAND RIVER ANIMAL RESCUE</h3>
                        <p><span class="icon"><i class="fas fa-home"></i></span> Kitchener, ON</p>
                        <p><span class="icon"><i class="fas fa-envelope"></i></span>grandriverrescue@hotmail.com</p>
                    </div>
                    <a href="https://www.grandriverallbreedrescue.ca/" target="_blank" class="view-pet">View Pet</a>
                </div>
                <div class="rescue-card">
                    <div class="weblogo">
                        <img src="images/other logo/hobo.jpeg" alt="Hobo Heaven Rescue">
                    </div>
                    <div class="rescue-details">
                        <h3>HOBO HEAVEN RESCUE</h3>
                        <p><span class="icon"><i class="fas fa-home"></i></span>Cambridge, ON</p>
                        <p><span class="icon"><i class="fas fa-envelope"></i></span>hoboheavenrescue.ca</p>
                    </div>
                    <a href="https://hobohavenrescue.ca/current-dogs" target="_blank" class="view-pet">View Pet</a>
                </div>
                <div class="rescue-card">
                    <div class="weblogo">
                        <img src="images/other logo/TCR.png" alt="Toronto Cat Rescue">
                    </div>
                    <div class="rescue-details">
                        <h3>TORONTO CAT RESCUE</h3>
                        <p><span class="icon"><i class="fas fa-home"></i></span>Waterloo, ON</p>
                        <p><span class="icon"><i class="fas fa-envelope"></i></span>info@torontocatrescue.ca</p>
                    </div>
                    <a href="https://www.torontocatrescue.ca/adopt-a-cat" target="_blank" class="view-pet">View Pet</a>
                </div>
                <div class="rescue-card">
                    <div class="weblogo">
                        <img src="images/other logo/golden.png" alt="Golden Rescue">
                    </div>
                    <div class="rescue-details">
                        <h3>GOLDEN RESCUE</h3>
                        <p><span class="icon"><i class="fas fa-home"></i></span>Cambridge, ON</p>
                        <p><span class="icon"><i class="fas fa-envelope"></i></span>info@goldenrescue.ca</p>
                    </div>
                    <a href="https://www.goldenrescue.ca/our-goldens/adopt-3/" target="_blank" class="view-pet">View Pet</a>
                </div>
                <div class="rescue-card">
                    <div class="weblogo">
                        <img src="images/other logo/boostan.jpeg" alt="Boosten Rescue">
                    </div>
                    <div class="rescue-details">
                        <h3>BOOSTEN RESCUE</h3>
                        <p><span class="icon"><i class="fas fa-home"></i></span>Waterloo, ON</p>
                        <p><span class="icon"><i class="fas fa-phone-alt"></i></span>1-833-287-2364</p>
                    </div>
                    <a href="https://bostonterrierrescuecanada.com/adoptable-dogs/" target="_blank" class="view-pet">View Pet</a>
                </div>
                <div class="rescue-card">
                    <div class="weblogo">
                        <img src="images/other logo/dogtales.jpg" alt="Dog Tales">
                    </div>
                    <div class="rescue-details">
                        <h3>DOG TALES</h3>
                        <p><span class="icon"><i class="fas fa-home"></i></span>Kitchener, ON</p>
                        <p><span class="icon"><i class="fas fa-envelope"></i></span>info@dogtales.ca</p>
                    </div>
                    <a href="https://www.dogtales.ca/" target="_blank" class="view-pet">View Pet</a>
                </div>
                <div class="rescue-card">
                    <div class="weblogo">
                        <img src="images/other logo/Polish.png" alt="Full Circle Rescue">
                    </div>
                    <div class="rescue-details">
                        <h3>FULL CIRCLE RESCUE</h3>
                        <p><span class="icon"><i class="fas fa-home"></i></span>Kitchener, ON</p>
                        <p><span class="icon"><i class="fas fa-phone-alt"></i></span>473-657-8999</p>
                    </div>
                    <a href="https://fullcirclerescue.ca/so-you-want-to-adopt/" target="_blank" class="view-pet">View Pet</a>
                </div>
            </div>
        </div>
    </main>

    <?php include 'shared/footer.php'; ?>
</body>

</html>
