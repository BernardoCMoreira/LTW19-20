<?php
  include_once('../config/init.php');
  include_once('../database/user.php');
  include_once('../database/property.php');
  include_once('../database/image.php');
  include_once('../database/extra.php');

  $propertyID = $_POST['propertyID'];

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

    if(updateAddress( $propertyID, $_POST['address'])==null){
      $_SESSION['error_messages'][] = "Error updating address";
    }

  }
  if($_POST['city']){

    if(updateCity( $propertyID, $_POST['city'])==null){
      $_SESSION['error_messages'][] = "Error updating city";
    }

  }
  if($_POST['country']){

    if(updateCountry( $propertyID, $_POST['country'])==null){
      $_SESSION['error_messages'][] = "Error updating country";
    }

  }
  if($_POST['numQuartos']){

    if(updateNumQuartos( $propertyID, $_POST['numQuartos'])==null){
      $_SESSION['error_messages'][] = "Error updating numQuartos";
    }

  }
  if($_POST['description']){

    if(updatePDescription( $propertyID, $_POST['description'])==null){
      $_SESSION['error_messages'][] = "Error updating description";
    }

  }
  if($_POST['price']){

    if(updatePrice( $propertyID, $_POST['price'])==null){
      $_SESSION['error_messages'][] = "Error updating price";
    }

  }

  header("Location: ../pages/addPropertyExtras.php?propertyID=$propertyID");
  
?>
