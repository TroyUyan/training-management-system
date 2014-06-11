<?php 
	$page_title=" | Add Course Records";
	include ('inc/header.inc.php');
?>

	<?php

		if ($_SESSION['usergroup_id'] == 4 OR $_SESSION['usergroup_id'] == 2) {

			if (isset($_GET['report_course'])) {

				#AFTER THE SUBMIT COURSE FORM WAS SUBMITTED
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {

					$course_id = $_POST['course_id'];
					# echo "Course ID: $course_id";

					$users_array = $_POST['users'];

					#debug array
					#var_dump($users_array);
					
					$value_set = "";

					foreach ($users_array as $key => $value) {

						$value_set .= "($value, $course_id), ";

					}
					$value_set = substr($value_set, 0, -2);
					#echo $value_set;

					$sql = "INSERT INTO users_courses
									(user_id, course_id)
									VALUES $value_set";

					#echo "$sql";

					$result = mysqli_query($dbc, $sql);
					
					if(mysqli_affected_rows($dbc) >= 1) {
						echo "<p><img src='img/ico_true'> The course results were successfully posted!</p>";
					} else {
						echo "<p><img src='img/ico_false'> The course results were not posted!</p>
							<p>Note that employees cannot take the same course twice, so at least one employee selected cannot have already taken the course selected.</p>";
					}

				} # end request_method = post


				#BEFORE THE SUBMIT COURSE FOR IS SUBMITTED

				$department_id = $_GET['report_course'];

				$sql = "SELECT department_name
								FROM departments
								WHERE department_id = $department_id";
				$result = mysqli_query($dbc, $sql);
				$rows = mysqli_fetch_array($result);

				$department_name = $rows['department_name'];

				echo "<h2>Adding Course Record for $department_name</h2>";

				# get course names
				$sql = "SELECT course_id, course_name
								FROM courses
								WHERE department_id = $department_id";
				$result = mysqli_query($dbc, $sql);

				echo "<form method='POST' action='records_add.php?report_course=$department_id'>";
				
				# drop-down for courses of this department
				echo "<p>Select which training course was completed:</p>";
				echo "<p><select name='course_id'>\n";
				while ($rows = mysqli_fetch_array($result)) {
					echo "<option value='{$rows['course_id']}'>{$rows['course_name']}</option>\n";
				}
				echo "</select></p>\n";

				# get employee names
				$sql = "SELECT user_id, first_name, last_name
								FROM users
								WHERE department_id = $department_id
								AND active = 1";
				$result = mysqli_query($dbc, $sql);

				# check boxes for all users assigned to this department
				echo "<br><p>Check which employees of the $department_name completed the course:</p>";
				echo "<p>";
				while ($rows = mysqli_fetch_array($result)) {
					echo "<input type='checkbox' name='users[]' value='{$rows['user_id']}'>{$rows['first_name']} {$rows['last_name']}<br>\n";
				}
				echo "</p>";

				echo "<input type='submit' class='button' value='Submit Course Record'>";
				echo "</form>";
				echo "<div class='clear'></div>";
				echo "<br><hr><br>";

			} # end ifisset _GET['report_course']


			#break out ?>
			<h2>Add Course Records</h2>
			<p>After a training course has been completed, use this page to insert the record of the courses completion and which employees were present.</p>

			<p>Select which department had the training course:</p>

      <p>
				<?php #enter php again

          # query for department list
          $sql = "SELECT * FROM departments";
          $result = mysqli_query($dbc, $sql);

          # display options based on dept. table contents
          while ($rows = mysqli_fetch_array($result)) {
          	if ($rows['department_id'] > 0) {
          		echo "<a href='?report_course={$rows['department_id']}'><img src='img/ico_add'> {$rows['department_name']}</a><br><br>\n";
						}
          }
        // exit php ?>
			</p>

		<?php #resume
		} else {
			permission();
		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>