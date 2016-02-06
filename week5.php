<?php

try
{
	$user = 'php';
	$password = 'foo';
	$server = 'localhost';

	// echo "Using user: $user; password: $password; server: $server";

	$db = new PDO("mysql:host=localhost;dbname=in_class", $user, $password);

	$scriptureData = array();

	foreach ($db->query('SELECT book, chapter, verse, content FROM scriptures') as $row)
	{
		// echo  "<b>" . $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " -</b> \"" . $row['content'] . "\"<br/>";
		// $scripture = "<b>" . $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . "</b>";
		// $content = '\"$row['content']\"';
		$book = $row['book'];
		$chapter = $row['chapter'];
		$verse = $row['verse'];
		$content = $row['content'];
		
		$scripture = "<b>" . $book . " " . $chapter . ":" . $verse . "</b>";
		echo $scripture . "</br>";

		$scriptureData[$scripture] = $content;

	}

	foreach ($scriptureData as $scripture)
	{
		echo $scripture . "- \"" . $scriptureData[$scripture] ."\"";
	}
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
	<title>Week 5</title>
</head>
<body>

</body>
</html>
