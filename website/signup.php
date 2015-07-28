<?php include "include/core.php"; ?>
<!DOCTYPE html>

<?php
	$title="Hoseki Team - Enter";
	$path="";
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
							if(!isset($_POST["username"]) && !isset($_POST["password"]) && !isset($_POST["re-password"]) && !isset($_POST["email"]) && !isset($_POST["re-email"])) {
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
						<?php if(!$logged): ?>
							<form id="signup-form" action="action/signup.php" method="post" onSubmit="return submit_form()">
								<table class="table-spaced">
									<tr class="bottom-aligned">
										<td>
											<label for="username">Username:</label><br>
											<input type="text" name="username" id="txt-username" value="<?= $username ?>">
										</td>
										<td>
											<div id="username-status"></div>
										</td>
									</tr>
									<tr class="top-aligned">
										<td>
											<label for="password">Password:</label><br>
											<input type="password" name="password" id="txt-password" value="<?= $password ?>>
											<div id="password-status"></div>
										</td>
										<td>
											<label for="re-password">Reinserisci la Password:</label><br>
											<input type="password" name="re-password" id="txt-re-password" autocomplete="off" value="<?= $re_password ?>><br>
											<div id="re-password-status"></div>
										</td>
									</tr>
									<tr class="top-aligned">
										<td>
											<label for="email">Email:</label><br>
											<input type="email" name="email" id="txt-email" value="<?= $email ?>><br>
											<div id="email-status"></div>
										</td>
										<td>
											<label for="re-email">Reinserisci l'Email:</label><br>
											<input type="email" name="re-email" id="txt-re-email" autocomplete="off" value="<?= $re_email ?>><br>
											<div id="re-email-status"></div>
										</td>
									</tr>
								</table>
								<input class="button-center" type="submit">
							</form>
						<?php else: ?>
							<h1>Sei già autenticato<br>Piccolo hacker in erba :)</h1>
						<?php endif ?>
					</div>
			</section>
		</div>
		
		<?php include "include/footer.php"; ?>
	</body>
</html>