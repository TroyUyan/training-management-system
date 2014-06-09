<?php 
	$page_title=" | Home Page";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>
	<h3>Welcome <?php echo "{$_SESSION['first_name']} {$_SESSION['last_name']}";?>!</h3>

	<?php
		if ($_SESSION['usergroup_id'] == 4) {
			#Admin
			?>

			<div class="tablesection">
				<h3>System Users</h3>
				<a href="users_view.php"><p class="sectionbutton">View All Users</p></a>
				<a href="users_add.php"><p class="sectionbutton">Add New User</p></a>
				<a href="records_view.php"><p class="sectionbutton">View Employee Records</p></a>
				<a href="records_add.php"><p class="sectionbutton">Add Course Results</p></a>
			</div>

			<div class="tablesection">
				<h3>Training Courses</h3>
				<a href="courses_view.php"><p class="sectionbutton">View All Courses</p></a>
				<a href="courses_add.php"><p class="sectionbutton">Add New Course</p></a>
			</div>

			<div class="tablesection">
				<h3>Bank Departments</h3>
				<a href="departments_view.php"><p class="sectionbutton">View All Departments</p></a>
				<a href="departments_add.php"><p class="sectionbutton">Add New Department</p></a>
			</div>

		<?php

			
		} elseif ($_SESSION['usergroup_id'] == 3) {

			#Viewer
			?>
			<div class="tablesection">
				<h3>Employees</h3>
				<a href="records_view.php"><p class="sectionbutton">View Employee Records</p></a>
			</div>

			<div class="tablesection">
				<h3>Training Courses</h3>
				<a href="courses_view.php"><p class="sectionbutton">View All Courses</p></a>
			</div>
		
		<?php

		} elseif ($_SESSION['usergroup_id'] == 2) {

			#coordinator
			?>

			<div class="tablesection">
				<h3>Employee Records</h3>
				<a href="records_view.php"><p class="sectionbutton">View Employee Records</p></a>
				<a href="records_add.php"><p class="sectionbutton">Add Course Results</p></a>
			</div>

			<div class="tablesection">
				<h3>Training Courses</h3>
				<a href="courses_view.php"><p class="sectionbutton">View All Courses</p></a>
				<a href="courses_add.php"><p class="sectionbutton">Add New Course</p></a>
			</div>

			<div class="tablesection">
				<h3>Bank Departments</h3>
				<a href="departments_view.php"><p class="sectionbutton">View All Departments</p></a>
			</div>

		<?php


		} elseif ($_SESSION['usergroup_id'] == 1) {

			#Employee
			echo "Employee";

			
		} else {

			#error-out
			permission();

		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>