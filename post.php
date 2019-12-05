<?php  
	if (session_status() == PHP_SESSION_NONE) {
		    session_start();
	}
	include 'connect.php';
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
	  $thisPage = "mypost";

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
					<th>Content</th>
					<th>Time Posted</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					getPost($_GET["postID"]);
				?>
				</tbody>
			</table>
			
			<table>
				<thead>
				<tr>
					<th>From</th>
					<th>Comment</th>
					<th>Time Posted</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					getPostCommentsAndLikes($_GET["postID"]);
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
	</main>
	
</body>
</html>

<?php 
function getPostCommentsAndLikes($postID,$Limit = 20,$Offset = 0 )
{
	// Connect and query sever
	include 'connect.php';

	// Get Comments
	$querycheck="SELECT comments.* FROM `comments`, `posts` WHERE comments.postID = ? AND posts.postID = ? LIMIT ?, ?";
	$stmt = $mysqli->prepare( $querycheck );
	$stmt->bind_param( "iiii", $pID, $pID, $Off, $lim);
	$pID = $postID;
	$Off = $Offset;
	$lim = $Limit;
	$stmt->execute();
	$res = $stmt->get_result();

	// Get number of Likes
	$querycheck="SELECT COUNT(*) FROM `likes` WHERE postID = ? ";
	$stmt = $mysqli->prepare( $querycheck );
	$stmt->bind_param( "i", $pID);
	$pID = $postID;
	$stmt->execute();
	$res2 = $stmt->get_result();

	// Display Post information

	while ($row = mysqli_fetch_array($res)) {
		// echo var_dump($row);
		echo "<tr>";
		echo "<td>" . $row["userID"] . "</td>";
		echo "<td>" . $row["Content"] . "</td>";
		echo "<td>" . $row["TimeCreated"] . "</td>";
		echo "</tr>";
	}
	// echo var_dump(mysqli_fetch_array($res2));
}

function getPost($postID, $Limit = 20, $Offset = 0)
{
	// Connect and query sever
	include 'connect.php';
	$querycheck="SELECT * FROM `posts` WHERE postID = ? ORDER BY TimeCreated DESC LIMIT ?, ?";
	$stmt = $mysqli->prepare( $querycheck );
	$stmt->bind_param( "iii", $pID, $Off, $lim);
	$pID = $postID;
	$Off = $Offset;
	$lim = $Limit;
	$stmt->execute();
	$res = $stmt->get_result();

	// Display Post information
	while ($row = mysqli_fetch_array($res)) {
		echo "<tr>";
		echo "<td>" . $row["Title"] . "</td>";
		echo "<td>" . $row["Content"] . "</td>";
		echo "<td>" . $row["TimeCreated"] . "</td>";
		if($row['userID'] == $_SESSION['userID']){
			echo '<td><input type="button" name="edit" value="edit"></td>';
		}
		echo "</tr>";
	}

}

?>
