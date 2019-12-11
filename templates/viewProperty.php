<br>
<div class=property>
<?='<h1>' . $propertyInfo['address'] . '</h1>';?>
	<ul class="imgs">
<?php
	foreach($images as $image)
		if($image['aproved'])
			echo '<li><img src="../images/' . $image['imageID'] . '.jpg" alt="house " width="500" height="300"></li>';
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
	</div>
	<input type="submit" value="Rent">
</div>

<script>
	var startDate = new Date(document.getElementById('startDate').value);
	var endDate = new Date(document.getElementById('endDate').value);
	
	document.getElementById("startDate").onchange = function(event) {
		startDate = new Date(document.getElementById('startDate').value);
		updateTotalPrice();
	}

	document.getElementById("endDate").onchange = function(event) {
		endDate = new Date(document.getElementById('endDate').value);
		updateTotalPrice();
	}

	function updateTotalPrice() {
		const dateDifference = (endDate.getTime() - startDate.getTime())/(24*60*60*1000);
		console.log("Date diference: " + dateDifference);

		var totalPriceElement = document.getElementById("totalPrice");
		totalPriceElement.innerHTML = "";
		let paragraph = document.createElement("h2");

		const pricePerDay = "<?= $propertyInfo['price'] ?>";
		const totalPrice = pricePerDay * dateDifference;
		paragraph.innerHTML = "Total Price: " + totalPrice;
		totalPriceElement.appendChild(paragraph);
	}
</script>