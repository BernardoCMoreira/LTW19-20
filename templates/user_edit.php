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

    <div class="edit_username">
      <label>Username:</label>
      <input type="text" name="username" placeholder="<?=$user['username']?>">
      <span class="hint">At least 3 characters</span>  
    </div>

    <div class="edit_password">
      <label>Password:</label>
      <input type="password" name="password" placeholder="¯\_(ツ)_/¯"> 
      <span class="hint">One uppercase, 1 symbol, 1 number, at least 8 characters</span> 
    </div>

    <div class="edit_name">
      <label>Name:</label>
      <input type="text" name="name" placeholder="<?=$user['name']?>">  
    </div>

    <div class="edit_email">
    <label>email:</label>
      <input type="text" name="email" placeholder="<?=$user['email']?>">  
      <span class="hint">Invalid email</span>
    </div>

    <div class="edit_description">
    <label>Description:</label>
      <input type="text" name="description" placeholder="<?=$user['description']?>">  
    </div>
  
    <input type="submit" value="Done">
  </form>
</div>