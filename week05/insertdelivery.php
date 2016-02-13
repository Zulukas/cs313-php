<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$user     = $_SESSION['user'];
$orgName = $_SESSION['orgname'];
$orgID = $_SESSION['orgid'];

$pickuploc  = $_POST['pickupaddress'];
$dropoffloc = $_POST["dropoffaddress"];
$pickupdate = $_POST["startdate"];
$pickupdate = date('Y-m-d', strtotime($pickupdate));
$priority   = $_POST["priority"];

echo $pickuploc . " " . $dropoffloc . " " . $pickupdate . " " . $priority[0] . "<br />";

$dropoffdate = "";

switch ($priority[0])
{
    case 1:
        $dropoffdate = date('Y-m-d', strtotime($pickupdate . ' + 1 days'));
        break;
    case 2:
        $dropoffdate = date('Y-m-d', strtotime($pickupdate . ' + 2 days'));
        break;
    case 3:
        $dropoffdate = date('Y-m-d', strtotime($pickupdate . ' + 5 days'));
        break;
    case 4:
        $dropoffdate = date('Y-m-d', strtotime($pickupdate . ' + 10 days'));
        break;
}

try
{
	$SQLuser = 'php';
	$SQLpassword = 'foo';
	// $server = '127.3.232.130:3306';
	$server = 'localhost';


	$db = new PDO("mysql:host=" .$server . ";dbname=php_project", $SQLuser, $SQLpassword);

    $query = "INSERT INTO deliveries (pick_up_location, drop_off_location, estimated_pick_up_time, estimated_drop_off_time, priority_level, org_id, billing_date) VALUES (\"$pickuploc\", \"$dropoffloc\", \"$pickupdate\", \"$dropoffdate\", $priority[0], $orgID, now());";
    echo "<br />" . $query;
}
catch (PDOException $ex)
{
	echo 'Error: ' . $ex->getMessage();
	die();
}
 ?>
