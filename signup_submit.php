<?php
	include 'connect.php';
	//TODO: handle case if user direct to this page without sign up.
	if (!isset($_POST['firstname']))  {
		header("Location: login.php");
	}
	echo var_dump($_POST);
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$email = $_POST['email'];
	$message = "Please Check Your Email to verify your account.";
	$options = [
		'cost' => 12,
	];
	$password = password_hash($_POST["password"], PASSWORD_BCRYPT, $options );	


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

		require 'PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;
		// $mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail->SMTPDebug = 0;
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.mines.edu';  				// Specify main and backup SMTP servers
		// $mail->SMTPAuth = true;                               // Enable SMTP authentication
		// $mail->Username = 'apikey';                 // SMTP username
		// $mail->Password = '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'; // SMTP password
		// $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 25;                                    // TCP port to connect to

		$mail->setFrom('VerifyAccount@mines.edu', 'Verify Account');


		$mail->addAddress($email, $firstName . ' ' . $lastName);     // Add a recipient
		// $mail->addAddress('ellen@example.com');               // Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		$e = explode('/',$_SERVER['REQUEST_URI']);
		$c = "";
		foreach ($e as $key => $value) {
			if (end($e)!=$value) {
				$c .=  $value . "/" ;
			}
			
		}
		echo var_dump ($c);

		$mail->Subject = 'Verify Account';
		$mail->Body    = 'Please verify your account by logging into this web page: <br>' . '<a href="' . $_SERVER['HTTP_HOST'] . $c . 'verify.php?email='. $email .'">link</a>';

		$mail->AltBody = 'Please verify your account by logging into this web page' . $_SERVER['HTTP_HOST'] . $c . 'verify.php?email='. $email;

		// echo var_dump('Please verify your account by logging into this web page: ' . '<a href=' . $_SERVER[HTTP_HOST] . $c . "verify.php?email=". $email ."\">link</a>");
		// echo var_dump($_SERVER['REQUEST_URI']);
		
		// echo var_dump($e);

		
		
		// echo var_dump($c);
		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}

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