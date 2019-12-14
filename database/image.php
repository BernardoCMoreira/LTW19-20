<?php
  function getLenghtImgs() {
    global $conn;
    
    $stmt = $conn->prepare('SELECT COUNT(*) FROM image');
    $stmt->execute();
    $num = $stmt->fetch();
    return $num['COUNT(*)'];
  }

  function createImg($propertyID, $userID, $type) {
    global $conn;  
    $imageID = getLenghtImgs() +1;

    $stmt = $conn->prepare('INSERT INTO image VALUES (?, ?, ?, ?, ?)');
    $stmt->execute(array($imageID, $propertyID, $userID, $type,"1"));
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

  function printImage($image) {
    if($image['type'] == '.mp4' || $image['type'] == '.MP4') {
        echo '<li><video width="500" height="300" controls>
                <source src="../images/' . $image['imageID'] . $image['type'] . '" type="video/mp4">
                Your browser does not support the video tag.
              </video></li>';
    }else{
      echo '<li><img src="../images/' . $image['imageID'] . $image['type'] . '" alt="house " width="500" height="300"></li>';
    }
  }
?>
