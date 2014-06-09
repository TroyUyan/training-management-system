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
			$view_user_id = $_SESSION['user_id'];
			$sql_view_user = "SELECT users.user_id, users.first_name, users.last_name, departments.department_id, departments.department_name, departments.required_courses
    										FROM users
    										INNER JOIN departments
    										on departments.department_id = users.department_id
    										WHERE user_id = $view_user_id";
    	$result_view_user = mysqli_query($dbc, $sql_view_user);

    	$row_view_user = mysqli_fetch_array($result_view_user);

			echo "<p>Here you can view your current employee training progress for the {$row_view_user['department_name']}.</p>";
			echo "<p>You need {$row_view_user['required_courses']} courses to be fully trained for this department.</p>";

      echo '<div class="clear"></div>';
    	
  		# Query what user HAS taken
  		$sql_users_courses_name = "SELECT users_courses.user_id, users_courses.course_id, courses.course_name
			      										FROM users_courses
			      										INNER JOIN courses
			      										on users_courses.course_id = courses.course_id
			      										WHERE user_id = $view_user_id";

			$result_users_courses_name = mysqli_query($dbc, $sql_users_courses_name);

			echo "<h4>Your Completed Courses for the {$row_view_user['department_name']}:</h4>";

			while ($row_users_courses_name = mysqli_fetch_array($result_users_courses_name)) {
				echo "<img src='img/ico_true.png'> {$row_users_courses_name['course_name']}<br>";
			}


			# Query what user HAS NOT taken

			$sql_users_courses_name2 = "SELECT course_id, course_name FROM courses
																 WHERE department_id = {$row_view_user['department_id']} AND 
																 course_id NOT IN
																 (SELECT course_id FROM users_courses WHERE user_id = {$row_view_user['user_id']})";

			$result_users_courses_name2 = mysqli_query($dbc, $sql_users_courses_name2);

			echo "<h4>Courses You Could Take for the {$row_view_user['department_name']}:</h4>";

			while ($row_users_courses_name2 = mysqli_fetch_array($result_users_courses_name2)) {
				echo "<img src='img/ico_false.png'> {$row_users_courses_name2['course_name']}<br>";
			}

			# compare is the emp fully trained or not
			$completed_courses = mysqli_num_rows($result_users_courses_name);
			$needed_courses = $row_view_user['required_courses'];
    	echo "<h4>Completed $completed_courses courses out of $needed_courses required.</h4>";
    	if ($completed_courses >= $needed_courses) {
      	echo "<p><img src='img/ico_true.png'> Congratulations! You are <strong>fully trained</strong>!</p>";
      } else {
      	$to_go = $needed_courses - $completed_courses;
      	echo "<p><img src='img/ico_false.png'> You need <strong>$to_go more</strong> courses to be fully trained.</p>";
      	echo "<p><a href='courses_schedule.php'>View upcoming training opportunities for these courses.</a></p>";
      }

			
		} else {

			#error-out
			permission();

		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>