<?php

// Filter
function filterInventoryByKeywords($keywords) {
    $db = phpmotorsConnect();
    $sql = "
        SELECT 
            invId,
            invMake,
            invModel,
            invDescription
        FROM inventory
        WHERE (
    ";
    $countkeys = 0;
    foreach ($keywords as $key) {
        $countkeys++;
        if($countkeys > 1){
            $sql.=" OR ";
        }
        $sql.="
            CONVERT(invMake USING utf8) LIKE '%$key%' 
            OR CONVERT(invModel USING utf8) LIKE '%$key%' 
            OR CONVERT(invDescription USING utf8) LIKE '%$key%' 
            OR CONVERT(invPrice USING utf8) LIKE '%$key%'
            OR CONVERT(invColor USING utf8) LIKE '%$key%'
        ";
    }
    $sql.=")";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $inventoryArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventoryArray;
    //return $sql;
}