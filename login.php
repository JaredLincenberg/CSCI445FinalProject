<?php
	include 'connect.php';
	$exist = "false";
	if(isset($_POST['Log_In'])) {
		$exist = "true";
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$password=$_POST['password'];
		
		$querycheck="SELECT * FROM USERS WHERE FirstName=? AND LastName=? AND Password=?";
		$stmt = $mysqli->prepare( $querycheck );
		$stmt->bind_param( "sss", $fname, $lname, $pword );
		$fname = $firstname;
		$lname = $lastname;
		$pword = $password;
		$stmt->execute();
		$res = $stmt->get_result();
		$row=mysqli_fetch_array($res);
		if(!is_null($row[0])) {
			$exist = "true";
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
		session_start();
		$path = "";
		$thisPage = "login";
		include 'templateHeader.php';

	?>
	


  	<!-- Test Account
  		J
  		L
  		j@l.com
  		qwerty123Q -->
	<!-- Body of Web Page -->
	<main>
		<!-- Log In Form -->
		<form class="entry-form" id="log-in" action="login_submit.php" method="post">
			<fieldset class="user-id-form">
				<label for="FirstName"> First Name
					<input type="text" name="firstname" pattern="[A-Za-z ']{1,50}" title="Letters, spaces, and apostrophes only"
				required value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>">
				</label>

				<label for="LastName"> Last Name
					<input type="text" name="lastname" pattern="[A-Za-z ']{1,50}" title="Letters, spaces, and apostrophes only" required value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'];?>">
				</label>

				<label for="Email"> Email
					<input type="email" name="email" id="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" 
					value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
				</label>

				<label for="password"> Password
					<input type="password" name="password" required="required">
				</label>

				
			</fieldset>
			<fieldset>
				<input type="hidden" name="time" value="<?php echo time();?>">
				<input type="submit" name="Log_In" value="Log In" id="Log_In" onclick="return checkform()">
				<span> <a href="forget_password.php">Forgot password?</a></span>
			</fieldset>
		</form>

	</main>
	
<script>
function checkform() {
	var exist = <?php echo $exist; ?>;
	if(exist){
		return true;
	}
	else{
		alert("The user name and password doesn't match!");
		return false;
	}
}
</script>	
</body>
</html>