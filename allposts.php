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
		echo "<script>alert('$message');</script>";
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<?php 
	  $path = "";
	  $thisPage = "allposts";

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
	<?php if (isset($_SESSION["passwordVerified"])): ?>
		<?php if ($_SESSION["passwordVerified"] == TRUE): ?>
			<!-- User is successfully Logged In -->
			<table>
				<thead>
				<tr>
					<th>Title</th>
					<th>User</th>
					<th>Content</th>
					<th>Time Posted</th>
					<!-- <th>Likes</th> -->
				</tr>
				</thead>
				<tbody>
				<?php 
					getPosts($_SESSION["userID"]);
				?>
				</tbody>
			</table>

		<?php else: ?>
			<!-- User has failed to Logged In successfully -->
			<p>Please Log in.</p>
		<?php endif ?>
	<?php else: ?>
		<!-- User has not tried to Log In -->
		<p>Please Log in.</p>
	<?php endif ?>
	
	
	<?php 
		function getPosts($userID, $Limit = 20, $Offset = 0)
		{
			// Connect and query sever
			include 'connect.php';
			$querycheck="SELECT * FROM `posts` ORDER BY TimeCreated DESC LIMIT ?, ?";
			$stmt = $mysqli->prepare( $querycheck );
			$stmt->bind_param( "ii", $Off, $lim);
			$Off = $Offset;
			$lim = $Limit;
			$stmt->execute();
			$res = $stmt->get_result();

			// Display Post information
			//TODO: ADD USERS' NAME
			while ($row = mysqli_fetch_array($res)) {
				$userid = $row["userID"];
				$querycheck2="SELECT FirstName, LastName FROM USERS WHERE userID = ?";
				$stmt2 = $mysqli->prepare( $querycheck2 );
				$stmt2->bind_param( "s", $uid);
				$uid = $userid;
				$stmt2->execute();
				$res2 = $stmt2->get_result();
				$row2 = mysqli_fetch_array($res2);
				echo "<tr>";
				echo "<td><a href=\"post.php?postID=".$row["postID"] . "\">" . $row["Title"] . "</a></td>";
				echo "<td>" . $row2["FirstName"] . " ". $row2["LastName"] . "</td>";
				echo "<td>" . $row["Content"] . "</td>";
				echo "<td>" . $row["TimeCreated"] . "</td>";
				echo '<td><a href=\'comment.php?pid='.$row['postID'].'&uid='.$userid.'\' class="comment" id="' . $row['postID'] . '">Comment</a></td>';
				echo '<td><a href=\'like.php?pid='.$row['postID'].'&uid='.$userid.'\' class="like" id="' . $row['postID'] . '">Like</a></td>';
				echo "</tr>";
				
			}

			$stmt = $mysqli->prepare("SELECT postID FROM `likes` WHERE userID=". $_SESSION['userID']);
			$stmt->execute();
			$result = $stmt->get_result();
			while($row = mysqli_fetch_array($result)){
				
				echo "<script>";
					echo "var id = " . $row['postID'] . ";";
					echo 'var pound = "#";';
					echo "$(pound.concat(toString(id))).text(\"Unlike\");";
				echo "</script>";
				
			}
		}
	?>

	</main>
	
</body>
</html>