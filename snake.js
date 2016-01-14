/*****************************************************
*****************GAME STATE RELATION FUNCTIONS********
*****************************************************/

/*
	Initializes the snake heading upwards with three 
	segments
*/
function init() {
	//Generate the snake...
	var tuple1 = {'x':9, 'y':8};
	var tuple2 = {'x':9, 'y':9};
	var tuple3 = {'x':9, 'y':10};
	snakeArray = [tuple1, tuple2, tuple3];

	generateFood();
	dir = 0;
	// console.log(food['y']);
}

/*
	Updates the snake by making a new head in the
	correct direction.
	Removes the tail after adding the head if no food was eaten

	Also checks to see if there is a collision with the snake of the game boundaries
*/
function update() {
	//Reference the current head
	var curHead = snakeArray[0];

	//Declare the new head
	var newHead = {'x':curHead['x'], 'y':curHead['y']};	

	if (dir === 1) { //right
		newHead['x']++;
	}
	else if (dir === 2) { //up
		newHead['y']--;
	}
	else if (dir === 3) { //left
		// tail['x'] += 1;
		newHead['x']--;		
	}
	else if (dir === 4) { //down		
		newHead['y']++;
	}

	//If we've gone out of bounds...
	// if (newHead['x'] < 0 || newHead['x'] > 19 ||
	// 	newHead['y'] < 0 || newHead['y'] > 19) {
	// 	snakeIsDead = true;
	// 	return;
	// }

	if (outOfBounds(newHead['x'], newHead['y'])) {
		snakeIsDead = true;
		return;
	}

	//Check to see if we have collided with ourself...
	var collision = false;

	for (var i = 1; i < snakeArray.length - 1; i++) {
		var seg = snakeArray[i];

		if (seg['x'] === newHead['x'] &&
			seg['y'] === newHead['y']) {
			snakeIsDead = true;
			return;
		}
	}

	//Put the current head back on, and then the new head
	snakeArray.unshift(newHead);

	var tail = snakeArray.pop();

	//Check to see if we have eaten the food...
	if (newHead['x'] === food['x'] && newHead['y'] === food['y']) {
		snakeArray.push(tail);
		generateFood();
	}
}

/*****************************************************
*****************MISC HELPER FUNCTIONS****************
*****************************************************/
/*
	Turns coordinates into corresponding pixels
*/
function coordToPixel(x) {
	return x * 15;
}

function outOfBounds(x, y) {
	if (x < 0 || x > 19)
		return true;
	if (y < 0 || y > 19)
		return true;

	return false;
}

function generateFood() {
	var foodIsValid = true;

	do {
		foodIsValid = true;
		var x = Math.floor(Math.random() * 19);
		var y = Math.floor(Math.random() * 19);

		food = {'x':x, 'y':y};

		//Check to see if we have a collision in the generated food
		//with any of the snake segments.
		for (var i = 0; i < snakeArray.length - 1; i++) {
			var seg = snakeArray[i];

			if (food['x'] === seg['x'] ||
				food['y'] === seg['y']) {
				foodIsValid = false;
				break;
			}
		}
	} while (!foodIsValid)
	
}

/******************************************************
*******************DISPLAY RELATED FUNCTIONS***********
******************************************************/

function draw() {
	// ctx.fillStyle = "#FF0000";
	// ctx.fillRect(0,0,150,75);
	//testXSpan();

	//Clear the canvas
	ctx.clearRect(0, 0, 300, 300);

	//draw the snake...
	//console.log(snakeArray.length);
	for (var i = 0; i < snakeArray.length; i++) {
		// console.log(snakeArray[i])
		drawSegment(snakeArray[i], "#009900");
		// console.log(segment['x']);
		// drawSegment(segment, "#FF0000");
	}

	//draw the food...
	drawSegment(food, "#FF0000");
	//drawBox(coordToPixel(food['x']), coordToPixel(food['y']), "#009900");
}

function drawSegment(segment, color) {
	drawBox(coordToPixel(segment['x']), coordToPixel(segment['y']), color);
}

/*
	draws an individual segment onto the screen
	with a (x,y) coordinate at the top-left corner
	of the box.  

	Note: The x and y have an offset of 2 pixels
*/
function drawBox(x, y, color) {
	ctx.fillStyle = color;
	ctx.fillRect(x + 2, y + 2, 11, 11);
	ctx.fillStyle = "#FFFFFF";
	ctx.fillRect(x + 4, y + 4, 7, 7);
}

/*
	Nice quick function to test the range of X
*/
function testXSpan() {
	drawBox(0, 0, "#FF0000");
	drawBox(15, 0, "#00FF00");
	drawBox(30, 0, "#0000FF");
	drawBox(45, 0, "#FF0000");
	drawBox(60, 0, "#00FF00");
	drawBox(75, 0, "#0000FF");
	drawBox(90, 0, "#FF0000");
	drawBox(105, 0, "#00FF00");
	drawBox(120, 0, "#0000FF");
	drawBox(135, 0, "#FF0000");
	drawBox(150, 0, "#00FF00");
	drawBox(165, 0, "#0000FF");
	drawBox(180, 0, "#FF0000");
	drawBox(195, 0, "#00FF00");
	drawBox(210, 0, "#0000FF");
	drawBox(225, 0, "#FF0000");
	drawBox(240, 0, "#00FF00");
	drawBox(255, 0, "#0000FF");
	drawBox(270, 0, "#FF0000");
	drawBox(285, 0, "#0000FF");
}

/*
	Nice quick function to test the range of Y
*/
function testYSpan() {
	drawBox(0, 0, "#FF0000");
	drawBox(0, 15, "#00FF00");
	drawBox(0, 30, "#0000FF");
	drawBox(0, 45, "#FF0000");
	drawBox(0, 60, "#00FF00");
	drawBox(0, 75, "#0000FF");
	drawBox(0, 90, "#FF0000");
	drawBox(0, 105, "#00FF00");
	drawBox(0, 120, "#0000FF");
	drawBox(0, 135, "#FF0000");
	drawBox(0, 150, "#00FF00");
	drawBox(0, 165, "#0000FF");
	drawBox(0, 180, "#FF0000");
	drawBox(0, 195, "#00FF00");
	drawBox(0, 210, "#0000FF");
	drawBox(0, 225, "#FF0000");
	drawBox(0, 240, "#00FF00");
	drawBox(0, 255, "#0000FF");
	drawBox(0, 270, "#FF0000");
	drawBox(0, 285, "#0000FF");
}