<?php
  include_once('../config/init.php');
  include_once('../database/user.php');

  $userID = getUser($_SESSION['username'])['userID'];
  $user_photo = getUser($_SESSION['username'])['photo'];

  if($_FILES["fileToUpload"]["name"]){
    
    // Generate filename
    $target_dir = "../images/";
    $originalName = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($originalName,PATHINFO_EXTENSION);
    $target_file = $target_dir . $userID . "_user." . $imageFileType ;

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "jfif"
    && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF" && $imageFileType != "JFIF") {
      $_SESSION['error_messages'][] = "Sorry, only JPG, JPEG, JFIF, PNG & GIF files are allowed.";
    }else{
      
      // delete past photo
      if($user_photo != 'default_user.jpg'){
        if (file_exists($target_dir . $user_photo)) {
          unlink($target_dir . $user_photo);
        }
      }

      // Move the uploaded file to its final destination
      move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

      // Insert image data into database
      if(updatePhoto( $userID,  $userID . "_user." . $imageFileType)==null){
        $_SESSION['error_messages'][] = "Error uploading photo";
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
