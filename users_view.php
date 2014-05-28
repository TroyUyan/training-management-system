<?php 
	$page_title=" | View Users";
	include ('inc/header.inc.php');
?>

	<h2>Training Tracking Management System</h2>
	<h3>View Users Table</h3>

	<?php

		if ($_SESSION['usergroup_id'] == 4) {

			#Admin

			$sql="SELECT * FROM gwb_training.users";

			$result = mysqli_query($dbc, $sql);

            echo "<table>\n";
            echo '<tr>
            		<th>Actions</th>
            		<th><a href="?sort=#">User ID</a></th>
            		<th><a href="?sort=#">Username</a></th>
            		<th><a href="?sort=#">First Name</a></th>
            		<th><a href="?sort=#">Last Name</a></th>
            		<th><a href="?sort=#">Usergroup ID</a></th>
            		<th><a href="?sort=#">Department ID</a></th>
            	  </tr>' . "\n";
            # loop thru each record in the students table
            while ($row = mysqli_fetch_array($result)){
                    echo "<tr class=\"center\">\n";
                    echo "
                    	<td><a href=\"?edit={$row['user_id']}\">Edit</a> <a href=\"?delete={$row['user_id']}\" onclick=\"return confirm('Are you sure?');\">Delete</a></td>
                    	<td>{$row['user_id']}</td>
                    	<td>{$row['username']}</td>
                    	<td>{$row['first_name']}</td>
                    	<td>{$row['last_name']}</td>
                    	<td>{$row['usergroup_id']}</td>
                    	<td>{$row['department_id']}</td>\n";
                    echo "</tr>\n";
            } # end of while loop
            echo "</table>\n";

			


		} else {
			#error-out
		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>