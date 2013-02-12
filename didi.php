
<?php 
include_once 'dbconnect.php';
$mysqli = $_SESSION["connection"];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Did I win?</title>
  <meta name="description" content="QR code lottery">
  <meta name="author" content="Pano">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,600,300,400' rel='stylesheet' type='text/css'>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <style>
  body{
    font-family: 'Open Sans', sans-serif;
    line-height: 150%;
    font-size: 120%;
  }
  input[type='text']{
    border: 1px solid rgb(150,150,150);
    -moz-border-radius: 5px;
    border-radius: 5px;
    line-height:30px;
  }
  </style>
  <script>
  $(document).ready(function(){
    if($("#name").length>0){
      $("#name").change(function(){
        var name = $("#name").val();
        $.ajax({
            url: "insert.php",
            data: {name: name},
            type: "post",
            success: function() {
              console.log("hi");
            }
        });
      });
      $.get('get.php', function(data) {
        console.log(data);
        $('#winners').html(data);
      });
    }
    });
    
  </script>
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
  <?php
  $ip = $_SERVER['REMOTE_ADDR'];
  //Last digit of IP
  $lastdigit = substr($ip,-1);
  //Win condition!
  if ($lastdigit==1){
    //Check to see if IP already in database
    echo "<div id=\"theinput\">Congratulations, you have won!<br> If you'd like to brag about it, enter your name here and press enter: <br />";
    echo '<input type="text" id="name" /></div>';
    echo '

    ';
  }
  ?>
<div id="winners"></div>
</body>
</html>
<?php

$mysqli->close();

?>