
<!--log in bar-->
<div id="top-nav" style="background-color:lightBlue">
	
	<form id="searchform" method="GET">
		<label for="search" style="color:black">Search</label>
		<input id="search" name="search" type="text" value="" maxlength="150">
		<input type="submit" id="search-button" value="Search">
	</form>

	<ul id="left-ul" style="list-style-type:none">
		<span style="color:blue">user name place holder</span>
		<li class="left-ul-li">
			<a id="logout" href="logout_submit.php">Log out</a>		
		</li>
	</ul>
</div>

<!--navagation bar-->
<div class="navigation-div">
<header>
	<br><h1 style="color:lightBlue;">MINER -- THE BEST ONLINE VIRTUAL “CORKBOARDS”</h1>
	</header>

	<nav class="navagation-bar">
	    <?php 
		  $homepath = $path."index.php";
		  $mypostpath = $path."myposts.php";
		  $allpostpath = $path."allposts.php";
	    ?>
		<a class="home" 
		<?php if ($thisPage=="home") echo "style=\"background-color: darkBlue;color: white;\""; ?>
		href="<?php echo $homepath; ?>">Home</a>
		<a class="myposts" 
		<?php if ($thisPage=="myposts") echo "style=\"background-color: darkBlue;color: white;\""; ?>
		href="<?php echo $mypostpath; ?>">My Posts</a>
		<a class="allposts" 
		<?php if ($thisPage=="allposts") echo "style=\"background-color: darkBlue;color: white;\""; ?>
		href="<?php echo $allpostpath; ?>">All Posts</a>
	</nav>
</div>