<?php
  include_once('../config/init.php');
  include_once('../database/user.php');
  include_once('../database/image.php');
  
  
  $username = trim(strip_tags($_POST['username']));
  $email = trim(strip_tags($_POST['email']));
  $password = $_POST['password'];  
  $name = trim(strip_tags($_POST['name']));

  $userID = createUser($username, $email, $password, $name);
  createImg($userID, 'user', '.jpg');

  
  header('Location: ../pages/mainPage.php');  
?>
