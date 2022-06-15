<?php if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] == 1) header('Location: /phpmotors'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            echo "Modify $invMake $invModel";
        }
        ?> | PHP Motors</title>
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
            <h1 class="heading-title">
                <?php
                if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";
                } elseif (isset($invMake) && isset($invModel)) {
                    echo "Modify $invMake $invModel";
                }
                ?>
            </h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <div class="add-vehicle-form">
                <form method="POST" action="/phpmotors/vehicles/index.php">
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" <?php if(isset($invId)){ echo "value='$invId'"; } elseif(isset($invInfo['invId'])) {echo "value='$invInfo[invId]'"; }?>>
                    <fieldset>
                        <legend>Vehicle</legend>
                        <h4>*Note all Fields are Required</h4>
                        <label for="classificationId">Classification</label>
                        <select id="classificationId" name="classificationId" class="formInput" required>
                            <option>Choose Car Classification</option>
                            <?php
                            foreach ($classifications as $classification) {
                                $classifId = $classification['classificationId'];
                                $classifName = $classification['classificationName'];
                                $classifSelected = ((isset($classificationId) && $classificationId == $classifId) || (isset($invInfo['classificationId']) && $invInfo['classificationId'] == $classifId)) ? 'selected' : '';
                                echo "<option value='$classifId' $classifSelected>$classifName</option>";
                            }
                            ?>
                        </select>
                        <label for="invMake">Make</label>
                        <h5>*Maximum 30 characters</h5>
                        <input type="text" id="invMake" name="invMake" class="formInput" maxlength="30" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> />
                        <label for="invModel">Model</label>
                        <h5>*Maximum 30 characters</h5>
                        <input type="text" id="invModel" name="invModel" class="formInput" maxlength="30" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> />
                        <label for="invDescription">Description</label>
                        <textarea id="invDescription" name="invDescription" rows="5" class="formInput" required><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                        <label for="invImage">Image Path</label>
                        <h5>*Maximum 50 characters</h5>
                        <input type="text" id="invImage" name="invImage" class="formInput" maxlength="50" required <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?> placeholder="/phpmotors/images/no-image.png" />
                        <label for="invThumbnail">Thumbnail</label>
                        <h5>*Maximum 50 characters</h5>
                        <input type="text" id="invThumbnail" name="invThumbnail" class="formInput" maxlength="50" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?> placeholder="/phpmotors/images/no-image.png" />
                        <label for="invPrice">Price</label>
                        <input type="number" min="0" step="0.005" id="invPrice" name="invPrice" class="formInput" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?> />
                        <label for="invStock">Stock</label>
                        <input type="number" min="0" step="1" id="invStock" name="invStock" class="formInput" required <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?> />
                        <label for="invColor">Color</label>
                        <input type="text" id="invColor" name="invColor" class="formInput" pattern="[a-zA-Z'-'\s]*" required <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?> />
                    </fieldset>
                    <a href="/phpmotors/vehicles" class="button btn-cancel">Cancel</a>
                    <button type="submit" class="button btn-submit">Update Vehicle</button>
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