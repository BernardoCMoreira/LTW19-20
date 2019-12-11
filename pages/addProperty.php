<?php
    include_once('../config/init.php');
    include_once('../database/user.php');
  

    include ('../templates/commom/header.php');

    if (isset($_SESSION['username'])){
      $user = getUser($_SESSION['username']);
      include ('../templates/addProperty.php');
    }
    else  
      header('Location: ../pages/register.php');  
      
    include ('../templates/commom/footer.php');
?>