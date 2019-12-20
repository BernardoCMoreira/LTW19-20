<?php
  include_once('../config/init.php');
  include_once('../database/user.php');
  include_once('../database/property.php');
  include_once('../database/image.php');
  include_once('../database/extra.php');

  $propertyID = trim(strip_tags($_POST['propertyID']));

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

      $imageFileType = '.' . $imageFileType;
      // Insert image data into database
      $target_file = createImg($propertyID, 'property', $imageFileType);
      $target_file = $target_dir . $target_file. $imageFileType;
      
      // Move the uploaded file to its final destination
      move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    }
  }

  if($_POST['address']){
    $address = trim(strip_tags($_POST['address']));
    if(updateAddress( $propertyID, $address)==null){
      $_SESSION['error_messages'][] = "Error updating address";
    }

  }
  if($_POST['city']){
    $city = trim(strip_tags($_POST['city']));
    if(updateCity( $propertyID, $city)==null){
      $_SESSION['error_messages'][] = "Error updating city";
    }

  }
  if($_POST['country']){
    $country = trim(strip_tags($_POST['country']));
    if(updateCountry( $propertyID, $country)==null){
      $_SESSION['error_messages'][] = "Error updating country";
    }

  }
  if($_POST['numQuartos']){
    $numQuartos = trim(strip_tags($_POST['numQuartos']));
    if(updateNumQuartos( $propertyID, $numQuartos)==null){
      $_SESSION['error_messages'][] = "Error updating numQuartos";
    }

  }
  if($_POST['description']){
    $description = trim(strip_tags($_POST['description']));
    if(updatePDescription( $propertyID, $description)==null){
      $_SESSION['error_messages'][] = "Error updating description";
    }

  }
  if($_POST['price']){
    $price = trim(strip_tags($_POST['price']));
    if(updatePrice( $propertyID, $price)==null){
      $_SESSION['error_messages'][] = "Error updating price";
    }

  }

  header("Location: ../pages/addPropertyExtras.php?propertyID=$propertyID");
  
?>
