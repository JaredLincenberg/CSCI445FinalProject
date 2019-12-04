<?php  
	if (session_status() == PHP_SESSION_NONE) {
		    session_start();
	}
	include 'connect.php';
	
	if(array_key_exists('passwordVerified',$_SESSION)){
		if (!isset($_SESSION["passwordVerified"])) {
			header("Location: login.php");
		}
		if((time() - $_SESSION['loggedin_time']) > 200){
			$message = "Your session has expired!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			header("Location: login.php");
		}
	}
	else{
		header("Location: login.php");
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
		$thisPage = "home";

		if (isset($_SESSION["passwordVerified"])) {
			// echo var_dump($_SESSION);
			if ($_SESSION["passwordVerified"] == TRUE) {
				include 'header_afterloggedin.php';
			}
			else{
				include 'templateHeader.php';
			}
		}
		else{
			include 'templateHeader.php';
		}
	  
	?>
	<main>
	<!-- https://stackoverflow.com/questions/722379/can-html-be-embedded-inside-php-if-statement -->
	<?php if (isset($_SESSION["passwordVerified"])): ?>
		<?php if ($_SESSION["passwordVerified"] == TRUE): ?>
			<!-- User is successfully Logged In -->
		 	<p>Loggedin</p>
		<?php else: ?>
			<!-- User has failed to Logged In successfully -->
			<p>Please Log in.</p>
		<?php endif ?>
	<?php else: ?>
		<!-- User has not tried to Log In -->
		<p>Please Log in.</p>
	<?php endif ?>
	</main>
</body>
</html>