<?php
// This is the Accounts Controller

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';

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
    case 'login':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'register':
        #echo 'You are in the register case statement.';
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        $clientPassword = filter_input(INPUT_POST, 'clientPassword');
        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }
        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
        // Check and report the result
        if ($regOutcome === 1) {
            $message = "<p class='alert-message'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p class='alert-message'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    default:
        break;      
}

?>