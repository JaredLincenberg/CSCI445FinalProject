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
					<th>User</th>
					<th>Title</th>
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
		 	<p>Loggedin</p>
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
				echo "<td>" . $row2["FirstName"] . " ". $row2["LastName"] . "</td>";
				echo "<td><a href=\"mypost.php?postID=".$row["postID"] . "\">" . $row["Title"] . "</a></td>";
				echo "<td>" . $row["Content"] . "</td>";
				echo "<td>" . $row["TimeCreated"] . "</td>";
				echo "</tr>";
			}
		}
?>

	</main>
	
</body>
</html>