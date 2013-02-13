<?php
include_once 'dbconnect.php';

function alreadyWon(){
	$mysqli = $_SESSION["connection"];
	$ip = $_SERVER['REMOTE_ADDR'];
	//If this is larger than 0 that means the IP has already won
	return ($mysqli->query("SELECT * FROM winners WHERE ip = '$ip'")->num_rows>0);
}
 
?>