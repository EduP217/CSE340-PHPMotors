<?php

// Vehicle PHP Motors Model
/**
 * the new function will handle site classification registration
 */
function regClassification($classificationName){
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

function regVehicle($vehicleMake, $vehicleModel, $vehicleDescription, $vehicleImage, $vehicleThumbnail, $vehiclePrice, $vehicleStock, $vehicleColor, $vehicleClassificationId){
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

?>