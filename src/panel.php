<?php
	session_start();
	if((!isset($_SESSION['islogged'])) || (!$_SESSION['islogged'])) {
		header('Location: loginform.php');
		exit();
	}
	require_once "connect.php";
	$db_connection = new mysqli($db_host, $db_user, $db_password, $db_name);
	$db_connection -> query("SET NAMES 'utf8'");
	mysqli_set_charset($db_connection, "utf-8");
	$login = $_SESSION['login'];
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
			<!--topbar begin-->
			<div id="topbar">
				<div id="topbar-left">
					<div class="topbar-item">
						<a href="index.php">
							Indeks
						</a>
					</div>
					<div class="topbar-item">
						<a href="names.php">
							Imiona
						</a>
					</div>
<?php
	if((isset($_SESSION['islogged'])) && ($_SESSION['islogged'])) {
		echo "<div class=\"topbar-item\"><a href=\"addform.php\">Dodaj</a></div>";
	}
?>
				</div>
				<div id="topbar-right">
					<div class="topbar-item">
<?php
	if((isset($_SESSION['islogged'])) && ($_SESSION['islogged'])) {
		echo "<a href=\"panel.php\">".$_SESSION['login']."</a>";
	} else {
		echo "<a href=\"loginform.php\">Zaloguj</a>";
	}
?>
					</div>
					<div class="topbar-item">
<?php
	if((isset($_SESSION['islogged'])) && ($_SESSION['islogged'])) {
		echo "<a href=\"logout.php\">Wyloguj</a>";
	} else {
		echo "<a href=\"registerform.php\">Zarejestruj</a>";
	}
?>
					</div>
				</div>
			</div>
			<!--topbar end-->
			<div id="content">
				<div id="center">
					<?php
						echo "<h3>".$login."</h3>";
						echo "Masz ".mysqli_fetch_assoc($db_connection -> query("SELECT `names_added` FROM `users` WHERE `login` = '$login'"))['names_added']." imion.";
					 ?>
				</div>
			</div>
		</div>
	</body>
</html>
