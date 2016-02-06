<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

try
{
	$SQLuser = 'php';
	$SQLpassword = 'foo';
	$server = '127.3.232.130:3306';

	$username = $_POST['username'];
	$password = $_POST['password'];

	if ($username == "" || $password == "")
	{
		setcookie("INVALID", 1, time() + 60);
		header("Location: login.php");
	}

	$db = new PDO("mysql:host=localhost;dbname=php_project", $SQLuser, $SQLpassword);
	// $db = new PDO("mysql:host=" .$server . ";dbname=php_project", $SQLuser, $SQLpassword);

	$sqlQuery = "SELECT password FROM users WHERE username='" . $username . "' LIMIT 1";

	$answer = $db->query($sqlQuery);
	$row = $answer->fetch();
	$result = $row['password'];

	if ($result == $password) {
		session_start();

		$_SESSION['user']	= $username;

		header("Location: home.php");
	}
	else {
		setcookie("INVALID", 1, time() + 60);
		header("Location: login.php");
	}

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
