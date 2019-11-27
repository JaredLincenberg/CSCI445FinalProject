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
	<!-- Body of Web Page -->
	<main>
		<!-- Log In Form -->
		<form class="entry-form" id="log-in" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
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

				<label for="password"> Password
					<input type="password" name="password" required="required">
				</label>

			</fieldset>
			<fieldset>
				<input type="submit" name="Log_In" value="Log In">
				<input type="submit" name="Forgot_Password" value="Forgot Password">
			</fieldset>
		</form>
	</main>

	
</body>
</html>