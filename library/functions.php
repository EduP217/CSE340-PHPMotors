<?php

/**
 * Functions library
 */

function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function checkInputMaxLength($input, $maxlength)
{
    return strlen(strval($input)) <= $maxlength;
}

function checkInteger($stock)
{
    $valstock = filter_var($stock, FILTER_VALIDATE_INT);
    return $valstock;
}

function checkText($color)
{
    $pattern = '/^[a-zA-Z ]*$/';
    return preg_match($pattern, $color);
}

function buildNavigationList($action, $classifications)
{
    // Build a navigation bar using the $classifications array
    $activeClass = ($action == 'home') ? 'active' : '';
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors' class='$activeClass' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $classificationNavName = strtolower($classification['classificationName']);
        $activeClass = ($classificationNavName == $action) ? 'active' : '';
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classificationNavName) . "' class='$activeClass' title='View our $classificationNavName lineup of vehicles'>$classificationNavName</a></li>";
    }
    $navList .= '</ul>';
    //echo $navList;
    //exit;
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications)
{
    $classificationList = '<select name="classificationId" id="classificationList" class="formInput small">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display" class="classification-list">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetail&vehicleId=$vehicle[invId]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors'></a>";
        $dv .= '<div class="horizontal-divider"></div>';
        $dv .= "<h4><a href='/phpmotors/vehicles/?action=vehicleDetail&vehicleId=$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</a></h4>";
        $dv .= "<span>$".number_format($vehicle['invPrice'])."</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

function buildVehicleDisplay($vehicle, $images)
{
    $dv = "<h1 class='heading-title'>$vehicle[invMake] $vehicle[invModel]</h1>";
    $dv .= "<div class='vehicle-detail-grid'>";
    $dv .= "<h2 class='hidden-md'>Vehicle Thumbnails</h2>";
    $dv .= "<div class='images-thumbnail'>";
    $imageSelected = '';
    foreach ($images as $image){
        $dataSrc = str_replace('-tn.','.',$image['ImgPath']);
        if(!$imageSelected and $image['ImgPrimary'] == '1'){
            $imageSelected = $dataSrc;
        }
        $dv .= "<img src='$image[ImgPath]' alt='$image[ImgName]' data-src='$dataSrc' />";
    }
    $dv .= "</div>";
    $dv .= "<img id='imageVehicleSelected' src='$imageSelected' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors'>";
    $dv .= "<p>$".number_format($vehicle['invPrice'])."</p>";
    $dv .= "<p>$vehicle[invDescription]</p>";
    $dv .= "<p>Color: $vehicle[invColor]</p>";
    $dv .= "<p># in stock: $vehicle[invStock]</p>";
    $dv .= "</div>";
    return $dv;
}

/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
        $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image' class='text-underline'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId" class="formInput">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
        $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
        break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
        break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
        break;
        default:
        return;
    } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
} // ends resizeImage function

function removeHTMLfromStr($text, $htmlAllowed = ''){
    return strip_tags($text, $htmlAllowed);
}

function displaySearchResult($searchResult){
    $display = "<ul class='searchContainer'>";
    foreach($searchResult as $r){
        $display .= "
            <li class='searchItem'>
                <img src='".$r["invThumbnailImage"]."' alt='thumbnail image of ".$r["invMake"]." ".$r["invModel"]."' />
                <a href='/phpmotors/vehicles/?action=vehicleDetail&vehicleId=".$r["invId"]."'>".$r["invYear"]." ".$r["invMake"]." ".$r["invModel"]."</a>
                <p>".$r["invDescription"]."</p>
            </li>";
    }
    $display .= "</ul>";
    return $display;
}

function displaySearchNavigation($totalnumPages, $q, $activenumpage){
    $qf = str_replace(" ","+",$q);
    $display = "<div class='paginator-container'><ul class='pagination'>";
    $previousNumber = $activenumpage-1;
    if($previousNumber > 0){
        $display .= "<li class='text-end'>
            <a href='/phpmotors/search/?action=q&query=$qf&p=$previousNumber'>
                <span class='paginationIcon'><</span><br/><span>Previous</span>
            </a>
        </li>";
    }
    foreach(range(1,$totalnumPages) as $num) {
        if($activenumpage == $num){
            $display .= "<li class='page active'>$num</li>";
        } else {
            $display .= "<li class='page'>
                <a href='/phpmotors/search/?action=q&query=$qf&p=$num'>$num</a>
            </li>";
        }
    }
    $nextNumber = $activenumpage+1;
    if($nextNumber <= $totalnumPages){
        $display .= "<li class='text-start'>
            <a href='/phpmotors/search/?action=q&query=$qf&p=$nextNumber'>
                <span class='paginationIcon'>></span><br/><span>Next</span>
            </a>
        </li>";
    }
    $display .= "</ul></div>";
    return $display;
}