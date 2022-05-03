<?php $host = '/CSE340/CSE340-PHPMotors/'; $page = 'classic'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic - PHP Motors</title>

    <link rel="stylesheet" href="<?php echo $host ?>css/style.css">
    <link rel="stylesheet" href="<?php echo $host ?>css/large.css">
</head>

<body>
    <header>
        <?php include '../layout/header.php'; ?>
    </header>
    <main>
        <div class="classic-container">
            <h1 class="heading-title">Content Title Here</h1>
        </div>
    </main>
    <footer>
        <?php include '../layout/footer.php'; ?>
    </footer>

    <script src="<?php echo $host ?>js/utils.js"></script>
    <script src="<?php echo $host ?>js/script.js"></script>
</body>

</html>