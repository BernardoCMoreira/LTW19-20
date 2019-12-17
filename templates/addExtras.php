<br>
<div class=property>
<<<<<<< HEAD

<?='<h1>' . $propertyInfo['address'] . '</h1>';?>
=======
	<?= '<h1>' . $propertyInfo['address'] . '</h1>'; ?>
>>>>>>> 9804f63f83439ca290439218e6023b13bf45d034
	<ul class="imgs">
		<?php
		foreach ($images as $image)
			if ($image['aproved'])
				printPImage($image);
		?>
	</ul>
	<div class="information">
		<div class="principal">
			<h3>Information</h3>
			<?= '<p>' . $propertyInfo['city'] . ', ' . $propertyInfo['country'] . '</p>'; ?>
			<?= '<p>Bedrooms: ' . $propertyInfo['numQuartos'] . '</p>' ?>
			<?= '<p>Description: ' . $propertyInfo['description'] . '</p>' ?>
			<?= '<p>Price Per Day: ' .  $propertyInfo['price'] . '</p>' ?>
		</div>
		<?php
			if ($extras != null) { ?>
			<div class="extra">
				<h3>Extras</h3>
				<?php
				foreach ($extras as $extra)
					echo '<p>' . $extra['name'] . '</p>';
				?>
			</div>
		<?php } ?>
	</div>
	<br>
	<div class="addProperty">
		<form action="../actions/action_add_extras.php" method="post">

			<div class="extra">
				<label>Extra:</label>
				<input type="text" name="extra" placeholder="extra">
				<?php echo '<input type="hidden" name="propertyID" value=' . $propertyID . '>'; ?>
			</div>

			<input type="submit" value="Add">
			<input type="button" value="Done" onclick="window.location.href='../pages/user.php'" />
		</form>
	</div>
</div>