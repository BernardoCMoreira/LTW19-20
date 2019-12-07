<?php

  function getLenghtUsers() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT COUNT(*) FROM user');
    $stmt->execute();
    $num = $stmt->fetch();
    return $num['COUNT(*)'];
  }

  function createUser($username, $email, $password, $name) {
    global $conn;  
    $userID = getLenghtUsers() +1;

    $options = ['cost' => 12];
    $hash = password_hash($password, PASSWORD_DEFAULT, $options);
    $stmt = $conn->prepare('INSERT INTO user (userID, email, username, password, name) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($userID, $email, $username, $hash, $name));
  }

  function verifyUser($username, $password) {
    global $conn;  
    $stmt = $conn->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();
    return ($user !== false && password_verify($password, $user['password']));
  }

  function getUser($username) {
    global $conn;  
    $stmt = $conn->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch();
  }

  function updatePhoto($userID, $photo) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE user SET photo = ? WHERE userID = ?');
      if($stmt->execute(array($photo, $userID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 

  function updateName($userID, $name) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE user SET name = ? WHERE userID = ?');
      if($stmt->execute(array($name, $userID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 

?>
