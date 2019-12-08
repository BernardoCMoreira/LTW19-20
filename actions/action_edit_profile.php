<?php
  include_once('../config/init.php');
  include_once('../database/user.php');

  $userID = getUser($_SESSION['username'])['userID'];
  $user_photo = getUser($_SESSION['username'])['photo'];

  if($_FILES["fileToUpload"]["name"]){
    
    $target_dir = "../images/";
    $originalName = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($originalName,PATHINFO_EXTENSION);
    $target_file = $target_dir . $userID . "_user." . $imageFileType ;
    $uploadOk = 1;
  
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"
    && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF" ) {
      $_SESSION['error_messages'][] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    else{
      //Overide previous picture
      if($user_photo != 'default_user.jpg'){
        if (file_exists($target_dir . $user_photo)) {
          unlink($target_dir . $user_photo);
        }
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
  }
  if($_POST['username']){

    if(updateUsername( $userID, $_POST['username'])==null){
      $_SESSION['error_messages'][] = "Error updating username";
    }
    else{
      $_SESSION['username'] = $_POST['username'];
    }

  }
  if($_POST['password']){

    if(updatePassword( $userID, $_POST['password'])==null){
      $_SESSION['error_messages'][] = "Error updating password";
    }

  }
  if($_POST['name']){

    if(updateName( $userID, $_POST['name'])==null){
      $_SESSION['error_messages'][] = "Error updating name";
    }

  }
  if($_POST['email']){

    if(updateEmail( $userID, $_POST['email'])==null){
      $_SESSION['error_messages'][] = "Error updating email";
    }

  }
  if($_POST['description']){

    if(updateDescription( $userID, $_POST['description'])==null){
      $_SESSION['error_messages'][] = "Error updating description";
    }

  }
  header('Location: ../pages/user.php');  
  
?>
