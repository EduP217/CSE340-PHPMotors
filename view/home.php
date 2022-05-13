<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - PHP Motors</title>

    <link rel="stylesheet" href="css/style.css" media="screen">
    <link rel="stylesheet" href="css/large.css" media="screen">
</head>

<body>
    <header>
        <?php include 'snippets/header.php'; ?>
    </header>
    <nav class="header-navigation">
        <?php echo $navList; ?>
    </nav>
    <main>
        <div class="home-container">
            <h1 class="heading-title">Welcome to PHP Motors!</h1>
            <div class="image-banner">
                <img src="images/delorean.jpg" alt="banner">
                <div class="banner-spotlight">
                    <h2>DMC Delorean</h2>
                    <p>
                        3 cup holders<br>
                        Superman doors<br>
                        Fuzzy dice!<br>
                    </p>
                </div>
                <button type="button">Own Today</button>
            </div>
            <div class="car-details">
                <div class="reviews">
                    <h2 class="heading-title">DMC Delorean Reviews</h2>
                    <ul>
                        <li>"So fast it's almost like traveling in time." [4/5]</li>
                        <li>"Coolest ride on the road." [4/5]</li>
                        <li>"I'm feeling Marty McFly!" [5/5]</li>
                        <li>"The most futuristic ride of our day." [4.5/5]</li>
                        <li>"80's living and I love it!" [5/5]</li>
                    </ul>
                </div>
                <div class="upgrades">
                    <h2 class="heading-title">Delorean Upgrades</h2>
                    <div class="grid-upgrades-container">
                        <div class="grid-upgrade-item">
                            <div class="image-icon">
                                <img src="images/upgrades/flux-cap.png" alt="flux cap">
                            </div>
                            <a href="#">Flux Capacitor</a>
                        </div>
                        <div class="grid-upgrade-item">
                            <div class="image-icon">
                                <img src="images/upgrades/flame.jpg" alt="flame">
                            </div>
                            <a href="#">Flame Decals</a>
                        </div>
                        <div class="grid-upgrade-item">
                            <div class="image-icon">
                                <img src="images/upgrades/bumper_sticker.jpg" alt="bumper">
                            </div>
                            <a href="#">Bumper Stickers</a>
                        </div>
                        <div class="grid-upgrade-item">
                            <div class="image-icon">
                                <img src="images/upgrades/hub-cap.jpg" alt="hub">
                            </div>
                            <a href="#">Hub Caps</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include 'snippets/footer.php'; ?>
    </footer>

    <script src="js/utils.js"></script>
    <script src="js/script.js"></script>
</body>

</html>