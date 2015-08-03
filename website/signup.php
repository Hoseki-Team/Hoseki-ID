<?php include "include/core.php"; ?>
<!DOCTYPE html>

<?php
	$title="Hoseki Team - Enter";
	$path="";
	$registration = false;
	if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["re-password"]) && isset($_POST["email"]) && isset($_POST["re-email"]) && $logged == false) {
		$form_validity = true;
		$response_username = 1;
		#$response_username = http_post_fields("action/check_exist.php",array("type" => "username", "val" => $_POST["username"]));
		if ($response_username != "1") {
			$form_validity = false;
			$form_error = "Username non disponibile<br>";
		}
		$response_email = 1;
		#response_email = http_post_fields ("action/check_exist.php",array("type" => "email", "val" => $_POST["email"]));
		if ($response_email != "1" || $_POST["email"] > 254) {
			$form_validity = false;
			$form_error = "Email non disponibile<br>";
		}
		if (strlen($_POST["username"]) < 3 || strlen($_POST["username"]) > 32) {
			$form_validity = false;
			$form_error = "Lunghezza dell'username errata (tra 32 e 3 caratteri)<br>";
		}
		if (strlen($_POST["password"]) < 6 || strlen($_POST["password"]) > 72) {
			$form_validity = false;
			$form_error = "Lunghezza della password errata (tra 6 e 72 caratteri)<br>";
		}
		if ($_POST["password"] != $_POST["re-password"]) {
			$form_validity = false;
			$form_error = "Le password non coincidono<br>";
		}
		if ($_POST["email"] != $_POST["re-email"]) {
			$form_validity = false;
			$form_error = "Le email non coincidono<br>";
		}
		
		if ($form_validity) {
			$mysqli = new mysqli($sql_host, $sql_user, $sql_password, $sql_database, $sql_port);
				if ($mysqli->connect_errno) {
				$form_error = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error. "<br>";
				return false;
			}
			if (!$mysqli->set_charset("latin1")) {	# For escaping username correctly
				$form_error = "Failed to change charset<br>";
				$mysqli->close;
				return false;
			}
			$username = $mysqli->escape_string($_POST["username"]);
			$email = $mysqli->escape_string($_POST["email"]);

			if (!$hash = password_hash($_POST["password"], PASSWORD_BCRYPT)) {	# Cause BCrypt system, password can't be longer than 72 characters
				$form_error = "Failed to hash the password<br>";
				$mysqli->close;
				return false;
			}
			if(!$query = $mysqli->query("INSERT INTO users (username,password,email) VALUES ('$username','$hash','$email')")) {
				$form_error = "Failed to insert data into database (" .$mysql->error. ")<br>";
				$mysqli->close();
				return false;
			}
			$registration = true;
		}
	}
?>

<html>
	<head>
<?php include "include/header.php"; ?>
		<script src="js/form-check.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
	</head>
	<body>
		<div id="container">		
<?php include "include/top_view.php"; ?>	
			<section id="content">
					<div class="block-center">
						<?php
							if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["re-password"]) && isset($_POST["email"]) && isset($_POST["re-email"])) {
								$username = $_POST["username"];
								$password = $_POST["password"];
								$re_password = $_POST["re-password"];
								$email = $_POST["email"];
								$re_email = $_POST["re-email"];
							}
							else
							{
								$username = $password = $re_password = $email = $re_email = "";
							}

						?>
							<h1>Registrati</h1>
						<?php if(!empty($form_error) && !$logged) {
							echo '<div class="error-status">' . $form_error . '</div>';
						} ?>
						<?php if(!$logged && !$registration): ?>
							<form id="signup-form" action="signup.php" method="post" onSubmit="return submit_form()">
								<table class="table-spaced">
									<tr class="bottom-aligned">
										<td>
											<label for="username">Username:</label><br>
											<input type="text" name="username" id="txt-username" value="<?= $username ?>" maxlength="32">
										</td>
										<td>
											<div id="username-status"></div>
										</td>
									</tr>
									<tr class="top-aligned">
										<td>
											<label for="password">Password:</label><br>
											<input type="password" name="password" id="txt-password" value="<?= $password ?>" maxlength="60">
											<div id="password-status"></div>
										</td>
										<td>
											<label for="re-password">Reinserisci la Password:</label><br>
											<input type="password" name="re-password" id="txt-re-password" autocomplete="off" value="<?= $re_password ?>" maxlength="60"><br>
											<div id="re-password-status"></div>
										</td>
									</tr>
									<tr class="top-aligned">
										<td>
											<label for="email">Email:</label><br>
											<input type="email" name="email" id="txt-email" value="<?= $email ?>" maxlength="255"><br>
											<div id="email-status"></div>
										</td>
										<td>
											<label for="re-email">Reinserisci l'Email:</label><br>
											<input type="email" name="re-email" id="txt-re-email" autocomplete="off" value="<?= $re_email ?>" maxlength="255"><br>
											<div id="re-email-status"></div>
										</td>
									</tr>
								</table>
								<input class="button-center" type="submit">
							</form>
						<?php else if($logged): ?>
							<h1>Sei già autenticato<br>Piccolo hacker in erba :)</h1>
						<?php else if($registration): ?>
							<h3>Registrazione effettuata!<br>Ti verrà inviata un email con un link di conferma<br>Controlla la tua casella di posta elettronica il prima possibile</h3>
						<?php else: ?>
							<h2>Errore sconosciuto, contattare gli amministratori del sistema</h2>
						<?php endif ?>
					</div>
			</section>
		</div>
		
		<?php include "include/footer.php"; ?>
	</body>
</html>