<?php
  include_once('config/init.php');
  include_once('database/user.php');
  
  $username = trim(strip_tags($_POST['username']));
  $password = $_POST['password'];  

  if (verifyUser($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['success_messages'][] = "Login Successful!";
  }
  else{
    $_SESSION['error_messages'][] = "Login Failed!";
  }
  
  header('Location: MainPage.php');  
?>
