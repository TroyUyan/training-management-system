<?php
	session_start();

	// NEED LIVE SERVER FOR LOGIN CHECK
	#include('functions.php');
	#logincheck();

	include('header_html.inc.php');

	include('mysqli_connect.inc.php'); #change to require when on server
	#require('mysqli_connect.inc.php');


?>