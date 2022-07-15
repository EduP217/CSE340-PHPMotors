<?php
// This is the Search controller

// create access to the session 
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicle model
require_once '../model/search-model.php';
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
    case 'q':
        $query = filter_input(INPUT_GET, 'query');
        $query = removeHTMLfromStr($query);
        $filter = filterInventoryByKeywords(['black', 'accent', 'police']);
        $searchResult = [];
        if(count($searchResult) == 0){
            $message = "<p class='alert-message alert-danger'>Sorry, no results were found to match $query.</p>";
        }
        include '../view/result-search.php';
        break;
    default:
        include '../view/search.php';
}