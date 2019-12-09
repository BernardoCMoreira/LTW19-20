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

	function displayUserSProperty($property) {
        echo '<h1> <a href="../pages/viewProperty.php?propertyID=' . $property['propertyID'] . '">' . $property['address'] . '</a></h1>';
	}

	function displayPropertySRent($rent) {
		echo '<div class="rent">';
		echo 	'<p><a href="../pages/viewProperty.php?propertyID=' . $rent['propertyID']. '"> View Property </a></p> ';
		echo 	'<p><a href="../pages/user.php?userID=' . $rent['touristID']. '"> View Tourist </a></p> ';
		echo 	'<p>Start date: ' . $rent['startDate'] . '</p>';
		echo 	'<p>End date: ' . $rent['endDate'] . '</p>';
		echo 	'<p>Last date to cancel: ' . $rent['cancelLimitDay'] . '</p>';
    	echo 	'<p>Price: ' .  $rent['price'] . '</p>';
		echo '</div>';
	}


	function getAllTouristRentsFromUser($username) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM rent, property WHERE touristID = (
			SELECT userID FROM user WHERE username = ?)
			AND rent.propertyID = property.propertyID');
		$stmt->execute(array($username));
		return $stmt->fetchAll();
	}

	function displaytouristSRent($rent) {
		echo '<div class="rentInfo">';
		echo 	'<p><a href="../pages/viewProperty.php?propertyID=' . $rent['propertyID']. '"> View Property </a></p> ';
		echo 	'<p><a href="../pages/user.php?userID=' . $rent['ownerID']. '"> View Owner </a></p> ';
		echo 	'<p>Start date: ' . $rent['startDate'] . '</p>';
		echo 	'<p>End date: ' . $rent['endDate'] . '</p>';
		echo 	'<p>Last date to cancel: ' . $rent['cancelLimitDay'] . '</p>';
    	echo 	'<p>Price: ' .  $rent['price'] . '</p>';
		echo '</div>';	
	}

?>
