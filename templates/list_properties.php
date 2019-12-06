<?php
    include_once('../config/init.php');
    include_once('../database/image.php');
?>


<div class="results">
    
<?php
    foreach( $properties as $property){
        displayProperty($property);
    }
?>

</div>