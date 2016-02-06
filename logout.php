<?php
	session_destroy();

	if (isset($_COOKIE["INVALID"])) {
		// unset($_COOKIE["INVALID"]);
		setcookie("INVALID", "", time() - 3600);
	}

	header("Location: login.php");
?>