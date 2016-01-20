<!DOCTYPE html>

<html>
<head>
	<title>Awesome.com</title>
	<script type="text/javascript" src="survey.js"></script>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="survey.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
	    	<div class="navbar-header">
	      		<a class="navbar-brand" href="index.php">Kevin Andres - CS 313</a>
	    	</div>
			<ul class="nav navbar-nav">
	  			<li class="active"><a href="index.php">Home</a></li>
	  			<li><a href="assignments.php">Assignments</a></li>
			</ul>
		</div>
	</nav>
	<div id="container">
		<h1>What brave animal should be the first to visit Mars?</h1>

		<div id="lhs">
		<form method="POST" action="results.php" name="selection">
			<input type="radio" onclick="changePhoto();" class="astrophoto" name="animals" value="dog">Harold the Husky<br><br>
			<input type="radio" onclick="changePhoto();" class="astrophoto" name="animals" value="cat">Purrito the Cat<br><br>
			<input type="radio" onclick="changePhoto();" class="astrophoto" name="animals" value="pig">Patsy the Pig<br><br>
			<input type="radio" onclick="changePhoto();" class="astrophoto" name="animals" value="kangaroo">Kyle the Kangaroo<br><br>
			<input type="radio" onclick="changePhoto();" class="astrophoto" name="animals" value="geico">The Geico Gecko<br><br>
			<input type="radio" onclick="changePhoto();" class="astrophoto" name="animals" value="sloth">Salazar the Sloth<br><br>
			<input type="radio" onclick="changePhoto();" class="astrophoto" name="animals" value="DavidBowie">David Bowie (not an animal, but an <i>excellent</i> choice)<br><br>
			<br>
			<button>Submit</button>
		</form>

		<br>
		</div>
		<div id="rhs">
			<img src="white.jpg" id="astronautphoto">
		</div>
	</div>
</body>
</html>


<?php
	// if (!isset($_COOKIE['count']))
	// {
		?>
<!-- Welcome!  This is the first time you visited this page! :D -->
<?php
		// $cookie = 1;
		// setcookie("count", $cookie);
	// }
	// else
	// {
		// $cookie = ++$_COOKIE['count'];
		// setcookie("count", $cookie);
		?>
<!-- You have this page <?=$_COOKIE['count'] ?> times. -->
<?php
	// }
?>