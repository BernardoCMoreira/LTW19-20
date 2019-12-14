<?php
  function getLenghtProperties() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT COUNT(*) FROM property');
    $stmt->execute();
    $num = $stmt->fetch();
    return $num['COUNT(*)'];
  }

  function createProperty($ownerID, $address, $city, $country, $numQuartos, $description, $price) {
    global $conn;  
    $propertyID = getLenghtProperties() +1;

    $stmt = $conn->prepare('INSERT INTO property VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($propertyID, $ownerID, $address, $city, $country, $numQuartos, $description, $price));
    return $propertyID;
  }

  function getAllProperties() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT * FROM property');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function getRandomNumberOfProperties($numberOfProperties) {
    global $conn;
    
    $stmt = $conn->prepare('SELECT * FROM property ORDER BY random() LIMIT ?');
    $stmt->execute(array($numberOfProperties));
    return $stmt->fetchAll();
  }

	function displayProperty($property) {
		$img = getFirstImgOfProperty( $property['propertyID']);
		$src_img = "../images/" .  $img['imageID']  .  $img['type'];

		echo '<article>';
        echo '<h1> <a href="../pages/viewProperty.php?propertyID=' . $property['propertyID'] . '">' . $property['address'] . '</a></h1>';
        echo '<p>Location: ' . $property['city'] . ', ' . $property['country'] . '</p>';
        echo '<p>Number of bedrooms: ' .  $property['numQuartos'] . '</p>';
        echo '<p>Description: ' .  $property['description'] . ' </p>';
    	echo '<p>Price: ' .  $property['price'] . '</p>';
	    echo '<ul class="imgs">';
		echo '<li>';
		echo '<img src=' . $src_img . ' alt="house" width="500" height="300" />';
		echo '</li>';
		echo '</ul>';
		echo '</article>';
	}

  	function getPropertyInfo($propertyID) {
    	global $conn;
    
      $stmt = $conn->prepare('SELECT * FROM property WHERE propertyID = ?');
		  $stmt->execute(array($propertyID));
    	return $stmt->fetch();  
	}

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
    
    $stmt = $conn->prepare('SELECT DISTINCT city FROM property ORDER BY city ASC');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function getAllBedrooms() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT DISTINCT numQuartos FROM property ORDER BY numQuartos ASC');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function getMaxPrice() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT DISTINCT max(price) AS max FROM property');
    $stmt->execute();
    $max = $stmt->fetch();
    return $max['max']; 
  }

  function getMinPrice() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT DISTINCT min(price) AS min FROM property');
    $stmt->execute();
    $min = $stmt->fetch();
    return $min['min']; 
  }

  function updateAddress($propertyID, $address) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE property SET address = ? WHERE propertyID = ?');
      if($stmt->execute(array($address, $propertyID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 

  function updateCity($propertyID, $city) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE property SET city = ? WHERE propertyID = ?');
      if($stmt->execute(array($city, $propertyID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 

  function updateCountry($propertyID, $country) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE property SET country = ? WHERE propertyID = ?');
      if($stmt->execute(array($country, $propertyID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 

  function updateNumQuartos($propertyID, $numQuartos) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE property SET numQuartos = ? WHERE propertyID = ?');
      if($stmt->execute(array($numQuartos, $propertyID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 

  function updatePDescription($propertyID, $description) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE property SET description = ? WHERE propertyID = ?');
      if($stmt->execute(array($description, $propertyID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 

  function updatePrice($propertyID, $price) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE property SET price = ? WHERE propertyID = ?');
      if($stmt->execute(array($price, $propertyID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 
?>