<br>
<div class="userprofile">
  <form>
    
    <div class="username">
      <p>@<?=$user['username']?></p>
    </div>
  
    <div class="profile_photo">
      <?php 
        printUImage($image);
      ?>
    </div>

    <div class="user_info">
      <div class="name">
        <p> <?=$user['name']?></p>
      </div>
      
      <div class="email">
        <p><?=$user['email']?></p>
      </div>

      <div class="description">
        <p><?=$user['description']?></p>
      </div>
    </div>

    <input type="button" value="Edit Profile" onclick="window.location.href='../pages/userEdit.php'" />
    <input type="button" value="Add New Property" onclick="window.location.href='../pages/addProperty.php'" />
  </form>
</div>