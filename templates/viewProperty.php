<br>
<div class=property>
	<?='<h1>' . $propertyInfo['address'] . '</h1>';?>
	<ul class="imgs">
		<?php
		foreach($images as $image)
    		if($image['aproved'])
				printPImage($image);
    ?>
	</ul>
	<form action="../actions/action_add_rent.php" method="post" enctype="multipart/form-data">
		<div class="hiddenInputInfo">
			<input type="hidden" name="propertyID" value=<?= $propertyInfo["propertyID"]?> >
		</div>
		<div class="dates">
			<label for="date"> Starting Date</label>
			<br>
			<input type="date" id="startDate" name="startDate" value="<?php echo date("Y-m-d"); ?>">
			<br>
			<br>
			<label for="date"> End Date</label>
			<br>
			<input type="date" id="endDate" name="endDate" value="<?php echo date("Y-m-d", time()+ 24*60*60); ?>">
			<br>
		</div>
		<div class="information">
			<div class="principal">
				<h3>Information</h3>
				<?='<p>' . $propertyInfo['city'] . ', ' . $propertyInfo['country'] . '</p>';?>
				<?='<p>Bedrooms: ' . $propertyInfo['numQuartos'] . '</p>'?>
				<?='<p>Description: ' . $propertyInfo['description'] . '</p>'?>
				<?='<p>Price Per Day: <span  id="basePrice">' .  $propertyInfo['price'] . '</span> € </p>'?>
			</div>
			<?php
				if($extras != null) {
					echo '<div class="extra">';
					echo '<h3>Extras</h3>';
					foreach($extras as $extra)
						echo '<p>' . $extra['name'] . '</p>';
					echo '</div>';
				}
			?>
		</div>
		<div id="totalPrice">
			<h2>Total Price: <?= $propertyInfo['price']?>€</h2>
		</div>
		<input id="sendButton" type="submit" value="Rent">
		<span id="sendButtonDataErrorMsg" style="display:none"> Dates are not valid </span>
<?php
		if(!isset($_SESSION['username']))
			echo '<span id="sendButtonUserErrorMsg"> User is not logged in </span>';
?>

	</form>
</div>
</div>
<script>
	var startDate = new Date(document.getElementById('startDate').value);
	var endDate = new Date(document.getElementById('endDate').value);

	document.getElementById("startDate").onchange = function(event) {
		startDate = new Date(document.getElementById('startDate').value);
		if(validateDate())
			updateTotalPrice();
	}

	document.getElementById("endDate").onchange = function(event) {
		endDate = new Date(document.getElementById('endDate').value);
		if(validateDate())
			updateTotalPrice();
	}

	function updateTotalPrice() {
		const dateDifference = (endDate.getTime() - startDate.getTime()) / (24 * 60 * 60 * 1000);
		const pricePerDay = document.getElementById("basePrice").innerHTML;
		const totalPrice = pricePerDay * dateDifference;

		var totalPriceElement = document.getElementById("totalPrice");
		totalPriceElement.innerHTML = "<h2>Total Price: " + totalPrice + "€ </h2>";
	}

	function validateDate() {
		let sendButton = document.getElementById("sendButton");
		let sendButtonErrorMsg = document.getElementById("sendButtonDataErrorMsg");
		if(startDate >= endDate) {
			sendButton.disabled = true;
			sendButtonErrorMsg.style.display = 'block';
			return false;
		} else {
			sendButton.disabled = false;
			sendButtonErrorMsg.style.display = 'none';
			return true;
		}
	}
</script>