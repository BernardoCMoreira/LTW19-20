<br>
<div class="addProperty">
  <form action="../actions/action_add_property.php" method="post" enctype="multipart/form-data">
    
    <div class="property_photo">
      <?php 
        $src_img = "../images/default.png";
        echo '<img src=' . $src_img . ' alt="Logo " width="150" height="150" />'; 
      ?>
      <input type="file" name="fileToUpload" id="fileToUpload">
    </div>

    <div class="address">
      <label>Address:</label>
      <input type="text" name="address" placeholder="address" required>
    </div>

    <div class="city">
      <label>City:</label>
      <input type="text" name="city" placeholder="city" required>
    </div>

    <div class="country">
      <label>Country:</label>
      <input type="text" name="country" placeholder="country" required>
    </div>

    <div class="numQuartos">
      <label>Number of bedrooms:</label>
      <input type="number" name="numQuartos" min="0" max="20" placeholder="number" required>
    </div>

    <div class="description">
      <label>Description:</label>
      <input type="text" name="description" placeholder="description">
    </div>
  
    <div class="price">
      <label>Price:</label>
      <input type="number" name="price"  min="0"  placeholder="price" required>
    </div>
  
    <input type="submit" value="Done">
  </form>
</div>