<?php
    include_once('../config/init.php');
    include_once('../database/user.php');
    include_once('../database/rents.php');

    // Reject action if no user is signed in
    if(! isset($_SESSION['username'])) {
        $_SESSION['error_messages'][] = "No user is signed in. Cannot complete action";
        header('Location: ../pages/login.php');
    }

    // Validate post information
    $userID = getUser($_SESSION['username'])['userID'];
    $rentID = trim(strip_tags($_POST['rentID']));
    if(! isset($rentID)) {
        $_SESSION['error_messages'][] = "Missing rentID. Returning to main page";
        header('Location: ../pages/mainPage.php');
        exit();
    }

    $rentInfo = getRentInfo($rentID);
    $currentDate = time() / (24*60*60);
    
    if($userID == $rentInfo['touristID']) {
        $cancelDay = strtotime($rentInfo['cancelLimitDay']) / (24*60*60);
        if($currentDate < $cancelDay)
            deleteRent($rentID);
        else
           $_SESSION['error_messages'][] = "Cannot delete rent: Past limit date.";
        
    } else if($userID == getOwnerID($rentID)) {
        $startDay = strtotime($rentInfo['startDate']) / (24*60*60);
        if($currentDate < $startDay)
            deleteRent($rentID);
        else
            $_SESSION['error_messages'][] = "Cannot delete rent: Past starting date.";

    } else {
        $_SESSION['error_messages'][] = "Unknown User. Cannot delete rent";
    }

    header('Location: ../pages/rents.php');
    exit();
?>