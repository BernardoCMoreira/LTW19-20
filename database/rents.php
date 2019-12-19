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

	function isPropertyAvalableFromTo($propertyID, $startDate, $endDate) {
		global $conn;
		
		$stmt = $conn->prepare('SELECT COUNT(*) AS count FROM rent
			WHERE propertyID = :propertyID
			AND ((startDate <= :endDate AND :endDate <= endDate)
			OR (startDate <= :startDate AND :endDate <= startDate))');
		$stmt->bindParam(':startDate', $startDate);
		$stmt->bindParam(':endDate', $endDate);
		$stmt->bindParam(':propertyID', $propertyID);
		$stmt->execute();
		$result = $stmt->fetch();
		return $result['count'] == 0;
	}

	function getPropertiesAvalableFromTo($properties, $startDate, $endDate) {
		$properties_final = array();
		if( $startDate > $endDate) return $properties_final;

		foreach ($properties as $p) {
		  if( isPropertyAvalableFromTo($p['propertyID'], $startDate, $endDate));
				array_push($properties_final,$p );
		  
		}
		return $properties_final;
	}

	function isUserFreeFromTo($touristID, $startDate, $endDate) {
		global $conn;
		
		$stmt = $conn->prepare('SELECT COUNT(*) AS count FROM rent
			WHERE touristID = :touristID
			AND ((startDate <= :endDate AND :endDate <= endDate)
			OR (startDate <= :startDate AND :endDate <= startDate))');
		$stmt->bindParam(':touristID', $touristID);
		$stmt->bindParam(':startDate', $startDate);
		$stmt->bindParam(':endDate', $endDate);
		$stmt->execute();
		$result = $stmt->fetch();

		return $result['count'] == 0;
	}

	function calculatePrice($propertyID, $startDate, $endDate) {
		global $conn;

		$days = (strtotime($endDate) - strtotime($startDate)) / (24*60*60);
		
		$stmt = $conn->prepare('SELECT price FROM property WHERE propertyID = ?');
		$stmt->execute(array($propertyID));
		$result = $stmt->fetch();
		$pricePerDay = $result['price'];

		return $pricePerDay * $days;
	}

	function createRent($propertyID, $touristID, $startDate, $endDate, $maxCancelDate, $price) {
		global $conn;

		$stmt = $conn->prepare('SELECT COUNT(rentID) as count FROM rent');
		$stmt->execute();
		$result = $stmt->fetch();
		$newRendID = $result['count'] +1; 

		$stmt = $conn->prepare('INSERT INTO rent VALUES (?, ?, ?, ?, ?, ?, ?)');
		$stmt->execute(array($newRendID, $propertyID, $touristID, $startDate, $endDate, $maxCancelDate, $price));
		return $newRendID;
	}

	function deleteRent($rentID) {
		global $conn;

		$stmt = $conn->prepare('DELETE FROM rent WHERE rentID = ?');
		$stmt->execute(array($rentID));
	}

	function getRentInfo($rentID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM rent WHERE rentID = ?');
		$stmt->execute(array($rentID));
		return $stmt->fetch();
	}

	function getOwnerID($rentID) {
		global $conn;

		$stmt = $conn->prepare('SELECT property.ownerID AS ownerID FROM rent, property
			WHERE rentID = ? AND rent.propertyID = property.propertyID');
		$stmt->execute(array($rentID));
		$result = $stmt->fetch();
		return $result['ownerID'];
	}

	function displayUserSProperty($property) {
		echo '<h2> <a href="../pages/viewProperty.php?propertyID=' . $property['propertyID'] . '">' . $property['address'] . '</a> </h2>';
		echo '<a id="editRents" href="../pages/editProperty.php?propertyID=' . $property['propertyID'] . '"> Edit </a>';
	}

	function displayPropertySRent($rent) {
		$daysOfRent = (strtotime($rent['endDate']) - strtotime($rent['startDate'])) / (24*60*60);

		echo '<div class="rent">';
		echo '	<div class="tourist">';
		echo '		<p><a href="../pages/user.php?userID=' . $rent['touristID']. '"> View Tourist </a></p> ';
		echo '	</div>';
		echo '	<div class="status"> Status: ' . getRentStatus($rent['rentID']) . '</div>';
		echo '	<p>Start date: ' . $rent['startDate'] . '</p>';
		echo '	<p>End date: ' . $rent['endDate'] . '</p>';
		echo '	<p>Last date to cancel: ' . $rent['cancelLimitDay'] . '</p>';
		echo '	<p>Price: ' .  $rent['price']*$daysOfRent . '</p>';
		if(time() < strtotime($rent['startDate'])) {
			echo '	<form action="../actions/action_cancel_rent.php" method="post" enctype="multipart/form-data">';
			echo '		<input type="hidden" name="rentID" value="' . $rent["rentID"] . '">';
			echo '		<input class="cancelRentButton" type="submit" value="Cancel">';
			echo '	</form>';
		}
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
		$daysOfRent = (strtotime($rent['endDate']) - strtotime($rent['startDate'])) / (24*60*60);

		echo '<div class="rentInfo">';
		echo '	<h2><a href="../pages/viewProperty.php?propertyID=' . $rent['propertyID']. '">' . $rent['address'] . '</a></h2>';
		echo '	<p><a href="../pages/user.php?userID=' . $rent['ownerID']. '"> View Owner </a></p> ';
		echo '	<div class="status"> Status: ' . getRentStatus($rent['rentID']) . '</div>';
		echo '	<p>Start date: ' . $rent['startDate'] . '</p>';
		echo '	<p>End date: ' . $rent['endDate'] . '</p>';
		echo '	<p>Last date to cancel: ' . $rent['cancelLimitDay'] . '</p>';
		echo '	<p>Price: ' .  $rent['price']*$daysOfRent. '</p>';
		if(time() < strtotime($rent['cancelLimitDay'])) {
			echo '	<form action="../actions/action_cancel_rent.php" method="post" enctype="multipart/form-data">';
			echo '		<input type="hidden" name="rentID" value="' . $rent["rentID"] . '">';
			echo '		<input class="cancelRentButton" type="submit" value="Cancel">';
			echo '	</form>';
		}
		echo '</div>';	
	}

	function getRentStatus($rentID) {
		// Get date in days
		$currentDate = time() / (24*60*60);
		global $conn;

		$stmt = $conn->prepare('SELECT startDate, endDate FROM rent WHERE rentID = ?');
		$stmt->execute(array($rentID));
		$result = $stmt->fetch();
		$startDay = strtotime($result['startDate']) / (24*60*60);
		$endDay = strtotime($result['endDate']) / (24*60*60);

		if($currentDate < $startDay)
			return "Pending";
		else if($currentDate > $endDay)
			return "Concluded";
		else
			return "Ongoing";
	}
?>
