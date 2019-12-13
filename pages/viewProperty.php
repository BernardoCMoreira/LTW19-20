<?php
	include_once('../config/init.php');
	include_once('../database/property.php');
	include_once('../database/image.php');
	include_once('../database/extra.php');

	$propertyID = $_GET['propertyID'];
	$propertyInfo = getPropertyInfo($propertyID);
	$images = getAllImgsProperty($propertyID);
	$extras = getAllExtrasProperty($propertyID);

	$pageTitleExtra = "View Property";
	include ('../templates/commom/header.php');
	include ('../templates/viewProperty.php');
	include ('../templates/commom/footer.php');
?>