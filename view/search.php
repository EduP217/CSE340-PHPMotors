<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search | PHP Motors, Inc.</title>

    <link rel="stylesheet" href="../css/style.css" media="screen">
    <link rel="stylesheet" href="../css/large.css" media="screen">
</head>

<body>
    <header>
        <?php include '../snippets/header.php'; ?>
    </header>
    <nav class="header-navigation">
        <?php echo $navList; ?>
    </nav>
    <main>
        <div class="container">
            <h1 class="heading-title">Search</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form method="GET" action="/phpmotors/search" class="full-width">
                <input type="hidden" name="action" value="q" />
                <div class="search-form">
                    <label for="query">What are you lookin for today?</label>
                    <input type="text" id="query" name="query" class="formInput full-width" required />
                    <button type="submit" class="btn btn-submit-secondary btn-large">Search</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <?php include '../snippets/footer.php'; ?>
    </footer>

    <script src="../js/utils.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>