<?php
  include_once('../config/init.php');
  include_once('../database/property.php');
  include_once('../database/rents.php');

  $bedrooms = $_GET['bedrooms'];
  $local = $_GET['local'];
  $price = $_GET['price'];
  $startdate = $_GET['startdate'];
  $enddate = $_GET['enddate'];
  if( $startdate == null || $enddate == null){
    $startdate = null;
    $enddate = null;
  }

  $properties = getAllPropertiesFilter($bedrooms, $local, $price); 
  if($enddate != null) $properties = getPropertiesAvalableFromTo($properties, $startdate, $enddate); 
 
  $pageTitleExtra = "Search Page";
  include ('../templates/commom/header.php');
  echo '<div class="mainpage"> ';
  include ('../templates/search_menu.php');
  include ('../templates/list_properties.php');
  echo '</div>';
  include ('../templates/commom/footer.php');
?>
