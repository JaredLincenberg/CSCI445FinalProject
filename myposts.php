<?php  
if (session_status() == PHP_SESSION_NONE) {
	    session_start();
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
	  $thisPage = "myposts";
	  include 'templateHeader.php';
	?>

	<?php
		if (isset($_SESSION["passwordVerified"])) {
			// echo var_dump($_SESSION);
			if ($_SESSION["passwordVerified"] == TRUE) {
				echo "Loggedin";
			}
			else{
				echo "Not loggedin";
			}
		}
		else{
			echo "Not set";
		}
	?>
	
</body>
</html>