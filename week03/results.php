<!DOCTYPE html>
<html>
<head>
	<title>Results</title>
	<script medium="text/javascript" src="survey.js"></script>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" medium="text/css" href="survey.css">
</head>
<body>
<?php
//The name of the file containg previous results.
$resultsfile = "surveyresults.dat";

//Opens the file for appending (file must already exist).
$fh = fopen($resultsfile, 'a');

//Get the user's input
$fixings = $_POST["fixings"];
$meat = $_POST["meat"];
$rice = $_POST["rice"];
$beans = $_POST["beans"];
$medium = $_POST["medium"];
$tomato_stuff = $_POST["tomato_stuff"];

//Create an array to store everything
$results_array = array();

//Push everything on
array_push($results_array, $meat, $rice, $beans, $medium, $tomato_stuff);

foreach ($fixings as $item) {
	array_push($results_array, $item);
}

//Implode the array and separate it.
$comma_delimited_list = implode("\n", $results_array) . ",\n";

//Write to our results file.
fwrite($fh, $comma_delimited_list);

fopen($resultsfile, 'r');

$content = file_get_contents("./$resultsfile", true);

//Build my results arrays

$meats = array(
	"Carne Asada" => substr_count($content, "Carne Asada"),
	"Chicken" => substr_count($content, "Chicken"),
	"Carnitas" => substr_count($content, "Carnitas"),
	"Ground Beef" => substr_count($content, "Ground Beef"),
	"Barbacoa" => substr_count($content, "Barbacoa"),
	"Fish" => substr_count($content, "Fish"),
	"Vegetarian" => substr_count($content, "Vegetarian")
);

print_r($meats);

$rices = array(
	"Cilantro Rice" => substr_count($content, "Cilantro Rice"),
	"Spanish Rice" => substr_count($content, "Spanish Rice"),
	"White Rice" => substr_count($content, "White Rice"),
	"Brown Rice" => substr_count($content, "Brown Rice"),
	"No Rice" => substr_count($content, "No Rice")
);

print_r($rices);

//This may cause issues with the currently existing beans variable
$beans = array(
	"Refried Beans" => substr_count($content, "Refried Beans"),
	"Black Beans" => substr_count($content, "Black Beans"),
	"Pinto Beans" => substr_count($content, "Pinto Beans"),
	"No Beans" => substr_count($content, "No Beans")
);

print_r($beans);

$mediums = array(
	"Thick Tortilla" => substr_count($content, "Thick Tortilla"),
	"Thin Tortilla" => substr_count($content, "Thin Tortilla"),
	"Salad" => substr_count($content, "Salad")	
);

print_r($beans);

//This may cause issues with the currently existing beans variable
$tomato_stuff = array(
	"Plain" => substr_count($content, "Plain"),
	"Pico de Gallo" => substr_count($content, "Pico de Gallo"),
	"Salsa" => substr_count($content, "Salsa")	
);

print_r($tomato_stuff);

$fixings = array(
	"Lettuce" => substr_count($content, "Lettuce"),
	"Sour Cream" => substr_count($content, "Sour Cream"),
	"Guacamole" => substr_count($content, "Guacamole"),
	"Cilantro" => substr_count($content, "Lettuce"),
	"Lime" => substr_count($content, "Lime"),
	"Jalapenos" => substr_count($content, "Jalapenos"),
	"Onions" => substr_count($content, "Onions")
);
print_r($fixings);

?>
</body>
</html>