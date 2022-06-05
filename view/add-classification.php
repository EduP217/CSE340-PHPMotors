<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Classification - PHP Motors</title>

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
        <div class="add-classification-container">
            <h1 class="heading-title">Add Classification</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <div class="add-classification-form">
                <form method="POST" action="/phpmotors/vehicles/index.php?action=save-classification">
                    <fieldset>
                        <legend>Classification</legend>
                        <label for="classificationName">Name</label>
                        <h5>*Maximum 30 characters</h5>
                        <input type="text" id="classificationName" name="classificationName" class="formInput" required maxlength="30" <?php if(isset($classificationName)){echo "value='$classificationName'";} ?>/>
                    </fieldset>
                    <a href="/phpmotors/vehicles" class="button btn-cancel">Cancel</a>
                    <button type="submit" class="button btn-submit">Add Classification</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <?php include '../snippets/footer.php'; ?>
    </footer>

    <script src="../js/utils.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>