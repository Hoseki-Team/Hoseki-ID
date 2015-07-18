<?php include "include/core.php"; ?>
<!DOCTYPE html>

<?php
	$title="Hoseki Team - Enter";
	$path="";
?>

<html>
	<head>
<?php include "include/header.php"; ?>
	<script type="text/javascript" language="javascript">
		$(document).ready(function() {  

			//the min chars for username  
			var min_chars = 3;

			//result texts  
			var characters_error = 'Il numero minimo di caratteri è 3';  
			var checking_html = 'Controllo...';  

			//when button is clicked  
			$( "#username" ).change(function() {
				//run the character number check
				$('#username-status').css("display","block");
				if($('#username').val().length < min_chars){  
					//if it's bellow the minimum show characters_error text '  
					$('#username-status').html(characters_error);  
				} else {  
					//else show the cheking_text and run the function to check  
					$('#username-status').html(checking_html);  
					check_username_availability();  
				}
			   });
			});

		//function to check username availability  
		function check_username_availability(){  

			//get the username  
			var username = $('#username').val();  

			//use ajax to run the check  
			$.post("include/check_exist.php", { username: username }, function(result) {  
				//if the result is 1  
				if(result == 1){  
					//show that the username is available  
					$('#username-status').html(username + ' è disponibile');
				}else{  
					//show that the username is NOT available  
					$('#username-status').html(username + ' è disponibile');  
				}  
			});  
		}
		</script>
	</head>
	
	<body>
		<div id="container">		
<?php include "include/top_view.php"; ?>	
			<section id="content">
					<div class="block">
						<h2>Registrati</h2>
						
						<form action="signup.php" method="post">
						<table class="invisible-row">
							<tr>
								<td><label for="username">Username:</label></td>
								<td><input type="text" name="username" require><br><div class="registration-status"><span id="username-status"></span></div></td>
							</tr>
							<tr>
								<td><label for="password">Password:</label></td>
								<td><label for="re-password">Reinserisci la Password:</td>
							</tr>
							<tr>
								<td><input type="password" name="password" require></td>
								<td><input type="password" name="re-password" autocomplete="off"><br><div class="registration-status"><span id="password-status"></span></div></td>
							</tr>
							<tr>
								<td><label for="email">Email:</label></td>
								<td><label for="re-email">Reinserisci l'Email:</label></td>
							</tr>
							<tr>
								<td><input type="email" name="email" require><br><div class="registration-status"><span id="email-exist"></span></div></td>
								<td><input type="email" name="re-email" autocomplete="off" require><br><div class="registration-status"><span id="email-status"></span></div></td>
							</tr>
							</table>
							<input class="button" type="submit">
						</form>
					</div>
			</section>
		</div>
		
		<?php include "include/footer.php"; ?>
	</body>
</html>