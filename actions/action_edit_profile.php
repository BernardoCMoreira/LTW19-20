<?php
  include_once('../config/init.php');
  include_once('../database/user.php');
  include_once('../database/image.php');

  $userID = getUser($_SESSION['username'])['userID'];
  $imageID = getUserImg($userID)['imageID'];

  if($_FILES["fileToUpload"]["name"]){
    // Generate filename
    $target_dir = "../images/";
    $originalName = basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($originalName,PATHINFO_EXTENSION);

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "jfif"
    && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF" && $imageFileType != "JFIF") {
      $_SESSION['error_messages'][] = "Sorry, only JPG, JPEG, JFIF, PNG & GIF files are allowed.";
    }else{

      // delete past photo 
      $pastName = getUserImg($userID)['name'];
      $pasttype = getUserImg($userID)['type'];
      if($pastName != 'default_user'){
        if (file_exists($target_dir . $pastName .  $pasttype)) {
          unlink($target_dir . $pastName .  $pasttype);
        }
      }

      $imageFileType = '.' . $imageFileType;
      // Insert image data into database
      $target_file = updateImg($userID, 'user', $imageFileType, $imageID);
      if($target_file == null){
        $_SESSION['error_messages'][] = "Error updating photo";
      }
      $target_file = $target_dir . $target_file. $imageFileType;
      // Move the uploaded file to its final destination
      move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

    }
  }
    
  if($_POST['username']){
    $username = trim(strip_tags($_POST['username']));
    if(updateUsername( $userID, $_POST['username'])==null){
      $_SESSION['error_messages'][] = "Error updating username";
    }
    else{
      $_SESSION['username'] = $_POST['username'];
    }

  }
  if($_POST['password']){
    $password = trim(strip_tags($_POST['password']));
    if(updatePassword( $userID, $password)==null){
      $_SESSION['error_messages'][] = "Error updating password";
    }

  }
  if($_POST['name']){
    $name = trim(strip_tags($_POST['name']));
    if(updateName( $userID, $_POST['name'])==null){
      $_SESSION['error_messages'][] = "Error updating name";
    }

  }
  if($_POST['email']){
    $email = trim(strip_tags($_POST['email']));
    if(updateEmail( $userID, $email)==null){
      $_SESSION['error_messages'][] = "Error updating email";
    }

  }
  if($_POST['description']){
    $description = trim(strip_tags($_POST['description']));
    if(updateDescription( $userID, $description)==null){
      $_SESSION['error_messages'][] = "Error updating description";
    }

  }
  header('Location: ../pages/user.php');  
  
?>
