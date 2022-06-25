<?php

/**
 * Functions library
 */

function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function checkInputMaxLength($input, $maxlength)
{
    return strlen(strval($input)) <= $maxlength;
}

function checkInteger($stock)
{
    $valstock = filter_var($stock, FILTER_VALIDATE_INT);
    return $valstock;
}

function checkText($color)
{
    $pattern = '/^[a-zA-Z ]*$/';
    return preg_match($pattern, $color);
}

function buildNavigationList($action, $classifications)
{
    // Build a navigation bar using the $classifications array
    $activeClass = ($action == 'home') ? 'active' : '';
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors' class='$activeClass' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $classificationNavName = strtolower($classification['classificationName']);
        $activeClass = ($classificationNavName == $action) ? 'active' : '';
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classificationNavName) . "' class='$activeClass' title='View our $classificationNavName lineup of vehicles'>$classificationNavName</a></li>";
    }
    $navList .= '</ul>';
    //echo $navList;
    //exit;
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications)
{
    $classificationList = '<select name="classificationId" id="classificationList" class="formInput small">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display" class="classification-list">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetail&vehicleId=$vehicle[invId]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors'></a>";
        $dv .= '<div class="horizontal-divider"></div>';
        $dv .= "<h3><a href='/phpmotors/vehicles/?action=vehicleDetail&vehicleId=$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</a></h3>";
        $dv .= "<span>$".number_format($vehicle['invPrice'])."</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

function buildVehicleDisplay($vehicle)
{
    $dv = "<h1 class='heading-title'>$vehicle[invMake] $vehicle[invModel]</h1>";
    $dv .= "<div class='vehicle-detail-grid'>";
    $dv .= "<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors'>";
    $dv .= "<h2>Price: $".number_format($vehicle['invPrice'])."</h2>";
    $dv .= "<h3>$vehicle[invMake] $vehicle[invModel] Details</h3>";
    $dv .= "<p class='colored'>$vehicle[invDescription]</p>";
    $dv .= "<p>Color: $vehicle[invColor]</p>";
    $dv .= "<p class='colored'># in stock: $vehicle[invStock]</p>";
    $dv .= "</div>";
    return $dv;
}