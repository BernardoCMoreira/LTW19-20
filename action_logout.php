<?php
  include_once('config/init.php');

  session_destroy();
  
  session_start();
  $_SESSION['success_messages'][] = "User logged out!";
  
  header('Location: MainPage.php');   
?>
