<?php 
	$page_title=" | Login";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>
	<h3>Welcome <?php echo "{$_SESSION['first_name']} {$_SESSION['last_name']}";?>!</h3>

	<?php
		if ($_SESSION['usergroup_id'] == 4) {
			
			#Admin
			echo "<p>Usergroup: Admin</p>";
			?>

			<div class="tablesection">
				<h3>Users Table</h3>
				<a href="users_add.php"><p class="button">Add New User</p></a>
				<a href="#"><p class="button">View All Users</p>
				<a href="#"><p class="button">Edit Employee Records</p>
			</div>

			<table>
				<tr>
					<th>Users Table</th>
				</tr>
				<tr>
					<td class="button"><a href="users_add.php">Add New User</td>
				</tr>
				<tr>
					<td class="button"><a href="#">View All Users</a></td>
				</tr>
				<tr>
					<td class="button"><a href="#">Edit Employee Records</a></td>
				</tr>
			</table>

		<?php

			
		} elseif ($_SESSION['usergroup_id'] == 3) {

			#Viewer
			echo "Viewer";



		} elseif ($_SESSION['usergroup_id'] == 2) {

			#Coordinator
			echo "Coordinator";


		} elseif ($_SESSION['usergroup_id'] == 1) {

			#Employee
			echo "Employee";

			
		} else {

			#error-out

		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>