<?php $page = '500'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - PHP Motors</title>

    <link rel="stylesheet" href="css/style.css" media="screen">
    <link rel="stylesheet" href="css/large.css" media="screen">
</head>

<body>
    <header>
        <?php include 'snippets/header.php'; ?>
    </header>
    <main>
        <div class="exception-container">
            <h1>Server Error</h1>
            <h3>
                Sorry our server seems to be experiencing some technical difficulties. Please check back later
            </h3>
        </div>
    </main>
    <footer>
        <?php include 'snippets/footer.php'; ?>
    </footer>

    <script src="js/utils.js"></script>
    <script src="js/script.js"></script>
</body>

</html>