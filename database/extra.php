<?php
  function createExtra($name, $propertyID) {
    global $conn;  

    $stmt = $conn->prepare('INSERT INTO extra VALUES (?, ?)');
    $stmt->execute(array($name, $propertyID));
  }

  function getAllExtrasProperty($propertyID) {
    global $conn;
    
    $stmt = $conn->prepare('SELECT name FROM extra WHERE propertyID = ?');
    $stmt->execute(array($propertyID));
    return $stmt->fetchAll();
  }
  
?>
