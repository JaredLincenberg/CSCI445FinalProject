<?php
	include 'connect.php';
	//TODO: handle case if user direct to this page without sign up.
	
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$email = $_POST['email'];
	$message = "You have successfully signed up!";
	$options = [
		'cost' => 12,
	];
	$password = password_hash($_POST["password"], PASSWORD_BCRYPT, $options );	

	include 'connect.php';

	/* check connection */
	if ($mysqli->connect_errno) {
		//printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	$dup = true;
	//check customer exists
	$querycheck = "SELECT * FROM USERS WHERE firstname= ? AND lastName = ? OR email = ?";
	$stmt = $mysqli->prepare( $querycheck );
	$stmt->bind_param( "sss", $fname, $lname, $emai );
	$fname = $firstName;
	$lname = $lastName;
	$emai = $email;
	$stmt->execute();
	$res = $stmt->get_result();
	$row=mysqli_fetch_array($res);
	if(is_null($row[0])) {
		$dup = false;
	}
	else{
		$message = "You have registered before.";
	}
	$stmt->close();

	//add customer
	if(!$dup){
		$queryinsertc = "INSERT INTO USERS (firstname, lastname, email, password) VALUES (?,?,?,?);";
		$stmt2 = $mysqli->prepare( $queryinsertc );
		$stmt2->bind_param( "ssss", $fname, $lname, $cemail, $pword);
		$fname = $firstName;
		$lname = $lastName;
		$cemail = $email;
		$pword = $password;
		$stmt2->execute();
		$stmt2->close();  
	}

	/* close connection */
	$mysqli->close();
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
	  $thisPage = "signup";
	  include 'templateheader.php';
	  // password_hash($_POST["password"], PASSWORD_BCRYPT, $options );
	?>
		
	<!-- Body of Web Page -->
	<main>
		<h2><?php echo $message;?></h2>
		<p class="tab" style="color:darkGreen;">Click here to <a style="color:red" href="login.php">log in</a>.</p>
		<p class="tab" style="color:darkGreen;">Go back to <a style="color:red" href="index.php">home page</a>.</p><br>
	</main>
</body>
</html>