<br>
<div class=rents>
	<div class=owns>
		<h3>Owner properties</h3>
<?php
	if(isset($_SESSION['username'])) {
		$properties = getAllPropertiesFromUsername($_SESSION['username']);
		foreach($properties as $property) {
			echo '<div class=propertyInfo>';
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
		<h3>Rented </h3>
<?php
	if(isset($_SESSION['username'])) {
		$rents = getAllTouristRentsFromUser($_SESSION['username']);
		foreach($rents as $rent) {
			displaytouristSRent($rent);
		}
	}
?>

	</div>
</div>