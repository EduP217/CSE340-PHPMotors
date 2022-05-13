<?php
// This is the main controller

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
}

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