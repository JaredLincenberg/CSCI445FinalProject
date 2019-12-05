<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include 'connect.php';
	
	$postid = $_GET['pid'];
	$userid = $_GET['uid'];
	
	if (isset($_POST['submit']))  {
		$comment = $_POST['comment'];
		$time_created=$_POST['time'];

		$repost = false;
		$querycheck2 = "SELECT * FROM comments WHERE TimeCreated= ? ";
		$stmt5 = $mysqli->prepare( $querycheck2 );
		$stmt5->bind_param( "s", $ctime);
		$ctime = $time_created;
		$stmt5->execute();
		$res5 = $stmt5->get_result();
		$row5=mysqli_fetch_array($res5);
		if(!is_null($row5[0])) {
			$repost = true;
		}

	//add customer
	if(!$repost){
		$queryinsertc = "INSERT INTO comments (userid, postid, content, timecreated) VALUES (?,?,?,?);";
		$stmt2 = $mysqli->prepare( $queryinsertc );
		$stmt2->bind_param( "ssss", $uid, $pid, $ccontent, $ctime);
		$uid = $userid;
		$pid = $postid;
		$ccontent = $comment;
		$pctime = $time_created;
		$stmt2->execute();
		$stmt2->close();
		$message = "Your comment is posted!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Location: allposts.php");
	}
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
	  $thisPage = "comment";
	  include 'header_afterloggedin.php';
	?>
		
	<!-- Body of Web Page -->
	<main>
		<h2>Post A Comment</h2>
		<form class="entry-form" id="write-comment" method="post">
			<fieldset class="user-id-form">
			<label for="content" >Comment</label>
			<textarea name="comment" style="width:80%;margin-left:10%;" name="content" rows="10" cols="30" id="content"
			title="Letters, spaces, and punctuation only."><?php if(isset($_POST['comment'])) echo $_POST['comment'];?></textarea>
			<br>
			</fieldset>
			<fieldset>
				<?php date_default_timezone_set("America/Denver");?>
				<input type="hidden" name="time" value="<?php date_default_timezone_set("America/Denver"); echo date('Y-m-d h:i:s');?>">
				<input class="button" type="reset" name="reset" id="reset" value="Reset"> 
				<input type="submit" name="submit" value="Post It" id="submit">
			</fieldset>
		</form><br><br>
	</main>
</body>
</html>