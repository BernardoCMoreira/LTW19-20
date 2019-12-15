<?php
include_once('../config/init.php');
include_once('../database/user.php');
include_once('../database/property.php');
include_once('../database/image.php');
include_once('../database/extra.php');

$ownerID = getUser($_SESSION['username'])['userID'];

if ($_FILES["fileToUpload"]["name"]) {
    // Generate filename
    $target_dir = "../images/";
    $originalName = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($originalName, PATHINFO_EXTENSION);

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "jfif" && $imageFileType != "mp4"
    && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF" && $imageFileType != "JFIF" && $imageFileType != "MP4") {
      $_SESSION['error_messages'][] = "Sorry, only JPG, JPEG, JFIF, MP4, PNG & GIF files are allowed.";
    }else{

        // Insert property data into database
        if($_POST['address'] && $_POST['city'] && $_POST['country'] && $_POST['numQuartos'] && $_POST['price']){
            $address = $_POST['address'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $numQuartos = $_POST['numQuartos'];
            $description = $_POST['description'];
            $price = $_POST['price'];

            $propertyID = createProperty($ownerID, $address, $city, $country, $numQuartos, $description, $price);

            $imageFileType = '.' . $imageFileType;
            // Insert property photo data into database
            $target_file = createImg($propertyID, 'property', $imageFileType);
            $target_file = $target_dir . $target_file. $imageFileType;

            // Move the uploaded file to its final destination
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

            header("Location: ../pages/addPropertyExtras.php?propertyID=$propertyID");
        }else{
            $_SESSION['error_messages'][] = "Incomplete form";
            header('Location: ../pages/user.php');
        }
    }
}else{
    $_SESSION['error_messages'][] = "You need to add a photo";
    header('Location: ../pages/user.php');
}

