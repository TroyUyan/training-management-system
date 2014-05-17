<?php
$dbc=mysqli_connect("127.0.0.1","root","root","ctec127_lab4") OR die("<p>Could not connect to the MySQL Server: " . mysqli_connect_error() . "<p>");
//set the endcoding
mysqli_set_charset($dbc,'utf8');
?>