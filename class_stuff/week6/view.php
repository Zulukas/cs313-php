<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

try
{
	$user = 'php';
	$password = 'foo';
	$server = 'localhost';



	$db = new PDO("mysql:host=" . $server . ";dbname=in_class", $user, $password);

	//Insert Here

if (isset($_POST)) {
	$book = $_POST["book"];
	$chapter = $_POST["chapter"];
	$verse = $_POST["verse"];
	$content = $_POST["content"];
	$topics = $_POST["topics"];
	
	$insertQuery = "INSERT INTO scriptures (book, chapter, verse, content) VALUE (\"$book\", $chapter, $verse, \"$content\");";

	$newRowID = $db->query("SELECT id FROM scriptures WHERE (book=\"$book\" AND chapter=$chapter AND verse = $VERSE);");

	echo $newRowID . "<br>";

	$db->query($insertQuery);

	$dbtopics = $db->query("SELECT * FROM topics;");

	foreach ($dbtopics as $topic) {
		if in_array($topic, $topics) {
			$db->query("INSERT INTO scripturetopic (scripture_id, topic_id) VALUE ($newRowID, $)";);
		}
	}
}

	//Read Here

	$topicsQuery = "SELECT name FROM topics;";

	$scripQuery = "SELECT * FROM scriptures";
	$topicQuery = "SELECT * FROM topics;";
	$stQuery = "SELECT topic_id, scripture_id FROM scripturetopic;";

	$stData = $db->query($stQuery);
	$scripData = $db->query($scripQuery);
	$topicData = $db->query($topicQuery);

	foreach ($scripData as $scripRow) {
		$book = $scripRow['book'];
		$chapter = $scripRow['chapter'];
		$verse = $scripRow['verse'];
		$content = $scripRow['content'];

		$scripture = "<b>" . $book . " " . $chapter . ":" . $verse . "</b>";
		echo $scripture . ": ";

		$topicsIDArray = array();

		foreach ($stData as $strow) {
			if ($strow["scripture_id"] == $scripRow["id"]) {
				//print out the topics
				array_push($topicsIDArray, $strow["topics_id"]);
			}
		}

		foreach ($topicData as $topicsRow) {
			if (in_array($topicsRow["id"], $topicsIDArray)) {
				echo " " . $topicsRow[0]["name"];
			}
		}		
	}


	// foreach ($db->query() as $row)
	// {
		

	// 	$scriptureData[$scripture] = $content;

	// }

	// foreach ($scriptureData as $scripture)
	// {
	// 	echo $scripture . "- \"" . $scriptureData[$scripture] ."\"";
	// }
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

</body>
</html>