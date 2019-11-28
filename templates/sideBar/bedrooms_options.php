<label for="bedrooms"> Bedrooms</label>
<br>
<select id="bedrooms" name="bedrooms">
 
    <option value="-" <?php if($bedrooms == "-"):
        ?> selected="selected"<?php endif;?>>-</option>

    <?php foreach ($bedroom_options as $numQuartos) {
        $numQuartos = $numQuartos['numQuartos'];?>
        <option value=<?=$numQuartos?><?php if ($bedrooms == $numQuartos) : 
            ?> selected="selected" <?php endif; ?>><?=$numQuartos?>
        </option>
    <?php } ?>
</select>
<br>
<br>
