<?php
  session_start();
  
  include_once('messages.php');

  $conn = new PDO('sqlite:../database/database.db');

  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
