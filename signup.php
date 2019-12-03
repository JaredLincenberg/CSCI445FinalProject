<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>Miner</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="header.css" />
</head>
<body>
	<?php 
	  $path = "";
	  $thisPage = "signup";
	  include 'templateHeader.php';
	  // password_hash($_POST["password"], PASSWORD_BCRYPT, $options );
	?>
	
	<!-- Body of Web Page -->
	<main>
		<!-- Sign Up Form -->
		<form class="entry-form" id="sign-up" action="signup_submit.php" method="post">
			<!-- Get information about User -->
			<fieldset class="user-id-form">
				
				<label for="firstname">First Name:
				<input type="text" name="firstname" id="firstname" pattern="[A-Za-z ']{1,50}" title="Letters, spaces, and apostrophes only"
				required value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>"> 
				<span class="error">*</span></label>
				<br>

				<label for="lastname">Last Name: 
				<input type="text" name="lastname" id="lastname" pattern="[A-Za-z ']{1,50}" title="Letters, spaces, and apostrophes only"
				required value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'];?>">
				<span class="error">*</span></label>
				<br>

				<label for="email">E-mail: 
				<input type="email" name="email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" 
				value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
				<span class="error">*</span></label> 
			    <br>

				<label for="password"> Password
					<input type="password" name="password" required="required" id="password"
					pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" 
					title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters">
				<span class="error">*</span></label>
				</label>
				<br>
				
				<label for="retype_password"> Retype Password
				<input type="password" required="required" Password: name="retype_password" id="retype_password">
				<span class="error">*</span>
				</label>
				
				<br>
			</fieldset>
			<fieldset>
			  <p><span class="error">* required field</span></p>
			  <label for="reset" style="display:none;" >Reset:</label>
			  <input class="button" type="reset" name="reset" id="reset" value="Reset">  
			  <input class="button" type="submit" name="submit" value="submit" onclick="return checkform()">  
			</fieldset>
		</form>
	</main>

<script>

//check if confirm information are same.
function checkform() {
	var validinput = true;	
	var password1 = document.getElementById("password").value;
	var password2 = document.getElementById("retype_password").value;
	if (password1 === password2){
        validinput = true;
    } else {
		alert("Password and confirm password must be the same!");
        validinput = false;
    }
	
	return validinput;
}
</script>	
</body>
</html>