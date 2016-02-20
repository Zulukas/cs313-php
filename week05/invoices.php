<?php

//Giving credit where credit is due:
//http://stackoverflow.com/questions/29003118/get-driving-distance-between-two-points-using-google-maps-api

function get_coordinates($city, $street, $province)
{
    $address = urlencode($city.','.$street.','.$province);
    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=Poland";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response);
    $status = $response_a->status;

    if ( $status == 'ZERO_RESULTS' )
    {
        return FALSE;
    }
    else
    {
        $return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
        return $return;
    }
}

function GetDrivingDistance($lat1, $lat2, $long1, $long2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=en-US";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

    return array('distance' => $dist, 'time' => $time);
}

function parseAddress($address)
{
	$parts = explode(", ", $address);

	$stateparts = explode(" ", $parts[2]);
	$parts[2] = $stateparts[0];

	return $parts;
}

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$user     = $_SESSION['user'];
$orgName = "NOT FOUND";
$is_admin = 0;

require "serverinfo.php";

$db = "";

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

	$delQuery = "SELECT * FROM deliveries";

	if (!$is_admin) {
		$delQuery .= " WHERE id=$userOrgID;";
	}

	$delData = $db->query($delQuery);
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
	  			<li><a href="home.php">Home</a></li>
	  			<li><a href="deliveries.php">Deliveries</a></li>
	  			<li class="active"><a href="#">Invoices</a></li>
	  			<li><a href="users.php">Users</a></li>
                <li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</nav>

	<div class="container">
<?php
foreach ($delData as $row) {
	$parts = parseAddress($row["pick_up_location"]);
	$coord1 = get_coordinates($parts[1], $parts[0], $parts[2]);
	$parts = parseAddress($row["drop_off_location"]);
	$coord2 = get_coordinates($parts[1], $parts[0], $parts[2]);

	$distanceKM = "";
	$miles = "";
	$distanceMI = "";
	if ( !$coord1 || !$coord2 )
	{
	    $distanceKM = 'Bad address(es).';
			$distanceMI = $distanceKM;
	}
	else
	{
	    $dist = GetDrivingDistance($coord1['lat'], $coord2['lat'], $coord1['long'], $coord2['long']);
			$distanceKM = $dist["distance"];
			// echo $distanceKM . "<br>";
			$parts = explode(" ", $distanceKM);
			$km = str_replace(",", "", $parts[0]);
			$miles = round($km / 1.6093442, 1);
			$distanceMI = $miles . " miles";
			// echo $distanceMI . "<br>";
	}

	$query = "SELECT billing_address, company_rate FROM organizations WHERE id=" . $row["org_id"] . ";";
	$data = $db->query($query);
	$datarow = $data->fetch();
	$billing_address = $datarow["billing_address"];
	$company_rate = $datarow["company_rate"];

	echo "<table class=\"table\" style=\"width: 800px\">";
	echo "<tr><td>Invoice #" . $row["id"] . "</td><td></td></tr>";
	echo "<tr><td>Billing Address: " . $billing_address . "</td><td>Billing Date: " . $row["billing_date"] . "</td></tr>";
	echo "<tr><td>Pick-up Location: " . $row["pick_up_location"] . "</td><td>Drop-off Location: " . $row["drop_off_location"] . "</td></tr>";
	echo "<tr><td>Total Distance - " . $distanceKM . " or " . $distanceMI . "</td><td></td></tr>";
	echo "<tr><td>Base Delivery Rate: $150</td><td></td></tr>";
	echo "<tr><td>Rate per Mile: $" . $company_rate . "</td><td></td><tr>";
	echo "<tr><td>Total: $" . number_format((($miles * $company_rate) + 150), 2) . "</td><td></td></tr>";
	echo "<tr><td></td><td></td></tr></table><br><br>";
}
 ?>
	</div>
