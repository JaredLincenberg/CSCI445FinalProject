<?php  
	if (session_status() == PHP_SESSION_NONE) {
		    session_start();
	}
	include 'connect.php';
	
	if(array_key_exists('passwordVerified',$_SESSION)){
		if (!isset($_SESSION["passwordVerified"])) {
			header("Location: login.php");
		}
		if(time() - $_SESSION['last_activity'] > $_SESSION['expire_time']){
			session_destroy();
			$message = "Your session has expired!";
			echo "<script type='text/javascript'>alert('$message');</script>";
			header("Location: login.php");
		}
	}
	else{
		header("Location: login.php");
	}
	$_SESSION['last_activity'] = time();
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
			 <h2> Something New? --- Write A Post</h2>
			 <form class="entry-form" id="write-post"  action="post_submit.php" method="post">
				<fieldset class="user-id-form">
				<label for="title"> Title
					<input type="text" name="title" title="Letters, spaces only." id="title"
				required value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>">
				</label><br>

				<label for="content" >Content
				<textarea style="width:80%;margin-left:10%;" name="content" rows="10" cols="30" 
				title="Letters, spaces, and punctuation only." id="content"><?php if(isset($_POST['content'])) echo $_POST['content'];?></textarea>
				</label><br>
				</fieldset>
				<fieldset>
					<?php date_default_timezone_set("America/Denver");?>
					<input type="hidden" name="time" value="<?php date_default_timezone_set("America/Denver"); echo date('Y-m-d h:i:s');?>">
					<input class="button" type="reset" name="reset" id="reset" value="Reset"> 
					<input type="submit" name="submit" value="Post It" id="submit">
				</fieldset>
			</form><br><br>
			<?php echo '<p class="tab" style="color:darkGreen;"><a href="change_password.php">Change Password</a>.</p><br>';?>
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