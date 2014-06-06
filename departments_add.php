<?php 
	$page_title=" | Add Department";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>
	<h3>Add Department</h3>

	<?php
		if ($_SESSION['usergroup_id'] == 4) {

			#Admin

			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				if(!empty($_POST['department_id']) &&
					!empty($_POST['department_name']) &&
					!empty($_POST['required_courses']) &&
					!empty($_POST['department_desc'])
					) {

						$department_id = $_POST['department_id'];
						$department_name = $_POST['department_name'];
						$required_courses = $_POST['required_courses'];
						$department_desc = $_POST['department_desc'];

						# check if id exists
	          $sql = "SELECT department_id FROM departments WHERE department_id = $department_id";
	          $result = mysqli_query($dbc, $sql);

	          if (mysqli_num_rows($result) == 0) {
	            
	            $sql="INSERT INTO gwb_training.departments (department_id, department_name, department_desc, required_courses)
										VALUES ('$department_id', '$department_name', '$department_desc', '$required_courses')";

	            mysqli_query($dbc, $sql);

	            if (mysqli_affected_rows($dbc) == 1) {
	                echo "<p><img src='img/ico_true.png'> The department was successfully added to the database!</p>";
									echo "<p>You can add another below, or <a href='departments_view.php'>view the departments table</a>.</p>";
	            } else {
	                echo "<p><img src='img/ico_false.png'> Something has gone wrong, here is the SQL:<br>$sql</p>";
	            }

	          } else {
	            echo "<p><img src='img/ico_false.png'> That department ID is already in use! Please pick another.</p>";
	          }


				} else {
					echo "<p><img src='img/ico_false.png'> You did not fill out all of the form fields!</p>";
				} #End if with the fill-check
				
			}
		
		?>

			<form method="POST" action="departments_add.php" class="inputform departmentform">
				<p>
					<label>Department ID</label>
					<input type="number" name="department_id" min="0" value="<?php if(isset($_POST['department_id'])){echo $_POST['department_id'];}?>">
				</p>
				<p>
					<label>Department Name</label>
					<input type="text" name="department_name" value="<?php if(isset($_POST['department_name'])){echo $_POST['department_name'];}?>">
				</p>
				<p>
					<label>Required Courses</label>
					<input type="number" name="required_courses" min="0" value="<?php if(isset($_POST['required_courses'])){echo $_POST['required_courses'];}?>">
				</p>
				<p>
					<label>Department Description</label>
					<textarea name="department_desc" rows="4" cols="50"><?php if(isset($_POST['department_desc'])){echo $_POST['department_desc'];}?></textarea>
				</p>
				<input type="submit" value="Add New Department" class="button">
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