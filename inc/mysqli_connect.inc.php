<?php
	$dbc=mysqli_connect("50.17.248.59","gwb_admin","gwblogin1","gwb_training")
	OR die("<p>Could not connect to the MySQL Server: " . mysqli_connect_error() . "<p>");
	
	//set the endcoding
	mysqli_set_charset($dbc,'utf8');
?>
