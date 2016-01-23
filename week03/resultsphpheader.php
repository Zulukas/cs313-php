<?php


fopen($resultsfile, 'r');

$content = file_get_contents("./$resultsfile", true);

//Build my results arrays

$meats = array(
	"Carne_Asada" => substr_count($content, "Carne Asada"),
	"Chicken" => substr_count($content, "Chicken"),
	"Carnitas" => substr_count($content, "Carnitas"),
	"Ground_Beef" => substr_count($content, "Ground Beef"),
	"Barbacoa" => substr_count($content, "Barbacoa"),
	"Fish" => substr_count($content, "Fish"),
	"Vegetarian" => substr_count($content, "Vegetarian")
);

// print_r($meats);

$rices = array(
	"Cilantro_Rice" => substr_count($content, "Cilantro Rice"),
	"Spanish_Rice" => substr_count($content, "Spanish Rice"),
	"White_Rice" => substr_count($content, "White Rice"),
	"Brown_Rice" => substr_count($content, "Brown Rice"),
	"No_Rice" => substr_count($content, "No Rice")
);

// print_r($rices);

//This may cause issues with the currently existing beans variable
$beans = array(
	"Refried_Beans" => substr_count($content, "Refried Beans"),
	"Black_Beans" => substr_count($content, "Black Beans"),
	"Pinto_Beans" => substr_count($content, "Pinto Beans"),
	"No_Beans" => substr_count($content, "No Beans")
);

// print_r($beans);

$mediums = array(
	"Thick_Tortilla" => substr_count($content, "Thick Tortilla"),
	"Thin_Tortilla" => substr_count($content, "Thin Tortilla"),
	"Salad" => substr_count($content, "Salad")	
);

// print_r($beans);

//This may cause issues with the currently existing beans variable
$tomato_stuff = array(
	"Plain" => substr_count($content, "Plain"),
	"Pico_de_Gallo" => substr_count($content, "Pico de Gallo"),
	"Salsa" => substr_count($content, "Salsa"),
	"None" => substr($content, "None")	
);

// print_r($tomato_stuff);

$fixings = array(
	"Lettuce" => substr_count($content, "Lettuce"),
	"Sour_Cream" => substr_count($content, "Sour Cream"),
	"Guacamole" => substr_count($content, "Guacamole"),
	"Cilantro" => substr_count($content, "Lettuce"),
	"Lime" => substr_count($content, "Lime"),
	"Jalapenos" => substr_count($content, "Jalapenos"),
	"Onions" => substr_count($content, "Onions")
);
// print_r($fixings);

?>