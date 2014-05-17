<?php 
	$page_title=" | Login";
	include ('inc/header.inc.php');
?>

			<div id="login-aside" class="clear">	
				
				<form method="Post" action="process_login.php">
					<fieldset>
						<p><strong>Please enter your username and password:</strong></p>
						<label for="username">Username:</label>
						<input id="username" type="text" name="username">
						<br>
						<label for="pass">Password:</label>
						<input id="pass" type="password" name="pass"> 
						<br>
						<input type="Submit" value="LOGIN" class="button">
					</fieldset>
					<a href="help.html" alt="Need help?" class="helpbutton"><strong>&#63;</strong></a>
				</form>

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