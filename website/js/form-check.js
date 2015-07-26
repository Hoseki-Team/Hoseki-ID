var user_min_chars = 3;
var pass_min_chars = 6;
var ret = false;

//result texts  
var characters_error = 'Il numero minimo di caratteri è ';  
var checking_html = 'Controllo...';  

$(document).ready(function() {  
	//when button is clicked  
	$( '#txt-username' ).change(function() {
		check_username();
	});
	
	$( "#txt-password" ).change(function() {
		check_password();
	});
	
	$( "#txt-re-password" ).change(function() {
		check_re_password();
	});
	
	$("#txt-email").change(function() {
		check_email();
	});
	
	$("#txt-re-email").change(function() {
		check_re_email();
	});
});

function check_username() {
	//run the character number check
	if($('#txt-username').val().length < user_min_chars){  
		//if it's bellow the minimum show characters_error text '  
		$('#username-status').html(characters_error + user_min_chars);  
		$('#username-status').css("background-color","#D32F2F");
		ret = false;
	} else {  
		//else show the cheking_text and run the function to check  
		$('#username-status').html(checking_html);  
		ret = check_username_availability();  
	}
	$('#username-status').fadeIn("400");
}

function check_password() {
	//run the character number check
	if($("#txt-password").val().length < pass_min_chars){  
		//if it's bellow the minimum show characters_error text '
		$('#password-status').css("background-color","#D32F2F");
		$('#password-status').html(characters_error + pass_min_chars);  
		ret = false;
	} else {  
		//ok
		$('#password-status').html('Password valida');
		$('#password-status').css("background-color","#4CAF50");
		ret = true;
	}
	$('#password-status').fadeIn("400");
}

function check_re_password() {
	//run the character number check
	if($("#txt-re-password").val() != $("#txt-password").val()){  
		//if it's bellow the minimum show characters_error text '
		$('#re-password-status').css("background-color","#D32F2F");
		$('#re-password-status').html("Le password non coincidono");  
		ret = false;
	} else {  
		//ok
		$('#re-password-status').css("background-color","#4CAF50");
		$('#re-password-status').html('OK');
		ret = true;
	}
	$('#re-password-status').fadeIn("400");
}

function check_email() {
	//run the character number check
	$("#signup-form").validate();
	if(!$("#txt-email").valid()) {
		//if it's bellow the minimum show characters_error text '
		$('#email-status').css("background-color","#D32F2F");
		$('#email-status').html("L'email non è valida");
		ret = false;
	} else {
		//ok
		$('#email-status').css("background-color","#4CAF50");
		$('#email-status').html('Email valida');
		ret = true;
	}
	$('#email-status').fadeIn("400");
}

function check_re_email() {
	//run the character number check
	if($("#txt-re-email").val() != $("#txt-email").val()) {
		//if it's bellow the minimum show characters_error text '
		$('#re-email-status').css("background-color","#D32F2F");
		$('#re-email-status').html("L'email non corrisponde");
		ret = false;		
	} else {  
		//ok
		$('#re-email-status').css("background-color","#4CAF50");
		$('#re-email-status').html('OK');
		ret = true;
	}
	$('#re-email-status').fadeIn("400");
}
	

//function to check username availability  
function check_username_availability(){  

	//get the username
	var username = $('#txt-username').val();  
	ret = false;
	//use ajax to run the check  
	$.post("include/check_exist.php", { username: username, type: "username" }, function(result) {  
		//if the result is 1  
		if(result == 1){  
			//show that the username is available  
			$('#username-status').html(username + ' è disponibile');
			$('#username-status').css("background-color","#4CAF50");
			ret = true;
		}else{  
			//show that the username is NOT available  
			$('#username-status').html(username + ' non è disponibile');
			$('#username-status').css("background-color","#D32F2F");
			ret = false;
		}  
	}); 
	return ret;
}

// Check if all fields are valid
function submit_form() {
	if(check_username() && check_password() && check_re_password() && check_email() && check_re_password()) {
		console.log("true");
		return true;
	} else {
		console.log("false");
		return false;
	}
}