<?php
  include_once('../config/init.php');
  include_once('../database/user.php');
  
  
  $username = trim(strip_tags($_POST['username']));
  $email = trim(strip_tags($_POST['email']));
  $password = $_POST['password'];  
  $name = trim(strip_tags($_POST['name']));

  createUser($username, $email, $password, $name);
  
  header('Location: ../pages/mainPage.php');  
?>
