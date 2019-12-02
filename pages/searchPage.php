<?php
  include_once('../config/init.php');
  include_once('../database/property.php');

  $bedrooms = $_GET['bedrooms'];
  $local = $_GET['local'];
  $price = $_GET['price'];

  $properties = getAllPropertiesFilter($bedrooms, $local, $price); 
 
  include ('../templates/commom/header.php');
  include ('../templates/search_menu.php');
  include ('../templates/list_properties.php');
  include ('../templates/commom/footer.php');
?>
