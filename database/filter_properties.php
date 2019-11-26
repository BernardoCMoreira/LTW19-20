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
            <a> ... </a>
            <br>
            <br>
            <label for="bedrooms"> Bedrooms</label><br>
            <a><?=$bedrooms?></a>
            <br>
            <br>
            <label for="local">Location</label><br>
            <a><?=$local?></a>
            <br>
            <br>
            <label for="price">Max.Price</label><br>
            <a><?=$price?></a>
            <br>
            <br>
            <form action="../html/MainPage.html" method="get">
                <input type="submit" value="Back">
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