<?php
	include_once('../config/init.php');
	include_once('../database/rents.php');

	$pageTitleExtra = "Rents";
	if (isset($_SESSION['username'])){
		include ('../templates/commom/header.php');
		include ('../templates/rents.php');
		include ('../templates/commom/footer.php');
	} else {
    	header('Location: ../pages/login.php');  
    }
?>
