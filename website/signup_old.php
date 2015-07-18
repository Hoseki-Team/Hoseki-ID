<?php
	require "include/constants.php";
	
	$mysqli = new mysqli($sql_host, $sql_user, $sql_password, $sql_database, $sql_port);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		$logged = false;
		return;
	}
	
	if (!$mysqli->set_charset("latin1")) {	# For escaping username correctly
		echo "Failed to change charset";
		$mysqli->close();
		return;
	}
	$username = $mysqli->escape_string($_POST["username"]);
	$email = $mysqli->escape_string($_POST["email"]);

	if (!$hash = password_hash($_POST["password"], PASSWORD_BCRYPT)) {	# Cause BCrypt system, password can't be longer than 72 characters
		echo "Failed to hash the password";
		$mysqli->close();
		return;
	}
	
	if (!$query = $mysqli->query("INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `game_id`, `usergroup`, `banned`, `uniquecode`) VALUES (NULL, '$username', '$hash', '$email', NULL, '0', '0', '0');")) {
		echo "Failed to execute the query: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	
	$mysqli->close();
?>