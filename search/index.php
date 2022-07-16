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

$searchLimitRows = 10;
$defaultOffset = 0;

switch ($action) {
    case 'q':
        $query = filter_input(INPUT_GET, 'query', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($query)) {
            $message = '<p class="alert-message alert-danger">You must provide a Search String.</p>';
            include '../view/search.php';
            exit;
        }
        $query = removeHTMLfromStr($query);
        $querySplit = explode(' ', $query);

        $totalRecordsOfSearchResult = CountTotalRecordsInventoryByKeywords($querySplit);
        if($totalRecordsOfSearchResult == 0){
            $message = "<p class='alert-message alert-danger'>Sorry, no results were found to match $query.</p>";
            include '../view/result-search.php';
            exit;
        }

        $initialOffset = $defaultOffset;
        $totalnumPages = ceil($totalRecordsOfSearchResult/$searchLimitRows);

        if($totalnumPages > 1){
            $numPage = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);
            if(!empty($numPage)){
                $initialOffset = ($numPage - 1) * $searchLimitRows;
            } else {
                $numPage = $initialOffset + 1;
            }
            $displayNavigation = displaySearchNavigation($totalnumPages, $query, $numPage);
        }

        $searchResult = filterInventoryByKeywords($querySplit, $searchLimitRows, $initialOffset);
        $displayResult = displaySearchResult($searchResult);
        include '../view/result-search.php';
        break;
    default:
        include '../view/search.php';
}