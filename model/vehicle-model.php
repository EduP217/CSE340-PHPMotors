<?php

// Vehicle PHP Motors Model
/**
 * the new function will handle site classification registration
 */
function regClassification($classificationName)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';
    try {
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
    } catch (\Exception $e) {
        //throw $th;
        //print($e);
        $rowsChanged = 0;
    }
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function regVehicle($vehicleMake, $vehicleModel, $vehicleDescription, $vehicleImage, $vehicleThumbnail, $vehiclePrice, $vehicleStock, $vehicleColor, $vehicleClassificationId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO inventory(invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId) 
        VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    try {
        // Create the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invMake', $vehicleMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $vehicleModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $vehicleDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $vehicleImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $vehicleThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $vehiclePrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $vehicleStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $vehicleColor, PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $vehicleClassificationId, PDO::PARAM_INT);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
    } catch (\Exception $e) {
        //throw $th;
        //print($e);
        $rowsChanged = 0;
    }
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId)
{
    $db = phpmotorsConnect();
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}

// Get vehicle information by invId
function getInvItemInfo($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

// Update a vehicle
function updateVehicle(
    $invMake,
    $invModel,
    $invDescription,
    $invImage,
    $invThumbnail,
    $invPrice,
    $invStock,
    $invColor,
    $classificationId,
    $invId
) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
        $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
        $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
    } catch(\Exception $e) {
        //throw $th;
        //print($e);
        $rowsChanged = 0;
    }
    return $rowsChanged;
}

function deleteVehicle($invId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
    } catch(\Exception $e) {
        //throw $th;
        //print($e);
        $rowsChanged = 0;
    }
    return $rowsChanged;
}

?>