<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = $_POST["username"];
$password = $_POST["password"];
$first    = $_POST["first"];
$last     = $_POST["last"];
$company  = $_POST["company"];
$phone    = $_POST["phone"];

try
{
	$SQLuser = 'php';
	$SQLpassword = 'foo';
	$server = '127.3.232.130:3306';
    // $server = 'localhost';
    $dbname = 'php_project';

	// $username = $_POST['username'];
	// $password = $_POST['password'];

	$db = new PDO("mysql:host=" .$server . ";dbname=$dbname", $SQLuser, $SQLpassword);

    //Check to see if the username is used already...
	$sqlQuery = "SELECT username FROM users WHERE username='" . $username . "'";
    $users = $db->query($sqlQuery);
    $userExists = false;

    foreach ($users as $user) {
        $userExists = true;
        break;
    }

    if ($userExists) {
        setcookie("USERNAME_TAKEN", 1, time() + 60);
		header("Location: register.php");
    }

    $sqlQuery = "SELECT id FROM organizations WHERE name=\"$company\" LIMIT 1;";
    $orgData = $db->query($sqlQuery);
    $orgRow = $orgData->fetch();
    $org_id = $orgRow['id'];

    if ($org_id == "") {
        setcookie("INVALID_COMPANY", 1, time() + 60);
        header("Location: register.php");
    }

    $sqlQueryToInsert = "INSERT INTO users (username, password, org_id, firstname, lastname, phone_number, account_creation_date) VALUE (\"$username\", \"$password\", $org_id, \"$first\", \"$last\", \"$phone\", now());";
    $users = $db->query($sqlQueryToInsert);
}
catch (PDOException $ex)
{
	echo 'Error: ' . $ex->getMessage();
	die();
}

 ?>

 <html>
 <head>
     <title>Success!</title>
 </head>
 <body>
     <h1>Success registering user!</h1>
     <a href="login.php">Login Page</a>
 </body>
 </html>
