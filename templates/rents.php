<br>
<div class=rents>
	<div class=owns>
		<h3>Owner houses</h3>
<?php
	if(isset($_SESSION['username'])) {
//		$properties = getAllPropertiesFromUsername($_SESSION['username']);
		$properties = getAllPropertiesFromUsername("andreRestivo");
		foreach($properties as $property) {
			echo '<div id=property' . $property["propertyID"] . '>';
			displayUserSProperty($property);
			$rents = getAllRentsOfProperty($property);
			foreach($rents as $rent) {
				displayPropertySRent($rent);
			}
			echo '</div>';
		}
	}
?>
	</div>

	<div class=rented>
		<h3>Rented houses</h3>

<?php
	if(isset($_SESSION['username'])) {
//		$rents = getAllTouristRentsFromUser($_SESSION['username']);
		$rents = getAllTouristRentsFromUser("andreRestivo");
		foreach($rents as $rent) {
			echo '<div id=rent' . $rent["rentID"] . '>';
			displayPropertySRent($rent);
			echo '</div>';
		}
	}
?>

	</div>
</div>