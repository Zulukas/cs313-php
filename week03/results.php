<?php 

$resultsfile = "surveyresults.dat";

if ($_POST["submit"] == "submitted")
{
	if (!isset($_COOKIE["has_voted"])) {
		//All the post data goes here

		//Get the user's input
		$fixings = $_POST["fixings"];
		$meat = $_POST["meat"];
		$rice = $_POST["rice"];
		$beans = $_POST["beans"];
		$medium = $_POST["medium"];
		$tomato_stuff = $_POST["tomato_stuff"];

		//The name of the file containg previous results.

		//Opens the file for appending (file must already exist).
		$fh = fopen($resultsfile, 'a');

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


		setcookie("has_voted", "1", mktime().time()+60*60*24*365*10);
	}
}

require "resultsphpheader.php";

 ?>
      
<!DOCTYPE html>
<html>
<head>
	<title>Results</title>
	<script medium="text/javascript" src="survey.js"></script>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" medium="text/css" href="survey.css">
	<script type="text/javascript" src="sources/jscharts.js"></script>
	<script type="text/javascript" src="results.js"></script>
  
            <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">

          // Load the Visualization API and the piechart package.
          google.load('visualization', '1.0', {'packages':['corechart']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(drawChart);

          // Callback that creates and populates a data table,
          // instantiates the pie chart, passes in the data and
          // draws it.
          function drawChart() {
          	var meatsArray = [<?php echo json_encode($meats); ?>];
	      	var beansArray = [<?php echo json_encode($beans); ?>];
	      	var riceArray = [<?php echo json_encode($rices); ?>];
	      	var mediumsArray = [<?php echo json_encode($mediums); ?>];
	      	var tomatoArray = [<?php  echo json_encode($tomato_stuff); ?>];
	      	var fixingsArray = [<?php echo json_encode($fixings); ?>]

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Meat');    
            data.addColumn('number', 'Count');
            data.addRows([
              ['Carne Asada', meatsArray[0].Carne_Asada],
			  ['Chicken',     meatsArray[0].Chicken],
			  ['Carnitas',    meatsArray[0].Carnitas],
			  ['Ground Beef', meatsArray[0].Ground_Beef],
			  ['Barbacoa', meatsArray[0].Barbacoa],
			  ['Fish',        meatsArray[0].Fish],
			  ['Vegetairan',  meatsArray[0].Vegetarian]

            ]);
            // Create the data table.
            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Rice');
            data2.addColumn('number', 'Count');
            data2.addRows([
              ['Cilantro Rice', riceArray[0].Cilantro_Rice],
			  ['Spanish Rice',  riceArray[0].Spanish_Rice],
			  ['White Rice',    riceArray[0].White_Rice],
			  ['Brown Rice', 	riceArray[0].Brown_Rice],
			  ['No Rice',       riceArray[0].No_Rice] 
            ]);

            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'Rice');
            data3.addColumn('number', 'Count');
            data3.addRows([              
			  ['Refried Beans',  beansArray[0].Refried_Beans],
			  ['Black Beans',    beansArray[0].Black_Beans],
			  ['Pinto Beans', 	beansArray[0].Pinto_Beans],
			  ['No Beans',       beansArray[0].No_Beans] 
            ]);              

            // Set chart options
            var options = {'title':'Favorite Meats',
                           'width':400,
                           'height':300};
            // Set chart options
            var options2 = {'title':'Favorite Kinds of Rice',
                           'width':400,
                           'height':300};
            // Set chart options
            var options3 = {'title':'Favorite Kinds of Beans',
                           'width':400,
                           'height':300};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
            var chart3 = new google.visualization.BarChart(document.getElementById('chart_div3'));
            chart3.draw(data3, options3);

          }
  </script> 
</head>
<body>

        <div id="chart_div"></div>
        <div id="chart_div2"></div>
        <div id="chart_div3"></div>
</body>
</html>