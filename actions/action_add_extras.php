<?php
include_once('../config/init.php');
include_once('../database/user.php');
include_once('../database/property.php');
include_once('../database/image.php');
include_once('../database/extra.php');

$propertyID = trim(strip_tags($_POST['propertyID']));
$extra = trim(strip_tags($_POST['extra']));
if($extra) createExtra($extra, $propertyID);

header("Location: ../pages/addPropertyExtras.php?propertyID=$propertyID");
