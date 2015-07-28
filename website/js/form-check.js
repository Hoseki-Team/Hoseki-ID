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
	$('#username-status').css("color","#FFFFFF");
	if($('#txt-username').val().length < user_min_chars){  
		//if it's bellow the minimum show characters_error text '  
		$('#username-status').html(characters_error + user_min_chars);  
		$('#username-status').css("background-color","#D32F2F");
		ret = false;
	} else {
		var regCheck = new RegExp("[a-zA-Z0-9_\-~!\?\*]$");
		if (!regCheck.test($('#txt-username').val())) {
			$('#username-status').html("Puoi utilizzare lettere, numeri e i carrateri speciali: _ - ~ ! ? *");
			$('#username-status').css("background-color","#D32F2F");
			ret = false;
		} else {
		//else show the cheking_text and run the function to check
		$('#username-status').css("color","#212121");
		$('#username-status').css("background-color","#EFEFEF");
		$('#username-status').html(checking_html);
		ret = true;
		}
	}
	$('#username-status').fadeIn("400");
	return ret;
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
	return ret;
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
	return ret;
}

function check_email() {
	//run the character number check
	$('#email-status').css("color","#FFFFFF");
	$("#signup-form").validate();
	if(!$("#txt-email").valid()) {
		//if it's bellow the minimum show characters_error text '
		$('#email-status').css("background-color","#D32F2F");
		$('#email-status').html("L'email non è valida");
		ret = false;
	} else {
		//ok
		$('#email-status').css("color","#212121");
		$('#email-status').css("background-color","#EFEFEF");
		$('#email-status').html(checking_html);
		ret = true;
	}
	$('#email-status').fadeIn("400");
	return ret;
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
	return ret;
}
	

//function to check username availability  
function check_username_availability(){  
	//get the username
	var username = $('#txt-username').val();  
	var ret_username = true;
	//use ajax to run the check  
	$.post("action/check_exist.php", { val: username, type: "username" }, function(result) {
		$('#username-status').css("color","#FFFFFF");
		//if the result is 1  
		if(result == 1){  
			//show that the username is available  
			$('#username-status').html(username + ' è disponibile');
			$('#username-status').css("background-color","#4CAF50");
			ret_username = true;
		} else if (result == 0){  
			//show that the username is NOT available  
			$('#username-status').html(username + ' non è disponibile');
			$('#username-status').css("background-color","#D32F2F");
			ret_username = false;
		} else {
			$('#username-status').html(result);
			$('#username-status').css("background-color","#D32F2F");
			ret_username = false;
		}
	}); 
	return ret_username;
}

//function to check email availability  
function check_email_availability(){  

	//get the username
	var email = $('#txt-email').val();
	var ret_email = true;
	//use ajax to run the check
	$.post("action/check_exist.php", { val: email, type: "email" }, function(result) {
		$('#email-status').css("color","#FFFFFF");
		//if the result is 1  
		if(result == 1){  
			//show that the username is available  
			$('#email-status').html(email + ' è disponibile');
			$('#email-status').css("background-color","#4CAF50");
			ret_email = true;
		} else if (result == 0){  
			//show that the username is NOT available  
			$('#email-status').html(email + ' non è disponibile');
			$('#email-status').css("background-color","#D32F2F");
			ret_email = false;
		} else {
			$('#email-status').html(result);
			$('#email-status').css("background-color","#D32F2F");
			ret_email = false;
		}
	}); 
	return ret_email;
}



// Check if all fields are valid
function submit_form() {
	if(check_password() && check_re_password() && check_re_email()) {
		return true;
	} else {
		console.log("false");
		return false;
	}
}