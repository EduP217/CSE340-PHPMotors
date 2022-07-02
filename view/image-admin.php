<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Management | PHP Motors, Inc.</title>

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
            <h1 class="heading-title">Image Management Here</h1>
            <label>Choose one of the option below:</label>
            <h2 class="heading-title">Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
                echo $message;
            }?>

            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data" class="image-man-form">
                <label for="invId">Vehicle</label>
                <?php echo $prodSelect; ?>
                <label>Is this the main image for the vehicle?</label>
                <fieldset>
                    <label for="priYes" class="pImage">Yes
                        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    </label>
                    <label for="priNo" class="pImage">No
                        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                    </label>
                </fieldset>
                <label for="file1">Upload Image:</label>
                <input type="file" id="file1" name="file1">
                <button type="submit" class="regbtn">Upload</button>
                <input type="hidden" name="action" value="upload">
            </form>
            <div class="horizontal-divider"></div>
            <h2 class="heading-title">Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
                echo $imageDisplay;
            }?>
        </div>
    </main>
    <footer>
        <?php include '../snippets/footer.php'; ?>
    </footer>

    <script src="../js/utils.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>