<?php 
	$page_title=" | View Employee Records";
	include ('inc/header.inc.php');
?>

	<?php

		if ($_SESSION['usergroup_id'] == 4 OR $_SESSION['usergroup_id'] == 2) {

			#Admin and coord
			echo "<h2>View Employee Records</h2>";
			echo "<p>View each user's training progress for each department.</p>";

      echo '<p><a href="records_add.php"> <img src="img/ico_add"> Add Course Results and Employee Records</a></p>';
      echo '<div class="clear"></div>';

      # if user clicks on the "view" action for a single user
      if (isset($_GET['view_user'])) {

      	$view_user_id = $_GET['view_user'];
      	$sql_view_user = "SELECT users.user_id, users.first_name, users.last_name, departments.department_id, departments.department_name, departments.required_courses
      										FROM users
      										INNER JOIN departments
      										on departments.department_id = users.department_id
      										WHERE user_id = $view_user_id";
      	$result_view_user = mysqli_query($dbc, $sql_view_user);

      	while ($row_view_user = mysqli_fetch_array($result_view_user)) {

      		echo "<br><hr><h3>Viewing records for {$row_view_user['first_name']} {$row_view_user['last_name']}</h3>";
      		echo "<p>Employee of {$row_view_user['department_name']}</p>";

      		# Query what user HAS taken

      		$sql_users_courses_name = "SELECT users_courses.user_id, users_courses.course_id, courses.course_name
					      										FROM users_courses
					      										INNER JOIN courses
					      										on users_courses.course_id = courses.course_id
					      										WHERE user_id = $view_user_id";

					$result_users_courses_name = mysqli_query($dbc, $sql_users_courses_name);

					echo "<h4>Completed Courses for {$row_view_user['department_name']}:</h4>";

					while ($row_users_courses_name = mysqli_fetch_array($result_users_courses_name)) {
						echo "<img src='img/ico_true.png'> {$row_users_courses_name['course_name']}<br>";
					}


					# Query what user HAS NOT taken

					$sql_users_courses_name2 = "SELECT course_id, course_name FROM courses
																		 WHERE department_id = {$row_view_user['department_id']} AND 
																		 course_id NOT IN
																		 (SELECT course_id FROM users_courses WHERE user_id = {$row_view_user['user_id']})";

					$result_users_courses_name2 = mysqli_query($dbc, $sql_users_courses_name2);

					echo "<h4>Incomplete Courses for {$row_view_user['department_name']}:</h4>";

					while ($row_users_courses_name2 = mysqli_fetch_array($result_users_courses_name2)) {
						echo "<img src='img/ico_false.png'> {$row_users_courses_name2['course_name']}<br>";
					}


					


					# compare is the emp fully trained or not
					$completed_courses = mysqli_num_rows($result_users_courses_name);
					$needed_courses = $row_view_user['required_courses'];
	      	echo "<h4>Completed $completed_courses courses out of $needed_courses required.</h4>";
	      	if ($completed_courses >= $needed_courses) {
          	echo "<p><img src='img/ico_true.png'> This employee is fully trained!</p>";
          } else {
          	$to_go = $needed_courses - $completed_courses;
          	echo "<p><img src='img/ico_false.png'> This employee needs $to_go more courses to be fully trained.</p>";
          }

	      	echo "<br><hr>";

				}

      } #end if _GET isset
      

      # main line to display information

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
	                <td style='text-align:left;'>";
	                if ($courses_complete >= $row_div['required_courses']) {
	                	echo "&nbsp;&nbsp;<img src='img/ico_true.png'> Complete";
	                } else {
	                	echo "&nbsp;&nbsp;<img src='img/ico_false.png'> Incomplete";
	                }
	              echo "</td>
	                <td><a href='?view_user={$row_inner['user_id']}'><img src='img/ico_mag.png' alt='View'></a></td>\n";
	              echo "</tr>\n";
	      } # end of inner while loop

	      echo "</table>\n";

	    } # end top-level loop



		} elseif ($_SESSION['usergroup_id'] == 3) {

						#Admin
			echo "<h2>View Employee Records</h2>";
			echo "<p>View each user's training progress for each department.</p>";
      echo '<div class="clear"></div>';

      # if user clicks on the "view" action for a single user
      if (isset($_GET['view_user'])) {

      	$view_user_id = $_GET['view_user'];
      	$sql_view_user = "SELECT users.user_id, users.first_name, users.last_name, departments.department_id, departments.department_name, departments.required_courses
      										FROM users
      										INNER JOIN departments
      										on departments.department_id = users.department_id
      										WHERE user_id = $view_user_id";
      	$result_view_user = mysqli_query($dbc, $sql_view_user);

      	while ($row_view_user = mysqli_fetch_array($result_view_user)) {

      		echo "<br><hr><h3>Viewing records for {$row_view_user['first_name']} {$row_view_user['last_name']}</h3>";
      		echo "<p>Employee of {$row_view_user['department_name']}</p>";

      		# Query what user HAS taken

      		$sql_users_courses_name = "SELECT users_courses.user_id, users_courses.course_id, courses.course_name
					      										FROM users_courses
					      										INNER JOIN courses
					      										on users_courses.course_id = courses.course_id
					      										WHERE user_id = $view_user_id";

					$result_users_courses_name = mysqli_query($dbc, $sql_users_courses_name);

					echo "<h4>Completed Courses for {$row_view_user['department_name']}:</h4>";

					while ($row_users_courses_name = mysqli_fetch_array($result_users_courses_name)) {
						echo "<img src='img/ico_true.png'> {$row_users_courses_name['course_name']}<br>";
					}


					# Query what user HAS NOT taken

					$sql_users_courses_name2 = "SELECT course_id, course_name FROM courses
																		 WHERE department_id = {$row_view_user['department_id']} AND 
																		 course_id NOT IN
																		 (SELECT course_id FROM users_courses WHERE user_id = {$row_view_user['user_id']})";

					$result_users_courses_name2 = mysqli_query($dbc, $sql_users_courses_name2);

					echo "<h4>Incomplete Courses for {$row_view_user['department_name']}:</h4>";

					while ($row_users_courses_name2 = mysqli_fetch_array($result_users_courses_name2)) {
						echo "<img src='img/ico_false.png'> {$row_users_courses_name2['course_name']}<br>";
					}


					


					# compare is the emp fully trained or not
					$completed_courses = mysqli_num_rows($result_users_courses_name);
					$needed_courses = $row_view_user['required_courses'];
	      	echo "<h4>Completed $completed_courses courses out of $needed_courses required.</h4>";
	      	if ($completed_courses >= $needed_courses) {
          	echo "<p><img src='img/ico_true.png'> This employee is fully trained!</p>";
          } else {
          	$to_go = $needed_courses - $completed_courses;
          	echo "<p><img src='img/ico_false.png'> This employee needs $to_go more courses to be fully trained.</p>";
          }

	      	echo "<br><hr>";

				}

      } #end if _GET isset
      

      # main line to display information

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
	                <td style='text-align:left;'>";
	                if ($courses_complete >= $row_div['required_courses']) {
	                	echo "&nbsp;&nbsp;<img src='img/ico_true.png'> Complete";
	                } else {
	                	echo "&nbsp;&nbsp;<img src='img/ico_false.png'> Incomplete";
	                }
	              echo "</td>
	                <td><a href='?view_user={$row_inner['user_id']}'><img src='img/ico_mag.png' alt='View'></a></td>\n";
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