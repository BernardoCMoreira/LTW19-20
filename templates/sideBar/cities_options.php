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
