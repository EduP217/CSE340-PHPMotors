<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle - PHP Motors</title>

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
        <div class="add-vehicle-container">
            <h1 class="heading-title">Add Vehicle</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <div class="add-vehicle-form">
                <form method="POST" action="/phpmotors/vehicles/index.php?action=save-vehicle">
                    <fieldset>
                        <legend>Vehicle</legend>
                        <h4>*Note all Fields are Required</h4>
                        <label for="classificationId">Classification</label>
                        <select id="classificationId" name="classificationId" class="formInput">
                            <option>Choose Car Classification</option>
                            <?php 
                            foreach ($classifications as $classification) {
                                $classificationId = $classification['classificationId'];
                                $classificationName = $classification['classificationName'];
                                echo "<option value='$classificationId'>$classificationName</option>";
                            }
                            ?>
                        </select>
                        <label for="vehicleMake">Make</label>
                        <input type="text" id="vehicleMake" name="vehicleMake" class="formInput" />
                        <label for="vehicleModel">Model</label>
                        <input type="text" id="vehicleModel" name="vehicleModel" class="formInput" />
                        <label for="vehicleDescription">Description</label>
                        <textarea id="vehicleDescription" name="vehicleDescription" rows="5" class="formInput"></textarea>
                        <label for="vehicleImageFile">Image Path</label>
                        <input type="text" id="vehicleImageFile" name="vehicleImageFile" class="formInput" value="/phpmotors/images/no-image.png" readonly />
                        <label for="vehicleThumbnailFile">Thumbnail</label>
                        <input type="text" id="vehicleThumbnailFile" name="vehicleThumbnailFile" class="formInput" value="/phpmotors/images/no-image.png" readonly />
                        <label for="vehiclePrice">Price</label>
                        <input type="number" min="0" step="0.5" id="vehiclePrice" name="vehiclePrice" class="formInput" />
                        <label for="vehicleStock">Stock</label>
                        <input type="number" min="0" step="1" id="vehicleStock" name="vehicleStock" class="formInput" />
                        <label for="vehicleColor">Color</label>
                        <input type="text" id="vehicleColor" name="vehicleColor" class="formInput" />
                    </fieldset>
                    <a href="/phpmotors/vehicles" class="button btn-cancel">Cancel</a>
                    <button type="submit" class="button btn-submit">Add Vehicle</button>
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