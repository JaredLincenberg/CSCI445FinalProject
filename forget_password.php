<?php
	include 'connect.php';
	if (isset($_POST['submit']))  {
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$email=$_POST['email'];
		
		$querycheck="SELECT Password FROM USERS WHERE FirstName=? AND LastName=? AND Email=?";
		$stmt = $mysqli->prepare( $querycheck );
		$stmt->bind_param( "sss", $fname, $lname, $emailsend);
		$fname = $firstname;
		$lname = $lastname;
		$emailsend = $email;
		$stmt->execute();
		$res = $stmt->get_result();
		$row=mysqli_fetch_array($res);

		if(!is_null($row[0])) {
			require 'PHPMailer/PHPMailerAutoload.php';

			$mail = new PHPMailer;
			// $mail->SMTPDebug = 3;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.sendgrid.net';  				// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'apikey';                 // SMTP username
			$mail->Password = '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';                           // SMTP password
			// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom('from@example.com', 'Mailer');
			$mail->addAddress('jaredlincenberg@mymail.mines.edu', 'Joe User');     // Add a recipient
			// $mail->addAddress('ellen@example.com');               // Name is optional
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');

			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}

			// echo var_dump($email);
			// $password = $row[0];
			// $message = "Please use this password to login ";
			// $r = mysqli_fetch_assoc($res);
			// $to = $email;
			// $subject = "Your Recovered Password";
			// $result = mail("jaredlincenberg@gmail.com", "test", "Please use this password to login ");
			// echo var_dump($result);
			// if(){
			// 	$message =  "Your Password has been sent to your email id";
			// }
			// else{
			// 	$message =  "Failed to Recover your password, try again";
			// }
			// echo "<script type='text/javascript'>alert('$message');</script>";
		}
		else{
			$message = "The user name does not exist!";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
		$stmt->close();
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
		$thisPage = "reset_password";
		include 'templateHeader.php';
		include 'connect.php';
	?>
	
	<main>
		<!-- find password form -->
		<h2>Find Password</h2>
		<form class="entry-form" id="log-in" method="post">
			<fieldset class="user-id-form">
				<label for="FirstName"> First Name
					<input type="text" name="firstname" pattern="[A-Za-z ']{1,50}" title="Letters, spaces, and apostrophes only"
				required value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>">
				</label><br>

				<label for="LastName"> Last Name
					<input type="text" name="lastname" pattern="[A-Za-z ']{1,50}" title="Letters, spaces, and apostrophes only" required value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'];?>">
				</label><br>

				<label for="Email"> Email
					<input type="email" name="email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" 
					value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
				</label><br>
				
			</fieldset>
			<fieldset>
				<input type="hidden" name="time" value="<?php echo time();?>">
				<input style="margin-left:40%; width:20%;" type="submit" name="submit" id="submit" value="Reset Password">
				<p>* By clicking the reset password button, a temporary password will be sent to your email.</p>
			</fieldset>
		</form>
	</main>
</body>
</html>