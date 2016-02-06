<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php

$string = file_get_contents("test.json");
$json_a = json_decode($string, true);

foreach ($json_a as $k => $v) {
	echo "$k: $v";
}

?>

</body>
</html>