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
	?>
	<!-- Body of Web Page -->
	<main>
		<!-- Sign Up Form -->
		<form class="entry-form" id="sign-up" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<!-- Get information about User -->
			<fieldset class="user-id-form">

				<label for="FirstName"> First Name
					<input type="text" name="FirstName" required="required">
				</label>

				<label for="LastName"> Last Name
					<input type="text" name="LastName" required="required">
				</label>

				<label for="Email"> Email
					<input type="text" name="Email" required="required">
				</label>

				<label for="confirm_Email"> Confirm Email
					<input type="text" name="confirm_Email" required="required">
				</label>

				<label for="password"> Password
					<input type="password" name="password" required="required">
				</label>

				<label for="retype_password"> Retype Password
					<input type="password" name="retype_password" required="required">
				</label>

			</fieldset>
			<fieldset>

				<input type="submit" name="Sign_up" value="Sign Up">

			</fieldset>
		</form>
	</main>

	
</body>
</html>