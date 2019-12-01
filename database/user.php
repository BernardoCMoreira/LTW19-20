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

    $stmt = $conn->prepare('INSERT INTO user VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($userID, $email, $username, $hash, $name));
  }

  function verifyUser($username, $password) {
    global $conn;  
    $stmt = $conn->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));
    $user = $stmt->fetch();
    return ($user !== false && password_verify($password, $user['password']));
  }

?>
