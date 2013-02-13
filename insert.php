<?php
include_once 'dbconnect.php';
include_once 'get.php';
//Check again to make sure
$ip = $_SERVER['REMOTE_ADDR'];
//Last digit of IP
$lastdigit = substr($ip,-1);
//Win condition!
if ($lastdigit%3==0 && !alreadyWon()){
  $mysqli = $_SESSION["connection"];
  $name = $mysqli->real_escape_string($_POST['name']);
  if (!$mysqli->query("INSERT into winners (ip,name,date) VALUES ('$ip','$name',CURDATE())")) {
      printf("Error: %s\n", $mysqli->error);
  }
}



?>