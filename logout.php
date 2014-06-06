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

<script>
  alert("You have logged out!");
  window.location.href='index.php';
</script> 



<?php 
	include('inc/footer.inc.php');
?>