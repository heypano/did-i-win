<?php
include_once('dbconnect.php');
$mysqli = $_SESSION["connection"];
$result = $mysqli->query("SELECT * FROM winners")->fetch_all();
echo json_encode($result);
?>