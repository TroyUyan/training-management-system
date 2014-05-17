<?php # header for Training Tracking Management System for Greenwell Bank, a final CTEC 227 project for Troy Uyan, Savanna Lord, and Christine Watson 
# each page needs $page_title defined before this includes file
session_start(); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo "$page_title"; ?></title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" type="image/png" href="img/gbfav.png">
	<link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php 
		//connect to database
		require('includes/mysqli_connect.inc.php');
	?>
	<div id="wrapper">	
		<header>
			<a href="login.php"><img src="img/clearlogo.png" alt="Greenwell Bank logo" class="logo"></a>
			<h1>Training Tracking Management System</h1>
			<div id="motto">
				<p><em>Help Us Help You Take Over the World</em></p>
			</div> <!-- end motto -->
			<div class="nav">
				<ul>
					<li id="home"><a href="home.php" alt="Return to Greenwell Bank Home Page">HOME</a></li>
					<li id="login"><a href="login.php" alt="Login">LOGIN</a></li>
					<li id="logout"><a href="logout.php" alt="Logout">LOG OUT</a></li>
				</ul>
			</div> <!-- end nav -->
		</header>

		<div id="content" >
			<div id="helpbar">
				<a href="help.html" title="Need help?" class="helpbutton"><strong>&#63;</strong></a>
			</div><!-- end helpbar -->
			