<?php
    include_once('../config/init.php');
    include_once('../database/user.php');
    include_once('../database/image.php');

    if (isset($_SESSION['username'])){
    	$pageTitleExtra = "User";
        include ('../templates/commom/header.php');
        $owner =0;
        if(isset($_GET['userID'])){
            $owner =1;
            $user = getUserById($_GET['userID']);
        }
        else{
            $user = getUser($_SESSION['username']);
        }
 
        $image = getUserImg($user['userID']);
    	include ('../templates/user.php');
    	include ('../templates/commom/footer.php');
    }
    else {
    	header('Location: ../pages/register.php');  
    }
?>