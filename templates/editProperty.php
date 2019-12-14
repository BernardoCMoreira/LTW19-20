<br>
<div class="addProperty">
  <form action="../actions/action_edit_property.php" method="post" enctype="multipart/form-data">
    
    <div class="property_photo">
    <?php
	foreach($images as $image)
    if($image['aproved'])
      printImage($image);
    ?>
      <label>Add photo:</label>
      <input type="file" name="fileToUpload" id="fileToUpload">
    </div>

    <div class="address">
      <label>Address:</label>
      <input type="text" name="address"  placeholder="<?=$propertyInfo['address']?>">
    </div>

    <div class="city">
      <label>City:</label>
      <input type="text" name="city" placeholder="<?=$propertyInfo['city']?>">
    </div>

    <div class="country">
      <label>Country:</label>
      <input type="text" name="country" placeholder="<?=$propertyInfo['country']?>">
    </div>

    <div class="numQuartos">
      <label>Number of bedrooms:</label>
      <input type="number" name="numQuartos" min="0" max="20" placeholder="<?=$propertyInfo['numQuartos']?>">
    </div>

    <div class="description">
      <label>Description:</label>
      <input type="text" name="description" placeholder="<?=$propertyInfo['description']?>">
    </div>
  
    <div class="price">
      <label>Price:</label>
      <input type="number" name="price"  min="0"  placeholder="<?=$propertyInfo['price']?>">
    </div>
    <input type="hidden" name="propertyID" value="<?=$propertyInfo['propertyID']?>">
    <input type="submit" value="Done">
  </form>
</div>