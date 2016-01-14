<!DOCTYPE html>

<html>
<head>
	<title>Awesome.com</title>
</head>
<body>
	<h1>What brave animal should be the first to visit Mars?</h1>
	<form>
		<input type="radio" class="astrophoto" name="animal" value="dog">Harold the Husky<br>
		<input type="radio" class="astrophoto" name="animal" value="cat">Purrito the Cat<br>
		<input type="radio" class="astrophoto" name="animal" value="pig">Patsy the Pig<br>
		<input type="radio" class="astrophoto" name="animal" value="kangaroo">Kyle the Kangaroo<br>
		<input type="radio" class="astrophoto" name="animal" value="geico">The Geico Gecko<br>
		<input type="radio" class="astrophoto" name="animal" value="sloth">Salazar the Sloth<br>
		<input type="radio" class="astrophoto" name="animal" value="DavidBowie">David Bowie (not an animal, but an <i>excellent</i> choice)<br>

	</form>


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