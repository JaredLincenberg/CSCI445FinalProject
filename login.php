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

		include 'dbConnect.php';
	?>
	
	
	<?php 
		function test_names($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data; 
		}
	?>

	<?php
    
    // echo(var_dump($_SESSION["conn"]));

	$FirstName_err = $LastName_err = $Email_err = $password_err = "";
	$FirstName = $LastName = $Email = $password = "";

	$isValid = FALSE;
	$hasError = FALSE;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		echo var_dump($_POST);
		if (empty($_POST["FirstName"])) {
			$FirstName_err = "Must enter a First Name";
			$hasError = TRUE;
			// echo $FirstName_err;
		}
		else {
			$FirstName = test_names($_POST["FirstName"]);
			if (preg_match("/^[a-zA-Z ]*$/",$FirstName)) {
				$_SESSION["FirstName"] = $FirstName;
			}
			else{
				$FirstName_err = "First Name must only have characters, and spaces";
				$hasError = TRUE;
				// echo $FirstName_err;
			}
		}


		if (empty($_POST["LastName"])) {
			$LastName_err = "Must enter a Last Name";
			$hasError = TRUE;
			// echo $Email_err;
		}
		else {
			$LastName = test_names($_POST["FirstName"]);
			if (preg_match("/^[a-zA-Z ]*$/",$LastName)) {
				$_SESSION["FirstName"] = $LastName;
			}
			else{
				$LastName_err = "LastName Name must only have characters, and spaces";
				$hasError = TRUE;
				// echo $FirstName_err;
			}
		}

		if (empty($_POST["Email"])) {
			$Email_err = "Must enter an Email";
		}
		else {
			$Email = $_POST["Email"];
			if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION["Email"] = $Email;
			}
			else{
				$Email_err = "Invaild Email";
				$hasError = TRUE;
			}
		}

		if (empty($_POST["password"])) {
			$password_err = "Must enter your password";
			$hasError = TRUE;
		}
		else {
			if (!$hasError) {
				// $isValidUser;
				// $id;
				// $pHash;
				// $isValidUser = $conn->prepare("SELECT userID FROM users WHERE FirstName = ? AND LastName = ?;");
				
				// $isValidUser->bind_param("ss", $FirstName, $LastName);
				// $isValidUser->execute();
				// echo "isValidUser <br>";
				// echo var_dump($isValidUser);

				// $isValidUser->bind_result($id);
				// $isValidUser->fetch();	
				// // $userPasswordHash = $isValidUser->get_result();
				// echo "pHash ";
				// echo var_dump($id);
				// echo var_dump( $pHash);
				// echo var_dump( $userPasswordHash->fetch_assoc());
				// $options = [
				//     'cost' => 12,
				// ];
				// $password = password_verify($_POST["password"],$hashed_password)
				 
				// echo $password;
			}
			
		}
        // echo $hasError;
        
		if (empty($_POST["time"])) {
			$hasError = TRUE;
		}
		else {
			$time = $_POST["time"];
			$_SESSION["time"] = $time;
		}
        

      }
      
      if(array_key_exists('reset',$_POST)){ 
        $FirstName_err = $LastName_err = $Email_err = $password_err = "";
        $FirstName = $LastName = $Email = "";

        session_unset();
      }

      //echo $_POST["time"];
      // echo $hasError;
      if (!$hasError && $isValid) {

        echo "string";
        $_SESSION["time"] = $_POST["time"];
        $conn->close();
        header("Location:index.php");
        die();
      }
      //echo var_dump(empty($hasError)) . var_dump($hasError) . "Hello";
      
  	?> 
	<!-- Body of Web Page -->
	<main>
		<!-- Log In Form -->
		<form class="entry-form" id="log-in" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<fieldset class="user-id-form">
				<label for="FirstName"> First Name
					<input type="text" name="FirstName" required="required">
				</label>

				<label for="LastName"> Last Name
					<input type="text" name="LastName" required="required">
				</label>

				<label for="Email"> Email
					<input type="text" name="Email" required="required">
				</label>

				<label for="password"> Password
					<input type="password" name="password" required="required">
				</label>

				
			</fieldset>
			<fieldset>
				<input type="hidden" name="time" value="<?php echo time();?>">
				<input type="submit" name="Log_In" value="Log In">
				<input type="submit" name="Forgot_Password" value="Forgot Password">
			</fieldset>
		</form>
	</main>

	
</body>
</html>