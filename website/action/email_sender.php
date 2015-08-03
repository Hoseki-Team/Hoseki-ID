<?php

function send_email($type,$user_id) {
	$mysqli = new mysqli($sql_host, $sql_user, $sql_password, $sql_database, $sql_port);
	if ($mysqli->connect_errno) {
		$form_error = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error. "<br>";
		return false;
	}

	if(!$query = $mysqli->query("SELECT * FROM users WHERE 'user_id' = '$user_id'")) {
		echo "Failed to read data from database (" .$mysql->error. ")";
		$mysqli->close();
		return false;
	}
	if($query->num_rows != 1) {
		echo "Error with the number of users";
		$mysqli->close();
		return false;
	}
	$user_data = $query->fetch_array_assoc;

	switch ($type) {
	case "convalidation":
		$subject = "Convalida dell'account ".$user_data['username'];
		$headers = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: multipart/related; charset=iso-8859-1";
		$headers[] = "From: Hoseki ID <noreply@hosekid.it>";
		$headers[] = "Subject: {Convalida dell'account ".$subject."}";
		$headers[] = "X-Mailer: PHP/".phpversion();
		$to = $user_data["email"];
		$email = '
		<html>
			<head>
				<title>{$subject}</title>
			</head>
			<body>
				<div class="container">
					<img style="margin: auto;" src="hsk.png" title="Hoseki ID Logo" alt="Hoseki ID Logo">
				</div>
				
			</body>
		</html>
		'

		mail($to, $subject, $email, implode("\r\n", $headers));
	}
	
}
?>