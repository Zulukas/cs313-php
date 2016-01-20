<!DOCTYPE html>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
 	<form action="result.php" method="post">
 	Name: <input type="text" name="name" placeholder="John Doe"><br>
 	Email: <input type="text" name="email" placeholder="johndoe@gmail.com"><br>

 	<br>

 		<input type="radio" name="major" value="Computer Science" checked>Computer Science<br>
 		<input type="radio" name="major" value="Wed Development and Design">Web Development and Design<br>
 		<input type="radio" name="major" value="Computer Information Technology">Computer Information Technology<br>
 		<input type="radio" name="major" value="Computer Engineering">Computer Engineering<br>

 		<br>

 		<input type="checkbox" name="continents[]" value="Africa">Africa<br>
 		<input type="checkbox" name="continents[]" value="Antartica">Antartica<br>
 		<input type="checkbox" name="continents[]" value="Asia">Asia<br>
 		<input type="checkbox" name="continents[]" value="Australia">Australia<br>
 		<input type="checkbox" name="continents[]" value="Europe">Europe<br>
 		<input type="checkbox" name="continents[]" value="North America">North America<br>
 		<input type="checkbox" name="continents[]" value="South America">South America<br>

 		<br>

 		<input type="textarea" name="comments" placeholder="comments!"><br>

 		<br>

 		<button>Submit</button>
 	</form>
</body>
</html>