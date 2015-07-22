$(document).ready(function() {  

	//the min chars for username  
	var user_min_chars = 3;
	var pass_min_chars = 6;

	//result texts  
	var characters_error = 'Il numero minimo di caratteri è ';  
	var checking_html = 'Controllo...';  

	//when button is clicked  
	$( '#txt-username' ).change(function() {
		//run the character number check
		//$('#username-status').css("display","inline-block");
		if($('#txt-username').val().length < user_min_chars){  
			//if it's bellow the minimum show characters_error text '  
			$('#username-status').html(characters_error + user_min_chars);  
			$('#username-status').css("background-color","#D32F2F");
		} else {  
			//else show the cheking_text and run the function to check  
			$('#username-status').html(checking_html);  
			check_username_availability();  
		}
		$('#username-status').fadeIn("400");
	});
	
	$( "#txt-password" ).change(function() {
		//run the character number check
		//$('#password-status').css("display","block");
		if($(this).val().length < pass_min_chars){  
			//if it's bellow the minimum show characters_error text '
			$('#password-status').css("background-color","#D32F2F");
			$('#password-status').html(characters_error + pass_min_chars);  
		} else {  
			//ok
			$('#password-status').html('Password valida');
			$('#password-status').css("background-color","#4CAF50");
		}
		$('#password-status').fadeIn("400");
	});
	
	$( "#txt-re-password" ).change(function() {
		//run the character number check
		//$('#password-status').css("display","block");
		if($(this).val() != $("#txt-password").val()){  
			//if it's bellow the minimum show characters_error text '
			$('#re-password-status').css("background-color","#D32F2F");
			$('#re-password-status').html("Le password non sono identiche");  
		} else {  
			//ok
			$('#re-password-status').css("background-color","#4CAF50");
			$('#re-password-status').html('Password identica');
		}
		$('#re-password-status').fadeIn("400");
	});
});
	

//function to check username availability  
function check_username_availability(){  

	//get the username  
	var username = $('#txt-username').val();  

	//use ajax to run the check  
	$.post("include/check_exist.php", { username: username, type: "username" }, function(result) {  
		//if the result is 1  
		if(result == 1){  
			//show that the username is available  
			$('#username-status').html(username + ' è disponibile');
			$('#username-status').css("background-color","#4CAF50");
		}else{  
			//show that the username is NOT available  
			$('#username-status').html(username + ' non è disponibile');
			$('#username-status').css("background-color","#D32F2F");
		}  
	});  
}