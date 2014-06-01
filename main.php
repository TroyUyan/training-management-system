<?php 
	$page_title=" | Home Page";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>
	<h3>Welcome <?php echo "{$_SESSION['first_name']} {$_SESSION['last_name']}";?>!</h3>

	<?php
		if ($_SESSION['usergroup_id'] == 4) {
			
			#Admin
			echo "<p>Usergroup: Admin</p>";
			?>

			<div class="tablesection">
				<h3>System Users</h3>
				<a href="users_view.php"><p class="sectionbutton">View All Users</p></a>
				<a href="users_add.php"><p class="sectionbutton">Add New User</p></a>
				<a href="#"><p class="sectionbutton">Edit Employee Records</p></a>
			</div>

			<div class="tablesection">
				<h3>Traning Courses</h3>
				<a href="courses_add.php"><p class="sectionbutton">View All Courses</p></a>
				<a href="courses_view.php"><p class="sectionbutton">Add New Course</p></a>
			</div>

			<div class="tablesection">
				<h3>Bank Departments</h3>
				<a href="department_view.php"><p class="sectionbutton">View All Departments</p></a>
				<a href="department_add.php"><p class="sectionbutton">Add New Department</p></a>
			</div>

		<?php

			
		} elseif ($_SESSION['usergroup_id'] == 3) {

			#Viewer
			echo "Viewer";



		} elseif ($_SESSION['usergroup_id'] == 2) {

			#Coordinator
			echo "Coordinator";


		} elseif ($_SESSION['usergroup_id'] == 1) {

			#Employee
			echo "Employee";

			
		} else {

			#error-out

		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>