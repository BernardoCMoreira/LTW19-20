<?php
    include_once('../config/init.php');
    include_once('../database/user.php');
    
    
    if (isset($_SESSION['username'])){
      $pageTitleExtra = "User";
      include ('../templates/commom/header.php');
      $user = getUser($_SESSION['username']);
      include ('../templates/user.php');
      include ('../templates/commom/footer.php');
    }
    else  
      header('Location: ../pages/register.php');  
      
?>