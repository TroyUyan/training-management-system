<?php
	$page_title=" | Login";
	include ('inc/header.inc.php');
?>

			<div id="login-aside" class="clear">

			<?php
				if ($_SERVER['REQUEST_METHOD'] == "POST") {

					echo "<form><fieldset>";

					# get form data
					$username = $_POST['username'];
					$pass = $_POST['pass'];

					#sql
					$sql = "SELECT user_id, first_name, last_name, usergroup_id, department_id
									FROM users WHERE username=? AND pass=?";

					#sql prepare
					$stmt = mysqli_prepare($dbc, $sql);

					#bind parameters
					mysqli_stmt_bind_param($stmt, 'ss', $username, $pass);

					# query the database
					mysqli_stmt_execute($stmt);

					# store result, needed for SELECTS
					mysqli_stmt_store_result($stmt);

					if (mysqli_stmt_num_rows($stmt) == 1) {
						# username and password match
						# Now set a session variable
						$_SESSION['loggedin'] = 1;
						$_SESSION['username'] = $username;

						# Get rows
						mysqli_stmt_bind_result($stmt, $user_id, $first_name, $last_name, $usergroup_id, $department_id);
						mysqli_stmt_fetch($stmt);

						# put results in session vars
						$_SESSION['user_id'] = $user_id;
						$_SESSION['first_name'] = $first_name;
						$_SESSION['last_name'] = $last_name;
						$_SESSION['usergroup_id'] = $usergroup_id;
						$_SESSION['department_id'] = $department_id;

						# delete the statement
						mysqli_stmt_close($stmt);

						#debug
						// echo $_SESSION['user_id'];
						// echo $_SESSION['first_name'];
						// echo $_SESSION['last_name'];
						// echo $_SESSION['usergroup_id'];
						// echo $_SESSION['department_id'];

						#redirect
						header('location:/main.php');

					} else {
						echo "<p>Your username or password was not correct.</p>";
						echo '<p><br><a href="index.php" class="button">Try Again</a></p><br>';
					}

					echo '<a href="help.php" title="Need Help?" alt="Need help?" class="helpbutton"><strong>&#63;</strong></a>';
					echo "</fieldset></form>";

				} else { ?>
					<form method="POST" action="index.php">
						<fieldset>
							<h3><strong>Please enter your username and password:</strong></h3>
							<label for="username">Username:</label>
							<input type="text" id="username" name="username" tabindex="1">
							<br>
							<label for="pass">Password:</label>
							<input type="password" id="pass" name="pass" tabindex="2"> 
							<br>
							<input type="submit" value="LOGIN" class="button" tabindex="3">
						</fieldset>
						<a href="help.php" title="Need Help?" alt="Need help?" class="helpbutton"><strong>&#63;</strong></a>
					</form>
				<?php
				}
			?>
				
			</div> <!-- end login-aside -->
			<img src="img/greenwell_bank.jpg" alt="colonial style brick bank building" class="building">
			<div id="content1">
				<p>Greenwell Bank policy requires all bank employees to complete several training courses each year. It is your responsibility to check on your progress regularly to ensure you meet the requirements.</p>
				<p>If you are experiencing difficulty logging in, and it is your first time logging into the system, please contact the IT Department. If you are not new to the system, but are experiencing difficulty logging in, please <a href="help.php">consult the help page</a>. Please contact the IT Department by creating a ticket on the intranet if you can not find a solution to your issue after consulting the help page.</p>
				<p>Have a beautiful day!</p>
			</div> <!-- end content1 -->

<?php 
	include('inc/footer.inc.php');
?>
