<?php

  /* user table functions */

	function admin_draw_users_view($dbc){

			$sql="SELECT * FROM gwb_training.users WHERE active = 1";

			$result = mysqli_query($dbc, $sql);

      echo "<table>\n";
      echo '<tr>
          		<th>User ID</th>
          		<th>Username</th>
          		<th>First Name</th>
          		<th>Last Name</th>
          		<th>Group ID</th>
          		<th>Dept. ID</th>
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
                <td><a href=\"?edit_user={$row['user_id']}\"><img src='img/ico_edit.png' alt='Edit' title='Edit'></a> &nbsp;<a href=\"?delete_user={$row['user_id']}\" onclick=\"return confirm('Make User #{$row['user_id']} In-active?');\"><img src='img/ico_x.png' alt='Delete' title='Delete'></a></td>\n";
              echo "</tr>\n";
      } # end of while loop
      echo "</table>\n";
	}

  function edit_user($dbc,$user_id){
      echo "<h2>Editing User ID: $user_id</h2>";

      if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if(!empty($_POST['pass']) &&
          !empty($_POST['first_name']) &&
          !empty($_POST['last_name']) &&
          !empty($_POST['usergroup_id'])
          ) {
            $pass = $_POST['pass'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $usergroup_id = $_POST['usergroup_id'];
            $department_id = $_POST['department_id'];
			
              
              $sql="UPDATE users 
                    SET pass = '{$_POST['pass']}', first_name = '{$_POST['first_name']}', last_name = '{$_POST['last_name']}', usergroup_id = '{$_POST['usergroup_id']}', department_id = '{$_POST['department_id']}'
                    WHERE user_id = $user_id";

              mysqli_query($dbc, $sql);

              if (mysqli_affected_rows($dbc) == 1) {
                  echo "<p><img src='img/ico_true.png'> The user information was successfully updated in the database!</p>";
              } else {
                  echo "<p><img src='img/ico_false.png'> Something has gone wrong, here is the SQL:<br>$sql</p>";
              }
               


        } else {
          echo "<p><img src='img/ico_false.png'> You did not fill out all of the form fields!</p>";
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
              <input type="text" name="username" value="<?php echo $username;?>" disabled="1">
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
                <?php #enter php again

                  # query for usergroup list
                  $sql = "SELECT * FROM usergroups";
                  $result = mysqli_query($dbc, $sql);

                  # display options based on usergroup table contents
                  while ($rows = mysqli_fetch_array($result)) {
                    $usergroup_option = "<option value='{$rows['usergroup_id']}'";
                      if ($rows['usergroup_id'] == $usergroup_id) {
                        $usergroup_option .= "selected='1'";
                      }
                    $usergroup_option .= ">{$rows['usergroup_name']}</option>\n";
                    echo "$usergroup_option";
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
                  // echo "<option value='{$rows['department_id']}'>{$rows['department_name']}</option>\n";

                  $department_option = "<option value='{$rows['department_id']}'";
                  if ($rows['department_id'] == $department_id) {
                    $department_option .= "selected='1'";
                  }
                  $department_option .= ">{$rows['department_name']}</option>\n";
                  echo "$department_option";
                }
                // exit php ?>
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

  if (isset($_GET['delete_user'])) {

    # handle ?delete_user=
    # write sql
    // $sql="DELETE FROM users
    //       WHERE user_id = {$_GET['delete_user']}";

    $sql="UPDATE users 
          SET active = 0
          WHERE user_id = {$_GET['delete_user']}";

    # perform Q
    mysqli_query($dbc, $sql);

    # check results
    if (mysqli_affected_rows($dbc) == 1) {
      echo "<p><img src='img/ico_true.png'> The user successfully marked as in-active in the database!</p>";
    } else {
      echo "<p><img src='img/ico_false.png'> Something has gone wrong, here is the SQL:<br>$sql</p>";
    }
  }


  /* department table functions */

  function admin_draw_departments_view($dbc){

      $sql="SELECT * FROM gwb_training.departments";

      $result = mysqli_query($dbc, $sql);

      echo "<table>\n";
      echo '<tr>
              <th>Dept. ID</th>
              <th>Dept. Name</th>
              <th>Required Courses</th>
              <th>Actions</th>
          </tr>' . "\n";
      # loop through each record in the users table
      while ($row = mysqli_fetch_array($result)){
              echo "<tr class=\"center\">\n";
              echo "
                <td>{$row['department_id']}</td>
                <td>{$row['department_name']}</td>
                <td>{$row['required_courses']}</td>
                <td><a href=\"?edit_department={$row['department_id']}\"><img src='img/ico_edit.png' alt='Edit' title='Edit'></a> &nbsp;<a href=\"?delete_department={$row['department_id']}\" onclick=\"return confirm('Delete Department #{$row['department_id']}?');\"><img src='img/ico_x.png' alt='Delete' title='Delete'></a></td>\n";
              echo "</tr>\n";
      } # end of while loop
      echo "</table>\n";
  }

  function edit_department($dbc,$department_id){
      echo "<h2>Editing Department ID: $department_id</h2>";

      if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if(!empty($_POST['department_name']) &&
          !empty($_POST['required_courses']) &&
          !empty($_POST['department_desc'])
          ) {
            $department_name = $_POST['department_name'];
            $required_courses = $_POST['required_courses'];
            $department_desc = $_POST['department_desc'];

            # check if id matches
            $sql = "SELECT department_id FROM departments WHERE department_id = $department_id";
            $result = mysqli_query($dbc, $sql);

            if (mysqli_num_rows($result) == 1) {
              
              $sql="UPDATE departments 
                    SET department_name = '$department_name', required_courses = '$required_courses', department_desc = '$department_desc'
                    WHERE department_id = $department_id";

             mysqli_query($dbc, $sql);

              if (mysqli_affected_rows($dbc) == 1) {
                  echo "<p><img src='img/ico_true.png'> The department information was successfully updated!</p>";
              } else {
                  echo "<p><img src='img/ico_false.png'> Something has gone wrong, here is the SQL:<br>$sql</p>";
              }

            } else {
              echo "<p><img src='img/ico_false.png'> That department ID does not match the one you are editing!</p>";
            }
                


        } else {
          echo "<p><img src='img/ico_false.png'> You did not fill out all of the form fields!</p>";
        } #End if with the fill-check
        
      } #End if-posted

          # generate SQL statement that will be used to get the complete row of data from the students table
          $sql = "SELECT * FROM departments WHERE department_id=$department_id LIMIT 1";
          # echo "$sql";

          # get the array of data for the student_id being passed into function
          $result = mysqli_query($dbc,$sql);

          # now get the row of data from the array
          $row = mysqli_fetch_array($result);

          # assign the form variables to some variables
          # this will make it easier to use the values in the HTML form
          $department_id = $row['department_id'];
          $department_name = $row['department_name'];
          $required_courses = $row['required_courses'];
          $department_desc = $row['department_desc'];
    ?><!-- end PHP script temporarily -->
          <!-- Display HTML form -->
      <form method="POST" action="?edit_department=<?php echo $department_id;?>" class="inputform departmentform">
        <p>
          <label>Department ID</label>
          <input type="text" name="department_id" value="<?php echo $department_id;?>" disabled="1">
        </p>
        <p>
          <label>Department Name</label>
          <input type="text" name="department_name" value="<?php echo $department_name;?>">
        </p>
        <p>
          <label>Required Courses</label>
          <input type="number" name="required_courses" min="0" value="<?php echo $required_courses;?>">
        </p>
        <p>
          <label>Department Description</label>
          <textarea name="department_desc" rows="4" cols="50"><?php echo $department_desc;?></textarea>
        </p>
        <input type="submit" value="Update Department Information" class="button">
      </form>
      <div class="clear"></div>

    <?php # resume PHP script
  } # end of edit_data function

  if (isset($_GET['edit_department'])) {

    # handle the ?edit
    # pass in $dbc and id from the URL
    edit_department($dbc, $_GET['edit_department']);
  }

  if (isset($_GET['delete_department'])) {

    # handle ?delete_user=
    # write sql
    // $sql="DELETE FROM users
    //       WHERE user_id = {$_GET['delete_user']}";

    $sql="DELETE FROM gwb_training.departments 
          WHERE department_id = {$_GET['delete_department']}";

    # perform Q
    mysqli_query($dbc, $sql);

    # check results
    if (mysqli_affected_rows($dbc) == 1) {
      echo "<p><img src='img/ico_true.png'> The department was successfully deleted from the database!</p>";
    } else {
      echo "<p><img src='img/ico_false.png'> Something has gone wrong, here is the SQL:<br>$sql</p>";
    }
  }



  /* course table functions */

  function admin_draw_courses_view($dbc){

    # divide the departments into seperate tables with their own courses
    $sql_div="SELECT department_id, department_name, required_courses
              FROM gwb_training.departments
              WHERE department_id > 0";
    $result_div = mysqli_query($dbc, $sql_div);

    # top-level loop starts
    while ($row_div = mysqli_fetch_array($result_div)){

      # each tables titles
      echo "<br>";
      echo "<h3>{$row_div['department_name']} (Dept. ID: {$row_div['department_id']})</h3>";
      echo "<h4>Required Courses: {$row_div['required_courses']}</h4>";
      $sql_count = "SELECT course_id
                    FROM gwb_training.courses
                    WHERE department_id = {$row_div['department_id']}";
      $result_count = mysqli_num_rows(mysqli_query($dbc, $sql_count));
      echo "<h4>Available Courses: $result_count</h4>";

      # each table
      echo "<table>\n";

      echo "<tr>
              <th>Course ID</th>
              <th>{$row_div['department_name']} Courses</th>
              <th>Actions</th>
            </tr>" . "\n";


      # loop through each course for this department
      $sql_inner = "SELECT course_id, course_name
                    FROM gwb_training.courses
                    WHERE department_id = {$row_div['department_id']}";
      $result_inner = mysqli_query($dbc, $sql_inner);

      while ($row = mysqli_fetch_array($result_inner)){
              echo "<tr class=\"center\">\n";
              echo "
                <td>{$row['course_id']}</td>
                <td>{$row['course_name']}</td>
                <td><a href=\"?delete_course={$row['course_id']}\" onclick=\"return confirm('Delete Course {$row['course_name']}?');\"><img src='img/ico_x.png' alt='Delete' title='Delete'></a></td>\n";
              echo "</tr>\n";
      } # end of inner while loop

      echo "</table>\n";

    } # end top-level loop

  } # end function




  if (isset($_GET['delete_course'])) {

    # handle ?delete_user=
    # write sql
    // $sql="DELETE FROM users
    //       WHERE user_id = {$_GET['delete_user']}";

    $sql="DELETE FROM gwb_training.courses 
          WHERE course_id = {$_GET['delete_course']}";

    # perform Q
    mysqli_query($dbc, $sql);

    # check results
    if (mysqli_affected_rows($dbc) == 1) {
      echo "<p><img src='img/ico_true.png'> The course was successfully deleted from the database!</p>";
    } else {
      echo "<p><img src='img/ico_false.png'> Something has gone wrong, here is the SQL:<br>$sql</p>";
    }
  }



  /* viewer-specific */

  function viewer_draw_courses_view($dbc){

    # divide the departments into seperate tables with their own courses
    $sql_div="SELECT department_id, department_name, required_courses
              FROM gwb_training.departments
              WHERE department_id > 0";
    $result_div = mysqli_query($dbc, $sql_div);

    # top-level loop starts
    while ($row_div = mysqli_fetch_array($result_div)){

      # each tables titles
      echo "<br>";
      echo "<h3>{$row_div['department_name']} (Dept. ID: {$row_div['department_id']})</h3>";
      echo "<h4>Required Courses: {$row_div['required_courses']}</h4>";
      $sql_count = "SELECT course_id
                    FROM gwb_training.courses
                    WHERE department_id = {$row_div['department_id']}";
      $result_count = mysqli_num_rows(mysqli_query($dbc, $sql_count));
      echo "<h4>Available Courses: $result_count</h4>";

      # each table
      echo "<table>\n";

      echo "<tr>
              <th>Course ID</th>
              <th>{$row_div['department_name']} Courses</th>
            </tr>" . "\n";


      # loop through each course for this department
      $sql_inner = "SELECT course_id, course_name
                    FROM gwb_training.courses
                    WHERE department_id = {$row_div['department_id']}";
      $result_inner = mysqli_query($dbc, $sql_inner);

      while ($row = mysqli_fetch_array($result_inner)){
              echo "<tr class=\"center\">\n";
              echo "
                <td>{$row['course_id']}</td>
                <td>{$row['course_name']}</td>\n";
              echo "</tr>\n";
      } # end of inner while loop

      echo "</table>\n";

    } # end top-level loop

  } # end function

  

  /* coordinator specific */
  function viewer_draw_departments_view($dbc){

      $sql="SELECT * FROM gwb_training.departments";

      $result = mysqli_query($dbc, $sql);

      echo "<table>\n";
      echo '<tr>
              <th>Dept. ID</th>
              <th>Dept. Name</th>
              <th>Required Courses</th>
              <th>Actions</th>
          </tr>' . "\n";
      # loop through each record in the users table
      while ($row = mysqli_fetch_array($result)){
              echo "<tr class=\"center\">\n";
              echo "
                <td>{$row['department_id']}</td>
                <td>{$row['department_name']}</td>
                <td>{$row['required_courses']}</td>
                <td><a href=\"?edit_department={$row['department_id']}\"><img src='img/ico_edit.png' alt='Edit' title='Edit'></a></td>\n";
              echo "</tr>\n";
      } # end of while loop
      echo "</table>\n";
  }




  /* Login and permission check */

  function loggedin($page_title) {
    if ($page_title==" | Login") {
      # on index.php
    } elseif ($page_title=="Help") {
	  # on help.php
	} elseif ($_SESSION['loggedin'] == 0) { ?>

      <script>
        alert("Warning!\n\nYou need to log in to access this page.\n\nYou will be redirected.");
        window.location.href='index.php';
      </script> 

    <?php }
  }

  function permission() {
  ?>
    <script>
      alert("Warning!\n\nYou do not have permission to view this page!\n\nYou will be redirected.");
      window.location.href='main.php';
    </script>  
  <?php
  }


?>
