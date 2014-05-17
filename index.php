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

					# test data
					// echo "<p>We have posted</p>";
					// echo "$username<br>$pass";

					# Now query the database to see if you get a match for username/password
					$sql = "SELECT * FROM users WHERE username='$username' AND pass='$pass'"; 
					
					# debug statement
					# echo $sql;

					# perform the query
					$result = mysqli_query($dbc,$sql);

					# debug statement
					#var_dump($result);

					if (mysqli_num_rows($result) == 1) {
						# username and password match
						# Now set a session variable
						$_SESSION['loggedin'] = 1;
						$_SESSION['username'] = $username;

						# Get rows
						$rows = mysqli_fetch_array($result);

						$_SESSION['user_id'] = $rows['user_id'];
						$_SESSION['first_name'] = $rows['first_name'];
						$_SESSION['last_name'] = $rows['last_name'];
						$_SESSION['usergroup_id'] = $rows['usergroup_id'];
						$_SESSION['department_id'] = $rows['department_id'];

						// echo $_SESSION['user_id'];
						// echo $_SESSION['first_name'];
						// echo $_SESSION['last_name'];
						// echo $_SESSION['usergroup_id'];
						// echo $_SESSION['department_id'];

						echo "<p>You are now logged in!</p>";
						echo '<br><p><a href="main.php" class="button">Enter System</a></p>';

					} else {
						echo "<p>I'm sorry but your login info was not correct.</p>";
						echo "<p><a href=\"index.php\">Go back</a> and try again.</p>";
					}

					echo "</fieldset></form>";

				} else { ?>
					<form method="POST" action="index.php">
						<fieldset>
							<p><strong>Please enter your username and password:</strong></p>
							<label for="username">Username:</label>
							<input type="text" id="username" name="username">
							<br>
							<label for="pass">Password:</label>
							<input type="password" id="pass" name="pass"> 
							<br>
							<input type="submit" value="LOGIN" class="button">
						</fieldset>
						<a href="help.html" alt="Need help?" class="helpbutton"><strong>&#63;</strong></a>
					</form>
				<?php
				}
			?>
				
			</div> <!-- end login-aside -->
			<img src="img/greenwell_bank.png" alt="colonial style brick bank building" class="building">
			<div id="content1">
				<p>The Training Tracking Management System was created by Dark Side Development for Greenwell Bank because Mr. Greenwell loves his employees. If you are experiencing difficulty logging in, and it is your first time logging into the system, please contact the IT Department. If you are not new to the system, but are experiencing difficulty logging in, please consult the help page. Please contact the IT Department by creating a ticket on the intranet if you can not find a solution to your issue after consulting the help page.</p>
				<p>Greenwell Bank policy requires all bank employees to complete several training courses each year. It is your responsibility to check on your progress regularly to ensure you meet the requirements.</p>
				<p>Have a beautiful day.</p>
			</div> <!-- end content1 -->

<?php 
	include('inc/footer.inc.php');
?>