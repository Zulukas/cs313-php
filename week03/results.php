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
            data3.addColumn('string', 'Beans');
            data3.addColumn('number', 'Count');
            data3.addRows([              
				['Refried Beans',  beansArray[0].Refried_Beans],
				['Black Beans',    beansArray[0].Black_Beans],
				['Pinto Beans', 	beansArray[0].Pinto_Beans],
				['No Beans',       beansArray[0].No_Beans] 
            ]);              

            var data4 = new google.visualization.DataTable();
            data4.addColumn('string', 'Tortilla');
            data4.addColumn('number', 'Count');
            data4.addRows([              
				['Thick Tortilla', mediumsArray[0].Thick_Tortilla],
				['Thin Tortilla', mediumsArray[0].Thin_Tortilla],
				['Salad',  		mediumsArray[0].Salad]
            ]); 

            var data5 = new google.visualization.DataTable();
            data5.addColumn('string', 'Tomato Stuff');
            data5.addColumn('number', 'Count');
            data5.addRows([              
				['Plain', 		tomatoArray[0].Plain],
				['Pico de Gallo', tomatoArray[0].Pico_de_Gallo],
				['Salsa',  		tomatoArray[0].Salsa],
				['None',		  	tomatoArray[0].None]
            ]); 

            var data6 = new google.visualization.DataTable();
            data6.addColumn('string', 'Rice');
            data6.addColumn('number', 'Count');
            data6.addRows([              
				['Lettuce', 		fixingsArray[0].Lettuce],
				['Sour Cream',    fixingsArray[0].Sour_Cream],
				['Guacamole',    	fixingsArray[0].Guacamole],
				['Cilantro', 		fixingsArray[0].Cilantro],
				['Lime',        	fixingsArray[0].Lime],
				['Jalapenos',  	fixingsArray[0].Jalapenos],
				['Onions', 		fixingsArray[0].Onions]
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
            // Set chart options
            var options4 = {'title':'Favorite Kinds of Tortilla',
                           'width':400,
                           'height':300};
            // Set chart options
            var options5 = {'title':'Favorite Kinds of Tomato-ey Stuff',
                           'width':400,
                           'height':300};
            // Set chart options
            var options6 = {'title':'Favorite Fixings',
                           'width':400,
                           'height':300};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div1'));
            chart.draw(data, options);
            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
            var chart3 = new google.visualization.PieChart(document.getElementById('chart_div3'));
            chart3.draw(data3, options3);0
            var chart4 = new google.visualization.PieChart(document.getElementById('chart_div4'));
            chart4.draw(data4, options4);
            var chart5 = new google.visualization.PieChart(document.getElementById('chart_div5'));
            chart5.draw(data5, options5);
            var chart6 = new google.visualization.BarChart(document.getElementById('chart_div6'));
            chart6.draw(data6, options6);

          }
  </script> 
</head>
<body>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
    	<div class="navbar-header">
      		<a class="navbar-brand">Tastiest Burrito Toppings & Fillins' Results</a>
    	</div>
		<ul class="nav navbar-nav">
  			<li class="active"><a href="results.php">Results</a></li>
		</ul>
	</div>
</nav>

<h2>Voting Results</h2>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
		<li data-target="#myCarousel" data-slide-to="3"></li>
		<li data-target="#myCarousel" data-slide-to="4"></li>
		<li data-target="#myCarousel" data-slide-to="5"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner centered" role="listbox">
		<!-- I wanted to center these, but I couldn't figure out the CSS... -->
		<div class="item active">
			<div id="chart_div1"></div>
		</div>

		<div class="item">
			<div id="chart_div2"></div>
		</div>

		<div class="item">
			<div id="chart_div3"></div>
		</div>

		<div class="item">
			<div id="chart_div4"></div>
		</div>

		<div class="item">
			<div id="chart_div5"></div>
		</div>

		<div class="item">
			<div id="chart_div6"></div>
		</div>
	</div>

	<!-- Left and right controls -->
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
</body>
</html>