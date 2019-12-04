<?php  
	if (session_status() == PHP_SESSION_NONE) {
		    session_start();
	}
	include 'connect.php';
	
	if(array_key_exists('passwordVerified',$_SESSION)){
		if (!isset($_SESSION["passwordVerified"])) {
			header("Location: login.php");
		}
		if((time() - $_SESSION['loggedin_time']) > 20){
			header("Location: login.php");
		}
	}
	else{
		header("Location: login.php");
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
	  $thisPage = "myposts";

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
			header("Location: login.php");
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
					<th>Content</td>
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
	</main>
	
</body>
</html>

<?php 
function getPosts($userID, $Limit = 20, $Offset = 0)
{
	// Connect and query sever
	include 'connect.php';
	$querycheck="SELECT * FROM `posts` WHERE userID = ? ORDER BY TimeCreated DESC LIMIT ?, ?";
	$stmt = $mysqli->prepare( $querycheck );
	$stmt->bind_param( "iii", $uID, $Off, $lim);
	$uID = $userID;
	$Off = $Offset;
	$lim = $Limit;
	$stmt->execute();
	$res = $stmt->get_result();

	// Display Post information
	while ($row = mysqli_fetch_array($res)) {
		echo "<tr>";
		echo "<td><a href=\"mypost.php?postID=".$row["postID"] . "\">" . $row["Title"] . "</a></td>";
		echo "<td>" . $row["Content"] . "</td>";
		echo "<td>" . $row["TimeCreated"] . "</td>";
		echo "</tr>";
	}
}
?>
