<?php 
	$page_title=" | View Users";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>

	<?php

		if ($_SESSION['usergroup_id'] == 4) {

			#Admin
      echo "<h3>View Users Table</h3>";
      echo '<p><a href="users_add.php"> <img src="img/ico_add"> Create New User</a></p>';
      echo '<div class="clear"></div>';
      admin_draw_users_view($dbc);

		} else {
			permission();
		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>