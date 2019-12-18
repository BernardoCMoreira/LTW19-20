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
    $touristID = getUser($_SESSION['username'])['userID'];
    $propertyID = $_POST['propertyID'];
    if(! isset($propertyID)) {
        $_SESSION['error_messages'][] = "Missing propertyID. Returning to main page";
        header('Location: ../pages/mainPage.php');
        exit();
    }
    $startDate = $_POST['startDate'];
    if(! isset($startDate)) {
        $_SESSION['error_messages'][] = "Missing startDate. Returning to main page";
        header('Location: ../pages/mainPage.php');
        exit();
    }
    $endDate = $_POST['endDate'];
    if(! isset($endDate)) {
        $_SESSION['error_messages'][] = "Missing endDate. Returning to main page";
        header('Location: ../pages/mainPage.php');
        exit();
    }

    // Check if property is avalable at given timeframe
    if(! isPropertyAvalableFromTo($propertyID, $startDate, $endDate)) {
        $_SESSION['error_messages'][] = "Property cannot be rented as it is already rented during specified time. Returning to main page";
        header('Location: ../pages/mainPage.php');
        exit();
    }

    // Check if user has already rented anouther place at same time
    if(! isUserFreeFromTo($touristID, $startDate, $endDate)) {
        $_SESSION['error_messages'][] = "Property cannot be rented: user has a rent in a different property at same time. Returning to main page";
        header('Location: ../pages/mainPage.php');
        exit();
    }

    $maxCancelDate_DAYS = 3;
    $maxCancelDate = date("Y-m-d", strtotime($startDate) - 24*60*60*$maxCancelDate_DAYS);
    $price = calculatePrice($propertyID, $startDate, $endDate);
    createRent($propertyID, $touristID, $startDate, $endDate, $maxCancelDate, $price);

    $_SESSION['success_messages'][] = "Property was rented with success";
    header('Location: ../pages/mainPage.php');
?>