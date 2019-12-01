<?php

    include_once('config/init.php');
    include_once('database/image.php');

    foreach( $properties as $property){
        $imgs = getAllImgsProperty( $property['propertyID']);
        include ('templates/list_propriety.php');
    }


?>