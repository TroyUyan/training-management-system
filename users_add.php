<?php 
	$page_title=" | Add User";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>
	<h3>Add User</h3>

	<?php
		if ($_SESSION['usergroup_id'] == 4) {

			#Admin

			if ($_SERVER['REQUEST_METHOD'] == "POST") {

				if(!empty($_POST['username']) &&
					!empty($_POST['pass']) &&
					!empty($_POST['first_name']) &&
					!empty($_POST['last_name']) &&
					!empty($_POST['usergroup_id'])
					) {

						$username = $_POST['username'];
						$pass = $_POST['pass'];
						$first_name = $_POST['first_name'];
						$last_name = $_POST['last_name'];
						$usergroup_id = $_POST['usergroup_id'];
						$department_id = $_POST['department_id'];

						# check if username exists
	          $sql = "SELECT username FROM users WHERE username = \"$username\"";
	          $result = mysqli_query($dbc, $sql);

	          if (mysqli_num_rows($result) == 0) {
	            
	            $sql="INSERT INTO gwb_training.users (user_id, username, pass, first_name, last_name, usergroup_id, department_id)
										VALUES (NULL, '$username', '$pass', '$first_name', '$last_name', '$usergroup_id', '$department_id')
									 ";

	            mysqli_query($dbc, $sql);

	            if (mysqli_affected_rows($dbc) == 1) {
	                echo "<p><img src='img/ico_true.png'> The user was successfully added to the database!</p>";
									echo "<p>You can add another below, or <a href='users_view.php'>view the users table</a>.</p>";
	            } else {
	                echo "<p><img src='img/ico_false.png'> Something has gone wrong, here is the SQL:<br>$sql</p>";
	            }

	          } else {
	            echo "<p><img src='img/ico_false.png'> That username is already in use! Please pick another.</p>";
	          }


				} else {
					echo "<p><img src='img/ico_false.png'> You did not fill out all of the form fields!</p>";
				} #End if with the fill-check
				
			}
		
		?>

			<form method="POST" action="users_add.php" class="inputform">
				<p>
					<label>User ID</label>
					<input type="text" name="user_id" placeholder="AUTO" disabled="1">
				</p>
				<p>
					<label>Username</label>
					<input type="text" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>">
				</p>
				<p>
					<label>Password</label>
					<input type="text" name="pass" value="<?php if(isset($_POST['pass'])){echo $_POST['pass'];}?>">
				</p>
				<p>
					<label>First Name</label>
					<input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];}?>">
				</p>
				<p>
					<label>Last Name</label>
					<input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];}?>">
				</p>
				<p>
					<label>Usergroup</label>
					<select name="usergroup_id">
						<?php #enter php again

              # query for usergroup list
              $sql = "SELECT * FROM usergroups";
              $result = mysqli_query($dbc, $sql);

              # display options based on usergroup table contents
              while ($rows = mysqli_fetch_array($result)) {
                echo "<option value='{$rows['usergroup_id']}'>{$rows['usergroup_name']}</option>\n";
              }
            // exit php ?>
					</select>
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
				<input type="submit" value="Add New User" class="button">
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
