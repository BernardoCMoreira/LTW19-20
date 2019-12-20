<?php
	include_once('../config/init.php');
	include_once('../database/property.php');
	
	$city_options = getAllCities();
	$bedroom_options = getAllBedrooms();
	$maxPrice = getMaxPrice();
	$minPrice = getMinPrice();

	if(!isset($startdate)) 
		$startdate = null;
	if(!isset($enddate)) 
		$enddate = null;
	if(!isset($bedrooms)) 
		$bedrooms = "-";
	if(!isset($local)) 
		$local = "-";
	if(!isset($price))
		$price = $maxPrice;
	
?>

    <div class="searchbar">
		<form action="searchPage.php" method="get">
			<label for="date"> Starting Date</label><br>
			<input type="date" id="date" name="startdate" value=<?=$startdate?> >
			<br>
			<br>
			<label for="date"> End Date</label><br>
			<input type="date" id="date" name="enddate" value=<?=$enddate?> >
			<br>
			<br>
        	<label for="bedrooms"> Bedrooms</label>
        	<br>
        	<select id="bedrooms" name="bedrooms">
				<option value="-"
					<?php if($bedrooms == "-"): ?> selected="selected"<?php endif;?>>-
				</option>
        	    <?php foreach ($bedroom_options as $numQuartos) {
        	        $numQuartos = $numQuartos['numQuartos'];?>
        	    <option value=<?=$numQuartos?><?php if ($bedrooms == $numQuartos) : 
        	            ?> selected="selected" <?php endif; ?>><?=$numQuartos?>
        	    </option>
        	    <?php } ?>
        	</select>
        	<br>
        	<br>
        	<label for="local">Location</label>
			<br>
			<select id="local" name="local" size="1">
    		<option value="-" <?php if($local == "-"):
    			?> selected="selected"<?php endif;?>>-</option>

    			<?php foreach ($city_options as $city) {
    			    $city = $city['city'];
    			    ?>
    			    <option value="<?=$city?>"<?php if ($local == $city) : 
    			        ?> selected="selected" <?php endif; ?>><?=$city?>
    			    </option>
    			<?php } ?>
			</select>
			<br>
        	<br>
        	<label for="price">Max.Price Per Day</label><br>
        	<input type="number" id="price" name="price"
        	    min= <?= $minPrice ?>
        	    max= <?= $maxPrice ?>
        	    value=<?= $price ?>>
				<br>
				<br>
        	<input type="submit" value="Search">
    	</form>
	</div>	