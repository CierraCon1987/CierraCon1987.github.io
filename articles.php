<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles | Wags &amp; Whiskers</title>
    <link rel="icon" type="image/x-icon" href="/images/wandw-favicon.svg">

    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/articles.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="css/fadein.css" rel="stylesheet">

    <!-- Custom JS -->
    <script src="js/header.js" defer></script>
    <script src="js/fadein.js" defer></script>
    <script src="js/articles.js" defer></script>
</head>

<body>
    <?php
        $current_page = basename(__FILE__);
        include 'shared/header.php';
    ?>

    <main class="container-fluid">
        <div class="row">
            <div class="fade-in col-md-8">
                <div class="blog-post">
                    <img loading="lazy" src="images/snoopy.jpg" alt="Snoopy Adoption Story">
                    <h2><a href="https://kitchener.ctvnews.ca/dog-finds-new-home-after-spending-276-days-with-kw-humane-society-1.6916177" target="_blank">Dog finds new home after spending 276 days with KW Humane Society!</a></h2>
                    <time>03/10/2024</time>
                    <p>A heartwarming story about Snoopy finally finding his forever home after many long months of waiting.</p>
                </div>
                <div class="fade-in blog-post">
                    <img loading="lazy" src="images/dogeating.jpg" alt="DIY Pet Treats">
                    <h2><a href="https://itdoesnttastelikechicken.com/easy-homemade-dog-treats/" target="_blank">DIY Pet Treat Recipes Your Pets Will Love</a></h2>
                    <time>02/15/2024</time>
                    <p>Learn how to make healthy, homemade treats for your pets that are both easy and nutritious!</p>
                </div>
                <div class="fade-in blog-post">
                    <img loading="lazy" src="images/catplaying.jpg" alt="New Pet Preparation">
                    <h2><a href="https://www.four-paws.org/our-stories/publications-guides/getting-a-dog?gad_source=1&gclid=Cj0KCQjwvpy5BhDTARIsAHSilym734EkhLOI_buFKF_V7ZayAC18uEKULhTSSMbY2Vw21h-oK4SoFZcaAi9gEALw_wcB" target="_blank">How to Prepare Your Home for a New Puppy or Kitten</a></h2>
                    <time>01/30/2024</time>
                    <p>Step-by-step guide to get your home ready for a new furry friend.</p>
                </div>
            </div>

            <aside class="fade-in col-md-4">
                <div class="staff-picks">
                    <h2>Staff Picks</h2>
                    <div class="staff-pick">
                        <h3><a href="https://www.humanesociety.org/resources/safe-dog-toys" target="_blank">How to Choose the Perfect Toy for Your Pet</a></h3>
                        <time>06/09/2024</time>
                    </div>
                    <div class="staff-pick">
                        <h3><a href="https://westshoretowncentre.com/blog/2024/09/18/5-tips-for-first-time-pet-owners/" target="_blank">5 Essential Tips for New Pet Owners</a></h3>
                        <time>12/08/2024</time>
                    </div>
                    <div class="staff-pick">
                        <h3><a href="https://fuzzydogcollective.com/en-ca/blogs/every-dog-owner-should-know/grooming-101-maintaining-a-shiny-healthy-coat" target="_blank">Grooming 101: How to Keep Your Pet's Coat Healthy and Shiny</a></h3>
                        <time>01/02/2024</time>
                    </div>
                    <div class="staff-pick">
                        <h3><a href="https://www.aafco.org/consumers/understanding-pet-food/selecting-the-right-pet-food/" target="_blank">The Importance of Choosing the Right Pet Food</a></h3>
                        <time>01/09/2024</time>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <?php include 'shared/footer.php'; ?>
</body>

</html>
