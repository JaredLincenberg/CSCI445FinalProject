<?php
	include 'connect.php';
	$postid = $_GET['pid'];
	$userid = $_GET['uid'];

	$query = "SELECT 1 FROM likes WHERE postID = ? AND userID = ?;";
	$stmt5 = $mysqli->prepare( $query );
	$stmt5->bind_param( "ii", $pid, $uid );
	$stmt5->execute();
	$result = $stmt5->get_result();
	$row = mysqli_fetch_array($result);
	if($row[0] == 0){
		$queryupdate = "INSERT INTO LIKES (userID, postID, TimeCreated ) VALUES (?,?,CURRENT_TIMESTAMP);";
		$stmt5 = $mysqli->prepare( $queryupdate );
		$stmt5->bind_param( "ii", $pid, $uid );
		$pid = $postid;
		$uid = $userid;
		$stmt5->execute();
		$stmt5->close();
	} else {
		$query= "DELETE FROM likes WHERE postID = ? AND userID = ?";
		$stmt5 = $mysqli->prepare( $query );
		$stmt5->bind_param( "ii", $pid, $uid );
		$stmt5->execute();
	}
	$stmt5->close();
	header("Location: allposts.php");
?> 