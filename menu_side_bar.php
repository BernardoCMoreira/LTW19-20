<?php
  include_once('config/init.php');
  include_once('database/property.php');

  $city_options = getAllCities();
  $bedroom_options = getAllBedrooms();
  $maxPrice = getMaxPrice();
  $minPrice = getMinPrice();

  if (!isset($bedrooms)) 
    $bedrooms = "-";
  if (!isset($local)) 
    $local = "-";
  if (!isset($price))
    $price = ($maxPrice + $minPrice) /2;

  include ('templates/sideBar/start_menu_bar.php');
  include ('templates/sideBar/bedrooms_options.php');
  include ('templates/sideBar/cities_options.php');
  include ('templates/sideBar/end_menu_bar.php');

  
?>
