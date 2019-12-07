<br>
<div class="userprofile">
  <form action="../actions/action_edit_profile.php" method="post" enctype="multipart/form-data">
    
  <div class="profile_photo">
      <?php 
        $src_img = "../images/" .  $user['photo'];
        echo '<img src=' . $src_img . ' alt="Logo " width="150" height="150" />'; 
      ?>
      <input type="file" name="fileToUpload" id="fileToUpload">
    </div>

    <div class="name">
        <label>Name:</label>
        <input type="text" name="name" placeholder="<?=$user['name']?>">  
    </div>
  
    <input type="submit" value="Done">
  </form>
</div>