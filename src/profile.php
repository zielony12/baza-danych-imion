<?php
	session_start();
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
	$login = $_GET['login'];
	$query_result = $db_connection -> query("SELECT * FROM `users` WHERE `login` = '$login'");
	$result = $query_result -> num_rows;
	if($result == 0) {
		$_SESSION['error'] = "Nie można odnaleźć użytkownika o podanym loginie";
		header('Location: index.php');
		exit();
	}
	$id = mysqli_fetch_assoc($db_connection -> query("SELECT `id` FROM `users` WHERE `login` = '$login'"))['id'];
?>
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
<?php
		if(isset($_SESSION['error'])) {
			echo "<div id=\"session-info\">
						<div class=\"info\">i</div>";
			echo $_SESSION['error']."<br />";
			echo "</div>";
			unset($_SESSION['error']);
		}
?>
				<h4>
					Profil użytkownika <?php echo $login; ?>
				</h4>
				<div>
					Ilość dodanych imion: <?php echo mysqli_fetch_assoc($db_connection -> query("SELECT * FROM `users` WHERE `id` = '$id'"))['names_added']; ?>
				</div>
			</div>
		</div>
	</body>
</html>
