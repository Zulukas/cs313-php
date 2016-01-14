<!DOCTYPE html>
<html lang="en">
<head>
  <title>Kevin Andres - CS 313</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
  
<div class="container">
	<h3>CS 313 Assignments</h3>

	<hr class="featurette-divider">

    <div class="row featurette">
    	<ul>
    		<li id="r1"><a href="#">Survey<a></li>
    		<script type="text/javascript">
    		var r1=document.getElementById("r1");
    		var myRainbowSpan = new RainbowSpan(r1, 0, 360, 255, 50, 18);
    		myRainbowSpan.timer = window.setInterval("myRainbowSpan.moveRainbow()", myRainbowSpan.speed);
    		</script>
    	</ul>
    </div>
</div>

</body>
</html>