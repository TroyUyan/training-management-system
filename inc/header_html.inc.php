<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GWB Training <?php echo "$page_title"; ?></title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" type="image/png" href="img/gbfav.png">
	<link href='http://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica:400,400italic' rel='stylesheet' type='text/css'>
</head>
<body>
		<header>
			<div class="wrapper">
			<?php
				if (isset($_SESSION['loggedin']) AND $_SESSION['loggedin'] == 1) {
					echo '<a href="main.php"><img src="img/clearlogo.png" alt="Greenwell Bank logo" class="logo"></a>';
				} else {
					echo '<a href="index.php"><img src="img/clearlogo.png" alt="Greenwell Bank logo" class="logo"></a>';
				}
			?>
			<h1>Training Tracking Management System</h1>
			<div id="motto">
				<p>Help Us Help You Take Over the World</p>
			</div> <!-- end motto -->
			<div class="nav">
			<?php 
				if (isset($_SESSION['usergroup_id']) AND $_SESSION['usergroup_id'] == 4) { ?>
					<ul>
						<li><a href="main.php" title="Home Page">HOME</a></li>
						<li><a href="users_view.php" title="View Users">USERS</a></li>
						<li class="nav-small"><a href="records_view.php" title="View Employee Records">EMPLOYEE RECORDS</a></li>
						<li><a href="courses_view.php" title="View Courses">COURSES</a></li>
						<li><a href="departments_view.php" title="View Departments">DEPARTMENTS</a></li>
						<li><a href="logout.php" title="Logout">LOG OUT</a></li>
					</ul>
				<?php } elseif (isset($_SESSION['usergroup_id']) AND $_SESSION['usergroup_id'] == 3) { ?>
					<ul>
						<li><a href="main.php" title="Home Page">HOME</a></li>
						<li class="nav-small"><a href="records_view.php" title="View Employee Records">EMPLOYEE RECORDS</a></li>
						<li><a href="courses_view.php" title="View Courses">COURSES</a></li>
						<li><a href="logout.php" title="Logout">LOG OUT</a></li>
					</ul>
				<?php } elseif (isset($_SESSION['usergroup_id']) AND $_SESSION['usergroup_id'] == 2) { ?>
					<ul>
						<li><a href="main.php" title="Home Page">HOME</a></li>
						<li class="nav-small"><a href="records_view.php" title="View Employee Records">EMPLOYEE RECORDS</a></li>
						<li><a href="courses_view.php" title="View Courses">COURSES</a></li>
						<li><a href="departments_view.php" title="View Departments">DEPARTMENTS</a></li>
						<li><a href="logout.php" title="Logout">LOG OUT</a></li>
					</ul>
				<?php } elseif (isset($_SESSION['usergroup_id']) AND $_SESSION['usergroup_id'] == 1) { ?>
					<ul>
						<li><a href="main.php" title="Home Page">MY PROGRESS</a></li>
						<li class="nav-small"><a href="courses_schedule.php" title="View Courses">UPCOMING COURSES</a></li>
						<li><a href="logout.php" title="Logout">LOG OUT</a></li>
					</ul>
				<?php } elseif (!isset($_SESSION['usergroup_id'])) { ?>
					<ul>
						<li><a href="index.php" title="Home Page">LOGIN</a></li>
						<li><a href="help.php" title="View Courses">HELP</a></li>
					</ul>
				<?php }
			#End overall nav block 
			?>
			</div> <!-- end nav -->
			</div> <!-- end wrapper -->
		</header>

		<div id="content" >
			<div class="wrapper">		