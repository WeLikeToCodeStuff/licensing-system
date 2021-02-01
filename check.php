<?php
// Modify to your liking :)


// MySQL Connection
$dbServername = "";
$dbUsername = "";
$dbPassword = "";
$db = "";
$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Define the license key (key) and discordid (dcid) example: https://notasite.com/check.php?key=ssdfsdfsdf&dcid=123456 
// This will validate the license key against the discord id
$key = $_GET['key'];
$dcid = $_GET['dcid'];

// SQL Query
$sql = "SELECT licensekey FROM licenses WHERE discorduserid = '$dcid'";
// Getting the result of the SQL Query
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// Check the license key from sql to see if it matches the license key with the discord id
if(isset($_GET['key'] /*&& $row['licensekey'] == $key*/)) {
  if ($row['licensekey'] == $key) {
    echo 'VALID';
  }
  else {
    echo "INVALID";
  }
}
else {
  echo 'INVALID';
}
?>
