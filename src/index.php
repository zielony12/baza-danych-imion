<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="stylesheet" href="styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Imiona
		</title>
	</head>
	<body>
		<div id="container">
			<div id="dodaj">
<?php
	session_start();
	if(isset($_SESSION['error'])) {
		echo $_SESSION['error']."<br />";
		unset($_SESSION['error']);
	}
?>
				<h4>
					Menu
				</h4>
<?php
	if((isset($_SESSION['islogged'])) && ($_SESSION['islogged'])) {
		echo "
			<a href=\"panel.php\">
				Panel
			</a>
		";
	} else {
		echo "
			<a href=\"loginform.php\">
				Zaloguj się
			</a>
		";
	}
?>
				<br />
				<a href="registerform.php">
					Zarejestruj się
				</a>
				<br />
				<a href="addform.php">
					Dodaj imię
				</a>
				<br />
				<a href="names.php">
					Pokaż imiona
				</a>
				<br />
				<a href="reports.php">
					Pokaż zgłoszenia
				</a>
				<br />
			</div>
		</div>
	</body>
</html>
