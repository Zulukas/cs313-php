<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

try
{
	$SQLuser = 'php';
	$SQLpassword = 'foo';
	// $server = '127.3.232.130:3306';
	$server = 'localhost';

	$username = $_POST['username'];
	$password = $_POST['password'];

	if ($username == "" || $password == "")
	{
		setcookie("INVALID", 1, time() + 60);
		header("Location: login.php");
	}

	$db = new PDO("mysql:host=" .$server . ";dbname=php_project", $SQLuser, $SQLpassword);

	$sqlQuery = "SELECT password, org_id FROM users WHERE username='" . $username . "' LIMIT 1";

	$answer = $db->query($sqlQuery);
	$row = $answer->fetch();
	$result = $row['password'];

	$orgQuery = "SELECT name FROM organizations WHERE id=" . $row['org_id'] . "";
	$orgData = $db->query($orgQuery);
	$orgRow = $orgData->fetch();
	$orgName = $orgRow['name'];

	if ($result == $password) {
		session_start();

		$_SESSION['user']	= $username;
		$_SESSION['orgid']  = $row['org_id'];
		$_SESSION['orgname'] = $orgName;

		header("Location: home.php");
	}
	else {
		setcookie("INVALID", 1, time() + 60);
		header("Location: login.php");
	}

	//Update the login date
	$updateQuery = "UPDATE users SET account_last_login=now() WHERE username=\"" . $username . "\";";
	$db->query($updateQuery);
}
catch (PDOException $ex)
{
	echo 'Error: ' . $ex->getMessage();
	die();
}
?>
<!--SELECT * FROM actormovie am JOIN actor a ON am.actorID = a.id JOIN movie m ON am.movieID = m.id;-->

<!DOCTYPE html>
<html>
<body>
	<form method="POST"
</body>
</html>
