<?php
session_start();
require 'serverinfo.php';

if ($_SESSION['user'] == "") {
    header("Location: login.php");
}

$dQuery = "SELECT * FROM deliveries;";

try
{
	$db = new PDO("mysql:host=" .$server . ";dbname=php_project", $SQLuser, $SQLpassword);

    $deliveries = $db->query($dQuery);
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
    <title>Update Delivery</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function() {
            $( "#datepickerdf" ).datepicker();
        });
        $(function() {
        	$( "#datepickerpu" ).datepicker();
      	});
    </script>
</head>
<body>
    <form action="updatedeliverysubmit.php" method="post">
        <select name="deliveryid">
            <option value="">Select delivery:</option>
<?php
        foreach ($deliveries as $row) {
            echo "<option value =" . $row['id'] . ">" . $row['id'] . " - Pick-up Location: " . $row["pick_up_location"] . " - Drop off Location: " . $row["drop_off_location"] . "</option>";
        }
?>
        </select>
        <br /><br />
        <label>Pick up date: <input name="startdate" type="text" id="datepickerpu" name="pickupdate"></label>
        <!-- <label>Drop off date: <input name="enddate" type="text" id="datepicker" name="dropoffdate"></label> -->
        <label>Pick up date: <input name="enddate" type="text" id="datepickerdf" name="pickupdate"></label>
<br /><br />
        <input type="submit" />
    </form>
</body>
</html>
