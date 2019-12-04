<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['last_activity'] = time(); 
//session expire in n minutes
$_SESSION['expire_time'] = 5*60; 
if(array_key_exists('passwordVerified',$_SESSION)){
	if (!isset($_SESSION["passwordVerified"])) {
		header("Location: login.php");
	}
}
else{
	header("Location: login.php");
}

include 'connect.php';

/* check connection */
if ($mysqli->connect_errno) {
    //printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
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
	  include 'header_afterloggedin.php';

	?>
		
	<!-- Body of Web Page -->
	<main>
		
		<?php 
			if ($_SESSION["passwordVerified"]) {
				echo '<h2>You have successfully Logged In!</h2>';
				echo '<p class="tab" style="color:darkGreen;">Go back to <a style="color:red" href="index.php">home page</a>.</p><br>';
				echo '<p class="tab" style="color:darkGreen;"><a style="color:red" href="change_password.php">Change Password</a>.</p><br>';
			}
			else{
				echo '<h2>You have an error with your Name or Password</h2>';
				echo '<p class="tab" style="color:darkGreen;">Click here to <a style="color:red" href="login.php">log in</a>.</p>';
				echo '<p class="tab" style="color:darkGreen;">Go back to <a style="color:red" href="index.php">home page</a>.</p><br>';
			}
			
		?>
		
	</main>
</body>
</html>