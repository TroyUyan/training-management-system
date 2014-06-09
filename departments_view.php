<?php 
	$page_title=" | View Departments";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>

	<?php

		if ($_SESSION['usergroup_id'] == 4) {

			#Admin
      echo "<h3>View Departments Table</h3>";
      echo '<p><a href="departments_add.php"> <img src="img/ico_add"> Create New Department</a></p>';
      echo '<div class="clear"></div>';
      admin_draw_departments_view($dbc);

		} elseif ($_SESSION['usergroup_id'] == 2) {
			
			#coordinator
      echo "<h3>View Departments Table</h3>";
      echo '<div class="clear"></div>';
      viewer_draw_departments_view($dbc);

		} else {
			permission();
		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>