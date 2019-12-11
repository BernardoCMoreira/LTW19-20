<br>
<div class=property>
<?='<h1>' . $propertyInfo['address'] . '</h1>';?>
	<ul class="imgs">
<?php
	foreach($images as $image)
		if($image['aproved'])
			echo '<li><img src="../images/' . $image['imageID'] . $image['type'] . '" alt="house " width="500" height="300"></li>';
?>
	</ul>
	<div class="dates">
		<label for="date"> Starting Date</label><br>
		<input type="date" id="startDate" name="date" value="<?php echo date("Y-m-d"); ?>">
		<br>
		<br>
		<label for="date"> End Date</label><br>
		<input type="date" id="endDate" name="date" value="<?php echo date("Y-m-d", time()+ 24*60*60); ?>">
		<br>
	</div>
	<div class="information">
		<div class="principal">
			<h3>Information</h3>
<?=			'<p>' . $propertyInfo['city'] . ', ' . $propertyInfo['country'] . '</p>';?>
<?= 		'<p>Bedrooms: ' . $propertyInfo['numQuartos'] . '</p>'?>
<?= 		'<p>Description: ' . $propertyInfo['description'] . '</p>'?>
<?= 		'<p>Price Per Day: ' .  $propertyInfo['price'] . '</p>'?>
		</div>
		<div class="extra">
			<h3>Extras</h3>
			<p>Wi-Fi</p>
			<p>TV</p>
			<p>Kitchen</p>
		</div>
	</div>
	<div id="totalPrice">
<?= 	'<h2>Total Price: ' .  $propertyInfo['price'] . '€ </h2>'?>
	</div>
	<input type="submit" value="Rent">
</div>