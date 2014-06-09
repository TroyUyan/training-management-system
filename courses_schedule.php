<?php 
	$page_title=" | View Upcoming Courses";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>

	<?php

		if ($_SESSION['usergroup_id'] == 1) {

		#Employee

		# Get information about user and their department
		$view_user_id = $_SESSION['user_id'];
		$sql_view_user = "SELECT users.user_id, users.first_name, users.last_name, departments.department_id, departments.department_name, departments.required_courses
  										FROM users
  										INNER JOIN departments
  										on departments.department_id = users.department_id
  										WHERE user_id = $view_user_id";
  	$result_view_user = mysqli_query($dbc, $sql_view_user);

  	$row_view_user = mysqli_fetch_array($result_view_user);

		echo "<p>These are the upcoming training opportunities for the {$row_view_user['department_name']} courses you have not taken yet.</p>";

    echo '<div class="clear"></div>';
  	
		# Query what user HAS NOT taken
		$sql_users_courses_name2 = "SELECT course_id, course_name FROM courses
															 WHERE department_id = {$row_view_user['department_id']} AND 
															 course_id NOT IN
															 (SELECT course_id FROM users_courses WHERE user_id = {$row_view_user['user_id']})";

		$result_users_courses_name2 = mysqli_query($dbc, $sql_users_courses_name2);

		echo "<h3>Courses You Could Take for the {$row_view_user['department_name']}:</h3>";

		# set the random times array
		$times = array(
			"8:00am", "8:30am", "9:00am", "9:30am", "10:00am", "10:30am",
			"11:00am", "11:30am", "12:00pm", "12:30pm", "1:00pm", "1:30pm",
			"2:00pm", "2:30pm", "3:00pm", "3:30pm", "4:00pm", "4:30pm",
			"5:00pm", "6:00pm", "7:00pm"
			);

		# set random rooms array
		$rooms = array(
			"Main Conference Room (RM 231)", "Primary Training Room (RM 76A)", "Upstairs Training Room (RM 167)",
			);

		# while their are courses the user hasnt taken
		while ($row_users_courses_name2 = mysqli_fetch_array($result_users_courses_name2)) {

			echo "<p><strong>{$row_users_courses_name2['course_name']}</strong><br>";

			#generate a random date in the next X amount of days
			$date = date('m-d-Y', strtotime( '+'.mt_rand(0,20).' days'));

			#get random time
			shuffle($times);

			#get random room
			shuffle($rooms);

			echo "Date: $date<br>
						Time: {$times[5]}<br>
						Location: {$rooms[1]}";
			echo "</p>";
		}

	echo '<p><a href="main.php">Go back and see my progress</a></p>';

		
	} else {

		#error-out
		permission();

	}	
?>

<?php 
	include('inc/footer.inc.php');
?>