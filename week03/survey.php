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
	      		<a class="navbar-brand">Tastiest Burrito Toppings & Fillins'</a>
	    	</div>
			<ul class="nav navbar-nav">
	  			<li class="active"><a href="results.php">Results</a></li>
			</ul>
		</div>
	</nav>
	<div id="container">
		<form action="results.php" method="POST">
			<div id="lhs">
				<h2>Favorite Meat</h2>
				<hr>

				<input type="radio" name="meat" value="Carne Asada"> Carne Asada<br>
				<input type="radio" name="meat" value="Chicken"> Chicken<br>
				<input type="radio" name="meat" value="Carnitas"> Carnitas<br>
				<input type="radio" name="meat" value="Ground Beef"> Ground Beef<br>
				<input type="radio" name="meat" value="Sweet Pork Barbacoa"> Barbacoa<br>
				<input type="radio" name="meat" value="Fish"> Fish<br>
				<input type="radio" name="meat" value="Vegetarian"> I hate meat (and America)<br>
				<br>

				<h2>Favorite Kind of Rice</h2>
				<hr>

				<input type="radio" name="rice" value="Spanish Rice"> Spanish Rice<br>
				<input type="radio" name="rice" value="Cilantro Rice"> Cilantro Rice<br>
				<input type="radio" name="rice" value="White Rice"> Plain Ole' White Rice<br>
				<input type="radio" name="rice" value="Brown Rice"> Brown Rice<br>
				<input type="radio" name="rice" value="None"> No Rice<br>
				<br>

				<h2>Favorite Kind of Beans</h2>
				<hr>

				<input type="radio" name="beans" value="Refried Beans"> Refried Beans<br>
				<input type="radio" name="beans" value="Black Beans"> Black Beans<br>
				<input type="radio" name="beans" value="Pinto Beans"> Pinto Beans<br>
				<input type="radio" name="beans" value="No Beans"> I prefer no air to escape my derrière<br>
				<br>

				<h2>Favorite Fillin' Medium </h2>
				<hr>

				<input type="radio" name="medium" value="Thick Tortilla"> Thick Flour Tortilla<br>
				<input type="radio" name="medium" value="Thin Tortilla"> Thin Flour Tortilla<br>
				<input type="radio" name="medium" value="Salad"> Burrito Salad Bowl<br>
				<br>

				<h2>Tomato-ey Stuff</h2>
				<hr>

				<input type="radio" name="tomato_stuff" value="Plain"> Plain old chopped up tomatoes<br>
				<input type="radio" name="tomato_stuff" value="Pico de Gallo"> Pico de Gallo<br>
				<input type="radio" name="tomato_stuff" value="Salsa"> Salsa-tized!<br>
				<input type="radio" name="tomato_stuff" value="None"> No tomatoes!<br>
				<br>
				
				<h2>Extra Fixin's</h2>
				<hr>

				<input type="checkbox" name="fixings[]" value="Lettuce"> Lettuce<br>
				<input type="checkbox" name="fixings[]" value="Sour Cream"> Sour Cream<br>
				<input type="checkbox" name="fixings[]" value="Guacamole"> Guacamole<br>
				<input type="checkbox" name="fixings[]" value="Cilantro"> Cilantro<br>
				<input type="checkbox" name="fixings[]" value="Lime"> Lime<br>
				<input type="checkbox" name="fixings[]" value="Jalapenos"> Jalepenos<br>
				<input type="checkbox" name="fixings[]" value="Onions"> Onions<br>
				<br>

				<button>Submit</button>
				<br>
				<br>
				<br>
			</div>
		</form>
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