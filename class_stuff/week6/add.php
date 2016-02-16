<?php
try
{
	$user = 'php';
	$password = 'foo';
	$server = 'localhost';

	$db = new PDO("mysql:host=" . $server . ";dbname=in_class", $user, $password);

	$topicsQuery = "SELECT name FROM topics;";
	$topics = $db->query($topicsQuery);
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
	<title></title>
</head>
<body>
	<form action="view.php" method="POST">
		<ul>
			<ol>Book: <input type="text" name="book"></ol>
			<ol>Chapter: <input type="text" name="chapter"></ol>
			<ol>Verse: <input type="text" name="verse"></ol>
			<br>
			<ol>Content:</ol>
			<ol><textarea name="content" rows="5" cols="20"></textarea></ol>
			<br>
<?php
	foreach($topics as $row) {
		echo "<ol><input type='checkbox' name='topics[]' value=" . $row["name"] .">" . $row["name"] . "</ol>";
	}
?>
			<br><br>
			<ol><input type="submit"></ol>
		</ul>
	</form>
</body>
</html>