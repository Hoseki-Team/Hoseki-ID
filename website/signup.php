<?php include "include/core.php"; ?>
<!DOCTYPE html>

<?php
	$title="Hoseki Team - Enter";
	$path="";
?>

<html>
	<head>
<?php include "include/header.php"; ?>
		<script src="js/form-check.js" type="text/javascript" language="javascript"></script>
	</head>
	<body>
		<div id="container">		
<?php include "include/top_view.php"; ?>	
			<section id="content">
					<div class="block-center">
						<h1>Registrati</h1>
						
						<form action="signup.php" method="post">
							<table class="table-spaced">
								<tr class="bottom-aligned">
									<td>
										<label for="username">Username:</label><br>
										<input type="text" name="username" id="txt-username">
									</td>
									<td>
										<div id="username-status"></div>
									</td>
								</tr>
								<tr class="top-aligned">
									<td>
										<label for="password">Password:</label><br>
										<input type="password" name="password" id="txt-password">
										<div id="password-status"></div>
									</td>
									<td>
										<label for="re-password">Reinserisci la Password:</label><br>
										<input type="password" name="re-password" id="txt-re-password" autocomplete="off"><br>
										<div id="re-password-status"></div>
									</td>
								</tr>
								<tr class="top-aligned">
									<td>
										<label for="email">Email:</label><br>
										<input type="email" name="email" id="txt-email"><br>
										<div id="email-status"></div>
									</td>
									<td>
										<label for="re-email">Reinserisci l'Email:</label><br>
										<input type="email" name="re-email" id="txt-re-email" autocomplete="off"><br>
										<div id="re-email-status"></div>
									</td>
								</tr>
							</table>
							<input class="button-center" type="submit">
						</form>
					</div>
			</section>
		</div>
		
		<?php include "include/footer.php"; ?>
	</body>
</html>