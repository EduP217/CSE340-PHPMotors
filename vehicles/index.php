<?php
// This is the Vehicle controller

// create access to the session 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicle model
require_once '../model/vehicle-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
//var_dump($classifications);
//exit;

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
}

$navList = buildNavigationList($action, $classifications);

switch ($action) {
    case 'add-classification':
        include '../view/add-classification.php';
        break;
    case 'add-vehicle':
        include '../view/add-vehicle.php';
        break;
    case 'save-classification':
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));        
        if (empty($classificationName)) {
            $message = "<p class='alert-message'>Please provide information for all empty form fields.</p>";
            include '../view/add-classification.php';
            exit;
        }
        if (!checkInputMaxLength($classificationName,30)) {
            $message = "<p class='alert-message'>Your classification name must have maximum 30 characters.</p>";
            include '../view/add-classification.php';
            exit;
        }
        $regOutcome = regClassification($classificationName);
        if ($regOutcome === 1) {
            $message = "<p class='alert-message alert-success'>The classification, $classificationName was addedd successfully.</p>";
            include '../view/add-classification.php';
            exit;
        } else {
            $message = "<p class='alert-message'>Sorry, but adding the new classification failed. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
    case 'save-vehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $vehicleMake = trim(filter_input(INPUT_POST, 'vehicleMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $vehicleModel = trim(filter_input(INPUT_POST, 'vehicleModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $vehicleDescription = trim(filter_input(INPUT_POST, 'vehicleDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $vehicleImageFile = trim(filter_input(INPUT_POST, 'vehicleImageFile', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $vehicleThumbnailFile = trim(filter_input(INPUT_POST, 'vehicleThumbnailFile', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $vehiclePrice = trim(filter_input(INPUT_POST, 'vehiclePrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $vehicleStock = trim(filter_input(INPUT_POST, 'vehicleStock', FILTER_SANITIZE_NUMBER_INT));
        $vehicleColor = trim(filter_input(INPUT_POST, 'vehicleColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $checkVehicleColor = checkText($vehicleColor);
        if(!$checkVehicleColor){
            $vehicleColor = '';
            $message = "<p class='alert-message alert-danger'>Some fields are not a valid type of data.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        
        if (empty($classificationId) || !is_numeric($classificationId) || empty($vehicleMake) || empty($vehicleModel) || empty($vehicleDescription) ||
            empty($vehicleImageFile) || empty($vehicleThumbnailFile) || empty($vehiclePrice) || empty($vehicleStock) || empty($vehicleColor)) {
            $message = "<p class='alert-message alert-danger'>Please provide information for all empty form fields.</p>";
            include '../view/add-vehicle.php';
            exit;
        }

        if (!checkInputMaxLength($vehicleMake,30) || !checkInputMaxLength($vehicleModel,30) || !checkInputMaxLength($vehicleImageFile,50) || !checkInputMaxLength($vehicleThumbnailFile,50)) {
            $message = "<p class='alert-message alert-danger'>Some fields are exceeding the maximun characters.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        
        $regOutcome = regVehicle($vehicleMake, $vehicleModel, $vehicleDescription, $vehicleImageFile, $vehicleThumbnailFile, $vehiclePrice, $vehicleStock, $vehicleColor, $classificationId);
        if ($regOutcome === 1) {
            $message = "<p class='alert-message alert-success'>The vehicle, $vehicleMake $vehicleModel was addedd successfully.</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p class='alert-message alert-danger'>Sorry, but adding the new vehicle failed. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;
    default:
        include '../view/vehicle-man.php';
}

?>