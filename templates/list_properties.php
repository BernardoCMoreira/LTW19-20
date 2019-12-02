<?php

    include_once('../config/init.php');
    include_once('../database/image.php');

    foreach( $properties as $property){
        $imgs = getAllImgsProperty( $property['propertyID']);?>
        <article id="feed">
            <h1><?= $property['address'] ?></h1>
            <p>propertyID: <?= $property['propertyID'] ?></p>
            <p>ownerID: <?= $property['ownerID'] ?></p>
            <p>city: <?= $property['city'] ?></p>
            <p>country: <?= $property['country'] ?></p>
            <p>numQuartos: <?= $property['numQuartos'] ?></p>
            <p>description: <?= $property['description'] ?></p>
            <p>price: <?= $property['price'] ?></p>
            <ul class="imgs">
                <?php foreach ($imgs as $img) {
                    $src_img = "../images/" .  $img['imageID']  . ".jpg"; ?>
                    <li>
                        <img src=<?= $src_img ?> alt="house " width="500" height="300" />
                    </li>
                <?php } ?>
            </ul>
        </article>
    <?php }
?>