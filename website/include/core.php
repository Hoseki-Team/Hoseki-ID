<?php
	require "constants.php";
	session_start();
	$logged = false;
	
	if (isset($_SESSION["username"]) && isset($_SESSION["user_id"]) && isset($_SESSION["email"]) && isset($_SESSION["usergroup"]) && isset($_SESSION["banned"])) {
		return true;
	}
	
	if (!isset($_COOKIE["username"]) || !isset($_COOKIE["password"])) {
		return false;
	}
	$mysqli = new mysqli($sql_host, $sql_user, $sql_password, $sql_database, $sql_port);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		return false;
	}
	if (!$mysqli->set_charset("latin1")) {	# For escaping username correctly
		echo "Failed to change charset";
		$mysqli->close;
		return false;
	}
	$username = $mysqli->escape_string($_COOKIE["username"]);

	if (!$hash = password_hash($_COOKIE["password"], PASSWORD_BCRYPT)) {	# Cause BCrypt system, password can't be longer than 72 characters
		echo "Failed to hash the password";
		$mysqli->close;
		return false;
	}
	if(!$query = $mysqli->query("SELECT * FROM `users` WHERE `username` = '$username'")) {
		$mysqli->close();
		return false;
	}
	$row = $query->fetch_assoc();
	if (!isset($row["password"])) {
		if (password_verify($_COOKIE["password"],$row["password"])) {
			setcookie($username, null);
			setcookie($hash, null);
		}
	}
	else {
		$_SESSION["username"] = $row["username"];
		$_SESSION["user_id"] = $row["user_id"];
		$_SESSION["email"] = $row["email"];
		$_SESSION["usergroup"] = $row["usergroup"];
		$_SESSION["banned"] = $row["banned"];
		$logged = true;
	}
	$mysqli->close();
	return $logged;
?>