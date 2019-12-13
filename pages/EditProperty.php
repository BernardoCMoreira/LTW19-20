<?php
    include_once('../config/init.php');
    include_once('../database/user.php');
    include_once('../database/property.php');
	include_once('../database/image.php');
	include_once('../database/extra.php');
  

    include ('../templates/commom/header.php');

    if (isset($_SESSION['username'])){
        getUser($_SESSION['username']);

        $propertyID = $_GET['propertyID'];
        $propertyInfo = getPropertyInfo($propertyID);
        $images = getAllImgsProperty($propertyID);
        $extras = getAllExtrasProperty($propertyID);

        include ('../templates/editProperty.php');
    }
    else  
        header('Location: ../pages/register.php');  
      
    include ('../templates/commom/footer.php');
?>