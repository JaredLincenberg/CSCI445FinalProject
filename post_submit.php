<?php
	if (session_status() == PHP_SESSION_NONE) {
	session_start();
	}

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

	include 'connect.php';

	/* check connection */
	if ($mysqli->connect_errno) {
	//printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
	}
	
	$title = $_POST['title'];
	$content = $_POST['content'];
	$time_created = $_POST['time'];

	$userid = $_SESSION["userID"];

	//check if repeated post
	$repost = false;
	$querycheck2 = "SELECT * FROM POSTS WHERE TimeCreated= ? ";
	$stmt5 = $mysqli->prepare( $querycheck2 );
	$stmt5->bind_param( "s", $ptime);
	$ptime = $time_created;
	$stmt5->execute();
	$res5 = $stmt5->get_result();
	$row5=mysqli_fetch_array($res5);
	if(!is_null($row5[0])) {
		$repost = true;
	}
	
	//insert new post into db
	if(!$repost){
		$queryinsertc = "INSERT INTO POSTS (userID, Title, Content, TimeCreated) VALUES (?,?,?,?);";
		$stmt2 = $mysqli->prepare( $queryinsertc );
		$stmt2->bind_param( "ssss", $uid, $ptitle, $pcontent, $ptime);
		$uid = $userid;
		$ptitle = $title;
		$pcontent = $content;
		$ptime = $time_created;
		$stmt2->execute();
		$stmt2->close(); 
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
	  $thisPage = "post_submit";
	  include 'header_afterloggedin.php';

	?>
		
	<!-- Body of Web Page -->
	<main>
		
		<?php 
			if ($_SESSION["passwordVerified"]) {
				echo '<h2>Your new post is posted!</h2>';
				echo '<p class="tab" style="color:darkGreen;">Go back to <a style="color:red" href="index.php">Write another post.</a>.</p><br>';
				echo $time_created;
			}			
		?>
		
	</main>
</body>
</html>