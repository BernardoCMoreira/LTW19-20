<?php
    include_once('../config/init.php');
    include_once('../database/user.php');
    include_once('../database/image.php');
  
    $pageTitleExtra = "Edit User";
    include ('../templates/commom/header.php');

    if (isset($_SESSION['username'])){
      $user = getUser($_SESSION['username']);
      $image = getUserImg($user['userID']);
      include ('../templates/user_edit.php');
    }
    else  
      header('Location: ../pages/register.php');  
      
    include ('../templates/commom/footer.php');
?>