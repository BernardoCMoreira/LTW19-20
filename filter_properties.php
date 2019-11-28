<?php
  include_once('config/init.php');
  include_once('database/property.php');

  $bedrooms = $_GET['bedrooms'];
  $local = $_GET['local'];
  $price = $_GET['price'];

  $properties = getAllPropertiesFilter($bedrooms, $local, $price); 

  include ('templates/header.php');
  include ('menu_side_bar.php');
  ?><article><?php
  include ('list_properties.php');
  ?></article><?php
  ?></div><?php
  include ('templates/footer.php');
  
?>
