<?php

	function getAllPropertiesFromUsername($username) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM property WHERE ownerID = (
			SELECT userID FROM user WHERE username = ?)');
		$stmt->execute(array($username));
		return $stmt->fetchAll();
	}

	function getAllRentsOfProperty($property) {
		global $conn;
		$propertyID = $property["propertyID"];

		$stmt = $conn->prepare('SELECT * FROM rent WHERE propertyID = ?');
		$stmt->execute(array($propertyID));
		return $stmt->fetchAll();
	}

	function getAllTouristRentsFromUser($username) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM rent WHERE touristID = (
			SELECT userID FROM user WHERE username = ?)');
		$stmt->execute(array($username));
		return $stmt->fetchAll();
	}

	function displayUserSProperty($property) {
        echo '<h1> <a href="../pages/viewProperty.php?propertyID=' . $property['propertyID'] . '">' . $property['address'] . '</a></h1>';
	}

	function displayPropertySRent($rent) {
		echo '<div id="rent' . $rent["rentID"] . '">';
        echo '<p>RentID: ' . $rent['rentID'] . '</p>';
        echo '<p>PropertyID: ' .  $rent['propertyID'] . '</p>';
        echo '<p>TouristID: ' .  $rent['touristID'] . ' </p>';
    	echo '<p>Price: ' .  $rent['price'] . '</p>';
		echo '</div>';
	}

?>
