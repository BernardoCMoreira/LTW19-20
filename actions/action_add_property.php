<?php
include_once('../config/init.php');
include_once('../database/user.php');
include_once('../database/property.php');
include_once('../database/image.php');
include_once('../database/extra.php');

$ownerID = getUser($_SESSION['username'])['userID'];
$imageID = getLenghtImgs() + 1;
$propertyID = getLenghtProperties() + 1;
$create = 0;

if ($_FILES["fileToUpload"]["name"]) {

    // Generate filename
    $target_dir = "../images/";
    $originalName = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($originalName, PATHINFO_EXTENSION);
    $target_file = $target_dir . $imageID . "." . $imageFileType;

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "jfif" && $imageFileType != "mp4"
    && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF" && $imageFileType != "JFIF" && $imageFileType != "MP4") {
      $_SESSION['error_messages'][] = "Sorry, only JPG, JPEG, JFIF, MP4, PNG & GIF files are allowed.";
    }else{
        // Move the uploaded file to its final destination
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

        // Insert property data into database
        createImg($propertyID, $ownerID, "." . $imageFileType);
        if($_POST['address'] && $_POST['city'] && $_POST['country'] && $_POST['numQuartos'] && $_POST['price']){
            $address = $_POST['address'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $numQuartos = $_POST['numQuartos'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            createProperty($ownerID, $address, $city, $country, $numQuartos, $description, $price);
            header("Location: ../pages/addPropertyExtras.php?propertyID=$propertyID");
        }else{
            $_SESSION['error_messages'][] = "Error uploading property data";
        }
    }
}else{
    $_SESSION['error_messages'][] = "You need to add a photo";
}
header('Location: ../pages/user.php');
