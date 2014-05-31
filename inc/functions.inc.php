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
                  <td><a href=\"?edit_user={$row['user_id']}\"><img src='img/ico_edit.png' alt='Edit' title='Edit'></a> <a href=\"?delete_user={$row['user_id']}\" onclick=\"return confirm('Delete User #{$row['user_id']}?');\"><img src='img/ico_x.png' alt='Delete' title='Delete'></a></td>\n";
              echo "</tr>\n";
      } # end of while loop
      echo "</table>\n";
	}

  function edit_user($dbc,$user_id){
          echo "<h2>Editing User ID: $user_id</h2>";

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

            $sql="UPDATE users 
                  SET username = '{$_POST['username']}', pass = '{$_POST['pass']}', first_name = '{$_POST['first_name']}', last_name = '{$_POST['last_name']}', usergroup_id = '{$_POST['usergroup_id']}', department_id = '{$_POST['department_id']}'
                  WHERE user_id = $user_id";

            mysqli_query($dbc, $sql);

            if (mysqli_affected_rows($dbc) == 1) {
              echo "<p>The user information was successfully updated in the database!</p>";
            } else {
              echo "<p>Something has gone wrong, here is the SQL:<br>$sql</p>";
            }

        } else {
          echo "<p>You did not fill out all of the form fields!</p>";
        } #End if with the fill-check
        
      } #End if-posted

          # generate SQL statement that will be used to get the complete row of data from the students table
          $sql = "SELECT * FROM users WHERE user_id=$user_id LIMIT 1";

          # get the array of data for the student_id being passed into function
          $result = mysqli_query($dbc,$sql);

          # now get the row of data from the array
          $row = mysqli_fetch_array($result);

          # assign the form variables to some variables
          # this will make it easier to use the values in the HTML form
          $user_id = $row['user_id'];
          $username = $row['username'];
          $pass = $row['pass'];
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $usergroup_id = $row['usergroup_id'];
          $department_id = $row['department_id'];
  	?><!-- end PHP script temporarily -->
          <!-- Display HTML form -->

          <form method="POST" action="?edit_user=<?php echo $user_id;?>" class="inputform clear">
            <p>
              <label>User ID</label>
              <input type="text" name="user_id" value="<?php echo $user_id;?>" disabled="1">
            </p>
            <p>
              <label>Username</label>
              <input type="text" name="username" value="<?php echo $username;?>">
            </p>
            <p>
              <label>Password</label>
              <input type="text" name="pass" value="<?php echo $pass;?>">
            </p>
            <p>
              <label>First Name</label>
              <input type="text" name="first_name" value="<?php echo $first_name;?>">
            </p>
            <p>
              <label>Last Name</label>
              <input type="text" name="last_name" value="<?php echo $last_name;?>">
            </p>
            <p>
              <label>Usergroup</label>
              <select name="usergroup_id">
                <option value="1" <?php if($usergroup_id == 1){echo 'selected="1"';}?>>Employee</option>
                <option value="2" <?php if($usergroup_id == 2){echo 'selected="1"';}?>>Coordinator</option>
                <option value="3" <?php if($usergroup_id == 3){echo 'selected="1"';}?>>Viewer</option>
                <option value="4" <?php if($usergroup_id == 4){echo 'selected="1"';}?>>Admin</option>
              </select>
            </p>
            <p>
              <label>Department</label>
              <select name="department_id">
                <option value="1" <?php if($department_id == 1){echo 'selected="1"';}?>>Department One</option>
                <option value="0" <?php if($department_id == 0){echo 'selected="1"';}?>>-- NO DEPARTMENT --</option>
              </select>
            </p>
            <input type="submit" value="Update User Information" class="button">
          </form>
          <div class="clear"></div>

  	<?php # resume PHP script
  } # end of edit_data function




  if (isset($_GET['edit_user'])) {

    # handle the ?edit
    # pass in $dbc and id from the URL
    edit_user($dbc, $_GET['edit_user']);
  }


?>