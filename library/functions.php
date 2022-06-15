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
        $navList .= "<li><a href='/phpmotors?action=" . urlencode($classificationNavName) . "' class='$activeClass' title='View our $classificationNavName product line'>$classificationNavName</a></li>";
    }
    $navList .= '</ul>';
    //echo $navList;
    //exit;
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications)
{
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}
