<?php
  function getLenghtProperties() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT COUNT(*) FROM property');
    $stmt->execute();
    $num = $stmt->fetch();
    return $num['COUNT(*)'];
  }

  /*function createProperty($propertyID, $ownerID, $address, $city, $country, $numQuartos, $description, $price) {
    global $conn;  
    $propertyID = getLenghtProperties() +1;

    $stmt = $conn->prepare('INSERT INTO property VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($propertyID, $ownerID, $address, $city, $country, $numQuartos, $description, $price));
  }*/

  function getAllProperties() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT * FROM property');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  /*function getProperty($propertyID) {
    global $conn;
    
    $stmt = $conn->prepare('SELECT * FROM property WHERE propertyID = ?');
    $stmt->execute(array($propertyID));
    return $stmt->fetch();  
  }*/

  function getAllPropertiesFilter($bedrooms, $local, $price) {
    global $conn;
    
    if($bedrooms == "-" && $local == "-"){
      $stmt = $conn->prepare('SELECT * FROM property WHERE price <= ?');
      $stmt->execute(array( $price));
    }
    else if($bedrooms == "-"){
        $stmt = $conn->prepare('SELECT * FROM property WHERE city = ? and price <= ?');
        $stmt->execute(array($local, $price));
    }
    else if($local == "-"){
        $stmt = $conn->prepare('SELECT * FROM property WHERE numQuartos = ? and price <= ?');
        $stmt->execute(array($bedrooms,  $price));
    }
    else{
        $stmt = $conn->prepare('SELECT * FROM property WHERE numQuartos = ? and city = ? and price <= ?');
        $stmt->execute(array($bedrooms, $local, $price));
    }
    return $stmt->fetchAll();
  }

  function getAllCities() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT city FROM property ORDER BY city ASC');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function getAllBedrooms() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT numQuartos FROM property ORDER BY numQuartos ASC');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function getMaxPrice() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT max(price) AS max FROM property');
    $stmt->execute();
    $max = $stmt->fetch();
    return $max['max']; 
  }

  function getMinPrice() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT min(price) AS min FROM property');
    $stmt->execute();
    $min = $stmt->fetch();
    return $min['min']; 
  }

?>
