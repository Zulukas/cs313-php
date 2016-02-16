<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$name            = $_POST["name"];
$address         = $_POST["address"];
$billing_address = $_POST["billing_address"];

try
{
	$SQLuser = 'php';
	$SQLpassword = 'foo';
	$server = '127.3.232.130:3306';
    // $server = 'localhost';
    $dbname = 'php_project';

	$db = new PDO("mysql:host=" .$server . ";dbname=$dbname", $SQLuser, $SQLpassword);

    //Check to see if the username is used already...
	$sqlQuery = "SELECT name FROM organizations WHERE name='" . $name . "'";
    $users = $db->query($sqlQuery);
    $userExists = false;

    foreach ($users as $user) {
        $userExists = true;
        break;
    }

    if ($userExists) {
        setcookie("COMPANY_NAME_TAKEN", 1, time() + 60);
		header("Location: registerorg.php");
    }

    $sqlQueryToInsert = "INSERT INTO organizations (name, address, billing_address, company_rate) VALUE (\"$name\", \"$address\", \"$billing_address\", 4);";
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
