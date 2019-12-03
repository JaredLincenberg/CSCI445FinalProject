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
		$thisPage = "reset_password";
		include 'templateHeader.php';
		include 'connect.php';
	?>
	
	<main>
		<!-- find password form -->
		<h2>Find Password</h2>
		<form class="entry-form" id="log-in" method="post">
			<fieldset class="user-id-form">
				<label for="FirstName"> First Name
					<input type="text" name="firstname" pattern="[A-Za-z ']{1,50}" title="Letters, spaces, and apostrophes only"
				required value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>">
				</label>

				<label for="LastName"> Last Name
					<input type="text" name="lastname" pattern="[A-Za-z ']{1,50}" title="Letters, spaces, and apostrophes only" required value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'];?>">
				</label>

				<label for="Email"> Email
					<input type="email" name="email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" 
					value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
				</label>
				
			</fieldset>
			<fieldset>
				<input type="hidden" name="time" value="<?php echo time();?>">
				<input type="submit" name="reset" value="Reset Password">
				<p>* By clicking the reset password button, a temporary password will be sent to your email.</p>
			</fieldset>
		</form>
	</main>
	<?php
	/*
	require_once('connect.php');
	if(isset($_POST) & !empty($_POST)){
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$sql = "SELECT * FROM `login` WHERE username = '$username'";
		$res = mysqli_query($connection, $sql);
		$count = mysqli_num_rows($res);
		if($count == 1){
			echo "Send email to user with password";
		}else{
			echo "User name does not exist in database";
		}
	}

	$r = mysqli_fetch_assoc($res);
	$password = $r['password'];
	$to = $r['email'];
	$subject = "Your Recovered Password";

	$message = "Please use this password to login " . $password;
	$headers = "From : vivek@codingcyber.com";
	if(mail($to, $subject, $message, $headers)){
		echo "Your Password has been sent to your email id";
	}else{
		echo "Failed to Recover your password, try again";
	}

	$r = mysqli_fetch_assoc($res);
	$password = $r['password'];
	$to = $r['email'];
	$subject = "Your Recovered Password";
	 
	$message = "Please use this password to login " . $password;
	$headers = "From : vivek@codingcyber.com";
	if(mail($to, $subject, $message, $headers)){
		echo "Your Password has been sent to your email id";
	}else{
		echo "Failed to Recover your password, try again";
	}
	$password = rand(999, 99999);
	$password_hash = md5($pass);	*/
	?>
</body>
</html>