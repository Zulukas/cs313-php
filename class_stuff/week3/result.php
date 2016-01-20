<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$name = $_POST["name"];
$email = $_POST["email"];
$major = $_POST["major"];
$continents = $_POST["continents"];
$comments = $_POST["comments"];

echo "Welcome $name ($email)<br/>";
echo "Your major is: $major<br/>";

echo "<br/>You have visted:<br/><ul>";

foreach ($continents as $continent)
{
	echo "<li>$continent</li>";
}
	
echo "</ul>";

echo "Your comments are:<br/>";
echo "$comments<br/>";
?>
</body>
</html>