<?php
	session_start();
	if((isset($_SESSION['islogged'])) && ($_SESSION['islogged'])) {
		header('Location: panel.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="stylesheet" href="styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Zaloguj
		</title>
	</head>
	<body>
		<div id="container">
			<div id="dodaj">
				<h4>
					Zaloguj
				</h4>
				<form name="login" method="POST" action="login.php">
					<input class="entry" name="e_login" type="text" placeholder="Login" />
					<br /><br />
					<input class="entry" name="e_password" type="password" placeholder="Hasło" />
					<br /><br />
					<input class="button" type="submit" value="ZALOGUJ" />
					<br /><br />
				</form>
<?php
	if(ISSET($_SESSION['error'])) {
		echo "<p class='error'>".$_SESSION['error']."</p><br />";
		unset($_SESSION['error']);
	}
?>
			</div>
		</div>
	</body>
</html>
