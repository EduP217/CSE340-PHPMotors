<?php

function getFrontPageItem($vehicleMake, $vehicleModel)
{
    $db = phpmotorsConnect();
    $sql = "SELECT invMake, invModel, invDescription, ImgPath FROM inventory INNER JOIN images on inventory.invId = images.InvId WHERE inventory.invMake=:invMake AND inventory.invModel=:invModel AND images.ImgPath not like '%-tn%' and images.ImgPrimary = 1 ORDER BY ImgId DESC LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invMake', $vehicleMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $vehicleModel, PDO::PARAM_STR);
    $stmt->execute();
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicle;
}

// Get Image Information from images table
function getImagesByVehicle($vehicleId) {
    $db = phpmotorsConnect();
    $sql = "SELECT ImgId, ImgName, ImgPath, ImgPrimary FROM images WHERE InvId=:invId and ImgPath like '%-tn.%' order by ImgPrimary desc, ImgDate asc";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $vehicleId, PDO::PARAM_STR);
    $stmt->execute();
    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $imageArray;
}