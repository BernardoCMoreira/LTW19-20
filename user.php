<?php
    include ('templates/header.php');
?>

    <br>
    <div class="userprofile">
    <div class="profile_photo">
		<img src="../images/user.png" alt="Logo " width="150" height="150" />
    <br>
		<label for ="picture">Picture:</label>
		<input type="file" id="picture" name="picture"/>
    </div>
    <div class="username">
    <label for="name" >Name:</label>
    <input type="text" id=name name="name" placeholder="Inser your name"/>
    </div>
    <div class="Country">
    <label for="country">Country:</label>
    <select id=country name="country">
        <option value="faro">Portugal</option>
        <option value="lisboa">Spain</option>
        <option value="aveiro">EUA</option>
        <option value="porto">France</option>
    </select>
    </div>
    <div class="City">
    <label for="city">City:</label>
    <select id=city name="city">
        <option value="faro">Faro</option>
        <option value="lisboa">Lisboa</option>
        <option value="aveiro">Aveiro</option>
        <option value="porto">Porto</option>
        <option value="bragança">Bragança</option>
        <option value="santarém">Santarém</option>
        <option value="Coimbra">Coimbra</option>
        <option value="Covilha">Covilhã</option>
    </select>
    </div>
    <div class="description">
    <label for="descprition">Description:</label>
    <textarea  id="descprition" name = "descprition" placeholder="Inser a descprition about yourself" style="height:150px"/></textarea>
    <input type="submit" value="Done">
	 </div>
  </div>

<?php
    include ('templates/footer.php');
?>