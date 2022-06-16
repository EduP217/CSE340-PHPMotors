<?php
// This is the Accounts Controller

// create access to the session 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
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
    case 'login':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'register':
        #echo 'You are in the register case statement.';
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = "<p class='alert-message'>Please provide information for all empty form fields.</p>";
            include '../view/registration.php';
            exit;
        }
        
        $existingEmail = checkExistingEmail($clientEmail);
        // Check for existing email address in the table
        if ($existingEmail) {
            $message = '<p class="alert-message">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 minute'), '/');
            $_SESSION['message'] = "<p class='alert-message alert-success'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            //$message = "<p class='alert-message'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            //include '../view/login.php';
            //exit;
        } else {
            $message = "<p class='alert-message alert-danger'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'Login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $checkPassword = checkPassword($clientPassword);
        if (empty($clientEmail) || empty($checkPassword)) {
            $message = "<p class='alert-message alert-danger'>Please provide a valid email address and password.</p>";
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = "<p class='alert-message alert-danger'>Please check your password and try again.</p>";
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../view/admin.php';
        exit;
        break;
    case 'logout':
        session_unset();
        session_destroy();
        header('Location: /phpmotors');
        break;
    case 'modifyAccount':
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientId = $_SESSION['clientData']['clientId'];
        include '../view/client-update.php';
        break;
    case 'updateAccount':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientEmail = checkEmail($clientEmail);

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $accountMessage = "<p class='alert-message alert-danger'>Please provide information for all empty form fields.</p>";
            include '../view/client-update.php';
            exit;
        }

        if ($clientEmail != $_SESSION['clientData']['clientEmail']){
            $existingEmail = checkExistingEmail($clientEmail);
            // Check for existing email address in the table
            if ($existingEmail) {
                $accountMessage = '<p class="alert-message alert-danger">That email address already exists. Do you want to login instead?</p>';
                include '../view/client-update.php';
                exit;
            }
        }

        $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        if ($updateOutcome === 1) {
            $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
            $_SESSION['clientData']['clientLastname'] = $clientLastname;
            $_SESSION['clientData']['clientEmail'] = $clientEmail;

            setcookie('firstname', $clientFirstname, strtotime('+1 minute'), '/');
            $_SESSION['message'] = "<p class='alert-message alert-success'>$clientFirstname, Your information has been updated.</p>";
            header('Location: /phpmotors/accounts/');
        } else {
            $message = "<p class='alert-message alert-danger'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }

        break;
    case 'updatePassword':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if (empty($checkPassword)) {
            $passwordMessage = "<p class='alert-message alert-danger'>Please make sure your password matches the desired pattern.</p>";
            include '../view/client-update.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $updateOutcome = updatePassword($hashedPassword, $clientId);

        if ($updateOutcome === 1) {
            $_SESSION['message'] = "<p class='alert-message alert-success'>$clientFirstname, Your password has been updated.</p>";
            header('Location: /phpmotors/accounts/');
        } else {
            $message = "<p class='alert-message alert-danger'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }

        break;
    default:
        include '../view/admin.php';
        break;
}

?>