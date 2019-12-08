<br>
<div class="userprofile">
  <form>
    <div class="profile_photo">
      <?php 
        $src_img = "../images/" .  $user['photo'];
        echo '<img src=' . $src_img . ' alt="Logo " width="150" height="150" />'; 
      ?>
    </div>
    
    <div class="name">
      <p>Name: <?=$user['name']?></p>
    </div>
    
    <input type="button" value="Edit" onclick="window.location.href='../pages/userEdit.php'" />

    <input type="submit" value="Add New Property">
  </form>
</div>