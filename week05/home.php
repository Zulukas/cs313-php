<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
	  			<li><a href="invoices.php">Invoices</a></li>
	  			<li><a href="users.php">Users</a></li>

	  			<?php
	  				if ($is_admin) {
	  					echo "\t\t\t\t<li><a href=\"administration.php\">Administration</a></li>";
	  				}
	  			?>

	  			<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>
	  
	<div class="container">
        <h3>Welcome <?php echo "$user"; ?></h3>
		<hr class="featurette-divider">

	    <div class="row featurette">
	        <div class="col-md-7 col-md-push-5">
	        </div>
	        <div class="col-md-5 col-md-pull-7">	      
	        </div>
	    </div>
	</div>

<!-- 	<?php 
		// echo "Welcome $user<br>"; 
	?> -->
</body>
</html>