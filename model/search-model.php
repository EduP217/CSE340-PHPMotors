<?php

// Get quantity of Records
function CountTotalRecordsInventoryByKeywords($keywords) {
    $db = phpmotorsConnect();
    $sql = "
        SELECT 
            count(1) AS totalRecords
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
            OR CONVERT(invYear USING utf8) LIKE '%$key%'
        ";
    }
    $sql.=")";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result['totalRecords'];
    //return $sql;
}

// Filter
function filterInventoryByKeywords($keywords, $limit, $numpage) {
    $db = phpmotorsConnect();
    $sql = "
        SELECT 
            invId,
            invYear,
            invMake,
            invModel,
            invDescription,
            (
                select imgPath from images im 
                where im.invId = inventory.invId and im.imgPrimary = 1 and im.imgName like '%-tn%' 
                order by im.imgId desc 
                limit 1
            ) as invThumbnailImage
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
            OR CONVERT(invYear USING utf8) LIKE '%$key%'
        ";
    }
    $sql.=") LIMIT $limit OFFSET $numpage";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $inventoryArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventoryArray;
    //return $sql;
}