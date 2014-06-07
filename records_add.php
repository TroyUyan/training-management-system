<?php 
	$page_title=" | Add Course Records";
	include ('inc/header.inc.php');
?>

	<?php

		if ($_SESSION['usergroup_id'] == 4) {
			#Admin

			if (isset($_GET['report_course'])) {

				$department_id = $_GET['report_course'];

				$sql = "SELECT department_name
								FROM departments
								WHERE department_id = $department_id";
				$result = mysqli_query($dbc, $sql);
				$rows = mysqli_fetch_array($result);

				$department_name = $rows['department_name'];

				echo "<h2>Adding Course Record for $department_name</h2>";



				//select box for which course
				//check boxes for all users
				echo "<br><hr><br>";
			}


			#break out ?>

			<h2>Add Course Records</h2>
			<p>After a training course has been completed, use this page to insert the record of the courses completion and which employees were present.</p>

			<p>Select which department had the training course:</p>

      <p>
				<?php #enter php again

          # query for department list
          $sql = "SELECT * FROM departments";
          $result = mysqli_query($dbc, $sql);

          # display options based on dept. table contents
          while ($rows = mysqli_fetch_array($result)) {
          	if ($rows['department_id'] > 0) {
          		echo "<a href='?report_course={$rows['department_id']}'><img src='img/ico_add'> {$rows['department_name']}</a><br><br>\n";
						}
          }
        // exit php ?>
			</p>

		<?php #resume
		} else {
			permission();
		}

	?>
			

<?php 
	include('inc/footer.inc.php');
?>