<?php
	include 'connect.php';
	$postid = $_GET['id'];
	$queryupdate = "DELETE FROM comments WHERE postID=?; DELETE FROM likes WHERE postID=?; DELETE FROM POSTS WHERE postID= ? ;";
	$stmt5 = $mysqli->prepare( $queryupdate );
	$stmt5->bind_param( "iii", $pid, $pid, $pid );
	$pid = $postid;
	$stmt5->execute();
	$stmt5->close();
	header("Location: myposts.php");
?> 