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
		session_start();
		$path = "";
		$thisPage = "login";
		include 'templateHeader.php';

		include 'dbConnect.php';
	?>
	
  	<!-- Test Account
  		J
  		L
  		j@l.com
  		qwerty123Q -->
	<!-- Body of Web Page -->
	<main>
		<!-- Log In Form -->
		<form class="entry-form" id="log-in" action="login_submit.php" method="post">
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

				<label for="password"> Password
					<input type="password" name="password" required="required">
				</label>

				
			</fieldset>
			<fieldset>
				<input type="hidden" name="time" value="<?php echo time();?>">
				<input type="submit" name="Log_In" value="Log In">
				<input type="submit" name="Forgot_Password" value="Forgot Password">
			</fieldset>
		</form>
	</main>

	
</body>
</html>