<?php if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] == 1) header('Location: /phpmotors'); ?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake'])){echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
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
        <div class="remove-vehicle-container">
            <h1 class="heading-title"><?php if(isset($invInfo['invMake'])){echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
            <p class="text-alert">Confirm Vehicle Deletion. The delete is permanent.</p>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <div class="remove-vehicle-form">
                <form method="POST" action="/phpmotors/vehicles/index.php">
                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" <?php if(isset($invId)){ echo "value='$invId'"; } elseif(isset($invInfo['invId'])) {echo "value='$invInfo[invId]'"; }?>>
                    <fieldset>
                        <legend>Vehicle</legend>
                        <label for="invMake">Make</label>
                        <input type="text" id="invMake" name="invMake" class="formInput" required readonly <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> />
                        <label for="invModel">Model</label>
                        <input type="text" id="invModel" name="invModel" class="formInput" required readonly <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> />
                        <label for="invDescription">Description</label>
                        <textarea rows="5" id="invDescription" name="invDescription" class="formInput" required readonly><?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                    </fieldset>
                    <a href="/phpmotors/vehicles" class="button btn-cancel">Cancel</a>
                    <button type="submit" class="button btn-submit">Delete Vehicle</button>
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