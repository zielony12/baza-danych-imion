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
				<div id="center">
<?php
		if(isset($_SESSION['error'])) {
			echo "<div id=\"session-info\">
						<div class=\"info\">i</div>";
			echo $_SESSION['error']."<br />";
			echo "</div>";
			unset($_SESSION['error']);
		}
?>
					<div id="pfhead">
						<img id="pfp" src="img/pfp.jpg" />
						<h1>
<?php
	echo $login;
?>
						</h1>
					</div>
					<div id="info">
						<div class="box">
							<h4>
								Łącznie dodane imiona
							</h4>
							<abig>
								<br />
<?php
	echo mysqli_fetch_assoc($db_connection -> query("SELECT `names_added` FROM `users` WHERE `login` = '$login'"))['names_added'];
?>
							</abig>
						</div>
						<div class="box">
							<h4>
								Dodane imiona
							</h4>
							<abig>
								<br />
<?php
	echo $db_connection -> query("SELECT * FROM `names` WHERE `name_author_id` = '$id'") -> num_rows;
?>
							</abig>
						</div>
						<div class="box">
							<h4>
								Ostatnie imie
							</h4>
							<amed>
								<br />
<?php
	echo mysqli_fetch_assoc($db_connection -> query("SELECT `name` FROM `names` WHERE `name_author_id` = '$id' ORDER BY `id` DESC"))['name'];
?>
							</amed>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
