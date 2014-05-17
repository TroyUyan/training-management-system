<?php
	$page_title=" | Logout";
	include ('inc/header.inc.php');
?>

<h1>Logout</h1>

<?php 

	# Destroy session
	session_destroy();
	echo "<p>You have logged out!</p>";

?>

<?php 
	include('inc/footer.inc.php');
?>