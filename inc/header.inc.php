<?php
	session_start();
	error_reporting(0); // UNcomment hash to DISABLE error reporting, comment hash to enable
	include('header_html.inc.php');
	require('mysqli_connect.inc.php');
	include('functions.inc.php');
	loggedin($page_title);
?>