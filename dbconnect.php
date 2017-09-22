<?php

	$dbconnect = mysqli_connect("localhost", "iffdbuser1", "iffdb123","iff_db");
	mysqli_set_charset($dbconnect,"utf8");
	if(mysqli_connect_errno()) {
		echo "Connection failed:could not find Database".mysqli_connect_error();
		exit;
	}

?>