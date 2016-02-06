<!DOCTYPE html>
<html>
<head>
	<title>Planet Express</title>
	<style>
		#loginbox {
			border-radius: 5px;
		    border: 5px solid #000000;
		    padding: 20px; 
		    width: 260px;
		    height: 150px; 
		    text-align: center;
		}

		.center {			
			margin: auto;
			width: 400px;			
		}
	</style>
	<script type="text/javascript">
	function validate(username, password)
	{

	}

	</script>
</head>
<body>
	<br>
	<br>
	<br>
	<div class="center">
		<form action="validate.php" method="POST">
			<div id="loginbox">
				<table>
					<tr>
						<td>Username:</td>
						<td><input type="text" name="username" placeholder="username"></td>
					</tr>
						<td> Password:</td>
						<td><input type="password" name="password" palceholder="password"></td>
					<tr>
					</tr>
				</table>

				<br>

				<input type="submit">
			</div>
		</form>
	</div>
</body>
</html>