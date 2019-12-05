<?php
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	include 'connect.php';
	if (isset($_POST['submit']))  {
		$email = $_POST['email'];
		$password=$_POST['password'];
		
		$querycheck="SELECT password, userID, FirstName, LastName, Verified FROM USERS WHERE Email=?";

		$stmt = $mysqli->prepare( $querycheck );
		$stmt->bind_param( "s", $emai);
		$emai = $email;
		$stmt->execute();
		$res = $stmt->get_result();
		$row=mysqli_fetch_array($res);
		if(!is_null($row[0]) && $row["Verified"]) {
			$hash = $row[0];
			$valid = password_verify ( $password, $hash );
			if($valid){
				$_SESSION["userfname"] = $row[2];
				$_SESSION["userlname"] = $row[3];
				$_SESSION["useremail"] = $email;
				$_SESSION["userID"] = $row[1];
				$_SESSION["passwordVerified"] = $valid;
				header("Location: login_submit.php");
			}
			else{
				$message = "The password is incorrect!";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
		elseif (isset($row["Verified"]) && !$row["Verified"]) {
			$valid = false;
			$message = "Please find the verification email and verify the account.";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		else{
			$valid = false;
			$message = "The user does not exist!";
			echo "<script type='text/javascript'>alert('$message');</script>";
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
		$thisPage = "login";
		include 'templateHeader.php';

	?>
	
  	<!-- Test Account
  		J
  		L
  		j@l.com
  		qwerty123Q -->
	<!-- Body of Web Page -->
	<main>
		<!-- Log In Form -->
		<h2>Log in</h2>
		<form class="entry-form" id="log-in"  method="post">
			<fieldset class="user-id-form">
				<label for="Email"> Email
					<input type="email" name="email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" 
					value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
				</label><br>

				<label for="password"> Password
					<input type="password" name="password" required="required">
				</label><br>

				
			</fieldset>
			<fieldset>
				<input type="hidden" name="time" value="<?php echo time();?>">
				<input type="submit" name="submit" value="Log In" id="submit">
				<span sytle="float:right;"> <a href="forget_password.php">Forgot password?</a></span>
			</fieldset>
		</form>

	</main>
		
</body>
</html>