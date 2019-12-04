<?php
	include 'connect.php';
	$postid = $_GET['id'];
	$queryupdate = "DELETE FROM POSTS WHERE postID= ? ;";
	$stmt5 = $mysqli->prepare( $queryupdate );
	$stmt5->bind_param( "i", $pid );
	$pid = $postid;
	$stmt5->execute();
	$stmt5->close();
	header("Location: myposts.php");
?> 