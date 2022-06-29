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
require_once '../model/images-model.php';
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
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
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
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='alert-message alert-danger'>Sorry, but adding the new vehicle failed. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;
    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */
    case 'getInventoryItems':
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(!$invInfo || count($invInfo)<1){
            $message = '<p class="alert-message alert-danger">Sorry, no vehicle information could be found.</p>';
        }
        include '../view/update-vehicle.php';
        exit;
        break;
    case 'updateVehicle':
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
            $message = '<p class="alert-message alert-danger">Please complete all information for the updated item! Double check the classification of the item.</p>';
            include '../view/update-vehicle.php';
            exit;
        }
        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
        if ($updateResult) {
            $message = "<p class='alert-message alert-success'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = '<p class="alert-message alert-danger">Error. The updated vehicle was not updated.</p>';
            include '../view/update-vehicle.php';
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/delete-vehicle.php';
        exit;
        break;
    case 'deleteVehicle':
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='alert-message alert-success'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = '<p class="alert-message alert-danger">Error: $invMake $invModel was not deleted.</p>';
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $navList = buildNavigationList($classificationName, $classifications);
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
            $message = "<p class='alert-message alert-danger'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include '../view/classification.php';
        break;
    case 'vehicleDetail':
        $vehicleId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);
        $vehicle = findVehicleById($vehicleId);
        if(!$vehicle){
            $pageTitle = 'Not Found';
            $message = "<p class='alert-message alert-danger'>Sorry, the vehicle could not be found.</p>";
        } else {
            $vehicleImages = getImagesByVehicle($vehicle["invId"]);
            $pageTitle = $vehicle['invMake']." ".$vehicle['invModel'];
            $vehicleDisplay = buildVehicleDisplay($vehicle, $vehicleImages);
        }
        include '../view/vehicle-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-man.php';
}

?>