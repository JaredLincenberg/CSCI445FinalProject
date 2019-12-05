<?php
	include 'connect.php';
	$postid = $_GET['id'];
	echo $postid;
	$queryupdate = "DELETE FROM comments WHERE postID=?;";
	$stmt5 = $mysqli->prepare( $queryupdate );
	$stmt5->bind_param( "i", $pid );
	$pid = $postid;
	$stmt5->execute();
	$stmt5->close();
	
	$queryupdate = "DELETE FROM likes WHERE postID=?; ";
	$stmt5 = $mysqli->prepare( $queryupdate );
	$stmt5->bind_param( "i", $pid );
	$pid = $postid;
	$stmt5->execute();
	$stmt5->close();
	
	$queryupdate = "DELETE FROM POSTS WHERE postID= ? ;";
	$stmt5 = $mysqli->prepare( $queryupdate );
	$stmt5->bind_param( "i", $pid);
	$pid = $postid;
	$stmt5->execute();
	$stmt5->close();
	header("Location: myposts.php");
?> 