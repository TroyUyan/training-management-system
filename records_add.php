<?php 
	$page_title=" | Manage Employee Records";
	include ('inc/header.inc.php');
?>

	<h2>Manage Employee Records</h2>
	<p>This page is used to add or remove credit for a course completion per user.</p>

	<?php

		if ($_SESSION['usergroup_id'] == 4) {

			#Admin
      echo "<h3>View Courses Tables</h3>";
      echo '<p><a href="courses_add.php"> <img src="img/ico_add"> Create New Course</a></p>';
      echo '<div class="clear"></div>';
      admin_draw_courses_view($dbc);

		} else {
			permission();
		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>