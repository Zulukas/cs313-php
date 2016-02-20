<?php
session_start();

require "serverinfo.php";

$id = $_POST['deliveryid'];
$pickupdate = $_POST['startdate'];
$pickupdate = date('Y-m-d', strtotime($pickupdate));
$dropoffdate = $_POST['enddate'];
$dropoffdate = date('Y-m-d', strtotime($dropoffdate));

try
{
	$db = new PDO("mysql:host=" .$server . ";dbname=php_project", $SQLuser, $SQLpassword);

    $query = "UPDATE deliveries SET pick_up_time=\"" . $pickupdate . "\", drop_off_time=\"" . $dropoffdate . "\" WHERE id=" . $id . ";";
    echo $query;

    $db->query($query);
    header("location: deliveries.php");
}
catch (PDOException $ex)
{
	echo 'Error: ' . $ex->getMessage();
	die();
}
?>
