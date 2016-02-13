<?php

function convertDate($date_input) {
	$pieces = explode("/", $date_input);
	$date_out = $pieces[2] . "-" . $pieces[0] . "-" . $pieces[1];

	return $date_out;
}

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$startdate = "";
$enddate = "";
$mode = "act";
$org = "";

if (!empty($_POST)) {
	$startdate 	= $_POST["startdate"];
	$enddate  	= $_POST["enddate"];
	$mode		= $_POST["type"];
	$org 		= $_POST["org"];
}

$user     = $_SESSION['user'];
$orgName = $_SESSION['orgname'];
$orgID = $_SESSION['orgid'];

$is_admin = 0;

$SQLuser = 'php';
$SQLpassword = 'foo';
// $server = '127.3.232.130:3306';
$server = 'localhost';

try //All SQL related stuff goes in this try loop.
{
	$db = new PDO("mysql:host=" .$server . ";dbname=php_project", $SQLuser, $SQLpassword);

	$userQuery = "SELECT * FROM users WHERE username='$user' LIMIT 1;";
	$userData = $db->query($userQuery);
	$userRow = $userData->fetch();
	$userOrgID = $userRow["org_id"];
	$is_admin = $userRow["is_admin"];

	$orgQuery = "SELECT * FROM organizations WHERE id=$userOrgID;";
	$orgData = $db->query($orgQuery);
	$orgRow = $orgData->fetch();
	$orgName = $orgRow["name"];

	$orgNamesIDs = "";

	if ($is_admin == "1") {
		$orgNamesIDQuery = "SELECT id, name FROM organizations ORDER BY name ASC;";
		$orgNamesIDs = $db->query($orgNamesIDQuery);
	}

	if ($startdate != "" && $enddate != "") {
		$start = convertDate($startdate) . " 00:00:00";
		$end = convertDate($enddate) . " 23:59:59";

		$deliveryQuery = "SELECT * FROM deliveries WHERE drop_off_time BETWEEN \"$start\" AND \"$end\";";
		$deliveryData = $db->query($deliveryQuery);
	}
	else { //Get all the delivery records for this organization.
		$deliveryQuery = "";
		if ($is_admin) {
			if ($mode == "act") {
				$deliveryQuery = "SELECT id, pick_up_location, drop_off_location, pick_up_time, drop_off_time, priority_level, billing_date FROM deliveries";
			}
			else {
				$deliveryQuery = "SELECT id, pick_up_location, drop_off_location, estimated_pick_up_time, estimated_drop_off_time, priority_level, billing_date FROM deliveries";
			}

			if ($org != "") { //No selection
				$deliveryQuery .= " WHERE org_id=\"$org\"";
			}

			$deliveryQuery .= ";";
		}
		else {
			if ($mode == "act") {
				$deliveryQuery = "SELECT id, pick_up_location, drop_off_location, pick_up_time, drop_off_time, priority_level, billing_date FROM deliveries WHERE org_id=\"$userOrgID\";";
			}
			else {
				$deliveryQuery = "SELECT id, pick_up_location, drop_off_location, estimated_pick_up_time, estimated_drop_off_time, priority_level, billing_date FROM deliveries WHERE org_id=\"$userOrgID\";";
			}
		}

		// $_SESSION['user'] = $user;
		// $_SESSION['orgid'] = $userOrgID;
		// $_SESSION['orgname'] = $orgName;
		$deliveryData = $db->query($deliveryQuery);
	}
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
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  	<script>
  	$(function() {
    	$( "#startingdatepicker" ).datepicker();
  	});

  	$(function() {
    	$( "#endingdatepicker" ).datepicker();
  	});
  	</script>
	<style>
		a.button {
			-webkit-appearance: button;
			-moz-appearance: button;
			appearance: button;

			text-decoration: none;
			color: initial;
		}
	</style>
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
	  			<li><a href="home.php">Home</a></li>
	  			<li class="active"><a href="#">Deliveries</a></li>
	  			<li><a href="invoices.php">Invoices</a></li>
	  			<li><a href="users.php">Users</a></li>

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
					<td>						</td>
					<td>Ending Date:  <input name="enddate" type="text" id="endingdatepicker"></td>
				</tr>
				<tr>
					<td>
						<select name="type">
							<option value="act" selected>Actual Times</option>
							<option value="est">Estimated Times</option>
						</select>
					</td>
				</tr>
<?php
	if ($is_admin) {
		echo "<tr><td><select name=\"org\"><option value=\"\" selected></option>";

		foreach ($orgNamesIDs as $row) {
			echo "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option>";
		}

		echo "</tr></td>";
	}
?>
				<tr>
					<td>
						<input type="submit">
					</td>
				</tr>
			</table>
        </form>


		<hr class="featurette-divider">

		<table class='table table-striped'>
			<tr>

<?php

echo "<td>ID</<td><td>Priority</td><td>Billing Date</td><td>Pick-up Location</td>";

if ($mode == "act") {
	echo "<td>Pick-up Time</td><td>Drop-off Location</td><td>Drop-off Time</td>";
}
else {
	echo "<td>Est. Pick-up Time</td><td>Drop-off Location</td><td>Est. Drop-off Time</td>";
}

echo "</tr>";

foreach ($deliveryData as $row) {
	echo "<tr>";
	echo "<td>" . $row['id'] . "</td>";
	echo "<td>" . $row['priority_level'] . "</td>";
	echo "<td>" . $row['billing_date'] . "</td>";
	echo "<td>" . $row['pick_up_location'] . "</td>";

	if ($mode == "act") {
		echo "<td>" . $row['pick_up_time'] . "</td>";
	}
	else {
		echo "<td>" . $row['estimated_pick_up_time'] . "</td>";
	}

	echo "<td>" . $row['drop_off_location'] . "</td>";

	if ($mode == "act") {
		echo "<td>" . $row['drop_off_time'] . "</td>";
	}
	else {
		echo "<td>" . $row['estimated_drop_off_time'] . "</td>";
	}

	echo "</tr>";
}
?>

		</table>


		<br /><br /><br />
		<!-- <form action="adddelivery.php<?php echo "?user=$user&orgid=$userOrgID&orgname=$orgName"; ?>" method="POST">
			<input type="bu" value="Add Delivery"/>
		</form> -->
		<a href="adddelivery.php" class="btn btn-default"> Add Delivery </a>
		<br />
		<br />
	</div>
</body>
</html>
