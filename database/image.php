<?php
  function getLenghtImgs() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT COUNT(*) FROM image');
    $stmt->execute();
    $num = $stmt->fetch();
    return $num['COUNT(*)'];
  }

  /*function createImg($propertyID, $userID) {
    global $conn;  
    $imageID = getLenghtImgs() +1;

    $stmt = $conn->prepare('INSERT INTO image VALUES (?, ?, ?, ?)');
    $stmt->execute(array($imageID, $propertyID, $userID, "0"));
  }

  function getAllImgs() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT * FROM image');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function getImg($imageID) {
    global $conn;
    
    $stmt = $conn->prepare('SELECT * FROM image WHERE imageID = ?');
    $stmt->execute(array($imageID));
    return $stmt->fetch();  
  }*/

  function getAllImgsProperty($propertyID) {
    global $conn;
    
    $stmt = $conn->prepare('SELECT * FROM image WHERE propertyID = ?');
    $stmt->execute(array($propertyID));
    return $stmt->fetchAll();
  }


?>
