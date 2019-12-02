<?php
	include_once('../config/init.php');
	include_once('../database/property.php');
	
	$city_options = getAllCities();
	$bedroom_options = getAllBedrooms();
	$maxPrice = getMaxPrice();
	$minPrice = getMinPrice();

	if(!isset($bedrooms)) 
		$bedrooms = "-";
	if(!isset($local)) 
		$local = "-";
	if(!isset($price))
    	$price = ($maxPrice + $minPrice) /2;
?>

<div class="mainpage">
    <div class="searchbar">
        <label for="search">Search</label><br>
        <input type="text" id="search" name="search" placeholder="...">
        <input type="submit" value="Find">
        <br>
        <br>
        <form action="searchPage.php" method="get">
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
        	<input type="submit" value="Search">
    	</form>
	</div>	
</div>	