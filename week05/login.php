<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<style>
		#loginbox {
			border-radius: 5px;
		    border: 5px solid #000000;
		    padding: 20px;
		    width: 260px;
		    height: 100px;
		    text-align: center;
		}

		.center {
			margin: auto;
			width: 400px;
			text-align: center;
		}

		.invalid {
			color: red;
		}

		.invalidMsg {
			color: red;
			width: auto;
			text-align: center;

		}
		.center #register {
			position:absolute;
			left:400px;
		}
	</style>
</head>
<body>
<?php
	if (isset($_COOKIE["INVALID"]))
	{
		echo "<h4 class='invalidMsg'>Invalid username/password</h4>";
	}
	else
	{
		echo "<br><br>";
	}
?>


	<br>
	<br>
	<div class="center">
		<form action="validate.php" method="POST">
			<div id="loginbox">
				<table>
					<tr>
						<td>Username:</td>
						<td><input type="text" name="username" placeholder="username"></td>
<?php
	if (isset($_COOKIE["INVALID"])) {
			echo "\t\t\t\t<td><span class='invalid'>*</span></td>\n";
	}
?>
					</tr>
						<td> Password:</td>
						<td><input type="password" name="password" palceholder="password"></td>
<?php
	if (isset($_COOKIE["INVALID"])) {
			echo "\t\t\t\t<td><span class='invalid'>*</span></td>\n";
	}
?>
					<tr>
					</tr>
				</table>

				<br>

				<input type="submit">
			</div>
		</form>
		<br />
		<a href="register.php" id="register">Register User</a>
		<br />
		<a href="registerorg.php" id="register">Register Organization</a>
	</div>
</body>
</html>
