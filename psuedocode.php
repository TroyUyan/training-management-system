<?php
	if (condition) {
		# code...
	} elseif (condition) {
		# code...
	} else {
		# code...
	}
	
?>


TOP.INC.PHP files
	LOGIN:
		SESSION, DB, HEADER

	LANDING PAGE AND ON:
		SESSION, DB, USER_GROUP/LOGIN CHECK, FUNCTIONS, HEADER

BOTTOM.INC.PHP files
	LOGIN PAGE AND ON:
		CLOSE_DB, FOOTER





LOGIN
if $user, $pass = SQL $user, SQL $pass
	then assign session vars
		(first_name, last_name, usergroup, dept_id)
	and redirect to landing page



LANDING PAGE
if usergroup == 1 {
	display all admin functions
} elseif usergroup == 2 {
	display all viewer functions
} elseif usergroup == 3 {
	display all coordinator functions
} elseif usergroup ==






