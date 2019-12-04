<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// $firstName = $_POST['firstname'];
// $lastName = $_POST['lastname'];
// $email = $_POST['email'];
// $password = $_POST['password'];	
// echo var_dump($password);
include 'connect.php';

/* check connection */
if ($mysqli->connect_errno) {
    //printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

// //check customer exists
// $querycheck = "SELECT * FROM USERS WHERE firstname= ? AND lastName = ?";
// $stmt = $mysqli->prepare( $querycheck );

// $fname = $firstName;
// $lname = $lastName;
// $email = $email;
// $stmt->bind_param( "ss", $fname, $lname);

// $stmt->execute();



// $res = $stmt->get_result();
// $row=mysqli_fetch_array($res);
// // echo var_dump($row);

// $passwordVerified = password_verify($password,$row["Password"]);

// $stmt->close();

// $_SESSION["passwordVerified"] = $passwordVerified;

// $_SESSION["userID"] = $row["userID"];

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

	  // password_hash($_POST["password"], PASSWORD_BCRYPT, $options );
	?>
		
	<!-- Body of Web Page -->
	<main>
		
		<?php 
			if ($_SESSION["passwordVerified"]) {
				echo '<h2>You have successfully Logged In!</h2>';
				echo '<p class="tab" style="color:darkGreen;">Go back to <a style="color:red" href="index.php">home page</a>.</p><br>';
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