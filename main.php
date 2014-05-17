<?php 
	$page_title=" | Login";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>
	<h3>Welcome <?php echo "{$_SESSION['first_name']} {$_SESSION['last_name']}";?>!</h3>

	<?php
		if ($_SESSION['usergroup_id'] == 1) {

			#Employee
			echo "Employee";

			
		} elseif ($_SESSION['usergroup_id'] == 2) {

			#Coordinator
			echo "Coordinator";


		} elseif ($_SESSION['usergroup_id'] == 3) {

			#Viewer
			echo "Viewer";


		} elseif ($_SESSION['usergroup_id'] == 4) {

			#Admin
			echo "Admin";


		} else {
			#error-out
		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>