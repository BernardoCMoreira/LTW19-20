<?php
  function getNewImageID() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT DISTINCT max(ImageID) AS max FROM image');
    $stmt->execute();
    $max = $stmt->fetch();
    return $max['max']; 
  }

  function createImg($userORpropertyID, $userORproperty, $typefile) {
    global $conn;  
    $imageID = getNewImageID() +1;

    $stmt = $conn->prepare('INSERT INTO image VALUES (?, ?, ?, ?, ?, ?)');
    if($userORproperty == 'user'){
      $hash = 'default_user';
      $stmt->execute(array($imageID, null, $userORpropertyID, $hash, $typefile, "1"));
    }
    else{
      $hash = hash('md2', $userORproperty . $userORpropertyID . $imageID);
      $stmt->execute(array($imageID, $userORpropertyID, null, $hash, $typefile, "1"));
    }
    return $hash;
  }

  function getAllImgsProperty($propertyID) {
    global $conn;
    
    $stmt = $conn->prepare('SELECT * FROM image WHERE propertyID = ?');
    $stmt->execute(array($propertyID));
    return $stmt->fetchAll();
  }
  
	function getFirstImgOfProperty($propertyID) {
    	global $conn;
    
		$stmt = $conn->prepare('SELECT * FROM image WHERE propertyID = ?');
		$stmt->execute(array($propertyID));
		return $stmt->fetch();
	}

  function printPImage($image) {
    if($image['type'] == '.mp4' || $image['type'] == '.MP4') {
        echo '<li><video width="500" height="300" controls>
                <source src="../images/' . $image['name'] . $image['type'] . '" type="video/mp4">
                Your browser does not support the video tag.
              </video></li>';
    }else{
      echo '<li><img src="../images/' . $image['name'] . $image['type'] . '" alt="house " width="500" height="300"></li>';
    }
  }

  function printUImage($image) {
    if($image == null)
    echo '<img src="../images/default_user" alt="Logo " width="150" height="150" />';
    else
      echo '<img src="../images/' . $image['name'] . $image['type'] . '" alt="Logo " width="150" height="150" />';
  }

  function getUserImg($userID) {
    global $conn;
  
    $stmt = $conn->prepare('SELECT * FROM image WHERE userID = ?');
    $stmt->execute(array($userID));
    return $stmt->fetch();
  }

  function updateImg($userORpropertyID, $userORproperty, $typefile, $imageID) {
    global $conn;
    try {
      $hash = hash('md2', $userORproperty . $userORpropertyID . $imageID);

      if($userORproperty == 'user')
        $stmt = $conn->prepare('UPDATE image SET name = ?, type = ? WHERE userID = ?');
      else
      $stmt = $conn->prepare('UPDATE image SET name = ?, type = ? WHERE propertyID = ?');
      if($stmt->execute(array($hash, $typefile, $userORpropertyID)))
          return $hash;
      else
          return false;
    }catch(PDOException $e) {
      return false;
    }
  } 

?>
