<?php $host = '/CSE340/CSE340-PHPMotors/'; $page = '500'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - PHP Motors</title>

    <link rel="stylesheet" href="<?php echo $host ?>css/style.css" media="screen">
    <link rel="stylesheet" href="<?php echo $host ?>css/large.css" media="screen">
</head>

<body>
    <header>
        <?php include '../layout/header.php'; ?>
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
        <?php include '../layout/footer.php'; ?>
    </footer>

    <script src="<?php echo $host ?>js/utils.js"></script>
    <script src="<?php echo $host ?>js/script.js"></script>
</body>

</html>