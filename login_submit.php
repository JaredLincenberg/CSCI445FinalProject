<?php
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$email = $_POST['email'];
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

//check customer exists
$querycheck = "SELECT * FROM USERS WHERE firstname= ? AND lastName = ? ";
$stmt = $mysqli->prepare( $querycheck );
$stmt->bind_param( "ss", $fname, $lname );
$fname = $firstName;
$lname = $lastName;
$stmt->execute();
$res = $stmt->get_result();
$row=mysqli_fetch_array($res);
if(is_null($row[0])) {
	$dup = false;
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
	  include 'header_afterloggedin.php';
	  // password_hash($_POST["password"], PASSWORD_BCRYPT, $options );
	?>
		
	<!-- Body of Web Page -->
	<main>
		<h2>You have successfully logged in!</h2>
	</main>
</body>
</html>