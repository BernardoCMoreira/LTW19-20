<?php
include_once('../config/init.php');
include_once('../database/user.php');
include_once('../database/property.php');
include_once('../database/image.php');

$ownerID = getUser($_SESSION['username'])['userID'];
$imageID = getLenghtImgs() + 1;
$propertyID = getLenghtProperties() + 1;

if ($_FILES["fileToUpload"]["name"]) {

    $target_dir = "../images/";
    $originalName = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($originalName, PATHINFO_EXTENSION);
    $target_file = $target_dir . $imageID . "." . $imageFileType;
    $uploadOk = 1;

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"
        && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF"
    ) {
        $_SESSION['error_messages'][] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            createImg($propertyID, $ownerID, "." . $imageFileType);

            if($_POST['address'] && $_POST['city'] && $_POST['country'] && $_POST['numQuartos'] && $_POST['price']){
                $address = $_POST['address'];
                $city = $_POST['city'];
                $country = $_POST['country'];
                $numQuartos = $_POST['numQuartos'];
                $description = $_POST['description'];
                $price = $_POST['price'];

                createProperty($ownerID, $address, $city, $country, $numQuartos, $description, $price);
            }else{
                $_SESSION['error_messages'][] = "Error uploading data";
            }
        } else {
            $_SESSION['error_messages'][] = "Error uploading photo";
        }
    }
}else {
    $_SESSION['error_messages'][] = "You need to choose a photo";
}


header('Location: ../pages/user.php');
