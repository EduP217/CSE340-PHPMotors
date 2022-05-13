<?php
// This is the main controller

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';

// Get the array of classifications
$classifications = getClassifications();
//var_dump($classifications);
//exit;

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
}

// Build a navigation bar using the $classifications array
$activeClass = ($action == null) ? 'active':'';
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors' class='$activeClass' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $classificationName = strtolower($classification['classificationName']);
    $activeClass = ($classificationName == $action) ? 'active':'';
    $navList .= "<li><a href='/phpmotors?action=" . urlencode($classificationName) . "' class='$activeClass' title='View our $classificationName product line'>$classificationName</a></li>";
}
$navList .= '</ul>';
//echo $navList;
//exit;

switch ($action) {
    case 'classic':
        include 'view/classic.php';
        break;
    case 'sports':
        include 'view/sports.php';
        break;
    case 'suv':
        include 'view/suv.php';
        break;
    case 'trucks':
        include 'view/trucks.php';
        break;
    case 'used':
        include 'view/used.php';
        break;
    default:
        include 'view/home.php';
}

?>