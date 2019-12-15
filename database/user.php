<?php
  function getNewUserID() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT DISTINCT max(userID) AS max FROM user');
    $stmt->execute();
    $max = $stmt->fetch();
    return $max['max']; 
  }

  function createUser($username, $email, $password, $name) {
    global $conn;  
    $userID = getNewUserID() +1;

    $options = ['cost' => 12];
    $hash = password_hash($password, PASSWORD_DEFAULT, $options);
    $stmt = $conn->prepare('INSERT INTO user (userID, email, username, password, name) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($userID, $email, $username, $hash, $name));
    return $userID;

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
  
  function updateUsername($userID, $username) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE user SET username = ? WHERE userID = ?');
      if($stmt->execute(array($username, $userID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 

  function updatePassword($userID, $password) {
    global $conn;
    try {
      $options = ['cost' => 12];
      $hash = password_hash($password, PASSWORD_DEFAULT, $options);

      $stmt = $conn->prepare('UPDATE user SET password = ? WHERE userID = ?');
      if($stmt->execute(array($hash, $userID)))
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

  function updateEmail($userID, $email) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE user SET email = ? WHERE userID = ?');
      if($stmt->execute(array($email, $userID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  }
  
  function updateDescription($userID, $description) {
    global $conn;
    try {
      $stmt = $conn->prepare('UPDATE user SET description = ? WHERE userID = ?');
      if($stmt->execute(array($description, $userID)))
          return true;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 

?>
