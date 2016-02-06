<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$startdate = $_POST["startdate"];
$enddate   = $_POST["enddate"];

$user     = $_SESSION['user'];
$orgName = "NOT FOUND";
$is_admin = 0;

$SQLuser = 'php';
$SQLpassword = 'foo';
$server = 'localhost';

try //All SQL related stuff goes in this try loop.
{
	$db = new PDO("mysql:host=localhost;dbname=php_project", $SQLuser, $SQLpassword);

	$userQuery = "SELECT * FROM users WHERE username='$user' LIMIT 1;";
	$userData = $db->query($userQuery);
	$userRow = $userData->fetch();
	$userOrgID = $userRow["org_id"];
	$is_admin = $userRow["is_admin"];

	$orgQuery = "SELECT * FROM organizations WHERE id=$userOrgID;";
	$orgData = $db->query($orgQuery);
	$orgRow = $orgData->fetch();
	$orgName = $orgRow["name"];

	$start = $startdate . " 00:00:00";
	$end = $enddate . " 23:59:59";

	echo $start . "<br>" . $end . "<br>";

	$deliveryQuery = "SELECT * FROM deliveries WHERE drop_off_time BETWEEN \"$start\" AND \"$end\";";
	$deliveryData = $db->query($deliveryQuery);
}
catch (PDOException $ex)
{
	echo 'Error: ' . $ex->getMessage();
	die();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		<?php 
			echo "$orgName ";
			if ($is_admin) { 
				echo "Admin"; 
			}
			else { 
				echo "Client"; 
			} 
			echo " Home"; 
		?>
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">     

	<script type="text/javascript" src="../jquery-timepicker/jquery.timepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery.timepicker.css" />

	<script type="text/javascript" src="lib/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css" />

	<script type="text/javascript" src="lib/site.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/site.css" />	

  	<script>
  	$(function() {
    	$( "#startingdatepicker" ).datepicker();
  	});

  	$(function() {
    	$( "#endingdatepicker" ).datepicker();
  	});
  	</script>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
	    	<div class="navbar-header">
	      		<a class="navbar-brand" href="home.php">
	      			<?php echo "$orgName"; ?>
	      		</a>
	    	</div>
			<ul class="nav navbar-nav">
	  			<li class="active"><a href="home.php">Home</a></li>
	  			<li><a href="deliveries.php">Deliveries</a></li>
	  			<li><a href="#">Invoices</a></li>
	  			<li><a href="#">Users</a></li>

	  			<?php
	  				if ($is_admin) {
	  					echo "\t\t\t\t<li><a href=\"#\">Administration</a></li>";
	  				}
	  			?>

	  			<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>
	  
	<div class="container">
        <h3>DELIVERIES</h3>

        <form action="deliveries.php" method="POST">
			<table class='table'>
				<tr>
					<td>Starting Date:  <input name="startdate" type="text" id="startingdatepicker"></td>
					<td></td>
					<td>Ending Date:  <input name="enddate" type="text" id="endingdatepicker"></td>
				</tr>
			</table>

			<input type="submit">
        </form>


		<hr class="featurette-divider">

<?php
	echo $deliveryQuery . "<br>";

	foreach ($deliveryData as $row) {
		// echo "$row['id']<br>";
	}
?>

	    <div class="row featurette">
	        <div class="col-md-7 col-md-push-5">
	        </div>
	        <div class="col-md-5 col-md-pull-7">	      
	        </div>
	    </div>
	</div>
</body>
</html>