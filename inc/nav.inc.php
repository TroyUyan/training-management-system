			<div class="nav">

		    <?php
		    //create navigation for login page
		    if (!isset($_SESSION)) {
		    ?>
		        <ul>
		        	<li id="home"><a href=#wrapper alt="Return to Greenwell Bank Home">Home</a><li>
		        </ul>
		    <?php
		        //navigation for admin users
		        } elseif ($_SESSION['usergroup_id'] == 4) {
		    ?>
						<ul>
							<li id="home"><a href="main.php" alt="Admin Home Page">HOME</a></li>
							<li id="employee"><a href="employee_records.php" alt="Edit Employee Records">EMPLOYEE RECORDS</a></li>
							<li id="courses"><a href="courses.php" alt="Edit Courses">COURSES</a></li>
							<li id="departments"><a href="departments.php" alt="Edit Departments">DEPARTMENTS</a></li>
							<li id="user"><a href="users_view.php" alt="Edit Users">USERS</a></li>
							<li id="logout"><a href="logout.php" alt="Logout">LOG OUT</a></li>
						</ul>
		    <?php
		        //navigation for viewer users
		        } elseif ($_SESSION['usergroup_id'] == 3){
		    ?>
				    <ul>
				    	<li id="home"><a href="main.php" alt="Viewer Home Page">HOME</a></li>
						<li id="employee"><a href="employee_records.php" alt="View Employee Records">EMPLOYEE RECORDS</a></li>
						<li id="courses"><a href="courses.php" alt="View Courses">COURSES</a></li>
						<li id="departments"><a href="departments.php" alt="View Departments">DEPARTMENTS</a></li>
						<li id="user"><!-- <a href="users_view.php" alt="View Users">USERS</a> --></li>
						<li id="logout"><a href="logout.php" alt="Logout">LOG OUT</a></li>	
					</ul>
		    <?php
		        //navigation for coordinator users
		        } elseif ($_SESSION['usergroup_id'] == 2){
		    ?>
		             <ul>
		        		<li id="home"><a href="main.php" alt="Coordinator Home Page">HOME</a></li>
						<li id="employee"><a href="employee_records.php" alt="Edit Employee Records">EMPLOYEE RECORDS</a></li>
						<li id="courses"><a href="courses.php" alt="Add Courses">COURSES</a></li>
						<!-- view only for departments -->
						<li id="departments"><a href="departments.php" alt="View Departments">DEPARTMENTS</a></li>
						<li id="user"><!-- <a href="users_view.php" alt="View Users">USERS</a> --></li>
						<li id="logout"><a href="logout.php" alt="Logout">LOG OUT</a></li>	
		             </ul>
		    <?php
		        //navigation for employee users and default for fail
		        } else {
		    ?>
	                <ul>
	            		<li id="home"><!-- <a href="main.php" alt="Admin Home Page">HOME</a> --></li>
						<li id="employee"><!-- <a href="employee_records.php" alt="View Employee Records">EMPLOYEE RECORDS</a> --></li>
						<li id="courses"><!-- <a href="courses.php" alt="View Courses">COURSES</a> --></li>
						<li id="departments"><!-- <a href="departments.php" alt="View Departments">DEPARTMENTS</a> --></li>
						<li id="user"><!--<a href="users_view.php" alt="View Users">USERS</a> --></li>
						<li id="logout"><a href="logout.php" alt="Logout">LOG OUT</a></li>					
	                </ul>
	        <?php
	            } //close nav if
	        ?>
                
			</div> <!-- end nav -->
		</header>

		<div id="content" >

