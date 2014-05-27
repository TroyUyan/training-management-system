<?php 
	$page_title=" | Add User";
	include ('/inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>
	<h3>Add User</h3>

	<?php
		if ($_SESSION['usergroup_id'] == 4) {

			#Admin

			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				$username = $_POST['username'];
				$pass = $_POST['pass'];
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$usergroup_id = $_POST['usergroup_id'];
				$department_id = $_POST['department_id'];

				$sql="
				INSERT INTO gwb_training.users
				(user_id, username, pass, first_name, last_name, usergroup_id, department_id)
				VALUES (NULL, '$username', '$pass', '$first_name', '$last_name', '$usergroup_id', '$department_id')
				";

				mysqli_query($dbc, $sql);

				if (mysqli_affected_rows($dbc) == 1) {
					echo "<p>The user was successfully added to the database!</p>";
					echo "<p>You can add another below.</p>";
				} else {
					echo "<p>Something has gone wrong, here is the SQL:<br>$sql</p>";
				}
				
			}
		
		?>

			<form method="POST" action="users_add.php">
				<p>
					<label>User ID</label>
					<input type="text" name="user_id" placeholder="AUTO" disabled="1">
				</p>
				<p>
					<label>Username</label>
					<input type="text" name="username">
				</p>
				<p>
					<label>Password</label>
					<input type="text" name="pass">
				</p>
				<p>
					<label>First Name</label>
					<input type="text" name="first_name">
				</p>
				<p>
					<label>Last Name</label>
					<input type="text" name="last_name">
				</p>
				<p>
					<label>Usergroup</label>
					<select name="usergroup_id">
						<option value="1">Employee</option>
						<option value="2">Coordinator</option>
						<option value="3">Viewer</option>
						<option value="4">Admin</option>
					</select>
				</p>
				<p>
					<label>Department</label>
					<select name="department_id">
						<option value="1">Department One</option>
						<option value="0">-- NO DEPARTMENT --</option>

					</select>
				</p>
				<input type="submit" value="Add New User">
			</form>

			




		<?php
		} else {
			#error-out
		}

	?>
			

<?php 
	include('/inc/footer.inc.php');
?>