<?php
    include_once('../config/init.php');
    include_once('../database/user.php');

    // Check rentId value
    if(! isset($_POST['rentID'])) {
        $_SESSION['error_messages'][] = "Missing rentID. Cannot complete action";
        header('Location: ../pages/rents.php');
        exit();
    }
    $rentID = trim(strip_tags($_POST['rentID']));

    //Check if user is tourist and,
    // therefore, can edit his rent
    $userID = getUser($_SESSION['username'])['userID'];
    if(! isUserRentSTourist($userID, $rentID)) {
        $_SESSION['error_messages'][] = "User does not match tourist of current rent. Cannot complete action";
        header('Location: ../pages/rents.php');
        exit();
    }

    $ratingInfo = getRatingInfo($rentID);
    global $conn;
    if($ratingInfo == null) {
        if(isset($_POST['pontuacao']) && isset($_POST['comentario'])) {
            $pontuacao = trim(strip_tags($_POST['pontuacao']));
            $comentario = trim(strip_tags($_POST['comentario']));
		    $stmt = $conn->prepare('INSERT INTO rating VALUES (?, ?, ?)');
            $stmt->execute(array($rentID, $pontuacao, $comentario));
            $_SESSION['success_messages'][] = "Score/Rating was added with success";
        } else {
            $_SESSION['error_messages'][] = "Missing values. Cannot complete action";
            header('Location: ../pages/rents.php');
            exit();
        }
    } else {
        if(! isset($_POST['pontuacao']) && ! isset($_POST['comentario'])) {
            $_SESSION['error_messages'][] = "Missing values. Cannot complete action";
            header('Location: ../pages/rents.php');
            exit();
        } else {
            if($_POST['pontuacao']) {
                $pontuacao = trim(strip_tags($_POST['pontuacao']));
                $stmt = $conn->prepare('UPDATE rating SET pontuacao = ? WHERE ratingID  = ?');
                $stmt->execute(array($pontuacao, $rentID));
            }
            if($_POST['comentario']) {
                $comentario = trim(strip_tags($_POST['comentario']));
                $stmt = $conn->prepare('UPDATE rating SET comentario = ? WHERE ratingID = ?');
                $stmt->execute(array($comentario, $rentID));
            }
        }
        $_SESSION['success_messages'][] = "Score/Rating was edited with success";
    }
    
    header('Location: ../pages/mainPage.php');


    function isUserRentSTourist($userID, $rentID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM rent WHERE 
            touristID = ? AND rentID = ?');
		$stmt->execute(array($userID, $rentID));
        return $stmt->fetch();
    }

    function getRatingInfo($rentID) {
		global $conn;

		$stmt = $conn->prepare('SELECT * FROM rating WHERE ratingID = ?');
		$stmt->execute(array($rentID));
		return $stmt->fetch();
	}

?>