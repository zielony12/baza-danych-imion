<?php
	session_start();
	if((!isset($_SESSION['islogged'])) || (!$_SESSION['islogged'])) {
		header('Location: loginform.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="stylesheet" href="styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Panel
		</title>
	</head>
	<body>
		<div id="container">
			<div id="dodaj">
				<br />
				<?php
					echo "Witaj, ".$_SESSION['login']."!";
					echo "<br />";
					require_once "connect.php";
					try {
						$db_connection = new mysqli($db_host, $db_user, $db_password, $db_name);
						$db_connection -> query("SET NAMES 'utf8'");
						mysqli_set_charset($db_connection, "utf-8");
						if($db_connection -> connect_errno != 0) {
							throw new Exception(mysqli_connect_errno());
						}
					} catch(Exception $e) {
						$_SESSION['error'] = "Nie można się połączyć z bazą danych. Przepraszamy.";
						header('Location: index.php');
						exit();
					}
					$login = $_SESSION['login'];
					echo "Masz ".mysqli_fetch_assoc($db_connection -> query("SELECT `names_added` FROM `users` WHERE `login` = '$login'"))['names_added']." imion.";
				?>
				<br /><br />
				<form name="logout" method="POST" action="logout.php">
					<input type="submit" value="Wyloguj" />
				</form>
				<br />
				<form name="add" method="POST" action="addform.php">
					<input type="submit" value="Dodaj imie" />
				</form>
				<br />
			</div>
		</div>
	</body>
</html>
