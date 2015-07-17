<?php include "include/core.php"; ?>
<!DOCTYPE html>

<?php
	$title="Hoseki Team - Enter";
	$path="";
?>

<html>
	<head>
<?php include "include/header.php"; ?>
	</head>
	
	<body>
		<div id="container">		
<?php include "include/top_view.php"; ?>	
			<section id="content">
					<div class="block">
						<h2>Entra</h2>
						<form action="login.php" method="post">
							Username: <input type="text" name="username"><br>
							Password: <input type="password" name="password"><br>
							<input type="submit">
						</form>
						<h2>Registrati</h2>
						<form action="signup.php" method="post">
							Username: <input type="text" name="username"><br>
							Password: <input type="password" name="password"><br>
							Email: <input type="email" name="email"><br>
							<input type="submit">
						</form>
					</div>
			</section>
		</div>
		
		<?php include "include/footer.php"; ?>
	</body>
</html>