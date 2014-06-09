<?php 
	$page_title=" | View Courses";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>

	<?php

		if ($_SESSION['usergroup_id'] == 4 OR $_SESSION['usergroup_id'] == 2) {

			#Admin and coord
      echo "<h3>View Courses Tables</h3>";
      echo '<p><a href="courses_add.php"> <img src="img/ico_add"> Create New Course</a></p>';
      echo '<div class="clear"></div>';
      admin_draw_courses_view($dbc);

		} elseif ($_SESSION['usergroup_id'] == 3) {

			#viewer
      echo "<h3>View Courses For Each Department</h3>";
      echo '<div class="clear"></div>';
      viewer_draw_courses_view($dbc);


		} else {
			permission();
		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>