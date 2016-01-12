<!DOCTYPE html>
<html>
	<head>
		<title>My first PHP page</title>
	</head>
	<body>
		<div>
			This is a pretty awesome page, bossman.

<?php
$name = "Br. Burton";
echo "<br>This is coming from PHP!<br>";
echo "Hello, $name<br>";

for ($i = 0; $i < 10; $i++)
{
	print "<div>WHOA!!</div>\n";
}
?>

		</div>
	</body>
</html>