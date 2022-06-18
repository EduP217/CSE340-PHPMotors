<?php if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] == 1) header('Location: /phpmotors');?><!DOCTYPE html>
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
                        <select id="classificationId" name="classificationId" class="formInput" required>
                            <option value="">Choose Car Classification</option>
                            <?php 
                            foreach ($classifications as $classification) {
                                $classifId = $classification['classificationId'];
                                $classifName = $classification['classificationName'];
                                $classifSelected = (isset($classificationId) && $classificationId == $classifId) ? 'selected':'';
                                echo "<option value='$classifId' $classifSelected>$classifName</option>";
                            }
                            ?>
                        </select>
                        <label for="vehicleMake">Make</label>
                        <h5>*Maximum 30 characters</h5>
                        <input type="text" id="vehicleMake" name="vehicleMake" class="formInput" maxlength="30" required <?php if(isset($vehicleMake)){echo "value='$vehicleMake'";} ?> />
                        <label for="vehicleModel">Model</label>
                        <h5>*Maximum 30 characters</h5>
                        <input type="text" id="vehicleModel" name="vehicleModel" class="formInput" maxlength="30" required <?php if(isset($vehicleModel)){echo "value='$vehicleModel'";} ?> />
                        <label for="vehicleDescription">Description</label>
                        <textarea id="vehicleDescription" name="vehicleDescription" rows="5" class="formInput" required ><?php if(isset($vehicleDescription)){echo $vehicleDescription;} ?></textarea>
                        <label for="vehicleImageFile">Image Path</label>
                        <h5>*Maximum 50 characters</h5>
                        <input type="text" id="vehicleImageFile" name="vehicleImageFile" class="formInput" maxlength="50" required <?php if(isset($vehicleImageFile)){echo "value='$vehicleImageFile'";} ?> placeholder="/phpmotors/images/no-image.png" />
                        <label for="vehicleThumbnailFile">Thumbnail</label>
                        <h5>*Maximum 50 characters</h5>
                        <input type="text" id="vehicleThumbnailFile" name="vehicleThumbnailFile" class="formInput" maxlength="50" required <?php if(isset($vehicleThumbnailFile)){echo "value='$vehicleThumbnailFile'";} ?> placeholder="/phpmotors/images/no-image.png" />
                        <label for="vehiclePrice">Price</label>
                        <input type="number" min="0" step="0.005" id="vehiclePrice" name="vehiclePrice" class="formInput" required <?php if(isset($vehiclePrice)){echo "value='$vehiclePrice'";} ?> />
                        <label for="vehicleStock">Stock</label>
                        <input type="number" min="0" step="1" id="vehicleStock" name="vehicleStock" class="formInput" required <?php if(isset($vehicleStock)){echo "value='$vehicleStock'";} ?> />
                        <label for="vehicleColor">Color</label>
                        <input type="text" id="vehicleColor" name="vehicleColor" class="formInput" pattern="[a-zA-Z'-'\s]*" required <?php if(isset($vehicleColor)){echo "value='$vehicleColor'";} ?> />
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