<?php

    $db = new PDO('sqlite:database.db');

    if (!isset($_GET['bedrooms']))
        die("No bedrooms!");
    $bedrooms = $_GET['bedrooms'];
 
    if (!isset($_GET['local']))
        die("No local!");
    $local = $_GET['local'];

    if (!isset($_GET['price']))
        die("No price!");
    $price = $_GET['price'];

    if($bedrooms == "-" && $local == "-"){
        $stmt = $db->prepare('SELECT * FROM property WHERE price <= ?');
        $stmt->execute(array($_GET['price']));
    }
    else if($bedrooms == "-"){
        $stmt = $db->prepare('SELECT * FROM property WHERE city = ? and price <= ?');
        $stmt->execute(array($_GET['local'], $_GET['price']));
    }
    else if($local == "-"){
        $stmt = $db->prepare('SELECT * FROM property WHERE numQuartos = ? and price <= ?');
        $stmt->execute(array($_GET['bedrooms'], $_GET['price']));
    }
    else{
        $stmt = $db->prepare('SELECT * FROM property WHERE numQuartos = ? and city = ? and price <= ?');
        $stmt->execute(array($_GET['bedrooms'], $_GET['local'], $_GET['price']));
    }
    $properties = $stmt->fetchAll();

    // print_r($properties);

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>
        HomeFull
    </title>
    <meta charset="UTF-8">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
    <link href="../css/feed.css" rel="stylesheet">
</head>

<body>
    <header>
        <h1> <a href="../html/MainPage.html">HomeFull </a></h1>
        <img src="../images/logo.png" alt="Logo " width="150" height="150" />
        <div id="signup">
            <a href="../html/register.html">Register</a>
            <a href="../html/login.html">Login</a>

        </div>
    </header>

    <nav id="menu">
        <ul>
            <li><a href="user.html">User</a></li>
            <li><a href="rents.html">Rents</a></li>
            <li><a href="aboutUs.html">About Us</a></li>
            <li><a href="contacts.html">Contact Us</a></li>
        </ul>
    </nav>

    <div class="mainpage">
        <div class="searchbar">
            <label for="search">Search</label><br>
            <input type="text" id="search" name="search" placeholder="..."><!--<br>
            <input type="submit" value="Find">-->
            <br>
            <br>
            <form action="../database/filter_properties.php" method="get">
                <label for="bedrooms"> Bedrooms</label><br>
                <select id="bedrooms" name="bedrooms">
                    <option value="-" <?php if($bedrooms == "-"):?> selected="selected"<?php endif;?>>-</option>
                    <option value="0" <?php if($bedrooms == "0"):?> selected="selected"<?php endif;?>>T0</option>
                    <option value="1" <?php if($bedrooms == "1"):?> selected="selected"<?php endif;?>>T1</option>
                    <option value="2" <?php if($bedrooms == "2"):?> selected="selected"<?php endif;?>>T2</option>
                    <option value="3" <?php if($bedrooms == "3"):?> selected="selected"<?php endif;?>>T3</option>
                    <option value="4" <?php if($bedrooms == "4"):?> selected="selected"<?php endif;?>>T4</option>
                </select>
                <br>
                <br>
                <label for="local">Location</label><br>
                <select id="local" name="local" size="1">
                    <option value="-" <?php if($local == "-"):?> selected="selected"<?php endif;?>>-</option>
                    <option value="faro"<?php if($local == "Faro"):?> selected="selected"<?php endif;?>>Faro</option>
                    <option value="lisboa"<?php if($local == "Lisboa"):?> selected="selected"<?php endif;?>>Lisboa</option>
                    <option value="aveiro"<?php if($local == "Aveiro"):?> selected="selected"<?php endif;?>>Aveiro</option>
                    <option value="Porto"<?php if($local == "Porto"):?> selected="selected"<?php endif;?>>Porto</option>
                    <option value="bragança"<?php if($local == "Bragança"):?> selected="selected"<?php endif;?>>Bragança</option>
                    <option value="santarém"<?php if($local == "Santarém"):?> selected="selected"<?php endif;?>>Santarém</option>
                    <option value="Coimbra"<?php if($local == "Coimbra"):?> selected="selected"<?php endif;?>>Coimbra</option>
                    <option value="Covilha"<?php if($local == "Covilhã"):?> selected="selected"<?php endif;?>>Covilhã</option>
                    <option value="Vila Nova de Gaia"<?php if($local == "Vila Nova de Gaia"):?> selected="selected"<?php endif;?>>Vila Nova de Gaia</option>
                </select>
                <br>
                <br>
                <label for="price">Max.Price</label><br>
                <input type="range" id="price" name="price" min="1" max="9999"><br>
                
                <input type="submit" value="Search">
            </form>
        </div>


        <article id="feed">
            <?php foreach ($properties as $property) { //print_r($property); ?>
                <h1><?=$property['address']?></h1>
                <p>propertyID: <?=$property['propertyID']?></p>
                <p>ownerID: <?=$property['ownerID']?></p>
                <p>city: <?=$property['city']?></p>
                <p>country: <?=$property['country']?></p>
                <p>numQuartos: <?=$property['numQuartos']?></p>
                <p>description: <?=$property['description']?></p>
                <p>price: <?=$property['price']?></p>
                <?php
                    $stmt = $db->prepare("SELECT * FROM image WHERE propertyID = '".$property['propertyID']."' ");
                    $stmt->execute();
                    $imgs = $stmt->fetchAll();
                    //print_r($imgs);
                    foreach ($imgs as $img) {
                        $src_img = "../images/" .  $img['imageID']  . ".jpg"; ?>
                        <img src= <?=$src_img?> alt="house " width="500" height="300" />
                    <?php } ?>
                <br>
                <br>
            <?php } ?>
        </article>
    </div>
    <footer>
        <p>&copy; HomeFull, 2019</p>
    </footer>
</body>

</html>