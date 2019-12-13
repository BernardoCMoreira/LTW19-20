<?php
	include_once('../config/init.php');

	$pageTitleExtra = "Main Page";
	include ('../templates/commom/header.php');
	echo '<div class="mainpage">';
	include ('../templates/search_menu.php');

	include_once('../database/property.php');
	include_once('../database/image.php');
	$properties = getRandomNumberOfProperties(3);

	echo '<div class="results">';
	foreach($properties as $property) {
		displayProperty($property);
	}
	echo '</div>';
	echo '</div>';

	include ('../templates/commom/footer.php');
?>
