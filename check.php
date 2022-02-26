<?php
// Modify to your liking :)


// MySQL Connection
$dbServername = "localhost";
$dbUsername = "neon";
$dbPassword = "73WsB<fyy+D.hM~";
$db = "auth";
$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Define the license key (key) and discordid (dcid) example: https://notasite.com/check.php?key=ssdfsdfsdf&dcid=123456 
// This will validate the license key against the discord id
$key = $_GET['key'];
$dcid = $_GET['dcid'];
$hwid = $_GET['hwid'];

// SQL Query
$sql = "SELECT licensekey, hwid FROM licenses WHERE discorduserid = '$dcid'";
// Getting the result of the SQL Query
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// Check the license key from sql to see if it matches the license key with the discord id
header('Content-type:application/json;charset=utf-8');
if($_GET['type'] == 'login') {
  if(isset($_GET['key'] /*&& $row['licensekey'] == $key*/)) {
    if ($row['licensekey'] == $key) {
      $arr1 = array('error' => false, 'hwid' => $row['hwid']);
      echo json_encode($arr1);
    }
    else {
      $arr2 = array('error' => true);
      echo json_encode($arr2);
    }
  }
  else {
    $arr3 = array('error' => true);
    echo json_encode($arr3);
  }
} else if($_GET['type'] == 'register') {
  if($key) {
    $sqlreg1 = "SELECT hwid FROM licenses WHERE key = '$key'";
    $resultreg1 = $conn->query($sqlreg1);
    $rowreg1 = $resultreg1->fetch_assoc();
      $sqlreg2 = "UPDATE `licenses` SET `hwid`='$hwid' WHERE `licensekey`='$key'";
      $resultreg2 = $conn->query($sqlreg2);
      $rowreg2 = $resultreg2->fetch_assoc();
      echo 'ok';
  } else {
    echo 'no';
  }
  
} else {
  echo 'no';
}
?>
