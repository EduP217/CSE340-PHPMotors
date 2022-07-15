<?php
// This is the main controller

// create access to the session 
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
require_once 'model/images-model.php';
// Get the functions library
require_once 'library/functions.php';

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

// Get the array of classifications
$classifications = getClassifications();
//var_dump($classifications);
//exit;

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
    if($action == NULL) {
        $action = 'home';
    }
}

$navList = buildNavigationList($action, $classifications);

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
        $delorean = getFrontPageItem('dmc','delorean');
        include 'view/home.php';
}

?>