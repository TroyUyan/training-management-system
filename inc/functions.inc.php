<?php

	function admin_draw_users_view($dbc){

			$sql="SELECT * FROM gwb_training.users";

			$result = mysqli_query($dbc, $sql);

      echo "<table>\n";
      echo '<tr>
      		<th><a href="?sort=#">User ID</a></th>
      		<th><a href="?sort=#">Username</a></th>
      		<th><a href="?sort=#">First Name</a></th>
      		<th><a href="?sort=#">Last Name</a></th>
      		<th><a href="?sort=#">Group ID</a></th>
      		<th><a href="?sort=#">Dept. ID</a></th>
              <th>Actions</th>
      	  </tr>' . "\n";
      # loop through each record in the users table
      while ($row = mysqli_fetch_array($result)){
              echo "<tr class=\"center\">\n";
              echo "
              	<td>{$row['user_id']}</td>
              	<td>{$row['username']}</td>
              	<td>{$row['first_name']}</td>
              	<td>{$row['last_name']}</td>
              	<td>{$row['usergroup_id']}</td>
              	<td>{$row['department_id']}</td>
                  <td><a href=\"?edit={$row['user_id']}\"><img src='img/ico_edit.png' alt='Edit' title='Edit'></a> <a href=\"?delete={$row['user_id']}\" onclick=\"return confirm('Are you sure?');\"><img src='img/ico_x.png' alt='Delete' title='Delete'></a></td>\n";
              echo "</tr>\n";
      } # end of while loop
      echo "</table>\n";
	}

  function edit_user($dbc,$id){
          echo "<p>Editing Record: $id</p>";

          # generate SQL statement that will be used to get the complete row of data from the students table
          $sql = "SELECT * FROM users WHERE user_id=$id LIMIT 1";

          # get the array of data for the student_id being passed into function
          $result = mysqli_query($dbc,$sql);

          # now get the row of data from the array
          $row = mysqli_fetch_array($result);

          # assign the form variables to some variables
          # this will make it easier to use the values in the HTML form
          $first = $row['first_name'];
          $last = $row['last_name'];
  	?><!-- end PHP script temporarily -->
          <!-- Display HTML form -->
          <form method="POST" action="?update=<?php echo $id; ?>">
                  <label for="id">Student ID:</label>
                  <input type="text" name="id" value="<?php echo $row['student_id']; ?>" readonly>
                  
                  <label for="first_name">First Name:</label>
                  <input type="text" id="first_name" value="<?php echo $first; ?>" name="first_name">

									<label for="last_name">Last Name:</label>
                  <input type="text" id="last_name" value="<?php echo $last; ?>" name="last_name">

                  <input type="submit" value="Update and Save">
          </form>

  	<?php # resume PHP script
  } # end of edit_data function




  if (isset($_GET['edit'])) {

    # handle the ?edit

    # call the edit_date function
    # pass in $dbc and student_id from the URL
    edit_user($dbc, $_GET['edit']);
  }

	if (isset($_GET['update'])) { 

	  #handle the ?update

	  # generate SQL statement
	  $sql = "UPDATE users SET first_name='{$_POST['first_name']}', last_name='{$_POST['last_name']}' WHERE student_id={$_POST['id']}";
	  # query the database using the SQL
	  $result = mysqli_query($dbc,$sql);

	  # if the update was ok then display all student data
	  if($result){

	          # generate the SQL
	          $sql = "SELECT * FROM users";
	          # query the database
	          $result = mysqli_query($dbc, $sql);
	          # call the render_data() function to display all of the student data in a table
	          admin_draw_users_view($dbc);

	  } else {

	          # something didn't go well when trying to update the student record
	          echo "ruh roh....";

	  }
	}


?>