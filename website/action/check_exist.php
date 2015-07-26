<?php
	if (!isset($_POST["type"]) || !isset($_POST["val"])) {
		echo "Arguments don't exist";
		return -1;
	}

	include "../include/constants.php";
	
	$mysqli = new mysqli($sql_host, $sql_user, $sql_password, $sql_database, $sql_port);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		return -1;
	}
	$val = $mysqli->escape_string($_POST["val"]);
	
	switch ($_POST["type"]) {
	case "username":
		
		if(!$query = $mysqli->query("SELECT username FROM users WHERE username = '$val'")) {
			echo "Query error: " . $mysqli->error;
			$mysqli->close();
		}
		if ($query->num_rows == 0) {
			echo "1";
		} else {
			echo "0";
		}
		break;
	case "email":
		if(!$query = $mysqli->query("SELECT email FROM 'users' WHERE 'email' = '$val'")) {
			$mysqli->close();
		}
		if ($query->num_rows == 0) {
			echo "1";
		} else {
			echo "0";
		}
		break;
	}
	$mysqli->close();
?>