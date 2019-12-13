<?php
  include_once('../config/init.php');
  include_once('../database/property.php');

  $bedrooms = $_GET['bedrooms'];
  $local = $_GET['local'];
  $price = $_GET['price'];

  $properties = getAllPropertiesFilter($bedrooms, $local, $price); 
 
  $pageTitleExtra = "Search Page";
  include ('../templates/commom/header.php');
  echo '<div class="mainpage"> ';
  include ('../templates/search_menu.php');
  include ('../templates/list_properties.php');
  echo '</div>';
  include ('../templates/commom/footer.php');
?>
