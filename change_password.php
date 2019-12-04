<?php
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	include 'connect.php';
	if(array_key_exists('passwordVerified',$_SESSION)){
		if (!isset($_SESSION["passwordVerified"])) {
			header("Location: login.php");
		}
	}
	else{
		header("Location: login.php");
	}
	if (isset($_POST['submit']))  {
		//Confuse about how to pass the user name or id through login page.
		//this two lines should be replaced.
		$firstname = $_SESSION["userfname"];
		$lastname = $_SESSION["userlname"];
		$email = $_SESSION["useremail"];
		$newpassword=$_POST['new_password'];
		$confirm_password = $_POST['retype_password'];
		$oldpassword = $_POST['old_password'];
		$querycheck="SELECT password FROM USERS WHERE FirstName=? AND LastName=?";
		$stmt = $mysqli->prepare( $querycheck );
		$stmt->bind_param( "ss", $fname, $lname);
		$fname = $firstname;
		$lname = $lastname;
		$stmt->execute();
		$res = $stmt->get_result();
		$row=mysqli_fetch_array($res);
		if(!is_null($row[0])) {
			$hash = $row[0];
			$valid = password_verify ( $oldpassword, $hash );
			if($valid){
				//verify two passwords are the same.
				if($newpassword == $confirm_password){
					//change password
					$options = ['cost' => 12,];
					$hashpassword = password_hash($newpassword, PASSWORD_BCRYPT, $options );	
					$queryupdate = "UPDATE USERS SET Password = '" .$hashpassword. "' WHERE FirstName = ? AND LastName = ?";
					$stmt2 = $mysqli->prepare( $queryupdate );
					$stmt2->bind_param( "ss", $fname2, $lname2 );
					$fname2 = $firstname;
					$lname2 = $lastname;
					$stmt2->execute();
					$stmt2->close();	
				}
				else{
					$message = "New passwords are not consistent!";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
			else{
				$message = "The old password is incorrect!";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
		$stmt->close();
	}
	
?>
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
		$thisPage = "change_password";
		include 'templateHeader.php';
		include 'connect.php';
	?>
	
	<main>
		<!-- find password form -->
		<h2>Change Password</h2>
		<form class="entry-form" id="change-password" method="post">
			<fieldset class="user-id-form">
				<label for="password"> Old Password
					<input type="password" name="old_password" id="old_password" required="required">
				</label><br>
				
				<label for="password"> New Password
					<input type="password" name="new_password" required="required" id="new_password"
					pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" 
					title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters">
				</label>
				<br>
				
				<label for="retype_password"> Confirm Password
				<input type="password" required="required" Password: name="retype_password" id="retype_password">
				</label>
			</fieldset>
			<fieldset>
				<input type="hidden" name="time" value="<?php echo time();?>">
				<input type="submit" name="submit" id="submit" value="Reset Password">
			</fieldset>
		</form>
	</main>
		
</body>
</html>