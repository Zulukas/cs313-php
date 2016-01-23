// google.charts.load('current', {'packages':['corechart']});


// var meatyData = google.visualization.arrayToDataTable([
//   ['Meat', 'Votes'],
//   ['Carne Asada', meatsArray[0].Carne_Asada],
//   ['Chicken',     meatsArray[0].Chicken],
//   ['Carnitas',    meatsArray[0].Carnitas],
//   ['Ground Beef', meatsArray[0].Ground_Beef],
//   ['Fish',        meatsArray[0].Fish],
//   ['Vegetairan',  meatsArray[0].Vegetarian]
// ]);

// var riceData = google.visualization.arrayToDataTable([
//   ['Rice', 'Votes'],
//   ['Cilantro Rice', riceArray[0].Cilantro_Rice],
//   ['Spanish Rice',  riceArray[0].Spanish_Rice],
//   ['White Rice',    riceArray[0].White_Rice],
//   ['Brown Rice', 	riceArray[0].Brown_Rice],
//   ['No Rice',       riceArray[0].No_Rice]          
// ]);

// var beansData = google.visualization.arrayToDataTable([
//   ['Beans', 'Votes'],
//   ['Refried Beans', beansArray[0].Refried_Beans],
//   ['Black Beans',   beansArray[0].Black_Beans],
//   ['Pinto Beans',   beansArray[0].Pinto_Beans],
//   ['No Beans', 		beansArray[0].No_Beans]
// ]);

// var mediumsData = google.visualization.arrayToDataTable([
//   ['Tortillas', 'Votes'],
//   ['Thick Tortilla', mediumsArray[0].Thick_Tortilla],
//   ['Thin Tortilla', mediumsArray[0].Thin_Tortilla],
//   ['Salad',  		mediumsArray[0].Salad]
// ]);

// var tomatoData = google.visualization.arrayToDataTable([
//   ['Tomato-ey Types', 'Votes'],
//   ['Plain', 		tomatoArray[0].Plain],
//   ['Pico de Gallo', tomatoArray[0].Pico_de_Gallo],
//   ['Salsa',  		tomatoArray[0].Salsa],
//   ['None',		  	tomatoArray[0].None]
// ]);

// var fixingsData = google.visualization.arrayToDataTable([
//   ['Fixings', 'Votes'],
//   ['Lettuce', 		fixingsArray[0].Lettuce],
//   ['Sour Cream',    fixingsArray[0].Sour_Cream],
//   ['Guacamole',    	fixingsArray[0].Guacamole],
//   ['Cilantro', 		fixingsArray[0].Cilantro],
//   ['Lime',        	fixingsArray[0].Lime],
//   ['Jalapenos',  	fixingsArray[0].Jalapenos],
//   ['Onions', 		fixingsArray[0].Onions]
// ]);

function drawMeatChart() {
	var myData = meatyData;
	var colors = ['#FACC00', '#FB9900', '#FB6600', '#FB4800', '#CB0A0A', '#F8F933'];
	var myChart = new JSChart('chartid', 'pie');
	
	myChart.setDataArray(myData);
	myChart.colorizePie(colors);
	myChart.setTitleColor('#857D7D');
	myChart.setPieUnitsColor('#9B9B9B');
	myChart.setPieValuesColor('#6A0000');
	myChart.draw();

	// var meatyOptions = {
 //          title: 'Favorite meats: '
 //    };

 //    var chart = new google.visualization.PieChart(document.getElementById('meatchart'));

 //    chart.draw(meatyData, meatyOptions);
}

function drawBeanChart() {
	var beansOptions = {
          title: 'Favorite beans: '
    };

    var chart = new google.visualization.PieChart(document.getElementById('beanschart'));

    chart.draw(beansData, beansOptions);    
}

function drawRiceChart() {
	var chart = new google.visualization.PieChart(document.getElementById('ricechart'));
 
    var riceOptions = {
      title: 'Favorite kinds of rice: '
    };

	chart.draw(riceData, riceOptions);
}

function drawTortillaChart() {
	var chart = new google.visualization.PieChart(document.getElementById('mediumchart'));

	var mediumsOptions = {
      title: 'Favorite kind of tortilla: '
    };

	chart.draw(mediumsData, mediumsOptions);
}

function drawTomatoChart() {
	var chart = new google.visualization.PieChart(document.getElementById('tomatochart'));

	var tomatoOptions = {
      title: 'Tomato-ey types: '
    };

	chart.draw(tomatoData, tomatoOptions);
}

function drawFixingsChart() {
	var chart = new google.visualization.PieChart(document.getElementById('fixingschart'));

	var fixingsOptions = {
      title: 'Favorite fixings: '
    };

	chart.draw(fixingsData, fixingsOptions);
}




    

    
    

        
        
        
        
        
        
