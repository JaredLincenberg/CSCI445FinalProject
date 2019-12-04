
<?php 
	session_start();
	
	session_destroy();
	if(isset($_SESSION)){
		// echo var_dump($_SESSION);
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
	  // password_hash($_POST["password"], PASSWORD_BCRYPT, $options );
	?>
		
	<!-- Body of Web Page -->
	<main>
		<h2>You have successfully Logged Out!</h2>
		<p class="tab" style="color:darkGreen;">Click here to <a style="color:red" href="login.php">log in</a>.</p>
		<p class="tab" style="color:darkGreen;">Go back to <a style="color:red" href="index.php">home page</a>.</p><br>
	</main>
</body>
</html>