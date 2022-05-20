<?php
// This is the Vehicle controller

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicle model
require_once '../model/vehicle-model.php';

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
    $classificationNavName = strtolower($classification['classificationName']);
    $activeClass = ($classificationNavName == $action) ? 'active':'';
    $navList .= "<li><a href='/phpmotors?action=" . urlencode($classificationNavName) . "' class='$activeClass' title='View our $classificationNavName product line'>$classificationNavName</a></li>";
}
$navList .= '</ul>';
//echo $navList;
//exit;

switch ($action) {
    case 'add-classification':
        include '../view/add-classification.php';
        break;
    case 'add-vehicle':
        include '../view/add-vehicle.php';
        break;
    case 'save-classification':
        $classificationName = filter_input(INPUT_POST, 'classificationName');
        if (empty($classificationName)) {
            $message = "<p class='alert-message'>Please provide information for all empty form fields.</p>";
            include '../view/add-classification.php';
            exit;
        }
        $regOutcome = regClassification($classificationName);
        if ($regOutcome === 1) {
            header("Location: /phpmotors/vehicles");
            die();
        } else {
            $message = "<p class='alert-message'>Sorry, but adding the new classification failed. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
    case 'save-vehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId');
        $vehicleMake = filter_input(INPUT_POST, 'vehicleMake');
        $vehicleModel = filter_input(INPUT_POST, 'vehicleModel');
        $vehicleDescription = filter_input(INPUT_POST, 'vehicleDescription');
        $vehicleImageFile = filter_input(INPUT_POST, 'vehicleImageFile');
        $vehicleThumbnailFile = filter_input(INPUT_POST, 'vehicleThumbnailFile');
        $vehiclePrice = filter_input(INPUT_POST, 'vehiclePrice');
        $vehicleStock = filter_input(INPUT_POST, 'vehicleStock');
        $vehicleColor = filter_input(INPUT_POST, 'vehicleColor');
        
        if (empty($classificationId) || !is_numeric($classificationId) || empty($vehicleMake) || empty($vehicleModel) || empty($vehicleDescription) ||
            empty($vehicleImageFile) || empty($vehicleThumbnailFile) || empty($vehiclePrice) || empty($vehicleStock) || empty($vehicleColor)) {
            $message = "<p class='alert-message'>Please provide information for all empty form fields.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        $regOutcome = regVehicle($vehicleMake, $vehicleModel, $vehicleDescription, $vehicleImageFile, $vehicleThumbnailFile, $vehiclePrice, $vehicleStock, $vehicleColor, $classificationId);
        if ($regOutcome === 1) {
            header("Location: /phpmotors/vehicles");
            die();
        } else {
            $message = "<p class='alert-message'>Sorry, but adding the new vehicle failed. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;
    default:
        include '../view/vehicle-man.php';
}

?>