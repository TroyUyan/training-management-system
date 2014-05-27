<?php

// INCLUDES
TOP.INC.PHP files
	LOGIN:
		SESSION, DB, HEADER

	LANDING PAGE AND ON:
		SESSION, DB, USER_GROUP/LOGIN CHECK(or die), FUNCTIONS, HEADER

BOTTOM.INC.PHP files
	LOGIN PAGE AND ON:
		CLOSE_DB, FOOTER
// END INCs
?>

<?php

DEFINE INCLUDES:

//HEADER

session.inc.php {
	session_start()
}

database_connection.inc.php {
	connect to database
	assign $dbc 
}

login_check.inc.php {
	if (usergroup !== 1 or 2 or 3 or 4) {
		die();
		redirect to login page
	}
}

functions.inc.php {
	all funcitons created (listed below)
}


//FOOTER

database_close.inc.php {
	mysqli_close function 
}

header.inc.php {
	all HTML for header
	has $pagetitle var 
}

footer.inc.php {
	all HTML for footer 
}


?>




<?php

// functions

function display_employee_table() {}


function usergroup_or_die ($group1,$group2,$group3,$group4) {

	if ($_SESSION['usergroup_id'] == 1 and $group1 !== 1) {
		die and redirect
	} elseif ($_SESSION['usergroup_id'] == 2 and $group2 !== 1) {
		die and redirect
	} elseif ($_SESSION['usergroup_id'] == 3 and $group3 !== 1) {
		die and redirect
	} elseif ($_SESSION['usergroup_id'] == 4 and $group4 !== 1) {
		die and redirect
	}

/*
Use by telling which usergroups are allowed with a '1'

Ie:
usergroup_or_die(1,1,0,0)
*/

} // END FUNCTION usergroup_or_die





?>


<?php

LOGIN PAGE:

display logo, name, intro msg, etc.
display login form 

if ($_SERVER['REQUEST_METHOD'] == POST) {

	if ($user, $pass = SQL $user, SQL $pass) {
		then assign session vars
			(first_name, last_name, usergroup, dept_id)
		and redirect to landing page
	} else {
		display error message
		display sticky(on username, not pass) form
	}

} else {
	display initial login form
}
?>


<?php

LANDING PAGE

if usergroup == 1 {

	// ADMIN
	display all admin functions
		display name (from $_SESSION) and greeting
		display action buttons {
			edit employee records
			edit courses
			edit departments
			edit users 
		}

} elseif usergroup == 2 {

	//VIEWER
	display all viewer functions
		display name (from $_SESSION) and greeting
		display action buttons {
			view employees
			view courses
			view departments
		}


} elseif usergroup == 3 {

	//COORD
	display all coordinator functions
		display name (from $_SESSION) and greeting
		display action buttons {
			add courses
			edit employee records
			view departments  // VIEW not edit
		}

} elseif usergroup == 4 {

	//EMPLOYEE

	display all employee functions
		query db {
			get department name, desc, courses
			get all courses in that dept
			get all courses user_id has taken
		}
	display name and greeting
	display department name and desc
	display how many courses taken and how many required
	display a table of completed courses
	display a table of courses user could-take
}

?>

<?php

EMPLOYEE RECORD VIEW:

function (check_usergroup or die)
	usergroup 4 not allowed.

display select forms to select the department, or all_depts view

function (display employee table)
	in this function 
		usergroup 1 and 3 can see edit
		usergroup 2 has no edit options

?>
