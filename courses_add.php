<?php 
	$page_title=" | Add Course";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>
	<h3>Add Course</h3>

	<?php
		if ($_SESSION['usergroup_id'] == 4 OR $_SESSION['usergroup_id'] == 2) {

			#Admin and coord

			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				if(!empty($_POST['course_name']) &&
					!empty($_POST['department_id'])
					) {

						$course_name = $_POST['course_name'];
						$department_id = $_POST['department_id'];
	            
            $sql="INSERT INTO gwb_training.courses (course_id, course_name, department_id)
									VALUES (NULL, '$course_name', '$department_id')";

            mysqli_query($dbc, $sql);

            if (mysqli_affected_rows($dbc) == 1) {
                echo "<p><img src='img/ico_true.png'> The course was successfully added to the database!</p>";
								echo "<p>You can add another below, or <a href='courses_view.php'>view the courses table</a>.</p>";
            } else {
                echo "<p><img src='img/ico_false.png'> Something has gone wrong, here is the SQL:<br>$sql</p>";
            }


				} else {
					echo "<p><img src='img/ico_false.png'> You did not fill out all of the form fields! Make sure you pick a department.</p>";
				} #End if with the fill-check
				
			}
		
		?>

			<form method="POST" action="courses_add.php" class="inputform departmentform">
				<p>
					<label>Course ID</label>
					<input type="text" name="course_id" placeholder="AUTO" disabled="1">
				</p>
				<p>
					<label>Course Name</label>
					<input type="text" name="course_name" value="<?php if(isset($_POST['course_name'])){echo $_POST['course_name'];}?>">
				</p>
				<p>
					<label>Department</label>
					<select name="department_id">
						<?php #enter php again

              # query for department list
              $sql = "SELECT * FROM departments";
              $result = mysqli_query($dbc, $sql);

              # display options based on dept. table contents
              while ($rows = mysqli_fetch_array($result)) {
                echo "<option value='{$rows['department_id']}'>{$rows['department_name']}</option>\n";
              }
            // exit php ?>
					</select>
				</p>
				<input type="submit" value="Add New Course" class="button">
			</form>

			




		<?php
		} else {
			#all other user groups
			permission();
		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>