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
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL";
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
	return $parts;
}

$coordinates1 = get_coordinates('Tychy', 'Jana Pawła II', 'Śląskie');
$coordinates2 = get_coordinates('Lędziny', 'Lędzińska', 'Śląskie');
if ( !$coordinates1 || !$coordinates2 )
{
    echo 'Bad address.';
}
else
{
    $dist = GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
    echo 'Distance: <b>'.$dist['distance'].'</b><br>Travel time duration: <b>'.$dist['time'].'</b>';
}

// $addr1 = "1521 1st Ave, Seattle, WA";
// $addr2 = "1301 Alaskan Way, Seattle, WA";

// $parts1 = parseAddress($addr1);
// $parts2 = parseAddress($addr2);

// $coord1 = get_coordinates("Seattle", "1521 1st Ave", "Washington");

// $coord1 = get_coordinates($parts1[1], $parts1[0], $parts1[2]);
// $coord2 = get_coordinates($parts2[1], $parts2[0], $parts2[2]);

echo $parts1[1] . " - " . $parts1[0] . " - " . $parts1[2] . "<br>";
echo $parts2[1] . " - " . $parts2[0] . " - " . $parts2[2] . "<br>";

// if ( !$coord1 || !$coord2 )
// {
//     echo 'Bad address.';
// }
// else
// {
//     $dist = GetDrivingDistance($coord1['lat'], $coord2['lat'], $coord1['long'], $coord2['long']);
//     echo 'Distance: <b>'.$dist['distance'].'</b><br>Travel time duration: <b>'.$dist['time'].'</b>';
// }

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
	  			<li><a href="home.php">Home</a></li>
	  			<li><a href="deliveries.php">Deliveries</a></li>
	  			<li class="active"><a href="#">Invoices</a></li>
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
        <h3>Coming Soon!</h3>
		<hr class="featurette-divider">

	    <div class="row featurette">
	        <div class="col-md-7 col-md-push-5">
	        </div>
	        <div class="col-md-5 col-md-pull-7">	      
	        </div>
	    </div>
	</div>