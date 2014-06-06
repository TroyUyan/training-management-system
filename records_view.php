<?php 
	$page_title=" | View Employee Records";
	include ('inc/header.inc.php');
?>

	<h2>View Employee Records</h2>
	<p>View each user's training progress for each department.</p>

	<?php

		if ($_SESSION['usergroup_id'] == 4) {


			#Admin
      echo '<p><a href="records_add.php"> <img src="img/ico_add"> Add Employee Records</a></p>';
      echo '<div class="clear"></div>';
      

      # divide the departments into seperate tables with their own courses
	    $sql_div="SELECT department_id, department_name, required_courses
	              FROM gwb_training.departments
	              WHERE department_id > 0";
	    $result_div = mysqli_query($dbc, $sql_div);

	    # top-level loop starts
	    while ($row_div = mysqli_fetch_array($result_div)){

	      # each tables titles
	      echo "<br>";
	      echo "<h3>{$row_div['department_name']}</h3>";
	      echo "<h4>Required Courses: {$row_div['required_courses']}</h4>";
	      $sql_count = "SELECT course_id
	                    FROM gwb_training.courses
	                    WHERE department_id = {$row_div['department_id']}";
	      $result_count = mysqli_num_rows(mysqli_query($dbc, $sql_count));
	      echo "<h4>Available Courses: $result_count</h4>";

	      # each table
	      echo "<table>\n";

	      echo "<tr>
	              <th>Employee Name</th>
	              <th>Training Progress</th>
	              <th>Training Status</th>
	              <th>Actions</th>
	            </tr>" . "\n";


	      # loop through each course for this department
	      $sql_inner = "SELECT user_id, first_name, last_name
	                    FROM gwb_training.users
	                    WHERE department_id = {$row_div['department_id']}
	                    AND active = 1";
	      $result_inner = mysqli_query($dbc, $sql_inner);

	      while ($row_inner = mysqli_fetch_array($result_inner)){

	      				$sql_users_courses = "SELECT user_id FROM gwb_training.users_courses
	      															WHERE user_id = {$row_inner['user_id']}";
	      				$courses_complete = mysqli_num_rows(mysqli_query($dbc, $sql_users_courses));

	              echo "<tr class=\"center\">\n";
	              echo "
	                <td>{$row_inner['first_name']} {$row_inner['last_name']}</td>
	                <td>$courses_complete &nbsp;/&nbsp; {$row_div['required_courses']}</td>
	                <td>";
	                if ($courses_complete >= $row_div['required_courses']) {
	                	echo "<img src='img/ico_true.png'> Complete";
	                } else {
	                	echo "<img src='img/ico_false.png'> Incomplete";
	                }
	              echo "</td>
	                <td>Actions</td>\n";
	              echo "</tr>\n";
	      } # end of inner while loop

	      echo "</table>\n";

	    } # end top-level loop



		} else {
			permission();
		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>