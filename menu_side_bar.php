<?php
  include_once('config/init.php');
  include_once('database/property.php');

  $city_options = getAllCities();
  $bedroom_options = getAllBedrooms();

  if (!isset($bedrooms)) 
    $bedrooms = "-";
  if (!isset($local)) 
    $local = "-";

  include ('templates/start_menu_bar.php');
  include ('templates/bedrooms_options.php');
  include ('templates/cities_options.php');
  include ('templates/end_menu_bar.php');

  
?>
