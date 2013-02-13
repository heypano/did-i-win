
<?php 
include_once 'dbconnect.php';
include_once 'get.php';
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
    padding:2px;
  }
  </style>
  <script>
  $(document).ready(function(){
    if($("#name").length>0){ //This means the person won
      $("#name").change(function(){
        var name = $("#name").val();
        $.ajax({
            url: "insert.php",
            data: {name: name},
            type: "post",
            success: function() {
              console.log("saved");
              $('#theinput').remove();
	          printWinners();
            }
        });
      });
    }
    });
	printWinners();
  function printWinners(){
      $.get('winners.php', function(data) {
      	winners = JSON.parse(data);
      	$('#winners').html("");
      	$(winners).each(
      		function(index,item){
      			$('#winners').append('<div class="winner">'+
      			"<strong>"+item.name+"</strong>"+
      			" - "+item.date+
      			'</div>')
      		}
      	);
      	if($('#winners').html()==""){
      		$('#winners').html("Noone has won yet!");
      	}
        //$('#winners').html(data);
      });
  }
  </script>
  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body>
  <?php
  $ip = $_SERVER['REMOTE_ADDR'];
  echo '<script>console.log("'.$ip.'")</script>';
  //Last digit of IP
  $lastdigit = substr($ip,-1);
  //Win condition!
  if ($lastdigit%3==0){
    //Check to see if IP already in database
  	if(!alreadyWon()){
	    echo "<div id=\"theinput\">Congratulations, you have won!<br> If you'd like to brag about it, enter your name here and press enter: <br />";
	    echo '<input type="text" id="name" /></div>';
  	}
	else{
		echo "Don't try to cheat, I know you've already won.";
	}

    
  }//If they didn't win
  else{
  	echo "I'm sorry! You lost. Try going somewhere else.";
  }
  ?>
<h3>The Winners</h3>
<div id="winners"></div>
</body>
</html>
<?php

$mysqli->close();

?>