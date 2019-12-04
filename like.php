<?php
	include 'connect.php';
	$postid = $_GET['pid'];
	$userid = $_GET['uid'];
	$queryupdate = "INSERT INTO LIKES (userID, postID, TimeCreated ) VALUES (?,?,CURRENT_TIMESTAMP);";
	$stmt5 = $mysqli->prepare( $queryupdate );
	$stmt5->bind_param( "ii", $pid, $uid );
	$pid = $postid;
	$uid = $userid;
	$stmt5->execute();
	$stmt5->close();
	header("Location: allposts.php");
?> 