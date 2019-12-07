<?php
  include_once('../config/init.php');
  include_once('../database/user.php');

  $userID = getUser($_SESSION['username'])['userID'];

  if($_FILES["fileToUpload"]["name"]){
    
    $target_dir = "../images/";
    $originalName = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($originalName,PATHINFO_EXTENSION);
    $target_file = $target_dir . $userID . "_user." . $imageFileType ;
    $uploadOk = 1;
  
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      $_SESSION['error_messages'][] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
  
    //Overide previous picture
    if (file_exists($target_file)) {
      unlink($target_file);
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $_SESSION['error_messages'][] = "Error uploading photo";

    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        if(updatePhoto( $userID,  $userID . "_user." . $imageFileType)==null){
          $_SESSION['error_messages'][] = "Error uploading photo";
        }

      } else {
        $_SESSION['error_messages'][] = "Error uploading photo";
      }
    }
  }
  if($_POST['name']){

    if(updateName( $userID, $_POST['name'])==null){
      $_SESSION['error_messages'][] = "Error updating name";
    }

  }
  header('Location: ../pages/user.php');  
  
?>
