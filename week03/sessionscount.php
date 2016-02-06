<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
This is a wonderful php file! <3

<?php 

if (!isset($_SESSION["VisitCount"]))
{
	$_SESSION["VisitCount"] = 0;
}

$_SESSION["VisitCount"] += 1;


if ($_SESSION["VisitCount"] > 9000)
{
	echo "YOU HAVE VISITED THIS PAGE OVER 9000!!!!!!!! times.<br>";
	$_SESSION["VisitCount"] = 1;
}
else
{
	echo "<br>You have visited this page: " . $_SESSION['VisitCount'] . " times!<br>";
}


?>
</body>
</html>